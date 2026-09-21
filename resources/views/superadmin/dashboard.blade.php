@extends('layouts.superadmin')

@section('content')

<style>
    .dashboard-title {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 25px;
    }

    .stat-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.25s ease;
        min-height: 145px;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    }

    .stat-card .card-body {
        padding: 22px;
        position: relative;
    }

    .stat-title {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 12px;
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        margin: 0;
    }

    .stat-icon {
        position: absolute;
        right: 20px;
        top: 22px;
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .secondary-card {
        border: none;
        border-radius: 12px;
        transition: all 0.25s ease;
        min-height: 125px;
        background: #ffffff;
    }

    .secondary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12) !important;
    }

    .secondary-card .card-body {
        padding: 20px;
    }

    .secondary-title {
        font-size: 15px;
        color: #6b7280;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .secondary-number {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .section-title {
        font-size: 18px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 15px;
    }
</style>

<div class="container-fluid px-0">

    {{-- Judul Dashboard --}}
    <div class="mb-4">
        <h3 class="dashboard-title">
            Dashboard Super Admin
        </h3>
        <p class="text-muted mb-0">
            Ringkasan informasi sistem manajemen rumah sakit
        </p>
    </div>


    {{-- Statistik Utama --}}
    <div class="row g-4 mb-4">

        {{-- Total User --}}
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-primary text-white shadow-sm">
                <div class="card-body">

                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <div class="stat-title">
                        Total User
                    </div>

                    <h2 class="stat-number">
                        {{ $totalUser }}
                    </h2>

                </div>
            </div>
        </div>


        {{-- Total Dokter --}}
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-success text-white shadow-sm">
                <div class="card-body">

                    <div class="stat-icon">
                        <i class="fas fa-user-md"></i>
                    </div>

                    <div class="stat-title">
                        Total Dokter
                    </div>

                    <h2 class="stat-number">
                        {{ $totalDokter }}
                    </h2>

                </div>
            </div>
        </div>


        {{-- Total Pasien --}}
        <div class="col-xl-4 col-md-6">
            <div class="card stat-card bg-info text-white shadow-sm">
                <div class="card-body">

                    <div class="stat-icon">
                        <i class="fas fa-procedures"></i>
                    </div>

                    <div class="stat-title">
                        Total Pasien
                    </div>

                    <h2 class="stat-number">
                        {{ $totalPasien }}
                    </h2>

                </div>
            </div>
        </div>

    </div>


    {{-- Informasi Pelayanan --}}
    <div class="mb-3">
        <h5 class="section-title">
            Informasi Pelayanan
        </h5>
    </div>

    <div class="row g-4">

        {{-- Pendaftaran Pasien --}}
        <div class="col-xl-4 col-md-6">
            <div class="card secondary-card shadow-sm border-start border-primary border-4">
                <div class="card-body">

                    <div class="secondary-title">
                        <i class="fas fa-clipboard-list text-primary me-2"></i>
                        Pendaftaran Pasien
                    </div>

                    <h3 class="secondary-number">
                        {{ $totalPendaftaran }}
                    </h3>

                    <small class="text-muted">
                        Total pendaftaran pasien
                    </small>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection