<?php

namespace App\Http\Controllers;

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
