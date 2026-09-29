@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Obat')

@section('content')

{{-- DATATABLE CSS --}}
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
>

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    /* =====================================================
       HALAMAN
    ===================================================== */
    .master-obat-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 22px 18px;
    }

    /* =====================================================
       HEADER
    ===================================================== */
    .obat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        gap: 15px;
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

    /* =====================================================
       TOMBOL TAMBAH
    ===================================================== */
    .btn-tambah-obat {
        background: var(--blue-main);
        border: none;
        color: #fff;
        padding: 9px 14px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: .2s;
    }

    .btn-tambah-obat:hover {
        background: var(--blue-dark);
        color: #fff;
    }

    /* =====================================================
       ALERT
    ===================================================== */
    .alert-obat {
        border-radius: 7px;
        padding: 10px 12px;
        margin-bottom: 14px;
        font-size: 10px;
    }

    /* =====================================================
       CARD TABLE
    ===================================================== */
    .obat-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
        padding-bottom: 10px;
        overflow: hidden;
    }

    .obat-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* =====================================================
       TABLE
    ===================================================== */
    .obat-table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin: 0 !important;
    }

    .obat-table thead th {
        background: var(--blue-main) !important;
        color: #fff !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        padding: 11px 12px !important;
        border: none !important;
        white-space: nowrap;
        text-align: left;
    }

    .obat-table tbody td {
        padding: 10px 12px !important;
        font-size: 10px !important;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4 !important;
        vertical-align: middle !important;
        background: #fff;
    }

    .obat-table tbody tr:hover td {
        background: #fafcff;
    }

    /* =====================================================
       HILANGKAN PANAH SORTING PADA KOLOM NON-SORTING
    ===================================================== */
    #obat-table.dataTable thead th.sorting_disabled::before,
    #obat-table.dataTable thead th.sorting_disabled::after {
        display: none !important;
        content: none !important;
        opacity: 0 !important;
    }

    /* =====================================================
       PAKSA HILANGKAN PANAH KATEGORI
       Kategori = kolom ke-3
    ===================================================== */
    #obat-table thead th:nth-child(3)::before,
    #obat-table thead th:nth-child(3)::after,
    #obat-table.dataTable thead > tr > th:nth-child(3)::before,
    #obat-table.dataTable thead > tr > th:nth-child(3)::after {
        display: none !important;
        content: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }

    #obat-table thead th:nth-child(3) {
        background-image: none !important;
        padding-right: 12px !important;
        cursor: default !important;
    }

    /* =====================================================
       HILANGKAN PANAH NO
       No = kolom ke-1
    ===================================================== */
    #obat-table thead th:nth-child(1)::before,
    #obat-table thead th:nth-child(1)::after {
        display: none !important;
        content: none !important;
        opacity: 0 !important;
    }

    #obat-table thead th:nth-child(1) {
        background-image: none !important;
        cursor: default !important;
    }

    /* =====================================================
       HILANGKAN PANAH AKSI
       Aksi = kolom ke-4
    ===================================================== */
    #obat-table thead th:nth-child(4)::before,
    #obat-table thead th:nth-child(4)::after {
        display: none !important;
        content: none !important;
        opacity: 0 !important;
    }

    #obat-table thead th:nth-child(4) {
        background-image: none !important;
        cursor: default !important;
    }

    /* =====================================================
       NAMA OBAT
    ===================================================== */
    .nama-obat {
        font-weight: 600;
        color: #1f2937;
        white-space: nowrap;
    }

    /* =====================================================
       KATEGORI
    ===================================================== */
    .kategori-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #fff0d5;
        color: #e8791b;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =====================================================
       AKSI
    ===================================================== */
    .aksi-header {
        text-align: center !important;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        white-space: nowrap;
    }

    .action-buttons form {
        margin: 0;
        padding: 0;
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
        min-width: 50px;
        cursor: pointer;
        transition: .2s;
        text-decoration: none !important;
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
        color: #fff;
    }

    .btn-edit:hover {
        background: var(--blue-dark);
        color: #fff;
    }

    .btn-hapus {
        background: #ef4444;
        color: #fff;
    }

    .btn-hapus:hover {
        background: #dc2626;
        color: #fff;
    }

    /* =====================================================
       DATATABLE
    ===================================================== */
    .dataTables_wrapper {
        font-size: 10px;
    }

    .dataTables_wrapper .row:first-child {
        padding: 13px 14px 10px;
        align-items: center;
    }

    .dataTables_wrapper .row:last-child {
        padding: 10px 14px 2px;
        align-items: center;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label,
    .dataTables_wrapper .dataTables_info {
        font-size: 10px;
        color: #64748b;
    }

    .dataTables_wrapper .dataTables_length select {
        min-width: 60px;
        height: 31px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        font-size: 10px;
        padding: 4px 24px 4px 7px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter {
        text-align: right;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 190px;
        height: 31px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 5px 9px;
        margin-left: 5px;
        font-size: 10px;
        outline: none;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24, 119, 242, .10) !important;
    }

    .dataTables_wrapper .pagination {
        margin: 0;
        gap: 3px;
    }

    .dataTables_wrapper .page-link {
        font-size: 9px;
        border-radius: 5px !important;
        color: #64748b;
        border: 1px solid #e2e8f0;
        padding: 5px 8px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .page-item.active .page-link {
        background: var(--blue-main);
        border-color: var(--blue-main);
        color: #fff;
    }

    .dataTables_wrapper .page-item.disabled .page-link {
        color: #b0bac8;
        background: #f8fafc;
    }

    table.dataTable {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    table.dataTable.no-footer {
        border-bottom: none !important;
    }

    div.dataTables_processing {
        font-size: 10px;
        color: #64748b;
    }

    /* =====================================================
       MODAL
    ===================================================== */
    .modal-obat .modal-dialog {
        max-width: 460px;
    }

    .modal-obat .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
    }

    .modal-obat .modal-header {
        background: var(--blue-main);
        border: none;
        padding: 14px 16px;
        color: #fff;
    }

    .modal-obat .modal-title {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .modal-obat .modal-body {
        padding: 18px 16px;
        background: #fff;
    }

    .modal-obat .modal-footer {
        border: none;
        background: #f8fafc;
        padding: 11px 16px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
    }

    /* =====================================================
       FORM
    ===================================================== */
    .form-obat-group {
        margin-bottom: 14px;
    }

    .form-obat-group:last-child {
        margin-bottom: 0;
    }

    .form-obat-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 5px;
    }

    .form-obat-control {
        width: 100%;
        min-height: 36px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 8px 9px;
        font-size: 10px;
        color: #374151;
        outline: none;
        background: #fff;
        transition: .2s;
        box-sizing: border-box;
    }

    .form-obat-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24, 119,242,.10);
    }

    .form-obat-control::placeholder {
        color: #9ca3af;
    }

    select.form-obat-control {
        cursor: pointer;
    }

    .error-obat {
        color: #dc3545;
        font-size: 8px;
        margin-top: 3px;
        display: block;
    }

    /* =====================================================
       DETAIL
    ===================================================== */
    .view-obat-value {
        width: 100%;
        min-height: 36px;
        border: 1px solid #e1e7ef;
        border-radius: 6px;
        background: #f8fafc;
        padding: 8px 9px;
        font-size: 10px;
        color: #374151;
        box-sizing: border-box;
    }

    /* =====================================================
       BUTTON MODAL
    ===================================================== */
    .btn-batal-obat {
        background: #eef2f7;
        border: none;
        color: #64748b;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-batal-obat:hover {
        background: #e2e8f0;
    }

    .btn-simpan-obat {
        background: var(--blue-main);
        color: #fff;
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

    /* =====================================================
       RESPONSIVE
    ===================================================== */
    @media (max-width: 768px) {
        .master-obat-page {
            padding: 15px 10px;
        }

        .obat-header {
            align-items: flex-start;
        }

        .modal-obat .modal-dialog {
            max-width: calc(100% - 30px);
            margin: 15px auto;
        }

        .dataTables_wrapper .dataTables_filter {
            margin-top: 8px;
            text-align: left;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 160px;
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
                <h2 class="obat-title">
                    Master Obat
                </h2>

                <p class="obat-subtitle">
                    Data obat yang terdaftar
                </p>
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


    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-obat">
            {{ session('success') }}
        </div>
    @endif


    {{-- ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-obat">

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

            <table
                id="obat-table"
                class="obat-table table align-middle"
            >

                <thead>
                    <tr>

                        <th style="width: 70px;">
                            No
                        </th>

                        <th>
                            Nama Obat
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th
                            class="aksi-header"
                            style="width: 220px;"
                        >
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH
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

                    {{-- NAMA --}}
                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Nama Obat
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-obat-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama obat"
                            value="{{ old('nama') }}"
                            required
                        >

                        @error('nama')
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
                            name="kategori_id"
                            class="form-obat-control @error('kategori_id') is-invalid @enderror"
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
     MODAL LIHAT
========================================================= --}}
<div
    class="modal fade modal-obat"
    id="modalLihatObat"
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
                        Nama Obat
                    </label>

                    <div
                        class="view-obat-value"
                        id="lihatNama"
                    >
                        -
                    </div>

                </div>


                <div class="form-obat-group">

                    <label class="form-obat-label">
                        Kategori
                    </label>

                    <div
                        class="view-obat-value"
                        id="lihatKategori"
                    >
                        -
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


{{-- =========================================================
     MODAL EDIT
========================================================= --}}
<div
    class="modal fade modal-obat"
    id="modalEditObat"
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
                id="formEditObat"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="modal-body">

                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Nama Obat
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="editNama"
                            class="form-obat-control"
                            placeholder="Masukkan nama obat"
                            required
                        >

                    </div>


                    <div class="form-obat-group">

                        <label class="form-obat-label">
                            Kategori
                        </label>

                        <select
                            name="kategori_id"
                            id="editKategori"
                            class="form-obat-control"
                            required
                        >

                            <option value="">
                                -- Pilih Kategori --
                            </option>

                            @foreach($kategoris as $kategori)

                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama }}
                                </option>

                            @endforeach

                        </select>

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

@endsection


@push('scripts')

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DATATABLE --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {

    /* =========================================================
       DATATABLE
    ========================================================= */
    const table = $('#obat-table').DataTable({

        processing: true,
        serverSide: true,

        ajax: "{{ route('master-obat.data') }}",

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        columns: [

            /* NO */
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center'
            },

            /* NAMA OBAT */
            {
                data: 'nama',
                name: 'nama',
                orderable: true,
                searchable: true,

                render: function (data) {

                    return `
                        <span class="nama-obat">
                            ${escapeHtml(data ?? '-')}
                        </span>
                    `;
                }
            },

            /* KATEGORI */
            {
                data: 'kategori_nama',
                name: 'kategori_nama',

                orderable: false,
                searchable: true,

                render: function (data) {

                    return `
                        <span class="kategori-badge">
                            ${escapeHtml(data ?? '-')}
                        </span>
                    `;
                }
            },

            /* AKSI */
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }

        ],

        /*
        |--------------------------------------------------------------------------
        | Tidak melakukan sorting otomatis
        |--------------------------------------------------------------------------
        */
        order: [],

        language: {

            search: "",

            searchPlaceholder:
                "Cari obat...",

            lengthMenu:
                "Tampilkan _MENU_ data",

            info:
                "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty:
                "Menampilkan 0 sampai 0 dari 0 data",

            emptyTable:
                "Belum ada data obat",

            zeroRecords:
                "Data obat tidak ditemukan",

            processing:
                "Memuat data...",

            paginate: {
                first: "Awal",
                last: "Akhir",
                next: "Lanjut",
                previous: "Kembali"
            }
        }
    });


    /* =========================================================
       ESCAPE HTML
    ========================================================= */
    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {
            return '';
        }

        return $('<div>')
            .text(value)
            .html();
    }


    /* =========================================================
       LIHAT
    ========================================================= */
    $('#obat-table').on(
        'click',
        '.btn-lihat',
        function (e) {

            e.preventDefault();

            const rowElement =
                $(this).closest('tr');

            const data =
                table.row(rowElement).data();

            if (!data) {
                return;
            }

            $('#lihatNama').text(
                data.nama ?? '-'
            );

            $('#lihatKategori').text(
                data.kategori_nama ?? '-'
            );

            const modalElement =
                document.getElementById(
                    'modalLihatObat'
                );

            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    modalElement
                );

            modal.show();
        }
    );


    /* =========================================================
       EDIT
    ========================================================= */
    $('#obat-table').on(
        'click',
        '.btn-edit',
        function (e) {

            e.preventDefault();

            const rowElement =
                $(this).closest('tr');

            const data =
                table.row(rowElement).data();

            if (!data) {
                return;
            }


            $('#editNama').val(
                data.nama ?? ''
            );


            $('#editKategori').val(
                String(
                    data.kategori_id ?? ''
                )
            );


            /*
            |--------------------------------------------------------------------------
            | URL UPDATE
            |--------------------------------------------------------------------------
            */
            const baseUrl =
                @json(url('/master-obat'));

            $('#formEditObat').attr(
                'action',
                baseUrl + '/' + data.id
            );


            const modalElement =
                document.getElementById(
                    'modalEditObat'
                );

            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    modalElement
                );

            modal.show();
        }
    );


    /* =========================================================
       VALIDASI TAMBAH GAGAL
    ========================================================= */
    @if($errors->any())

        const modalTambahElement =
            document.getElementById(
                'modalTambahObat'
            );

        if (modalTambahElement) {

            const modalTambah =
                bootstrap.Modal.getOrCreateInstance(
                    modalTambahElement
                );

            modalTambah.show();
        }

    @endif

});
</script>

@endpush
