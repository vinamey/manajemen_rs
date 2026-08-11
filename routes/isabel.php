<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterPasienController;
use App\Http\Controllers\MasterDokterController;
use App\Http\Controllers\MasterPerawatController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;


// =======================
// Dashboard
// =======================
Route::get('/dashboard', [DashboardController::class, 'index']);


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
