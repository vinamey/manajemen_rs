<?php

namespace App\Http\Controllers;

use App\Models\MasterDokter;
use App\Models\MasterPasien;
use App\Models\MasterPerawat;
use App\Models\MasterObat;
use App\Models\MasterKamar;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (strtolower($user->getRoleNames()->first() ?? '') === 'direktur') {

            $jumlahPasien = MasterPasien::count();
            $jumlahDokter = MasterDokter::count();
            $jumlahPerawat = MasterPerawat::count();
            $jumlahObat = MasterObat::count();
            $jumlahKamar = MasterKamar::count();

            $pendapatan = 0;

            return view('direktur.dashboard', compact(
                'jumlahPasien',
                'jumlahDokter',
                'jumlahPerawat',
                'jumlahObat',
                'jumlahKamar',
                'pendapatan'
            ));
        }

        return view('dashboard');
    }

    public function laporan()
    {
        return view('direktur.laporan');
    }
}