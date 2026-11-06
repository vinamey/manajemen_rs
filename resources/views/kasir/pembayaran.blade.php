
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pembayaran Obat - Kasir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #edf5ff;
            --bg: #f4f6fa;
            --text: #374151;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 200px;
            background: var(--blue);
            color: white;
            z-index: 1000;
        }

        .logo {
            height: 68px;
            display: flex;
            align-items: center;
            padding: 0 20px;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #ffffff30;
        }

        .logo i {
            margin-right: 10px;
        }

        .menu {
            padding: 18px 10px;
        }

        .menu-title {
            padding: 0 10px;
            margin-bottom: 10px;
            font-size: 10px;
            opacity: .75;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            margin-bottom: 5px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            font-size: 13px;
        }

        .menu a:hover,
        .menu a.active {
            background: #ffffff2b;
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        .logout-area {
            position: absolute;
            bottom: 12px;
            width: 100%;
            padding: 0 12px;
        }

        .logout-btn {
            width: 100%;
            border: none;
            border-radius: 8px;
            background: white;
            color: #dc3545;
            padding: 10px;
            font-weight: bold;
        }

        /* KONTEN */
        .content {
            margin-left: 200px;
            min-height: 100vh;
        }

        .topbar {
            height: 68px;
            padding: 0 24px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-title {
            font-size: 14px;
            font-weight: bold;
        }

        .user-info {
            font-size: 13px;
            color: #555;
        }

        .page {
            padding: 25px;
        }

        .page-title {
            margin-bottom: 5px;
            color: var(--blue);
            font-size: 25px;
            font-weight: bold;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .page-header {
            padding: 22px;
            margin-bottom: 22px;
            border-radius: 12px;
            color: white;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
        }

        .page-header h4 {
            font-weight: bold;
            margin: 0;
        }

        .page-header p {
            margin: 7px 0 0;
            font-size: 13px;
        }

        /* KARTU TABEL */
        .payment-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 22px;
        }

        .card-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
        }

        .card-heading h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .payment-table {
            margin: 0;
            min-width: 1000px;
        }

        .payment-table thead th {
            padding: 14px;
            background: #edf5ff;
            color: #31557f;
            font-size: 12px;
            white-space: nowrap;
            border-bottom: 1px solid #dce8f8;
        }

        .payment-table tbody td {
            padding: 14px;
            font-size: 13px;
            vertical-align: middle;
        }

        .patient-name {
            color: var(--blue);
            font-weight: bold;
        }

        .medicine-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 6px;
            background: var(--blue-light);
            color: var(--blue-dark);
            font-size: 11px;
        }

        .quantity-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 6px;
            background: #e9f9ef;
            color: #16834b;
            font-size: 11px;
        }

        .medicine-detail {
            margin-bottom: 5px;
            white-space: nowrap;
        }

        .detail-badge {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
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

        .empty-state {
            padding: 38px 15px;
            text-align: center;
            color: #6b7280;
        }

        .empty-state i {
            display: block;
            margin-bottom: 12px;
            color: #b8c8dc;
            font-size: 38px;
        }

        .pagination-wrapper {
            padding: 15px 20px;
            border-top: 1px solid #edf0f4;
        }

        /* MODAL */
        .payment-backdrop {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background: rgba(9, 20, 43, .58);
            backdrop-filter: blur(4px);
        }

        .payment-backdrop.show {
            display: flex;
        }

        .payment-modal {
            width: 100%;
            max-width: 490px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border-radius: 14px;
            background: white;
            box-shadow: 0 24px 70px #071b3b45;
            animation: modalIn .18s ease-out;
        }

        @keyframes modalIn {
            from {
                opacity: 0;
                transform: translateY(10px) scale(.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .payment-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 22px;
            color: white;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
        }

        .payment-modal-header h5 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .payment-modal-header small {
            display: block;
            margin-top: 5px;
        }

        .modal-close {
            border: none;
            background: transparent;
            color: white;
            font-size: 24px;
        }

        .payment-modal-body {
            padding: 22px;
            overflow-y: auto;
        }

        .summary-box {
            padding: 16px;
            margin-bottom: 20px;
            border: 1px solid #dce8f8;
            border-radius: 10px;
            background: #f4f8ff;
        }

        .summary-label {
            color: #64748b;
            font-size: 12px;
        }

        .summary-total {
            margin: 5px 0 15px;
            color: var(--blue-dark);
            font-size: 27px;
            font-weight: 800;
            overflow-wrap: anywhere;
        }

        .form-label {
            margin-bottom: 7px;
            font-size: 13px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            min-height: 43px;
            border-color: #dce3ed;
            border-radius: 8px;
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px #1877f220;
        }

        .method-title {
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: bold;
        }

        .method-option {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px;
            margin-bottom: 9px;
            border: 1px solid #dce3ed;
            border-radius: 10px;
            cursor: pointer;
        }

        .method-option:has(input:checked) {
            border-color: var(--blue);
            background: var(--blue-light);
            box-shadow: 0 0 0 1px var(--blue);
        }

        .method-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #f0f6ff;
            color: var(--blue);
            font-size: 19px;
        }

        .method-description {
            flex: 1;
        }

        .method-description strong {
            font-size: 13px;
        }

        .method-description small {
            color: #6b7280;
            font-size: 11px;
        }

        .method-option input {
            width: 17px;
            height: 17px;
            accent-color: var(--blue);
        }

        .method-panel {
            margin-top: 14px;
            padding: 15px;
            border: 1px solid #dce8f8;
            border-radius: 10px;
            background: #f8fbff;
        }

        .hidden {
            display: none !important;
        }

        /* QRIS KHUSUS */
        #panelQris {
            padding: 20px;
            border: 1px solid #cfe2ff;
            border-radius: 13px;
            background: linear-gradient(180deg, #f8fbff, #edf5ff);
            color: #334155;
            text-align: center;
        }

        .qris-heading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            color: var(--blue-dark);
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .qris-description {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 15px;
        }

        .qris-merchant {
            display: inline-block;
            padding: 6px 13px;
            margin-bottom: 15px;
            border-radius: 20px;
            background: #dcecff;
            color: #175bb2;
            font-size: 11px;
            font-weight: bold;
        }

        .qris-image-wrapper {
            display: flex;
            justify-content: center;
            margin: 5px auto 18px;
        }

        .qris-image-frame {
            width: 245px;
            height: 245px;
            padding: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: white;
            border: 2px solid #b9d6ff;
            border-radius: 13px;
            box-shadow: 0 5px 18px rgba(24, 119, 242, .12);
        }

        .qris-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .qris-total-box {
            padding: 12px;
            margin-bottom: 12px;
            background: white;
            border: 1px solid #dce8f8;
            border-radius: 9px;
            text-align: left;
        }

        .qris-total-box label {
            display: block;
            margin-bottom: 5px;
            color: #64748b;
            font-size: 11px;
        }

        .qris-total-box input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: var(--blue-dark);
            font-size: 19px;
            font-weight: bold;
        }

        .qris-information {
            padding: 11px;
            border-radius: 8px;
            background: #fff5d9;
            border: 1px solid #ffe4a3;
            color: #8a6418;
            font-size: 11px;
            text-align: left;
            line-height: 1.6;
        }

        .qris-information i {
            margin-right: 5px;
        }

        .btn-qris {
            width: 100%;
            min-height: 46px;
            margin-top: 14px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            color: white;
            font-weight: bold;
            font-size: 13px;
            box-shadow: 0 5px 14px #1877f233;
        }

        .btn-qris:hover {
            background: var(--blue-dark);
        }

        .btn-qris:disabled {
            opacity: .65;
        }

        /* CASH */
        .change-box {
            margin-top: 12px;
            padding: 12px;
            border-radius: 9px;
            background: #e9f9ef;
            color: #16834b;
        }

        /* TRANSFER */
        .payment-note {
            margin-top: 12px;
            font-size: 11px;
            line-height: 1.5;
            color: #64748b;
        }

        .btn-pay {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            min-height: 46px;
            margin-top: 20px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            color: white;
            font-size: 14px;
            font-weight: bold;
            box-shadow: 0 5px 14px #1877f233;
        }

        .btn-pay:hover {
            color: white;
            background: var(--blue-dark);
        }

        .btn-pay:disabled {
            opacity: .65;
            cursor: not-allowed;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {

            .sidebar {
                width: 65px;
            }

            .logo {
                padding-left: 20px;
                font-size: 0;
            }

            .logo i {
                font-size: 20px;
            }

            .menu-title,
            .menu a span {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 12px 5px;
            }

            .logout-btn {
                font-size: 0;
            }

            .logout-btn i {
                font-size: 14px;
                margin: 0 !important;
            }

            .content {
                margin-left: 65px;
            }

            .page {
                padding: 18px 12px;
            }

            .topbar {
                padding: 0 12px;
            }
        }

        @media (max-width: 480px) {

            .payment-backdrop {
                padding: 8px;
            }

            .payment-modal {
                max-height: 95vh;
            }

            .payment-modal-body {
                padding: 15px;
            }

            .payment-modal-header {
                padding: 15px;
            }

            .summary-total {
                font-size: 24px;
            }

            .qris-image-frame {
                width: 220px;
                height: 220px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-hospital"></i> SIM RS
        </div>

        <nav class="menu">

            <div class="menu-title">Menu Kasir</div>

            <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

           

            <a href="{{ route('kasir.pembayaran') }}" class="active">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Pembayaran Obat</span>
            </a>

        </nav>

        <div class="logout-area">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Logout
                </button>

            </form>

        </div>

    </aside>


    {{-- KONTEN --}}
    <main class="content">

        <header class="topbar">

            <div class="topbar-title">
                Pembayaran Obat
            </div>

            <div class="user-info">
                <i class="fa-solid fa-user me-2"></i>
                {{ auth()->user()->name }}
            </div>

        </header>


        <div class="page">

            <h3 class="page-title">
                Pembayaran Obat
            </h3>

            <div class="page-subtitle">
                Kelola pembayaran resep obat pasien dan riwayat transaksi.
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
                <div class="alert alert-danger">

                    <strong>Pembayaran belum berhasil:</strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif


            {{-- HEADER --}}
            <section class="page-header">

                <h4>
                    <i class="fa-solid fa-wallet me-2"></i>
                    Pembayaran Obat Pasien
                </h4>

                <p>
                    Pilih resep pasien, lalu proses pembayaran menggunakan metode yang tersedia.
                </p>

            </section>


            {{-- DAFTAR RESEP --}}
            <section class="payment-card">

                <div class="card-heading">

                    <h5>
                        <i class="fa-solid fa-receipt text-primary me-2"></i>
                        Daftar Resep untuk Pembayaran
                    </h5>

                    <span class="badge text-bg-primary">
                        {{ $resepObats->total() }} resep
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table payment-table mb-0">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Dosis</th>
                                <th>Frekuensi</th>
                                <th>Aturan</th>
                                <th>Lama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($resepObats as $index => $resep)

                                @php

                                    $detailObat = $resep->obat->map(function ($obat) {

                                        $aturanPakai = trim((string) ($obat->pivot->aturan_pakai ?? ''));

                                        $detail = [
                                            'dosis' => '-',
                                            'frekuensi' => '-',
                                            'aturan' => '-',
                                            'lama' => '-',
                                        ];

                                        if ($aturanPakai !== '') {

                                            preg_match('/dosis\s*:\s*([^|]+)/i', $aturanPakai, $dosis);

                                            preg_match('/frekuensi\s*:\s*([^|]+)/i', $aturanPakai, $frekuensi);

                                            preg_match('/aturan(?:\s+pakai)?\s*:\s*([^|]+)/i', $aturanPakai, $aturan);

                                            preg_match('/lama\s*:\s*([^|]+)/i', $aturanPakai, $lama);

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

                                @endphp


                                <tr>

                                    <td>
                                        {{ $resepObats->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <span class="patient-name">
                                            {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}
                                    </td>

                                    <td>

                                        @forelse($resep->obat as $obat)

                                            <div class="medicine-detail">
                                                <span class="medicine-badge">
                                                    {{ $obat->nama }}
                                                </span>
                                            </div>

                                        @empty
                                            -
                                        @endforelse

                                    </td>

                                    <td>

                                        @forelse($resep->obat as $obat)

                                            <div class="medicine-detail">
                                                <span class="quantity-badge">
                                                    {{ $obat->pivot->nilai ?? '-' }}
                                                </span>
                                            </div>

                                        @empty
                                            -
                                        @endforelse

                                    </td>

                                    <td>

                                        @forelse($detailObat as $detail)

                                            <div class="medicine-detail">
                                                <span class="detail-badge">
                                                    {{ $detail['dosis'] }}
                                                </span>
                                            </div>

                                        @empty
                                            -
                                        @endforelse

                                    </td>

                                    <td>

                                        @forelse($detailObat as $detail)

                                            <div class="medicine-detail">
                                                <span class="detail-badge">
                                                    {{ $detail['frekuensi'] }}
                                                </span>
                                            </div>

                                        @empty
                                            -
                                        @endforelse

                                    </td>

                                    <td>

                                        @forelse($detailObat as $detail)

                                            <div class="medicine-detail">
                                                <span class="detail-badge">
                                                    {{ $detail['aturan'] }}
                                                </span>
                                            </div>

                                        @empty
                                            -
                                        @endforelse

                                    </td>

                                    <td>

                                        @forelse($detailObat as $detail)

                                            <div class="medicine-detail">
                                                <span class="detail-badge">
                                                    {{ $detail['lama'] }}
                                                </span>
                                            </div>

                                        @empty
                                            -
                                        @endforelse

                                    </td>

                                    <td>

                                        @if($resep->obat->isEmpty())

                                            <button type="button" class="btn btn-secondary btn-sm" disabled>
                                                Tidak Ada Obat
                                            </button>

                                        @else

                                            <button
                                                type="button"
                                                class="btn-process"
                                                data-open-payment
                                                data-resep-id="{{ $resep->id }}"
                                                data-pasien="{{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}"
                                            >
                                                <i class="fa-solid fa-credit-card me-1"></i>
                                                Proses Bayar
                                            </button>

                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="10">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-file-invoice-dollar"></i>

                                            <h6>Belum Ada Resep</h6>

                                            <p class="mb-0">
                                                Belum ada resep obat yang dapat diproses untuk pembayaran.
                                            </p>

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
                        <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i>
                        Riwayat Pembayaran
                    </h5>

                    <span class="badge text-bg-primary">
                        {{ $riwayatPembayaran->total() }} transaksi
                    </span>

                </div>


                <div class="table-responsive">

                    <table class="table payment-table mb-0">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Total</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($riwayatPembayaran as $index => $bayar)

                                <tr>

                                    <td>
                                        {{ $riwayatPembayaran->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <span class="patient-name">
                                            {{ $bayar->resep?->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $bayar->resep?->pemeriksaan?->dokter?->nama ?? '-' }}
                                    </td>

                                    <td class="fw-bold">
                                        Rp{{ number_format((float) $bayar->total_pembayaran, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        <span class="medicine-badge">
                                            {{ $bayar->metode_pembayaran ?? '-' }}
                                        </span>
                                    </td>

                                    <td>

                                        @if(strtoupper($bayar->status ?? '') === 'LUNAS')

                                            <span class="badge text-bg-success">
                                                Lunas
                                            </span>

                                        @elseif(strtoupper($bayar->status ?? '') === 'MENUNGGU VERIFIKASI')

                                            <span class="badge text-bg-warning">
                                                Menunggu Verifikasi
                                            </span>

                                        @else

                                            <span class="badge text-bg-secondary">
                                                {{ $bayar->status ?? '-' }}
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $bayar->created_at?->format('d-m-Y H:i') ?? '-' }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-receipt"></i>

                                            <h6>Belum Ada Riwayat Pembayaran</h6>

                                            <p class="mb-0">
                                                Transaksi yang tercatat akan tampil di sini.
                                            </p>

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


    {{-- MODAL PEMBAYARAN --}}
    <div class="payment-backdrop" id="paymentBackdrop" aria-hidden="true">

        <section class="payment-modal" role="dialog" aria-modal="true">

            <header class="payment-modal-header">

                <div>

                    <h5>
                        <i class="fa-solid fa-wallet me-2"></i>
                        Pembayaran Pasien
                    </h5>

                    <small id="namaPasienPanel">
                        Pilih metode pembayaran
                    </small>

                </div>

                <button
                    type="button"
                    class="modal-close"
                    id="tutupPembayaran"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>

            </header>


            <div class="payment-modal-body">

                <form id="formPembayaran" method="POST">

                    @csrf


                    {{-- TOTAL --}}
                    <div class="summary-box">

                        <div class="summary-label">
                            Total Pembayaran
                        </div>

                        <div class="summary-total" id="tampilanTotal">
                            Rp0
                        </div>

                        <label for="total_pembayaran" class="form-label">
                            Jumlah tagihan (Rp)
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="total_pembayaran"
                            name="total_pembayaran"
                            min="1"
                            step="1"
                            placeholder="Contoh: 50000"
                            required
                        >

                        <small class="text-muted">
                            Masukkan total tagihan sesuai harga obat.
                        </small>

                    </div>


                    {{-- PILIH METODE --}}
                    <div class="method-title">
                        Pilih Metode Pembayaran
                    </div>


                    {{-- CASH --}}
                    <label class="method-option">

                        <span class="method-icon">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </span>

                        <span class="method-description">
                            <strong>Cash / Tunai</strong><br>
                            <small>Bayar langsung ke kasir</small>
                        </span>

                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="Cash"
                            required
                        >

                    </label>


                    {{-- QRIS --}}
                    <label class="method-option">

                        <span class="method-icon">
                            <i class="fa-solid fa-qrcode"></i>
                        </span>

                        <span class="method-description">
                            <strong>QRIS</strong><br>
                            <small>Pembayaran melalui kode QR</small>
                        </span>

                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="QRIS"
                            required
                        >

                    </label>


                    {{-- TRANSFER BANK --}}
                    <label class="method-option">

                        <span class="method-icon">
                            <i class="fa-solid fa-building-columns"></i>
                        </span>

                        <span class="method-description">
                            <strong>Transfer Bank</strong><br>
                            <small>Pembayaran melalui rekening bank</small>
                        </span>

                        <input
                            type="radio"
                            name="metode_pembayaran"
                            value="Transfer Bank"
                            required
                        >

                    </label>


                    {{-- DETAIL CASH --}}
                    <div id="panelCash" class="method-panel hidden">

                        <h6 class="fw-bold mb-3">
                            Pembayaran Tunai
                        </h6>

                        <label for="uangDiterima" class="form-label">
                            Uang diterima (Rp)
                        </label>

                        <input
                            type="number"
                            class="form-control"
                            id="uangDiterima"
                            name="uang_diterima"
                            min="0"
                            step="1"
                            placeholder="Masukkan uang dari pasien"
                        >

                        <div class="change-box">

                            <div class="small">
                                Kembalian
                            </div>

                            <strong id="nilaiKembalian">
                                Rp0
                            </strong>

                        </div>

                    </div>


                    {{-- DETAIL QRIS --}}
                    <div id="panelQris" class="method-panel hidden">

                        <div class="qris-heading">
                            <i class="fa-solid fa-qrcode"></i>
                            Pembayaran QRIS
                        </div>

                        <div class="qris-description">
                            Scan QR Code berikut untuk melakukan pembayaran.
                        </div>

                        <div class="qris-merchant">
                            <i class="fa-solid fa-hospital me-1"></i>
                            QRIS RUMAH SAKIT
                        </div>

                        {{-- GAMBAR QRIS --}}
                        <div class="qris-image-wrapper">

                            <div class="qris-image-frame">

                                <img
                                    src="{{ asset('images/qris.jpeg') }}"
                                    alt="QRIS Rumah Sakit"
                                    class="qris-image"
                                    id="gambarQris"
                                    onerror="
                                        this.classList.add('hidden');
                                        document.getElementById('qrisError').classList.remove('hidden');
                                    "
                                >

                                <div id="qrisError" class="hidden text-center text-danger small">
                                    <i class="fa-solid fa-image fa-2x mb-2"></i>
                                    <br>
                                    Gambar QRIS belum tersedia.
                                </div>

                            </div>

                        </div>

                        {{-- JUMLAH --}}
                        <div class="qris-total-box">

                            <label>Jumlah pembayaran</label>

                            <input
                                type="text"
                                id="qrisJumlah"
                                value="Rp0"
                                readonly
                            >

                        </div>

                        {{-- INFORMASI --}}
                        <div class="qris-information">

                            <i class="fa-solid fa-circle-info"></i>

                            Silakan scan QRIS menggunakan aplikasi pembayaran
                            yang mendukung QRIS. Transaksi akan menunggu
                            verifikasi kasir sebelum dinyatakan lunas.

                        </div>

                        {{-- TOMBOL QRIS --}}
                        <button
                            type="submit"
                            class="btn-qris"
                            id="tombolQris"
                        >
                            <i class="fa-solid fa-qrcode me-2"></i>
                            Bayar via QRIS
                        </button>

                    </div>


                    {{-- DETAIL TRANSFER --}}
                    <div id="panelTransfer" class="method-panel hidden">

                        <h6 class="fw-bold mb-3">
                            Detail Transfer Bank
                        </h6>

                        <label for="namaBank" class="form-label">
                            Pilih Bank
                        </label>

                        <select id="namaBank" class="form-select mb-3">

                            <option value="">
                                Pilih bank
                            </option>

                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BSI">BSI</option>

                        </select>

                        <div class="alert alert-info small mb-0">
                            Transfer akan menunggu verifikasi kasir sebelum
                            dinyatakan lunas. Jangan memasukkan PIN atau
                            password rekening pasien.
                        </div>

                    </div>


                    <p class="payment-note">
                        Cash dicatat lunas setelah konfirmasi berhasil.
                        QRIS dan transfer dicatat menunggu verifikasi.
                        Halaman ini belum terhubung ke layanan pembayaran otomatis.
                    </p>


                    {{-- TOMBOL CASH DAN TRANSFER --}}
                    <button
                        type="submit"
                        class="btn-pay"
                        id="tombolBayar"
                    >
                        <i class="fa-solid fa-lock"></i>
                        Bayar Sekarang
                    </button>

                </form>

            </div>

        </section>

    </div>


    {{-- JAVASCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        const backdrop = document.getElementById('paymentBackdrop');

        const form = document.getElementById('formPembayaran');

        const totalInput = document.getElementById('total_pembayaran');

        const uangInput = document.getElementById('uangDiterima');

        const totalText = document.getElementById('tampilanTotal');

        const kembalianText = document.getElementById('nilaiKembalian');

        const qrisJumlah = document.getElementById('qrisJumlah');

        const tombolBayar = document.getElementById('tombolBayar');

        const tombolQris = document.getElementById('tombolQris');


        // FORMAT RUPIAH
        function rupiah(angka) {

            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(angka || 0);

        }


        // UPDATE TOTAL
        function updateTotal() {

            const total = Number(totalInput.value) || 0;

            totalText.textContent = rupiah(total);

            qrisJumlah.value = rupiah(total);

            updateKembalian();

        }


        // HITUNG KEMBALIAN
        function updateKembalian() {

            const total = Number(totalInput.value) || 0;

            const uang = Number(uangInput.value) || 0;

            kembalianText.textContent = rupiah(
                Math.max(uang - total, 0)
            );

        }


        // PILIH METODE
        function updateMetode() {

            const cash = document.getElementById('panelCash');

            const qris = document.getElementById('panelQris');

            const transfer = document.getElementById('panelTransfer');

            cash.classList.add('hidden');

            qris.classList.add('hidden');

            transfer.classList.add('hidden');

            uangInput.required = false;

            tombolBayar.classList.remove('hidden');

            tombolQris.disabled = false;

            const metode = document.querySelector(
                'input[name="metode_pembayaran"]:checked'
            );

            if (!metode) return;


            // CASH
            if (metode.value === 'Cash') {

                cash.classList.remove('hidden');

                uangInput.required = true;

            }


            // QRIS
            else if (metode.value === 'QRIS') {

                qris.classList.remove('hidden');

                tombolBayar.classList.add('hidden');

                qrisJumlah.value = rupiah(
                    Number(totalInput.value) || 0
                );

            }


            // TRANSFER
            else if (metode.value === 'Transfer Bank') {

                transfer.classList.remove('hidden');

            }

        }


        // BUKA MODAL
        function bukaModal(tombol) {

            const resepId = tombol.dataset.resepId;

            const pasien = tombol.dataset.pasien || '-';

            form.action =
                "{{ url('/kasir/pembayaran') }}/" +
                encodeURIComponent(resepId) +
                "/proses";

            document.getElementById('namaPasienPanel').textContent =
                'Pasien: ' + pasien;

            form.reset();

            updateTotal();

            updateMetode();

            tombolBayar.disabled = false;

            tombolQris.disabled = false;

            tombolBayar.innerHTML =
                '<i class="fa-solid fa-lock"></i> Bayar Sekarang';

            tombolQris.innerHTML =
                '<i class="fa-solid fa-qrcode me-2"></i> Bayar via QRIS';

            backdrop.classList.add('show');

            backdrop.setAttribute('aria-hidden', 'false');

            document.body.style.overflow = 'hidden';

            setTimeout(() => totalInput.focus(), 100);

        }


        // TUTUP MODAL
        function tutupModal() {

            backdrop.classList.remove('show');

            backdrop.setAttribute('aria-hidden', 'true');

            document.body.style.overflow = '';

        }


        // BUKA PEMBAYARAN
        document.querySelectorAll('[data-open-payment]').forEach(button => {

            button.addEventListener('click', () => {

                bukaModal(button);

            });

        });


        // TUTUP MODAL
        document.getElementById('tutupPembayaran')
            .addEventListener('click', tutupModal);


        // KLIK LUAR MODAL
        backdrop.addEventListener('click', event => {

            if (event.target === backdrop) {

                tutupModal();

            }

        });


        // ESCAPE
        document.addEventListener('keydown', event => {

            if (
                event.key === 'Escape' &&
                backdrop.classList.contains('show')
            ) {

                tutupModal();

            }

        });


        // PILIH METODE
        document.querySelectorAll(
            'input[name="metode_pembayaran"]'
        ).forEach(radio => {

            radio.addEventListener('change', updateMetode);

        });


        // TOTAL
        totalInput.addEventListener('input', updateTotal);


        // UANG CASH
        uangInput.addEventListener('input', updateKembalian);


        // VALIDASI PEMBAYARAN
        form.addEventListener('submit', event => {

            const metode = document.querySelector(
                'input[name="metode_pembayaran"]:checked'
            );

            const total = Number(totalInput.value) || 0;


            if (!metode) {

                event.preventDefault();

                alert('Silakan pilih metode pembayaran.');

                return;

            }


            if (total <= 0) {

                event.preventDefault();

                alert('Total pembayaran harus lebih dari Rp0.');

                totalInput.focus();

                return;

            }


            // VALIDASI CASH
            if (metode.value === 'Cash') {

                const uang = Number(uangInput.value) || 0;

                if (uangInput.value === '' || uang < total) {

                    event.preventDefault();

                    alert(
                        'Uang yang diterima harus sama dengan atau lebih besar dari total tagihan.'
                    );

                    uangInput.focus();

                    return;

                }

            }


            // VALIDASI TRANSFER
            if (metode.value === 'Transfer Bank') {

                const bank = document.getElementById('namaBank').value;

                if (!bank) {

                    event.preventDefault();

                    alert('Silakan pilih bank terlebih dahulu.');

                    document.getElementById('namaBank').focus();

                    return;

                }

            }


            // KONFIRMASI QRIS DAN TRANSFER
            if (
                metode.value === 'QRIS' ||
                metode.value === 'Transfer Bank'
            ) {

                const lanjut = confirm(
                    'Pembayaran ' + metode.value +
                    ' akan dicatat menunggu verifikasi. Lanjutkan?'
                );

                if (!lanjut) {

                    event.preventDefault();

                    return;

                }

            }


            // TOMBOL PROSES
            if (!event.defaultPrevented) {

                tombolBayar.disabled = true;

                tombolQris.disabled = true;

                if (metode.value === 'QRIS') {

                    tombolQris.innerHTML =
                        '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

                } else {

                    tombolBayar.innerHTML =
                        '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

                }

            }

        });

    </script>

</body>
</html>
