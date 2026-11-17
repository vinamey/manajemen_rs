@php
    $user = auth()->user();
    $isApoteker = $user->hasRole('apoteker');
    $isDokter = $user->hasRole('dokter');
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
            --background: #f4f6fa;
            --border: #e5eaf2;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
            color: #1f2937;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            background: var(--blue-main);
            color: white;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .logo {
            min-height: 65px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .menu {
            padding: 20px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .menu-title {
            font-size: 12px;
            opacity: .75;
            padding: 0 13px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,.18);
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        .logout-area { padding: 15px; }

        .logout-btn {
            width: 100%;
            border: none;
            background: white;
            color: #dc3545;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
        }

        .content {
            margin-left: 250px;
            min-height: 100vh;
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
            min-width: 950px;
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

        .recipe-table tbody tr:hover td { background: #f4f8ff; }

        .patient-name {
            font-weight: 700;
            color: var(--blue-dark);
            min-width: 120px;
        }

        .doctor-name {
            font-weight: 600;
            white-space: nowrap;
        }

        .medicine-badge {
            display: inline-block;
            background: var(--blue-light);
            color: var(--blue-dark);
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .quantity-badge {
            display: inline-block;
            background: #eaf9f0;
            color: #16834b;
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
        }

        .instruction-cell { min-width: 140px; }

        .instruction-value {
            display: inline-block;
            background: #edf5ff;
            color: #1859a9;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            line-height: 1.5;
            white-space: normal;
            overflow-wrap: anywhere;
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

        .medicine-form-row {
            background: #f7faff;
            border: 1px solid #dce9fa;
            border-radius: 10px;
            padding: 15px;
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

        .alert {
            font-size: 13px;
        }

        @media (max-width: 768px) {
            .sidebar { width: 200px; }
            .content { margin-left: 200px; }
            .page { padding: 15px; }
            .topbar { padding: 15px; flex-wrap: wrap; }
            .page-header { padding: 18px; }
        }

        @media (max-width: 480px) {
            .sidebar { width: 65px; }
            .logo {
                justify-content: center;
                padding: 0;
                font-size: 0;
            }
            .logo i {
                font-size: 22px;
                margin: 0 !important;
            }
            .menu { padding: 15px 7px; }
            .menu-title, .menu a span { display: none; }
            .menu a {
                justify-content: center;
                padding: 13px 5px;
            }
            .content { margin-left: 65px; }
            .logout-area { padding: 8px; }
            .logout-btn { font-size: 0; }
            .logout-btn i {
                font-size: 16px;
                margin: 0 !important;
            }
        }
    </style>
</head>

<body>

<aside class="sidebar">
    <div class="logo">
        <i class="fa-solid fa-hospital me-2"></i>
        SIM RS
    </div>

    <nav class="menu">
        <div class="menu-title">
            Menu {{ $isDokter ? 'Dokter' : ($isApoteker ? 'Apoteker' : 'Kasir') }}
        </div>

        @if($isDokter)
            <a href="{{ route('dokter.dashboard') }}">
                <i class="fa-solid fa-house"></i><span>Dashboard</span>
            </a>

            <a href="{{ route('dokter.pasien.index') }}">
                <i class="fa-solid fa-hospital-user"></i><span>Data Pasien</span>
            </a>

            <a href="{{ route('dokter.resep.index') }}" class="active">
                <i class="fa-solid fa-stethoscope"></i><span>Pemeriksaan & Resep</span>
            </a>

        @elseif($isApoteker)
            <a href="{{ route('apoteker.dashboard') }}">
                <i class="fa-solid fa-house"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('kasir.resep') }}" class="active">
                <i class="fa-solid fa-file-prescription"></i><span>Resep Dokter</span>
            </a>

        @else
            <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-house"></i><span>Dashboard</span>
            </a>
            <a href="{{ route('kasir.resep') }}" class="active">
                <i class="fa-solid fa-file-prescription"></i><span>Resep dari Dokter</span>
            </a>
            <a href="{{ route('kasir.pembayaran') }}">
                <i class="fa-solid fa-money-bill-wave"></i><span>Pembayaran Obat</span>
            </a>
        @endif
    </nav>

    <div class="logout-area">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
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

            {{-- RIWAYAT PEMERIKSAAN --}}
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
                                <th>Poli</th>
                                <th>Keluhan / Hasil Pemeriksaan</th>
                                <th>Dokter</th>
                                <th>Tanggal Pemeriksaan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($pemeriksaans as $index => $pemeriksaan)
                                <tr>
                                    <td>
                                        {{ $pemeriksaans->firstItem() + $index }}
                                    </td>

                                    <td>
                                        <div class="patient-name">
                                            {{ $pemeriksaan->pendaftaran?->pasien?->nama ?? '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        {{ $pemeriksaan->pendaftaran?->poli?->nama ?? '-' }}
                                    </td>

                                    <td style="min-width:220px;">
                                        {{ $pemeriksaan->keluhan ?? '-' }}
                                    </td>

                                    <td>
                                        <span class="doctor-name">
                                            {{ $pemeriksaan->dokter?->nama ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $pemeriksaan->created_at?->format('d-m-Y H:i') ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
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

        @endif

        {{-- DAFTAR RESEP OBAT --}}
        <section class="recipe-card">

            <div class="recipe-card-header">
                <h5>
                    <i class="fa-solid fa-prescription-bottle-medical text-primary me-2"></i>
                    Daftar Resep Obat
                </h5>
            </div>

            <div class="table-responsive">
                <table class="table recipe-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Frekuensi</th>
                            <th>Aturan Pakai</th>
                            <th>Lama</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($resepObats as $index => $resep)

                            @forelse($resep->obat as $obat)

                                @php
                                    $teks = $obat->pivot->aturan_pakai ?? '';

                                    $frekuensi = '-';
                                    $aturan = '-';
                                    $lama = '-';

                                    if (preg_match('/Frekuensi:\s*(.*?)(?=\s*\|\s*Aturan:|$)/i', $teks, $m)) {
                                        $frekuensi = trim($m[1]);
                                    }

                                    if (preg_match('/Aturan:\s*(.*?)(?=\s*\|\s*Lama:|$)/i', $teks, $m)) {
                                        $aturan = trim($m[1]);
                                    }

                                    if (preg_match('/Lama:\s*(.*)/i', $teks, $m)) {
                                        $lama = trim($m[1]);
                                    }
                                @endphp

                                <tr>
                                    <td>{{ $resepObats->firstItem() + $index }}</td>

                                    <td>
                                        <div class="patient-name">
                                            {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="doctor-name">
                                            <i class="fa-solid fa-user-doctor text-primary me-1"></i>
                                            {{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="medicine-badge">
                                            {{ $obat->nama ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="quantity-badge">
                                            {{ $obat->pivot->nilai ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="instruction-cell">
                                        <span class="instruction-value">{{ $frekuensi }}</span>
                                    </td>

                                    <td class="instruction-cell">
                                        <span class="instruction-value">{{ $aturan }}</span>
                                    </td>

                                    <td class="instruction-cell">
                                        <span class="instruction-value">{{ $lama }}</span>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td>{{ $resepObats->firstItem() + $index }}</td>
                                    <td>{{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}</td>
                                    <td>{{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}</td>
                                    <td colspan="5" class="text-muted">
                                        Belum ada obat pada resep ini.
                                    </td>
                                </tr>
                            @endforelse

                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fa-solid fa-file-prescription d-block"></i>
                                        <h6>Belum Ada Resep</h6>
                                        <p>Belum ada resep obat yang tersedia.</p>
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

    </div>
</main>

{{-- MODAL TAMBAH PEMERIKSAAN --}}
@if($isDokter)
<div class="modal fade" id="modalPemeriksaan" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content">

            <form action="{{ route('dokter.pemeriksaan.store') }}"
                  method="POST"
                  id="formPemeriksaan">

                @csrf

                <div class="modal-header text-white"
                     style="background:var(--blue-main);">

                    <h5 class="modal-title fw-bold">
                        <i class="fa-solid fa-stethoscope me-2"></i>
                        Tambah Pemeriksaan Dokter
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4">

                    {{-- DATA PEMERIKSAAN --}}
                    <div class="section-label">
                        <i class="fa-solid fa-user-injured me-2"></i>
                        Data Pemeriksaan Pasien
                    </div>

                    <div class="row g-3">

                        <div class="col-md-12">
                            <label class="form-label">Pilih Pasien</label>

                            <select name="pendaftaran_id"
                                    id="pendaftaran_id"
                                    class="form-select"
                                    required>

                                <option value="">-- Pilih Pasien --</option>

                                @foreach($pendaftarans as $pendaftaran)
                                    <option
                                        value="{{ $pendaftaran->id }}"
                                        data-dokter="{{ $pendaftaran->dokter?->nama ?? '-' }}"
                                        data-poli="{{ $pendaftaran->poli?->nama ?? '-' }}"
                                        {{ old('pendaftaran_id') == $pendaftaran->id ? 'selected' : '' }}>

                                        {{ $pendaftaran->pasien?->nama ?? 'Pasien' }}
                                        - {{ $pendaftaran->tanggal_pendaftaran ?? '' }}

                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Dokter</label>
                            <input type="text"
                                   id="namaDokter"
                                   class="form-control"
                                   value="{{ $dokters->first()?->nama ?? '-' }}"
                                   readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Poli</label>
                            <input type="text"
                                   id="namaPoli"
                                   class="form-control"
                                   readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Keluhan / Hasil Pemeriksaan</label>

                            <textarea name="keluhan"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Masukkan keluhan dan hasil pemeriksaan pasien..."
                                      required>{{ old('keluhan') }}</textarea>
                        </div>

                    </div>

                    <hr class="my-4">

                    {{-- RESEP OBAT --}}
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">

                        <div class="section-label mb-0">
                            <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
                            Resep Obat
                        </div>

                        <button type="button"
                                class="btn btn-outline-primary btn-sm"
                                id="btnTambahObat">

                            <i class="fa-solid fa-plus me-1"></i>
                            Tambah Obat
                        </button>

                    </div>

                    <div class="alert alert-info">
                        <i class="fa-solid fa-circle-info me-2"></i>
                        Resep obat bersifat opsional. Pemeriksaan tetap dapat disimpan tanpa menambahkan obat.
                    </div>

                    <div id="daftarObat"></div>

                    <input type="hidden"
                           name="resep_obat"
                           id="resep_obat"
                           value="[]">

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-blue">

                        <i class="fa-solid fa-save me-1"></i>
                        Simpan Pemeriksaan
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

{{-- TEMPLATE PILIHAN OBAT --}}
<template id="templatePilihanObat">
    <option value="">-- Pilih Obat --</option>

    @foreach($stokObats as $stok)
        @if($stok->obat && $stok->satuanObat)
            <option
                value="{{ $stok->obat_id }}|{{ $stok->satuan_obat_id }}"
                data-obat-id="{{ $stok->obat_id }}"
                data-satuan-id="{{ $stok->satuan_obat_id }}">

                {{ $stok->obat->nama }}
                - {{ $stok->satuanObat->nama }}
            </option>
        @endif
    @endforeach
</template>

@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@if($isDokter)
<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectPasien = document.getElementById('pendaftaran_id');
    const namaDokter = document.getElementById('namaDokter');
    const namaPoli = document.getElementById('namaPoli');

    const daftarObat = document.getElementById('daftarObat');
    const btnTambahObat = document.getElementById('btnTambahObat');

    const hiddenResep = document.getElementById('resep_obat');
    const formPemeriksaan = document.getElementById('formPemeriksaan');

    const templatePilihanObat = document.getElementById('templatePilihanObat');

    // Mengisi dokter dan poli berdasarkan pasien yang dipilih.
    function updateDataPasien() {

        const option = selectPasien.options[selectPasien.selectedIndex];

        if (!option || !option.value) {
            namaDokter.value = '{{ $dokters->first()?->nama ?? '-' }}';
            namaPoli.value = '';
            return;
        }

        namaDokter.value = option.dataset.dokter || '-';
        namaPoli.value = option.dataset.poli || '-';
    }

    selectPasien.addEventListener('change', updateDataPasien);

    updateDataPasien();

    // Membuat form satu obat.
    function tambahBarisObat() {

        const row = document.createElement('div');

        row.className = 'medicine-form-row';

        row.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-3">
                <strong class="text-primary">
                    <i class="fa-solid fa-capsules me-1"></i>
                    Obat Resep
                </strong>

                <button type="button"
                        class="btn btn-outline-danger btn-sm btnHapusObat">
                    <i class="fa-solid fa-trash"></i>
                    Hapus
                </button>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nama Obat dan Satuan</label>
                    <select class="form-select selectObat" required></select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jumlah</label>
                    <input type="number"
                           class="form-control jumlahObat"
                           min="1"
                           value="1"
                           required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Frekuensi</label>
                    <input type="text"
                           class="form-control frekuensiObat"
                           placeholder="Contoh: 3 kali sehari">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Lama Penggunaan (hari)</label>
                    <input type="number"
                           class="form-control lamaObat"
                           min="1"
                           placeholder="Contoh: 5">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Aturan Pakai</label>
                    <input type="text"
                           class="form-control aturanObat"
                           placeholder="Contoh: Sesudah makan">
                </div>

            </div>
        `;

        const selectObat = row.querySelector('.selectObat');

        selectObat.innerHTML = templatePilihanObat.innerHTML;

        row.querySelector('.btnHapusObat').addEventListener('click', function () {
            row.remove();
        });

        daftarObat.appendChild(row);
    }

    btnTambahObat.addEventListener('click', tambahBarisObat);

    // Menyiapkan data resep dalam format JSON untuk controller.
    formPemeriksaan.addEventListener('submit', function (event) {

        const dataResep = [];

        const semuaBaris = daftarObat.querySelectorAll('.medicine-form-row');

        let valid = true;

        semuaBaris.forEach(function (row) {

            const select = row.querySelector('.selectObat');
            const selectedOption = select.options[select.selectedIndex];

            if (!selectedOption || !selectedOption.value) {
                valid = false;
                return;
            }

            const jumlah = row.querySelector('.jumlahObat').value;

            if (!jumlah || Number(jumlah) < 1) {
                valid = false;
                return;
            }

            dataResep.push({
                obat_id: selectedOption.dataset.obatId,
                satuan_obat_id: selectedOption.dataset.satuanId,
                jumlah: jumlah,
                frekuensi: row.querySelector('.frekuensiObat').value,
                lama: row.querySelector('.lamaObat').value || null,
                aturan_pakai: row.querySelector('.aturanObat').value
            });
        });

        if (!valid) {
            event.preventDefault();
            alert('Silakan lengkapi pilihan obat dan jumlahnya.');
            return;
        }

        hiddenResep.value = JSON.stringify(dataResep);
    });

    // Membuka kembali modal apabila validasi Laravel gagal.
    @if($errors->any())
        const modalElement = document.getElementById('modalPemeriksaan');

        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    @endif

});
</script>
@endif

</body>
</html>

