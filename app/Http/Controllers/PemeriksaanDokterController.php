<?php

namespace App\Http\Controllers;

use App\Models\PemeriksaanDokter;
use App\Models\PendaftaranPasien;
use App\Models\MasterDokter;
use Illuminate\Http\Request;

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
            'dokter'
        ])
        ->latest()
        ->get();

        return view('pemeriksaan-dokter.index', compact('pemeriksaans'));
    }

    /**
     * Menampilkan form pemeriksaan dokter
     */
    public function create()
    {
        // Mengambil data pendaftaran pasien
        $pendaftarans = PendaftaranPasien::with([
            'pasien',
            'dokter',
            'poli'
        ])
        ->latest()
        ->get();

        // Mengambil data dokter
        $dokters = MasterDokter::all();

        return view(
            'pemeriksaan-dokter.create',
            compact('pendaftarans', 'dokters')
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
            'resep_obat' => 'required|integer',
        ]);

        PemeriksaanDokter::create([
            'pendaftaran_id' => $request->pendaftaran_id,
            'dokter_id' => $request->dokter_id,
            'keluhan' => $request->keluhan,
            'resep_obat' => $request->resep_obat,
        ]);

        return redirect()
            ->route('pemeriksaan-dokter.index')
            ->with('success', 'Pemeriksaan dokter berhasil disimpan!');
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