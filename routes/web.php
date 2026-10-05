<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\ResepObat;

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
use App\Http\Controllers\ApotekerDashboardController;
use App\Http\Controllers\ApotekerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KasirResepController;


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
)
->middleware([
    'auth',
    'role:super admin'
])
->name('superadmin.dashboard');


// ==================================================
// DASHBOARD UMUM
// KHUSUS DIREKTUR
// ==================================================

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)
->middleware([
    'auth',
    'role:direktur'
])
->name('dashboard');


// ==================================================
// ADMIN DASHBOARD
// ==================================================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})
->middleware([
    'auth',
    'admin.rs'
])
->name('admin.dashboard');


// ==================================================
// APOTEKER DASHBOARD
// APOTEKER + ADMIN RUMAH SAKIT
// ==================================================

Route::get(
    '/apoteker/dashboard',
    [ApotekerDashboardController::class, 'index']
)
->middleware([
    'auth',
    'role:apoteker|Apoteker|admin rumah sakit'
])
->name('apoteker.dashboard');
// ==================================================
// KASIR DASHBOARD
// ==================================================

Route::get('/kasir/dashboard', function () {

    $jumlahResepMenunggu = ResepObat::count();

    return view('kasir.dashboard', compact(
        'jumlahResepMenunggu'
    ));

})
->middleware([
    'auth',
    'role:kasir|admin rumah sakit'
])
->name('kasir.dashboard');

// ==================================================
// KASIR - RESEP DARI DOKTER
// ==================================================

Route::get(
    '/kasir/resep',
    [KasirResepController::class, 'index']
)
->middleware([
    'auth',
    'role:kasir|apoteker|admin rumah sakit'
])
->name('kasir.resep');

// ==================================================
// KASIR - PEMBAYARAN OBAT
// ==================================================

Route::get(
    '/kasir/pembayaran',
    [PembayaranController::class, 'index']
)
->middleware([
    'auth',
    'role:kasir'
])
->name('kasir.pembayaran');


// ==================================================
// DIREKTUR - LAPORAN
// ==================================================

Route::middleware([
    'auth',
    'role:direktur'
])->group(function () {

    Route::get(
        '/direktur/laporan',
        [LaporanController::class, 'index']
    )->name('direktur.laporan');

    Route::get(
        '/laporan/export/excel/{type}',
        [LaporanController::class, 'exportExcel']
    )->name('laporan.export.excel');

    Route::get(
        '/laporan/export/pdf/{type}',
        [LaporanController::class, 'exportPdf']
    )->name('laporan.export.pdf');

});

Route::get('/superadmin/laporan', function () {
    return view('superadmin.dashboard', [
        'halaman' => 'laporan'
    ]);
})->name('superadmin.laporan');


// ==================================================
// ROLE MANAGEMENT
// KHUSUS SUPER ADMIN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin'
])->group(function () {

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

});


// ==================================================
// PERMISSION MANAGEMENT
// KHUSUS SUPER ADMIN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin'
])->group(function () {

    Route::resource(
        'permissions',
        PermissionController::class
    );

});


// ==================================================
// USER MANAGEMENT
// KHUSUS SUPER ADMIN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin'
])->group(function () {

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

});


// ==================================================
// MASTER ASURANSI
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get(
        '/master-asuransi/data',
        [MasterAsuransiController::class, 'data']
    )->name('master-asuransi.data');

    Route::resource(
        'master-asuransi',
        MasterAsuransiController::class
    );

});


// ==================================================
// MASTER DOKTER
// DOKTER + SUPER ADMIN + ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|dokter'
])->group(function () {

    Route::get(
        '/master-dokter/data',
        [MasterDokterController::class, 'data']
    )->name('master-dokter.data');

    Route::resource(
        'master-dokter',
        MasterDokterController::class
    );

});


// ==================================================
// MASTER KAMAR
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get(
        '/master-kamar/data',
        [MasterKamarController::class, 'data']
    )->name('master-kamar.data');

    Route::resource(
        'master-kamar',
        MasterKamarController::class
    );

});


// ==================================================
// MASTER KATEGORI
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get(
        '/master-kategori/data',
        [MasterKategoriController::class, 'data']
    )->name('master-kategori.data');

    Route::resource(
        'master-kategori',
        MasterKategoriController::class
    );

});


// ==================================================
// MASTER PASIEN
// DOKTER HANYA BISA MELIHAT
// PERAWAT JUGA BISA MELIHAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|dokter|perawat'
])->group(function () {

    // DataTables
    Route::get(
        '/master-pasien/data',
        [MasterPasienController::class, 'data']
    )->name('master-pasien.data');

    // Hanya melihat daftar
    Route::get(
        '/master-pasien',
        [MasterPasienController::class, 'index']
    )->name('master-pasien.index');

    // Detail pasien
    Route::get(
        '/master-pasien/{master_pasien}',
        [MasterPasienController::class, 'show']
    )->name('master-pasien.show');

});


// ==================================================
// MASTER PASIEN
// CRUD HANYA UNTUK SUPER ADMIN & ADMIN RUMAH SAKIT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    // Tambah pasien
    Route::post(
        '/master-pasien',
        [MasterPasienController::class, 'store']
    )->name('master-pasien.store');

    // Edit pasien
    Route::put(
        '/master-pasien/{master_pasien}',
        [MasterPasienController::class, 'update']
    )->name('master-pasien.update');

    // Hapus pasien
    Route::delete(
        '/master-pasien/{master_pasien}',
        [MasterPasienController::class, 'destroy']
    )->name('master-pasien.destroy');

});

// ==================================================
// MASTER PERAWAT
// SUPER ADMIN / ADMIN RS
// ==================================================

// ==================================================
// MASTER PERAWAT
// SUPER ADMIN / ADMIN RS / PERAWAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|perawat'
])->group(function () {

    Route::get(
        '/master-perawat/data',
        [MasterPerawatController::class, 'data']
    )->name('master-perawat.data');

    Route::resource(
        'master-perawat',
        MasterPerawatController::class
    );

});


// ==================================================
// MASTER POLI
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get(
        '/master-poli/data',
        [MasterPoliController::class, 'data']
    )->name('master-poli.data');

    Route::resource(
        'master-poli',
        MasterPoliController::class
    );

});


// ==================================================
// MASTER SATUAN OBAT
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get(
        '/master-satuan/data',
        [MasterSatuanController::class, 'data']
    )->name('master-satuan.data');

    Route::resource(
        'master-satuan',
        MasterSatuanController::class
    );

});


// ==================================================
// MASTER SUPPLIER
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->group(function () {

    Route::get(
        '/master-supplier/data',
        [MasterSupplierController::class, 'data']
    )->name('master-supplier.data');

    Route::resource(
        'master-supplier',
        MasterSupplierController::class
    );

});


// ==================================================
// MASTER TINDAKAN
// SUPER ADMIN / ADMIN RS
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get(
        '/master-tindakan/data',
        [MasterTindakanController::class, 'data']
    )->name('master-tindakan.data');

    Route::resource(
        'master-tindakan',
        MasterTindakanController::class
    );

});


// ==================================================
// PENDAFTARAN PASIEN
// SUPER ADMIN / ADMIN RS / PERAWAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|perawat'
])->group(function () {

    Route::resource(
        'pendaftaran',
        PendaftaranPasienController::class
    );

});


// ==================================================
// PEMERIKSAAN DOKTER / RESEP DOKTER
// SUPER ADMIN / ADMIN RS / DOKTER / APOTEKER
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|dokter|apoteker'
])->group(function () {

    Route::resource(
        'pemeriksaan-dokter',
        PemeriksaanDokterController::class
    );

});


// ==================================================
// MASTER OBAT & LOG STOK OBAT
// SUPER ADMIN / ADMIN RS / APOTEKER
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->group(function () {

    // ==================================================
    // MASTER OBAT - DATA
    // ==================================================

    // WAJIB sebelum Route::resource
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

// ==================================================
// MASTER APOTEKER
// SUPER ADMIN / ADMIN RUMAH SAKIT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::resource(
        'master-apoteker',
        ApotekerController::class
    );

});


// ==================================================
// MASTER KASIR
// SUPER ADMIN / ADMIN RUMAH SAKIT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::resource(
        'kasir',
        KasirController::class
    );

});


