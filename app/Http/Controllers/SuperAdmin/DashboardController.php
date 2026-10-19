<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\PendaftaranPasien;
use App\Models\PemeriksaanDokter;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
         $user = Auth::user();
         if ($user->hasRole('super admin')) {
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
         if ($user->hasRole('admin rumah sakit')) {
            return view('admin.dashboard');
            }
         }

    }


