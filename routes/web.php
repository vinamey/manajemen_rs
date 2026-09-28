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
use App\Http\Controllers\PendaftaranPasienController;
use App\Http\Controllers\PemeriksaanDokterController;
use App\Http\Controllers\LogStokObatController;



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

Route::get(
    '/users/{id}/reset-password',
    [UserController::class, 'resetPasswordForm']
)->name('users.reset-password');

Route::post(
    '/users/{id}/reset-password',
    [UserController::class, 'resetPassword']
)->name('users.reset-password.update');

Route::resource('users', UserController::class);

// ==================================================
// MASTER DATA
// ==================================================

// Master Asuransi
Route::resource(
    'master-asuransi',
    MasterAsuransiController::class
);

// Master Dokter - DataTables
Route::get(
    '/master-dokter/data',
    [MasterDokterController::class, 'data']
)->name('master-dokter.data');

// Master Dokter - CRUD
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


// Kurangi Stok Obat
Route::post(
    '/master-obat/{id}/kurangi-stok',
    [MasterObatController::class, 'kurangiStok']
)->name('master-obat.kurangi-stok');

// Master Pasien - DataTables
Route::get(
    '/master-pasien/data',
    [MasterPasienController::class, 'data']
)->name('master-pasien.data');

// Master Pasien - CRUD
Route::resource(
    'master-pasien',
    MasterPasienController::class
);
// Master Perawat - DataTables
Route::get(
    '/master-perawat/data',
    [MasterPerawatController::class, 'data']
)->name('master-perawat.data');

// Master Perawat - CRUD
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


Route::resource(
    'master-supplier',
    MasterSupplierController::class
);


Route::resource(
    'master-tindakan',
    MasterTindakanController::class
);

Route::resource(
    'pendaftaran',
    PendaftaranPasienController::class
);

Route::get('/master-dokter/data', [MasterDokterController::class, 'data'])
    ->name('master-dokter.data');

Route::resource('master-dokter', MasterDokterController::class);

Route::resource('pemeriksaan-dokter', PemeriksaanDokterController::class);

Route::middleware(['role:super admin|admin rumah sakit|apoteker'])->group(function () {
        // Sesuaikan ->name() dengan yang dipanggil di sidebar: 'log-stok-obat.index'
        Route::get('/log-stok-obat', [LogStokObatController::class, 'index'])->name('log-stok-obat.index');

        Route::resource('master-obat', MasterObatController::class);
        Route::post('/master-obat/{id}/kurangi-stok', [MasterObatController::class, 'kurangiStok'])->name('master-obat.kurangi-stok');
    });
