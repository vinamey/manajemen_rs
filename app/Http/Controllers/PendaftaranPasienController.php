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
    // =====================================
    // QUERY PENDAFTARAN + RELASI
    // =====================================

    $query = PendaftaranPasien::with([
        'pasien',
        'dokter',
        'poli',
        'kamar'
    ]);


    // =====================================
    // SEARCH
    // =====================================

    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            // Cari nomor antrian
            $q->where('nomor_antrian', 'like', '%' . $search . '%')

                // Cari nama pasien
                ->orWhereHas('pasien', function ($pasien) use ($search) {

                    $pasien->where(
                        'nama',
                        'like',
                        '%' . $search . '%'
                    );

                })

                // Cari nama dokter
                ->orWhereHas('dokter', function ($dokter) use ($search) {

                    $dokter->where(
                        'nama',
                        'like',
                        '%' . $search . '%'
                    );

                });

        });

    }


    // =====================================
    // FILTER POLI
    // =====================================

    if ($request->filled('poli_id')) {

        $query->where('poli_id', $request->poli_id);

    }


    // =====================================
    // FILTER STATUS
    // =====================================

    if ($request->filled('status')) {

        $query->where('status', $request->status);

    }


    // =====================================
    // FILTER TANGGAL
    // =====================================

    if ($request->filled('tanggal')) {

        $query->whereDate(
            'tanggal_pendaftaran',
            $request->tanggal
        );

    }


    // =====================================
    // AMBIL DATA
    // =====================================

   $pendaftarans = $query
    ->latest()
    ->paginate(10)
    ->withQueryString();


   // =====================================
// DATA UNTUK DROPDOWN
// =====================================

$pasiens = MasterPasien::all();

$dokters = MasterDokter::with('poli')
    ->orderBy('nama')
    ->get();

$polis = MasterPoli::orderBy('nama')->get();

$kamars = MasterKamar::all();

    // =====================================
// STATISTIK PENDAFTARAN
// =====================================

$totalPendaftaran = PendaftaranPasien::count();

$totalMenunggu = PendaftaranPasien::where(
    'status',
    'menunggu'
)->count();

$totalDiperiksa = PendaftaranPasien::where(
    'status',
    'diperiksa'
)->count();

$totalSelesai = PendaftaranPasien::where(
    'status',
    'selesai'
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

    /**
     * Menampilkan form tambah pendaftaran
     */
    public function create()
{
    $pasiens = MasterPasien::all();

    $dokters = MasterDokter::with('poli')
        ->orderBy('nama')
        ->get();

    $kamars = MasterKamar::all();

    return view(
        'pendaftaran.create',
        compact(
            'pasiens',
            'dokters',
            'kamars'
        )
    );
}

    /**
     * Menyimpan data pendaftaran
     */
   public function store(Request $request)
{
    $request->validate([
        'pasien_id' => 'required|exists:master_pasiens,id',
        'dokter_id' => 'required|exists:master_dokters,id',
        'kamar_id' => 'required|exists:master_kamars,id',
        'tanggal_pendaftaran' => 'required|date',
    ]);

    // Ambil dokter beserta poli yang sudah ditentukan di Master Dokter
    $dokter = MasterDokter::with('poli')
        ->findOrFail($request->dokter_id);

    // Pastikan dokter sudah mempunyai poli
    if (!$dokter->poli_id) {
        return back()
            ->withInput()
            ->withErrors([
                'dokter_id' => 'Dokter tersebut belum memiliki poli. Silakan atur poli pada Master Dokter terlebih dahulu.'
            ]);
    }

    // Generate nomor antrian
    $nomorAntrian = 'A-' . str_pad(
        PendaftaranPasien::whereDate(
            'tanggal_pendaftaran',
            $request->tanggal_pendaftaran
        )->count() + 1,
        3,
        '0',
        STR_PAD_LEFT
    );

    PendaftaranPasien::create([
        'pasien_id' => $request->pasien_id,
        'dokter_id' => $dokter->id,

        // POLI OTOMATIS DARI MASTER DOKTER
        'poli_id' => $dokter->poli_id,

        'kamar_id' => $request->kamar_id,
        'tanggal_pendaftaran' => $request->tanggal_pendaftaran,
        'nomor_antrian' => $nomorAntrian,
        'status' => 'menunggu',
    ]);

    return redirect()
        ->route('pendaftaran.index')
        ->with(
            'success',
            'Pendaftaran pasien berhasil ditambahkan.'
        );
}


    /**
     * Menampilkan detail pendaftaran
     */
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


    /**
     * Menampilkan form edit
     */
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


    /**
     * Update data pendaftaran
     */
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


    /**
     * Menghapus data pendaftaran
     */
    public function destroy(PendaftaranPasien $pendaftaran)
    {
        $pendaftaran->delete();

        return redirect()
            ->route('pendaftaran.index')
            ->with('success', 'Data pendaftaran berhasil dihapus!');
    }
}