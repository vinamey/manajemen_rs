<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPasien;
use App\Models\MasterPerawat;
use App\Models\MasterObat;
use App\Models\MasterKamar;
use App\Models\PendaftaranPasien; // 1. Tambahkan Import Model PendaftaranPasien
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalUser        = User::count();
        $totalPasien      = MasterPasien::count();
        $totalDokter      = MasterDokter::count();
        $totalPerawat     = MasterPerawat::count();
        $totalObat        = MasterObat::count();
        $totalKamar       = MasterKamar::count();

        
        $totalPendaftaran = PendaftaranPasien::whereDate('tanggal_pendaftaran', Carbon::today())->count();

        if (strtolower($user->getRoleNames()->first() ?? '') === 'direktur') {
            $pendapatan = 0;

            return view('direktur.dashboard', compact(
                'totalUser',
                'totalPasien',
                'totalDokter',
                'totalPerawat',
                'totalObat',
                'totalKamar',
                'totalPendaftaran', 
                'pendapatan'
            ));
        }

       
        return view('dashboard', compact(
            'totalUser',
            'totalPasien',
            'totalDokter',
            'totalPerawat',
            'totalObat',
            'totalKamar',
            'totalPendaftaran'
        ));
    }

    public function laporan()
    {
        return view('direktur.laporan');
    }
}