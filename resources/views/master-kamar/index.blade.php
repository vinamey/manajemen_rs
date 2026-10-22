@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Kamar')

@section('content')

{{-- DATATABLE CSS --}}
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
>

<style>
    :root {
        --kamar-blue: #1877f2;
        --kamar-blue-dark: #0f58c6;
        --kamar-blue-light: #e8f1fd;
        --kamar-bg: #f4f6f9;
    }

    /* =========================================================
       PAGE
    ========================================================= */
    .kamar-page {
        padding: 20px 28px;
        background: var(--kamar-bg);
        min-height: calc(100vh - 70px);
    }


    /* =========================================================
       HEADER
    ========================================================= */
    .kamar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .kamar-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kamar-icon {
        width: 42px;
        height: 42px;
        background: var(--kamar-blue-light);
        color: var(--kamar-blue);
        border-radius: 10px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 18px;
    }

    .kamar-title {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
        color: #1f2937;
    }

    .kamar-subtitle {
        margin: 3px 0 0;
        font-size: 11px;
        color: #8b95a5;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */
    .btn-tambah-kamar {
        background: var(--kamar-blue);
        color: white;
        border: none;
        border-radius: 8px;

        padding: 10px 16px;

        font-size: 11px;
        font-weight: 600;

        box-shadow:
            0 3px 8px rgba(24, 119, 242, 0.25);
    }

    .btn-tambah-kamar:hover {
        background: var(--kamar-blue-dark);
        color: white;
    }


    /* =========================================================
       CARD
    ========================================================= */
    .kamar-card {
        background: white;

        border-radius: 12px;
        border: none;

        box-shadow:
            0 3px 12px rgba(0, 0, 0, 0.04);
    }

    .kamar-card .table-responsive {
        overflow-x: auto;
    }


    /* =========================================================
       TABLE
    ========================================================= */
    .kamar-table {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    .kamar-table thead th {
        background: var(--kamar-blue) !important;
        color: white !important;

        padding: 13px 14px !important;

        font-size: 11px !important;
        font-weight: 600 !important;

        border: none !important;
        white-space: nowrap;
    }

    .kamar-table tbody td {
        padding: 14px !important;

        font-size: 11px !important;

        color: #657184;

        vertical-align: middle;

        border-bottom:
            1px solid #eef1f5 !important;

        white-space: nowrap;
    }

    .kamar-table tbody tr:last-child td {
        border-bottom: none !important;
    }

    .kamar-table tbody tr:hover td {
        background: #f8fbff;
    }


    /* =========================================================
       BADGE KODE
    ========================================================= */
    .kode-badge {
        display: inline-block;

        background: #e8f1fd;
        color: var(--kamar-blue);

        padding: 5px 10px;

        border-radius: 6px;

        font-size: 10px;
        font-weight: 600;
    }


    /* =========================================================
       BADGE NAMA
    ========================================================= */
    .nama-badge {
        display: inline-block;

        background: #fef0d5;
        color: #e67e22;

        padding: 5px 11px;

        border-radius: 6px;

        font-size: 10px;
        font-weight: 600;
    }


    /* =========================================================
       STATUS
    ========================================================= */
    .status-badge {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 10px;

        border-radius: 6px;

        font-size: 10px;
        font-weight: 600;
    }

    .status-tersedia {
        background: #e8f8ef;
        color: #198754;
    }

    .status-terisi {
        background: #fff0f0;
        color: #dc3545;
    }

    .status-lain {
        background: #f1f5f9;
        color: #64748b;
    }


    /* =========================================================
       AKSI
    ========================================================= */
    .aksi-wrapper {
        display: flex;
        align-items: center;
        gap: 3px;
        white-space: nowrap;
    }

    .btn-aksi-kamar {
        border: none;

        border-radius: 6px;

        padding: 7px 10px;

        font-size: 10px;
        font-weight: 600;

        display: inline-flex;
        align-items: center;

        gap: 4px;
    }

    .btn-lihat-kamar {
        background: #e3f2fd;
        color: #0288d1;
    }

    .btn-lihat-kamar:hover {
        background: #cce9fa;
        color: #0288d1;
    }

    .btn-edit-kamar {
        background: var(--kamar-blue);
        color: white;
    }

    .btn-edit-kamar:hover {
        background: var(--kamar-blue-dark);
        color: white;
    }

    .btn-hapus-kamar {
        background: #ef4444;
        color: white;
    }

    .btn-hapus-kamar:hover {
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
        border: 1px solid #d9e1ea !important;
    }

    .dataTables_filter input {
        font-size: 11px !important;

        border:
            1px solid #d9e1ea !important;

        border-radius: 7px !important;

        padding: 7px 10px !important;

        outline: none !important;

        margin-left: 7px !important;
    }

    .dataTables_filter input:focus {
        border-color:
            var(--kamar-blue) !important;

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

        color: var(--kamar-blue);

        border:
            1px solid #e5e7eb;

        padding: 6px 9px;
    }

    .dataTables_paginate
    .page-item.active
    .page-link {
        background:
            var(--kamar-blue);

        border-color:
            var(--kamar-blue);

        color: white;
    }


    /* =========================================================
       MODAL
    ========================================================= */
    .kamar-modal .modal-dialog {
        max-width: 500px;
    }

    .kamar-modal .modal-content {
        border: none;

        border-radius: 12px;

        overflow: hidden;

        box-shadow:
            0 10px 35px
            rgba(0, 0, 0, 0.15);
    }

    .kamar-modal .modal-header {
        background:
            var(--kamar-blue);

        color: white;

        padding: 14px 18px;

        border: none;
    }

    .kamar-modal .modal-title {
        font-size: 14px;
        font-weight: 600;
    }

    .kamar-modal .modal-body {
        padding: 20px;
    }

    .kamar-modal .modal-footer {
        background: #f8fafc;

        padding: 12px 18px;

        border-top:
            1px solid #edf0f4;
    }

    .kamar-modal .form-label {
        font-size: 11px;

        font-weight: 600;

        color: #374151;

        margin-bottom: 6px;
    }

    .kamar-modal .form-control,
    .kamar-modal .form-select {
        font-size: 11px;

        border-radius: 7px;

        padding: 9px 11px;

        border:
            1px solid #d9e1ea;
    }

    .kamar-modal .form-control:focus,
    .kamar-modal .form-select:focus {
        border-color:
            var(--kamar-blue);

        box-shadow:
            0 0 0 0.15rem
            rgba(24, 119, 242, 0.12);
    }

    .kamar-modal .btn-close {
        display: none !important;
    }


    /* =========================================================
       MODAL BUTTON
    ========================================================= */
    .btn-batal-kamar {
        background: #e9eef5;

        color: #64748b;

        border: none;

        border-radius: 6px;

        padding: 8px 14px;

        font-size: 10px;
        font-weight: 600;
    }

    .btn-simpan-kamar {
        background:
            var(--kamar-blue);

        color: white;

        border: none;

        border-radius: 6px;

        padding: 8px 14px;

        font-size: 10px;
        font-weight: 600;
    }

    .btn-simpan-kamar:hover {
        background:
            var(--kamar-blue-dark);

        color: white;
    }


    /* =========================================================
       DETAIL
    ========================================================= */
    .detail-box {
        background: #f8fafc;

        border:
            1px solid #edf0f4;

        border-radius: 8px;

        padding: 12px;

        margin-bottom: 12px;
    }

    .detail-label {
        font-size: 10px;

        color: #8b95a5;

        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 12px;

        font-weight: 600;

        color: #374151;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 768px) {

        .kamar-page {
            padding: 12px;
        }

        .kamar-header {
            flex-direction: column;

            align-items: flex-start;

            gap: 12px;
        }

        .btn-tambah-kamar {
            width: 100%;
        }

        .kamar-table {
            min-width: 700px;
        }
    }
</style>


{{-- =========================================================
     HALAMAN MASTER KAMAR
========================================================= --}}
<div class="kamar-page">

    {{-- HEADER --}}
    <div class="kamar-header">

        <div class="kamar-title-wrapper">

            <div class="kamar-icon">
                <i class="fas fa-bed"></i>
            </div>


            <div>

                <h2 class="kamar-title">
                    Master Kamar
                </h2>

                <p class="kamar-subtitle">
                    Data kamar yang terdaftar
                </p>

            </div>

        </div>


        <button
            type="button"
            class="btn btn-tambah-kamar"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahKamar"
        >

            <i class="fas fa-plus me-1"></i>

            Tambah Kamar

        </button>

    </div>


    {{-- TABLE --}}
    <div class="kamar-card">

        <div class="table-responsive">

            <table
                id="kamar-table"
                class="kamar-table table align-middle"
            >

                <thead>

                    <tr>

                        <th
                            width="7%"
                            class="text-center"
                        >
                            No
                        </th>

                        <th width="22%">
                            Kode Kamar
                        </th>

                        <th width="30%">
                            Nama Kamar
                        </th>

                        <th width="20%">
                            Status
                        </th>

                        <th width="21%">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>
                    {{-- DATA OTOMATIS YAJRA --}}
                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}
<div
    class="modal fade kamar-modal"
    id="modalTambahKamar"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-plus-circle me-2"></i>

                    Tambah Kamar

                </h5>

            </div>


            <form id="formTambahKamar">

                @csrf


                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="mb-3">

                        <label
                            for="kode"
                            class="form-label"
                        >
                            Kode Kamar
                        </label>


                        <input
                            type="text"
                            name="kode"
                            id="kode"
                            class="form-control"
                            placeholder="Contoh: KMR001"
                            required
                        >

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label
                            for="nama"
                            class="form-label"
                        >
                            Nama Kamar
                        </label>


                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control"
                            placeholder="Contoh: Melati"
                            required
                        >

                    </div>


                    {{-- STATUS --}}
                    <div class="mb-3">

                        <label
                            for="status"
                            class="form-label"
                        >
                            Status
                        </label>


                        <select
                            name="status"
                            id="status"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option value="tersedia">
                                Tersedia
                            </option>

                            <option value="terisi">
                                Terisi
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-batal-kamar"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-simpan-kamar"
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
    class="modal fade kamar-modal"
    id="modalLihatKamar"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-eye me-2"></i>

                    Detail Kamar

                </h5>

            </div>


            <div class="modal-body">

                {{-- KODE --}}
                <div class="detail-box">

                    <div class="detail-label">
                        Kode Kamar
                    </div>

                    <div class="detail-value">

                        <span
                            class="kode-badge"
                            id="lihatKode"
                        >
                            -
                        </span>

                    </div>

                </div>


                {{-- NAMA --}}
                <div class="detail-box">

                    <div class="detail-label">
                        Nama Kamar
                    </div>

                    <div class="detail-value">

                        <span
                            class="nama-badge"
                            id="lihatNama"
                        >
                            -
                        </span>

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="detail-box">

                    <div class="detail-label">
                        Status
                    </div>

                    <div
                        class="detail-value"
                        id="lihatStatus"
                    >
                        -
                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-batal-kamar"
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
    class="modal fade kamar-modal"
    id="modalEditKamar"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-edit me-2"></i>

                    Edit Kamar

                </h5>

            </div>


            <form id="formEditKamar">

                @csrf
                @method('PUT')


                <input
                    type="hidden"
                    id="editId"
                >


                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="mb-3">

                        <label
                            for="editKode"
                            class="form-label"
                        >
                            Kode Kamar
                        </label>


                        <input
                            type="text"
                            name="kode"
                            id="editKode"
                            class="form-control"
                            placeholder="Contoh: KMR001"
                            required
                        >

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label
                            for="editNama"
                            class="form-label"
                        >
                            Nama Kamar
                        </label>


                        <input
                            type="text"
                            name="nama"
                            id="editNama"
                            class="form-control"
                            placeholder="Contoh: Melati"
                            required
                        >

                    </div>


                    {{-- STATUS --}}
                    <div class="mb-3">

                        <label
                            for="editStatus"
                            class="form-label"
                        >
                            Status
                        </label>


                        <select
                            name="status"
                            id="editStatus"
                            class="form-select"
                            required
                        >

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option value="tersedia">
                                Tersedia
                            </option>

                            <option value="terisi">
                                Terisi
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-batal-kamar"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="btn btn-simpan-kamar"
                    >

                        <i class="fas fa-save me-1"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection


@push('scripts')

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
    | DATATABLE YAJRA
    |--------------------------------------------------------------------------
    */

    const table = $('#kamar-table').DataTable({

        processing: true,

        serverSide: true,

        ordering: false,


        ajax: {
            url:
                "{{ route('master-kamar.data') }}",

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
                            <span class="kode-badge">
                                ${escapeHtml(data || '-')}
                            </span>
                        `;
                    }
            },


            /*
             * NAMA
             */
            {
                data:
                    'nama',

                name:
                    'nama',

                render:
                    function (data) {

                        return `
                            <span class="nama-badge">
                                ${escapeHtml(data || '-')}
                            </span>
                        `;
                    }
            },


            /*
             * STATUS
             */
            {
                data:
                    'status',

                name:
                    'status',

                render:
                    function (data) {

                        return buatBadgeStatus(
                            data
                        );
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
                    false
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
                "Data kamar tidak ditemukan",

            emptyTable:
                "Belum ada data kamar",

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
    | BUAT BADGE STATUS
    |--------------------------------------------------------------------------
    */

    function buatBadgeStatus(status) {

        if (status === 'tersedia') {

            return `
                <span class="status-badge status-tersedia">
                    <i class="fas fa-check-circle"></i>
                    Tersedia
                </span>
            `;

        }


        if (status === 'terisi') {

            return `
                <span class="status-badge status-terisi">
                    <i class="fas fa-user"></i>
                    Terisi
                </span>
            `;

        }


        return `
            <span class="status-badge status-lain">
                ${escapeHtml(status || '-')}
            </span>
        `;

    }


    /*
    |--------------------------------------------------------------------------
    | TAMBAH DATA
    |--------------------------------------------------------------------------
    */

    $('#formTambahKamar').on(
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
                    "{{ route('master-kamar.store') }}",

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
                                        'modalTambahKamar'
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
                                'Data kamar berhasil ditambahkan.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data kamar gagal disimpan.'
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

    $('#kamar-table').on(
        'click',
        '.btn-lihat-kamar',
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


            $('#lihatKode').text(
                data.kode || '-'
            );


            $('#lihatNama').text(
                data.nama || '-'
            );


            $('#lihatStatus').html(
                buatBadgeStatus(
                    data.status
                )
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalLihatKamar'
                        )
                    );


            modal.show();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | BUKA MODAL EDIT
    |--------------------------------------------------------------------------
    */

    $('#kamar-table').on(
        'click',
        '.btn-edit-kamar',
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


            $('#editId').val(
                data.id
            );


            $('#editKode').val(
                data.kode || ''
            );


            $('#editNama').val(
                data.nama || ''
            );


            $('#editStatus').val(
                data.status || ''
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalEditKamar'
                        )
                    );


            modal.show();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    $('#formEditKamar').on(
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
                    "{{ url('/master-kamar') }}/" +
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
                                        'modalEditKamar'
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
                                'Data kamar berhasil diperbarui.',

                            confirmButtonText:
                                'OK'

                        });

                    },


                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data kamar gagal diperbarui.'
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
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */

    $('#kamar-table').on(
        'click',
        '.btn-hapus-kamar',
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
                    'Data kamar "' +
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
                            "{{ url('/master-kamar') }}/" +
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
                                        'Data kamar berhasil dihapus.',

                                    confirmButtonText:
                                        'OK'

                                });

                            },


                        error:
                            function (xhr) {

                                tampilkanError(
                                    xhr,
                                    'Data kamar gagal dihapus.'
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

    $('#modalTambahKamar').on(
        'hidden.bs.modal',
        function () {

            document
                .getElementById(
                    'formTambahKamar'
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


        /*
         * Pesan dari Controller
         */
        if (
            xhr.responseJSON &&
            xhr.responseJSON.message
        ) {

            message =
                xhr.responseJSON.message;

        }


        /*
         * Error validasi Laravel
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

@endpush
