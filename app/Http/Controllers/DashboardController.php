<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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
=======
use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterPerawat;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPasien = MasterPasien::count();
        $totalDokter = MasterDokter::count();
        $totalPerawat = MasterPerawat::count();

        return view('master.dashboard', compact(
            'totalPasien',
            'totalDokter',
            'totalPerawat'
        ));
    }
}
>>>>>>> origin/main
