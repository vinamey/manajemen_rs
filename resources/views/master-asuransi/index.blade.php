@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Asuransi')

@section('content')

<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
>

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light-bg: #e7f3ff;
        --blue-soft: #f0f7ff;
    }

    /* =========================================================
       GENERAL
    ========================================================= */
    .master-asuransi {
        padding: 12px 0;
    }


    /* =========================================================
       HEADER
    ========================================================= */
    .page-header-asuransi {
        margin-bottom: 22px;
    }

    .header-icon-box-asuransi {
        width: 42px;
        height: 42px;

        background-color:
            var(--blue-light-bg);

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        color:
            var(--blue-main);

        font-size: 18px;

        flex-shrink: 0;
    }

    .page-title-asuransi {
        font-size: 22px;
        font-weight: 700;

        color: #1e293b;

        margin: 0;

        line-height: 1.2;
    }

    .page-subtitle-asuransi {
        font-size: 12px;

        color: #64748b;

        margin: 3px 0 0;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */
    .btn-blue-primary-asuransi {
        background-color:
            var(--blue-main) !important;

        border: none !important;

        color: #ffffff !important;

        border-radius: 8px;

        padding: 9px 15px;

        font-size: 13px;
        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary-asuransi:hover {
        background-color:
            var(--blue-dark) !important;

        color: #ffffff !important;

        transform: translateY(-1px);
    }


    /* =========================================================
       TABLE CARD
    ========================================================= */
    .card-table-asuransi {
        border: none !important;

        border-radius: 12px !important;

        box-shadow:
            0 4px 12px
            rgba(0, 0, 0, 0.05) !important;
    }

    .card-table-asuransi .table-responsive {
        overflow-x: auto;
    }


    /* =========================================================
       TABLE
    ========================================================= */
    .table-asuransi {
        width: 100% !important;

        margin-bottom: 0 !important;
    }

    .table-asuransi thead th {
        background-color:
            var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        font-size: 13px !important;

        font-weight: 600 !important;

        padding: 14px 16px !important;

        white-space: nowrap;
    }

    .table-asuransi tbody td {
        padding: 12px 16px !important;

        font-size: 13px !important;

        color: #475569;

        border-bottom:
            1px solid #f1f5f9 !important;

        vertical-align: middle;

        white-space: nowrap;
    }

    .table-asuransi tbody tr {
        transition: 0.15s ease;
    }

    .table-asuransi tbody tr:hover {
        background-color:
            var(--blue-soft) !important;
    }

    .table-asuransi tbody tr:last-child td {
        border-bottom: none !important;
    }


    /* =========================================================
       ASURANSI PROFILE
    ========================================================= */
    .asuransi-name {
        color: #1e293b;

        font-weight: 600;

        margin-bottom: 2px;
    }

    .avatar-asuransi {
        width: 32px;
        height: 32px;

        border-radius: 50%;

        background-color:
            var(--blue-light-bg);

        color:
            var(--blue-main);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 13px;

        flex-shrink: 0;
    }


    /* =========================================================
       BADGE KODE
    ========================================================= */
    .badge-code-asuransi {
        background-color:
            #e0f2fe !important;

        color:
            #0284c7 !important;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 12px;

        border-radius: 6px;
    }


    /* =========================================================
       ACTION
    ========================================================= */
    .btn-action-view-asuransi {
        background-color:
            #e0f2fe !important;

        color:
            #0284c7 !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-view-asuransi:hover {
        background-color:
            #bae6fd !important;

        color:
            #0369a1 !important;
    }


    .btn-action-edit-asuransi {
        background-color:
            var(--blue-main) !important;

        color:
            #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-edit-asuransi:hover {
        background-color:
            var(--blue-dark) !important;

        color:
            #ffffff !important;
    }


    .btn-action-delete-asuransi {
        background-color:
            #ef4444 !important;

        color:
            #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-delete-asuransi:hover {
        background-color:
            #dc2626 !important;

        color:
            #ffffff !important;
    }


    /* =========================================================
       DATATABLE
    ========================================================= */
    .dataTables_wrapper {
        padding: 18px;
    }

    .dataTables_wrapper .row:first-child {
        margin-bottom: 14px;
    }

    .dataTables_wrapper .row:last-child {
        margin-top: 14px;
    }

    .dataTables_length label,
    .dataTables_filter label,
    .dataTables_info {
        font-size: 11px;

        color: #64748b;
    }

    .dataTables_length select {
        font-size: 11px !important;

        border-radius: 7px !important;

        border:
            1px solid #d7e0ea !important;
    }

    .dataTables_filter input {
        font-size: 11px !important;

        border:
            1px solid #d7e0ea !important;

        border-radius: 7px !important;

        padding: 7px 10px !important;

        margin-left: 7px !important;

        outline: none !important;
    }

    .dataTables_filter input:focus {
        border-color:
            var(--blue-main) !important;

        box-shadow:
            0 0 0 0.15rem
            rgba(24, 119, 242, 0.12) !important;
    }

    .dataTables_paginate .pagination {
        gap: 3px;
    }

    .dataTables_paginate .page-link {
        font-size: 10px;

        border-radius:
            6px !important;

        color:
            var(--blue-main);

        border:
            1px solid #e5e7eb;

        padding: 6px 9px;
    }

    .dataTables_paginate
    .page-item.active
    .page-link {
        background:
            var(--blue-main);

        border-color:
            var(--blue-main);

        color: white;
    }


    /* =========================================================
       MODAL
    ========================================================= */
    .modal-asuransi .modal-dialog {
        max-width: 460px;
    }

    .modal-asuransi .modal-content {
        border: none;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 15px 40px
            rgba(15, 23, 42, 0.18);
    }

    .modal-asuransi .modal-header {
        background-color:
            var(--blue-main);

        color: #ffffff;

        border: none;

        padding: 15px 18px;
    }

    .modal-asuransi .modal-title {
        font-size: 16px;

        font-weight: 700;
    }

    /*
     * Sesuai halaman master lain:
     * tombol X disembunyikan.
     */
    .modal-asuransi .btn-close {
        display: none !important;
    }

    .modal-asuransi .modal-body {
        padding: 20px 18px;

        background-color:
            #ffffff;
    }


    /* =========================================================
       FORM
    ========================================================= */
    .form-label-asuransi {
        display: block;

        font-size: 11px;

        font-weight: 600;

        color: #64748b;

        margin-bottom: 6px;
    }

    .form-control-asuransi,
    .form-select-asuransi {
        width: 100%;

        border:
            1px solid #d7e0ea;

        border-radius: 8px;

        padding: 9px 11px;

        font-size: 12px;

        color: #334155;

        background-color:
            #ffffff;

        transition: 0.2s ease;
    }

    .form-control-asuransi:focus,
    .form-select-asuransi:focus {
        border-color:
            var(--blue-main);

        box-shadow:
            0 0 0 3px
            rgba(24, 119, 242, 0.12);

        outline: none;
    }

    .form-group-asuransi {
        margin-bottom: 13px;
    }


    /* =========================================================
       MODAL FOOTER
    ========================================================= */
    .modal-asuransi .modal-footer {
        background-color:
            #f8fafc;

        border: none;

        padding: 12px 18px;
    }

    .btn-modal-cancel-asuransi {
        background-color:
            #f1f5f9 !important;

        color:
            #64748b !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 15px;

        font-size: 12px;

        font-weight: 600;
    }

    .btn-modal-cancel-asuransi:hover {
        background-color:
            #e2e8f0 !important;
    }

    .btn-modal-save-asuransi {
        background-color:
            var(--blue-main) !important;

        color:
            #ffffff !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 16px;

        font-size: 12px;

        font-weight: 600;
    }

    .btn-modal-save-asuransi:hover {
        background-color:
            var(--blue-dark) !important;
    }


    /* =========================================================
       DETAIL
    ========================================================= */
    .detail-asuransi-table {
        width: 100%;

        margin: 0;
    }

    .detail-asuransi-table td {
        padding: 9px 5px;

        border-bottom:
            1px solid #f1f5f9;

        font-size: 12px;

        vertical-align: top;
    }

    .detail-asuransi-table tr:last-child td {
        border-bottom: none;
    }

    .detail-asuransi-label {
        width: 120px;

        color: #64748b;

        font-weight: 600;
    }

    .detail-asuransi-value {
        color: #1e293b;

        font-weight: 500;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 768px) {

        .page-header-asuransi {
            flex-direction: column;

            align-items:
                flex-start !important;

            gap: 15px;
        }

        .btn-blue-primary-asuransi {
            width: 100%;
        }

        .table-asuransi {
            min-width: 700px;
        }

        .modal-asuransi .modal-dialog {
            max-width:
                calc(100% - 25px);

            margin: 12px auto;
        }
    }
</style>


<div class="container-fluid master-asuransi">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <div
        class="d-flex justify-content-between align-items-center page-header-asuransi"
    >

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box-asuransi">
                <i class="fas fa-shield-alt"></i>
            </div>

            <div>

                <h3 class="page-title-asuransi">
                    Master Asuransi
                </h3>

                <p class="page-subtitle-asuransi">
                    Data jenis asuransi yang tersedia
                </p>

            </div>

        </div>


        <button
            type="button"
            class="btn btn-blue-primary-asuransi"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahAsuransi"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Asuransi
        </button>

    </div>


    {{-- =====================================================
         TABLE
    ====================================================== --}}
    <div class="card card-table-asuransi">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    id="tableAsuransi"
                    class="table table-asuransi align-middle"
                >

                    <thead>

                        <tr>

                            <th
                                class="text-center"
                                width="50"
                            >
                                No
                            </th>

                            <th>
                                Kode
                            </th>

                            <th>
                                Jenis Asuransi
                            </th>

                            <th
                                class="text-center"
                                width="220"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>
                        {{-- DATA YAJRA --}}
                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}
<div
    class="modal fade modal-asuransi"
    id="modalTambahAsuransi"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-shield-alt"></i>

                    <h5 class="modal-title">
                        Tambah Asuransi
                    </h5>

                </div>

            </div>


            <form id="formTambahAsuransi">

                @csrf


                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="form-group-asuransi">

                        <label
                            for="tambah_kode_asuransi"
                            class="form-label-asuransi"
                        >
                            Kode Asuransi
                        </label>

                        <input
                            type="text"
                            id="tambah_kode_asuransi"
                            name="kode"
                            class="form-control-asuransi"
                            placeholder="Contoh: ASR001"
                            maxlength="255"
                            required
                        >

                    </div>


                    {{-- JENIS --}}
                    <div class="form-group-asuransi mb-0">

                        <label
                            for="tambah_nama_asuransi"
                            class="form-label-asuransi"
                        >
                            Jenis Asuransi
                        </label>


                        <select
                            id="tambah_nama_asuransi"
                            name="nama"
                            class="form-select-asuransi"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Asuransi --
                            </option>

                            <option value="Gigi">
                                Gigi
                            </option>

                            <option value="Rawat Inap">
                                Rawat Inap
                            </option>

                            <option value="Penyakit Kritis">
                                Penyakit Kritis
                            </option>

                            <option value="Rawat Jalan">
                                Rawat Jalan
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel-asuransi"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-modal-save-asuransi"
                    >
                        <i class="fas fa-save me-1"></i>
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
    class="modal fade modal-asuransi"
    id="modalLihatAsuransi"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-shield-alt"></i>

                    <h5 class="modal-title">
                        Detail Asuransi
                    </h5>

                </div>

            </div>


            <div class="modal-body">

                <table class="detail-asuransi-table">

                    <tr>

                        <td class="detail-asuransi-label">
                            ID
                        </td>

                        <td
                            class="detail-asuransi-value"
                            id="lihatAsuransiId"
                        >
                            -
                        </td>

                    </tr>


                    <tr>

                        <td class="detail-asuransi-label">
                            Kode
                        </td>

                        <td class="detail-asuransi-value">

                            <span
                                class="badge badge-code-asuransi"
                                id="lihatAsuransiKode"
                            >
                                -
                            </span>

                        </td>

                    </tr>


                    <tr>

                        <td class="detail-asuransi-label">
                            Jenis Asuransi
                        </td>

                        <td
                            class="detail-asuransi-value"
                            id="lihatAsuransiNama"
                        >
                            -
                        </td>

                    </tr>

                </table>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-modal-cancel-asuransi"
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
    class="modal fade modal-asuransi"
    id="modalEditAsuransi"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-edit"></i>

                    <h5 class="modal-title">
                        Edit Asuransi
                    </h5>

                </div>

            </div>


            <form id="formEditAsuransi">

                @csrf
                @method('PUT')


                <input
                    type="hidden"
                    id="edit_asuransi_id"
                >


                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="form-group-asuransi">

                        <label
                            for="edit_kode_asuransi"
                            class="form-label-asuransi"
                        >
                            Kode Asuransi
                        </label>


                        <input
                            type="text"
                            id="edit_kode_asuransi"
                            name="kode"
                            class="form-control-asuransi"
                            maxlength="255"
                            required
                        >

                    </div>


                    {{-- JENIS --}}
                    <div class="form-group-asuransi mb-0">

                        <label
                            for="edit_nama_asuransi"
                            class="form-label-asuransi"
                        >
                            Jenis Asuransi
                        </label>


                        <select
                            id="edit_nama_asuransi"
                            name="nama"
                            class="form-select-asuransi"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Asuransi --
                            </option>

                            <option value="Gigi">
                                Gigi
                            </option>

                            <option value="Rawat Inap">
                                Rawat Inap
                            </option>

                            <option value="Penyakit Kritis">
                                Penyakit Kritis
                            </option>

                            <option value="Rawat Jalan">
                                Rawat Jalan
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel-asuransi"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-modal-save-asuransi"
                    >
                        <i class="fas fa-save me-1"></i>
                        Update Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | DATATABLE
    |--------------------------------------------------------------------------
    */

    const table = $('#tableAsuransi').DataTable({

        processing: true,

        serverSide: true,

        ordering: false,


        ajax: {
            url:
                "{{ route('master-asuransi.data') }}",

            type:
                "GET"
        },


        pageLength: 10,


        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],


        columns: [

            /*
             * NO
             */
            {
                data:
                    'DT_RowIndex',

                name:
                    'DT_RowIndex',

                searchable:
                    false,

                orderable:
                    false,

                className:
                    'text-center'
            },


            /*
             * KODE
             */
            {
                data:
                    'kode',

                name:
                    'kode',

                render:
                    function (data) {

                        return `
                            <span class="badge badge-code-asuransi">
                                ${escapeHtml(data || '-')}
                            </span>
                        `;

                    }
            },


            /*
             * JENIS ASURANSI
             */
            {
                data:
                    'nama',

                name:
                    'nama',

                render:
                    function (data) {

                        return `
                            <div class="d-flex align-items-center gap-2">

                                <div class="avatar-asuransi">
                                    <i class="fas fa-shield-alt"></i>
                                </div>

                                <div class="asuransi-name">
                                    ${escapeHtml(data || '-')}
                                </div>

                            </div>
                        `;

                    }
            },


            /*
             * AKSI
             */
            {
                data:
                    'aksi',

                name:
                    'aksi',

                searchable:
                    false,

                orderable:
                    false,

                className:
                    'text-center'
            }

        ],


        language: {

            processing:
                "Memuat data...",

            search:
                "Cari:",

            lengthMenu:
                "Tampilkan _MENU_ data",

            info:
                "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty:
                "Tidak ada data",

            infoFiltered:
                "(difilter dari _MAX_ total data)",

            zeroRecords:
                "Data asuransi tidak ditemukan",

            emptyTable:
                "Belum ada data asuransi",

            paginate: {

                first:
                    "Pertama",

                last:
                    "Terakhir",

                next:
                    "Selanjutnya",

                previous:
                    "Sebelumnya"

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | ESCAPE HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(text) {

        return $('<div>')
            .text(text ?? '')
            .html();

    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH ASURANSI
    |--------------------------------------------------------------------------
    */

    $('#formTambahAsuransi').on(
        'submit',
        function (e) {

            e.preventDefault();


            const form =
                $(this);


            const button =
                form.find(
                    'button[type="submit"]'
                );


            button.prop(
                'disabled',
                true
            );


            $.ajax({

                url:
                    "{{ route('master-asuransi.store') }}",

                type:
                    "POST",

                headers: {
                    'Accept':
                        'application/json'
                },

                data:
                    form.serialize(),


                success:
                    function (response) {

                        const modal =
                            bootstrap.Modal
                                .getOrCreateInstance(
                                    document.getElementById(
                                        'modalTambahAsuransi'
                                    )
                                );


                        modal.hide();


                        form[0].reset();


                        table.ajax.reload(
                            null,
                            false
                        );


                        Swal.fire({

                            icon:
                                'success',

                            title:
                                'Berhasil!',

                            text:
                                response.message ||
                                'Data asuransi berhasil ditambahkan.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data asuransi gagal disimpan.'
                        );

                    },


                complete:
                    function () {

                        button.prop(
                            'disabled',
                            false
                        );

                    }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | LIHAT
    |--------------------------------------------------------------------------
    */

    $('#tableAsuransi').on(
        'click',
        '.btn-action-view-asuransi',
        function () {

            const data =
                table
                    .row(
                        $(this).closest('tr')
                    )
                    .data();


            if (!data) {
                return;
            }


            $('#lihatAsuransiId').text(
                data.id || '-'
            );


            $('#lihatAsuransiKode').text(
                data.kode || '-'
            );


            $('#lihatAsuransiNama').text(
                data.nama || '-'
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalLihatAsuransi'
                        )
                    );


            modal.show();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | BUKA EDIT
    |--------------------------------------------------------------------------
    */

    $('#tableAsuransi').on(
        'click',
        '.btn-action-edit-asuransi',
        function () {

            const data =
                table
                    .row(
                        $(this).closest('tr')
                    )
                    .data();


            if (!data) {
                return;
            }


            $('#edit_asuransi_id').val(
                data.id
            );


            $('#edit_kode_asuransi').val(
                data.kode || ''
            );


            $('#edit_nama_asuransi').val(
                data.nama || ''
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalEditAsuransi'
                        )
                    );


            modal.show();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    $('#formEditAsuransi').on(
        'submit',
        function (e) {

            e.preventDefault();


            const id =
                $('#edit_asuransi_id').val();


            const form =
                $(this);


            const button =
                form.find(
                    'button[type="submit"]'
                );


            button.prop(
                'disabled',
                true
            );


            $.ajax({

                url:
                    "{{ url('/master-asuransi') }}/" +
                    id,

                type:
                    "POST",

                headers: {
                    'Accept':
                        'application/json'
                },

                data:
                    form.serialize(),


                success:
                    function (response) {

                        const modal =
                            bootstrap.Modal
                                .getOrCreateInstance(
                                    document.getElementById(
                                        'modalEditAsuransi'
                                    )
                                );


                        modal.hide();


                        table.ajax.reload(
                            null,
                            false
                        );


                        Swal.fire({

                            icon:
                                'success',

                            title:
                                'Berhasil!',

                            text:
                                response.message ||
                                'Data asuransi berhasil diperbarui.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data asuransi gagal diperbarui.'
                        );

                    },


                complete:
                    function () {

                        button.prop(
                            'disabled',
                            false
                        );

                    }

            });

        }
    );


    /*
    |--------------------------------------------------------------------------
    | HAPUS
    |--------------------------------------------------------------------------
    */

    $('#tableAsuransi').on(
        'click',
        '.btn-action-delete-asuransi',
        function () {

            const data =
                table
                    .row(
                        $(this).closest('tr')
                    )
                    .data();


            if (!data) {
                return;
            }


            Swal.fire({

                title:
                    'Apakah Anda yakin?',

                text:
                    'Data asuransi "' +
                    (data.nama || '') +
                    '" akan dihapus.',

                icon:
                    'warning',

                showCancelButton:
                    true,

                confirmButtonColor:
                    '#ef4444',

                cancelButtonColor:
                    '#64748b',

                confirmButtonText:
                    'Ya, hapus!',

                cancelButtonText:
                    'Batal'

            }).then(
                function (result) {

                    if (
                        !result.isConfirmed
                    ) {
                        return;
                    }


                    $.ajax({

                        url:
                            "{{ url('/master-asuransi') }}/" +
                            data.id,

                        type:
                            "DELETE",

                        headers: {
                            'Accept':
                                'application/json'
                        },

                        data: {

                            _token:
                                "{{ csrf_token() }}"

                        },


                        success:
                            function (response) {

                                table.ajax.reload(
                                    null,
                                    false
                                );


                                Swal.fire({

                                    icon:
                                        'success',

                                    title:
                                        'Berhasil!',

                                    text:
                                        response.message ||
                                        'Data asuransi berhasil dihapus.',

                                    confirmButtonText:
                                        'OK'

                                });

                            },


                        error:
                            function (xhr) {

                                tampilkanError(
                                    xhr,
                                    'Data asuransi gagal dihapus.'
                                );

                            }

                    });

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | RESET FORM TAMBAH
    |--------------------------------------------------------------------------
    */

    $('#modalTambahAsuransi').on(
        'hidden.bs.modal',
        function () {

            document
                .getElementById(
                    'formTambahAsuransi'
                )
                .reset();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | ERROR AJAX
    |--------------------------------------------------------------------------
    */

    function tampilkanError(
        xhr,
        defaultMessage
    ) {

        let message =
            defaultMessage;


        if (
            xhr.responseJSON &&
            xhr.responseJSON.message
        ) {

            message =
                xhr.responseJSON.message;

        }


        if (
            xhr.responseJSON &&
            xhr.responseJSON.errors
        ) {

            const errors =
                Object.values(
                    xhr.responseJSON.errors
                ).flat();


            if (errors.length > 0) {

                message =
                    errors[0];

            }

        }


        Swal.fire({

            icon:
                'error',

            title:
                'Gagal!',

            text:
                message

        });

    }

});
</script>

@endpush
