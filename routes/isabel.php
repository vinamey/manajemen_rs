<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterPasienController;
use App\Http\Controllers\MasterDokterController;
use App\Http\Controllers\MasterPerawatController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\AuthController;


/// ==============================
// LOGIN
// ==============================

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// =======================
// Dashboard
// =======================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');


// =======================
// Master Data
// =======================

Route::resource('master-pasien', MasterPasienController::class);

Route::resource('master-dokters', MasterDokterController::class);

Route::resource('master-perawat', MasterPerawatController::class);

Route::resource('master-apoteker', ApotekerController::class);


// =======================
// Kasir
// =======================

Route::resource('kasir', KasirController::class);
