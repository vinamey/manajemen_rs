<?php

namespace App\Http\Controllers;

use App\Models\LogStokObat;

class LogStokObatController extends Controller
{
    public function index()
    {
       
        $logs = LogStokObat::with(['stokObat', 'obat'])
            ->orderBy('tanggal_update', 'desc')
            ->paginate(10);

       
        return view('log-stok-obat.index', compact('logs'));
    }
}