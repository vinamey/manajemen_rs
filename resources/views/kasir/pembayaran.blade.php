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
            --bg: #f1f5fc;
            --navy: #092c82;
            --border: #dce7f7;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: #14264f;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 230px;
            background: linear-gradient(180deg, #0865df, #1877f2);
            color: white;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .logo {
            min-height: 105px;
            padding: 18px 22px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
            border-bottom: 1px solid #ffffff25;
        }

        .logo i {
            font-size: 39px;
            margin-top: 2px;
        }

        .logo strong {
            display: block;
            font-size: 22px;
        }

        .logo small {
            display: block;
            margin-top: 4px;
            font-size: 12px;
            line-height: 1.5;
            opacity: .9;
        }

        .menu {
            padding: 18px 9px;
        }

        .menu-title {
            padding: 8px 12px;
            font-size: 10px;
            text-transform: uppercase;
            opacity: .7;
            letter-spacing: 1px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 17px;
            margin-bottom: 6px;
            border-radius: 10px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: .2s;
        }

        .menu a i {
            width: 21px;
            font-size: 18px;
        }

        .menu a:hover,
        .menu a.active {
            background: #ffffff25;
        }

        .menu a.active {
            box-shadow: inset 3px 0 white;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding: 16px 17px 20px;
            background: #ffffff0b;
        }

        .logout-btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: white;
            color: #ed3030;
            font-size: 14px;
            font-weight: bold;
        }

        /* MAIN */
        .content {
            margin-left: 230px;
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            margin: 0 25px;
            border-bottom: 1px solid #dce5f4;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 24px;
        }

        .topbar-icon {
            position: relative;
            color: var(--navy);
            font-size: 21px;
        }

        .notification {
            position: absolute;
            top: -8px;
            right: -9px;
            width: 19px;
            height: 19px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ef3030;
            color: white;
            font-size: 10px;
            font-weight: bold;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--blue);
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 23px;
        }

        .page {
            padding: 24px 30px 35px;
        }

        .breadcrumb-custom {
            display: flex;
            gap: 13px;
            align-items: center;
            margin-bottom: 22px;
            color: #71819e;
            font-size: 13px;
        }

        .breadcrumb-custom strong {
            color: #244078;
        }

        .page-heading {
            display: flex;
            align-items: center;
            gap: 17px;
            margin-bottom: 20px;
        }

        .heading-icon {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: #c9e1ff;
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .page-heading h2 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            color: var(--navy);
        }

        .page-heading p {
            margin: 5px 0 0;
            color: #657895;
            font-size: 14px;
        }

        /* BANNER */
        .page-banner {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 19px 23px;
            margin-bottom: 17px;
            border-radius: 12px;
            background: linear-gradient(110deg, #0867e8, #1683fa);
            color: white;
            box-shadow: 0 5px 15px #1877f220;
        }

        .page-banner i {
            font-size: 37px;
        }

        .page-banner h4 {
            margin: 0;
            font-size: 19px;
            font-weight: bold;
        }

        .page-banner p {
            margin: 5px 0 0;
            font-size: 13px;
        }

        /* SEARCH */
        .search-card {
            display: grid;
            grid-template-columns: 1.5fr 1.1fr auto auto;
            gap: 16px;
            align-items: end;
            padding: 17px;
            margin-bottom: 17px;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: white;
            box-shadow: 0 2px 5px #173a6a08;
        }

        .search-group label {
            display: block;
            margin-bottom: 7px;
            color: #14264f;
            font-size: 13px;
            font-weight: bold;
        }

        .search-input {
            position: relative;
        }

        .search-input i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #657895;
        }

        .search-input input,
        .search-group input {
            width: 100%;
            height: 47px;
            padding: 0 13px;
            border: 1px solid #d3deef;
            border-radius: 9px;
            outline: none;
            color: #263b65;
            font-size: 13px;
        }

        .search-input input {
            padding-left: 42px;
        }

        .search-input input:focus,
        .search-group input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px #1877f218;
        }

        .btn-search,
        .btn-reset {
            height: 47px;
            padding: 0 23px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn-search {
            border: none;
            background: var(--blue);
            color: white;
        }

        .btn-reset {
            border: 1px solid #b8d0f5;
            background: white;
            color: var(--blue);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* TABLE CARD */
        .payment-card {
            margin-bottom: 23px;
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 13px;
            background: white;
            box-shadow: 0 2px 6px #173a6a0a;
        }

        .card-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 16px 19px;
            border-bottom: 1px solid var(--border);
        }

        .card-heading h5 {
            margin: 0;
            color: var(--navy);
            font-size: 17px;
            font-weight: bold;
        }

        .card-heading h5 i {
            color: var(--blue);
            margin-right: 8px;
        }

        .data-count {
            padding: 5px 12px;
            border-radius: 20px;
            background: var(--blue);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .payment-table {
            width: 100%;
            min-width: 950px;
            margin: 0;
        }

        .payment-table thead th {
            padding: 13px 14px;
            background: #e8f2ff;
            color: #122d69;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
            border-color: #dce8f8;
        }

        .payment-table tbody td {
            padding: 13px 14px;
            color: #172a52;
            font-size: 13px;
            vertical-align: middle;
            border-color: #e3eaf4;
        }

        .patient-name {
            font-weight: bold;
            color: #152e69;
        }

        .medicine-badge {
            display: inline-block;
            margin: 2px;
            padding: 5px 10px;
            border: 1px solid #b9d7ff;
            border-radius: 20px;
            background: #eaf3ff;
            color: #0866df;
            font-size: 11px;
            font-weight: 600;
        }

        .status-waiting {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #ffca35;
            color: #483600;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-paid {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #d6f6df;
            color: #147438;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .status-verification {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #fff0c4;
            color: #946400;
            font-size: 11px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn-process {
            padding: 9px 12px;
            border: none;
            border-radius: 7px;
            background: var(--blue);
            color: white;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .btn-process:hover {
            background: var(--blue-dark);
        }

        .btn-detail {
            padding: 8px 12px;
            border: 1px solid #bfd7ff;
            border-radius: 7px;
            background: #eaf3ff;
            color: var(--blue-dark);
            font-size: 12px;
            font-weight: bold;
        }

        .empty-state {
            padding: 38px 15px !important;
            text-align: center;
            color: #71819e !important;
        }

        .empty-state i {
            display: block;
            margin-bottom: 12px;
            color: #a8c7ed;
            font-size: 38px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            padding: 13px 18px;
            border-top: 1px solid #e7edf6;
        }

        .pagination-wrapper nav {
            margin: 0;
        }

        .pagination {
            margin: 0;
        }

        .page-link {
            color: var(--blue);
        }

        .page-item.active .page-link {
            background: var(--blue);
            border-color: var(--blue);
        }

        /* MODAL */
        .payment-modal .modal-dialog {
            max-width: 920px;
        }

        .payment-modal .modal-content {
            overflow: hidden;
            border: none;
            border-radius: 17px;
            box-shadow: 0 20px 60px #10264d35;
        }

        .payment-modal .modal-header {
            padding: 20px 28px;
            background: linear-gradient(110deg, #0867e8, #1683fa);
            color: white;
            border: none;
        }

        .payment-modal .modal-header h5 {
            font-size: 20px;
            font-weight: bold;
        }

        .payment-modal .btn-close {
            filter: brightness(0) invert(1);
            opacity: 1;
        }

        .payment-modal .modal-body {
            padding: 19px 25px 24px;
            background: #fff;
            max-height: 78vh;
            overflow-y: auto;
        }

        .patient-summary {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr;
            gap: 15px;
            padding: 16px;
            margin-bottom: 18px;
            border-radius: 11px;
            background: #e5f0ff;
        }

        .patient-summary-item {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .patient-summary-item:not(:last-child) {
            border-right: 1px solid #a9c9f7;
        }

        .summary-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #c4dfff;
            color: #0866df;
            font-size: 23px;
        }

        .patient-summary-item small {
            display: block;
            color: #61789c;
            font-size: 12px;
        }

        .patient-summary-item strong {
            display: block;
            margin-top: 3px;
            color: #102d70;
            font-size: 14px;
        }

        .patient-summary-item span {
            display: block;
            margin-top: 3px;
            color: #405a84;
            font-size: 11px;
        }

        .detail-box {
            overflow: hidden;
            margin-bottom: 12px;
            border: 1px solid #dce7f7;
            border-radius: 11px;
        }

        .detail-box-title {
            padding: 13px 16px;
            color: #102d70;
            font-size: 15px;
            font-weight: bold;
        }

        .detail-box-title i {
            margin-right: 8px;
            color: var(--blue);
        }

        .detail-table {
            width: 100%;
            margin: 0;
        }

        .detail-table th {
            padding: 11px 12px;
            background: #e9f2ff;
            color: #17356f;
            font-size: 12px;
            white-space: nowrap;
            border-color: #dce7f7;
        }

        .detail-table td {
            padding: 11px 12px;
            font-size: 12px;
            vertical-align: middle;
            border-color: #e1e9f5;
        }

        .total-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 20px;
            padding: 13px 17px;
            margin-bottom: 17px;
            border-radius: 9px;
            background: #e0edff;
            color: #102d70;
            font-size: 15px;
            font-weight: bold;
        }

        .total-bar strong {
            color: #064fc0;
            font-size: 23px;
        }

        .method-section-title {
            margin-bottom: 12px;
            color: #102d70;
            font-size: 15px;
            font-weight: bold;
        }

        .method-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .method-option {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 82px;
            padding: 12px;
            border: 1.5px solid #dce5f3;
            border-radius: 11px;
            cursor: pointer;
            transition: .2s;
        }

        .method-option:has(input:checked) {
            border-color: var(--blue);
            background: #eaf3ff;
            box-shadow: 0 0 0 1px var(--blue);
        }

        .method-option input {
            position: absolute;
            opacity: 0;
        }

        .method-icon {
            width: 43px;
            height: 43px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #e9f2ff;
            color: #1266d5;
            font-size: 22px;
        }

        .method-option:first-child .method-icon {
            color: #27945d;
            background: #e1f5e9;
        }

        .method-description strong {
            display: block;
            color: #102d70;
            font-size: 14px;
        }

        .method-description small {
            display: block;
            margin-top: 4px;
            color: #71819e;
            font-size: 10px;
        }

        .method-check {
            position: absolute;
            top: 9px;
            right: 9px;
            display: none;
            width: 22px;
            height: 22px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--blue);
            color: white;
            font-size: 11px;
        }

        .method-option:has(input:checked) .method-check {
            display: flex;
        }

        .method-panel {
            margin-top: 13px;
            padding: 15px;
            border: 1px solid #dce7f7;
            border-radius: 10px;
            background: #f7faff;
        }

        .hidden {
            display: none !important;
        }

        .cash-change {
            padding: 11px;
            margin-top: 10px;
            border-radius: 8px;
            background: #e1f7e9;
            color: #147438;
        }

        .qris-panel {
            text-align: center;
        }

        .qris-image-frame {
            width: 210px;
            height: 210px;
            padding: 10px;
            margin: 12px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #cbdcf3;
            border-radius: 10px;
            background: white;
        }

        .qris-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .qris-image-error {
            color: #dc3545;
            font-size: 12px;
        }

        .info-payment {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            border-radius: 9px;
            background: #e7f1ff;
            color: #20558e;
            font-size: 12px;
            line-height: 1.5;
        }

        .modal-footer-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 17px;
        }

        .modal-footer-custom .info-payment {
            max-width: 48%;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .btn-cancel,
        .btn-submit {
            min-height: 46px;
            padding: 0 18px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: bold;
        }

        .btn-cancel {
            border: 1px solid #9dc3fa;
            background: white;
            color: var(--blue);
        }

        .btn-submit {
            border: none;
            background: var(--blue);
            color: white;
        }

        .btn-submit:hover {
            background: var(--blue-dark);
            color: white;
        }

        .history-modal .modal-dialog {
            max-width: 560px;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .search-card {
                grid-template-columns: 1fr 1fr;
            }

            .patient-summary {
                grid-template-columns: 1fr;
            }

            .patient-summary-item:not(:last-child) {
                padding-bottom: 10px;
                border-right: none;
                border-bottom: 1px solid #a9c9f7;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 67px;
            }

            .logo {
                justify-content: center;
                padding: 18px 5px;
            }

            .logo i {
                font-size: 25px;
            }

            .logo div,
            .menu-title,
            .menu a span,
            .sidebar-bottom span {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 14px 5px;
            }

            .sidebar-bottom {
                padding: 12px 8px;
            }

            .logout-btn {
                font-size: 0;
            }

            .logout-btn i {
                font-size: 17px;
            }

            .content {
                margin-left: 67px;
            }

            .page {
                padding: 18px 13px;
            }

            .topbar {
                margin: 0 13px;
            }

            .page-heading h2 {
                font-size: 22px;
            }

            .heading-icon {
                width: 60px;
                height: 60px;
                font-size: 29px;
            }

            .method-grid {
                grid-template-columns: 1fr;
            }

            .modal-footer-custom {
                align-items: stretch;
                flex-direction: column;
            }

            .modal-footer-custom .info-payment {
                max-width: 100%;
            }

            .modal-actions {
                justify-content: flex-end;
            }
        }

        @media (max-width: 480px) {
            .search-card {
                grid-template-columns: 1fr;
            }

            .page-banner {
                padding: 15px;
            }

            .page-banner h4 {
                font-size: 16px;
            }

            .payment-modal .modal-body {
                padding: 13px;
            }

            .payment-modal .modal-header {
                padding: 15px;
            }

            .total-bar {
                gap: 8px;
                font-size: 12px;
            }

            .total-bar strong {
                font-size: 18px;
            }

            .detail-table {
                min-width: 680px;
            }

            .btn-cancel,
            .btn-submit {
                padding: 0 12px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-plus"></i>

            <div>
                <strong>SIM RS</strong>
                <small>Sistem Informasi<br>Rumah Sakit</small>
            </div>
        </div>

        <nav class="menu">

            <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Transaksi</div>

                    <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <div class="menu-title">Transaksi</div>

            <a href="{{ route('kasir.pembayaran') }}" class="active">
                <i class="fa-solid fa-pills"></i>
                <span>Resep & Pembayaran Obat</span>
            </a>

            <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-cash-register"></i>
                <span>Data Kasir</span>
            </a>

        </nav>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN CONTENT --}}
    <main class="content">

        <header class="topbar">

            <div class="topbar-icon">
                <i class="fa-regular fa-bell"></i>
                <span class="notification">1</span>
            </div>

            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>

        </header>

        <div class="page">

            {{-- BREADCRUMB --}}
            <div class="breadcrumb-custom">
                <i class="fa-solid fa-house"></i>
                <span>/</span>
                <span>Transaksi</span>
                <span>/</span>
                <strong>Resep & Pembayaran Obat</strong>
            </div>

            {{-- PAGE TITLE --}}
            <div class="page-heading">

                <div class="heading-icon">
                    <i class="fa-solid fa-capsules"></i>
                </div>

                <div>
                    <h2>Pembayaran Obat</h2>
                    <p>Kelola resep obat dan lakukan pembayaran obat pasien</p>
                </div>

            </div>

            {{-- NOTIFIKASI --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Pembayaran belum berhasil:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- BANNER --}}
            <section class="page-banner">
                <i class="fa-solid fa-credit-card"></i>

                <div>
                    <h4>Pembayaran Obat Pasien</h4>
                    <p>Cari pasien dan pilih resep yang akan dibayarkan</p>
                </div>
            </section>

            {{-- PENCARIAN --}}
            <form action="{{ route('kasir.pembayaran') }}" method="GET" class="search-card">

                <div class="search-group">
                    <label>Cari Pasien (Nama)</label>

                    <div class="search-input">
                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama pasien..."
                        >
                    </div>
                </div>

                <div class="search-group">
                    <label>Tanggal Resep - Mulai</label>

                    <input
                        type="date"
                        name="tanggal_mulai"
                        value="{{ request('tanggal_mulai') }}"
                    >
                </div>

                <div class="search-group">
                    <label>Tanggal Resep - Sampai</label>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="{{ request('tanggal_selesai') }}"
                    >
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn-search">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>
                        Cari
                    </button>

                    <a href="{{ route('kasir.pembayaran') }}" class="btn-reset">
                        <i class="fa-solid fa-rotate me-1"></i>
                        Reset
                    </a>
                </div>

            </form>

            {{-- DAFTAR RESEP --}}
            <section class="payment-card">

                <div class="card-heading">

                    <h5>
                        <i class="fa-solid fa-receipt"></i>
                        Daftar Resep untuk Pembayaran
                    </h5>

                    <span class="data-count">
                        {{ $resepObats->total() }} Data
                    </span>

                </div>

                <div class="table-responsive">

                    <table class="table payment-table">

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

                            @forelse($resepObats as $index => $resep)


                        @php
                            $detailObat = $resep->obat->map(function ($obat) {

                                $aturanPakai = trim(
                                    (string) ($obat->pivot->aturan_pakai ?? '')
                                );

                                // Ambil harga jual obat
                                $hargaJual = $obat->hargaJual->first();

                                // Jumlah resep
                                $jumlah = (int) ($obat->pivot->nilai ?? 0);

                                // Harga jual dan isi kemasan
                                $isi = (int) ($hargaJual->isi ?? 0);
                                $harga = (float) ($hargaJual->harga ?? 0);

                                // Harga per satuan terkecil
                                $hargaSatuan = $isi > 0 ? $harga / $isi : 0;

                                // Subtotal
                                $subtotal = $hargaSatuan * $jumlah;

                                $detail = [
                                    'nama' => $obat->nama ?? '-',
                                    'jumlah' => $jumlah,
                                    'cara' => $obat->pivot->satuan_obat_id ?? '-',
                                    'harga' => $hargaSatuan,
                                    'subtotal' => $subtotal,
                                    'dosis' => '-',
                                    'frekuensi' => '-',
                                    'aturan' => '-',
                                    'lama' => '-',
                                ];

                                // Parsing aturan pakai
                                if ($aturanPakai !== '') {

                                    preg_match(
                                        '/dosis\s*:\s*([^|]+)/i',
                                        $aturanPakai,
                                        $dosis
                                    );

                                    preg_match(
                                        '/frekuensi\s*:\s*([^|]+)/i',
                                        $aturanPakai,
                                        $frekuensi
                                    );

                                    preg_match(
                                        '/aturan(?:\s+pakai)?\s*:\s*([^|]+)/i',
                                        $aturanPakai,
                                        $aturan
                                    );

                                    preg_match(
                                        '/lama\s*:\s*([^|]+)/i',
                                        $aturanPakai,
                                        $lama
                                    );

                                    if (isset($dosis[1])) {
                                        $detail['dosis'] = trim($dosis[1]);
                                    }

                                    if (isset($frekuensi[1])) {
                                        $detail['frekuensi'] = trim($frekuensi[1]);
                                    }

                                    if (isset($aturan[1])) {
                                        $detail['aturan'] = trim($aturan[1]);
                                    }

                                    if (isset($lama[1])) {
                                        $detail['lama'] = trim($lama[1]);
                                    }

                                    if (
                                        !isset($dosis[1]) &&
                                        !isset($frekuensi[1]) &&
                                        !isset($aturan[1]) &&
                                        !isset($lama[1])
                                    ) {
                                        $detail['aturan'] = $aturanPakai;
                                    }
                                }

                                return $detail;
                            });

                            $totalResep = $detailObat->sum('subtotal');

                            $pasien = $resep->pemeriksaan?->pendaftaran?->pasien;

                            $namaPasien = $pasien?->nama ?? '-';

                            $namaDokter = $resep->pemeriksaan?->dokter?->nama ?? '-';
                        @endphp

                                <tr>

                                    <td>
                                        {{ $resepObats->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <span class="patient-name">
                                            {{ $namaPasien }}
                                        </span>
                                    </td>

                                    <td>{{ $namaDokter }}</td>

                                    <td>
                                        @foreach($detailObat as $detail)
                                            <div>
                                                <span class="medicine-badge">
                                                    {{ $detail['nama'] }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($detailObat as $detail)
                                            <div class="mb-1">
                                                {{ $detail['jumlah'] }} item
                                            </div>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($detailObat as $detail)
                                            <div class="mb-1">
                                                {{ $detail['cara'] }}
                                            </div>
                                        @endforeach
                                    </td>

                                    <td class="fw-bold">
                                        Rp {{ number_format($totalResep, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <span class="status-waiting">
                                            Menunggu Pembayaran
                                        </span>
                                    </td>

                                    <td>

                                        @if($detailObat->isEmpty() || $totalResep <= 0)

                                            <button class="btn btn-secondary btn-sm" disabled>
                                                Tidak tersedia
                                            </button>

                                        @else

                                            <button
                                                type="button"
                                                class="btn-process"
                                                data-bs-toggle="modal"
                                                data-bs-target="#paymentModal{{ $resep->id }}"
                                            >
                                                <i class="fa-solid fa-credit-card me-1"></i>
                                                Proses Bayar
                                            </button>

                                        @endif

                                    </td>

                                </tr>

                                {{-- MODAL PEMBAYARAN --}}
                                <div
                                    class="modal fade payment-modal"
                                    id="paymentModal{{ $resep->id }}"
                                    tabindex="-1"
                                    aria-hidden="true"
                                >

                                    <div class="modal-dialog modal-dialog-centered modal-xl">

                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title">
                                                    <i class="fa-solid fa-wallet me-2"></i>
                                                    Proses Pembayaran Resep
                                                </h5>

                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                ></button>

                                            </div>

                                            <div class="modal-body">

                                                {{-- IDENTITAS PASIEN --}}
                                                <div class="patient-summary">

                                                    <div class="patient-summary-item">

                                                        <div class="summary-icon">
                                                            <i class="fa-solid fa-user"></i>
                                                        </div>

                                                        <div>
                                                            <small>Pasien</small>
                                                            <strong>{{ $namaPasien }}</strong>
                                                            <span>
                                                                No. RM:
                                                                {{ $pasien?->no_rm ?? '-' }}
                                                            </span>
                                                        </div>

                                                    </div>

                                                    <div class="patient-summary-item">

                                                        <div class="summary-icon">
                                                            <i class="fa-solid fa-user-doctor"></i>
                                                        </div>

                                                        <div>
                                                            <small>Dokter</small>
                                                            <strong>{{ $namaDokter }}</strong>
                                                        </div>

                                                    </div>

                                                    <div class="patient-summary-item">

                                                        <div class="summary-icon">
                                                            <i class="fa-solid fa-calendar-days"></i>
                                                        </div>

                                                        <div>
                                                            <small>Tanggal Resep</small>
                                                            <strong>
                                                                {{ $resep->created_at?->format('d/m/Y') ?? '-' }}
                                                            </strong>
                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- DETAIL OBAT --}}
                                                <div class="detail-box">

                                                    <div class="detail-box-title">
                                                        <i class="fa-solid fa-pills"></i>
                                                        Detail Resep Obat
                                                    </div>

                                                    <div class="table-responsive">

                                                        <table class="table detail-table">

                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Nama Obat</th>
                                                                    <th>Dosis</th>
                                                                    <th>Frekuensi</th>
                                                                    <th>Aturan</th>
                                                                    <th>Lama</th>
                                                                    <th>Harga</th>
                                                                    <th>Subtotal</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                @foreach($detailObat as $nomor => $detail)

                                                                    <tr>

                                                                        <td>{{ $nomor + 1 }}</td>

                                                                        <td class="fw-bold">
                                                                            {{ $detail['nama'] }}
                                                                        </td>

                                                                        <td>{{ $detail['dosis'] }}</td>

                                                                        <td>{{ $detail['frekuensi'] }}</td>

                                                                        <td>{{ $detail['aturan'] }}</td>

                                                                        <td>{{ $detail['lama'] }}</td>

                                                                        <td>
                                                                            Rp {{ number_format($detail['harga'], 0, ',', '.') }}
                                                                        </td>

                                                                        <td class="fw-bold">
                                                                            Rp {{ number_format($detail['subtotal'], 0, ',', '.') }}
                                                                        </td>

                                                                    </tr>

                                                                @endforeach

                                                            </tbody>

                                                        </table>

                                                    </div>

                                                </div>

                                                {{-- TOTAL --}}
                                                <div class="total-bar">

                                                    <span>Total Pembayaran :</span>

                                                    <strong>
                                                        Rp {{ number_format($totalResep, 0, ',', '.') }}
                                                    </strong>

                                                </div>

                                                {{-- FORM PEMBAYARAN --}}
                                                <form
                                                    action="{{ route('kasir.pembayaran.proses', $resep->id) }}"
                                                    method="POST"
                                                    class="payment-form"
                                                    data-total="{{ $totalResep }}"
                                                >

                                                    @csrf

                                                    <div class="method-section-title">
                                                        <i class="fa-solid fa-credit-card me-2"></i>
                                                        Metode Pembayaran
                                                    </div>

                                                    <div class="method-grid">

                                                        {{-- CASH --}}
                                                        <label class="method-option">

                                                            <span class="method-icon">
                                                                <i class="fa-solid fa-money-bill-wave"></i>
                                                            </span>

                                                            <span class="method-description">
                                                                <strong>Tunai</strong>
                                                                <small>Bayar dengan uang tunai</small>
                                                            </span>

                                                            <input
                                                                type="radio"
                                                                name="metode_pembayaran"
                                                                value="Cash"
                                                                required
                                                            >

                                                            <span class="method-check">
                                                                <i class="fa-solid fa-check"></i>
                                                            </span>

                                                        </label>

                                                        {{-- QRIS --}}
                                                        <label class="method-option">

                                                            <span class="method-icon">
                                                                <i class="fa-solid fa-qrcode"></i>
                                                            </span>

                                                            <span class="method-description">
                                                                <strong>QRIS</strong>
                                                                <small>Scan QR Code</small>
                                                            </span>

                                                            <input
                                                                type="radio"
                                                                name="metode_pembayaran"
                                                                value="QRIS"
                                                                required
                                                            >

                                                            <span class="method-check">
                                                                <i class="fa-solid fa-check"></i>
                                                            </span>

                                                        </label>

                                                        {{-- TRANSFER --}}
                                                        <label class="method-option">

                                                            <span class="method-icon">
                                                                <i class="fa-solid fa-building-columns"></i>
                                                            </span>

                                                            <span class="method-description">
                                                                <strong>Transfer</strong>
                                                                <small>Transfer via Bank</small>
                                                            </span>

                                                            <input
                                                                type="radio"
                                                                name="metode_pembayaran"
                                                                value="Transfer Bank"
                                                                required
                                                            >

                                                            <span class="method-check">
                                                                <i class="fa-solid fa-check"></i>
                                                            </span>

                                                        </label>

                                                    </div>

                                                    {{-- PANEL CASH --}}
                                                    <div class="method-panel hidden" data-panel="cash">

                                                        <label class="form-label">
                                                            Uang Diterima (Rp)
                                                        </label>

                                                        <input
                                                            type="number"
                                                            name="uang_diterima"
                                                            class="form-control cash-input"
                                                            min="0"
                                                            step="1"
                                                            placeholder="Masukkan uang dari pasien"
                                                        >

                                                        <div class="cash-change">

                                                            <small>Kembalian</small>

                                                            <div class="fw-bold change-value">
                                                                Rp 0
                                                            </div>

                                                        </div>

                                                    </div>

                                                    {{-- PANEL QRIS --}}
                                                    <div class="method-panel qris-panel hidden" data-panel="qris">

                                                        <h6 class="fw-bold text-primary">
                                                            <i class="fa-solid fa-qrcode me-2"></i>
                                                            Pembayaran QRIS
                                                        </h6>

                                                        <p class="small text-muted">
                                                            Scan QR Code berikut menggunakan aplikasi pembayaran.
                                                        </p>

                                                        <div class="qris-image-frame">

                                                            <img
                                                                src="{{ asset('images/qris.jpeg') }}"
                                                                alt="QRIS Rumah Sakit"
                                                                onerror="
                                                                    this.style.display='none';
                                                                    this.nextElementSibling.classList.remove('hidden');
                                                                "
                                                            >

                                                            <div class="qris-image-error hidden">
                                                                <i class="fa-solid fa-image fa-2x"></i>
                                                                <br>
                                                                Gambar QRIS belum tersedia.
                                                            </div>

                                                        </div>

                                                        <div class="fw-bold text-primary">
                                                            Total:
                                                            Rp {{ number_format($totalResep, 0, ',', '.') }}
                                                        </div>

                                                        <div class="small text-muted mt-2">
                                                            Pembayaran akan menunggu verifikasi kasir.
                                                        </div>

                                                    </div>

                                                    {{-- PANEL TRANSFER --}}
                                                    <div class="method-panel hidden" data-panel="transfer">

                                                        <h6 class="fw-bold mb-3">
                                                            Detail Transfer Bank
                                                        </h6>

                                                        <label class="form-label">
                                                            Pilih Bank
                                                        </label>

                                                        <select class="form-select">
                                                            <option value="">Pilih bank</option>
                                                            <option>BCA</option>
                                                            <option>BRI</option>
                                                            <option>BNI</option>
                                                            <option>Mandiri</option>
                                                            <option>BSI</option>
                                                        </select>

                                                        <div class="alert alert-info small mt-3 mb-0">
                                                            Pembayaran transfer akan menunggu verifikasi kasir.
                                                        </div>

                                                    </div>

                                                    {{-- FOOTER MODAL --}}
                                                    <div class="modal-footer-custom">

                                                        <div class="info-payment">

                                                            <i class="fa-solid fa-circle-info fa-lg"></i>

                                                            <span>
                                                                Pastikan pembayaran sesuai dengan total
                                                                sebelum melanjutkan proses.
                                                            </span>

                                                        </div>

                                                        <div class="modal-actions">

                                                            <button
                                                                type="button"
                                                                class="btn-cancel"
                                                                data-bs-dismiss="modal"
                                                            >
                                                                <i class="fa-solid fa-xmark me-1"></i>
                                                                Batal
                                                            </button>

                                                            <button
                                                                type="submit"
                                                                class="btn-submit"
                                                            >
                                                                <i class="fa-solid fa-check me-1"></i>
                                                                Bayar Sekarang
                                                            </button>

                                                        </div>

                                                    </div>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <tr>
                                    <td colspan="9" class="empty-state">

                                        <i class="fa-solid fa-file-invoice-dollar"></i>

                                        <strong>Belum Ada Resep</strong>

                                        <div class="mt-2">
                                            Belum ada resep yang menunggu pembayaran.
                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if($resepObats->hasPages())
                    <div class="pagination-wrapper">
                        {{ $resepObats->links() }}
                    </div>
                @endif

            </section>

            {{-- RIWAYAT PEMBAYARAN --}}
            <section class="payment-card">

                <div class="card-heading">

                    <h5>
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        Riwayat Pembayaran
                    </h5>

                    <span class="data-count">
                        {{ $riwayatPembayaran->total() }} Data
                    </span>

                </div>

                <div class="table-responsive">

                    <table class="table payment-table">

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

                            @forelse($riwayatPembayaran as $index => $bayar)

                                @php
                                    $namaPasienRiwayat =
                                        $bayar->resep?->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-';

                                    $namaDokterRiwayat =
                                        $bayar->resep?->pemeriksaan?->dokter?->nama ?? '-';
                                @endphp

                                <tr>

                                    <td>
                                        {{ $riwayatPembayaran->firstItem() + $index }}
                                    </td>

                                    <td class="patient-name">
                                        {{ $namaPasienRiwayat }}
                                    </td>

                                    <td>
                                        {{ $namaDokterRiwayat }}
                                    </td>

                                    <td>
                                        {{ $bayar->created_at?->format('d/m/Y') ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="medicine-badge">
                                            {{ $bayar->metode_pembayaran }}
                                        </span>
                                    </td>

                                    <td>

                                        @if(strtoupper($bayar->status ?? '') === 'LUNAS')

                                            <span class="status-paid">
                                                Pembayaran Berhasil
                                            </span>

                                        @elseif(strtoupper($bayar->status ?? '') === 'MENUNGGU VERIFIKASI')

                                            <span class="status-verification">
                                                Menunggu Verifikasi
                                            </span>

                                        @else

                                            <span class="status-waiting">
                                                {{ $bayar->status ?? '-' }}
                                            </span>

                                        @endif

                                    </td>

                                    <td class="fw-bold">
                                        Rp {{ number_format((float) $bayar->total_pembayaran, 0, ',', '.') }}
                                    </td>

                                    <td>

                                        <button
                                            type="button"
                                            class="btn-detail"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailRiwayat{{ $bayar->id }}"
                                        >
                                            <i class="fa-solid fa-eye me-1"></i>
                                            Detail
                                        </button>

                                    </td>

                                </tr>

                                {{-- MODAL DETAIL RIWAYAT --}}
                                <div
                                    class="modal fade history-modal"
                                    id="detailRiwayat{{ $bayar->id }}"
                                    tabindex="-1"
                                    aria-hidden="true"
                                >

                                    <div class="modal-dialog modal-dialog-centered">

                                        <div class="modal-content">

                                            <div class="modal-header bg-primary text-white">

                                                <h5 class="modal-title fw-bold">
                                                    <i class="fa-solid fa-receipt me-2"></i>
                                                    Detail Pembayaran
                                                </h5>

                                                <button
                                                    type="button"
                                                    class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"
                                                ></button>

                                            </div>

                                            <div class="modal-body p-4">

                                                <div class="mb-3">
                                                    <small class="text-muted">Nama Pasien</small>
                                                    <div class="fw-bold">
                                                        {{ $namaPasienRiwayat }}
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <small class="text-muted">Dokter</small>
                                                    <div class="fw-bold">
                                                        {{ $namaDokterRiwayat }}
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <small class="text-muted">Tanggal Pembayaran</small>
                                                    <div class="fw-bold">
                                                        {{ $bayar->created_at?->format('d/m/Y H:i') ?? '-' }}
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <small class="text-muted">Metode Pembayaran</small>
                                                    <div class="fw-bold">
                                                        {{ $bayar->metode_pembayaran }}
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <small class="text-muted">Status</small>
                                                    <div class="fw-bold">
                                                        {{ $bayar->status }}
                                                    </div>
                                                </div>

                                                <div class="p-3 rounded-3 bg-light">
                                                    <small class="text-muted">
                                                        Total Pembayaran
                                                    </small>

                                                    <div class="fs-4 fw-bold text-primary">
                                                        Rp {{ number_format((float) $bayar->total_pembayaran, 0, ',', '.') }}
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Tutup
                                                </button>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @empty

                                <tr>
                                    <td colspan="8" class="empty-state">

                                        <i class="fa-solid fa-clock-rotate-left"></i>

                                        <strong>Belum Ada Riwayat Pembayaran</strong>

                                        <div class="mt-2">
                                            Transaksi pembayaran akan muncul di sini.
                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                @if($riwayatPembayaran->hasPages())
                    <div class="pagination-wrapper">
                        {{ $riwayatPembayaran->links() }}
                    </div>
                @endif

            </section>

        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // FORMAT RUPIAH
            function rupiah(angka) {
                return 'Rp ' + new Intl.NumberFormat('id-ID', {
                    maximumFractionDigits: 0
                }).format(angka || 0);
            }

            // SETIAP MODAL PEMBAYARAN
            document.querySelectorAll('.payment-modal').forEach(function (modal) {

                const form = modal.querySelector('.payment-form');

                if (!form) return;

                const total = Number(form.dataset.total) || 0;

                const cashInput = form.querySelector('.cash-input');

                const changeValue = form.querySelector('.change-value');

                const panels = form.querySelectorAll('.method-panel');

                const radios = form.querySelectorAll(
                    'input[name="metode_pembayaran"]'
                );

                // HITUNG KEMBALIAN
                function hitungKembalian() {

                    const uang = Number(cashInput.value) || 0;

                    const kembalian = Math.max(uang - total, 0);

                    changeValue.textContent = rupiah(kembalian);
                }

                // GANTI METODE PEMBAYARAN
                function updateMetode() {

                    panels.forEach(function (panel) {
                        panel.classList.add('hidden');
                    });

                    const selected = form.querySelector(
                        'input[name="metode_pembayaran"]:checked'
                    );

                    if (!selected) return;

                    if (selected.value === 'Cash') {

                        const panel = form.querySelector('[data-panel="cash"]');

                        panel.classList.remove('hidden');

                        cashInput.required = true;

                    } else {

                        cashInput.required = false;

                        cashInput.value = '';

                        hitungKembalian();

                        if (selected.value === 'QRIS') {

                            form.querySelector('[data-panel="qris"]')
                                .classList.remove('hidden');

                        } else if (selected.value === 'Transfer Bank') {

                            form.querySelector('[data-panel="transfer"]')
                                .classList.remove('hidden');

                        }
                    }
                }

                radios.forEach(function (radio) {
                    radio.addEventListener('change', updateMetode);
                });

                cashInput.addEventListener('input', hitungKembalian);

                // RESET KETIKA MODAL DIBUKA
                modal.addEventListener('show.bs.modal', function () {

                    form.reset();

                    panels.forEach(function (panel) {
                        panel.classList.add('hidden');
                    });

                    cashInput.required = false;

                    changeValue.textContent = rupiah(0);

                });

            });

        });
    </script>

</body>
</html>
