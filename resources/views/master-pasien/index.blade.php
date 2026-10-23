@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Pasien')

@section('content')

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<style>
    /* =====================================================
       MASTER PASIEN
    ====================================================== */
    .master-pasien {
        padding: 5px 0 30px;
    }

    /* =====================================================
       HEADER HALAMAN
    ====================================================== */
    .pasien-page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .pasien-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .pasien-title-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #e7f3ff;
        color: #1877f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .pasien-title h4 {
        margin: 0;
        color: #17233c;
        font-size: 20px;
        font-weight: 700;
    }

    .pasien-title p {
        margin: 4px 0 0;
        color: #8a94a6;
        font-size: 12px;
    }

    /* =====================================================
       TOMBOL TAMBAH
    ====================================================== */
    .btn-tambah-pasien {
        background: #1877f2;
        color: #ffffff !important;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        box-shadow: 0 3px 8px rgba(24, 119, 242, 0.18);
        transition: 0.2s;
    }

    .btn-tambah-pasien:hover {
        background: #0f67d8;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* =====================================================
       ALERT
    ====================================================== */
    .alert-custom {
        border: none;
        border-radius: 9px;
        font-size: 13px;
        padding: 12px 15px;
        margin-bottom: 18px;
    }

    /* =====================================================
       TABLE CARD
    ====================================================== */
    .pasien-table-card {
        width: 100%;
        background: #ffffff;
        border-radius: 11px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.07);
    }

    .pasien-table-content {
        background: #ffffff;
    }

    /* =====================================================
       DATATABLES
    ====================================================== */
    .dataTables_wrapper {
        background: #ffffff !important;
    }

    .dataTables_wrapper > .row:first-child {
        padding: 15px 15px 10px;
        margin: 0 !important;
        background: #ffffff !important;
    }

    .dataTables_wrapper > .row:last-child {
        padding: 10px 15px 14px;
        margin: 0 !important;
        background: #ffffff !important;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        color: #687386;
        font-size: 12px;
        font-weight: 500;
    }

    .dataTables_wrapper .dataTables_length select {
        min-width: 65px;
        margin: 0 5px;
        padding: 6px 28px 6px 9px;
        border: 1px solid #dfe5ec;
        border-radius: 7px;
        background-color: #ffffff;
        color: #495057;
        font-size: 12px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 170px;
        margin-left: 7px;
        padding: 6px 10px;
        border: 1px solid #dfe5ec;
        border-radius: 7px;
        background: #ffffff;
        color: #495057;
        font-size: 12px;
        outline: none;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.10) !important;
    }

    .dataTables_wrapper .dataTables_info {
        color: #7b8494;
        font-size: 11px;
        padding-top: 8px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 4px !important;
    }

    .dataTables_wrapper .page-link {
        color: #657080;
        background: #ffffff;
        border: 1px solid #e0e5eb;
        font-size: 11px;
        border-radius: 6px !important;
        margin: 0 2px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .page-item.active .page-link {
        background: #1877f2 !important;
        border-color: #1877f2 !important;
        color: #ffffff !important;
    }

    div.dataTables_processing {
        display: none !important;
    }

    /* =====================================================
       TABLE
    ====================================================== */
    #pasien-table {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    #pasien-table thead th {
        background: #1877f2 !important;
        color: #ffffff !important;
        font-size: 12px;
        font-weight: 700;
        padding: 13px 14px !important;
        border: none !important;
        vertical-align: middle;
        white-space: nowrap;
    }

    #pasien-table tbody tr {
        background: #ffffff !important;
    }

    #pasien-table tbody td {
        background: #ffffff !important;
        color: #4f5969;
        font-size: 12px;
        padding: 12px 14px !important;
        border-bottom: 1px solid #eef1f5 !important;
        vertical-align: middle;
    }

    #pasien-table tbody tr:last-child td {
        border-bottom: none !important;
    }

    #pasien-table tbody tr:hover td {
        background: #f8fbff !important;
    }

    #pasien-table tbody td:first-child {
        text-align: center;
    }

    #pasien-table tbody td:nth-child(2) {
        color: #17233c;
        font-weight: 700;
    }

    table.dataTable thead > tr > th.sorting:before,
    table.dataTable thead > tr > th.sorting:after,
    table.dataTable thead > tr > th.sorting_asc:before,
    table.dataTable thead > tr > th.sorting_asc:after,
    table.dataTable thead > tr > th.sorting_desc:before,
    table.dataTable thead > tr > th.sorting_desc:after {
        color: #ffffff !important;
        opacity: 0.75 !important;
    }

    /* =====================================================
       BADGE
    ====================================================== */
    .badge-gender,
    .badge-darah,
    .badge-asuransi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 500;
        white-space: nowrap;
    }

    .badge-gender {
        background: #dff2ff;
        color: #0784c9;
    }

    .badge-darah {
        background: #ffe9ec;
        color: #dc3545;
    }

    .badge-asuransi.aktif {
        background: #e4f7ec;
        color: #198754;
    }

    .badge-asuransi.tidak {
        background: #edf1f4;
        color: #6c757d;
    }

    /* =====================================================
       ACTION
    ====================================================== */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
        font-size: 12px;
    }

    .btn-view {
        background: #dff5ff;
        color: #0797d5;
    }

    .btn-view:hover {
        background: #0797d5;
        color: #ffffff;
    }

    .btn-edit {
        background: #1877f2;
        color: #ffffff;
    }

    .btn-edit:hover {
        background: #0f67d8;
        color: #ffffff;
    }

    .btn-delete {
        background: #ef3f45;
        color: #ffffff;
    }

    .btn-delete:hover {
        background: #d92f35;
        color: #ffffff;
    }

    /* =====================================================
       MODAL
    ====================================================== */
    .modal-content {
        border: none;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.18);
    }

    .modal-header-custom {
        background: #1877f2;
        color: #ffffff;
        border: none;
        padding: 15px 18px;
    }

    .modal-header-custom .modal-title {
        margin: 0;
        color: #ffffff;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .modal-body {
        padding: 20px;
    }

    .form-group-custom {
        margin-bottom: 15px;
    }

    .form-group-custom:last-child {
        margin-bottom: 0;
    }

    .form-label-custom {
        display: block;
        color: #697386;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .form-control-custom,
    .form-select-custom {
        width: 100%;
        min-height: 42px;
        border: 1px solid #d9e0e8;
        border-radius: 8px;
        padding: 9px 11px;
        background: #ffffff;
        color: #495057;
        font-size: 12px;
        outline: none;
        transition: 0.2s;
    }

    textarea.form-control-custom {
        min-height: 85px;
        resize: vertical;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.10);
    }

    .modal-footer-custom {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 13px 18px;
        background: #f8fafc;
        border-top: none;
    }

    .btn-modal-batal {
        border: none;
        background: #f0f3f7;
        color: #667085;
        border-radius: 7px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-batal:hover {
        background: #e4e8ee;
    }

    .btn-modal-simpan {
        border: none;
        background: #1877f2;
        color: #ffffff;
        border-radius: 7px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-simpan:hover {
        background: #0f67d8;
    }

    /* =====================================================
       DETAIL PASIEN
    ====================================================== */
    .detail-item {
        margin-bottom: 14px;
    }

    .detail-item:last-child {
        margin-bottom: 0;
    }

    .detail-label {
        color: #8a94a6;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .detail-value {
        background: #f8fafc;
        border: 1px solid #edf0f4;
        border-radius: 7px;
        padding: 10px 12px;
        color: #344054;
        font-size: 13px;
        min-height: 40px;
        display: flex;
        align-items: center;
    }

    /* =====================================================
       RESPONSIVE
    ====================================================== */
    @media (max-width: 768px) {
        .pasien-page-header {
            gap: 15px;
            align-items: flex-start;
        }

        .pasien-title h4 {
            font-size: 17px;
        }

        .btn-tambah-pasien {
            padding: 8px 11px;
            font-size: 11px;
        }

        .pasien-table-card {
            overflow-x: auto;
        }

        #pasien-table {
            min-width: 1100px;
        }
    }
</style>


<div class="master-pasien">

    {{-- HEADER --}}
    <div class="pasien-page-header">

        <div class="pasien-title-wrapper">

            <div class="pasien-title-icon">
                <i class="fas fa-hospital-user"></i>
            </div>

            <div class="pasien-title">
                <h4>Master Pasien</h4>
                <p>Data pasien yang terdaftar</p>
            </div>

        </div>


        {{-- TOMBOL TAMBAH HANYA UNTUK SUPER ADMIN & ADMIN RS --}}
        @if(auth()->user()->hasAnyRole(['super admin', 'admin rumah sakit']))

            <button type="button"
                    class="btn-tambah-pasien"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahPasien">

                <i class="fas fa-plus"></i>
                Tambah Pasien

            </button>

        @endif

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-custom">

            <i class="fas fa-circle-check me-1"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- TABLE --}}
    <div class="pasien-table-card">

        <div class="pasien-table-content">

            <div class="table-responsive">

                <table id="pasien-table"
                       class="table align-middle">

                    <thead>

                        <tr>

                            <th class="text-center">
                                No
                            </th>

                            <th>
                                Nama Pasien
                            </th>

                            <th>
                                Jenis Kelamin
                            </th>

                            <th>
                                Tanggal Lahir
                            </th>

                            <th>
                                Alamat
                            </th>

                            <th>
                                Golongan Darah
                            </th>

                            <th>
                                Status Asuransi
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH PASIEN
     HANYA UNTUK SUPER ADMIN & ADMIN RS
========================================================= --}}

@if(auth()->user()->hasAnyRole(['super admin', 'admin rumah sakit']))

<div class="modal fade"
     id="modalTambahPasien"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('master-pasien.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header modal-header-custom">

                    <h5 class="modal-title">
                        <i class="fas fa-user-plus"></i>
                        Tambah Pasien
                    </h5>

                </div>


                <div class="modal-body">

                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Nama Pasien
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control-custom"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama pasien"
                               required>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Jenis Kelamin
                        </label>

                        <select name="jenis_kelamin"
                                class="form-select-custom"
                                required>

                            <option value="">
                                -- Pilih Jenis Kelamin --
                            </option>

                            <option value="laki-laki"
                                {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="perempuan"
                                {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Tanggal Lahir
                        </label>

                        <input type="date"
                               name="tanggal_lahir"
                               class="form-control-custom"
                               value="{{ old('tanggal_lahir') }}"
                               required>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Alamat
                        </label>

                        <textarea name="alamat"
                                  class="form-control-custom"
                                  placeholder="Ketikkan alamat lengkap..."
                                  required>{{ old('alamat') }}</textarea>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Golongan Darah
                        </label>

                        <select name="golongan_darah"
                                class="form-select-custom"
                                required>

                            <option value="">
                                -- Pilih Golongan Darah --
                            </option>

                            <option value="A"
                                {{ old('golongan_darah') == 'A' ? 'selected' : '' }}>
                                A
                            </option>

                            <option value="B"
                                {{ old('golongan_darah') == 'B' ? 'selected' : '' }}>
                                B
                            </option>

                            <option value="AB"
                                {{ old('golongan_darah') == 'AB' ? 'selected' : '' }}>
                                AB
                            </option>

                            <option value="O"
                                {{ old('golongan_darah') == 'O' ? 'selected' : '' }}>
                                O
                            </option>

                        </select>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Status Asuransi
                        </label>

                        <select name="status_asuransi"
                                class="form-select-custom"
                                required>

                            <option value="">
                                -- Pilih Status Asuransi --
                            </option>

                            <option value="01"
                                {{ old('status_asuransi') == '01' ? 'selected' : '' }}>
                                Memiliki Asuransi
                            </option>

                            <option value="0"
                                {{ old('status_asuransi') === '0' ? 'selected' : '' }}>
                                Tidak Memiliki Asuransi
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer-custom">

                    <button type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn-modal-simpan">

                        <i class="fas fa-floppy-disk me-1"></i>
                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     MODAL LIHAT PASIEN
     BISA DIGUNAKAN DOKTER
     TANPA TANDA X
========================================================= --}}

<div class="modal fade"
     id="modalLihatPasien"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header modal-header-custom">

                <h5 class="modal-title">
                    <i class="fas fa-eye"></i>
                    Detail Pasien
                </h5>

            </div>


            <div class="modal-body">

                <div class="detail-item">

                    <div class="detail-label">
                        Nama Pasien
                    </div>

                    <div class="detail-value"
                         id="lihatNama">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Jenis Kelamin
                    </div>

                    <div class="detail-value"
                         id="lihatJenisKelamin">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Tanggal Lahir
                    </div>

                    <div class="detail-value"
                         id="lihatTanggalLahir">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Alamat
                    </div>

                    <div class="detail-value"
                         id="lihatAlamat">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Golongan Darah
                    </div>

                    <div class="detail-value"
                         id="lihatGolonganDarah">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Status Asuransi
                    </div>

                    <div class="detail-value"
                         id="lihatStatusAsuransi">
                        -
                    </div>

                </div>

            </div>


            <div class="modal-footer-custom">

                <button type="button"
                        class="btn-modal-batal"
                        data-bs-dismiss="modal">
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL EDIT PASIEN
     HANYA UNTUK SUPER ADMIN & ADMIN RS
========================================================= --}}

@if(auth()->user()->hasAnyRole(['super admin', 'admin rumah sakit']))

<div class="modal fade"
     id="modalEditPasien"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form id="formEditPasien"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header modal-header-custom">

                    <h5 class="modal-title">
                        <i class="fas fa-pen-to-square"></i>
                        Edit Pasien
                    </h5>

                </div>


                <div class="modal-body">

                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Nama Pasien
                        </label>

                        <input type="text"
                               id="editNama"
                               name="nama"
                               class="form-control-custom"
                               placeholder="Masukkan nama pasien"
                               required>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Jenis Kelamin
                        </label>

                        <select id="editJenisKelamin"
                                name="jenis_kelamin"
                                class="form-select-custom"
                                required>

                            <option value="">
                                -- Pilih Jenis Kelamin --
                            </option>

                            <option value="laki-laki">
                                Laki-laki
                            </option>

                            <option value="perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Tanggal Lahir
                        </label>

                        <input type="date"
                               id="editTanggalLahir"
                               name="tanggal_lahir"
                               class="form-control-custom"
                               required>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Alamat
                        </label>

                        <textarea id="editAlamat"
                                  name="alamat"
                                  class="form-control-custom"
                                  placeholder="Ketikkan alamat lengkap..."
                                  required></textarea>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Golongan Darah
                        </label>

                        <select id="editGolonganDarah"
                                name="golongan_darah"
                                class="form-select-custom"
                                required>

                            <option value="">
                                -- Pilih Golongan Darah --
                            </option>

                            <option value="A">
                                A
                            </option>

                            <option value="B">
                                B
                            </option>

                            <option value="AB">
                                AB
                            </option>

                            <option value="O">
                                O
                            </option>

                        </select>

                    </div>


                    <div class="form-group-custom">

                        <label class="form-label-custom">
                            Status Asuransi
                        </label>

                        <select id="editStatusAsuransi"
                                name="status_asuransi"
                                class="form-select-custom"
                                required>

                            <option value="">
                                -- Pilih Status Asuransi --
                            </option>

                            <option value="01">
                                Memiliki Asuransi
                            </option>

                            <option value="0">
                                Tidak Memiliki Asuransi
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer-custom">

                    <button type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn-modal-simpan">

                        <i class="fas fa-floppy-disk me-1"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(function () {
    const table = $('#pasien-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: @json(route('master-pasien.data')),
            type: 'GET',
            error: function (xhr) {
                console.error('Gagal memuat pasien:', xhr.responseText);
            }
        },
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'alamat', name: 'alamat' },
            { data: 'golongan_darah', name: 'golongan_darah' },
            { data: 'status_asuransi', name: 'status_asuransi' },
            { data: 'aksi', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']],
        pageLength: 10,
        language: {
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Belum ada data pasien',
            infoFiltered: '(disaring dari _MAX_ total data)',
            zeroRecords: 'Data pasien tidak ditemukan',
            emptyTable: 'Belum ada data pasien',
            paginate: {
                first: 'Pertama',
                previous: 'Sebelumnya',
                next: 'Berikutnya',
                last: 'Terakhir'
            }
        }
    });

    function bukaModal(id) {
        const elemen = document.getElementById(id);

        if (!elemen || !window.bootstrap) {
            alert('Modal tidak dapat dibuka. Periksa Bootstrap JavaScript pada layouts.superadmin.');
            return;
        }

        bootstrap.Modal.getOrCreateInstance(elemen).show();
    }

    function teks(value) {
        return value == null || value === '' ? '-' : String(value);
    }

    // LIHAT PASIEN
    $('#pasien-table').on('click', '.btn-view', function () {
        const row = table.row($(this).closest('tr')).data();
        if (!row) return;

        $('#lihatNama').text(teks(row.nama));

        let jk = String(row.jenis_kelamin_raw ?? row.jenis_kelamin ?? '');
        if (['L', 'l', 'laki_laki'].includes(jk)) jk = 'laki-laki';
        if (['P', 'p'].includes(jk)) jk = 'perempuan';

        $('#lihatJenisKelamin').text(teks(jk));
        $('#lihatTanggalLahir').text(teks(row.tanggal_lahir));
        $('#lihatAlamat').text(teks(row.alamat));
        $('#lihatGolonganDarah').text(
            teks(row.golongan_darah_raw ?? row.golongan_darah)
        );

        const status = String(
            row.status_asuransi_raw ?? row.status_asuransi ?? ''
        );

        $('#lihatStatusAsuransi').text(
            ['01', '1'].includes(status)
                ? 'Memiliki Asuransi'
                : 'Tidak Memiliki Asuransi'
        );

        bukaModal('modalLihatPasien');
    });

    // EDIT PASIEN
    $('#pasien-table').on('click', '.btn-edit', function () {
        const row = table.row($(this).closest('tr')).data();
        if (!row || !row.id) {
            alert('ID pasien tidak ditemukan.');
            return;
        }

        $('#editNama').val(row.nama ?? '');

        let jk = String(row.jenis_kelamin_raw ?? row.jenis_kelamin ?? '');
        jk = jk.toLowerCase();

        if (jk === 'l' || jk === 'laki_laki') jk = 'laki-laki';
        if (jk === 'p') jk = 'perempuan';

        $('#editJenisKelamin').val(jk);
        $('#editTanggalLahir').val(
            row.tanggal_lahir_raw ?? ''
        );
        $('#editAlamat').val(row.alamat ?? '');
        $('#editGolonganDarah').val(
            row.golongan_darah_raw ?? row.golongan_darah ?? ''
        );

        let status = String(
            row.status_asuransi_raw ?? ''
        );

        if (status === '1') status = '01';
        $('#editStatusAsuransi').val(status);

        const url = @json(url('/master-pasien')) + '/' +
            encodeURIComponent(row.id);

        $('#formEditPasien').attr('action', url);
        bukaModal('modalEditPasien');
    });

    // HAPUS PASIEN
    $('#pasien-table').on('click', '.btn-delete', function (e) {
        const form = $(this).closest('form');

        if (!form.length) {
            e.preventDefault();
            alert('Form hapus tidak ditemukan. Periksa kode aksi pada controller.');
            return;
        }

        if (!confirm('Yakin ingin menghapus data pasien ini?')) {
            e.preventDefault();
        }
    });

    // TAMPILKAN ERROR VALIDASI JIKA ADA
    @if ($errors->any())
        alert(@json($errors->first()));
    @endif
});
</script>

@endsection
