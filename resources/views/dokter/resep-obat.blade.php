
@php
    $user = auth()->user();
    $isApoteker = $user->hasRole('apoteker');
    $isDokter = $user->hasRole('dokter');

    $dataStokObat = collect($stokObats ?? [])->map(function ($stok) {
        return [
            'obat_id' => $stok->obat_id,
            'satuan_obat_id' => $stok->satuan_obat_id,
            'nama_obat' => $stok->obat?->nama ?? '-',
            'nama_satuan' => $stok->satuanObat?->nama ?? '-',
            'stok_tersedia' => (int) ($stok->stok ?? $stok->jumlah_stok ?? 0),
        ];
    })->values();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan dan Resep Obat | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f7fc;
            --border: #e5eaf2;
        }

        * { box-sizing: border-box; }

        html, body {
            min-height: 100%;
            height: auto;
            overflow-x: hidden;
            overflow-y: auto;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: #24334b;
        }

        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            padding: 27px 18px;
            color: white;
            background: linear-gradient(165deg, #176de0, #1048a7);
            box-shadow: 5px 0 25px rgba(18,75,160,.12);
            overflow-y: auto;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.18);
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.18);
            border-radius: 14px;
            font-size: 22px;
        }

        .logo h5 {
            margin: 0;
            font-weight: 750;
            letter-spacing: .3px;
        }

        .logo small {
            color: #d9e9ff;
            font-size: 10px;
        }

        .menu {
            padding: 0;
            margin-top: 28px;
        }

        .menu-title {
            margin: 0 12px 12px;
            color: #b9d7ff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 15px;
            margin-bottom: 8px;
            color: #e4efff;
            text-decoration: none;
            border-radius: 12px;
            transition: .2s ease;
            font-size: 13px;
            font-weight: 500;
        }

        .menu a i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .menu a:hover,
        .menu a.active {
            color: white;
            background: rgba(255,255,255,.17);
        }

        .menu a.active {
            box-shadow: inset 3px 0 white;
        }

        .sidebar-note {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 85px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 14px;
            background: rgba(255,255,255,.09);
            font-size: 11px;
            color: #e4efff;
            line-height: 1.7;
        }

        .logout-area {
            position: absolute;
            bottom: 22px;
            left: 18px;
            right: 18px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 12px;
            background: white;
            color: #dc3545;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .logout-btn:hover {
            background: #ffe8eb;
            color: #b02a37;
        }

        .content {
            margin-left: 255px;
            min-height: 100vh;
            width: calc(100% - 255px);
            overflow-x: hidden;
            overflow-y: auto;
        }

        .topbar {
            min-height: 65px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 28px;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 700;
        }

        .user-info {
            font-size: 14px;
            color: #555;
        }

        .page { padding: 28px; }

        .page-header {
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            color: white;
            border-radius: 14px;
            padding: 22px 25px;
            margin-bottom: 24px;
            box-shadow: 0 5px 15px rgba(24,119,242,.15);
        }

        .page-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .page-header p {
            margin: 6px 0 0;
            opacity: .9;
            font-size: 13px;
        }

        .recipe-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 15px rgba(0,0,0,.04);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .recipe-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .recipe-card-header h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .table-responsive { width: 100%; }

        .recipe-table {
            width: 100%;
            min-width: 700px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .recipe-table thead th {
            background: var(--blue-main);
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 14px 12px;
            white-space: nowrap;
            border-right: 1px solid rgba(255,255,255,.2);
            border-bottom: 1px solid var(--blue-dark);
        }

        .recipe-table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            font-size: 13px;
            color: #374151;
            background: white;
            border-bottom: 1px solid #e9edf4;
        }

        .recipe-table tbody tr:hover td {
            background: #f4f8ff;
        }

        .patient-name {
            font-weight: 700;
            color: var(--blue-dark);
            min-width: 120px;
        }

        .empty-state {
            text-align: center;
            padding: 45px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 40px;
            color: #b8c8dc;
            margin-bottom: 14px;
        }

        .empty-state h6 {
            font-weight: 700;
            color: #4b5563;
        }

        .empty-state p {
            font-size: 13px;
            margin: 0;
        }

        .pagination-wrapper {
            padding: 16px 20px;
            border-top: 1px solid #edf0f4;
        }

        .pagination { margin-bottom: 0; }

        .pagination .page-link { color: var(--blue-main); }

        .pagination .active .page-link {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: white;
        }

        .btn-blue {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: white;
        }

        .btn-blue:hover {
            background: var(--blue-dark);
            border-color: var(--blue-dark);
            color: white;
        }

        .section-label {
            font-size: 14px;
            font-weight: 700;
            color: var(--blue-dark);
            margin-bottom: 12px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            font-size: 13px;
        }

        .alert { font-size: 13px; }

        /* BAGIAN RESEP DI DALAM MODAL */
        .resep-box {
            background: #f7faff;
            border: 1px solid #dce9fa;
            border-radius: 12px;
            padding: 18px;
        }

        .aturan-pakai-wrapper {
            position: relative;
        }

        .aturan-pakai-input-wrapper {
            position: relative;
        }

        .aturan-pakai-arrow {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            pointer-events: none;
        }

        .aturan-pakai-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 4px);
            left: 0;
            right: 0;
            z-index: 1080;
            max-height: 190px;
            overflow-y: auto;
            background: white;
            border: 1px solid #dce4ef;
            border-radius: 9px;
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }

        .aturan-pakai-dropdown.show { display: block; }

        .aturan-pakai-option {
            padding: 10px 13px;
            font-size: 13px;
            cursor: pointer;
        }

        .aturan-pakai-option:hover {
            background: var(--blue-light);
            color: var(--blue-dark);
        }

        .resep-table {
            width: 100%;
            min-width: 750px;
            font-size: 12px;
        }

        .resep-table th {
            background: #e7f1ff;
            color: #174f99;
            padding: 10px;
            white-space: nowrap;
        }

        .resep-table td {
            padding: 10px;
            vertical-align: middle;
        }

        @media (max-width: 900px) {
            .sidebar { width: 215px; }
            .content {
                margin-left: 215px;
                width: calc(100% - 215px);
            }
            .page { padding: 24px 20px; }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: 0;
                padding: 18px;
                overflow: visible;
            }

            .logo { padding-bottom: 17px; }
            .menu { margin-top: 17px; }
            .sidebar-note { display: none; }

            .logout-area {
                position: static;
                margin-top: 18px;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }

            .page { padding: 22px 16px; }

            .topbar {
                padding: 15px;
                flex-wrap: wrap;
            }

            .page-header { padding: 18px; }


/* SCROLL MODAL PEMERIKSAAN */
#modalPemeriksaan .modal-dialog {
    width: 95%;
    max-width: 1140px;
    margin: 20px auto;
}

#modalPemeriksaan .modal-content {
    height: calc(100vh - 40px);
    max-height: calc(100vh - 40px);
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

#modalPemeriksaan #formPemeriksaan {
    display: flex;
    flex-direction: column;
    flex: 1;
    min-height: 0;
    overflow: hidden;
}

#modalPemeriksaan .modal-header,
#modalPemeriksaan .modal-footer {
    flex-shrink: 0;
}

#modalPemeriksaan .modal-body {
    display: block;
    flex: 1;
    min-height: 0;
    height: 0;
    overflow-y: scroll !important;
    overflow-x: hidden;
    overscroll-behavior: contain;
    padding: 20px;
}

#modalPemeriksaan .resep-box {
    overflow: visible;
}

#modalPemeriksaan .table-responsive {
    overflow-x: auto;
}

@media (max-width: 650px) {
    #modalPemeriksaan .modal-dialog {
        width: auto;
        margin: 10px;
    }

    #modalPemeriksaan .modal-content {
        height: calc(100vh - 20px);
        max-height: calc(100vh - 20px);
    }
}



    </style>
</head>

<body>

<aside class="sidebar">
    <div class="logo">
        <div class="logo-icon">
            <i class="fa-solid fa-hospital"></i>
        </div>

        <div>
            <h5>SIM RS</h5>
            <small>Sistem Informasi Rumah Sakit</small>
        </div>
    </div>

    <nav class="menu">
        <div class="menu-title">
            MENU {{ $isDokter ? 'DOKTER' : ($isApoteker ? 'APOTEKER' : 'KASIR') }}
        </div>

        @if($isDokter)
            <a href="{{ route('dokter.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('dokter.pasien.index') }}">
                <i class="fa-solid fa-hospital-user"></i>
                <span>Data Pasien</span>
            </a>

            <a href="{{ route('dokter.resep.index') }}" class="active">
                <i class="fa-solid fa-prescription"></i>
                <span>Pemeriksaan dan Resep Obat</span>
            </a>

        @elseif($isApoteker)
            <a href="{{ route('apoteker.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kasir.resep') }}" class="active">
                <i class="fa-solid fa-file-prescription"></i>
                <span>Resep Dokter</span>
            </a>

        @else
            <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kasir.resep') }}" class="active">
                <i class="fa-solid fa-file-prescription"></i>
                <span>Resep dari Dokter</span>
            </a>

            <a href="{{ route('kasir.pembayaran') }}">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Pembayaran Obat</span>
            </a>
        @endif
    </nav>

    <div class="sidebar-note">
        <i class="fa-solid fa-shield-heart me-1"></i>
        <strong>Pelayanan Kesehatan</strong>
        <br>
        Gunakan data pasien dengan teliti dan jaga kerahasiaan informasi medis.
    </div>

    <div class="logout-area">
        <form action="{{ $isDokter ? route('dokter.logout') : route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>

<main class="content">
    <header class="topbar">
        <div class="topbar-title">
            {{ $isDokter ? 'Pemeriksaan dan Resep Obat' : 'Resep Obat' }}
        </div>

        <div class="user-info">
            <i class="fa-solid fa-user me-2"></i>{{ $user->name }}
        </div>
    </header>

    <div class="page">
        <section class="page-header">
            <h4>
                <i class="fa-solid fa-stethoscope me-2"></i>
                Pemeriksaan Dokter
            </h4>
            <p>
                Kelola pemeriksaan pasien dan resep obat dalam satu halaman.
            </p>
        </section>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($isDokter)
            <section class="recipe-card">
                <div class="recipe-card-header">
                    <h5>
                        <i class="fa-solid fa-notes-medical text-primary me-2"></i>
                        Riwayat Pemeriksaan Pasien
                    </h5>

                    <button type="button"
                            class="btn btn-blue btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#modalPemeriksaan">
                        <i class="fa-solid fa-plus me-1"></i>
                        Tambah Pemeriksaan
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table recipe-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pasien</th>
                                <th>Keluhan / Hasil Pemeriksaan</th>
                                <th>Tanggal Pemeriksaan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pemeriksaans as $index => $pemeriksaan)
                                <tr>
                                    <td>{{ $pemeriksaans->firstItem() + $index }}</td>

                                    <td>
                                        <div class="patient-name">
                                            {{ $pemeriksaan->pendaftaran?->pasien?->nama ?? '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $pemeriksaan->keluhan ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $pemeriksaan->created_at?->format('d-m-Y H:i') ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-notes-medical d-block"></i>
                                            <h6>Belum Ada Pemeriksaan</h6>
                                            <p>Silakan tambahkan pemeriksaan pasien.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($pemeriksaans->hasPages())
                    <div class="pagination-wrapper">
                        {{ $pemeriksaans->links() }}
                    </div>
                @endif
            </section>

            {{-- MODAL TAMBAH PEMERIKSAAN --}}
            <div class="modal fade" id="modalPemeriksaan" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header text-white"
                             style="background:linear-gradient(135deg,#1877f2,#0f58c6)">
                            <h5 class="modal-title">
                                <i class="fa-solid fa-stethoscope me-2"></i>
                                Tambah Pemeriksaan
                            </h5>

                            <button type="button"
                                    class="btn-close btn-close-white"
                                    data-bs-dismiss="modal"></button>
                        </div>

                        <form id="formPemeriksaan"
                              action="{{ route('dokter.pemeriksaan.store') }}"
                              method="POST">

                            @csrf

                            <div class="modal-body">

                                {{-- DATA PEMERIKSAAN --}}
                                <div class="section-label">
                                    <i class="fa-solid fa-user-injured me-2"></i>
                                    Data Pemeriksaan Pasien
                                </div>

                                <div class="mb-3">
                                    <label for="pendaftaran_id" class="form-label">
                                        Pilih Pasien
                                    </label>

                                    <select name="pendaftaran_id"
                                            id="pendaftaran_id"
                                            class="form-select"
                                            required>
                                        <option value="">-- Pilih Pasien --</option>

                                        @foreach($pendaftarans as $pendaftaran)
                                            <option value="{{ $pendaftaran->id }}"
                                                {{ old('pendaftaran_id') == $pendaftaran->id ? 'selected' : '' }}>
                                                {{ $pendaftaran->pasien?->nama ?? 'Pasien' }}
                                                - {{ $pendaftaran->tanggal_pendaftaran ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="keluhan" class="form-label">
                                        Keluhan / Hasil Pemeriksaan
                                    </label>

                                    <textarea name="keluhan"
                                              id="keluhan"
                                              class="form-control"
                                              rows="4"
                                              placeholder="Masukkan keluhan dan hasil pemeriksaan pasien..."
                                              required>{{ old('keluhan') }}</textarea>
                                </div>

                                <hr>

                                {{-- RESEP OBAT --}}
                                <div class="resep-box">
                                    <div class="mb-3">
                                        <h5 class="mb-1">
                                            <i class="fa-solid fa-pills text-primary me-2"></i>
                                            Resep Obat
                                        </h5>

                                        <small class="text-muted">
                                            Pilih obat dan satuan sesuai stok yang tersedia.
                                        </small>
                                    </div>

                                    <div class="row g-3">

                                        <div class="col-12">
                                            <label for="obat_id" class="form-label">
                                                Obat
                                            </label>

                                            <select id="obat_id" class="form-select">
                                                <option value="">-- Pilih Obat --</option>

                                                @foreach($obats ?? [] as $obat)
                                                    <option value="{{ $obat->id }}">
                                                        {{ $obat->nama }}
                                                        @if($obat->kategori)
                                                            - {{ $obat->kategori->nama }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="satuan_obat_id" class="form-label">
                                                Satuan Obat
                                            </label>

                                            <select id="satuan_obat_id"
                                                    class="form-select"
                                                    disabled>
                                                <option value="">
                                                    -- Pilih obat terlebih dahulu --
                                                </option>
                                            </select>

                                            <small class="text-muted">
                                                Satuan mengikuti stok obat yang dipilih.
                                            </small>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="jumlah_obat" class="form-label">
                                                Jumlah Obat
                                            </label>

                                            <input type="number"
                                                   id="jumlah_obat"
                                                   class="form-control"
                                                   min="1"
                                                   step="1"
                                                   placeholder="Contoh: 10">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="frekuensi_obat" class="form-label">
                                                Frekuensi
                                            </label>

                                            <select id="frekuensi_obat" class="form-select">
                                                <option value="">-- Pilih Frekuensi --</option>

                                                @forelse($frekuensis as $frekuensi)
                                                    <option value="{{ $frekuensi->nama }}">
                                                        {{ $frekuensi->nama }}
                                                    </option>
                                                @empty
                                                    <option value="" disabled>
                                                        Belum ada data frekuensi
                                                    </option>
                                                @endforelse
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="lama_obat" class="form-label">
                                                Lama Pemakaian (hari)
                                            </label>

                                            <input type="number"
                                                   id="lama_obat"
                                                   class="form-control"
                                                   min="1"
                                                   step="1"
                                                   placeholder="Contoh: 5">
                                        </div>

                                        <div class="col-12">
                                            <label for="aturan_pakai" class="form-label">
                                                Aturan Pakai
                                            </label>

                                            <div class="aturan-pakai-wrapper">
                                                <div class="aturan-pakai-input-wrapper">
                                                    <input type="text"
                                                           id="aturan_pakai"
                                                           class="form-control"
                                                           placeholder="Ketik untuk mencari aturan pakai..."
                                                           autocomplete="off">

                                                    <span class="aturan-pakai-arrow">▾</span>
                                                </div>

                                                <div id="aturanPakaiDropdown"
                                                     class="aturan-pakai-dropdown">
                                                    @foreach([
                                                        'Sebelum makan',
                                                        'Sesudah makan',
                                                        'Saat makan',
                                                        'Sebelum tidur',
                                                        'Sesudah bangun tidur',
                                                        'Pagi hari',
                                                        'Siang hari',
                                                        'Sore hari',
                                                        'Malam hari',
                                                        'Saat diperlukan',
                                                        'Sesuai petunjuk dokter',
                                                        'Dengan air putih',
                                                        'Dikonsumsi bersama makanan'
                                                    ] as $aturan)
                                                        <div class="aturan-pakai-option"
                                                             data-value="{{ $aturan }}">
                                                            {{ $aturan }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button type="button"
                                                    id="btnTambahkanObat"
                                                    class="btn btn-success">
                                                <i class="fa-solid fa-plus me-1"></i>
                                                Tambahkan Obat
                                            </button>
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="section-label">
                                        <i class="fa-solid fa-list me-2"></i>
                                        Daftar Obat yang Ditambahkan
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-bordered resep-table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Obat</th>
                                                    <th>Satuan</th>
                                                    <th>Jumlah</th>
                                                    <th>Frekuensi</th>
                                                    <th>Lama</th>
                                                    <th>Aturan Pakai</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody id="daftarObat">
                                                <tr id="barisKosong">
                                                    <td colspan="8" class="text-center text-muted py-3">
                                                        Belum ada obat yang ditambahkan.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="alert alert-info mb-0 mt-3">
                                        <i class="fa-solid fa-circle-info me-2"></i>
                                        Resep obat bersifat opsional. Pemeriksaan tetap dapat disimpan tanpa menambahkan obat.
                                    </div>

                                    <input type="hidden"
                                           name="resep_obat"
                                           id="resep_obat"
                                           value="[]">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                        class="btn btn-light"
                                        data-bs-dismiss="modal">
                                    Batal
                                </button>

                                <button type="submit" class="btn btn-blue">
                                    <i class="fa-solid fa-save me-1"></i>
                                    Simpan Pemeriksaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dataStokObat = @json($dataStokObat);

    const form = document.getElementById('formPemeriksaan');

    // Jika halaman ini bukan halaman dokter, hentikan script modal.
    if (!form) return;

    const obatSelect = document.getElementById('obat_id');
    const satuanSelect = document.getElementById('satuan_obat_id');
    const jumlahInput = document.getElementById('jumlah_obat');
    const frekuensiSelect = document.getElementById('frekuensi_obat');
    const lamaInput = document.getElementById('lama_obat');
    const aturanInput = document.getElementById('aturan_pakai');
    const aturanDropdown = document.getElementById('aturanPakaiDropdown');
    const btnTambah = document.getElementById('btnTambahkanObat');
    const daftarObat = document.getElementById('daftarObat');
    const inputResep = document.getElementById('resep_obat');
    const modalElement = document.getElementById('modalPemeriksaan');

    let resepObat = [];

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    function resetPilihanObat() {
        obatSelect.value = '';
        satuanSelect.innerHTML = '<option value="">-- Pilih obat terlebih dahulu --</option>';
        satuanSelect.disabled = true;
        jumlahInput.value = '';
        frekuensiSelect.value = '';
        lamaInput.value = '';
        aturanInput.value = '';
        aturanDropdown.classList.remove('show');
    }

    function tampilkanSatuan() {
        const obatId = obatSelect.value;

        satuanSelect.innerHTML = '';

        if (!obatId) {
            satuanSelect.innerHTML = '<option value="">-- Pilih obat terlebih dahulu --</option>';
            satuanSelect.disabled = true;
            return;
        }

        const satuanTersedia = dataStokObat.filter(item =>
            String(item.obat_id) === String(obatId)
        );

        if (satuanTersedia.length === 0) {
            satuanSelect.innerHTML = '<option value="">Stok obat tidak tersedia</option>';
            satuanSelect.disabled = true;
            return;
        }

        satuanSelect.disabled = false;
        satuanSelect.innerHTML = '<option value="">-- Pilih Satuan --</option>';

        satuanTersedia.forEach(item => {
            const option = document.createElement('option');

            option.value = item.satuan_obat_id;
            option.textContent = `${item.nama_satuan} (Stok: ${item.stok_tersedia})`;

            option.dataset.stok = item.stok_tersedia;
            option.dataset.namaSatuan = item.nama_satuan;

            satuanSelect.appendChild(option);
        });
    }

    obatSelect.addEventListener('change', tampilkanSatuan);

    // Pencarian aturan pakai
    aturanInput.addEventListener('focus', function () {
        aturanDropdown.classList.add('show');
    });

    aturanInput.addEventListener('input', function () {
        const keyword = this.value.toLowerCase();

        aturanDropdown.classList.add('show');

        aturanDropdown.querySelectorAll('.aturan-pakai-option').forEach(option => {
            const cocok = option.textContent.toLowerCase().includes(keyword);
            option.style.display = cocok ? '' : 'none';
        });
    });

    aturanDropdown.querySelectorAll('.aturan-pakai-option').forEach(option => {
        option.addEventListener('click', function () {
            aturanInput.value = this.dataset.value;
            aturanDropdown.classList.remove('show');
        });
    });

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.aturan-pakai-wrapper')) {
            aturanDropdown.classList.remove('show');
        }
    });

    // Render daftar resep
    function renderResep() {
        daftarObat.innerHTML = '';

        if (resepObat.length === 0) {
            daftarObat.innerHTML = `
                <tr>
                    <td colspan="8" class="text-center text-muted py-3">
                        Belum ada obat yang ditambahkan.
                    </td>
                </tr>
            `;
        } else {
            resepObat.forEach((item, index) => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${escapeHtml(item.nama_obat)}</td>
                    <td>${escapeHtml(item.nama_satuan)}</td>
                    <td>${escapeHtml(item.jumlah)}</td>
                    <td>${escapeHtml(item.frekuensi)}</td>
                    <td>${escapeHtml(item.lama || '-')} hari</td>
                    <td>${escapeHtml(item.aturan_pakai || '-')}</td>
                    <td>
                        <button type="button"
                                class="btn btn-danger btn-sm btn-hapus-resep"
                                data-index="${index}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                `;

                daftarObat.appendChild(row);
            });
        }

        inputResep.value = JSON.stringify(resepObat);
    }

    // Tambahkan obat
    btnTambah.addEventListener('click', function () {
        const obatId = obatSelect.value;
        const satuanId = satuanSelect.value;
        const jumlah = Number(jumlahInput.value);
        const frekuensi = frekuensiSelect.value;
        const lama = lamaInput.value;
        const aturanPakai = aturanInput.value.trim();

        if (!obatId) {
            alert('Silakan pilih obat terlebih dahulu.');
            obatSelect.focus();
            return;
        }

        if (!satuanId) {
            alert('Silakan pilih satuan obat.');
            satuanSelect.focus();
            return;
        }

        if (!Number.isInteger(jumlah) || jumlah < 1) {
            alert('Jumlah obat harus berupa angka minimal 1.');
            jumlahInput.focus();
            return;
        }

        if (!frekuensi) {
            alert('Silakan pilih frekuensi obat.');
            frekuensiSelect.focus();
            return;
        }

        const stokTerpilih = dataStokObat.find(item =>
            String(item.obat_id) === String(obatId) &&
            String(item.satuan_obat_id) === String(satuanId)
        );

        if (!stokTerpilih) {
            alert('Data stok obat tidak ditemukan.');
            return;
        }

        if (jumlah > Number(stokTerpilih.stok_tersedia)) {
            alert(`Jumlah melebihi stok tersedia. Stok saat ini: ${stokTerpilih.stok_tersedia}`);
            jumlahInput.focus();
            return;
        }

        const namaObat = obatSelect.options[obatSelect.selectedIndex].text.trim();

        resepObat.push({
            obat_id: obatId,
            satuan_obat_id: satuanId,
            jumlah: jumlah,
            frekuensi: frekuensi,
            lama: lama,
            aturan_pakai: aturanPakai,
            nama_obat: namaObat,
            nama_satuan: stokTerpilih.nama_satuan
        });

        renderResep();
        resetPilihanObat();
    });

    // Hapus obat dari daftar
    daftarObat.addEventListener('click', function (event) {
        const tombol = event.target.closest('.btn-hapus-resep');

        if (!tombol) return;

        const index = Number(tombol.dataset.index);

        resepObat.splice(index, 1);
        renderResep();
    });

    // Pastikan data resep terkirim saat form disubmit.
    form.addEventListener('submit', function () {
        inputResep.value = JSON.stringify(resepObat);
    });

    // Reset isi modal setelah ditutup.
    modalElement.addEventListener('hidden.bs.modal', function () {
        form.reset();
        resepObat = [];
        renderResep();
        resetPilihanObat();
    });

    // Jika validasi Laravel gagal, buka kembali modal.
    @if($errors->any())
        bootstrap.Modal.getOrCreateInstance(modalElement).show();
    @endif
});
</script>

</body>
</html>
