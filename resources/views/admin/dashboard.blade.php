@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Admin Rumah Sakit')

@section('content')

<style>
    .admin-wrapper {
        padding: 25px;
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
    }

    .welcome-card {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        color: white;
        border-radius: 18px;
        padding: 25px 30px;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(24, 119, 242, 0.18);
    }

    .welcome-card h2 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .welcome-card p {
        margin: 0;
        opacity: .9;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 18px;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .menu-card {
        background: white;
        border-radius: 16px;
        padding: 22px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .05);
        transition: .2s ease;
    }

    .menu-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(24, 119, 242, .12);
    }

    .menu-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #e7f3ff;
        color: #1877f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 15px;
    }

    .menu-card h5 {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 7px;
    }

    .menu-card p {
        color: #6b7280;
        font-size: 14px;
        min-height: 42px;
        margin-bottom: 18px;
    }

    .btn-kelola {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #1877f2;
        color: white !important;
        padding: 9px 16px;
        border-radius: 9px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: .2s ease;
    }

    .btn-kelola:hover {
        background: #0f58c6;
    }

    @media (max-width: 992px) {
        .menu-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .menu-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-wrapper">

    {{-- WELCOME --}}
    <div class="welcome-card">
        <h2>
            <i class="fa-solid fa-hospital me-2"></i>
            Dashboard Admin Rumah Sakit
        </h2>

        <p>
            Kelola data pasien, dokter, perawat, apoteker, dan kasir.
        </p>
    </div>

    {{-- MENU --}}
    <div class="section-title">
        <i class="fa-solid fa-database me-2"></i>
        Kelola Data
    </div>

    <div class="menu-grid">

        {{-- PASIEN --}}
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fa-solid fa-hospital-user"></i>
            </div>

            <h5>Data Pasien</h5>

            <p>
                Menambahkan dan mengelola data pasien.
            </p>

            <a href="{{ route('admin.pasien.index') }}"
               class="btn-kelola">
                <i class="fa-solid fa-arrow-right"></i>
                Kelola Data
            </a>
        </div>


        {{-- DOKTER --}}
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fa-solid fa-user-doctor"></i>
            </div>

            <h5>Data Dokter</h5>

            <p>
                Menambahkan dan mengelola data dokter.
            </p>

            <a href="{{ route('admin.dokter.index') }}"
               class="btn-kelola">
                <i class="fa-solid fa-arrow-right"></i>
                Kelola Data
            </a>
        </div>


        {{-- PERAWAT --}}
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fa-solid fa-user-nurse"></i>
            </div>

            <h5>Data Perawat</h5>

            <p>
                Menambahkan dan mengelola data perawat.
            </p>

            <a href="{{ route('admin.perawat.index') }}"
               class="btn-kelola">
                <i class="fa-solid fa-arrow-right"></i>
                Kelola Data
            </a>
        </div>


        {{-- APOTEKER --}}
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fa-solid fa-prescription-bottle-medical"></i>
            </div>

            <h5>Data Apoteker</h5>

            <p>
                Menambahkan dan mengelola data apoteker.
            </p>

            <a href="{{ route('apoteker.dashboard') }}"
               class="btn-kelola">
                <i class="fa-solid fa-arrow-right"></i>
                Kelola Data
            </a>
        </div>


        {{-- KASIR --}}
        <div class="menu-card">
            <div class="menu-icon">
                <i class="fa-solid fa-cash-register"></i>
            </div>

            <h5>Data Kasir</h5>

            <p>
                Menambahkan dan mengelola data kasir.
            </p>

            <a href="{{ route('kasir.dashboard') }}"
               class="btn-kelola">
                <i class="fa-solid fa-arrow-right"></i>
                Kelola Data
            </a>
        </div>

    </div>

</div>

@endsection
