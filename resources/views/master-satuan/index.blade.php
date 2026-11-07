@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Satuan Obat')

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
    .satuan-page {
        padding: 0;
    }

    /* =========================================================
       HEADER
    ========================================================= */
    .satuan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .satuan-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .satuan-icon {
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

    .satuan-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
    }

    .satuan-subtitle {
        margin: 3px 0 0;
        font-size: 11px;
        color: #8b95a5;
    }

    /* =========================================================
       TOMBOL TAMBAH
    ========================================================= */
    .btn-tambah-satuan {
        background: #1877f2;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-tambah-satuan:hover {
        background: #0f58c6;
        color: white;
    }

    /* =========================================================
       CARD TABLE
    ========================================================= */
    .satuan-card {
        background: white;
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        padding: 0;
    }

    .satuan-card .table-responsive {
        overflow-x: auto;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .satuan-table {
        width: 100% !important;
        margin-bottom: 0 !important;
        border-collapse: collapse !important;
    }

    .satuan-table thead {
        background: #1877f2;
        color: white;
    }

    .satuan-table thead th {
        background: #1877f2 !important;
        color: white !important;
        padding: 14px 13px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        border: none !important;
        white-space: nowrap;
    }

    .satuan-table tbody td {
        padding: 13px !important;
        font-size: 11px !important;
        color: #657184;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f5 !important;
        white-space: nowrap;
    }

    .satuan-table tbody tr:last-child td {
        border-bottom: none !important;
    }

    .satuan-table tbody tr:hover {
        background: #f8fbff;
    }

    /* =========================================================
       BADGE
    ========================================================= */
    .badge-kode {
        display: inline-block;
        background: #e0edff;
        color: #1d72f3;
        border-radius: 6px;
        padding: 6px 12px;
        font-size: 11px;
        font-weight: 700;
    }

    .badge-nama-satuan {
        display: inline-block;
        background: #ffedd5;
        color: #ea580c;
        border-radius: 6px;
        padding: 6px 12px;
        font-size: 11px;
        font-weight: 700;
    }

    /* =========================================================
       TOMBOL AKSI
    ========================================================= */
    .aksi-wrapper {
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .btn-satuan-aksi {
        border: none;
        border-radius: 6px;
        padding: 8px 10px;
        font-size: 10px;
        font-weight: 600;
        min-width: 48px;
    }

    .btn-satuan-lihat {
        background: #dff1ff;
        color: #087db5;
    }

    .btn-satuan-lihat:hover {
        background: #c7e8fc;
        color: #087db5;
    }

    .btn-satuan-edit {
        background: #1877f2;
        color: white;
    }

    .btn-satuan-edit:hover {
        background: #0f58c6;
        color: white;
    }

    .btn-satuan-hapus {
        background: #ef4444;
        color: white;
    }

    .btn-satuan-hapus:hover {
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
        border: 1px solid #d9e0e8 !important;
        padding: 5px 28px 5px 8px !important;
    }

    .dataTables_filter input {
        font-size: 11px !important;
        border: 1px solid #d9e0e8 !important;
        border-radius: 7px !important;
        padding: 7px 10px !important;
        outline: none !important;
        margin-left: 7px !important;
    }

    .dataTables_filter input:focus {
        border-color: #1877f2 !important;
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.12) !important;
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

    .dataTables_paginate .page-item.active .page-link {
        background: #1877f2;
        border-color: #1877f2;
        color: white;
    }

    /* =========================================================
       MODAL
    ========================================================= */
    .satuan-modal .modal-dialog {
        max-width: 520px;
    }

    .satuan-modal .modal-content {
        border: none;
        border-radius: 12px;
        overflow: visible !important;
    }

    .satuan-modal .modal-header {
        background: #1877f2;
        color: white;
        padding: 15px 20px;
        border-radius: 12px 12px 0 0;
        border-bottom: none;
    }

    .satuan-modal .modal-title {
        font-size: 15px;
        font-weight: 600;
    }

    .satuan-modal .modal-body {
        padding: 20px;
        overflow: visible !important;
    }

    .satuan-modal .modal-footer {
        padding: 14px 20px;
        border-radius: 0 0 12px 12px;
    }

    .satuan-modal .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
    }

    .satuan-modal .form-control {
        font-size: 12px;
        border-radius: 7px;
        padding: 9px 11px;
    }

    .satuan-modal .form-control:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.15);
    }

    .satuan-modal .btn-close {
        display: none !important;
    }

    /* =========================================================
       CUSTOM DROPDOWN
    ========================================================= */
    .custom-select-wrapper {
        position: relative;
        width: 100%;
        z-index: 100;
    }

    .custom-select-button {
        width: 100%;
        min-height: 40px;
        padding: 9px 38px 9px 11px;
        background: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 7px;
        font-size: 12px;
        color: #495057;
        text-align: left;
        cursor: pointer;
        position: relative;
    }

    .custom-select-button:hover {
        border-color: #1877f2;
    }

    .custom-select-button.active {
        border-color: #1877f2;
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.15);
    }

    .custom-select-arrow {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: #6c757d;
        pointer-events: none;
    }

    .custom-select-list {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        width: 100%;
        background: white;
        border: 1px solid #ced4da;
        border-radius: 7px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.15);
        z-index: 99999;
        display: none;
        max-height: 230px;
        overflow-y: auto;
    }

    .custom-select-list.show {
        display: block;
    }

    .custom-option {
        padding: 10px 12px;
        font-size: 12px;
        color: #374151;
        background: white;
        cursor: pointer;
        transition: 0.15s;
    }

    .custom-option:hover {
        background: #e7f3ff;
        color: #1877f2;
    }

    .custom-option.selected {
        background: #1877f2;
        color: white;
    }

    .custom-option.placeholder {
        color: #8b95a5;
    }

    /* =========================================================
       DETAIL
    ========================================================= */
    .detail-item {
        margin-bottom: 16px;
    }

    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 13px;
        color: #657184;
    }

    /* =========================================================
       SWEETALERT
    ========================================================= */
    .swal2-styled.swal2-confirm {
        border-radius: 6px !important;
        padding: 8px 24px !important;
        font-size: 13px !important;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */
    @media (max-width: 768px) {
        .satuan-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .btn-tambah-satuan {
            width: 100%;
        }
    }
</style>


{{-- =========================================================
     HALAMAN MASTER SATUAN
========================================================= --}}
<div class="satuan-page">

    {{-- HEADER --}}
    <div class="satuan-header">

        <div class="satuan-title-wrapper">

            <div class="satuan-icon">
                <i class="fas fa-box"></i>
            </div>

            <div>
                <h2 class="satuan-title">
                    Master Satuan Obat
                </h2>

                <p class="satuan-subtitle">
                    Data satuan obat yang terdaftar
                </p>
            </div>

        </div>


        <button
            type="button"
            class="btn btn-tambah-satuan"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Satuan
        </button>

    </div>


    {{-- TABLE --}}
    <div class="satuan-card">

        <div class="table-responsive">

            <table
                id="satuan-table"
                class="satuan-table table align-middle"
            >

                <thead>
                    <tr>

                        <th width="8%">
                            No
                        </th>

                        <th width="25%">
                            Kode Satuan
                        </th>

                        <th width="35%">
                            Nama Satuan
                        </th>

                        <th width="32%">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody>
                    {{-- Data otomatis dari Yajra --}}
                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}
<div
    class="modal fade satuan-modal"
    id="modalTambah"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Satuan Obat
                </h5>
            </div>

            <form
                id="formTambah"
                method="POST"
                action="{{ route('master-satuan.store') }}"
            >
                @csrf

                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="mb-3">
                        <label for="kode" class="form-label">
                            Kode Satuan
                        </label>

                        <input
                            type="text"
                            name="kode"
                            id="kode"
                            class="form-control"
                            placeholder="Contoh: TAB"
                        >
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label for="nama_satuan" class="form-label">
                            Nama Satuan
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="nama_satuan"
                            class="form-control"
                            placeholder="Masukkan nama satuan"
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
    class="modal fade satuan-modal"
    id="modalLihat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-eye me-2"></i>
                    Detail Satuan Obat
                </h5>

            </div>


            <div class="modal-body">

                <div class="detail-item">

                    <div class="detail-label">
                        Kode Satuan
                    </div>

                    <div class="detail-value">
                        <span
                            class="badge-kode"
                            id="lihatKode"
                        >
                            -
                        </span>
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Nama Satuan
                    </div>

                    <div class="detail-value">
                        <span
                            class="badge-nama-satuan"
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
    class="modal fade satuan-modal"
    id="modalEdit"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>
                    Edit Satuan Obat
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

                    {{-- KODE --}}
                    <div class="mb-3">

                        <label
                            for="editKode"
                            class="form-label"
                        >
                            Kode Satuan
                        </label>

                        <input
                            type="text"
                            name="kode"
                            id="editKode"
                            class="form-control"
                        >

                    </div>


                    {{-- NAMA --}}
                    
                    <div class="mb-3">

                        <label for="editNama" class="form-label">
                            Nama Satuan
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="editNama"
                            class="form-control"
                            placeholder="Masukkan nama satuan"
                            required
                        >

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
    | DATATABLE YAJRA
    |--------------------------------------------------------------------------
    */

    const table = $('#satuan-table').DataTable({

        processing: true,
        serverSide: true,

        ordering: false,

        ajax: {
            url: "{{ route('master-satuan.data') }}",
            type: "GET"
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
                data: 'kode',
                name: 'kode',

                render: function (data) {

                    return `
                        <span class="badge-kode">
                            ${escapeHtml(data || '-')}
                        </span>
                    `;
                }
            },

            {
                data: 'nama',
                name: 'nama',

                render: function (data) {

                    return `
                        <span class="badge-nama-satuan">
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

            processing: "Memuat data...",

            search: "Cari:",

            lengthMenu:
                "Tampilkan _MENU_ data",

            info:
                "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty:
                "Tidak ada data",

            infoFiltered:
                "(difilter dari _MAX_ total data)",

            zeroRecords:
                "Data satuan tidak ditemukan",

            emptyTable:
                "Belum ada data satuan obat",

            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Selanjutnya",
                previous: "Sebelumnya"
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
    | ELEMENT DROPDOWN TAMBAH
    |--------------------------------------------------------------------------
    */

    const namaInput = document.getElementById('nama_satuan');


    
/* ELEMENT INPUT EDIT */
    const editNamaInput =
    document.getElementById('editNama');


    /*
    |--------------------------------------------------------------------------
    | KLIK DI LUAR DROPDOWN
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function () {
    editNamaList.classList.remove('show');
    editNamaButton.classList.remove('active');
});

    /*
    |--------------------------------------------------------------------------
    | TAMBAH DATA
    |--------------------------------------------------------------------------
    */

    $('#formTambah').on(
        'submit',
        function (e) {

            e.preventDefault();


            if (!namaInput.value.trim()) {
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Silakan masukkan nama satuan terlebih dahulu.'
            });

            return;
        }


            const form = $(this);

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
                    "{{ route('master-satuan.store') }}",

                type: "POST",

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

                        resetDropdownTambah();


                        table.ajax.reload(
                            null,
                            false
                        );


                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text:
                                response.message ||
                                'Data satuan obat berhasil ditambahkan.',
                            confirmButtonText:
                                'OK'
                        });
                    },

                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data satuan gagal disimpan.'
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

    $('#satuan-table').on(
        'click',
        '.btn-satuan-lihat',
        function () {
            console.log('TOMBOL LIHAT DIKLIK');

            const row =
                $(this).closest('tr');


            const data =
                table.row(row).data();


            if (!data) {
                return;
            }


            $('#lihatKode').text(
                data.kode || '-'
            );

            $('#lihatNama').text(
                data.nama || '-'
            );

            $('#lihatId').text(
                data.id || '-'
            );


            const modal =
                bootstrap.Modal
                    .getOrCreateInstance(
                        document.getElementById(
                            'modalLihat'
                        )
                    );


            modal.show();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | EDIT DATA
    |--------------------------------------------------------------------------
    */


$('#satuan-table').on(
    'click',
    '.btn-satuan-edit',
    function () {

        const row = $(this).closest('tr');
        const data = table.row(row).data();

        if (!data) {
            return;
        }

        $('#editId').val(data.id);
        $('#editKode').val(data.kode || '');
        $('#editNama').val(data.nama || '');

        const modal = bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEdit')
        );

        modal.show();
    }
);



    /*
    |--------------------------------------------------------------------------
    | SIMPAN EDIT
    |--------------------------------------------------------------------------
    */

    $('#formEdit').on(
        'submit',
        function (e) {

            e.preventDefault();


            if (!editNamaInput.value.trim()) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Silakan masukkan nama satuan terlebih dahulu.'
                });

                return;
            }


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
                    "{{ url('/master-satuan') }}/" +
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
                            icon: 'success',
                            title: 'Berhasil!',
                            text:
                                response.message ||
                                'Data satuan obat berhasil diperbarui.',
                            confirmButtonText:
                                'OK'
                        });

                    },

                error:
                    function (xhr) {

                        tampilkanError(
                            xhr,
                            'Data satuan gagal diperbarui.'
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

    $('#satuan-table').on(
        'click',
        '.btn-satuan-hapus',
        function () {

            const row =
                $(this).closest('tr');


            const data =
                table.row(row).data();


            if (!data) {
                return;
            }


            Swal.fire({

                title:
                    'Apakah Anda yakin?',

                text:
                    'Data satuan "' +
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
                            "{{ url('/master-satuan') }}/" +
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
                                        'Data satuan berhasil dihapus.',

                                    confirmButtonText:
                                        'OK'
                                });

                            },

                        error:
                            function (xhr) {

                                tampilkanError(
                                    xhr,
                                    'Data satuan gagal dihapus.'
                                );
                            }

                    });

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | RESET MODAL TAMBAH
    |--------------------------------------------------------------------------
    */

    $('#modalTambah').on(
        'hidden.bs.modal',
        function () {

            const form =
                document.getElementById(
                    'formTambah'
                );

            form.reset();

            resetDropdownTambah();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | FUNCTION RESET DROPDOWN
    |--------------------------------------------------------------------------
    */

   function resetDropdownTambah() {
    namaInput.value = '';
}

    /*
    |--------------------------------------------------------------------------
    | FUNCTION ERROR AJAX
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


            if (
                errors.length > 0
            ) {

                message =
                    errors[0];
            }

        }


        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: message
        });

    }

});
</script>

@endsection
