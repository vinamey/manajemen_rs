@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Obat')

@section('content')

{{-- =========================================================
    SELECT2 CSS
========================================================= --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

    /* HEADER TABLE */
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

    /* BODY TABLE */
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
       NO
    ========================================================= */
    .nomor {
        width: 45px;
        color: #6b7280 !important;
    }

    /* =========================================================
       KODE OBAT
    ========================================================= */
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

    /* =========================================================
       NAMA OBAT
    ========================================================= */
    .nama-obat {
        min-width: 180px;
        font-weight: 600;
        color: #1f2937 !important;
    }

    /* =========================================================
       KATEGORI
    ========================================================= */
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

    /* =========================================================
       SATUAN
    ========================================================= */
    .satuan-obat {
        min-width: 100px;
        color: #6b7280;
    }

    /* =========================================================
       HARGA
    ========================================================= */
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

    /* LIHAT */
    .btn-lihat {
        background: #dff2ff;
        color: #087db9;
    }

    .btn-lihat:hover {
        background: #c8eaff;
        color: #087db9;
    }

    /* EDIT */
    .btn-edit {
        background: var(--blue-main);
        color: white;
    }

    .btn-edit:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* HAPUS */
    .btn-hapus {
        background: #ff4b4b;
        color: white;
    }

    .btn-hapus:hover {
        background: #dc3030;
        color: white;
    }

    /* =========================================================
       DATA KOSONG
    ========================================================= */
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

    .select2-container--default
    .select2-results__option {
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

    /* =========================================================
       ERROR
    ========================================================= */
    .error-obat {
        color: #dc3545;
        font-size: 8px;
        margin-top: 3px;
        display: block;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
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

    {{-- HEADER --}}
    <div class="obat-header">

        <div class="obat-title-wrapper">

            <div class="obat-icon">
                <i class="fas fa-pills"></i>
            </div>

            <div>
                <h2 class="obat-title">
                    Master Obat
                </h2>

                <p class="obat-subtitle">
                    Data obat yang terdaftar
                </p>
            </div>

        </div>


        {{-- TOMBOL TAMBAH --}}
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


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- ERROR --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         TABLE
    ====================================================== --}}
    <div class="obat-card">

        <div class="obat-table-wrapper">

            <table class="obat-table">

                <thead>

                    <tr>

                        <th style="width: 45px;">
                            No
                        </th>

                        <th>
                            Kode
                        </th>

                        <th>
                            Nama Obat
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th>
                            Satuan
                        </th>

                        <th>
                            Harga
                        </th>

                        <th class="aksi-header">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($obats as $obat)

                        <tr>

                            {{-- NO --}}
                            <td class="nomor">
                                {{ $loop->iteration }}
                            </td>


                            {{-- KODE --}}
                            <td class="kode-obat">

                                <span class="kode-obat-badge">
                                    {{ $obat->kode_obat }}
                                </span>

                            </td>


                            {{-- NAMA --}}
                            <td class="nama-obat">
                                {{ $obat->nama_obat }}
                            </td>


                            {{-- KATEGORI --}}
                            <td class="kategori-obat">

                                <span class="badge-kategori">
                                    {{ $obat->kategori }}
                                </span>

                            </td>


                            {{-- SATUAN --}}
                            <td class="satuan-obat">
                                {{ $obat->satuan }}
                            </td>


                            {{-- HARGA --}}
                            <td class="harga-obat">
                                Rp {{ number_format($obat->harga, 0, ',', '.') }}
                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="aksi-wrapper">

                                    {{-- LIHAT --}}
                                    <button
                                        type="button"
                                        class="btn-aksi btn-lihat"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLihatObat{{ $obat->id }}"
                                    >
                                        <i class="fas fa-eye"></i>
                                        Lihat
                                    </button>


                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        class="btn-aksi btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditObat{{ $obat->id }}"
                                    >
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('master-obat.destroy', $obat->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-aksi btn-hapus"
                                            onclick="return confirm('Yakin ingin menghapus obat ini?')"
                                        >
                                            <i class="fas fa-trash"></i>
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="data-kosong"
                            >
                                Belum ada data obat.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



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

            {{-- HEADER --}}
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

                    {{-- KODE --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Kode Obat
                        </label>

                        <input
                            type="text"
                            name="kode_obat"
                            class="form-obat-control"
                            placeholder="Masukkan kode obat"
                            value="{{ old('kode_obat') }}"
                            required
                        >

                        @error('kode_obat')

                            <span class="error-obat">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- NAMA OBAT --}}
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

                            @foreach($obats->unique('nama_obat') as $obatName)

                                <option
                                    value="{{ $obatName->nama_obat }}"
                                    {{ old('nama_obat') == $obatName->nama_obat ? 'selected' : '' }}
                                >
                                    {{ $obatName->nama_obat }}
                                </option>

                            @endforeach

                        </select>

                        @error('nama_obat')

                            <span class="error-obat">
                                {{ $message }}
                            </span>

                        @enderror

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
                                    {{ old('kategori') == $kategori->nama ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama }}
                                </option>

                            @endforeach

                        </select>

                        @error('kategori')

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

                        <div style="position: relative;">

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


                {{-- FOOTER --}}
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

            {{-- HEADER --}}
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


                    {{-- NAMA OBAT --}}
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

                            @foreach($obats->unique('nama_obat') as $obatName)

                                <option
                                    value="{{ $obatName->nama_obat }}"
                                    {{ $obat->nama_obat == $obatName->nama_obat ? 'selected' : '' }}
                                >
                                    {{ $obatName->nama_obat }}
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

                        <div style="position: relative;">

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


                {{-- FOOTER --}}
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

            {{-- HEADER --}}
            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-eye"></i>

                    Detail Obat

                </h5>

            </div>


            {{-- BODY --}}
            <div class="modal-body">

                {{-- KODE --}}
                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Kode Obat
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->kode_obat }}
                    </div>

                </div>


                {{-- NAMA --}}
                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Nama Obat
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->nama_obat }}
                    </div>

                </div>


                {{-- KATEGORI --}}
                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Kategori
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->kategori }}
                    </div>

                </div>


                {{-- SATUAN --}}
                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Satuan
                    </label>

                    <div class="view-obat-value">
                        {{ $obat->satuan }}
                    </div>

                </div>


                {{-- HARGA --}}
                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Harga
                    </label>

                    <div class="view-obat-value">
                        Rp {{ number_format($obat->harga, 0, ',', '.') }}
                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
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
        | SELECT2 UNTUK MODAL TAMBAH
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
        | SELECT2 UNTUK MODAL EDIT
        |--------------------------------------------------------------------------
        */

        @foreach($obats as $obat)

            $('#modalEditObat{{ $obat->id }}').on('shown.bs.modal', function () {

                $(this).find('.select2-obat').each(function () {

                    let select = $(this);

                    if (select.hasClass('select2-hidden-accessible')) {
                        select.select2('destroy');
                    }

                    select.select2({
                        width: '100%',
                        placeholder: select.data('placeholder'),
                        allowClear: true,
                        dropdownParent: $('#modalEditObat{{ $obat->id }}')
                    });

                });

            });

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

    });

</script>

@endsection
