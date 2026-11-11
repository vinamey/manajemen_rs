{{-- resources/views/kasir/pembayaran.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pembayaran Obat - SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --bg: #f1f5fd;
            --navy: #10266d;
            --border: #dce6f6;
            --text: #172b63;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        /* SIDEBAR */
        .sidebar {
            width: 232px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            color: #fff;
            background: linear-gradient(180deg, #0864d8 0%, #1478f4 100%);
            box-shadow: 3px 0 15px rgba(20, 80, 170, .12);
        }

        .brand {
            min-height: 105px;
            padding: 18px 20px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            border-bottom: 1px solid rgba(255,255,255,.18);
        }

        .brand-icon {
            font-size: 43px;
            line-height: 1;
        }

        .brand-name {
            font-size: 21px;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .brand-subtitle {
            font-size: 12px;
            line-height: 1.5;
            opacity: .9;
        }

        .sidebar-menu {
            padding: 14px 9px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 17px;
            min-height: 55px;
            padding: 12px 17px;
            margin-bottom: 7px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            transition: .2s;
        }

        .sidebar-link i {
            width: 24px;
            text-align: center;
            font-size: 20px;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            color: #fff;
            background: rgba(255,255,255,.17);
        }

        .sidebar-link.active {
            background: rgba(255,255,255,.2);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 16px 17px 22px;
        }

        .logout-button {
            width: 100%;
            border: 0;
            border-radius: 9px;
            padding: 13px;
            color: #ed3030;
            background: #fff;
            font-weight: 700;
            font-size: 14px;
        }

        /* MAIN */
        .main-content {
            min-height: 100vh;
            margin-left: 232px;
            padding: 0 25px 30px;
        }

        .topbar {
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 27px;
            border-bottom: 1px solid #dce5f3;
            margin-bottom: 20px;
        }

        .topbar-icon {
            color: var(--navy);
            font-size: 21px;
            position: relative;
        }

        .notification-count {
            position: absolute;
            top: -9px;
            right: -8px;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #fff;
            background: #ed3030;
            font-size: 10px;
            font-weight: 700;
        }

        .profile-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: #fff;
            background: var(--blue);
            font-size: 23px;
        }

        .breadcrumb-area {
            display: flex;
            align-items: center;
            gap: 13px;
            color: #64769c;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .breadcrumb-area strong {
            color: #344c84;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 17px;
            margin-bottom: 17px;
        }

        .heading-icon {
            width: 88px;
            height: 78px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            color: var(--blue);
            background: #d6e8ff;
            font-size: 48px;
        }

        .page-heading h1 {
            margin: 0 0 6px;
            color: #10266d;
            font-size: 29px;
            font-weight: 800;
        }

        .page-heading p {
            margin: 0;
            color: #64769c;
            font-size: 15px;
        }

        /* BANNER */
        .banner {
            min-height: 88px;
            padding: 18px 24px;
            margin-bottom: 17px;
            display: flex;
            align-items: center;
            gap: 22px;
            color: #fff;
            border-radius: 13px;
            background: linear-gradient(105deg, #0869e5, #2183fb);
            box-shadow: 0 5px 14px rgba(24,119,242,.12);
        }

        .banner i {
            font-size: 38px;
        }

        .banner h3 {
            margin: 0 0 7px;
            font-size: 20px;
            font-weight: 800;
        }

        .banner p {
            margin: 0;
            font-size: 14px;
        }

        /* FILTER */
        .filter-card {
            padding: 17px;
            margin-bottom: 17px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(30,70,130,.04);
        }

        .filter-label {
            display: block;
            margin-bottom: 8px;
            color: #15265f;
            font-weight: 700;
            font-size: 14px;
        }

        .filter-control {
            width: 100%;
            height: 47px;
            border: 1px solid #cdd9ec;
            border-radius: 9px;
            padding: 0 14px;
            color: #172b63;
            background: #fff;
            outline: none;
        }

        .filter-control:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(24,119,242,.1);
        }

        .filter-button {
            width: 100%;
            height: 47px;
            border-radius: 9px;
            font-weight: 700;
        }

        .btn-blue {
            color: #fff;
            background: var(--blue);
            border: 1px solid var(--blue);
        }

        .btn-blue:hover {
            color: #fff;
            background: var(--blue-dark);
        }

        .btn-outline-blue {
            color: var(--blue);
            background: #fff;
            border: 1px solid #a9c8fa;
        }

        .btn-outline-blue:hover {
            color: var(--blue-dark);
            background: var(--blue-light);
        }

        /* TABLE CARD */
        .table-card {
            overflow: hidden;
            margin-bottom: 22px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(30,70,130,.04);
        }

        .table-card-header {
            min-height: 56px;
            padding: 12px 17px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
        }

        .table-card-header h4 {
            margin: 0;
            color: #10266d;
            font-size: 18px;
            font-weight: 800;
        }

        .table-card-header h4 i {
            margin-right: 10px;
            color: var(--blue);
        }

        .count-badge {
            padding: 5px 11px;
            border-radius: 20px;
            color: #fff;
            background: var(--blue);
            font-weight: 700;
            font-size: 12px;
        }

        .table-responsive {
            width: 100%;
        }

        .main-table {
            width: 100%;
            margin: 0;
            color: #14265d;
            vertical-align: middle;
        }

        .main-table thead th {
            padding: 14px 13px;
            white-space: nowrap;
            color: #10266d;
            background: #e4efff;
            border: 1px solid #d4e2f7;
            font-size: 13px;
            font-weight: 800;
        }

        .main-table tbody td {
            padding: 11px 13px;
            border: 1px solid #e0e8f5;
            font-size: 13px;
            font-weight: 500;
        }

        .main-table tbody tr:hover {
            background: #f7faff;
        }

        .medicine-badge,
        .method-badge {
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid #a9ceff;
            border-radius: 20px;
            color: #0869e5;
            background: #eaf3ff;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-waiting {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            color: #473100;
            background: #ffc629;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-success {
            display: inline-block;
            padding: 6px 10px;
            border: 1px solid #91e3a6;
            border-radius: 20px;
            color: #12642a;
            background: #d9f8df;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .action-button {
            padding: 8px 12px;
            border-radius: 8px;
            color: #fff;
            background: var(--blue);
            border: 0;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .action-button:hover {
            color: #fff;
            background: var(--blue-dark);
        }

        .detail-button {
            padding: 7px 12px;
            border: 1px solid #b7d2ff;
            border-radius: 8px;
            color: var(--blue);
            background: #eaf3ff;
            font-weight: 700;
        }

        .empty-state {
            padding: 30px !important;
            color: #7a89a8 !important;
            text-align: center;
        }

        .pagination-info {
            color: #10266d;
            font-weight: 600;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            margin-left: 4px;
            border: 1px solid #d3e0f5;
            border-radius: 7px;
            color: var(--blue);
        }

        .pagination .active .page-link {
            color: #fff;
            background: var(--blue);
            border-color: var(--blue);
        }

        /* MODAL */
        .modal-backdrop.show {
            opacity: .48;
        }

        .payment-modal .modal-dialog,
        .detail-modal .modal-dialog {
            max-width: 920px;
        }

        .payment-modal .modal-content,
        .detail-modal .modal-content {
            overflow: hidden;
            border: 0;
            border-radius: 22px;
            box-shadow: 0 18px 45px rgba(13,39,90,.25);
        }

        .payment-modal .modal-header,
        .detail-modal .modal-header {
            min-height: 83px;
            padding: 18px 30px;
            color: #fff;
            background: linear-gradient(110deg, #0869e5, #2183fb);
            border: 0;
        }

        .modal-title {
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 21px;
            font-weight: 800;
        }

        .modal-title i {
            font-size: 32px;
        }

        .modal-close {
            color: #fff !important;
            opacity: 1;
            font-size: 25px;
            box-shadow: none !important;
        }

        .payment-modal .modal-body,
        .detail-modal .modal-body {
            padding: 18px 30px 25px;
            background: #fff;
        }

        .patient-summary {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            align-items: center;
            gap: 15px;
            padding: 17px 20px;
            margin-bottom: 17px;
            border-radius: 12px;
            background: #e5f0ff;
        }

        .summary-item {
            min-height: 58px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding-right: 12px;
            border-right: 1px solid #a9c9fb;
        }

        .summary-item:last-child {
            border-right: 0;
        }

        .summary-icon {
            width: 54px;
            height: 54px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 50%;
            color: #0869d9;
            background: #c8e0ff;
            font-size: 26px;
        }

        .summary-label {
            color: #526a9c;
            font-size: 13px;
        }

        .summary-value {
            color: #10266d;
            font-size: 15px;
            font-weight: 800;
        }

        .summary-small {
            color: #10266d;
            font-size: 12px;
        }

        .modal-section {
            overflow: hidden;
            margin-bottom: 13px;
            border: 1px solid #dce7f7;
            border-radius: 12px;
        }

        .modal-section-title {
            padding: 12px 15px;
            color: #10266d;
            font-size: 16px;
            font-weight: 800;
        }

        .modal-section-title i {
            margin-right: 9px;
            color: var(--blue);
        }

        .medicine-table {
            width: 100%;
            margin: 0;
            vertical-align: middle;
        }

        .medicine-table th {
            padding: 11px 10px;
            color: #10266d;
            background: #e5f0ff;
            border: 1px solid #d4e2f7;
            white-space: nowrap;
            font-size: 12px;
        }

        .medicine-table td {
            padding: 10px;
            color: #172b63;
            border: 1px solid #e0e8f5;
            font-size: 12px;
        }

        .total-bar {
            padding: 12px 16px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 15px;
            border-radius: 10px;
            color: #10266d;
            background: #e2efff;
            font-size: 15px;
            font-weight: 800;
        }

        .total-value {
            padding: 8px 13px;
            border-radius: 8px;
            color: #064cb5;
            background: #c8e0ff;
            font-size: 21px;
            white-space: nowrap;
        }

        .payment-method-title {
            margin-bottom: 12px;
            color: #10266d;
            font-size: 16px;
            font-weight: 800;
        }

        .payment-method-title i {
            margin-right: 8px;
            color: var(--blue);
        }

        .payment-method-option {
            height: 83px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 13px;
            padding: 10px;
            border: 2px solid #dce6f5;
            border-radius: 12px;
            cursor: pointer;
            transition: .2s;
        }

        .payment-method-option:hover {
            border-color: #91bdff;
            background: #f6faff;
        }

        .payment-method-option.selected {
            border-color: var(--blue);
            background: #e8f2ff;
        }

        .payment-method-option input {
            position: absolute;
            opacity: 0;
        }

        .payment-method-option > i {
            color: #0758bf;
            font-size: 30px;
        }

        .payment-method-option.cash > i {
            color: #42a878;
        }

        .method-name {
            color: #10266d;
            font-size: 15px;
            font-weight: 800;
        }

        .method-description {
            margin-top: 3px;
            color: #64769c;
            font-size: 11px;
        }

        .method-check {
            position: absolute;
            top: 9px;
            right: 10px;
            color: var(--blue);
            font-size: 20px;
            display: none;
        }

        .payment-method-option.selected .method-check {
            display: block;
        }

        .payment-extra {
            display: none;
            padding: 14px;
            margin-top: 13px;
            border: 1px solid #dce7f7;
            border-radius: 10px;
            background: #f7faff;
        }

        .payment-extra.show {
            display: block;
        }

        .payment-extra label {
            display: block;
            margin-bottom: 7px;
            color: #10266d;
            font-weight: 700;
        }

        .payment-extra input {
            height: 43px;
            border: 1px solid #cdd9ec;
            border-radius: 8px;
        }

        .qris-image {
            display: block;
            width: 180px;
            max-width: 100%;
            height: auto;
            margin: 10px auto;
            padding: 8px;
            border: 1px solid #dce6f5;
            border-radius: 10px;
            background: #fff;
        }

        .info-note {
            min-height: 60px;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 10px;
            color: #1761c3;
            background: #e5f0ff;
            font-size: 13px;
            line-height: 1.5;
        }

        .info-note i {
            font-size: 23px;
        }

        .modal-footer-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 16px;
        }

        .modal-footer-buttons {
            display: flex;
            gap: 10px;
        }

        .modal-footer-buttons .btn {
            min-width: 125px;
            min-height: 48px;
            border-radius: 9px;
            font-weight: 700;
        }

        .modal-footer-buttons .btn-primary {
            min-width: 165px;
            background: var(--blue);
            border-color: var(--blue);
        }

        /* DETAIL HISTORY */
        .detail-total {
            padding: 15px;
            border-radius: 10px;
            color: #10266d;
            background: #e5f0ff;
            text-align: right;
            font-size: 19px;
            font-weight: 800;
        }

        @media (max-width: 1000px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding-left: 17px;
                padding-right: 17px;
            }

            .patient-summary {
                grid-template-columns: 1fr;
            }

            .summary-item {
                border-right: 0;
                border-bottom: 1px solid #a9c9fb;
                padding-bottom: 10px;
            }

            .summary-item:last-child {
                border-bottom: 0;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 68px;
            }

            .brand {
                justify-content: center;
                padding: 15px 5px;
            }

            .brand > div:last-child,
            .sidebar-link span,
            .sidebar-bottom {
                display: none;
            }

            .sidebar-link {
                justify-content: center;
                padding: 13px 5px;
            }

            .sidebar-link i {
                font-size: 21px;
            }

            .main-content {
                margin-left: 68px;
                padding: 0 12px 20px;
            }

            .page-heading h1 {
                font-size: 22px;
            }

            .heading-icon {
                width: 60px;
                height: 60px;
                font-size: 32px;
            }

            .filter-card .row > div {
                margin-bottom: 12px;
            }

            .payment-modal .modal-dialog,
            .detail-modal .modal-dialog {
                margin: 10px;
            }

            .payment-modal .modal-header,
            .detail-modal .modal-header,
            .payment-modal .modal-body,
            .detail-modal .modal-body {
                padding-left: 16px;
                padding-right: 16px;
            }

            .modal-footer-custom {
                align-items: stretch;
                flex-direction: column;
            }

            .modal-footer-buttons {
                width: 100%;
            }

            .modal-footer-buttons .btn {
                flex: 1;
                min-width: 0;
            }
        }
    </style>
</head>

<body>

@php
    /*
    |--------------------------------------------------------------------------
    | Helper harga obat
    |--------------------------------------------------------------------------
    | Harga jual dipilih berdasarkan satuan yang dipakai pada detail resep.
    */
    $ambilHargaObat = function ($obat) {
        $satuanId = (int) ($obat->pivot->satuan_obat_id ?? 0);

        $harga = $obat->hargaJual->firstWhere('satuan_id', $satuanId);

        if (!$harga) {
            $harga = $obat->hargaJual->first();
        }

        if (!$harga || (float) $harga->isi <= 0) {
            return 0;
        }

        return (float) $harga->harga / (float) $harga->isi;
    };

    $hitungTotalResep = function ($resep) use ($ambilHargaObat) {
        $total = 0;

        foreach ($resep->obat as $obat) {
            $jumlah = (int) ($obat->pivot->nilai ?? 0);
            $total += $ambilHargaObat($obat) * $jumlah;
        }

        return $total;
    };

    $namaPasien = function ($resep) {
        return data_get($resep, 'pemeriksaan.pendaftaran.pasien.nama', '-');
    };

    $namaDokter = function ($resep) {
        return data_get($resep, 'pemeriksaan.dokter.nama')
            ?? data_get($resep, 'pemeriksaan.dokter.user.name')
            ?? '-';
    };
@endphp

{{-- SIDEBAR --}}
<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">
            <i class="fa-solid fa-plus"></i>
        </div>
        <div>
            <div class="brand-name">SIM RS</div>
            <div class="brand-subtitle">Sistem Informasi<br>Rumah Sakit</div>
        </div>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('kasir.dashboard') }}" class="sidebar-link">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('kasir.pembayaran') }}" class="sidebar-link active">
            <i class="fa-solid fa-capsules"></i>
            <span>Resep &amp; Pembayaran Obat</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket me-2"></i>
                Logout
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<main class="main-content">

    <div class="topbar">
        <div class="topbar-icon">
            <i class="fa-regular fa-bell"></i>
            <span class="notification-count">1</span>
        </div>
        <div class="profile-icon">
            <i class="fa-solid fa-user"></i>
        </div>
    </div>

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-area">
        <i class="fa-solid fa-house"></i>
        <span>/</span>
        <span>Transaksi</span>
        <span>/</span>
        <strong>Resep &amp; Pembayaran Obat</strong>
    </div>

    {{-- JUDUL HALAMAN --}}
    <div class="page-heading">
        <div class="heading-icon">
            <i class="fa-solid fa-capsules"></i>
        </div>
        <div>
            <h1>Pembayaran Obat</h1>
            <p>Kelola resep obat dan lakukan pembayaran obat pasien</p>
        </div>
    </div>

    {{-- BANNER --}}
    <div class="banner">
        <i class="fa-solid fa-wallet"></i>
        <div>
            <h3>Pembayaran Obat Pasien</h3>
            <p>Cari pasien dan pilih resep yang akan dibayarkan</p>
        </div>
    </div>

    {{-- FILTER PENCARIAN --}}
    <div class="filter-card">
        <form action="{{ route('kasir.pembayaran') }}" method="GET">
            <div class="row align-items-end">
                <div class="col-lg-5">
                    <label class="filter-label">Cari Pasien (Nama / No. RM)</label>
                    <input
                        type="text"
                        name="search"
                        class="filter-control"
                        value="{{ request('search') }}"
                        placeholder="Masukkan nama pasien atau No. RM..."
                    >
                </div>

                <div class="col-lg-3">
                    <label class="filter-label">Tanggal Resep</label>
                    <input
                        type="date"
                        name="tanggal_mulai"
                        class="filter-control"
                        value="{{ request('tanggal_mulai') }}"
                    >
                </div>

                <div class="col-lg-3">
                    <label class="filter-label">Sampai Tanggal</label>
                    <input
                        type="date"
                        name="tanggal_selesai"
                        class="filter-control"
                        value="{{ request('tanggal_selesai') }}"
                    >
                </div>

                <div class="col-lg-1 d-grid">
                    <button type="submit" class="btn btn-blue filter-button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>

            <div class="text-end mt-2">
                <a href="{{ route('kasir.pembayaran') }}" class="btn btn-sm btn-outline-blue">
                    <i class="fa-solid fa-rotate-right me-1"></i> Reset Filter
                </a>
            </div>
        </form>
    </div>

    {{-- DAFTAR RESEP --}}
    <section class="table-card">
        <div class="table-card-header">
            <h4>
                <i class="fa-solid fa-rectangle-list"></i>
                Daftar Resep untuk Pembayaran
            </h4>
            <span class="count-badge">{{ $resepObats->total() }} Data</span>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Obat</th>
                        <th>Jumlah</th>
                        <th>Cara</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($resepObats as $index => $resep)
                        @php
                            $totalResep = $hitungTotalResep($resep);
                            $daftarObat = $resep->obat;
                            $jumlahObat = $daftarObat->sum(function ($obat) {
                                return (int) ($obat->pivot->nilai ?? 0);
                            });
                        @endphp

                        <tr>
                            <td>{{ $resepObats->firstItem() + $index }}</td>

                            <td>{{ $namaPasien($resep) }}</td>

                            <td>{{ $namaDokter($resep) }}</td>

                            <td>
                                @forelse ($daftarObat as $obat)
                                    <span class="medicine-badge mb-1">
                                        {{ $obat->nama_obat ?? $obat->nama ?? 'Obat' }}
                                    </span>
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>{{ $jumlahObat }}</td>

                            <td>
                                @forelse ($daftarObat as $obat)
                                    <div>
                                        {{ $obat->bentuk_obat ?? $obat->jenis_obat ?? '-' }}
                                    </div>
                                @empty
                                    -
                                @endforelse
                            </td>

                            <td>
                                <strong>
                                    Rp {{ number_format($totalResep, 0, ',', '.') }}
                                </strong>
                            </td>

                            <td>
                                <span class="status-waiting">
                                    Menunggu Pembayaran
                                </span>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="action-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#paymentModal{{ $resep->id }}"
                                >
                                    <i class="fa-solid fa-wallet me-1"></i>
                                    Proses Bayar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="empty-state">
                                <i class="fa-solid fa-folder-open fa-2x mb-2 d-block"></i>
                                Belum ada resep yang menunggu pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- RIWAYAT PEMBAYARAN --}}
    <section class="table-card">
        <div class="table-card-header">
            <h4>
                <i class="fa-solid fa-clock-rotate-left"></i>
                Riwayat Pembayaran
            </h4>
            <span class="count-badge">{{ $riwayatPembayaran->total() }} Data</span>
        </div>

        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Tanggal</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($riwayatPembayaran as $index => $bayar)
                        @php
                            $resepRiwayat = $bayar->resep;
                        @endphp

                        <tr>
                            <td>{{ $riwayatPembayaran->firstItem() + $index }}</td>

                            <td>
                                {{ $resepRiwayat ? $namaPasien($resepRiwayat) : '-' }}
                            </td>

                            <td>
                                {{ $resepRiwayat ? $namaDokter($resepRiwayat) : '-' }}
                            </td>

                            <td>
                                {{ $bayar->created_at ? $bayar->created_at->format('d/m/Y') : '-' }}
                            </td>

                            <td>
                                <span class="method-badge">
                                    {{ $bayar->metode_pembayaran }}
                                </span>
                            </td>

                            <td>
                                <span class="status-success">
                                    {{ $bayar->status }}
                                </span>
                            </td>

                            <td>
                                <strong>
                                    Rp {{ number_format($bayar->total_pembayaran, 0, ',', '.') }}
                                </strong>
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="detail-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailRiwayat{{ $bayar->id }}"
                                >
                                    <i class="fa-solid fa-eye me-1"></i>
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="empty-state">
                                <i class="fa-solid fa-clock-rotate-left fa-2x mb-2 d-block"></i>
                                Belum ada riwayat pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- PAGINATION --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="pagination-info">
            Menampilkan
            {{ $riwayatPembayaran->firstItem() ?? 0 }}
            -
            {{ $riwayatPembayaran->lastItem() ?? 0 }}
            dari
            {{ $riwayatPembayaran->total() }} data riwayat pembayaran
        </div>

        <div>
            {{ $riwayatPembayaran->links('pagination::bootstrap-5') }}
        </div>
    </div>

</main>

{{-- =========================================================
     MODAL PROSES PEMBAYARAN
     DILETAKKAN DI LUAR TABEL
========================================================= --}}
@foreach ($resepObats as $resep)
    @php
        $totalResep = $hitungTotalResep($resep);
        $daftarObat = $resep->obat;
    @endphp

    <div
        class="modal fade payment-modal"
        id="paymentModal{{ $resep->id }}"
        tabindex="-1"
        aria-labelledby="paymentModalLabel{{ $resep->id }}"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel{{ $resep->id }}">
                        <i class="fa-solid fa-wallet"></i>
                        Proses Pembayaran Resep
                    </h5>

                    <button
                        type="button"
                        class="btn-close modal-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>

                <form
                    action="{{ route('kasir.pembayaran.proses', $resep->id) }}"
                    method="POST"
                    class="payment-form"
                    data-total="{{ $totalResep }}"
                >
                    @csrf

                    <div class="modal-body">

                        {{-- INFORMASI PASIEN --}}
                        <div class="patient-summary">
                            <div class="summary-item">
                                <div class="summary-icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div>
                                    <div class="summary-label">Pasien</div>
                                    <div class="summary-value">
                                        {{ $namaPasien($resep) }}
                                    </div>
                                    <div class="summary-small">
                                        No. Resep: {{ $resep->id }}
                                    </div>
                                </div>
                            </div>

                            <div class="summary-item">
                                <div class="summary-icon">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                                <div>
                                    <div class="summary-label">Dokter</div>
                                    <div class="summary-value">
                                        {{ $namaDokter($resep) }}
                                    </div>
                                </div>
                            </div>

                            <div class="summary-item">
                                <div class="summary-icon">
                                    <i class="fa-regular fa-calendar-days"></i>
                                </div>
                                <div>
                                    <div class="summary-label">Tanggal Resep</div>
                                    <div class="summary-value">
                                        {{ $resep->created_at ? $resep->created_at->format('d/m/Y') : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DETAIL OBAT --}}
                        <div class="modal-section">
                            <div class="modal-section-title">
                                <i class="fa-solid fa-capsules"></i>
                                Detail Resep Obat
                            </div>

                            <div class="table-responsive">
                                <table class="medicine-table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Obat</th>
                                            <th>Jumlah</th>
                                            <th>Frekuensi</th>
                                            <th>Aturan</th>
                                            <th>Lama</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($daftarObat as $index => $obat)
                                            @php
                                                $jumlah = (int) ($obat->pivot->nilai ?? 0);
                                                $hargaSatuan = $ambilHargaObat($obat);
                                                $subtotal = $hargaSatuan * $jumlah;
                                                $aturanPakai = $obat->pivot->aturan_pakai ?? '-';
                                            @endphp

                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>
                                                    {{ $obat->nama_obat ?? $obat->nama ?? 'Obat' }}
                                                </td>

                                                <td>{{ $jumlah }}</td>

                                                <td>-</td>

                                                <td>{{ $aturanPakai }}</td>

                                                <td>-</td>

                                                <td>
                                                    Rp {{ number_format($hargaSatuan, 0, ',', '.') }}
                                                </td>

                                                <td>
                                                    <strong>
                                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                                    </strong>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    Tidak ada detail obat.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- TOTAL --}}
                        <div class="total-bar">
                            <span>Total Pembayaran:</span>
                            <span class="total-value">
                                Rp {{ number_format($totalResep, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- METODE PEMBAYARAN --}}
                        <div class="payment-method-title">
                            <i class="fa-solid fa-wallet"></i>
                            Metode Pembayaran
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="payment-method-option cash selected">
                                    <input
                                        type="radio"
                                        name="metode_pembayaran"
                                        value="Cash"
                                        checked
                                        required
                                    >
                                    <i class="fa-solid fa-money-bill-wave"></i>
                                    <div>
                                        <div class="method-name">Tunai</div>
                                        <div class="method-description">Bayar dengan uang tunai</div>
                                    </div>
                                    <i class="fa-solid fa-circle-check method-check"></i>
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="payment-method-option">
                                    <input
                                        type="radio"
                                        name="metode_pembayaran"
                                        value="QRIS"
                                        required
                                    >
                                    <i class="fa-solid fa-qrcode"></i>
                                    <div>
                                        <div class="method-name">QRIS</div>
                                        <div class="method-description">Scan QR Code</div>
                                    </div>
                                    <i class="fa-solid fa-circle-check method-check"></i>
                                </label>
                            </div>

                            <div class="col-md-4">
                                <label class="payment-method-option">
                                    <input
                                        type="radio"
                                        name="metode_pembayaran"
                                        value="Transfer Bank"
                                        required
                                    >
                                    <i class="fa-solid fa-building-columns"></i>
                                    <div>
                                        <div class="method-name">Transfer</div>
                                        <div class="method-description">Transfer via Bank</div>
                                    </div>
                                    <i class="fa-solid fa-circle-check method-check"></i>
                                </label>
                            </div>
                        </div>

                        {{-- INPUT TUNAI --}}
                        <div class="payment-extra show cash-panel">
                            <label>Uang Diterima</label>
                            <input
                                type="number"
                                name="uang_diterima"
                                class="form-control cash-input"
                                min="{{ $totalResep }}"
                                step="1"
                                placeholder="Masukkan jumlah uang yang diterima"
                            >

                            <div class="mt-2 small text-muted">
                                Kembalian:
                                <strong class="change-value">Rp 0</strong>
                            </div>
                        </div>

                        {{-- PANEL QRIS --}}
                        <div class="payment-extra qris-panel">
                            <div class="text-center">
                                <strong class="text-primary">Silakan scan QRIS berikut</strong>

                                <img
                                    src="{{ asset('images/qris.jpeg') }}"
                                    alt="QRIS Pembayaran"
                                    class="qris-image"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                >

                                <div class="text-danger small" style="display:none">
                                    Gambar QRIS tidak ditemukan. Pastikan file tersedia di
                                    <strong>public/images/qris.jpeg</strong>.
                                </div>

                                <div class="small text-muted">
                                    Total: Rp {{ number_format($totalResep, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        {{-- PANEL TRANSFER --}}
                        <div class="payment-extra transfer-panel">
                            <label>Informasi Transfer Bank</label>
                            <div class="small text-muted">
                                Silakan lakukan transfer sesuai total pembayaran dan ikuti
                                prosedur verifikasi pembayaran yang berlaku.
                            </div>
                        </div>

                        {{-- CATATAN --}}
                        <div class="modal-footer-custom">
                            <div class="info-note flex-grow-1">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>
                                    Pastikan pembayaran sesuai dengan total sebelum
                                    melanjutkan proses.
                                </span>
                            </div>

                            <div class="modal-footer-buttons">
                                <button
                                    type="button"
                                    class="btn btn-outline-blue"
                                    data-bs-dismiss="modal"
                                >
                                    <i class="fa-solid fa-xmark me-1"></i>
                                    Batal
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-check me-1"></i>
                                    Bayar Sekarang
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- =========================================================
     MODAL DETAIL RIWAYAT PEMBAYARAN
     DILETAKKAN DI LUAR TABEL
========================================================= --}}
@foreach ($riwayatPembayaran as $bayar)
    @php
        $resepRiwayat = $bayar->resep;
        $detailObatRiwayat = $resepRiwayat ? $resepRiwayat->obat : collect();
    @endphp

    <div
        class="modal fade detail-modal"
        id="detailRiwayat{{ $bayar->id }}"
        tabindex="-1"
        aria-labelledby="detailRiwayatLabel{{ $bayar->id }}"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="detailRiwayatLabel{{ $bayar->id }}">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        Detail Pembayaran
                    </h5>

                    <button
                        type="button"
                        class="btn-close modal-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>

                <div class="modal-body">

                    <div class="patient-summary">
                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fa-solid fa-user"></i>
                            </div>
                            <div>
                                <div class="summary-label">Pasien</div>
                                <div class="summary-value">
                                    {{ $resepRiwayat ? $namaPasien($resepRiwayat) : '-' }}
                                </div>
                                <div class="summary-small">
                                    No. Resep: {{ $bayar->resep_id }}
                                </div>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>
                            <div>
                                <div class="summary-label">Dokter</div>
                                <div class="summary-value">
                                    {{ $resepRiwayat ? $namaDokter($resepRiwayat) : '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <div>
                                <div class="summary-label">Tanggal Pembayaran</div>
                                <div class="summary-value">
                                    {{ $bayar->created_at ? $bayar->created_at->format('d/m/Y') : '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-section">
                        <div class="modal-section-title">
                            <i class="fa-solid fa-capsules"></i>
                            Detail Obat
                        </div>

                        <div class="table-responsive">
                            <table class="medicine-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Aturan Pakai</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($detailObatRiwayat as $index => $obat)
                                        @php
                                            $jumlah = (int) ($obat->pivot->nilai ?? 0);
                                            $hargaSatuan = $ambilHargaObat($obat);
                                            $subtotal = $hargaSatuan * $jumlah;
                                        @endphp

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $obat->nama_obat ?? $obat->nama ?? 'Obat' }}</td>
                                            <td>{{ $jumlah }}</td>
                                            <td>{{ $obat->pivot->aturan_pakai ?? '-' }}</td>
                                            <td>Rp {{ number_format($hargaSatuan, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">
                                                Detail obat tidak tersedia.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="summary-label">Metode Pembayaran</div>
                            <div class="summary-value">
                                {{ $bayar->metode_pembayaran }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="summary-label">Status Pembayaran</div>
                            <div class="summary-value">
                                {{ $bayar->status }}
                            </div>
                        </div>
                    </div>

                    <div class="detail-total">
                        Total Pembayaran:
                        Rp {{ number_format($bayar->total_pembayaran, 0, ',', '.') }}
                    </div>

                    <div class="text-end mt-3">
                        <button
                            type="button"
                            class="btn btn-outline-blue px-4"
                            data-bs-dismiss="modal"
                        >
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Pilih metode pembayaran dan tampilkan panel yang sesuai.
    document.querySelectorAll('.payment-modal').forEach(function (modal) {

        function updatePaymentMethod() {
            const form = modal.querySelector('.payment-form');
            if (!form) return;

            const selected = form.querySelector('input[name="metode_pembayaran"]:checked');
            const cashPanel = form.querySelector('.cash-panel');
            const qrisPanel = form.querySelector('.qris-panel');
            const transferPanel = form.querySelector('.transfer-panel');
            const cashInput = form.querySelector('.cash-input');

            form.querySelectorAll('.payment-method-option').forEach(function (option) {
                option.classList.remove('selected');
            });

            if (selected) {
                selected.closest('.payment-method-option').classList.add('selected');
            }

            cashPanel.classList.remove('show');
            qrisPanel.classList.remove('show');
            transferPanel.classList.remove('show');

            if (selected && selected.value === 'Cash') {
                cashPanel.classList.add('show');
                cashInput.required = true;
            } else {
                cashInput.required = false;
            }

            if (selected && selected.value === 'QRIS') {
                qrisPanel.classList.add('show');
            }

            if (selected && selected.value === 'Transfer Bank') {
                transferPanel.classList.add('show');
            }
        }

        modal.querySelectorAll('input[name="metode_pembayaran"]').forEach(function (radio) {
            radio.addEventListener('change', updatePaymentMethod);
        });

        // Hitung uang kembalian untuk pembayaran tunai.
        const cashInput = modal.querySelector('.cash-input');
        const changeValue = modal.querySelector('.change-value');
        const form = modal.querySelector('.payment-form');

        if (cashInput && changeValue && form) {
            cashInput.addEventListener('input', function () {
                const total = Number(form.dataset.total || 0);
                const diterima = Number(cashInput.value || 0);
                const kembalian = Math.max(0, diterima - total);

                changeValue.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(kembalian);
            });
        }

        // Reset pilihan ketika modal dibuka.
        modal.addEventListener('show.bs.modal', function () {
            const cashRadio = modal.querySelector('input[name="metode_pembayaran"][value="Cash"]');

            if (cashRadio) {
                cashRadio.checked = true;
            }

            if (cashInput) {
                cashInput.value = '';
            }

            if (changeValue) {
                changeValue.textContent = 'Rp 0';
            }

            updatePaymentMethod();
        });

        updatePaymentMethod();
    });

});
</script>

</body>
</html>
