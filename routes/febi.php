<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {

    // Dashboard Utama (Opsional)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // =======================
    // Dashboard Super Admin
    // =======================
    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('superadmin.dashboard');

    // =======================
    // Dashboard Admin Rumah Sakit
    // =======================
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // =======================
    // Dashboard Dokter
    // =======================
    Route::get('/dokter/dashboard', function () {
        return view('dokter.dashboard');
    })->name('dokter.dashboard');

    // =======================
    // Dashboard Perawat
    // =======================
    Route::get('/perawat/dashboard', function () {
        return view('perawat.dashboard');
    })->name('perawat.dashboard');

    // =======================
    // Dashboard Apoteker
    // =======================
    Route::get('/apoteker/dashboard', function () {
        return view('apoteker.dashboard');
    })->name('apoteker.dashboard');

    // =======================
    // Dashboard Kasir
    // =======================
    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    // =======================
    // Dashboard Direktur
    // =======================
    Route::get('/direktur/dashboard', function () {
        return view('direktur.dashboard');
    })->name('direktur.dashboard');

    // =======================
    // Logout
    // =======================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
