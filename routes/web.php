<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==============================
// CONTROLLERS
// ==============================

// Auth
use App\Http\Controllers\LoginController;

// Dashboard
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;

// Management
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

// Master Data
use App\Http\Controllers\MasterAsuransiController;
use App\Http\Controllers\MasterDokterController;
use App\Http\Controllers\MasterKamarController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\MasterObatController;
use App\Http\Controllers\MasterPasienController;
use App\Http\Controllers\MasterPerawatController;
use App\Http\Controllers\MasterPoliController;
use App\Http\Controllers\MasterSatuanController;
use App\Http\Controllers\MasterSupplierController;
use App\Http\Controllers\MasterTindakanController;

// ==============================
// LANDING PAGE
// ==============================

Route::get('/', function () {
    return view('landing');
})->name('landing');


// ==============================
// LOGIN
// ==============================

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.post');


// ==============================
// SUPER ADMIN DASHBOARD
// ==============================

Route::get(
    '/superadmin/dashboard',
    [SuperAdminDashboardController::class, 'index']
)->name('superadmin.dashboard');


// ==============================
// DASHBOARD UMUM
// ==============================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// ==============================
// LOGOUT
// ==============================

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('landing');

})->name('logout');


// ==================================================
// ROLE MANAGEMENT
// ==================================================

Route::resource('roles', RoleController::class);


// ==============================
// ROLE - PERMISSION
// ==============================

Route::get(
    '/roles/{id}/permission',
    [RoleController::class, 'givePermission']
)->name('roles.permission');

Route::post(
    '/roles/{id}/permission',
    [RoleController::class, 'givePermissionStore']
)->name('roles.permission.store');


// ==================================================
// PERMISSION MANAGEMENT
// ==================================================

Route::resource('permissions', PermissionController::class);


// ==================================================
// USER MANAGEMENT
// ==================================================

Route::resource('users', UserController::class);


// ==================================================
// MASTER DATA
// ==================================================

// Master Asuransi
Route::resource(
    'master-asuransi',
    MasterAsuransiController::class
);

// Master Dokter
Route::resource(
    'master-dokter',
    MasterDokterController::class
);

// Master Kamar
Route::resource(
    'master-kamar',
    MasterKamarController::class
);

// Master Kategori
Route::resource(
    'master-kategori',
    MasterKategoriController::class
);

// Master Obat
Route::resource(
    'master-obat',
    MasterObatController::class
);

// Master Pasien
Route::resource(
    'master-pasien',
    MasterPasienController::class
);

// Master Perawat
Route::resource(
    'master-perawat',
    MasterPerawatController::class
);

// Master Poli
Route::resource(
    'master-poli',
    MasterPoliController::class
);

// Master Satuan
Route::resource(
    'master-satuan',
    MasterSatuanController::class
);

// Master Supplier
Route::resource(
    'master-supplier',
    MasterSupplierController::class
);

// Master Tindakan
Route::resource(
    'master-tindakan',
    MasterTindakanController::class
);