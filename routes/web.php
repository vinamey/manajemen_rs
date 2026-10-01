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
use App\Http\Controllers\LaporanController;


// ==================================================
// LANDING PAGE
// ==================================================

Route::get('/', function () {
    return view('landing');
})->name('landing');


// ==================================================
// LOGIN
// ==================================================

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post(
    '/login',
    [LoginController::class, 'login']
)->name('login.post');


// ==================================================
// LOGOUT
// ==================================================

Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('landing');

})->name('logout');


// ==================================================
// SUPER ADMIN DASHBOARD
// ==================================================

Route::get(
    '/superadmin/dashboard',
    [SuperAdminDashboardController::class, 'index']
)->name('superadmin.dashboard');



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
Route::get('/direktur/laporan', [LaporanController::class, 'index'])->name('direktur.laporan');
Route::get('/laporan/export/excel/{type}', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
Route::get('/laporan/export/pdf/{type}', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
});

// ==================================================
// ROLE MANAGEMENT
// ==================================================

Route::resource(
    'roles',
    RoleController::class
);


// ==================================================
// ROLE - PERMISSION
// ==================================================

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

Route::resource(
    'permissions',
    PermissionController::class
);


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

Route::resource(
    'users',
    UserController::class
);


// ==================================================
// MASTER ASURANSI
// ==================================================

// WAJIB di atas Route::resource
Route::get(
    '/master-asuransi/data',
    [MasterAsuransiController::class, 'data']
)->name('master-asuransi.data');

Route::resource(
    'master-asuransi',
    MasterAsuransiController::class
);


// ==================================================
// MASTER DOKTER
// ==================================================

// DataTables
Route::get(
    '/master-dokter/data',
    [MasterDokterController::class, 'data']
)->name('master-dokter.data');

// CRUD
Route::resource(
    'master-dokter',
    MasterDokterController::class
);


// ==================================================
// MASTER KAMAR
// ==================================================

// DataTables - WAJIB di atas Route::resource
Route::get(
    '/master-kamar/data',
    [MasterKamarController::class, 'data']
)->name('master-kamar.data');

// CRUD
Route::resource(
    'master-kamar',
    MasterKamarController::class
);
// ==================================================
// MASTER KATEGORI
// ==================================================

Route::get(
    '/master-kategori/data',
    [MasterKategoriController::class, 'data']
)->name('master-kategori.data');

// CRUD
Route::resource(
    'master-kategori',
    MasterKategoriController::class
);

// ==================================================
// MASTER KATEGORI
// ==================================================

Route::resource(
    'master-kategori',
    MasterKategoriController::class
);


// ==================================================
// MASTER PASIEN
// ==================================================

// DataTables
Route::get(
    '/master-pasien/data',
    [MasterPasienController::class, 'data']
)->name('master-pasien.data');

// CRUD
Route::resource(
    'master-pasien',
    MasterPasienController::class
);


// ==================================================
// MASTER PERAWAT
// ==================================================

// DataTables
Route::get(
    '/master-perawat/data',
    [MasterPerawatController::class, 'data']
)->name('master-perawat.data');

// CRUD
Route::resource(
    'master-perawat',
    MasterPerawatController::class
);


// ==================================================
// MASTER POLI
// ==================================================

// Yajra DataTables
// WAJIB di atas Route::resource
Route::get(
    '/master-poli/data',
    [MasterPoliController::class, 'data']
)->name('master-poli.data');


// CRUD MASTER POLI
Route::resource(
    'master-poli',
    MasterPoliController::class
);


// ==================================================
// MASTER SATUAN OBAT
// ==================================================

// DataTables
// WAJIB di atas Route::resource
Route::get(
    '/master-satuan/data',
    [MasterSatuanController::class, 'data']
)->name('master-satuan.data');

// CRUD
Route::resource(
    'master-satuan',
    MasterSatuanController::class
);

// ==================================================
// MASTER SUPPLIER
// ==================================================

// DataTables
// WAJIB di atas Route::resource supaya "data"
// tidak dianggap sebagai ID supplier.
Route::get(
    '/master-supplier/data',
    [MasterSupplierController::class, 'data']
)->name('master-supplier.data');

// CRUD
Route::resource(
    'master-supplier',
    MasterSupplierController::class
);
// ==================================================
// MASTER TINDAKAN
// ==================================================

// WAJIB di atas Route::resource
Route::get(
    '/master-tindakan/data',
    [MasterTindakanController::class, 'data']
)->name('master-tindakan.data');

Route::resource(
    'master-tindakan',
    MasterTindakanController::class
);


// ==================================================
// PENDAFTARAN PASIEN
// ==================================================

Route::resource(
    'pendaftaran',
    PendaftaranPasienController::class
);


// ==================================================
// PEMERIKSAAN DOKTER
// ==================================================

Route::resource(
    'pemeriksaan-dokter',
    PemeriksaanDokterController::class
);


// ==================================================
// MASTER OBAT & LOG STOK OBAT
// SUPER ADMIN / ADMIN RS / APOTEKER
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->group(function () {

    // ==================================================
    // MASTER OBAT - YAJRA DATATABLES
    // ==================================================
    //
    // WAJIB berada SEBELUM Route::resource master-obat
    // supaya "data" tidak dianggap sebagai ID obat.
    //

    Route::get(
        '/master-obat/data',
        [MasterObatController::class, 'data']
    )->name('master-obat.data');


    // ==================================================
    // MASTER OBAT - CRUD
    // ==================================================

    Route::resource(
        'master-obat',
        MasterObatController::class
    );


    // ==================================================
    // KURANGI STOK OBAT
    // ==================================================

    Route::post(
        '/master-obat/{id}/kurangi-stok',
        [MasterObatController::class, 'kurangiStok']
    )->name('master-obat.kurangi-stok');


    // ==================================================
    // LOG STOK OBAT
    // ==================================================

    Route::get(
        '/log-stok-obat',
        [LogStokObatController::class, 'index']
    )->name('log-stok-obat.index');

});
