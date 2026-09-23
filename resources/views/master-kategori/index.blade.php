@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Kategori')

@section('content')

<style>
    /* =========================================================
       MASTER KATEGORI
    ========================================================= */

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

    .master-kategori-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 20px 18px;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 17px;
    }

    .kategori-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kategori-icon {
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

    .kategori-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.2;
    }

    .kategori-subtitle {
        margin: 3px 0 0;
        font-size: 9px;
        color: var(--text-muted);
    }

    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */

    .btn-tambah-kategori {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: 0.2s;
        cursor: pointer;
    }

    .btn-tambah-kategori:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* =========================================================
       CARD TABLE
    ========================================================= */

    .kategori-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .kategori-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .kategori-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
        min-width: 650px;
    }

    /* =========================================================
       TABLE HEADER
    ========================================================= */

    .kategori-table thead th {
        background: var(--blue-main);
        color: white;
        font-size: 9px;
        font-weight: 600;
        padding: 11px 10px;
        border: none;
        white-space: nowrap;
        text-align: left;
    }

    /* =========================================================
       TABLE BODY
    ========================================================= */

    .kategori-table tbody td {
        padding: 10px;
        font-size: 9px;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4;
        vertical-align: middle;
        background: white;
    }

    .kategori-table tbody tr:last-child td {
        border-bottom: none;
    }

    .kategori-table tbody tr:hover td {
        background: #fafcff;
    }

    /* =========================================================
       NO
    ========================================================= */

    .nomor-kategori {
        width: 50px;
        color: #6b7280 !important;
    }

    /* =========================================================
       KODE KATEGORI
    ========================================================= */

    .kode-kategori {
        white-space: nowrap;
    }

    .kode-kategori-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #e7f3ff;
        color: #1877f2;
        font-size: 8px;
        font-weight: 600;
    }

    /* =========================================================
       NAMA KATEGORI
    ========================================================= */

    .nama-kategori {
        font-weight: 600;
        color: #1f2937 !important;
    }

    .nama-kategori-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #fff1e6;
        color: #e67e22;
        font-size: 8px;
        font-weight: 600;
    }

    /* =========================================================
       AKSI
    ========================================================= */

    .aksi-wrapper {
        display: flex;
        gap: 5px;
        align-items: center;
        white-space: nowrap;
    }

    .btn-aksi-kategori {
        border: none;
        border-radius: 5px;
        padding: 6px 9px;
        font-size: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        line-height: 1;
    }

    /* =========================================================
       LIHAT - BIRU MUDA SEPERTI GAMBAR
    ========================================================= */

    .btn-lihat-kategori {
        background: #e7f3ff;
        color: #1877f2;
    }

    .btn-lihat-kategori:hover {
        background: #d5eaff;
        color: #0f58c6;
    }

    .btn-lihat-kategori i {
        color: #1877f2;
    }

    /* =========================================================
       EDIT - BIRU
    ========================================================= */

    .btn-edit-kategori {
        background: #1877f2;
        color: white;
    }

    .btn-edit-kategori:hover {
        background: #0f58c6;
        color: white;
    }

    /* =========================================================
       HAPUS - MERAH
    ========================================================= */

    .btn-hapus-kategori {
        background: #ff4b4b;
        color: white;
    }

    .btn-hapus-kategori:hover {
        background: #dc3030;
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
        padding: 8px 11px;
    }

    .alert-danger ul {
        padding-left: 16px;
    }

    /* =========================================================
       DATA KOSONG
    ========================================================= */

    .data-kosong {
        text-align: center;
        padding: 30px !important;
        color: #9ca3af !important;
    }

    /* =========================================================
       MODAL
    ========================================================= */

    .modal-kategori-besar {
        max-width: 560px !important;
    }

    .modal-kategori-besar .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
    }

    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-kategori-besar .modal-header {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 15px 20px;
    }

    .modal-kategori-besar .modal-title {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    .modal-kategori-besar .modal-title i {
        margin-right: 5px;
    }

    /* =========================================================
       MODAL BODY
    ========================================================= */

    .modal-kategori-besar .modal-body {
        padding: 22px 25px;
        background: white;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .form-kategori-group {
        margin-bottom: 16px;
    }

    .form-kategori-group:last-child {
        margin-bottom: 0;
    }

    .form-kategori-label {
        display: block;
        font-size: 10px;
        font-weight: 500;
        color: #526071;
        margin-bottom: 6px;
    }

    .form-kategori-control {
        width: 100%;
        height: 40px;
        border: 1px solid #d4dce6;
        border-radius: 7px;
        padding: 8px 11px;
        font-size: 10px;
        color: #374151;
        outline: none;
        background: white;
        transition: 0.2s;
    }

    .form-kategori-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.10);
    }

    .form-kategori-control::placeholder {
        color: #9ca3af;
    }

    /* =========================================================
       SELECT2
    ========================================================= */

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 40px !important;
        border: 1px solid #d4dce6 !important;
        border-radius: 7px !important;
        display: flex !important;
        align-items: center !important;
        background: white !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        color: #374151 !important;
        font-size: 10px !important;
        line-height: 38px !important;
        padding-left: 11px !important;
        padding-right: 30px !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__placeholder {
        color: #9ca3af !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        height: 38px !important;
        right: 8px !important;
    }

    .select2-container--default.select2-container--open
    .select2-selection--single {
        border-color: var(--blue-main) !important;
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.10) !important;
    }

    .select2-dropdown {
        border: 1px solid #1877f2 !important;
        border-radius: 7px !important;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
    }

    .select2-search--dropdown {
        padding: 8px !important;
        background: white;
    }

    .select2-search--dropdown .select2-search__field {
        height: 34px !important;
        border: 1px solid #d4dce6 !important;
        border-radius: 6px !important;
        padding: 5px 8px !important;
        font-size: 10px !important;
        outline: none;
    }

    .select2-search--dropdown .select2-search__field:focus {
        border-color: #1877f2 !important;
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.10);
    }

    .select2-results__option {
        font-size: 10px !important;
        padding: 8px 10px !important;
    }

    .select2-container--default
    .select2-results__option--highlighted[aria-selected] {
        background: #1877f2 !important;
        color: white !important;
    }

    .select2-container--default
    .select2-results__option[aria-selected="true"] {
        background: #e7f3ff !important;
        color: #1877f2 !important;
    }

    /* =========================================================
       MODAL FOOTER
    ========================================================= */

    .modal-kategori-besar .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 12px 20px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
    }

    .btn-batal-kategori {
        background: #f1f5f9;
        border: none;
        color: #526071;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        cursor: pointer;
    }

    .btn-batal-kategori:hover {
        background: #e2e8f0;
    }

    .btn-simpan-kategori {
        background: var(--blue-main);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-simpan-kategori:hover {
        background: var(--blue-dark);
    }

    /* =========================================================
       ERROR
    ========================================================= */

    .error-kategori {
        display: block;
        color: #dc3545;
        font-size: 8px;
        margin-top: 4px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .master-kategori-page {
            padding: 18px 12px;
        }

        .kategori-header {
            align-items: flex-start;
            gap: 12px;
        }

        .kategori-title {
            font-size: 15px;
        }

        .btn-tambah-kategori {
            white-space: nowrap;
        }

        .modal-kategori-besar {
            max-width: calc(100% - 30px) !important;
            margin: 15px auto;
        }
    }
</style>


{{-- =========================================================
     SELECT2 CSS
========================================================= --}}

<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>


{{-- =========================================================
     DATA KATEGORI
========================================================= --}}

@php
    $daftarKategori = [
        'Antibiotik',
        'Analgesik',
        'Antipiretik',
        'Antihistamin',
        'Antiseptik',
        'Vitamin dan Suplemen',
        'Obat Batuk dan Pilek',
        'Obat Lambung',
        'Obat Kulit',
        'Obat Mata',
        'Obat Tetes',
        'Obat Injeksi',
        'Obat Jantung',
        'Obat Hipertensi',
        'Obat Diabetes',
        'Obat Kolesterol',
        'Obat Asma',
        'Obat Alergi',
        'Obat Diare',
        'Obat Sakit Kepala'
    ];
@endphp


<div class="master-kategori-page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="kategori-header">

        <div class="kategori-title-wrapper">

            <div class="kategori-icon">
                <i class="fas fa-tags"></i>
            </div>

            <div>

                <h2 class="kategori-title">
                    Master Kategori
                </h2>

                <p class="kategori-subtitle">
                    Data kategori yang terdaftar
                </p>

            </div>

        </div>


        {{-- TOMBOL TAMBAH --}}

        <button
            type="button"
            class="btn-tambah-kategori"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahKategori"
        >
            <i class="fas fa-plus"></i>
            Tambah Kategori
        </button>

    </div>


    {{-- =====================================================
         SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- =====================================================
         ERROR
    ====================================================== --}}

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

    <div class="kategori-card">

        <div class="kategori-table-wrapper">

            <table class="kategori-table">

                <thead>

                    <tr>

                        <th width="50">
                            No
                        </th>

                        <th width="180">
                            Kode Kategori
                        </th>

                        <th>
                            Nama Kategori
                        </th>

                        <th width="220">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($kategoris as $kategori)

                        <tr>

                            {{-- NO --}}

                            <td class="nomor-kategori">
                                {{ $loop->iteration }}
                            </td>


                            {{-- KODE --}}

                            <td class="kode-kategori">

                                <span class="kode-kategori-badge">
                                    {{ $kategori->kode }}
                                </span>

                            </td>


                            {{-- NAMA --}}

                            <td class="nama-kategori">

                                <span class="nama-kategori-badge">
                                    {{ $kategori->nama }}
                                </span>

                            </td>


                            {{-- =================================================
                                 AKSI
                            ================================================== --}}

                            <td>

                                <div class="aksi-wrapper">


                                    {{-- LIHAT --}}

                                    <a
                                        href="{{ route('master-kategori.show', $kategori->id) }}"
                                        class="btn-aksi-kategori btn-lihat-kategori"
                                    >

                                        <i class="fas fa-eye"></i>

                                        Lihat

                                    </a>


                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        class="btn-aksi-kategori btn-edit-kategori"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditKategori{{ $kategori->id }}"
                                    >

                                        <i class="fas fa-edit"></i>

                                        Edit

                                    </button>


                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route('master-kategori.destroy', $kategori->id) }}"
                                        method="POST"
                                        style="display:inline;"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-aksi-kategori btn-hapus-kategori"
                                            onclick="return confirm('Yakin ingin menghapus kategori ini?')"
                                        >

                                            <i class="fas fa-trash"></i>

                                            Hapus

                                        </button>

                                    </form>


                                </div>

                            </td>

                        </tr>


                        {{-- =================================================
                             MODAL EDIT KATEGORI
                        ================================================== --}}

                        <div
                            class="modal fade"
                            id="modalEditKategori{{ $kategori->id }}"
                            tabindex="-1"
                            aria-hidden="true"
                        >

                            <div class="modal-dialog modal-dialog-centered modal-kategori-besar">

                                <div class="modal-content">


                                    {{-- HEADER --}}

                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            <i class="fas fa-edit"></i>

                                            Edit Kategori

                                        </h5>

                                    </div>


                                    {{-- FORM --}}

                                    <form
                                        action="{{ route('master-kategori.update', $kategori->id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PUT')


                                        {{-- BODY --}}

                                        <div class="modal-body">


                                            {{-- KODE --}}

                                            <div class="form-kategori-group">

                                                <label class="form-kategori-label">
                                                    Kode Kategori
                                                </label>

                                                <input
                                                    type="text"
                                                    name="kode"
                                                    class="form-kategori-control"
                                                    value="{{ $kategori->kode }}"
                                                    placeholder="Masukkan kode kategori"
                                                    required
                                                >

                                            </div>


                                            {{-- NAMA --}}

                                            <div class="form-kategori-group">

                                                <label class="form-kategori-label">
                                                    Nama Kategori
                                                </label>


                                                <select
                                                    name="nama"
                                                    id="namaKategoriEdit{{ $kategori->id }}"
                                                    class="form-kategori-select2"
                                                    required
                                                >

                                                    <option value="">
                                                        -- Cari / Pilih Kategori --
                                                    </option>


                                                    @foreach($daftarKategori as $namaKategori)

                                                        <option
                                                            value="{{ $namaKategori }}"
                                                            {{ $kategori->nama == $namaKategori ? 'selected' : '' }}
                                                        >

                                                            {{ $namaKategori }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>


                                        {{-- FOOTER --}}

                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn-batal-kategori"
                                                data-bs-dismiss="modal"
                                            >
                                                Batal
                                            </button>


                                            <button
                                                type="submit"
                                                class="btn-simpan-kategori"
                                            >

                                                <i class="fas fa-save"></i>

                                                Simpan Perubahan

                                            </button>

                                        </div>


                                    </form>

                                </div>

                            </div>

                        </div>


                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="data-kosong"
                            >

                                Belum ada data kategori.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH KATEGORI
========================================================= --}}

<div
    class="modal fade"
    id="modalTambahKategori"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-kategori-besar">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-tags"></i>

                    Tambah Kategori

                </h5>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('master-kategori.store') }}"
                method="POST"
            >

                @csrf


                {{-- BODY --}}

                <div class="modal-body">


                    {{-- KODE --}}

                    <div class="form-kategori-group">

                        <label class="form-kategori-label">
                            Kode Kategori
                        </label>

                        <input
                            type="text"
                            name="kode"
                            class="form-kategori-control"
                            placeholder="Masukkan kode kategori"
                            value="{{ old('kode') }}"
                            required
                        >

                        @error('kode')

                            <span class="error-kategori">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- NAMA --}}

                    <div class="form-kategori-group">

                        <label class="form-kategori-label">
                            Nama Kategori
                        </label>


                        <select
                            name="nama"
                            id="namaKategori"
                            class="form-kategori-select2"
                            required
                        >

                            <option value="">
                                -- Cari / Pilih Kategori --
                            </option>


                            @foreach($daftarKategori as $namaKategori)

                                <option
                                    value="{{ $namaKategori }}"
                                    {{ old('nama') == $namaKategori ? 'selected' : '' }}
                                >

                                    {{ $namaKategori }}

                                </option>

                            @endforeach

                        </select>


                        @error('nama')

                            <span class="error-kategori">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-kategori"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn-simpan-kategori"
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
     JQUERY
========================================================= --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


{{-- =========================================================
     SELECT2 JS
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =========================================================
       SELECT2 TAMBAH
    ========================================================= */

    $('#namaKategori').select2({

        placeholder: 'Cari / Pilih Kategori',

        allowClear: true,

        width: '100%',

        dropdownParent: $('#modalTambahKategori')

    });


    /* =========================================================
       SELECT2 EDIT
    ========================================================= */

    @foreach($kategoris as $kategori)

        $('#namaKategoriEdit{{ $kategori->id }}').select2({

            placeholder: 'Cari / Pilih Kategori',

            allowClear: true,

            width: '100%',

            dropdownParent: $('#modalEditKategori{{ $kategori->id }}')

        });

    @endforeach


    /* =========================================================
       BUKA MODAL TAMBAH JIKA VALIDASI ERROR
    ========================================================= */

    @if($errors->any() && old('_form') === 'tambah-kategori')

        var modalElement = document.getElementById('modalTambahKategori');

        if (modalElement) {

            var modal = new bootstrap.Modal(modalElement);

            modal.show();

        }

    @endif

});

</script>

@endsection
