<?php

namespace App\Http\Controllers;

use App\Models\PendaftaranPasien;
use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterPoli;
use App\Models\MasterKamar;
use Illuminate\Http\Request;

class PendaftaranPasienController extends Controller
{
    /**
     * Menampilkan semua data pendaftaran pasien
     */
    public function index(Request $request)
    {
        $query = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli',
            'kamar'
        ]);


        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('nomor_antrian', 'like', '%' . $search . '%')


                    ->orWhereHas('pasien', function ($pasien) use ($search) {
                        $pasien->where('nama', 'like', '%' . $search . '%')
                            ->orWhere('nik', 'like', '%' . $search . '%')
                            ->orWhere('no_rm', 'like', '%' . $search . '%');
                    })


                    ->orWhereHas('dokter', function ($dokter) use ($search) {
                        $dokter->where('nama', 'like', '%' . $search . '%');
                    });
            });
        } elseif ($request->filled('tanggal')) {

            $query->whereDate('tanggal_pendaftaran', $request->tanggal);
       }

        if ($request->filled('poli_id')) {
            $query->where('poli_id', $request->poli_id);
        }


        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

       $pendaftarans = $query
        ->oldest('id')
        ->paginate(10)
        ->withQueryString();

        $pasiens = MasterPasien::all();

        $dokters = MasterDokter::with('poli')
            ->orderBy('nama')
            ->get();

        $polis = MasterPoli::orderBy('nama')->get();

        $kamars = MasterKamar::all();


       // Total seluruh pendaftaran
$totalPendaftaran = PendaftaranPasien::count();

// Total pendaftaran menunggu
$totalMenunggu = PendaftaranPasien::whereRaw(
    'LOWER(status) = ?', ['menunggu']
)->count();

// Total pendaftaran diperiksa
$totalDiperiksa = PendaftaranPasien::whereRaw(
    'LOWER(status) = ?', ['diperiksa']
)->count();

// Total pendaftaran selesai
$totalSelesai = PendaftaranPasien::whereRaw(
    'LOWER(status) = ?', ['selesai']
)->count();
        return view(
            'pendaftaran.index',
            compact(
                'pendaftarans',
                'pasiens',
                'dokters',
                'polis',
                'kamars',
                'totalPendaftaran',
                'totalMenunggu',
                'totalDiperiksa',
                'totalSelesai'
            )
        );
    }


    public function create()
    {
         $pasiens = MasterPasien::orderBy('nama')->get();

        $dokters = MasterDokter::with('poli')
            ->orderBy('nama')
            ->get();

         $polis = MasterPoli::orderBy('nama')->get();


        $kamars = MasterKamar::orderBy('nama')->get();

        return view(
            'pendaftaran.create',
            compact(
                'pasiens',
                'dokters',
                'polis',
                'kamars'
            )
        );
    }



public function store(Request $request)
{
    $validated = $request->validate([
        'pasien_id' => 'required|exists:master_pasiens,id',
        'dokter_id' => 'required|exists:master_dokters,id',
        'poli_id' => 'required|exists:master_polis,id',
        'kamar_id' => 'nullable|exists:master_kamars,id',
        'tanggal_pendaftaran' => 'required|date',
    ]);

    // Ambil nomor antrian terakhir berdasarkan tanggal pendaftaran
    $latestAntrian = PendaftaranPasien::whereDate('tanggal_pendaftaran', $request->tanggal_pendaftaran)
        ->latest('id')
        ->first();

    $maxNumber = 0;

    if ($latestAntrian && $latestAntrian->nomor_antrian) {
        $maxNumber = (int) preg_replace('/[^0-9]/', '', $latestAntrian->nomor_antrian);
    }

    $nomorAntrian = 'A-' . str_pad($maxNumber + 1, 3, '0', STR_PAD_LEFT);

    PendaftaranPasien::create([
        'pasien_id' => $request->pasien_id,
        'dokter_id' => $request->dokter_id,
        'poli_id' => $request->poli_id,
        'kamar_id' => $request->kamar_id,
        'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        'nomor_antrian' => $nomorAntrian, // Memastikan string A-00x masuk ke database
        'status' => 'menunggu',
    ]);

    return redirect()
        ->route('pendaftaran.index')
        ->with('success', 'Pendaftaran pasien berhasil ditambahkan.');
}


    public function show(PendaftaranPasien $pendaftaran)
    {
        $pendaftaran->load([
            'pasien',
            'dokter',
            'poli',
            'kamar'
        ]);

        return view('pendaftaran.show', compact('pendaftaran'));
    }


    public function edit(PendaftaranPasien $pendaftaran)
    {
        $pasiens = MasterPasien::all();
        $dokters = MasterDokter::all();
        $polis = MasterPoli::all();
        $kamars = MasterKamar::all();

        return view(
            'pendaftaran.edit',
            compact(
                'pendaftaran',
                'pasiens',
                'dokters',
                'polis',
                'kamars'
            )
        );
    }

    public function update(Request $request, PendaftaranPasien $pendaftaran)
    {
        $request->validate([
            'pasien_id' => 'required|exists:master_pasiens,id',
            'dokter_id' => 'required|exists:master_dokters,id',
            'poli_id' => 'required|exists:master_polis,id',
            'kamar_id' => 'nullable|exists:master_kamars,id',
            'tanggal_pendaftaran' => 'required|date',
            'status' => 'required|in:menunggu,diperiksa,selesai',
        ]);

        $pendaftaran->update([
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'poli_id' => $request->poli_id,
            'kamar_id' => $request->kamar_id,
            'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil diperbarui!');
    }


    public function destroy(PendaftaranPasien $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}
