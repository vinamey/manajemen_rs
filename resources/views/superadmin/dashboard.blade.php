@extends('layouts.superadmin')

@section('content')

<style>
    .dashboard-title {
        margin-bottom: 6px;
        color: #1f2937;
        font-size: 24px;
        font-weight: 600;
    }

    .dashboard-subtitle {
        margin-bottom: 28px;
        color: #6b7280;
        font-size: 14px;
    }

    .stat-card {
        position: relative;
        min-height: 135px;
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0,0,0,.08);
    }

    .stat-card .card-body {
        position: relative;
        padding: 24px;
    }

    .stat-title {
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 500;
    }

    .stat-number {
        margin: 0;
        font-size: 30px;
        font-weight: 700;
    }

    .stat-icon {
        position: absolute;
        top: 24px;
        right: 24px;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(255,255,255,.18);
        font-size: 20px;
    }

    /* Varian Warna Kartu Stat Upper Grid */
    .card-user { background: #2474ed; }
    .card-pasien { background: #6f42c1; } /* Warna Purple untuk Pasien */
    .card-dokter { background: #20a36a; }
    .card-perawat { background: #21a6c7; }
    .card-obat { background: #e5a92d; }
    .card-kamar { background: #64748b; }

    .section-title {
        margin: 8px 0 16px;
        color: #374151;
        font-size: 17px;
        font-weight: 600;
    }

    .secondary-card {
        min-height: 125px;
        border: none;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(0,0,0,.07);
    }

    .secondary-card .card-body { padding: 20px; }

    .secondary-title {
        margin-bottom: 8px;
        color: #6b7280;
        font-size: 14px;
        font-weight: 500;
    }

    .secondary-number {
        margin: 0 0 4px;
        color: #1f2937;
        font-size: 28px;
        font-weight: 700;
    }

    /* LAPORAN */
    .report-card {
        border: none;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(0,0,0,.07);
        overflow: hidden;
    }

    .report-header {
        padding: 20px 24px;
        border-bottom: 1px solid #eef1f5;
    }

    .report-header h5 {
        margin: 0;
        color: #1f2937;
        font-size: 17px;
        font-weight: 600;
    }

    .report-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 13px;
    }

    .report-table { margin: 0; }

    .report-table thead th {
        padding: 15px 24px;
        border: none;
        background: #eaf2ff;
        color: #374151;
        font-size: 14px;
        font-weight: 600;
    }

    .report-table tbody td {
        padding: 18px 24px;
        color: #4b5563;
        font-size: 14px;
        vertical-align: middle;
    }
</style>

@php
    $totalPerawat = \App\Models\MasterPerawat::count();
    $totalObat = \App\Models\MasterObat::count();
    $totalKamar = \App\Models\MasterKamar::count();
    $totalPendaftaran = \App\Models\PendaftaranPasien::whereDate(
        'tanggal_pendaftaran',
        today()
    )->count();

    $halaman = $halaman ?? 'dashboard';
@endphp
<div class="container-fluid px-0">

    @if($halaman === 'laporan')

        <div class="mb-4">
            <h3 class="dashboard-title">Laporan</h3>
            <p class="dashboard-subtitle">Informasi laporan sistem manajemen rumah sakit</p>
        </div>

        <div class="card report-card">
            <div class="report-header">
                <h5>
                    <i class="fas fa-chart-column text-primary me-2"></i>
                    Daftar Laporan
                </h5>
                <p>Informasi laporan sistem manajemen rumah sakit.</p>
            </div>

            <div class="table-responsive">
                <table class="table report-table align-middle">
                    <thead>
                        <tr>
                            <th style="width: 100px;" class="text-center">No</th>
                            <th style="width: 300px;">Jenis Laporan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center fw-semibold">1</td>
                            <td>
                                <div class="d-flex align-items-center fw-bold text-dark">
                                    <i class="fas fa-money-bill-wave text-success me-3 fs-5"></i>
                                    Pendapatan
                                </div>
                            </td>
                            <td class="text-muted">Laporan rekapitulasi keuangan dan pendapatan rumah sakit</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-semibold">2</td>
                            <td>
                                <div class="d-flex align-items-center fw-bold text-dark">
                                    <i class="fas fa-user-injured text-primary me-3 fs-5"></i>
                                    Pasien
                                </div>
                            </td>
                            <td class="text-muted">Laporan rekam medis dan data pendaftaran pasien</td>
                        </tr>
                        <tr>
                            <td class="text-center fw-semibold">3</td>
                            <td>
                                <div class="d-flex align-items-center fw-bold text-dark">
                                    <i class="fas fa-pills text-warning me-3 fs-5"></i>
                                    Apotek
                                </div>
                            </td>
                            <td class="text-muted">Laporan stok obat-obatan dan riwayat transaksi farmasi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    @else

        {{-- =========================
            DASHBOARD SUPER ADMIN
        ========================== --}}

        <div class="mb-4">
            <h3 class="dashboard-title">Dashboard Super Admin</h3>
            <p class="dashboard-subtitle">Ringkasan informasi sistem manajemen rumah sakit</p>
        </div>

        <div class="row g-3 mb-4">
            {{-- USER --}}
            <div class="col-xl-4 col-md-6">
                <div class="card stat-card card-user text-white">
                    <div class="card-body">
                        <div class="stat-title">Jumlah User</div>
                        <h2 class="stat-number">{{ $totalUser }}</h2>
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                    </div>
                </div>
            </div>

            {{-- PASIEN --}}
            <div class="col-xl-4 col-md-6">
                <div class="card stat-card card-pasien text-white">
                    <div class="card-body">
                        <div class="stat-title">Jumlah Pasien</div>
                        <h2 class="stat-number">{{ $totalPasien }}</h2>
                        <div class="stat-icon"><i class="fas fa-user-injured"></i></div>
                    </div>
                </div>
            </div>

            {{-- DOKTER --}}
            <div class="col-xl-4 col-md-6">
                <div class="card stat-card card-dokter text-white">
                    <div class="card-body">
                        <div class="stat-title">Jumlah Dokter</div>
                        <h2 class="stat-number">{{ $totalDokter }}</h2>
                        <div class="stat-icon"><i class="fas fa-user-md"></i></div>
                    </div>
                </div>
            </div>

            {{-- PERAWAT --}}
            <div class="col-xl-4 col-md-6">
                <div class="card stat-card card-perawat text-white">
                    <div class="card-body">
                        <div class="stat-title">Jumlah Perawat</div>
                        <h2 class="stat-number">{{ $totalPerawat }}</h2>
                        <div class="stat-icon"><i class="fas fa-user-nurse"></i></div>
                    </div>
                </div>
            </div>

            {{-- OBAT --}}
            <div class="col-xl-4 col-md-6">
                <div class="card stat-card card-obat text-white">
                    <div class="card-body">
                        <div class="stat-title">Jumlah Obat</div>
                        <h2 class="stat-number">{{ $totalObat }}</h2>
                        <div class="stat-icon"><i class="fas fa-pills"></i></div>
                    </div>
                </div>
            </div>

            {{-- KAMAR --}}
            <div class="col-xl-4 col-md-6">
                <div class="card stat-card card-kamar text-white">
                    <div class="card-body">
                        <div class="stat-title">Jumlah Kamar</div>
                        <h2 class="stat-number">{{ $totalKamar }}</h2>
                        <div class="stat-icon"><i class="fas fa-bed"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- INFORMASI PELAYANAN --}}
        <h5 class="section-title">Informasi Pelayanan</h5>

        <div class="row g-3">
            <div class="col-xl-4 col-md-6">
                <div class="card secondary-card border-start border-primary border-4">
                    <div class="card-body">
                        <div class="secondary-title">
                            Pendaftaran Pasien
                        </div>
                        <h3 class="secondary-number">{{ $totalPendaftaran }}</h3>
                        <small class="text-muted">Total pendaftaran pasien hari ini</small>
                    </div>
                </div>
            </div>
        </div>

    @endif

</div>

@endsection