<?php

use App\Http\Controllers\MasterPasienController;
use App\Http\Controllers\MasterDokterController;
use App\Http\Controllers\MasterPerawatController;
use App\Http\Controllers\MasterObatController;
use App\Http\Controllers\MasterSupplierController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\MasterSatuanController;
use App\Http\Controllers\MasterPoliController;
use App\Http\Controllers\MasterKamarController;
use App\Http\Controllers\MasterAsuransiController;
use App\Http\Controllers\MasterTindakanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use App\Models\MasterPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;
use App\Models\PendaftaranPasien;
use App\Models\PemeriksaanDokter;
use App\Models\Pembayaran;



// Halaman Login
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Proses Login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {


Route::resource('master-pasien', MasterPasienController::class);

Route::resource('master-dokter', MasterDokterController::class);

Route::resource('master-perawat', MasterPerawatController::class);

Route::resource('master-obat', MasterObatController::class);

Route::resource('master-supplier', MasterSupplierController::class);

Route::resource('master-kategori', MasterKategoriController::class);

Route::resource('master-satuan', MasterSatuanController::class);

Route::resource('master-poli', MasterPoliController::class);

Route::resource('master-kamar', MasterKamarController::class);

Route::resource('master-asuransi', MasterAsuransiController::class);

Route::resource('master-tindakan', MasterTindakanController::class);

// =======================
// Role Management
// =======================
Route::resource('roles', RoleController::class);

Route::get('/roles/{id}/permission', [RoleController::class, 'givePermission'])
    ->name('roles.permission');

Route::post('/roles/{id}/permission', [RoleController::class, 'givePermissionStore'])
    ->name('roles.permission.store');

// =======================
// Permission Management
// =======================
Route::resource('permissions', PermissionController::class);

// =======================
// User Management
// =======================
Route::resource('users', UserController::class);

    // Dashboard Utama (Opsional)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //reset Password
    Route::get('/users/{id}/reset-password',
    [UserController::class,'resetPasswordForm'])
    ->name('users.reset-password');

Route::post('/users/{id}/reset-password',
    [UserController::class,'resetPassword'])
    ->name('users.reset-password.update');

    // =======================
    // Dashboard Super Admin
    // =======================
    Route::get('/superadmin/dashboard', [DashboardController::class, 'superadmin'])
    ->name('superadmin.dashboard');
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