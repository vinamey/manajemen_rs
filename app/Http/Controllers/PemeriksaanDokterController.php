<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanDokter;
use App\Models\PendaftaranPasien;
use App\Models\MasterDokter;
use Illuminate\Http\Request;
use App\Models\MasterObat;
use App\Models\ResepObat;

class PemeriksaanDokterController extends Controller
{
    /**
     * Menampilkan daftar pemeriksaan dokter
     */
   public function index()
{
    $pemeriksaans = PemeriksaanDokter::with([
        'pendaftaran.pasien',
        'pendaftaran.poli',
        'pendaftaran.kamar',
        'dokter',
        'obat',
    ])
    ->latest()
    ->get();

    $pendaftarans = PendaftaranPasien::with([
        'pasien',
        'dokter',
        'poli',
    ])
    ->latest()
    ->get();

    $dokters = MasterDokter::orderBy('nama')->get();

   $obats = MasterObat::orderBy('nama')->get();

    return view('pemeriksaan-dokter.index', compact(
        'pemeriksaans',
        'pendaftarans',
        'dokters',
        'obats'
    ));
}
    /**
     * Menampilkan form pemeriksaan dokter
     */
    public function create()
{
    $pendaftarans = PendaftaranPasien::with([
        'pasien',
        'dokter',
        'poli'
    ])->latest()->get();

    $dokters = MasterDokter::all();

   $obats = MasterObat::orderBy('nama')->get();

    return view(
        'pemeriksaan-dokter.create',
        compact(
            'pendaftarans',
            'dokters',
            'obats'
        )
    );
}

    /**
     * Menyimpan pemeriksaan dokter
     */
    public function store(Request $request)
{
    $request->validate([
        'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
        'dokter_id' => 'required|exists:master_dokters,id',
        'keluhan' => 'required|string',
        'resep_obat' => 'required|exists:master_obats,id',
    ]);

    // Simpan pemeriksaan dokter
    $pemeriksaan = PemeriksaanDokter::create([
        'pendaftaran_id' => $request->pendaftaran_id,
        'dokter_id' => $request->dokter_id,
        'keluhan' => $request->keluhan,
        'resep_obat' => $request->resep_obat,
    ]);

    // Buat data resep berdasarkan pemeriksaan
    ResepObat::create([
        'pemeriksaan_id' => $pemeriksaan->id,
    ]);

    // Ubah status pendaftaran menjadi selesai
    $pendaftaran = PendaftaranPasien::findOrFail(
        $request->pendaftaran_id
    );

    $pendaftaran->update([
        'status' => 'selesai',
    ]);

    return redirect()
        ->route('pemeriksaan-dokter.index')
        ->with(
            'success',
            'Pemeriksaan dokter dan resep obat berhasil disimpan. Status pasien menjadi selesai.'
        );
}
    /**
     * Menampilkan detail pemeriksaan dokter
     */
    public function show(PemeriksaanDokter $pemeriksaanDokter)
    {
        $pemeriksaanDokter->load([
            'pendaftaran.pasien',
            'pendaftaran.poli',
            'pendaftaran.kamar',
            'dokter'
        ]);

        return view(
            'pemeriksaan-dokter.show',
            compact('pemeriksaanDokter')
        );
    }

    /**
     * Menampilkan form edit pemeriksaan
     */
    public function edit(PemeriksaanDokter $pemeriksaanDokter)
    {
        $pendaftarans = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli'
        ])
        ->latest()
        ->get();

        $dokters = MasterDokter::all();

        return view(
            'pemeriksaan-dokter.edit',
            compact(
                'pemeriksaanDokter',
                'pendaftarans',
                'dokters'
            )
        );
    }

    /**
     * Memperbarui pemeriksaan dokter
     */
    public function update(
        Request $request,
        PemeriksaanDokter $pemeriksaanDokter
    ) {
        $request->validate([
            'pendaftaran_id' => 'required|exists:pendaftaran_pasiens,id',
            'dokter_id' => 'required|exists:master_dokters,id',
            'keluhan' => 'required|string',
            'resep_obat' => 'required|integer',
        ]);

        $pemeriksaanDokter->update([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'resep_obat' => $request->resep_obat,
        ]);

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dokter berhasil diperbarui!');
    }

    /**
     * Menghapus pemeriksaan dokter
     */
    public function destroy(PemeriksaanDokter $pemeriksaanDokter)
    {
        $pemeriksaanDokter->delete();

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dokter berhasil dihapus!');
    }
}