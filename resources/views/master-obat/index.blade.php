@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Obat')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    /* =========================
       HALAMAN
    ========================= */
    .master-obat-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 20px 18px;
    }

    /* =========================
       HEADER
    ========================= */
    .obat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 17px;
    }

    .obat-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .obat-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: var(--blue-light);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .obat-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .obat-subtitle {
        margin: 3px 0 0;
        font-size: 9px;
        color: var(--text-muted);
    }

    /* =========================
       BUTTON TAMBAH
    ========================= */
    .btn-tambah-obat {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .btn-tambah-obat:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* =========================
       CARD TABLE
    ========================= */
    .obat-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .obat-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .obat-table {
        width: 100%;
        min-width: 900px;
        border-collapse: collapse;
        margin: 0;
    }

    .obat-table thead th {
        background: var(--blue-main);
        color: white;
        font-size: 9px;
        font-weight: 600;
        padding: 11px 10px;
        border: none;
        white-space: nowrap;
        text-align: left;
    }

    .obat-table tbody td {
        padding: 10px;
        font-size: 9px;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4;
        vertical-align: middle;
        background: white;
    }

    .obat-table tbody tr:hover td {
        background: #fafcff;
    }

    .nomor {
        width: 45px;
    }

    /* =========================
       KODE
    ========================= */
    .kode-obat {
        white-space: nowrap;
    }

    .kode-obat-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 5px;
        background: #e7f3ff;
        color: #1877f2;
        font-size: 8px;
        font-weight: 600;
    }

    /* =========================
       NAMA
    ========================= */
    .nama-obat {
        font-weight: 600;
        color: #1f2937 !important;
        min-width: 130px;
    }

    /* =========================
       KATEGORI
    ========================= */
    .badge-kategori {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 5px;
        background: #fff0d5;
        color: #e8791b;
        font-size: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================
       SATUAN
    ========================= */
    .satuan-obat {
        color: #6b7280;
        white-space: nowrap;
    }

    /* =========================
       HARGA
    ========================= */
    .harga-obat {
        color: #374151 !important;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================
       STOK
    ========================= */
    .stok-wrapper {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .badge-stok {
        width: fit-content;
        padding: 4px 7px;
        border-radius: 5px;
        font-size: 8px;
        font-weight: 600;
        white-space: nowrap;
    }

    .stok-aman {
        background: #d9f8e5;
        color: #198754;
    }

    .stok-menipis {
        background: #fff0c9;
        color: #a16207;
    }

    .stok-habis {
        background: #ffe0e0;
        color: #dc3545;
    }

    .jumlah-stok {
        font-size: 8px;
        color: #6b7280;
    }

    /* =========================
       AKSI
    ========================= */
    .aksi-wrapper {
        display: flex;
        gap: 4px;
        align-items: center;
        white-space: nowrap;
    }

    .btn-aksi {
        border: none;
        border-radius: 5px;
        padding: 6px 8px;
        font-size: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        cursor: pointer;
        transition: 0.2s;
        min-width: 43px;
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

    /* =========================
       ALERT
    ========================= */
    .alert-success,
    .alert-danger {
        margin: 0 0 12px;
        border-radius: 7px;
        font-size: 10px;
        padding: 8px 11px;
    }

    /* =========================
       DATA KOSONG
    ========================= */
    .data-kosong {
        text-align: center;
        padding: 30px !important;
        color: #9ca3af !important;
    }

    /* =====================================================
       MODAL
    ===================================================== */

    .modal-obat .modal-dialog {
        max-width: 600px;
    }

    .modal-obat .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0,0,0,0.20);
    }

    /* HEADER MODAL BIRU */
    .modal-obat .modal-header {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 13px 15px;
    }

    .modal-obat .modal-title {
        font-size: 13px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    /*
       TIDAK ADA TOMBOL X
    */

    .modal-obat .modal-body {
        background: white;
        padding: 18px 15px;
    }

    .modal-obat .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 10px 15px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
    }

    /* =========================
       FORM
    ========================= */
    .form-obat-group {
        margin-bottom: 10px;
    }

    .form-obat-label {
        display: block;
        font-size: 9px;
        font-weight: 500;
        color: #526071;
        margin-bottom: 5px;
    }

    .form-obat-control {
        width: 100%;
        min-height: 32px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 6px 9px;
        font-size: 9px;
        color: #374151;
        outline: none;
        background: white;
        transition: 0.2s;
    }

    .form-obat-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24,119,242,0.10);
    }

    .form-obat-control::placeholder {
        color: #9ca3af;
    }

    select.form-obat-control {
        cursor: pointer;
    }

    textarea.form-obat-control {
        min-height: 60px;
        resize: vertical;
    }

    /* =========================
       HARGA
    ========================= */
    .harga-input-wrapper {
        position: relative;
    }

    .harga-prefix {
        position: absolute;
        left: 9px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 9px;
        color: #6b7280;
        z-index: 2;
    }

    .harga-input {
        padding-left: 24px !important;
    }

    /* =========================
       VIEW / LIHAT
    ========================= */
    .view-obat-value {
        width: 100%;
        min-height: 32px;
        border: 1px solid #e1e7ef;
        border-radius: 6px;
        background: #f8fafc;
        padding: 8px 9px;
        font-size: 9px;
        color: #374151;
    }

    /* =========================
       BUTTON MODAL
    ========================= */
    .btn-batal-obat {
        background: #f1f5f9;
        border: none;
        color: #64748b;
        border-radius: 6px;
        padding: 7px 12px;
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
        padding: 7px 12px;
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

    /* =========================
       ERROR
    ========================= */
    .error-obat {
        color: #dc3545;
        font-size: 8px;
        margin-top: 3px;
        display: block;
    }

    /* =========================
       RESPONSIVE
    ========================= */
    @media (max-width: 768px) {
        .master-obat-page {
            padding: 18px 12px;
        }

        .obat-header {
            align-items: flex-start;
            gap: 12px;
        }

        .modal-obat .modal-dialog {
            max-width: calc(100% - 30px);
            margin: 15px auto;
        }
    }
</style>


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

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- TABLE --}}
    <div class="obat-card">

        <div class="obat-table-wrapper">

            <table class="obat-table">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
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
                            <td>

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


                            {{-- STOK --}}
                            <td>

                                <div class="stok-wrapper">

                                    @if($obat->stok <= 0)

                                        <span class="badge-stok stok-habis">
                                            Habis
                                        </span>

                                    @elseif($obat->stok <= 5)

                                        <span class="badge-stok stok-menipis">
                                            Stok Menipis
                                        </span>

                                    @else

                                        <span class="badge-stok stok-aman">
                                            Stok Aman
                                        </span>

                                    @endif


                                    <span class="jumlah-stok">
                                        {{ $obat->stok }} {{ $obat->satuan }}
                                    </span>

                                </div>

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
                                colspan="8"
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


                    {{-- NAMA OBAT LIST --}}

                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Nama Obat
                        </label>

                        <select
                            name="nama_obat"
                            class="form-obat-control"
                            required
                        >

                            <option value="">
                                -- Pilih Nama Obat --
                            </option>

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
                            class="form-obat-control"
                            required
                        >

                            <option value="">
                                -- Pilih Kategori --
                            </option>

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
                            class="form-obat-control"
                            required
                        >

                            <option value="">
                                -- Pilih Satuan --
                            </option>

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

                        <div class="harga-input-wrapper">

                            <span class="harga-prefix">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga"
                                class="form-obat-control harga-input"
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


                    {{-- STOK --}}

                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            class="form-obat-control"
                            placeholder="Masukkan jumlah stok"
                            value="{{ old('stok') }}"
                            min="0"
                            required
                        >

                        @error('stok')
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


                    {{-- NAMA --}}

                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Nama Obat
                        </label>

                        <select
                            name="nama_obat"
                            class="form-obat-control"
                            required
                        >

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
                            class="form-obat-control"
                            required
                        >

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
                            class="form-obat-control"
                            required
                        >

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

                        <div class="harga-input-wrapper">

                            <span class="harga-prefix">
                                Rp
                            </span>

                            <input
                                type="number"
                                name="harga"
                                class="form-obat-control harga-input"
                                value="{{ $obat->harga }}"
                                min="0"
                                required
                            >

                        </div>

                    </div>


                    {{-- STOK --}}

                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            class="form-obat-control"
                            value="{{ $obat->stok }}"
                            min="0"
                            required
                        >

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


                {{-- STOK --}}

                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Stok
                    </label>

                    <div class="view-obat-value">

                        {{ $obat->stok }}
                        {{ $obat->satuan }}

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

@endsection
