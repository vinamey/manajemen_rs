<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterPoli;
use App\Models\MasterKamar;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PendaftaranPasienController extends Controller
{
    /**
     * Menampilkan data pendaftaran pasien.
     */
    public function index(Request $request)
    {
        $tanggalHariIni = now()->toDateString();

        $query = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
            'kamar'
        ]);

        /*
        |--------------------------------------------------------------------------
        | TAMPILAN AWAL
        |--------------------------------------------------------------------------
        | Jika tidak mencari dan tidak memilih tanggal,
        | tampilkan pendaftaran hari ini.
        | Jika mencari, data tanggal lama juga bisa ditemukan.
        */

        if (
            !$request->filled('search') &&
            !$request->filled('tanggal')
        ) {
            $query->whereDate(
                'tanggal_pendaftaran',
                $tanggalHariIni
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // Cari nomor antrean
                $q->where(
                    'nomor_antrian',
                    'like',
                    "%{$search}%"
                )

                // Cari nama pasien
                ->orWhereHas('pasien', function ($pasien) use ($search) {

                    $pasien->where(
                        'nama',
                        'like',
                        "%{$search}%"
                    );

                })

                // Cari nama dokter
                ->orWhereHas('dokter', function ($dokter) use ($search) {

                    $dokter->where(
                        'nama',
                        'like',
                        "%{$search}%"
                    );

                });

            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($request->filled('tanggal')) {

            $query->whereDate(
                'tanggal_pendaftaran',
                $request->tanggal
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER POLI
        |--------------------------------------------------------------------------
        */

        if ($request->filled('poli_id')) {

            $query->where(
                'poli_id',
                $request->poli_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $pendaftarans = $query
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | DATA DROPDOWN
        |--------------------------------------------------------------------------
        */

        $pasiens = MasterPasien::orderBy('nama')->get();

        $dokters = MasterDokter::with('poli')
            ->orderBy('nama')
            ->get();

        $polis = MasterPoli::orderBy('nama')->get();

       // Mengambil kamar beserta jumlah pasien aktif
            $kamars = MasterKamar::query()
                ->select('master_kamars.*')
                ->selectSub(
                    PendaftaranPasien::query()
                        ->selectRaw('COUNT(DISTINCT pasien_id)')
                        ->whereColumn(
                            'pendaftaran_pasiens.kamar_id',
                            'master_kamars.id'
                        )
                        ->whereIn('status', ['menunggu', 'diperiksa']),
                    'jumlah_pasien'
                )
                ->orderBy('nama')
                ->get();
        /*
        |--------------------------------------------------------------------------
        | STATISTIK PENDAFTARAN HARI INI
        |--------------------------------------------------------------------------
        */

        $statistik = PendaftaranPasien::whereDate(
            'tanggal_pendaftaran',
            $tanggalHariIni
        );

        // Total seluruh pendaftaran hari ini
        $totalPendaftaran = (clone $statistik)->count();

        // Total menunggu hari ini
        $totalMenunggu = (clone $statistik)
            ->whereRaw('LOWER(status) = ?', ['menunggu'])
            ->count();

        // Total diperiksa hari ini
        $totalDiperiksa = (clone $statistik)
            ->whereRaw('LOWER(status) = ?', ['diperiksa'])
            ->count();

        // Total selesai hari ini
        $totalSelesai = (clone $statistik)
            ->whereRaw('LOWER(status) = ?', ['selesai'])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('pendaftaran.index', compact(
            'pendaftarans',
            'pasiens',
            'dokters',
            'polis',
            'kamars',
            'totalPendaftaran',
            'totalMenunggu',
            'totalDiperiksa',
            'totalSelesai',
            'tanggalHariIni'
        ));
    }


    /**
     * Menyimpan pendaftaran pasien.
     */
   
public function store(Request $request)
{
    $request->validate([
        'pasien_id' => 'required|exists:master_pasiens,id',
        'dokter_id' => 'required|exists:master_dokters,id',
        'poli_id' => 'required|exists:master_polis,id',
        'kamar_id' => 'nullable|exists:master_kamars,id',
        'tanggal_pendaftaran' => 'required|date',
    ]);

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | CEK KAPASITAS KAMAR
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kamar_id')) {

            // Mengunci data kamar selama proses pendaftaran
            $kamar = MasterKamar::whereKey($request->kamar_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Menghitung pasien aktif dalam kamar
            $jumlahPasien = PendaftaranPasien::where(
                'kamar_id',
                $kamar->id
            )
                ->whereIn('status', ['menunggu', 'diperiksa'])
                ->distinct()
                ->count('pasien_id');

            // Memeriksa apakah pasien sudah menempati kamar tersebut
            $pasienSudahDiKamar = PendaftaranPasien::where(
                'kamar_id',
                $kamar->id
            )
                ->where('pasien_id', $request->pasien_id)
                ->whereIn('status', ['menunggu', 'diperiksa'])
                ->exists();

            // Menolak jika kamar penuh dan pasien belum terdaftar di kamar itu
            if (
                $jumlahPasien >= 4 &&
                !$pasienSudahDiKamar
            ) {

                DB::rollBack();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Kamar ' . $kamar->nama .
                        ' sudah penuh. Kapasitas maksimal hanya 4 pasien.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | MEMBUAT DATA PASIEN JIKA BELUM ADA
        |--------------------------------------------------------------------------
        */

        $masterPasien = MasterPasien::findOrFail(
            $request->pasien_id
        );

        $jenisKelamin = $masterPasien->jenis_kelamin;

        if ($jenisKelamin === 'L') {
            $jenisKelamin = 'Laki-laki';
        } elseif ($jenisKelamin === 'P') {
            $jenisKelamin = 'Perempuan';
        }

        $pasien = Pasien::where(
            'nama_pasien',
            $masterPasien->nama
        )
            ->where(
                'jenis_kelamin',
                $jenisKelamin
            )
            ->first();

        if (!$pasien) {

            $pasien = Pasien::create([
                'no_rekam_medis' => 'RM-' . strtoupper(Str::random(6)),
                'nama_pasien' => $masterPasien->nama,
                'jenis_kelamin' => $jenisKelamin,
                'tanggal_masuk' => $request->tanggal_pendaftaran,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | MEMBUAT NOMOR ANTRIAN
        |--------------------------------------------------------------------------
        */

        $jumlahPendaftaran = PendaftaranPasien::whereDate(
            'tanggal_pendaftaran',
            $request->tanggal_pendaftaran
        )->count();

        $nomorAntrian = 'A-' . str_pad(
            $jumlahPendaftaran + 1,
            3,
            '0',
            STR_PAD_LEFT
        );


        /*
        |--------------------------------------------------------------------------
        | SIMPAN PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        PendaftaranPasien::create([

            'pasien_id' => $masterPasien->id,

            'dokter_id' => $request->dokter_id,

            'poli_id' => $request->poli_id,

            'kamar_id' => $request->kamar_id,

            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,

            'nomor_antrian' => $nomorAntrian,

            'status' => 'menunggu',

        ]);

        DB::commit();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Pendaftaran pasien berhasil disimpan.');

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Gagal menyimpan pendaftaran pasien.');
    }
}


    /**
     * Menampilkan detail pendaftaran.
     */
    public function show($id)
    {
        $pendaftaran = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
            'kamar'
        ])->findOrFail($id);

        return view(
            'pendaftaran.show',
            compact('pendaftaran')
        );
    }


    /**
     * Menampilkan form edit.
     */
    public function edit($id)
    {
        $pendaftaran = PendaftaranPasien::findOrFail($id);

        $pasiens = MasterPasien::orderBy('nama')->get();

        $dokters = MasterDokter::with('poli')->get();

        $polis = MasterPoli::all();

       // Mengambil kamar beserta jumlah pasien aktif
        $kamars = MasterKamar::query()
            ->select('master_kamars.*')
            ->selectSub(
                PendaftaranPasien::query()
                    ->selectRaw('COUNT(DISTINCT pasien_id)')
                    ->whereColumn(
                        'pendaftaran_pasiens.kamar_id',
                        'master_kamars.id'
                    )
                    ->whereIn('status', ['menunggu', 'diperiksa']),
                'jumlah_pasien'
            )
            ->orderBy('nama')
            ->get();

        return view('pendaftaran.edit', compact(
            'pendaftaran',
            'pasiens',
            'dokters',
            'polis',
            'kamars'
        ));
    }


    /**
     * Memperbarui pendaftaran.
     */
    
public function update(Request $request, $id)
{
    $request->validate([
        'pasien_id' => 'required|exists:master_pasiens,id',
        'dokter_id' => 'required|exists:master_dokters,id',
        'poli_id' => 'required|exists:master_polis,id',
        'kamar_id' => 'nullable|exists:master_kamars,id',
        'tanggal_pendaftaran' => 'required|date',
        'status' => 'required|in:menunggu,diperiksa,selesai',
    ]);

    DB::beginTransaction();

    try {

        $pendaftaran = PendaftaranPasien::whereKey($id)
            ->lockForUpdate()
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | CEK KAPASITAS KAMAR SAAT EDIT
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('kamar_id') &&
            in_array($request->status, ['menunggu', 'diperiksa'], true)
        ) {

            $kamar = MasterKamar::whereKey($request->kamar_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Menghitung pasien aktif selain pendaftaran yang sedang diedit
            $jumlahPasien = PendaftaranPasien::where(
                'kamar_id',
                $kamar->id
            )
                ->whereIn('status', ['menunggu', 'diperiksa'])
                ->where('id', '!=', $pendaftaran->id)
                ->distinct()
                ->count('pasien_id');

            // Memeriksa apakah pasien sudah berada di kamar tujuan
            $pasienSudahDiKamar = PendaftaranPasien::where(
                'kamar_id',
                $kamar->id
            )
                ->where('pasien_id', $request->pasien_id)
                ->whereIn('status', ['menunggu', 'diperiksa'])
                ->where('id', '!=', $pendaftaran->id)
                ->exists();

            if (
                $jumlahPasien >= 4 &&
                !$pasienSudahDiKamar
            ) {

                DB::rollBack();

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Kamar ' . $kamar->nama .
                        ' sudah penuh. Kapasitas maksimal hanya 4 pasien.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        $pendaftaran->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli_id' => $request->poli_id,
            'kamar_id' => $request->kamar_id,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'status' => $request->status,
        ]);

        DB::commit();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui.');

    } catch (\Throwable $e) {

        DB::rollBack();

        report($e);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Gagal memperbarui pendaftaran pasien.');
    }
}


    /**
     * Menghapus pendaftaran.
     */
    public function destroy($id)
    {
        $pendaftaran = PendaftaranPasien::findOrFail($id);

        $pendaftaran->delete();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
