<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterPasienController;
use App\Http\Controllers\MasterDokterController;
use App\Http\Controllers\MasterPerawatController;

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('master-pasien', MasterPasienController::class);
Route::resource('master-dokters', MasterDokterController::class);
Route::resource('master-perawat', MasterPerawatController::class);
