<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard Super Admin</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>

        body {
            background: #f5f6fa;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #0d6efd;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }

        .sidebar .logo {
            padding: 20px 10px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .sidebar .dropdown-menu {
            background: #0b5ed7;
            border: none;
            width: 100%;
        }

        .sidebar .dropdown-item {
            color: white;
            padding: 10px 35px;
        }

        .sidebar .dropdown-item:hover {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .navbar {
            min-height: 65px;
        }

    </style>

</head>

<body>

<div class="d-flex">

    <!-- ========================= -->
    <!-- SIDEBAR -->
    <!-- ========================= -->

    <div class="sidebar">

        <!-- Logo -->

        <div class="logo text-center">

            <h3>

                <i class="fa-solid fa-hospital"></i>

                SIM RS

            </h3>

        </div>

        <hr class="bg-white">

        <ul class="nav flex-column">

            <!-- Dashboard -->

            <li class="nav-item">

                <a
                    href="{{ route('superadmin.dashboard') }}"
                    class="nav-link">

                    <i class="fa fa-home me-2"></i>

                    Dashboard

                </a>

            </li>


            <!-- Role Management -->

            <li class="nav-item">

                <a
                    href="{{ route('roles.index') }}"
                    class="nav-link">

                    <i class="fa-solid fa-user-shield me-2"></i>

                    Role Management

                </a>

            </li>


            <!-- Permission Management -->

            <li class="nav-item">

                <a
                    href="{{ route('permissions.index') }}"
                    class="nav-link">

                    <i class="fa-solid fa-key me-2"></i>

                    Permission Management

                </a>

            </li>


            <!-- User Management -->

            <li class="nav-item">

                <a
                    href="{{ route('users.index') }}"
                    class="nav-link">

                    <i class="fa-solid fa-users me-2"></i>

                    User Management

                </a>

            </li>


            <!-- ========================= -->
            <!-- MASTER DATA -->
            <!-- ========================= -->

            <li class="nav-item dropdown">

                <a
                    class="nav-link dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <i class="fa-solid fa-database me-2"></i>

                    Master Data

                </a>


                <ul class="dropdown-menu">


                    <!-- Master Pasien -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-pasien.index') }}">

                            <i class="fa-solid fa-hospital-user me-2"></i>

                            Master Pasien

                        </a>

                    </li>


                    <!-- Master Dokter -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-dokter.index') }}">

                            <i class="fa-solid fa-user-doctor me-2"></i>

                            Master Dokter

                        </a>

                    </li>


                    <!-- Master Perawat -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-perawat.index') }}">

                            <i class="fa-solid fa-user-nurse me-2"></i>

                            Master Perawat

                        </a>

                    </li>


                    <!-- Master Obat -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-obat.index') }}">

                            <i class="fa-solid fa-pills me-2"></i>

                            Master Obat

                        </a>

                    </li>


                    <!-- Master Supplier -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-supplier.index') }}">

                            <i class="fa-solid fa-truck me-2"></i>

                            Master Supplier

                        </a>

                    </li>


                    <!-- Master Kategori -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-kategori.index') }}">

                            <i class="fa-solid fa-tags me-2"></i>

                            Master Kategori

                        </a>

                    </li>


                    <!-- Master Satuan -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-satuan.index') }}">

                            <i class="fa-solid fa-box me-2"></i>

                            Master Satuan Obat

                        </a>

                    </li>


                    <!-- Master Poli -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-poli.index') }}">

                            <i class="fa-solid fa-hospital me-2"></i>

                            Master Poli

                        </a>

                    </li>


                    <!-- Master Kamar -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-kamar.index') }}">

                            <i class="fa-solid fa-bed me-2"></i>

                            Master Kamar

                        </a>

                    </li>


                    <!-- Master Asuransi -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-asuransi.index') }}">

                            <i class="fa-solid fa-shield-heart me-2"></i>

                            Master Asuransi

                        </a>

                    </li>


                    <!-- Master Tindakan -->

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('master-tindakan.index') }}">

                            <i class="fa-solid fa-stethoscope me-2"></i>

                            Master Tindakan

                        </a>

                    </li>


                </ul>

            </li>


            <!-- ========================= -->
            <!-- LAPORAN -->
            <!-- ========================= -->

            <li class="nav-item">

                <a
                    href="#"
                    class="nav-link">

                    <i class="fa-solid fa-chart-column me-2"></i>

                    Laporan

                </a>

            </li>


        </ul>

    </div>


    <!-- ========================= -->
    <!-- CONTENT -->
    <!-- ========================= -->

    <div class="content">


        <!-- Navbar -->

        <nav class="navbar navbar-light bg-white shadow-sm">

            <div class="container-fluid">

                <span class="navbar-brand">

                    Dashboard Super Admin

                </span>


                <div>

                    <span class="me-2">

                        {{ Auth::user()->name }}

                    </span>


                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        style="display:inline">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </nav>


        <!-- Page Content -->

        <div class="container mt-4">

            @yield('content')

        </div>


    </div>

</div>


<!-- Bootstrap JS -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>