@extends('layouts.superadmin')

@section('page-title', 'Dashboard Admin Rumah Sakit')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --blue-soft: #f4f8ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    .admin-dashboard {
        padding: 5px 0 25px;
    }

    /* HEADER */
    .dashboard-header {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        border-radius: 18px;
        padding: 25px 28px;
        color: white;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(24, 119, 242, 0.18);
    }

    .dashboard-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .dashboard-header p {
        margin: 0;
        font-size: 14px;
        opacity: .9;
    }

    .welcome-user {
        margin-top: 18px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .welcome-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: rgba(255,255,255,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .welcome-user strong {
        display: block;
        font-size: 15px;
    }

    .welcome-user small {
        opacity: .85;
    }

    /* SECTION TITLE */
    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    /* MENU CARD */
    .menu-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 17px;
        padding: 22px;
        height: 100%;
        transition: .2s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,.04);
        position: relative;
        overflow: hidden;
    }

    .menu-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(24, 119, 242, .12);
        border-color: #cfe3ff;
    }

    .menu-card::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: var(--blue-light);
        right: -35px;
        bottom: -35px;
        opacity: .7;
    }

    .menu-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--blue-light);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 17px;
    }

    .menu-card h5 {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 7px;
    }

    .menu-card p {
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.6;
        min-height: 42px;
        margin-bottom: 17px;
    }

    .btn-kelola {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: var(--blue-main);
        color: white;
        text-decoration: none;
        border-radius: 9px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
        position: relative;
        z-index: 2;
    }

    .btn-kelola:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* INFO */
    .info-card {
        background: var(--blue-soft);
        border: 1px solid #dcecff;
        border-radius: 16px;
        padding: 20px;
        margin-top: 25px;
    }

    .info-card h6 {
        font-weight: 700;
        color: var(--blue-dark);
        margin-bottom: 7px;
    }

    .info-card p {
        margin: 0;
        font-size: 13px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 20px;
        }

        .dashboard-header h2 {
            font-size: 20px;
        }
    }
</style>


<div class="admin-dashboard">

    {{-- ========================= --}}
    {{-- HEADER DASHBOARD --}}
    {{-- ========================= --}}
    <div class="dashboard-header">

        <h2>
            <i class="fa-solid fa-hospital me-2"></i>
            Dashboard Admin Rumah Sakit
        </h2>

        <p>
            Kelola data operasional rumah sakit melalui menu yang tersedia.
        </p>

        <div class="welcome-user">

            <div class="welcome-icon">
                <i class="fa-solid fa-user-shield"></i>
            </div>

            <div>
                <strong>
                    Selamat datang, {{ auth()->user()->name }}
                </strong>

               
            </div>

        </div>

    </div>


    {{-- ========================= --}}
    {{-- MENU UTAMA --}}
    {{-- ========================= --}}
    <div class="section-title">
        Menu Utama
    </div>


    <div class="row g-4">


        {{-- PASIEN --}}
        <div class="col-xl-4 col-md-6">

            <div class="menu-card">

                <div class="menu-icon">
                    <i class="fa-solid fa-hospital-user"></i>
                </div>

                <h5>Data Pasien</h5>

                <p>
                    Menambahkan, melihat, mengubah, dan mengelola
                    data pasien rumah sakit.
                </p>

                <a href="{{ route('master-pasien.index') }}"
                   class="btn-kelola">

                    <i class="fa-solid fa-arrow-right"></i>
                    Kelola Data

                </a>

            </div>

        </div>


        {{-- DOKTER --}}
        <div class="col-xl-4 col-md-6">

            <div class="menu-card">

                <div class="menu-icon">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <h5>Data Dokter</h5>

                <p>
                    Mengelola data dokter yang terdaftar
                    di rumah sakit.
                </p>

                <a href="{{ route('master-dokter.index') }}"
                   class="btn-kelola">

                    <i class="fa-solid fa-arrow-right"></i>
                    Kelola Data

                </a>

            </div>

        </div>


        {{-- PERAWAT --}}
        <div class="col-xl-4 col-md-6">

            <div class="menu-card">

                <div class="menu-icon">
                    <i class="fa-solid fa-user-nurse"></i>
                </div>

                <h5>Data Perawat</h5>

                <p>
                    Mengelola data perawat yang bekerja
                    di rumah sakit.
                </p>

                <a href="{{ route('master-perawat.index') }}"
                   class="btn-kelola">

                    <i class="fa-solid fa-arrow-right"></i>
                    Kelola Data

                </a>

            </div>

        </div>


        {{-- APOTEKER --}}
        <div class="col-xl-4 col-md-6">

            <div class="menu-card">

                <div class="menu-icon">
                    <i class="fa-solid fa-prescription-bottle-medical"></i>
                </div>

                <h5>Data Apoteker</h5>

                <p>
                    Mengelola data apoteker dan kebutuhan
                    pelayanan kefarmasian.
                </p>

                <a href="{{ route('apoteker.dashboard') }}"
                   class="btn-kelola">

                    <i class="fa-solid fa-arrow-right"></i>
                    Kelola Data

                </a>

            </div>

        </div>


        {{-- KASIR --}}
        <div class="col-xl-4 col-md-6">

            <div class="menu-card">

                <div class="menu-icon">
                    <i class="fa-solid fa-cash-register"></i>
                </div>

                <h5>Data Kasir</h5>

                <p>
                    Mengakses bagian kasir untuk mendukung
                    proses administrasi pembayaran.
                </p>

                <a href="{{ route('kasir.dashboard') }}"
                   class="btn-kelola">

                    <i class="fa-solid fa-arrow-right"></i>
                    Kelola Data

                </a>

            </div>

        </div>


    </div>


    {{-- ========================= --}}
    {{-- INFORMASI --}}
    {{-- ========================= --}}
    <div class="info-card">

        <h6>
            <i class="fa-solid fa-circle-info me-2"></i>
            Informasi Admin Rumah Sakit
        </h6>

        <p>
            Gunakan menu di atas untuk mengelola data yang menjadi
            tanggung jawab Admin Rumah Sakit.
        </p>

    </div>

</div>

@endsection
