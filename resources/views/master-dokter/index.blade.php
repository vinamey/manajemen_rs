@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Dokter')

@section('content')

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

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
    .master-dokter {
        padding: 5px 0 30px;
    }

    /* =========================================================
       HEADER
    ========================================================= */
    .page-header-dokter {
        margin-bottom: 22px;
    }

    .header-icon-box {
        width: 44px;
        height: 44px;
        background: var(--blue-light-bg);
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-main);
        font-size: 18px;
        flex-shrink: 0;
    }

    .page-title-dokter {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .page-subtitle-dokter {
        font-size: 12px;
        color: #64748b;
        margin: 3px 0 0;
    }

    .btn-blue-primary {
        background: var(--blue-main) !important;
        border: none !important;
        color: #fff !important;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-blue-primary:hover {
        background: var(--blue-dark) !important;
    }

    /* =========================================================
       TABLE CARD
    ========================================================= */
    .card-table-dokter {
        background: #fff;
        border: none;
        border-radius: 13px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.06);
        padding: 18px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    #dokter-table {
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    #dokter-table thead th {
        background: var(--blue-main) !important;
        color: #fff !important;
        border: none !important;
        padding: 13px 12px !important;
        font-size: 12px;
        font-weight: 600;
        vertical-align: middle;
        white-space: nowrap;
    }

    #dokter-table tbody td {
        background: #fff;
        color: #475569;
        border-bottom: 1px solid #edf2f7;
        padding: 12px !important;
        font-size: 12px;
        vertical-align: middle;
    }

    #dokter-table tbody tr:hover td {
        background: var(--blue-soft);
    }

    /* =========================================================
       BADGE
    ========================================================= */
    .badge-gender {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #e0f2fe;
        color: #0284c7;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-poli {
        display: inline-block;
        background: #dcfce7;
        color: #15803d;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* =========================================================
       ACTION
    ========================================================= */
    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 7px;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 12px;
        transition: .2s;
    }

    .btn-view {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-view:hover {
        background: #bae6fd;
        color: #0369a1;
    }

    .btn-edit {
        background: var(--blue-main);
        color: #fff;
    }

    .btn-edit:hover {
        background: var(--blue-dark);
        color: #fff;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: #fff;
    }

    /* =========================================================
       DATATABLE
    ========================================================= */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
        font-size: 12px;
        color: #64748b;
    }

    .dataTables_wrapper .dataTables_length select {
        min-width: 65px;
        border: 1px solid #dbe3ec !important;
        border-radius: 7px !important;
        padding: 5px 28px 5px 8px !important;
        font-size: 12px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #dbe3ec !important;
        border-radius: 7px !important;
        padding: 6px 10px !important;
        font-size: 12px;
        box-shadow: none !important;
        margin-left: 6px !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--blue-main) !important;
        box-shadow: 0 0 0 3px rgba(24,119,242,.10) !important;
        outline: none;
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 11px;
        color: #64748b;
        padding-top: 15px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px !important;
    }

    .dataTables_wrapper .page-link {
        font-size: 11px;
        color: var(--blue-main);
        border-radius: 6px !important;
        margin: 0 2px;
        border: 1px solid #e2e8f0;
        box-shadow: none !important;
    }

    .dataTables_wrapper .page-item.active .page-link {
        background: var(--blue-main);
        border-color: var(--blue-main);
        color: #fff;
    }

    /* =========================================================
       MODAL
    ========================================================= */
    .modal-dokter .modal-dialog {
        max-width: 500px;
    }

    .modal-dokter .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15,23,42,.18);
    }

    .modal-dokter .modal-header {
        background: var(--blue-main);
        color: #fff;
        border: none;
        padding: 15px 18px;
    }

    .modal-dokter .modal-title {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    .modal-dokter .modal-body {
        padding: 20px 18px;
        background: #fff;
    }

    .modal-dokter .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 12px 18px;
    }

    /* =========================================================
       FORM
    ========================================================= */
    .form-group-dokter {
        margin-bottom: 13px;
    }

    .form-label-dokter {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
    }

    .form-control-dokter,
    .form-select-dokter {
        width: 100%;
        border: 1px solid #d7e0ea;
        border-radius: 8px;
        padding: 9px 11px;
        font-size: 12px;
        color: #334155;
        background: #fff;
        outline: none;
    }

    .form-control-dokter:focus,
    .form-select-dokter:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.12);
    }

    textarea.form-control-dokter {
        min-height: 75px;
        resize: vertical;
    }

    .form-control-dokter:disabled {
        background: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    .form-note {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 4px;
    }

    .btn-modal-cancel {
        background: #f1f5f9 !important;
        color: #64748b !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save {
        background: var(--blue-main) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save:hover {
        background: var(--blue-dark) !important;
    }

    /* =========================================================
       DETAIL
    ========================================================= */
    .detail-body-dokter {
        padding: 0 15px !important;
    }

    .detail-full-dokter {
        padding: 14px 5px;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row-dokter {
        margin: 0 !important;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row-dokter > div {
        padding: 14px 5px;
    }

    .detail-row-dokter > div:first-child {
        border-right: 1px solid #e5e7eb;
    }

    .detail-label-dokter {
        font-size: 10px;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .detail-value-dokter {
        font-size: 12px;
        color: #475569;
        line-height: 1.5;
        word-break: break-word;
    }

    .detail-name {
        color: #334155;
        font-weight: 700;
    }

    .alamat-detail-dokter {
        border-bottom: none;
    }

    @media (max-width: 768px) {
        .page-header-dokter {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 12px;
        }

        .btn-blue-primary {
            width: 100%;
        }
    }
</style>

<div class="container-fluid master-dokter">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center page-header-dokter">

        <div class="d-flex align-items-center gap-3">
            <div class="header-icon-box">
                <i class="fas fa-user-doctor"></i>
            </div>

            <div>
                <h3 class="page-title-dokter">
                    Master Dokter
                </h3>

                <p class="page-subtitle-dokter">
                    Data dokter yang terdaftar
                </p>
            </div>
        </div>

        <button
            type="button"
            class="btn btn-blue-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahDokter"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Dokter
        </button>

    </div>

    {{-- TABLE --}}
    <div class="card-table-dokter">

        <div class="table-responsive">

            <table
                id="dokter-table"
                class="table align-middle"
            >
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Dokter</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Spesialis</th>
                        <th>Alamat</th>
                        <th>Poli</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}
<div
    class="modal fade modal-dokter"
    id="modalTambahDokter"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-plus"></i>

                    <h5 class="modal-title">
                        Tambah Dokter
                    </h5>
                </div>
            </div>

            <form id="formTambahDokter">
                @csrf

                <div class="modal-body">

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Nama Dokter
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="tambah_nama"
                            class="form-control-dokter"
                            placeholder="Masukkan nama dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Jenis Kelamin
                        </label>

                        <select
                            name="jenis_kelamin"
                            id="tambah_jenis_kelamin"
                            class="form-select-dokter"
                            required
                        >
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

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="tanggal_lahir"
                            id="tambah_tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Spesialis
                        </label>

                        <input
                            type="text"
                            name="spesialis"
                            id="tambah_spesialis"
                            class="form-control-dokter"
                            placeholder="Masukkan spesialis"
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            id="tambah_alamat"
                            class="form-control-dokter"
                            placeholder="Masukkan alamat dokter"
                        ></textarea>
                    </div>

                    <div class="form-group-dokter mb-0">
                        <label class="form-label-dokter">
                            Poli
                        </label>

                        <select
                            name="poli_id"
                            id="tambah_poli_id"
                            class="form-select-dokter"
                        >
                            <option value="">
                                -- Pilih Poli --
                            </option>

                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save"
                        id="btnSimpanTambah"
                    >
                        <i class="fas fa-floppy-disk me-1"></i>
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
    class="modal fade modal-dokter"
    id="modalLihatDokter"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-doctor"></i>

                    <h5 class="modal-title">
                        Detail Dokter
                    </h5>
                </div>
            </div>

            <div class="modal-body detail-body-dokter">

                <div class="detail-full-dokter">
                    <div class="detail-label-dokter">
                        Nama Dokter
                    </div>

                    <div
                        class="detail-value-dokter detail-name"
                        id="lihat_nama"
                    >
                        -
                    </div>
                </div>

                <div class="row detail-row-dokter">

                    <div class="col-6">
                        <div class="detail-label-dokter">
                            Jenis Kelamin
                        </div>

                        <div
                            class="detail-value-dokter"
                            id="lihat_jenis_kelamin"
                        >
                            -
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label-dokter">
                            Tanggal Lahir
                        </div>

                        <div
                            class="detail-value-dokter"
                            id="lihat_tanggal_lahir"
                        >
                            -
                        </div>
                    </div>

                </div>

                <div class="row detail-row-dokter">

                    <div class="col-6">
                        <div class="detail-label-dokter">
                            Spesialis
                        </div>

                        <div
                            class="detail-value-dokter"
                            id="lihat_spesialis"
                        >
                            -
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="detail-label-dokter">
                            Poli
                        </div>

                        <div
                            class="detail-value-dokter"
                            id="lihat_poli"
                        >
                            -
                        </div>
                    </div>

                </div>

                <div class="detail-full-dokter alamat-detail-dokter">
                    <div class="detail-label-dokter">
                        Alamat
                    </div>

                    <div
                        class="detail-value-dokter"
                        id="lihat_alamat"
                    >
                        -
                    </div>
                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-blue-primary"
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
    class="modal fade modal-dokter"
    id="modalEditDokter"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-pen"></i>

                    <h5 class="modal-title">
                        Edit Dokter
                    </h5>
                </div>
            </div>

            <form id="formEditDokter">
                @csrf

                <input
                    type="hidden"
                    id="edit_id"
                >

                <div class="modal-body">

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Nama Dokter
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="edit_nama"
                            class="form-control-dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Jenis Kelamin
                        </label>

                        <select
                            name="jenis_kelamin"
                            id="edit_jenis_kelamin"
                            class="form-select-dokter"
                            required
                        >
                            <option value="laki-laki">
                                Laki-laki
                            </option>

                            <option value="perempuan">
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="tanggal_lahir"
                            id="edit_tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Spesialis
                        </label>

                        <input
                            type="text"
                            id="edit_spesialis"
                            class="form-control-dokter"
                            disabled
                        >

                        <div class="form-note">
                            Spesialis tidak dapat diubah pada form edit.
                        </div>
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            id="edit_alamat"
                            class="form-control-dokter"
                        ></textarea>
                    </div>

                    <div class="form-group-dokter mb-0">
                        <label class="form-label-dokter">
                            Poli
                        </label>

                        <select
                            name="poli_id"
                            id="edit_poli_id"
                            class="form-select-dokter"
                        >
                            <option value="">
                                -- Pilih Poli --
                            </option>

                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save"
                        id="btnSimpanEdit"
                    >
                        <i class="fas fa-floppy-disk me-1"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- =========================================================
     SCRIPT
========================================================= --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    /* =========================================================
       DATATABLE
    ========================================================= */
    const table = $('#dokter-table').DataTable({

        processing: false,
        serverSide: true,

        ajax: "{{ route('master-dokter.data') }}",

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'jenis_kelamin',
                name: 'jenis_kelamin'
            },
            {
                data: 'tanggal_lahir',
                name: 'tanggal_lahir'
            },
            {
                data: 'spesialis',
                name: 'spesialis'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
    data: 'poli',
    name: 'poli',
    orderable: false,
    searchable: false
},
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false
            }
        ],

        order: [[1, 'asc']],

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Data dokter tidak ditemukan",
            emptyTable: "Belum ada data dokter",

            paginate: {
                first: "Pertama",
                previous: "Sebelumnya",
                next: "Berikutnya",
                last: "Terakhir"
            }
        },

        columnDefs: [
            {
                targets: [0, 7],
                className: 'text-center'
            }
        ]
    });


    /* =========================================================
       TAMBAH DOKTER
    ========================================================= */
    $('#formTambahDokter').on('submit', function (e) {

        e.preventDefault();

        const form = this;
        const button = $('#btnSimpanTambah');

        button.prop('disabled', true);

        button.html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'
        );

        $.ajax({
            url: "{{ route('master-dokter.store') }}",
            type: "POST",
            data: $(form).serialize(),

            success: function (response) {

                const modalElement =
                    document.getElementById('modalTambahDokter');

                const modal =
                    bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide();
                }

                form.reset();

                table.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message ||
                        'Data dokter berhasil ditambahkan.',
                    timer: 1700,
                    showConfirmButton: false
                });
            },

            error: function (xhr) {
                tampilkanError(xhr);
            },

            complete: function () {

                button.prop('disabled', false);

                button.html(
                    '<i class="fas fa-floppy-disk me-1"></i> Simpan Data'
                );
            }
        });

    });


    /* =========================================================
       LIHAT DOKTER
    ========================================================= */
    $('#dokter-table').on('click', '.btn-view', function () {

        const row = table.row(
            $(this).closest('tr')
        ).data();

        if (!row) {
            return;
        }

        $('#lihat_nama').text(
            row.nama || '-'
        );

        let jenisKelamin =
            row.jenis_kelamin_raw;

        if (
            jenisKelamin === 'laki-laki' ||
            jenisKelamin === 'laki_laki'
        ) {
            jenisKelamin = 'Laki-laki';
        }
        else if (
            jenisKelamin === 'perempuan'
        ) {
            jenisKelamin = 'Perempuan';
        }
        else {
            jenisKelamin = '-';
        }

        $('#lihat_jenis_kelamin').text(
            jenisKelamin
        );

        $('#lihat_tanggal_lahir').text(
            row.tanggal_lahir || '-'
        );

        $('#lihat_spesialis').text(
            row.spesialis_raw || '-'
        );

        $('#lihat_poli').text(
            row.poli || '-'
        );

        $('#lihat_alamat').text(
            row.alamat_raw || '-'
        );

        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalLihatDokter'
                )
            );

        modal.show();

    });


    /* =========================================================
       BUKA EDIT
    ========================================================= */
    $('#dokter-table').on('click', '.btn-edit', function () {

        const row = table.row(
            $(this).closest('tr')
        ).data();

        if (!row) {
            return;
        }

        $('#edit_id').val(
            row.id
        );

        $('#edit_nama').val(
            row.nama || ''
        );

        let jenisKelamin =
            row.jenis_kelamin_raw || '';

        if (jenisKelamin === 'laki_laki') {
            jenisKelamin = 'laki-laki';
        }

        $('#edit_jenis_kelamin').val(
            jenisKelamin
        );

        $('#edit_tanggal_lahir').val(
            row.tanggal_lahir_raw || ''
        );

        $('#edit_spesialis').val(
            row.spesialis_raw || ''
        );

        $('#edit_alamat').val(
            row.alamat_raw || ''
        );

        $('#edit_poli_id').val(
            row.poli_id_raw || ''
        );

        const modal =
            new bootstrap.Modal(
                document.getElementById(
                    'modalEditDokter'
                )
            );

        modal.show();

    });


    /* =========================================================
       SIMPAN EDIT
    ========================================================= */
    $('#formEditDokter').on('submit', function (e) {

        e.preventDefault();

        const id =
            $('#edit_id').val();

        const button =
            $('#btnSimpanEdit');

        button.prop(
            'disabled',
            true
        );

        button.html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'
        );

        let formData =
            $(this).serialize();

        formData += '&_method=PUT';

        $.ajax({
            url: "{{ url('master-dokter') }}/" + id,
            type: "POST",
            data: formData,

            success: function (response) {

                const modalElement =
                    document.getElementById(
                        'modalEditDokter'
                    );

                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );

                if (modal) {
                    modal.hide();
                }

                table.ajax.reload(
                    null,
                    false
                );

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        response.message ||
                        'Data dokter berhasil diperbarui.',
                    timer: 1700,
                    showConfirmButton: false
                });

            },

            error: function (xhr) {
                tampilkanError(xhr);
            },

            complete: function () {

                button.prop(
                    'disabled',
                    false
                );

                button.html(
                    '<i class="fas fa-floppy-disk me-1"></i> Simpan Perubahan'
                );
            }
        });

    });


    /* =========================================================
       HAPUS DOKTER
    ========================================================= */
    $('#dokter-table').on(
        'submit',
        '.form-delete-dokter',
        function (e) {

            e.preventDefault();

            const form = this;

            Swal.fire({
                title: 'Hapus dokter?',
                text: 'Data dokter akan dihapus.',
                icon: 'warning',

                showCancelButton: true,

                confirmButtonText:
                    'Ya, hapus',

                cancelButtonText:
                    'Batal',

                reverseButtons: true

            }).then(function (result) {

                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({
                    url: form.action,
                    type: 'POST',

                    data: {
                        _token:
                            $(form)
                                .find(
                                    'input[name="_token"]'
                                )
                                .val(),

                        _method:
                            'DELETE'
                    },

                    success: function (response) {

                        table.ajax.reload(
                            null,
                            false
                        );

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text:
                                response.message ||
                                'Data dokter berhasil dihapus.',
                            timer: 1700,
                            showConfirmButton: false
                        });

                    },

                    error: function (xhr) {
                        tampilkanError(xhr);
                    }
                });

            });

        }
    );


    /* =========================================================
       ERROR
    ========================================================= */
    function tampilkanError(xhr) {

        let pesan =
            'Terjadi kesalahan. Silakan coba lagi.';

        if (
            xhr.responseJSON &&
            xhr.responseJSON.errors
        ) {

            pesan =
                Object.values(
                    xhr.responseJSON.errors
                )
                .flat()
                .join('<br>');

        }
        else if (
            xhr.responseJSON &&
            xhr.responseJSON.message
        ) {

            pesan =
                xhr.responseJSON.message;

        }

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: pesan
        });
    }

});
</script>

@endsection
