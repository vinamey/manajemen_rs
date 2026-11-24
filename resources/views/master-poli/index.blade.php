@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Poli')

@section('content')

{{-- DATATABLE CSS --}}
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
>

<style>
    /* =========================================================
       GLOBAL
    ========================================================= */
    .poli-page {
        padding: 0;
    }


    /* =========================================================
       HEADER
    ========================================================= */
    .poli-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .poli-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .poli-icon {
        width: 42px;
        height: 42px;

        background: #e7f3ff;
        color: #1877f2;

        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
    }

    .poli-title {
        margin: 0;

        font-size: 20px;
        font-weight: 700;

        color: #1f2937;
    }

    .poli-subtitle {
        margin: 3px 0 0;

        font-size: 11px;

        color: #8b95a5;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */
    .btn-tambah-poli {
        background: #1877f2;
        color: white;

        border: none;
        border-radius: 8px;

        padding: 9px 15px;

        font-size: 11px;
        font-weight: 600;
    }

    .btn-tambah-poli:hover {
        background: #0f58c6;
        color: white;
    }


    /* =========================================================
       CARD
    ========================================================= */
    .poli-card {
        background: white;

        border-radius: 12px;
        border: none;

        box-shadow:
            0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .poli-card .table-responsive {
        overflow-x: auto;
    }


    /* =========================================================
       TABLE
    ========================================================= */
    .poli-table {
        width: 100% !important;

        margin-bottom: 0 !important;

        border-collapse: collapse !important;
    }

    .poli-table thead {
        background: #1877f2;

        color: white;
    }

    .poli-table thead th {
        background: #1877f2 !important;

        color: white !important;

        padding: 14px 13px !important;

        font-size: 11px !important;
        font-weight: 700 !important;

        border: none !important;

        white-space: nowrap;
    }

    .poli-table tbody td {
        padding: 13px !important;

        font-size: 11px !important;

        color: #657184;

        vertical-align: middle;

        border-bottom:
            1px solid #f0f2f5 !important;

        white-space: nowrap;
    }

    .poli-table tbody tr:last-child td {
        border-bottom: none !important;
    }

    .poli-table tbody tr:hover {
        background: #f8fbff;
    }


    /* =========================================================
       BADGE NAMA
    ========================================================= */
    .badge-nama-poli {
        display: inline-block;

        background: #ffedd5;
        color: #ea580c;

        border-radius: 6px;

        padding: 6px 12px;

        font-size: 11px;
        font-weight: 700;
    }


    /* =========================================================
       AKSI
    ========================================================= */
    .aksi-wrapper {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .btn-poli-aksi {
        border: none;

        border-radius: 6px;

        padding: 8px 10px;

        font-size: 10px;
        font-weight: 600;

        min-width: 48px;
    }

    .btn-poli-lihat {
        background: #dff1ff;
        color: #087db5;
    }

    .btn-poli-lihat:hover {
        background: #c7e8fc;
        color: #087db5;
    }

    .btn-poli-edit {
        background: #1877f2;
        color: white;
    }

    .btn-poli-edit:hover {
        background: #0f58c6;
        color: white;
    }

    .btn-poli-hapus {
        background: #ef4444;
        color: white;
    }

    .btn-poli-hapus:hover {
        background: #dc2626;
        color: white;
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

        color: #657184;
    }

    .dataTables_length select {
        font-size: 11px !important;

        border-radius: 7px !important;

        border:
            1px solid #d9e0e8 !important;
    }

    .dataTables_filter input {
        font-size: 11px !important;

        border:
            1px solid #d9e0e8 !important;

        border-radius: 7px !important;

        padding: 7px 10px !important;

        outline: none !important;

        margin-left: 7px !important;
    }

    .dataTables_filter input:focus {
        border-color: #1877f2 !important;

        box-shadow:
            0 0 0 0.15rem
            rgba(24, 119, 242, 0.12) !important;
    }

    .dataTables_paginate .pagination {
        gap: 3px;
    }

    .dataTables_paginate .page-link {
        font-size: 10px;

        border-radius: 6px !important;

        color: #1877f2;

        border: 1px solid #e5e7eb;

        padding: 6px 9px;
    }

    .dataTables_paginate
    .page-item.active
    .page-link {
        background: #1877f2;

        border-color: #1877f2;

        color: white;
    }


    /* =========================================================
       MODAL
    ========================================================= */
    .poli-modal .modal-dialog {
        max-width: 520px;
    }

    .poli-modal .modal-content {
        border: none;

        border-radius: 12px;

        overflow: visible !important;
    }

    .poli-modal .modal-header {
        background: #1877f2;

        color: white;

        padding: 15px 20px;

        border-radius:
            12px 12px 0 0;

        border-bottom: none;
    }

    .poli-modal .modal-title {
        font-size: 15px;

        font-weight: 600;
    }

    .poli-modal .modal-body {
        padding: 20px;
    }

    .poli-modal .modal-footer {
        padding: 14px 20px;
    }

    .poli-modal .form-label {
        font-size: 12px;

        font-weight: 600;

        color: #374151;
    }

    .poli-modal .form-control {
        font-size: 12px;

        border-radius: 7px;

        padding: 9px 11px;
    }

    .poli-modal .form-control:focus {
        border-color: #1877f2;

        box-shadow:
            0 0 0 0.15rem
            rgba(24, 119, 242, 0.15);
    }

    .poli-modal .btn-close {
        display: none !important;
    }


    /* =========================================================
       DETAIL
    ========================================================= */
    .detail-item {
        margin-bottom: 16px;
    }

    .detail-label {
        margin-bottom: 5px;

        font-size: 12px;

        font-weight: 600;

        color: #374151;
    }

    .detail-value {
        font-size: 13px;

        color: #657184;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 768px) {

        .poli-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 12px;
        }

        .btn-tambah-poli {
            width: 100%;
        }
    }
</style>


{{-- =========================================================
     MASTER POLI
========================================================= --}}
<div class="poli-page">

    {{-- HEADER --}}
    <div class="poli-header">

        <div class="poli-title-wrapper">

            <div class="poli-icon">
                <i class="fas fa-hospital"></i>
            </div>


            <div>

                <h2 class="poli-title">
                    Master Poli
                </h2>

                <p class="poli-subtitle">
                    Data poli yang terdaftar
                </p>

            </div>

        </div>


        <button
            type="button"
            class="btn btn-tambah-poli"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah"
        >

            <i class="fas fa-plus me-1"></i>

            Tambah Poli

        </button>

    </div>


    {{-- TABLE --}}
    <div class="poli-card">

        <div class="table-responsive">

            <table
                id="poli-table"
                class="poli-table table align-middle"
            >

                <thead>

                    <tr>

                        <th width="8%">
                            No
                        </th>

                        <th width="35%">
                            Nama Poli
                        </th>

                        <th width="32%">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>
                    {{-- DATA OTOMATIS DARI YAJRA --}}
                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}
<div
    class="modal fade poli-modal"
    id="modalTambah"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-plus-circle me-2"></i>

                    Tambah Poli

                </h5>

            </div>


           
           <form id="formTambah"
                    method="POST"
                    action="{{ route('master-poli.store') }}"
                >
                    @csrf


                <div class="modal-body">

                    {{-- NAMA POLI --}}
                    <div class="mb-3">

                        <label
                            for="nama"
                            class="form-label"
                        >
                            Nama Poli
                        </label>


                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control"
                            placeholder="Contoh: Poli Umum"
                            required
                        >

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fas fa-save me-1"></i>

                        Simpan

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
    class="modal fade poli-modal"
    id="modalLihat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-eye me-2"></i>

                    Detail Poli

                </h5>

            </div>


            <div class="modal-body">


                <div class="detail-item">

                    <div class="detail-label">
                        Nama Poli
                    </div>

                    <div class="detail-value">

                        <span
                            class="badge-nama-poli"
                            id="lihatNama"
                        >
                            -
                        </span>

                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        ID
                    </div>

                    <div
                        class="detail-value"
                        id="lihatId"
                    >
                        -
                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
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
    class="modal fade poli-modal"
    id="modalEdit"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-edit me-2"></i>

                    Edit Poli

                </h5>

            </div>


            <form id="formEdit">

                @csrf
                @method('PUT')


                <input
                    type="hidden"
                    id="editId"
                >


                <div class="modal-body">


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label
                            for="editNama"
                            class="form-label"
                        >
                            Nama Poli
                        </label>


                        <input
                            type="text"
                            name="nama"
                            id="editNama"
                            class="form-control"
                            required
                        >

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fas fa-save me-1"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>






{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DATATABLE --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | DATATABLE
    |--------------------------------------------------------------------------
    */

    const table = $('#poli-table').DataTable({

        processing: true,

        serverSide: true,

        ordering: false,


        ajax: {
            url:
                "{{ route('master-poli.data') }}",

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
        data: 'DT_RowIndex',
        name: 'DT_RowIndex',
        searchable: false,
        orderable: false
    },
    {
        data: 'nama',
        name: 'nama',
        render: function (data) {
            return `
                <span class="badge-nama-poli">
                    ${escapeHtml(data || '-')}
                </span>
            `;
        }
    },
    {
        data: 'aksi',
        name: 'aksi',
        searchable: false,
        orderable: false
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
                "Data poli tidak ditemukan",

            emptyTable:
                "Belum ada data poli",

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
    | TAMBAH DATA
    |--------------------------------------------------------------------------
    */

    $('#formTambah').on(
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
                    "{{ route('master-poli.store') }}",

                type:
                    "POST",

                data:
                    form.serialize(),


                success:
                    function (response) {

                        const modal =
                            bootstrap.Modal
                                .getOrCreateInstance(
                                    document.getElementById(
                                        'modalTambah'
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
                                'Data poli berhasil ditambahkan.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data poli gagal disimpan.'
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
    | LIHAT DATA
    |--------------------------------------------------------------------------
    */

    $('#poli-table').on(
    'click',
    '.btn-poli-lihat',
    function () {

        const data = table
            .row($(this).closest('tr'))
            .data();

        if (!data) {
            return;
        }

        $('#lihatNama').text(data.nama || '-');
        $('#lihatId').text(data.id || '-');

        const modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihat')
        );

        modal.show();
    }
);


    /*
    |--------------------------------------------------------------------------
    | BUKA EDIT
    |--------------------------------------------------------------------------
    */

    $('#poli-table').on(
    'click',
    '.btn-poli-edit',
    function () {

        const data = table
            .row($(this).closest('tr'))
            .data();

        if (!data) {
            return;
        }

        $('#editId').val(data.id);
        $('#editNama').val(data.nama || '');

        const modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEdit')
        );

        modal.show();
    }
);


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    $('#formEdit').on(
        'submit',
        function (e) {

            e.preventDefault();


            const id =
                $('#editId').val();


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
                    "{{ url('/master-poli') }}/" +
                    id,

                type:
                    "POST",

                data:
                    form.serialize(),


                success:
                    function (response) {

                        const modal =
                            bootstrap.Modal
                                .getOrCreateInstance(
                                    document.getElementById(
                                        'modalEdit'
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
                                'Data poli berhasil diperbarui.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data poli gagal diperbarui.'
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

    $('#poli-table').on(
        'click',
        '.btn-poli-hapus',
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
                    'Data poli "' +
                    (data.nama || '') +
                    '" akan dihapus.',

                icon:
                    'warning',

                showCancelButton:
                    true,

                confirmButtonColor:
                    '#ef4444',

                cancelButtonColor:
                    '#6c757d',

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
                            "{{ url('/master-poli') }}/" +
                            data.id,

                        type:
                            "DELETE",

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
                                        'Data poli berhasil dihapus.',

                                    confirmButtonText:
                                        'OK'

                                });

                            },


                        error:
                            function (xhr) {

                                tampilkanError(
                                    xhr,
                                    'Data poli gagal dihapus.'
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

    $('#modalTambah').on(
        'hidden.bs.modal',
        function () {

            document
                .getElementById(
                    'formTambah'
                )
                .reset();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN ERROR
    |--------------------------------------------------------------------------
    */

    function tampilkanError(
        xhr,
        defaultMessage
    ) {

        let message =
            defaultMessage;


        /*
         * Pesan umum dari Controller
         */
        if (
            xhr.responseJSON &&
            xhr.responseJSON.message
        ) {

            message =
                xhr.responseJSON.message;

        }


        /*
         * Pesan validasi Laravel
         */
        if (
            xhr.responseJSON &&
            xhr.responseJSON.errors
        ) {

            const errors =
                Object.values(
                    xhr.responseJSON.errors
                ).flat();


            if (
                errors.length > 0
            ) {

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

@endsection
