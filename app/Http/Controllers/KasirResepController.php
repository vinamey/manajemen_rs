<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;

class KasirResepController extends Controller
{
    public function index()
    {
        $resepObats = ResepObat::with([
            'pemeriksaan.pendaftaran.pasien',
            'pemeriksaan.dokter',
            'obat',
        ])
        ->latest()
        ->paginate(10);

        return view(
            'kasir.resep',
            compact('resepObats')
        );
    }
}
