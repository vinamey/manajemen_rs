<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanDokter;
use App\Models\PendaftaranPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\StokObat;
use App\Models\ResepObat;
use App\Models\MasterFrekuensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PemeriksaanDokterController extends Controller
{
    // Halaman Pemeriksaan Dokter untuk Super Admin.
    public function index()
    {
        // Dokter tidak boleh melihat seluruh data pemeriksaan.
        if (auth()->user()->hasRole('dokter')) {
            return redirect()->route('dokter.resep.index');
        }

        $pemeriksaans = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->latest()->paginate(10);

        $pendaftarans = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
        ])
            ->whereDoesntHave('pemeriksaan')
            ->whereNotNull('dokter_id')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama', 'ASC')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama', 'ASC')
            ->get();

        $stokObats = StokObat::with([
            'obat',
            'satuanObat',
        ])
            ->orderBy('obat_id')
            ->get();

        $frekuensis = MasterFrekuensi::orderBy('nama', 'ASC')->get();

        return view('pemeriksaan-dokter.index', compact(
            'pemeriksaans',
            'pendaftarans',
            'dokters',
            'obats',
            'stokObats',
            'frekuensis'
        ));
    }

    // Halaman pemeriksaan khusus akun Dokter.
    public function indexDokter()
    {
        return $this->resepDokter();
    }

    // Menampilkan pemeriksaan dan resep dokter yang dipilih.
    public function resepDokter()
    {
        $dokterId = session('dokter_aktif_id');

        if (!$dokterId) {
            return redirect()->route('dokter.pilih');
        }

        $dokter = MasterDokter::find($dokterId);

        if (!$dokter) {
            session()->forget('dokter_aktif_id');

            return redirect()->route('dokter.pilih')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        $pemeriksaans = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'pendaftaran.poli',
            'dokter',
            'resep.obat',
        ])
            ->where('dokter_id', $dokterId)
            ->latest()
            ->paginate(10);


            $resepObats = ResepObat::with([
    'pemeriksaan.pendaftaran.pasien',
    'pemeriksaan.dokter',
    'obat',
])
    ->whereHas('pemeriksaan', function ($query) use ($dokterId) {
        $query->where('dokter_id', $dokterId);
    })
    ->latest()
   ->paginate(10, ['*'], 'resepPage');

        $pendaftarans = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
        ])
            ->where('dokter_id', $dokterId)
            ->whereDoesntHave('pemeriksaan')
            ->latest()
            ->get();

        $dokters = MasterDokter::where('id', $dokterId)->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama', 'ASC')
            ->get();

        $stokObats = StokObat::with([
            'obat',
            'satuanObat',
        ])
            ->orderBy('obat_id')
            ->get();

        $frekuensis = MasterFrekuensi::orderBy('nama', 'ASC')->get();

       return view('dokter.resep-obat', compact(
    'pemeriksaans',
    'resepObats',
    'pendaftarans',
    'dokters',
    'obats',
    'stokObats',
    'frekuensis'
));
    }

    // Menyimpan pemeriksaan dan resep obat.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'keluhan' => 'required|string',
            'resep_obat' => 'nullable|json',

            'obat_id' => 'nullable|integer|exists:master_obats,id',
            'satuan_obat_id' => 'nullable|integer|exists:master_satuan_obats,id',
            'jumlah_obat' => 'nullable|integer|min:1',
        ]);

        $pendaftaran = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
        ])->findOrFail($validated['pendaftaran_id']);

        if (!$pendaftaran->dokter_id) {
            return back()->withInput()->withErrors([
                'pendaftaran_id' => 'Pendaftaran ini belum memiliki dokter.',
            ]);
        }

        // Memastikan dokter hanya memeriksa pasien yang ditugaskan kepadanya.
        if (auth()->user()->hasRole('dokter')) {

            $dokterAktifId = session('dokter_aktif_id');

            if (!$dokterAktifId) {
                return redirect()->route('dokter.pilih');
            }

            if (!MasterDokter::whereKey($dokterAktifId)->exists()) {
                session()->forget('dokter_aktif_id');

                return redirect()->route('dokter.pilih');
            }

            if ((int) $pendaftaran->dokter_id !== (int) $dokterAktifId) {
                return back()->withInput()->withErrors([
                    'pendaftaran_id' => 'Pasien ini tidak ditugaskan kepada dokter yang sedang dipilih.',
                ]);
            }
        }

        // Mengambil daftar resep dari JSON.
        $obatList = [];

        if ($request->filled('resep_obat')) {

            $decoded = json_decode($request->resep_obat, true);

            if (!is_array($decoded)) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Format daftar resep obat tidak valid.',
                ]);
            }

            $obatList = $decoded;
        }

        // Jika menggunakan input obat langsung.
        if (empty($obatList) && $request->filled('obat_id')) {

            $obatList[] = [
                'obat_id' => $request->obat_id,
                'satuan_obat_id' => $request->satuan_obat_id,
                'jumlah' => $request->jumlah_obat,
                'frekuensi' => $request->frekuensi_obat,
                'lama' => $request->lama_obat,
                'aturan_pakai' => $request->aturan_pakai,
            ];
        }

        // Validasi setiap obat dan satuannya.
        $obatValid = [];

        foreach ($obatList as $obat) {

            $validator = Validator::make($obat, [
                'obat_id' => 'required|integer|exists:master_obats,id',
                'satuan_obat_id' => 'required|integer|exists:master_satuan_obats,id',
                'jumlah' => 'required|integer|min:1',
                'frekuensi' => 'nullable|string',
                'lama' => 'nullable|integer|min:1',
                'aturan_pakai' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withInput()
                    ->withErrors($validator);
            }

            $dataObat = $validator->validated();

            // Pastikan satuan tersedia untuk obat tersebut.
            $stokTersedia = StokObat::where('obat_id', $dataObat['obat_id'])
                ->where('satuan_obat_id', $dataObat['satuan_obat_id'])
                ->exists();

            if (!$stokTersedia) {
                return back()->withInput()->withErrors([
                    'resep_obat' => 'Satuan obat yang dipilih tidak tersedia untuk obat tersebut.',
                ]);
            }

            $obatValid[] = $dataObat;
        }

        // Simpan pemeriksaan dan resep dalam satu transaksi.
        DB::transaction(function () use ($validated, $pendaftaran, $obatValid) {

            $pemeriksaan = PemeriksaanDokter::create([
                'pendaftaran_id' => $pendaftaran->id,
                'dokter_id' => $pendaftaran->dokter_id,
                'keluhan' => $validated['keluhan'],
                'resep_obat' => 0,
            ]);

            if (empty($obatValid)) {
                return;
            }

            $resep = ResepObat::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'status' => 'menunggu',
            ]);

            foreach ($obatValid as $obat) {

                $aturan = [];

                if (!empty($obat['frekuensi'])) {
                    $aturan[] = 'Frekuensi: ' . $obat['frekuensi'];
                }

                if (!empty($obat['aturan_pakai'])) {
                    $aturan[] = 'Aturan: ' . $obat['aturan_pakai'];
                }

                if (!empty($obat['lama'])) {
                    $aturan[] = 'Lama: ' . $obat['lama'] . ' hari';
                }

                $resep->obat()->attach($obat['obat_id'], [
                    'satuan_obat_id' => $obat['satuan_obat_id'],
                    'nilai' => $obat['jumlah'],
                    'aturan_pakai' => implode(' | ', $aturan) ?: '-',
                ]);
            }
        });

        if (auth()->user()->hasRole('dokter')) {
            return redirect()
                ->route('dokter.resep.index')
                ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
        }

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dan resep obat berhasil disimpan.');
    }

    // Detail pemeriksaan.
    public function show($id)
    {
        $query = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ]);

        // Dokter hanya boleh melihat pemeriksaannya sendiri.
        if (auth()->user()->hasRole('dokter')) {

            $dokterId = session('dokter_aktif_id');

            if (!$dokterId) {
                return redirect()->route('dokter.pilih');
            }

            $query->where('dokter_id', $dokterId);
        }

        $pemeriksaan = $query->findOrFail($id);

        return view('pemeriksaan-dokter.show', compact('pemeriksaan'));
    }

    // Dokter tidak diperbolehkan mengedit pemeriksaan.
    public function edit($id)
    {
        if (auth()->user()->hasRole('dokter')) {
            abort(403, 'Dokter tidak memiliki akses untuk mengedit pemeriksaan.');
        }

        $pemeriksaan = PemeriksaanDokter::with([
            'pendaftaran.pasien',
            'dokter',
            'resep.obat',
        ])->findOrFail($id);

        $pendaftarans = PendaftaranPasien::with('pasien')
            ->whereDoesntHave('pemeriksaan')
            ->latest()
            ->get();

        $dokters = MasterDokter::orderBy('nama', 'ASC')->get();

        $obats = MasterObat::with('kategori')
            ->orderBy('nama', 'ASC')
            ->get();

        $stokObats = StokObat::with([
            'obat',
            'satuanObat',
        ])
            ->orderBy('obat_id')
            ->get();

        $frekuensis = MasterFrekuensi::orderBy('nama', 'ASC')->get();

        return view('pemeriksaan-dokter.edit', compact(
            'pemeriksaan',
            'pendaftarans',
            'dokters',
            'obats',
            'stokObats',
            'frekuensis'
        ));
    }

    // Memperbarui pemeriksaan.
    public function update(Request $request, $id)
    {
        if (auth()->user()->hasRole('dokter')) {
            abort(403, 'Dokter tidak memiliki akses untuk mengubah pemeriksaan.');
        }

        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'dokter_id' => 'required|exists:master_dokters,id',
            'keluhan' => 'required|string',
        ]);

        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        $pemeriksaan->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
        ]);

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    // Menghapus pemeriksaan dan resep terkait.
    public function destroy($id)
    {
        if (auth()->user()->hasRole('dokter')) {
            abort(403, 'Dokter tidak memiliki akses untuk menghapus pemeriksaan.');
        }

        $pemeriksaan = PemeriksaanDokter::findOrFail($id);

        DB::transaction(function () use ($pemeriksaan) {

            $resep = ResepObat::where(
                'pemeriksaan_id',
                $pemeriksaan->id
            )->first();

            if ($resep) {
                $resep->obat()->detach();
                $resep->delete();
            }

            $pemeriksaan->delete();
        });

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}
