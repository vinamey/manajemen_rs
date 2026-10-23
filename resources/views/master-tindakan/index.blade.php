@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Tindakan')

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
    .master-tindakan {
        padding: 12px 0;
    }


    /* =========================================================
       HEADER
    ========================================================= */
    .page-header-tindakan {
        margin-bottom: 22px;
    }

    .header-icon-box-tindakan {
        width: 42px;
        height: 42px;

        background-color: var(--blue-light-bg);

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        color: var(--blue-main);

        font-size: 18px;

        flex-shrink: 0;
    }

    .page-title-tindakan {
        font-size: 22px;
        font-weight: 700;

        color: #1e293b;

        margin: 0;

        line-height: 1.2;
    }

    .page-subtitle-tindakan {
        font-size: 12px;

        color: #64748b;

        margin: 3px 0 0;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */
    .btn-blue-primary-tindakan {
        background-color: var(--blue-main) !important;

        border: none !important;

        color: #ffffff !important;

        border-radius: 8px;

        padding: 9px 15px;

        font-size: 13px;
        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary-tindakan:hover {
        background-color: var(--blue-dark) !important;

        color: #ffffff !important;

        transform: translateY(-1px);
    }


    /* =========================================================
       TABLE CARD
    ========================================================= */
    .card-table-tindakan {
        border: none !important;

        border-radius: 12px !important;

        box-shadow:
            0 4px 12px
            rgba(0, 0, 0, 0.05) !important;
    }

    .card-table-tindakan .table-responsive {
        overflow-x: auto;
    }


    /* =========================================================
       TABLE
    ========================================================= */
    .table-tindakan {
        width: 100% !important;

        margin-bottom: 0 !important;
    }

    .table-tindakan thead th {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        font-size: 13px !important;

        font-weight: 600 !important;

        padding: 14px 16px !important;

        white-space: nowrap;
    }

    .table-tindakan tbody td {
        padding: 12px 16px !important;

        font-size: 13px !important;

        color: #475569;

        border-bottom:
            1px solid #f1f5f9 !important;

        vertical-align: middle;

        white-space: nowrap;
    }

    .table-tindakan tbody tr {
        transition: 0.15s ease;
    }

    .table-tindakan tbody tr:hover {
        background-color:
            var(--blue-soft) !important;
    }

    .table-tindakan tbody tr:last-child td {
        border-bottom: none !important;
    }


    /* =========================================================
       TINDAKAN PROFILE
    ========================================================= */
    .tindakan-name {
        color: #1e293b;

        font-weight: 600;

        margin-bottom: 2px;
    }

    .avatar-tindakan {
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
    .badge-code-tindakan {
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
    .btn-action-view-tindakan {
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

    .btn-action-view-tindakan:hover {
        background-color:
            #bae6fd !important;

        color:
            #0369a1 !important;
    }


    .btn-action-edit-tindakan {
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

    .btn-action-edit-tindakan:hover {
        background-color:
            var(--blue-dark) !important;

        color:
            #ffffff !important;
    }


    .btn-action-delete-tindakan {
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

    .btn-action-delete-tindakan:hover {
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
    }

    .dataTables_filter input:focus {
        border-color:
            var(--blue-main) !important;

        box-shadow:
            0 0 0 0.15rem
            rgba(24, 119, 242, 0.12) !important;

        outline: none !important;
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
    .modal-tindakan .modal-dialog {
        max-width: 460px;
    }

    .modal-tindakan .modal-content {
        border: none;

        border-radius: 14px;

        overflow: hidden;

        box-shadow:
            0 15px 40px
            rgba(15, 23, 42, 0.18);
    }

    .modal-tindakan .modal-header {
        background-color:
            var(--blue-main);

        color: #ffffff;

        border: none;

        padding: 15px 18px;
    }

    .modal-tindakan .modal-title {
        font-size: 16px;

        font-weight: 700;
    }

    /* X disembunyikan */
    .modal-tindakan .btn-close {
        display: none !important;
    }

    .modal-tindakan .modal-body {
        padding: 20px 18px;

        background-color:
            #ffffff;
    }


    /* =========================================================
       FORM
    ========================================================= */
    .form-label-tindakan {
        display: block;

        font-size: 11px;

        font-weight: 600;

        color: #64748b;

        margin-bottom: 6px;
    }

    .form-control-tindakan {
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

    .form-control-tindakan:focus {
        border-color:
            var(--blue-main);

        box-shadow:
            0 0 0 3px
            rgba(24, 119, 242, 0.12);

        outline: none;
    }

    .form-group-tindakan {
        margin-bottom: 13px;
    }


    /* =========================================================
       FOOTER
    ========================================================= */
    .modal-tindakan .modal-footer {
        background-color:
            #f8fafc;

        border: none;

        padding: 12px 18px;
    }

    .btn-modal-cancel-tindakan {
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

    .btn-modal-cancel-tindakan:hover {
        background-color:
            #e2e8f0 !important;
    }

    .btn-modal-save-tindakan {
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

    .btn-modal-save-tindakan:hover {
        background-color:
            var(--blue-dark) !important;
    }


    /* =========================================================
       DETAIL
    ========================================================= */
    .detail-tindakan-table {
        width: 100%;

        margin: 0;
    }

    .detail-tindakan-table td {
        padding: 9px 5px;

        border-bottom:
            1px solid #f1f5f9;

        font-size: 12px;

        vertical-align: top;
    }

    .detail-tindakan-table tr:last-child td {
        border-bottom: none;
    }

    .detail-tindakan-label {
        width: 120px;

        color: #64748b;

        font-weight: 600;
    }

    .detail-tindakan-value {
        color: #1e293b;

        font-weight: 500;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 768px) {

        .page-header-tindakan {
            flex-direction: column;

            align-items:
                flex-start !important;

            gap: 15px;
        }

        .btn-blue-primary-tindakan {
            width: 100%;
        }

        .table-tindakan {
            min-width: 700px;
        }

        .modal-tindakan .modal-dialog {
            max-width:
                calc(100% - 25px);

            margin: 12px auto;
        }
    }
</style>


<div class="container-fluid master-tindakan">

    {{-- =====================================================
         HEADER
    ====================================================== --}}
    <div
        class="d-flex justify-content-between align-items-center page-header-tindakan"
    >

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box-tindakan">
                <i class="fas fa-notes-medical"></i>
            </div>

            <div>

                <h3 class="page-title-tindakan">
                    Master Tindakan
                </h3>

                <p class="page-subtitle-tindakan">
                    Data tindakan yang tersedia
                </p>

            </div>

        </div>


        <button
            type="button"
            class="btn btn-blue-primary-tindakan"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahTindakan"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Tindakan
        </button>

    </div>


    {{-- =====================================================
         TABLE
    ====================================================== --}}
    <div class="card card-table-tindakan">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table
                    id="tableTindakan"
                    class="table table-tindakan align-middle"
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
                                Nama Tindakan
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




{{-- MODAL TAMBAH --}}
<div
    class="modal fade modal-tindakan"
    id="modalTambahTindakan"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-notes-medical"></i>
                    <h5 class="modal-title">Tambah Tindakan</h5>
                </div>
            </div>

            <form
                id="formTambahTindakan"
                method="POST"
                action="{{ route('master-tindakan.store') }}"
            >
                @csrf

                <div class="modal-body">
                    <div class="form-group-tindakan">
                        <label
                            for="tambah_kode"
                            class="form-label-tindakan"
                        >
                            Kode Tindakan
                        </label>

                        <input
                            type="text"
                            id="tambah_kode"
                            name="kode"
                            class="form-control-tindakan"
                            placeholder="Masukkan kode tindakan"
                            maxlength="255"
                            required
                        >
                    </div>

                    <div class="form-group-tindakan mb-0">
                        <label
                            for="tambah_nama"
                            class="form-label-tindakan"
                        >
                            Nama Tindakan
                        </label>

                        <input
                            type="text"
                            id="tambah_nama"
                            name="nama"
                            class="form-control-tindakan"
                            placeholder="Masukkan nama tindakan"
                            maxlength="255"
                            required
                        >
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-modal-cancel-tindakan"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        id="btnSimpanTindakan"
                        class="btn btn-modal-save-tindakan"
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
    class="modal fade modal-tindakan"
    id="modalLihatTindakan"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-notes-medical"></i>

                    <h5 class="modal-title">
                        Detail Tindakan
                    </h5>

                </div>

            </div>


            <div class="modal-body">

                <table class="detail-tindakan-table">

                    <tr>



                       

                    </tr>


                    <tr>

                        <td class="detail-tindakan-label">
                            Kode
                        </td>

                        <td class="detail-tindakan-value">

                            <span
                                class="badge badge-code-tindakan"
                                id="lihatTindakanKode"
                            >
                                -
                            </span>

                        </td>

                    </tr>


                    <tr>

                        <td class="detail-tindakan-label">
                            Nama Tindakan
                        </td>

                        <td
                            class="detail-tindakan-value"
                            id="lihatTindakanNama"
                        >
                            -
                        </td>

                    </tr>

                </table>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-modal-cancel-tindakan"
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
    class="modal fade modal-tindakan"
    id="modalEditTindakan"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-edit"></i>

                    <h5 class="modal-title">
                        Edit Tindakan
                    </h5>

                </div>

            </div>


            <form id="formEditTindakan">

                @csrf
                @method('PUT')


                <input
                    type="hidden"
                    id="edit_tindakan_id"
                >


                <div class="modal-body">

                    <div class="form-group-tindakan">

                        <label
                            for="edit_kode"
                            class="form-label-tindakan"
                        >
                            Kode Tindakan
                        </label>

                        <input
                            type="text"
                            id="edit_kode"
                            name="kode"
                            class="form-control-tindakan"
                            maxlength="255"
                            required
                        >

                    </div>


                    <div class="form-group-tindakan mb-0">

                        <label
                            for="edit_nama"
                            class="form-label-tindakan"
                        >
                            Nama Tindakan
                        </label>

                        <input
                            type="text"
                            id="edit_nama"
                            name="nama"
                            class="form-control-tindakan"
                            maxlength="255"
                            required
                        >

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel-tindakan"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-modal-save-tindakan"
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




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {
console.log('JavaScript Master Tindakan berhasil dijalankan');


    /*
    |--------------------------------------------------------------------------
    | DATATABLE
    |--------------------------------------------------------------------------
    */
    const table = $('#tableTindakan').DataTable({

        processing: true,

        serverSide: true,

        ordering: false,


        ajax: {
            url:
                "{{ route('master-tindakan.data') }}",

            type:
                "GET"
        },


        pageLength: 10,


        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],


        columns: [

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


            {
                data:
                    'kode',

                name:
                    'kode',

                render:
                    function (data) {

                        return `
                            <span class="badge badge-code-tindakan">
                                ${escapeHtml(data || '-')}
                            </span>
                        `;

                    }
            },


            {
                data:
                    'nama',

                name:
                    'nama',

                render:
                    function (data) {

                        return `
                            <div class="d-flex align-items-center gap-2">

                                <div class="avatar-tindakan">
                                    <i class="fas fa-notes-medical"></i>
                                </div>

                                <div class="tindakan-name">
                                    ${escapeHtml(data || '-')}
                                </div>

                            </div>
                        `;

                    }
            },


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
                "Data tindakan tidak ditemukan",

            emptyTable:
                "Belum ada data tindakan",

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
    | TAMBAH
    |--------------------------------------------------------------------------
    */
    $('#formTambahTindakan').on(
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
                    "{{ route('master-tindakan.store') }}",

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
                                        'modalTambahTindakan'
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
                                'Data tindakan berhasil ditambahkan.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data tindakan gagal disimpan.'
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
    $('#tableTindakan').on(
        'click',
        '.btn-action-view-tindakan',
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


            $('#lihatTindakanId').text(
                data.id || '-'
            );


            $('#lihatTindakanKode').text(
                data.kode || '-'
            );


            $('#lihatTindakanNama').text(
                data.nama || '-'
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalLihatTindakan'
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
    $('#tableTindakan').on(
        'click',
        '.btn-action-edit-tindakan',
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


            $('#edit_tindakan_id').val(
                data.id
            );


            $('#edit_kode').val(
                data.kode || ''
            );


            $('#edit_nama').val(
                data.nama || ''
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalEditTindakan'
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
    $('#formEditTindakan').on(
        'submit',
        function (e) {

            e.preventDefault();


            const id =
                $('#edit_tindakan_id').val();


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
                    "{{ url('/master-tindakan') }}/" +
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
                                        'modalEditTindakan'
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
                                'Data tindakan berhasil diperbarui.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data tindakan gagal diperbarui.'
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
    $('#tableTindakan').on(
        'click',
        '.btn-action-delete-tindakan',
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
                    'Data tindakan "' +
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
                            "{{ url('/master-tindakan') }}/" +
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
                                        'Data tindakan berhasil dihapus.',

                                    confirmButtonText:
                                        'OK'

                                });

                            },


                        error:
                            function (xhr) {

                                tampilkanError(
                                    xhr,
                                    'Data tindakan gagal dihapus.'
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
    $('#modalTambahTindakan').on(
        'hidden.bs.modal',
        function () {

            document
                .getElementById(
                    'formTambahTindakan'
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
