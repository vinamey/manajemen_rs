<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Super Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>

<body style="background:#f5f6fa;">

<div class="d-flex">

    <!-- Sidebar -->

    <div style="width:260px;height:100vh;background:#0d6efd;color:white;position:fixed;">

        <h3 class="text-center mt-4">

            <i class="fa-solid fa-hospital"></i>

            SIM RS

        </h3>

        <hr class="bg-white">

        <ul class="nav flex-column">

            <li class="nav-item">

                <a href="{{ route('superadmin.dashboard') }}"
                class="nav-link text-white">

                    <i class="fa fa-home"></i>

                    Dashboard

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('roles.index') }}"
                class="nav-link text-white">

                    <i class="fa-solid fa-user-shield"></i>

                    Role Management

                </a>

            </li>

            <li class="nav-item">
    <a href="{{ route('permissions.index') }}" class="nav-link text-white">
        <i class="fa-solid fa-key"></i>
        Permission Management
    </a>
</li>
            <li class="nav-item">

                <a href="#"
                class="nav-link text-white">

                    <i class="fa-solid fa-users"></i>

                    User Management

                </a>

            </li>

            <li class="nav-item">

                <li class="nav-item dropdown">

    <a class="nav-link dropdown-toggle text-white"
       href="#"
       data-bs-toggle="dropdown">

        <i class="fa-solid fa-database"></i>
        Master Data

    </a>

    <ul class="dropdown-menu">

        <li>
            <a class="dropdown-item"
               href="{{ route('master-pasien.index') }}">
                Master Pasien
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-dokter.index') }}">
                Master Dokter
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-perawat.index') }}">
                Master Perawat
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-obat.index') }}">
                Master Obat
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-supplier.index') }}">
                Master Supplier
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-kategori.index') }}">
                Master Kategori
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-satuan.index') }}">
                Master Satuan
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-poli.index') }}">
                Master Poli
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-kamar.index') }}">
                Master Kamar
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-asuransi.index') }}">
                Master Asuransi
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('master-tindakan.index') }}">
                Master Tindakan
            </a>
        </li>

    </ul>

</li>
            </li>

            <li class="nav-item">

                <a href="#"
                class="nav-link text-white">

                    <i class="fa-solid fa-chart-column"></i>

                    Laporan

                </a>

            </li>

        </ul>

    </div>

    <!-- Content -->

    <div style="margin-left:260px;width:100%;">

        <!-- Navbar -->

        <nav class="navbar navbar-light bg-white shadow-sm">

            <div class="container-fluid">

                <span class="navbar-brand">

                    Dashboard Super Admin

                </span>

                <div>

                    {{ Auth::user()->name }}

                    <form action="{{ route('logout') }}"
                    method="POST"
                    style="display:inline">

                        @csrf

                        <button class="btn btn-danger btn-sm">

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </nav>

        <div class="container mt-4">

            @yield('content')

        </div>

    </div>

</div>

</body>

</html>