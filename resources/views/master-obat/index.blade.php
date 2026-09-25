@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Obat')

@section('content')

{{-- =========================================================
     SELECT2 CSS
========================================================= --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@php
    /*
    |--------------------------------------------------------------------------
    | DAFTAR NAMA OBAT
    |--------------------------------------------------------------------------
    | Kalau nanti mau menambah nama obat, cukup tambahkan di array ini.
    */
    $daftarNamaObat = [
        'Acyclovir',
        'Albendazole',
        'Allopurinol',
        'Ambroxol',
        'Amlodipine',
        'Amoxicillin',
        'Antasida',
        'Asam Folat',
        'Asam Mefenamat',
        'Aspirin',
        'Azithromycin',
        'Betahistine',
        'Bisacodyl',
        'Captopril',
        'Cefadroxil',
        'Cefixime',
        'Cetirizine',
        'Chloramphenicol',
        'Chlorpheniramine',
        'Ciprofloxacin',
        'Clindamycin',
        'Dexamethasone',
        'Dextromethorphan',
        'Diazepam',
        'Diclofenac Sodium',
        'Digoxin',
        'Domperidone',
        'Doxycycline',
        'Erythromycin',
        'Furosemide',
        'Glibenclamide',
        'Hydrochlorothiazide',
        'Ibuprofen',
        'Ketoconazole',
        'Lansoprazole',
        'Loratadine',
        'Metformin',
        'Metronidazole',
        'Nystatin',
        'Omeprazole',
        'Ondansetron',
        'Oralit',
        'Paracetamol',
        'Prednisone',
        'Ranitidine',
        'Salbutamol',
        'Simvastatin',
        'Sucralfate',
        'Vitamin B Complex',
        'Vitamin C',
        'Vitamin D',
        'Zinc',
    ];
@endphp

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    /* =========================================================
       HALAMAN
    ========================================================= */
    .master-obat-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 22px 18px;
    }

    /* =========================================================
       HEADER
    ========================================================= */
    .obat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .obat-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .obat-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: var(--blue-light);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .obat-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .obat-subtitle {
        margin: 3px 0 0;
        font-size: 10px;
        color: var(--text-muted);
    }

    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */
    .btn-tambah-obat {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 9px 14px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-tambah-obat:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* =========================================================
       ALERT
    ========================================================= */
    .alert-success,
    .alert-danger {
        margin: 0 0 12px;
        border-radius: 7px;
        font-size: 10px;
        padding: 9px 12px;
    }

    .alert-danger ul {
        padding-left: 18px;
    }

    /* =========================================================
       CARD TABLE
    ========================================================= */
    .obat-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .obat-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .obat-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .obat-table thead th {
        background: var(--blue-main);
        color: white;
        font-size: 10px;
        font-weight: 600;
        padding: 11px 12px;
        border: none;
        white-space: nowrap;
        text-align: left;
    }

    .obat-table tbody td {
        padding: 10px 12px;
        font-size: 10px;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4;
        vertical-align: middle;
        background: white;
    }

    .obat-table tbody tr:last-child td {
        border-bottom: none;
    }

    .obat-table tbody tr:hover td {
        background: #fafcff;
    }

    /* =========================================================
       KOLOM
    ========================================================= */
    .nomor {
        width: 45px;
        color: #6b7280 !important;
    }

    .kode-obat {
        width: 150px;
    }

    .kode-obat-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #e7f3ff;
        color: #1877f2;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .nama-obat {
        min-width: 180px;
        font-weight: 600;
        color: #1f2937 !important;
    }

    .kategori-obat {
        min-width: 150px;
    }

    .badge-kategori {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #fff0d5;
        color: #e8791b;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .satuan-obat {
        min-width: 100px;
        color: #6b7280;
    }

    .harga-obat {
        min-width: 130px;
        color: #374151 !important;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================================================
       AKSI
    ========================================================= */
    .aksi-header {
        text-align: center !important;
    }

    .aksi-wrapper {
        display: flex;
        gap: 5px;
        align-items: center;
        justify-content: flex-end;
        white-space: nowrap;
    }

    .btn-aksi {
        border: none;
        border-radius: 6px;
        padding: 7px 9px;
        font-size: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        cursor: pointer;
        transition: 0.2s;
        min-width: 47px;
        text-decoration: none;
    }

    .btn-lihat {
        background: #dff2ff;
        color: #087db9;
    }

    .btn-lihat:hover {
        background: #c8eaff;
        color: #087db9;
    }

    .btn-edit {
        background: var(--blue-main);
        color: white;
    }

    .btn-edit:hover {
        background: var(--blue-dark);
        color: white;
    }

    .btn-hapus {
        background: #ff4b4b;
        color: white;
    }

    .btn-hapus:hover {
        background: #dc3030;
        color: white;
    }

    .data-kosong {
        text-align: center;
        padding: 35px !important;
        color: #9ca3af !important;
    }

    /* =========================================================
       MODAL
    ========================================================= */
    .modal-obat .modal-dialog {
        max-width: 600px;
    }

    .modal-obat .modal-content {
        border: none;
        border-radius: 12px;
        overflow: visible;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.20);
    }

    .modal-obat .modal-header {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 14px 16px;
        border-radius: 12px 12px 0 0;
    }

    .modal-obat .modal-title {
        font-size: 14px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .modal-obat .modal-body {
        background: white;
        padding: 18px 16px;
    }

    .modal-obat .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 11px 16px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
        border-radius: 0 0 12px 12px;
    }

    /* =========================================================
       FORM
    ========================================================= */
    .form-obat-group {
        margin-bottom: 12px;
    }

    .form-obat-group:last-child {
        margin-bottom: 0;
    }

    .form-obat-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #526071;
        margin-bottom: 5px;
    }

    .form-obat-control {
        width: 100%;
        min-height: 34px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 7px 9px;
        font-size: 10px;
        color: #374151;
        outline: none;
        background: white;
        transition: 0.2s;
    }

    .form-obat-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.10);
    }

    .form-obat-control::placeholder {
        color: #9ca3af;
    }

    /* =========================================================
       SELECT2
    ========================================================= */
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 34px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        background: white;
        display: flex;
        align-items: center;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        color: #374151;
        font-size: 10px;
        line-height: 32px;
        padding-left: 9px;
        padding-right: 30px;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__placeholder {
        color: #9ca3af;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        height: 32px;
        right: 5px;
    }

    .select2-container--default.select2-container--focus
    .select2-selection--single {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.10);
    }

    .select2-dropdown {
        border: 1px solid #d4dce6;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.10);
        z-index: 9999;
    }

    .select2-search--dropdown {
        padding: 7px;
        background: white;
    }

    .select2-search--dropdown .select2-search__field {
        border: 1px solid #d4dce6;
        border-radius: 5px;
        padding: 6px 8px;
        font-size: 10px;
        outline: none;
    }

    .select2-search--dropdown .select2-search__field:focus {
        border-color: var(--blue-main);
    }

    .select2-container--default .select2-results__option {
        font-size: 10px;
        padding: 7px 9px;
    }

    .select2-container--default
    .select2-results__option--highlighted[aria-selected] {
        background: var(--blue-main);
        color: white;
    }

    .select2-container--default
    .select2-results__option[aria-selected="true"] {
        background: #e7f3ff;
        color: var(--blue-main);
    }

    /* Supaya daftar obat tidak terlalu panjang */
    .select2-results__options {
        max-height: 220px !important;
    }

    /* =========================================================
       VIEW DETAIL
    ========================================================= */
    .view-obat-value {
        width: 100%;
        min-height: 34px;
        border: 1px solid #e1e7ef;
        border-radius: 6px;
        background: #f8fafc;
        padding: 8px 9px;
        font-size: 10px;
        color: #374151;
    }

    /* =========================================================
       BUTTON MODAL
    ========================================================= */
    .btn-batal-obat {
        background: #f1f5f9;
        border: none;
        color: #64748b;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        cursor: pointer;
    }

    .btn-batal-obat:hover {
        background: #e2e8f0;
        color: #374151;
    }

    .btn-simpan-obat {
        background: var(--blue-main);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .btn-simpan-obat:hover {
        background: var(--blue-dark);
    }

    .error-obat {
        color: #dc3545;
        font-size: 8px;
        margin-top: 3px;
        display: block;
    }

    @media (max-width: 768px) {
        .master-obat-page {
            padding: 18px 12px;
        }

        .obat-header {
            align-items: flex-start;
            gap: 12px;
        }

        .obat-title {
            font-size: 16px;
        }

        .modal-obat .modal-dialog {
            max-width: calc(100% - 30px);
            margin: 15px auto;
        }
    }
</style>

{{-- =========================================================
     HALAMAN MASTER OBAT
========================================================= --}}
<div class="master-obat-page">

    <div class="obat-header">

        <div class="obat-title-wrapper">

            <div class="obat-icon">
                <i class="fas fa-pills"></i>
            </div>

            <div>
                <h2 class="obat-title">Master Obat</h2>
                <p class="obat-subtitle">Data obat yang terdaftar</p>
            </div>

        </div>

        <button
            type="button"
            class="btn-tambah-obat"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahObat"
        >
            <i class="fas fa-plus"></i>
            Tambah Obat
        </button>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   @extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Obat')

@section('content')

<style>
    /* =====================================================
       MASTER OBAT
    ====================================================== */
    .master-obat {
        padding: 10px 5px 30px;
    }

    /* =====================================================
       HEADER ATAS
    ====================================================== */
    .obat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .obat-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .obat-header-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #e7f3ff;
        color: #1877f2;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 16px;
        flex-shrink: 0;
    }

    .obat-header-title h4 {
        margin: 0;
        color: #1f2937;
        font-size: 20px;
        font-weight: 700;
    }

    .obat-header-title small {
        display: block;
        margin-top: 2px;
        color: #8492a6;
        font-size: 12px;
    }

    /* =====================================================
       TOMBOL TAMBAH
    ====================================================== */
    .btn-tambah-obat {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;

        background: #1877f2 !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 7px;

        padding: 10px 15px;

        font-size: 13px;
        font-weight: 600;

        text-decoration: none !important;

        box-shadow: 0 2px 5px rgba(24, 119, 242, 0.20);

        transition: all 0.2s ease;
    }

    .btn-tambah-obat:hover {
        background: #0f58c6 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* =====================================================
       CARD TABLE
    ====================================================== */
    .obat-card {
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;

        border: 1px solid #edf0f4;

        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
    }

    .obat-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* =====================================================
       TABLE
    ====================================================== */
    .obat-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    /* HEADER TABLE */
    .obat-table thead {
        background: #1877f2;
    }

    .obat-table thead th {
        background: #1877f2 !important;
        color: #ffffff !important;

        padding: 13px 15px;

        font-size: 12px;
        font-weight: 700;

        border: none;

        text-align: left;
        white-space: nowrap;
    }

    /* BODY TABLE */
    .obat-table tbody td {
        background: #ffffff;
        color: #4b5563;

        padding: 12px 15px;

        font-size: 13px;

        border-bottom: 1px solid #f0f2f5;

        vertical-align: middle;
    }

    .obat-table tbody tr:last-child td {
        border-bottom: none;
    }

    .obat-table tbody tr:hover td {
        background: #f8fbff;
    }

    /* =====================================================
       KOLOM
    ====================================================== */

    /* NO */
    .kolom-no {
        width: 60px;
    }

    .nomor-obat {
        color: #6b7280;
    }

    /* NAMA OBAT */
    .nama-obat-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .icon-obat {
        width: 30px;
        height: 30px;

        border-radius: 50%;

        background: #e7f3ff;
        color: #1877f2;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        font-size: 12px;
    }

    .nama-obat {
        color: #1f2937;
        font-weight: 700;
    }

    /* =====================================================
       KATEGORI
    ====================================================== */
    .badge-kategori {
        display: inline-flex;
        align-items: center;

        background: #e7f3ff;
        color: #1877f2;

        border-radius: 5px;

        padding: 5px 10px;

        font-size: 11px;
        font-weight: 600;
    }

    /* =====================================================
       AKSI
    ====================================================== */
    .kolom-aksi {
        width: 210px;
        text-align: center !important;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .action-buttons form {
        margin: 0;
        padding: 0;
    }

    .btn-aksi {
        min-width: 52px;
        height: 38px;

        border: none;
        border-radius: 6px;

        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        gap: 2px;

        padding: 4px 8px;

        font-size: 10px;
        font-weight: 600;

        text-decoration: none !important;

        cursor: pointer;

        transition: all 0.2s ease;
    }

    .btn-aksi i {
        font-size: 11px;
    }

    /* LIHAT */
    .btn-lihat {
        background: #dff3ff;
        color: #0786c8;
    }

    .btn-lihat:hover {
        background: #c8ebff;
        color: #0677b2;
    }

    /* EDIT */
    .btn-edit {
        background: #1877f2;
        color: #ffffff;
    }

    .btn-edit:hover {
        background: #0f58c6;
        color: #ffffff;
    }

    /* HAPUS */
    .btn-hapus {
        background: #ef4444;
        color: #ffffff;
    }

    .btn-hapus:hover {
        background: #dc2626;
        color: #ffffff;
    }

    /* =====================================================
       DATA KOSONG
    ====================================================== */
    .empty-data {
        text-align: center;
        padding: 45px 20px !important;
    }

    .empty-icon {
        width: 55px;
        height: 55px;

        margin: 0 auto 10px;

        border-radius: 50%;

        background: #e7f3ff;
        color: #1877f2;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 22px;
    }

    .empty-data h6 {
        margin: 0 0 4px;
        color: #374151;
        font-weight: 700;
    }

    .empty-data p {
        margin: 0;
        color: #9ca3af;
        font-size: 12px;
    }

    /* =====================================================
       RESPONSIVE
    ====================================================== */
    @media (max-width: 768px) {

        .master-obat {
            padding: 8px 2px 25px;
        }

        .obat-header {
            gap: 15px;
        }

        .obat-header-title h4 {
            font-size: 17px;
        }

        .obat-header-title small {
            font-size: 10px;
        }

        .btn-tambah-obat {
            padding: 8px 11px;
            font-size: 11px;
        }

        .obat-table {
            min-width: 700px;
        }
    }
</style>


<div class="master-obat">

    {{-- =====================================================
         HEADER MASTER OBAT
    ====================================================== --}}
    <div class="obat-header">

        <div class="obat-header-left">

            {{-- ICON --}}
            <div class="obat-header-icon">
                <i class="fas fa-pills"></i>
            </div>

            {{-- JUDUL --}}
            <div class="obat-header-title">
                <h4>Master Obat</h4>
                <small>Data obat yang terdaftar</small>
            </div>

        </div>


        {{-- TOMBOL TAMBAH OBAT --}}
        <a href="{{ route('master-obat.create') }}"
           class="btn-tambah-obat">

            <i class="fas fa-plus"></i>

            Tambah Obat

        </a>

    </div>


    {{-- =====================================================
         TABLE
    ====================================================== --}}
    <div class="obat-card">

        <div class="obat-table-wrapper">

            <table class="obat-table">

                {{-- HEADER TABLE --}}
                <thead>

                    <tr>

                        <th class="kolom-no">
                            No
                        </th>

                        <th>
                            Nama Obat
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th class="kolom-aksi">
                            Aksi
                        </th>

                    </tr>

                </thead>


                {{-- BODY TABLE --}}
                <tbody>

                    @forelse($obats as $index => $obat)

                        <tr>

                            {{-- =========================
                                 NO
                            ========================== --}}
                            <td class="nomor-obat">

                                {{ $index + 1 }}

                            </td>


                            {{-- =========================
                                 NAMA OBAT
                            ========================== --}}
                            <td>

                                <div class="nama-obat-wrapper">

                                    <div class="icon-obat">
                                        <i class="fas fa-capsules"></i>
                                    </div>

                                    <span class="nama-obat">
                                        {{ $obat->nama }}
                                    </span>

                                </div>

                            </td>


                            {{-- =========================
                                 KATEGORI
                            ========================== --}}
                            <td>

                                <span class="badge-kategori">

                                    {{ $obat->kategori->nama ?? '-' }}

                                </span>

                            </td>


                            {{-- =========================
                                 AKSI
                            ========================== --}}
                            <td>

                                <div class="action-buttons">


                                    {{-- LIHAT --}}
                                    <a href="{{ route('master-obat.show', $obat->id) }}"
                                       class="btn-aksi btn-lihat"
                                       title="Lihat">

                                        <i class="fas fa-eye"></i>

                                        <span>
                                            Lihat
                                        </span>

                                    </a>


                                    {{-- EDIT --}}
                                    <a href="{{ route('master-obat.edit', $obat->id) }}"
                                       class="btn-aksi btn-edit"
                                       title="Edit">

                                        <i class="fas fa-edit"></i>

                                        <span>
                                            Edit
                                        </span>

                                    </a>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('master-obat.destroy', $obat->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus obat ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-aksi btn-hapus"
                                            title="Hapus"
                                        >

                                            <i class="fas fa-trash"></i>

                                            <span>
                                                Hapus
                                            </span>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- =============================
                             JIKA DATA KOSONG
                        ============================== --}}
                        <tr>

                            <td colspan="4"
                                class="empty-data">

                                <div class="empty-icon">
                                    <i class="fas fa-pills"></i>
                                </div>

                                <h6>
                                    Belum Ada Data Obat
                                </h6>

                                <p>
                                    Silakan tambahkan data obat terlebih dahulu.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

            {{-- =========================================================
                MODAL TAMBAH OBAT
            ========================================================= --}}
            <div
                class="modal fade modal-obat"
                id="modalTambahObat"
                tabindex="-1"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fas fa-pills"></i>
                                Tambah Obat
                            </h5>
                        </div>

                        <form
                            action="{{ route('master-obat.store') }}"
                            method="POST"
                        >
                            @csrf

                            <div class="modal-body">

                                {{-- KODE OBAT --}}
                                <div class="form-obat-group">

                                    <label class="form-obat-label">
                                        Kode Obat
                                    </label>

                                    <input
                                        type="text"
                                        name="kode"
                                        class="form-obat-control"
                                        placeholder="Masukkan kode obat"
                                        value="{{ old('kode') }}"
                                        required
                                    >

                                    @error('kode_obat')
                                        <span class="error-obat">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


            {{-- =================================================
                NAMA OBAT - BANYAK PILIHAN + SEARCH
            ================================================== --}}
            <div class="form-obat-group">

                <label class="form-obat-label">
                    Nama Obat
                </label>

                <select
                    name="nama"
                    class="form-obat-control select2-obat"
                    data-placeholder="Cari / pilih nama obat..."
                    required
                >

                    <option value=""></option>

                    @foreach($daftarNamaObat as $namaObat)

                        <option
                            value="{{ $namaObat }}"
                            {{ old('nama') == $namaObat ? 'selected' : '' }}
                        >
                            {{ $namaObat }}
                        </option>

                    @endforeach

                </select>

                @error('nama')
                    <span class="error-obat">
                        {{ $message }}
                    </span>
                @enderror

            </div>


            {{-- =================================================
                KATEGORI
            ================================================== --}}
            <div class="form-obat-group">

                <label class="form-obat-label">
                    Kategori
                </label>

                <select
                    name="kategori_id"
                    class="form-obat-control"
                    required
                >

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    @foreach($kategoris as $kategori)

                        <option
                            value="{{ $kategori->id }}"
                            {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}
                        >
                            {{ $kategori->nama }}
                        </option>

                    @endforeach

                </select>

                @error('kategori_id')
                    <span class="error-obat">
                        {{ $message }}
                    </span>
                @enderror

            </div>


                   

                    {{-- SATUAN --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Satuan
                        </label>

                        <select
                            name="satuan"
                            class="form-obat-control select2-obat"
                            data-placeholder="Cari / pilih satuan..."
                            required
                        >

                            <option value=""></option>

                            @foreach($satuans as $satuan)

                                <option
                                    value="{{ $satuan->nama }}"
                                    {{ old('satuan') == $satuan->nama ? 'selected' : '' }}
                                >
                                    {{ $satuan->nama }}
                                </option>

                            @endforeach

                        </select>

                        @error('satuan')
                            <span class="error-obat">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- HARGA --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Harga
                        </label>

                        <div style="position:relative;">

                            <span
                                style="
                                    position:absolute;
                                    left:9px;
                                    top:50%;
                                    transform:translateY(-50%);
                                    font-size:10px;
                                    color:#6b7280;
                                    z-index:2;
                                "
                            >
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga"
                                class="form-obat-control"
                                style="padding-left:25px;"
                                placeholder="Masukkan harga obat"
                                value="{{ old('harga') }}"
                                min="0"
                                required
                            >

                        </div>

                        @error('harga')
                            <span class="error-obat">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-obat"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-simpan-obat"
                    >
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- =========================================================
     MODAL EDIT OBAT
========================================================= --}}
@foreach($obats as $obat)

<div
    class="modal fade modal-obat"
    id="modalEditObat{{ $obat->id }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Obat
                </h5>
            </div>

            <form
                action="{{ route('master-obat.update', $obat->id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Kode Obat
                        </label>

                        <input
                            type="text"
                            name="kode_obat"
                            class="form-obat-control"
                            value="{{ $obat->kode_obat }}"
                            required
                        >

                    </div>


                    {{-- =================================================
                         NAMA OBAT - BANYAK PILIHAN + SEARCH
                    ================================================== --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Nama Obat
                        </label>

                        <select
                            name="nama_obat"
                            class="form-obat-control select2-obat"
                            data-placeholder="Cari / pilih nama obat..."
                            required
                        >

                            <option value=""></option>

                            {{-- Jika nama lama tidak ada di daftar, tetap tampilkan --}}
                            @if(
                                $obat->nama_obat &&
                                !in_array($obat->nama_obat, $daftarNamaObat)
                            )
                                <option
                                    value="{{ $obat->nama_obat }}"
                                    selected
                                >
                                    {{ $obat->nama_obat }}
                                </option>
                            @endif

                            @foreach($daftarNamaObat as $namaObat)

                                <option
                                    value="{{ $namaObat }}"
                                    {{ $obat->nama_obat == $namaObat ? 'selected' : '' }}
                                >
                                    {{ $namaObat }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- KATEGORI --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Kategori
                        </label>

                        <select
                            name="kategori"
                            class="form-obat-control select2-obat"
                            data-placeholder="Cari / pilih kategori..."
                            required
                        >

                            <option value=""></option>

                            @foreach($kategoris as $kategori)

                                <option
                                    value="{{ $kategori->nama }}"
                                    {{ $obat->kategori == $kategori->nama ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- SATUAN --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Satuan
                        </label>

                        <select
                            name="satuan"
                            class="form-obat-control select2-obat"
                            data-placeholder="Cari / pilih satuan..."
                            required
                        >

                            <option value=""></option>

                            @foreach($satuans as $satuan)

                                <option
                                    value="{{ $satuan->nama }}"
                                    {{ $obat->satuan == $satuan->nama ? 'selected' : '' }}
                                >
                                    {{ $satuan->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- HARGA --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Harga
                        </label>

                        <div style="position:relative;">

                            <span
                                style="
                                    position:absolute;
                                    left:9px;
                                    top:50%;
                                    transform:translateY(-50%);
                                    font-size:10px;
                                    color:#6b7280;
                                    z-index:2;
                                "
                            >
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga"
                                class="form-obat-control"
                                style="padding-left:25px;"
                                value="{{ $obat->harga }}"
                                min="0"
                                required
                            >

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-obat"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-simpan-obat"
                    >
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endforeach


{{-- =========================================================
     MODAL LIHAT OBAT
========================================================= --}}
@foreach($obats as $obat)

<div
    class="modal fade modal-obat"
    id="modalLihatObat{{ $obat->id }}"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-eye"></i>
                    Detail Obat
                </h5>

            </div>

            <div class="modal-body">

                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Kode Obat
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->kode_obat }}
                    </div>

                </div>

                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Nama Obat
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->nama_obat }}
                    </div>

                </div>

                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Kategori
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->kategori }}
                    </div>

                </div>

                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Satuan
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->satuan }}
                    </div>

                </div>

                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Harga
                    </label>

                    <div class="view-obat-value">
                        Rp {{ number_format($obat->harga, 0, ',', '.') }}
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-batal-obat"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>
</div>

@endforeach


{{-- =========================================================
     JQUERY + SELECT2
========================================================= --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function () {

        /*
        |--------------------------------------------------------------------------
        | SELECT2 MODAL TAMBAH
        |--------------------------------------------------------------------------
        */
        $('#modalTambahObat').on('shown.bs.modal', function () {

            $(this).find('.select2-obat').each(function () {

                let select = $(this);

                if (select.hasClass('select2-hidden-accessible')) {
                    select.select2('destroy');
                }

                select.select2({
                    width: '100%',
                    placeholder: select.data('placeholder'),
                    allowClear: true,
                    dropdownParent: $('#modalTambahObat')
                });

            });

        });


        /*
        |--------------------------------------------------------------------------
        | SELECT2 MODAL EDIT
        |--------------------------------------------------------------------------
        */
        @foreach($obats as $obat)

            $('#modalEditObat{{ $obat->id }}').on(
                'shown.bs.modal',
                function () {

                    $(this).find('.select2-obat').each(function () {

                        let select = $(this);

                        if (
                            select.hasClass(
                                'select2-hidden-accessible'
                            )
                        ) {
                            select.select2('destroy');
                        }

                        select.select2({
                            width: '100%',
                            placeholder: select.data('placeholder'),
                            allowClear: true,
                            dropdownParent:
                                $('#modalEditObat{{ $obat->id }}')
                        });

                    });

                }
            );

        @endforeach


        /*
        |--------------------------------------------------------------------------
        | HANCURKAN SELECT2 SAAT MODAL DITUTUP
        |--------------------------------------------------------------------------
        */
        $('.modal-obat').on('hidden.bs.modal', function () {

            $(this).find('.select2-obat').each(function () {

                let select = $(this);

                if (select.hasClass('select2-hidden-accessible')) {
                    select.select2('destroy');
                }

            });

        });


        /*
        |--------------------------------------------------------------------------
        | BUKA MODAL TAMBAH LAGI JIKA VALIDASI GAGAL
        |--------------------------------------------------------------------------
        */
        @if($errors->any())

            const modalTambah = new bootstrap.Modal(
                document.getElementById('modalTambahObat')
            );

            modalTambah.show();

        @endif

    });
</script>

@endsection
