
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\ResepObat;

// ==============================
// CONTROLLERS
// ==============================

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;

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
use App\Http\Controllers\HasilPemeriksaanController;


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

Route::post('/login', [
    LoginController::class,
    'login'
])->name('login.post');


// ==================================================
// LOGOUT
// ==================================================

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('landing');
})->middleware('auth')->name('logout');


// ==================================================
// SUPER ADMIN DASHBOARD
// ==================================================

Route::get('/superadmin/dashboard', [
    SuperAdminDashboardController::class,
    'index'
])->middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->name('superadmin.dashboard');


// ==================================================
// DASHBOARD DIREKTUR
// ==================================================

Route::get('/dashboard', [
    DashboardController::class,
    'index'
])->middleware([
    'auth',
    'role:direktur'
])->name('dashboard');


// ==================================================
// ADMIN DASHBOARD
// ==================================================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware([
    'auth',
    'admin.rs'
])->name('admin.dashboard');


// ==================================================
// FITUR ADMIN RUMAH SAKIT
// ==================================================

Route::middleware(['auth', 'admin.rs'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // DATA PASIEN
        Route::get('/data-pasien/data', [
            MasterPasienController::class,
            'dataAdmin'
        ])->name('pasien.data');

        Route::get('/data-pasien', [
            MasterPasienController::class,
            'indexAdmin'
        ])->name('pasien.index');

        Route::get('/data-pasien/{id}', [
            MasterPasienController::class,
            'showAdmin'
        ])->whereNumber('id')->name('pasien.show');


        // DATA PERAWAT
        Route::get('/data-perawat', [
            MasterPerawatController::class,
            'indexAdmin'
        ])->name('perawat.index');

        Route::get('/data-perawat/data', [
            MasterPerawatController::class,
            'dataAdmin'
        ])->name('perawat.data');

        Route::post('/data-perawat', [
            MasterPerawatController::class,
            'storeAdmin'
        ])->name('perawat.store');

        Route::put('/data-perawat/{id}', [
            MasterPerawatController::class,
            'updateAdmin'
        ])->whereNumber('id')->name('perawat.update');

        Route::delete('/data-perawat/{id}', [
            MasterPerawatController::class,
            'destroyAdmin'
        ])->whereNumber('id')->name('perawat.destroy');


        // DATA DOKTER
        Route::get('/data-dokter', [
            MasterDokterController::class,
            'indexAdmin'
        ])->name('dokter.index');

        Route::get('/data-dokter/data', [
            MasterDokterController::class,
            'dataAdmin'
        ])->name('dokter.data');

        Route::post('/data-dokter', [
            MasterDokterController::class,
            'storeAdmin'
        ])->name('dokter.store');

        Route::put('/data-dokter/{id}', [
            MasterDokterController::class,
            'updateAdmin'
        ])->whereNumber('id')->name('dokter.update');

        Route::delete('/data-dokter/{id}', [
            MasterDokterController::class,
            'destroyAdmin'
        ])->whereNumber('id')->name('dokter.destroy');
    });


// ==================================================
// DASHBOARD DOKTER
// ==================================================

Route::get('/dokter/dashboard', function () {
    return view('dokter.dashboard');
})->middleware([
    'auth',
    'role:dokter'
])->name('dokter.dashboard');


// ==================================================
// FITUR KHUSUS DOKTER
// ==================================================

Route::middleware(['auth', 'role:dokter'])
    ->prefix('dokter')
    ->name('dokter.')
    ->group(function () {

        Route::get('/data-pasien', [
            MasterPasienController::class,
            'indexDokter'
        ])->name('pasien.index');

        Route::get('/data-pasien/data', [
            MasterPasienController::class,
            'data'
        ])->name('pasien.data');

        Route::get('/resep-obat', [
            PemeriksaanDokterController::class,
            'resepDokter'
        ])->name('resep.index');

        Route::post('/pemeriksaan', [
            PemeriksaanDokterController::class,
            'store'
        ])->name('pemeriksaan.store');

        Route::get('/pemeriksaan', function () {
            return redirect()->route('dokter.resep.index');
        })->name('pemeriksaan.index');
    });


// ==================================================
// DASHBOARD PERAWAT
// ==================================================

Route::get('/perawat/dashboard', function () {
    return view('perawat.dashboard');
})->middleware([
    'auth',
    'role:perawat'
])->name('perawat.dashboard');


// ==================================================
// FITUR KHUSUS PERAWAT
// ==================================================

Route::middleware(['auth', 'role:perawat'])
    ->prefix('perawat')
    ->name('perawat.')
    ->group(function () {

        Route::get('/data-pasien', [
            MasterPasienController::class,
            'indexPerawat'
        ])->name('pasien.index');

        Route::get('/data-pasien/data', [
            MasterPasienController::class,
            'dataPerawat'
        ])->name('pasien.data');

        Route::get('/data-pasien/{master_pasien}', [
            MasterPasienController::class,
            'showPerawat'
        ])->whereNumber('master_pasien')
          ->name('pasien.show');
    });


// ==================================================
// DASHBOARD APOTEKER
// ==================================================

Route::get('/apoteker/dashboard', [
    ApotekerDashboardController::class,
    'index'
])->middleware([
    'auth',
    'role:apoteker|Apoteker|admin rumah sakit'
])->name('apoteker.dashboard');


// ==========================================
// DATA OBAT KHUSUS APOTEKER
// ==========================================
Route::middleware(['auth', 'role:apoteker'])
    ->prefix('apoteker')
    ->name('apoteker.')
    ->group(function () {

        Route::get('/data-obat', [
            MasterObatController::class,
            'indexApoteker'
        ])->name('obat.index');

        Route::get('/data-obat/data', [
            MasterObatController::class,
            'data'
        ])->name('obat.data');
    });

// ==================================================
// UPDATE STOK OBAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->prefix('apoteker')->name('apoteker.')->group(function () {

    // Menampilkan halaman update stok
    Route::get('/update-stok-obat', [
        LogStokObatController::class,
        'updateStok'
    ])->name('update-stok-obat.index');

// Pastikan route ini ada di dalam file routes/web.php
Route::get('/apoteker/update-stok-obat',
 [LogStokObatController::class, 'updateStokobat'])
 ->name('log-stok-obat.update-stok-obat');

    // Menyimpan penambahan stok
    Route::post('/update-stok-obat', [
        LogStokObatController::class,
        'store'
    ])->name('update-stok-obat.store');
});


// ==================================================
// DASHBOARD KASIR
// ==================================================

Route::get('/kasir/dashboard', function () {
    $jumlahResepMenunggu = ResepObat::count();

    return view('kasir.dashboard', compact('jumlahResepMenunggu'));
})->middleware([
    'auth',
    'role:kasir|admin rumah sakit'
])->name('kasir.dashboard');


// ==================================================
// KASIR - RESEP DARI DOKTER
// ==================================================

Route::get('/kasir/resep', [
    KasirResepController::class,
    'index'
])->middleware([
    'auth',
    'role:kasir|apoteker|admin rumah sakit'
])->name('kasir.resep');


// ==================================================
// KASIR - PEMBAYARAN OBAT
// ==================================================

Route::middleware(['auth', 'role:kasir'])->group(function () {

    Route::get('/kasir/pembayaran', [
        PembayaranController::class,
        'index'
    ])->name('kasir.pembayaran');

    Route::post('/kasir/pembayaran/{id}/proses', [
        PembayaranController::class,
        'proses'
    ])->name('kasir.pembayaran.proses');

    Route::delete('/kasir/pembayaran/{id}/hapus', [
        PembayaranController::class,
        'destroy'
    ])->name('kasir.pembayaran.hapus');
});


// ==================================================
// DIREKTUR - LAPORAN
// ==================================================

Route::middleware(['auth', 'role:direktur'])->group(function () {

    Route::get('/direktur/laporan', [
        LaporanController::class,
        'index'
    ])->name('direktur.laporan');

    Route::get('/laporan/export/excel/{type}', [
        LaporanController::class,
        'exportExcel'
    ])->name('laporan.export.excel');

    Route::get('/laporan/export/pdf/{type}', [
        LaporanController::class,
        'exportPdf'
    ])->name('laporan.export.pdf');
});


// ==================================================
// LAPORAN SUPER ADMIN
// ==================================================

Route::get('/superadmin/laporan', function () {
    return view('superadmin.dashboard', [
        'halaman' => 'laporan'
    ]);
})->middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->name('superadmin.laporan');


// ==================================================
// ROLE MANAGEMENT
// ==================================================

Route::middleware(['auth', 'role:super admin'])->group(function () {

    Route::resource('roles', RoleController::class);

    Route::get('/roles/{id}/permission', [
        RoleController::class,
        'givePermission'
    ])->name('roles.permission');

    Route::post('/roles/{id}/permission', [
        RoleController::class,
        'givePermissionStore'
    ])->name('roles.permission.store');
});


// ==================================================
// PERMISSION MANAGEMENT
// ==================================================

Route::middleware(['auth', 'role:super admin'])->group(function () {
    Route::resource('permissions', PermissionController::class);
});


// ==================================================
// USER MANAGEMENT
// ==================================================

Route::middleware(['auth', 'role:super admin'])->group(function () {

    Route::get('/users/{id}/reset-password', [
        UserController::class,
        'resetPasswordForm'
    ])->name('users.reset-password');

    Route::post('/users/{id}/reset-password', [
        UserController::class,
        'resetPassword'
    ])->name('users.reset-password.update');

    Route::resource('users', UserController::class);
});


// ==================================================
// MASTER ASURANSI
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-asuransi/data', [
        MasterAsuransiController::class,
        'data'
    ])->name('master-asuransi.data');

    Route::resource('master-asuransi', MasterAsuransiController::class);
});


// ==================================================
// MASTER DOKTER
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-dokter/data', [
        MasterDokterController::class,
        'data'
    ])->name('master-dokter.data');

    Route::resource('master-dokter', MasterDokterController::class);
});


// ==================================================
// MASTER KAMAR
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-kamar/data', [
        MasterKamarController::class,
        'data'
    ])->name('master-kamar.data');

    Route::resource('master-kamar', MasterKamarController::class);
});


// ==================================================
// MASTER KATEGORI
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-kategori/data', [
        MasterKategoriController::class,
        'data'
    ])->name('master-kategori.data');

    Route::resource('master-kategori', MasterKategoriController::class);
});


// ==================================================
// MASTER PASIEN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-pasien/data', [
        MasterPasienController::class,
        'data'
    ])->name('master-pasien.data');

    Route::get('/master-pasien', [
        MasterPasienController::class,
        'index'
    ])->name('master-pasien.index');

    Route::get('/master-pasien/{master_pasien}', [
        MasterPasienController::class,
        'show'
    ])->name('master-pasien.show');

    Route::post('/master-pasien', [
        MasterPasienController::class,
        'store'
    ])->name('master-pasien.store');

    Route::put('/master-pasien/{master_pasien}', [
        MasterPasienController::class,
        'update'
    ])->name('master-pasien.update');

    Route::delete('/master-pasien/{master_pasien}', [
        MasterPasienController::class,
        'destroy'
    ])->name('master-pasien.destroy');
});


// ==================================================
// MASTER PERAWAT
// ==================================================

Route::middleware(['auth', 'role:super admin'])->group(function () {

    Route::get('/master-perawat/data', [
        MasterPerawatController::class,
        'data'
    ])->name('master-perawat.data');

    Route::resource('master-perawat', MasterPerawatController::class);
});


// ==================================================
// MASTER POLI
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-poli/data', [
        MasterPoliController::class,
        'data'
    ])->name('master-poli.data');

    Route::resource('master-poli', MasterPoliController::class);
});


// ==================================================
// MASTER SATUAN OBAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-satuan/data', [
        MasterSatuanController::class,
        'data'
    ])->name('master-satuan.data');

    Route::resource('master-satuan', MasterSatuanController::class);
});


// ==================================================
// MASTER SUPPLIER
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->group(function () {

    Route::get('/master-supplier/data', [
        MasterSupplierController::class,
        'data'
    ])->name('master-supplier.data');

    Route::resource('master-supplier', MasterSupplierController::class);
});


// ==================================================
// MASTER TINDAKAN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {

    Route::get('/master-tindakan/data', [
        MasterTindakanController::class,
        'data'
    ])->name('master-tindakan.data');

    Route::resource('master-tindakan', MasterTindakanController::class);
});


// ==================================================
// PENDAFTARAN PASIEN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {
    Route::resource('pendaftaran', PendaftaranPasienController::class);
});


// ==================================================
// PEMERIKSAAN DOKTER / RESEP DOKTER
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
// MASTER OBAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->group(function () {

    Route::get('/master-obat/data', [
        MasterObatController::class,
        'data'
    ])->name('master-obat.data');

    Route::resource('master-obat', MasterObatController::class);

    Route::post('/master-obat/{id}/kurangi-stok', [
        MasterObatController::class,
        'kurangiStok'
    ])->name('master-obat.kurangi-stok');
});



// ==================================================
// LOG STOK OBAT
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit|apoteker'
])->group(function () {

    Route::get('/log-stok-obat', [
        LogStokObatController::class,
        'index'
    ])->name('log-stok-obat.index');

    Route::post('/log-stok-obat', [
        LogStokObatController::class,
        'store'
    ])->name('log-stok-obat.store');
});


// ==================================================
// MASTER APOTEKER
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {
    Route::resource('master-apoteker', ApotekerController::class);
});


// ==================================================
// MASTER KASIR
// ==================================================

Route::middleware([
    'auth',
    'role:super admin|admin rumah sakit'
])->group(function () {
    Route::resource('kasir', KasirController::class);
});


// ==================================================
// HASIL PEMERIKSAAN
// ==================================================

Route::middleware([
    'auth',
    'role:super admin'
])->group(function () {
    Route::resource('hasil-pemeriksaan', HasilPemeriksaanController::class);
});