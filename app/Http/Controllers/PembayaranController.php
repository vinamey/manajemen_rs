<?php

namespace App\Http\Controllers;

use App\Models\ResepObat;
use Illuminate\Http\Request;

class PembayaranController extends Controller
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

        return view('kasir.pembayaran', compact('resepObats'));
    }
}
