<?php
 namespace App\Http\Controllers;

use App\Models\LogStokObat;

class StokObatController extends Controller
{
    public function index()
    {
        // Mengambil data log stok beserta relasi ke obat
        $logs = LogStokObat::with(['obat', 'stokObat'])
            ->latest('tanggal_update')
            ->paginate(10);

        return view('log-stok-obat.index', compact('logs'));
    }
}