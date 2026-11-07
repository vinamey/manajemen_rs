<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title', 'SIM RS')</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body {
            margin: 0;
            background: #f5f6fa;
            font-family: Arial, Helvetica, sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #0d6efd;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
        }

        .sidebar .logo {
            padding: 20px 10px;
            text-align: center;
        }

        .sidebar .logo h3 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar .logo i {
            margin-right: 7px;
        }

        .sidebar hr {
            margin: 0;
            opacity: 0.2;
        }

        .sidebar .nav {
            padding-top: 8px;
            padding-bottom: 20px;
        }

        .sidebar .nav-item {
            width: 100%;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: 0.2s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
        }

        .sidebar .nav-link i {
            width: 18px;
            text-align: center;
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.22);
            color: white;
            font-weight: 600;
            border-left: 3px solid white;
        }

        /* MASTER DATA */
        .master-toggle {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .master-toggle-left {
            display: flex;
            align-items: center;
        }

        .master-toggle-left i {
            margin-right: 8px;
        }

        .master-arrow {
            font-size: 10px !important;
            width: auto !important;
            transition: transform 0.25s ease;
        }

        .master-toggle[aria-expanded="true"] .master-arrow {
            transform: rotate(180deg);
        }

        .master-toggle.master-active {
            background: rgba(255, 255, 255, 0.15);
        }

        .master-menu {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #0b5ed7;
        }

        .master-menu li {
            padding: 0;
            margin: 0;
        }

        .master-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 10px 20px 10px 45px;
            font-size: 13px;
            transition: all 0.2s ease;
        }

        .master-item i {
            width: 18px;
            text-align: center;
            font-size: 13px;
        }

        .master-item:hover {
            background: rgba(255, 255, 255, 0.12);
            color: white;
        }

        .master-item.active {
            background: rgba(255, 255, 255, 0.22);
            color: white;
            font-weight: 600;
            border-left: 3px solid white;
            padding-left: 42px;
        }

        /* CONTENT */
        .content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        /* NAVBAR */
        .navbar {
            min-height: 65px;
            padding: 0 24px;
            background: #ffffff;
            border-bottom: 1px solid #e0e0e0;
        }

        .navbar-brand {
            font-size: 16px;
            color: #222 !important;
            font-weight: 500;
        }

        .navbar .user-name {
            font-size: 14px;
            color: #333;
        }

        .navbar .btn-danger {
            font-size: 12px;
            padding: 6px 10px;
        }

        /* PAGE CONTENT */
        .page-container {
            padding: 24px;
            margin: 0;
        }

        /* SCROLLBAR */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: #0d6efd;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.35);
            border-radius: 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 220px;
            }

            .content {
                margin-left: 220px;
                width: calc(100% - 220px);
            }

            .sidebar .nav-link {
                font-size: 12px;
            }

            .master-item {
                font-size: 12px;
                padding-left: 35px;
            }

            .master-item.active {
                padding-left: 32px;
            }

            .page-container {
                padding: 16px;
            }
        }
    </style>
</head>

<body>

    <div class="d-flex">

        {{-- SIDEBAR --}}
        <div class="sidebar">

            {{-- LOGO --}}
            <div class="logo">
                <h3>
                    <i class="fa-solid fa-hospital"></i>
                    SIM RS
                </h3>
            </div>

            <hr>

            {{-- SIDEBAR ADMIN RUMAH SAKIT --}}
            @if (auth()->user()?->hasRole('admin rumah sakit'))

                <ul class="nav flex-column">

                    {{-- DATA DOKTER --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.dokter.index') }}"
                            class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-doctor me-2"></i>
                            Data Dokter
                        </a>
                    </li>

                    {{-- DATA PERAWAT --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.perawat.index') }}"
                            class="nav-link {{ request()->routeIs('admin.perawat.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-nurse me-2"></i>
                            Data Perawat
                        </a>
                    </li>

                    {{-- DATA PASIEN --}}
                    <li class="nav-item">
                        <a href="{{ route('admin.pasien.index') }}"
                            class="nav-link {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-hospital-user me-2"></i>
                            Data Pasien
                        </a>
                    </li>

                    {{-- DATA APOTEKER --}}
                    <li class="nav-item">
                        <a href="{{ route('apoteker.dashboard') }}"
                            class="nav-link {{ request()->routeIs('apoteker.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
                            Data Apoteker
                        </a>
                    </li>

                    {{-- DATA KASIR --}}
                    <li class="nav-item">
                        <a href="{{ route('kasir.dashboard') }}"
                            class="nav-link {{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-cash-register me-2"></i>
                            Data Kasir
                        </a>
                    </li>

                </ul>

            @else

                {{-- SIDEBAR SUPER ADMIN --}}
                <ul class="nav flex-column">

                    {{-- DASHBOARD --}}
                    <li class="nav-item">
                        <a href="{{ route('superadmin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                            <i class="fa fa-home me-2"></i>
                            Dashboard
                        </a>
                    </li>

                    {{-- ROLE MANAGEMENT --}}
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}"
                            class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-shield me-2"></i>
                            Role Management
                        </a>
                    </li>

                    {{-- PERMISSION MANAGEMENT --}}
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}"
                            class="nav-link {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-key me-2"></i>
                            Permission Management
                        </a>
                    </li>

                    {{-- USER MANAGEMENT --}}
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users me-2"></i>
                            User Management
                        </a>
                    </li>

                    {{-- MASTER DATA --}}
                    @php
                        $masterRoutes = [
                            'master-pasien.*',
                            'master-dokter.*',
                            'master-perawat.*',
                            'master-obat.*',
                            'master-supplier.*',
                            'master-kategori.*',
                            'master-satuan.*',
                            'master-poli.*',
                            'master-kamar.*',
                            'master-asuransi.*',
                            'master-tindakan.*',
                        ];

                        $masterAktif = false;

                        foreach ($masterRoutes as $route) {
                            if (request()->routeIs($route)) {
                                $masterAktif = true;
                                break;
                            }
                        }
                    @endphp

                    <li class="nav-item">

                        <a class="nav-link master-toggle {{ $masterAktif ? 'master-active' : '' }}"
                            data-bs-toggle="collapse"
                            href="#masterDataMenu"
                            role="button"
                            aria-expanded="{{ $masterAktif ? 'true' : 'false' }}"
                            aria-controls="masterDataMenu">

                            <span class="master-toggle-left">
                                <i class="fa-solid fa-database me-2"></i>
                                Master Data
                            </span>

                            <i class="fa-solid fa-chevron-down master-arrow"></i>

                        </a>

                        <div class="collapse {{ $masterAktif ? 'show' : '' }}" id="masterDataMenu">

                            <ul class="master-menu">

                                {{-- MASTER PASIEN --}}
                                <li>
                                    <a href="{{ route('master-pasien.index') }}"
                                        class="master-item {{ request()->routeIs('master-pasien.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-hospital-user"></i>
                                        <span>Master Pasien</span>
                                    </a>
                                </li>

                                {{-- MASTER DOKTER --}}
                                <li>
                                    <a href="{{ route('master-dokter.index') }}"
                                        class="master-item {{ request()->routeIs('master-dokter.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-user-doctor"></i>
                                        <span>Master Dokter</span>
                                    </a>
                                </li>

                                {{-- MASTER PERAWAT --}}
                                <li>
                                    <a href="{{ route('master-perawat.index') }}"
                                        class="master-item {{ request()->routeIs('master-perawat.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-user-nurse"></i>
                                        <span>Master Perawat</span>
                                    </a>
                                </li>

                                {{-- MASTER OBAT --}}
                                <li>
                                    <a href="{{ route('master-obat.index') }}"
                                        class="master-item {{ request()->routeIs('master-obat.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-pills"></i>
                                        <span>Master Obat</span>
                                    </a>
                                </li>

                                {{-- MASTER SUPPLIER --}}
                                <li>
                                    <a href="{{ route('master-supplier.index') }}"
                                        class="master-item {{ request()->routeIs('master-supplier.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-truck"></i>
                                        <span>Master Supplier</span>
                                    </a>
                                </li>

                                {{-- MASTER KATEGORI --}}
                                <li>
                                    <a href="{{ route('master-kategori.index') }}"
                                        class="master-item {{ request()->routeIs('master-kategori.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-tags"></i>
                                        <span>Master Kategori</span>
                                    </a>
                                </li>

                                {{-- MASTER SATUAN OBAT --}}
                                <li>
                                    <a href="{{ route('master-satuan.index') }}"
                                        class="master-item {{ request()->routeIs('master-satuan.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-box"></i>
                                        <span>Master Satuan Obat</span>
                                    </a>
                                </li>

                                {{-- MASTER POLI --}}
                                <li>
                                    <a href="{{ route('master-poli.index') }}"
                                        class="master-item {{ request()->routeIs('master-poli.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-hospital"></i>
                                        <span>Master Poli</span>
                                    </a>
                                </li>

                                {{-- MASTER KAMAR --}}
                                <li>
                                    <a href="{{ route('master-kamar.index') }}"
                                        class="master-item {{ request()->routeIs('master-kamar.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-bed"></i>
                                        <span>Master Kamar</span>
                                    </a>
                                </li>

                                {{-- MASTER ASURANSI --}}
                                <li>
                                    <a href="{{ route('master-asuransi.index') }}"
                                        class="master-item {{ request()->routeIs('master-asuransi.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-shield-heart"></i>
                                        <span>Master Asuransi</span>
                                    </a>
                                </li>

                                {{-- MASTER TINDAKAN --}}
                                <li>
                                    <a href="{{ route('master-tindakan.index') }}"
                                        class="master-item {{ request()->routeIs('master-tindakan.*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-stethoscope"></i>
                                        <span>Master Tindakan</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    {{-- PENDAFTARAN PASIEN --}}
                    <li class="nav-item">
                        <a href="{{ route('pendaftaran.index') }}"
                            class="nav-link {{ request()->routeIs('pendaftaran.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-clipboard-user me-2"></i>
                            Pendaftaran Pasien
                        </a>
                    </li>

                    {{-- PEMERIKSAAN DOKTER --}}
                    <li class="nav-item">
                        <a href="{{ route('pemeriksaan-dokter.index') }}"
                            class="nav-link {{ request()->routeIs('pemeriksaan-dokter.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-stethoscope me-2"></i>
                            Pemeriksaan Dokter
                        </a>
                    </li>

                    {{-- HASIL PEMERIKSAAN --}}
                    <li class="nav-item">
                        <a href="{{ route('hasil-pemeriksaan.index') }}"
                            class="nav-link {{ request()->routeIs('hasil-pemeriksaan.*') ? 'active' : '' }}">
                            <i class="fa-solid fa-file-medical me-2"></i>
                            Hasil Pemeriksaan
                        </a>
                    </li>

                    {{-- LAPORAN --}}
                    <li class="nav-item">
                        <a href="{{ route('superadmin.laporan') }}"
                            class="nav-link {{ request()->routeIs('superadmin.laporan') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-column me-2"></i>
                            Laporan
                        </a>
                    </li>

                </ul>

            @endif

        </div>

        {{-- AREA KONTEN UTAMA --}}
        <div class="content">

            {{-- NAVBAR ATAS --}}
            <nav class="navbar navbar-expand-lg">

                <div class="container-fluid p-0">

                    <span class="navbar-brand">

                        @if (request()->routeIs('superadmin.laporan'))
                            Laporan

                        @elseif (request()->routeIs('roles.*'))
                            Role Management

                        @elseif (request()->routeIs('permissions.*'))
                            Permission Management

                        @elseif (request()->routeIs('users.*'))
                            User Management

                        @elseif (request()->routeIs('master-*'))
                            Master Data

                        @elseif (request()->routeIs('pendaftaran.*'))
                            Pendaftaran Pasien

                        @elseif (request()->routeIs('pemeriksaan-dokter.*'))
                            Pemeriksaan Dokter

                        @elseif (request()->routeIs('hasil-pemeriksaan.*'))
                            Hasil Pemeriksaan

                        @else
                            @yield('navbar-title', 'Dashboard Superadmin')
                        @endif

                    </span>

                    <div class="d-flex align-items-center gap-3">

                        <span class="user-name">
                            <i class="fa-solid fa-circle-user me-1"></i>
                            {{ auth()->user()->name ?? 'User' }}
                        </span>

                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf

                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-right-from-bracket me-1"></i>
                                Logout
                            </button>
                        </form>

                    </div>

                </div>

            </nav>

            {{-- WADAH ISI HALAMAN --}}
            <div class="page-container">

                @php
                    $requiredPermission = null;

                    $permissionRoutes = [

                        // DASHBOARD
                        'superadmin.dashboard' => 'dashboard',
                        'admin.dashboard' => 'dashboard',

                        // MANAGEMENT
                        'roles.*' => 'role management',
                        'permissions.*' => 'permission management',
                        'users.*' => 'user management',

                        // DATA ADMIN RUMAH SAKIT
                        'admin.dokter.*' => 'master dokter',
                        'admin.perawat.*' => 'master perawat',
                        'admin.pasien.*' => 'master pasien',

                        // MASTER DATA
                        'master-pasien.*' => 'master pasien',
                        'master-dokter.*' => 'master dokter',
                        'master-perawat.*' => 'master perawat',
                        'master-obat.*' => 'master obat',
                        'master-supplier.*' => 'master supplier',
                        'master-kategori.*' => 'master kategori',
                        'master-satuan.*' => 'master satuan obat',
                        'master-poli.*' => 'master poli',
                        'master-kamar.*' => 'master kamar',
                        'master-asuransi.*' => 'master asuransi',
                        'master-tindakan.*' => 'master tindakan',
                        'master-apoteker.*' => 'master apoteker',

                        // APOTEKER
                        'apoteker.dashboard' => 'master apoteker',
                        'apoteker.obat.*' => 'master obat',
                        'apoteker.supplier.*' => 'master supplier',
                        'apoteker.resep.*' => 'resep obat',
                        'apoteker.update-stok-obat.*' => 'stok obat',
                        'apoteker.log-stok-obat.*' => 'stok obat',

                        // KASIR
                        'kasir.dashboard' => 'master kasir',
                        'kasir.resep' => 'resep obat',
                        'kasir.pembayaran' => 'pembayaran',
                        'kasir.pembayaran.*' => 'pembayaran',

                        // DATA KASIR
                        'kasir.index' => 'master kasir',
                        'kasir.create' => 'master kasir',
                        'kasir.store' => 'master kasir',
                        'kasir.show' => 'master kasir',
                        'kasir.edit' => 'master kasir',
                        'kasir.update' => 'master kasir',
                        'kasir.destroy' => 'master kasir',

                        // FITUR LAINNYA
                        'pendaftaran.*' => 'pendaftaran pasien',
                        'pemeriksaan-dokter.*' => 'pemeriksaan dokter',
                        'hasil-pemeriksaan.*' => 'hasil pemeriksaan',
                        'log-stok-obat.*' => 'stok obat',
                        'superadmin.laporan' => 'laporan',
                    ];

                    foreach ($permissionRoutes as $routePattern => $permission) {
                        if (request()->routeIs($routePattern)) {
                            $requiredPermission = $permission;
                            break;
                        }
                    }
                @endphp

                            {{-- PENGECEKAN PERMISSION --}}
                @if (
                    request()->routeIs('roles.*', 'permissions.*') ||
                    (
                        $requiredPermission !== null &&
                        auth()->user()?->hasPermissionTo($requiredPermission)
                    )
                )

                    @yield('content')

                @endif

            </div>

        </div>

    </div>

    {{-- JS BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

