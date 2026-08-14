<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\PendaftaranPasien;
use App\Models\PemeriksaanDokter;
use App\Models\Pembayaran;

class DashboardController extends Controller
{
    public function superadmin()
    {
        $totalUser = User::count();
        $totalPasien = MasterPasien::count();
        $totalDokter = MasterDokter::count();
        $totalObat = MasterObat::count();
        $totalPendaftaran = PendaftaranPasien::count();
        $totalPemeriksaan = PemeriksaanDokter::count();
        $totalPembayaran = Pembayaran::count();

        return view('superadmin.dashboard', compact(
            'totalUser',
            'totalPasien',
            'totalDokter',
            'totalObat',
            'totalPendaftaran',
            'totalPemeriksaan',
            'totalPembayaran'
        ));
        
    }
}

