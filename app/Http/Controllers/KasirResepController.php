<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;

class KasirResepController extends Controller
{
    /**
     * Halaman Resep Dokter khusus Kasir.
     */
    public function index()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
            ->latest()
            ->paginate(10);

        return view('kasir.resep', compact('resepObats'));
    }

    /**
     * Halaman Resep Dokter khusus Apoteker.
     */
    public function indexApoteker()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
            ->latest()
            ->paginate(10);

        return view('apoteker.resep', compact('resepObats'));
    }
}
