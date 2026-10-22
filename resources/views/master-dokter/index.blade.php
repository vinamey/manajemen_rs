@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Dokter')

@section('content')

{{-- =========================================================
     LIBRARY & STYLES
========================================================= --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light-bg: #e7f3ff;
        --blue-soft: #f0f7ff;
    }

    /* GENERAL */
    .master-dokter {
        padding: 5px 0 30px;
    }

    /* HEADER */
    .page-header-dokter {
        margin-bottom: 22px;
    }

    .header-icon-box {
        width: 44px;
        height: 44px;
        background-color: var(--blue-light-bg);
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

    /* BUTTON PRIMARY */
    .btn-blue-primary {
        background: var(--blue-main) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-blue-primary:hover {
        background: var(--blue-dark) !important;
    }

    /* TABLE CARD & TABLE */
    .card-table-dokter {
        background: #fff;
        border: none !important;
        border-radius: 13px !important;
        overflow: hidden;
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
        color: #ffffff !important;
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

    /* BADGES & ACTION BUTTONS */
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

    /* DATATABLE OVERRIDES */
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

    /* MODAL */
    .modal-dokter .modal-dialog {
        width: calc(100% - 30px) !important;
        max-width: 450px !important;
        margin: 1.75rem auto !important;
    }

    .modal-dokter .modal-dialog.modal-dialog-centered {
        min-height: calc(100% - 3.5rem) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .modal-dokter .modal-content {
        width: 100% !important;
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18) !important;
    }

    .modal-dokter .modal-header {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 15px 18px !important;
    }

    .modal-dokter .modal-title {
        font-size: 15px !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }

    .modal-dokter .modal-body {
        padding: 20px 18px !important;
        background-color: #ffffff !important;
    }

    .modal-dokter .modal-footer {
        background-color: #f8fafc !important;
        border: none !important;
        padding: 12px 18px !important;
    }

    /* FORM STYLES */
    .form-group-dokter {
        width: 100% !important;
        margin-bottom: 13px !important;
    }

    .form-label-dokter {
        display: block !important;
        width: 100% !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #64748b !important;
        margin-bottom: 6px !important;
    }

    .form-control-dokter,
    .form-select-dokter {
        width: 100% !important;
        height: 38px !important;
        box-sizing: border-box !important;
        border: 1px solid #d7e0ea !important;
        border-radius: 8px !important;
        padding: 9px 11px !important;
        font-size: 12px !important;
        color: #334155 !important;
        background-color: #ffffff !important;
    }

    .form-control-dokter:focus,
    .form-select-dokter:focus {
        border-color: var(--blue-main) !important;
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12) !important;
        outline: none !important;
    }

    textarea.form-control-dokter {
        height: auto !important;
        min-height: 75px !important;
        resize: vertical !important;
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

    /* DETAIL MODAL */
    .detail-body-dokter {
        padding: 0 18px 20px !important;
    }

    .detail-full-dokter {
        padding: 14px 0;
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

    /* SELECT2 OVERRIDES */
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 38px !important;
        border: 1px solid #d7e0ea !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        padding: 0 11px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #334155 !important;
        font-size: 12px !important;
        padding-left: 0 !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
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

{{-- =========================================================
     CONTENT
========================================================= --}}
<div class="container-fluid master-dokter">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center page-header-dokter">
        <div class="d-flex align-items-center gap-3">
            <div class="header-icon-box">
                <i class="fas fa-user-doctor"></i>
            </div>
            <div>
                <h3 class="page-title-dokter">Master Dokter</h3>
                <p class="page-subtitle-dokter">Data dokter yang terdaftar</p>
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
            <table id="dokter-table" class="table align-middle">
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
    aria-labelledby="modalTambahDokterLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    <h5 class="modal-title" id="modalTambahDokterLabel">
                        Tambah Dokter
                    </h5>
                </div>
            </div>

            <form id="formTambahDokter">
                @csrf

                <div class="modal-body">

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Nama Dokter</label>
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
                        <label class="form-label-dokter">Jenis Kelamin</label>
                        <select
                            name="jenis_kelamin"
                            id="tambah_jenis_kelamin"
                            class="form-select-dokter"
                            required
                        >
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Tanggal Lahir</label>
                        <input
                            type="date"
                            name="tanggal_lahir"
                            id="tambah_tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Spesialis</label>
                        <input
                            type="text"
                            name="spesialis"
                            id="tambah_spesialis"
                            class="form-control-dokter"
                            placeholder="Masukkan spesialis"
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Alamat</label>
                        <textarea
                            name="alamat"
                            id="tambah_alamat"
                            class="form-control-dokter"
                            rows="3"
                            placeholder="Masukkan alamat lengkap dokter..."
                        ></textarea>
                    </div>

                    <div class="form-group-dokter mb-0">
                        <label class="form-label-dokter">Poli</label>
                       <select name="poli_id" class="form-select" style="font-size: 12px !important;">
    <option value="">-- Pilih Poli --</option>

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
                    <h5 class="modal-title">Detail Dokter</h5>
                </div>
            </div>

            <div class="modal-body detail-body-dokter">
                <div class="detail-full-dokter">
                    <div class="detail-label-dokter">Nama Dokter</div>
                    <div class="detail-value-dokter detail-name" id="lihat_nama">-</div>
                </div>

                <div class="row detail-row-dokter">
                    <div class="col-6">
                        <div class="detail-label-dokter">Jenis Kelamin</div>
                        <div class="detail-value-dokter" id="lihat_jenis_kelamin">-</div>
                    </div>
                    <div class="col-6">
                        <div class="detail-label-dokter">Tanggal Lahir</div>
                        <div class="detail-value-dokter" id="lihat_tanggal_lahir">-</div>
                    </div>
                </div>

                <div class="row detail-row-dokter">
                    <div class="col-6">
                        <div class="detail-label-dokter">Spesialis</div>
                        <div class="detail-value-dokter" id="lihat_spesialis">-</div>
                    </div>
                    <div class="col-6">
                        <div class="detail-label-dokter">Poli</div>
                        <div class="detail-value-dokter" id="lihat_poli">-</div>
                    </div>
                </div>

                <div class="detail-full-dokter border-bottom-0">
                    <div class="detail-label-dokter">Alamat</div>
                    <div class="detail-value-dokter" id="lihat_alamat">-</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">
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
    aria-labelledby="modalEditDokterLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-pen"></i>
                    <h5 class="modal-title" id="modalEditDokterLabel">
                        Edit Data Dokter
                    </h5>
                </div>
            </div>

            <form id="formEditDokter">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-body">

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Nama Dokter</label>
                        <input
                            type="text"
                            name="nama"
                            id="edit_nama"
                            class="form-control-dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Jenis Kelamin</label>
                        <select
                            name="jenis_kelamin"
                            id="edit_jenis_kelamin"
                            class="form-select-dokter"
                            required
                        >
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Tanggal Lahir</label>
                        <input
                            type="date"
                            name="tanggal_lahir"
                            id="edit_tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Spesialis</label>
                        <input
                            type="text"
                            name="spesialis"
                            id="edit_spesialis"
                            class="form-control-dokter"
                        >
                    </div>

                    <div class="form-group-dokter">
                        <label class="form-label-dokter">Alamat</label>
                        <textarea
                            name="alamat"
                            id="edit_alamat"
                            class="form-control-dokter"
                            rows="3"
                        ></textarea>
                    </div>

                    <div class="form-group-dokter mb-0">
                        <label class="form-label-dokter">Poli</label>
                        <select
                            name="poli_id"
                            id="edit_poli_id"
                            class="select2-poli-edit form-select-dokter"
                            required
                        >
                            <option value="">-- Pilih Poli --</option>
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
                        Perbarui Data
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

let table;

$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | SELECT2
    |--------------------------------------------------------------------------
    */

    $('.select2-poli').select2({
        dropdownParent: $('#modalTambahDokter'),
        width: '100%'
    });

    $('.select2-poli-edit').select2({
        dropdownParent: $('#modalEditDokter'),
        width: '100%'
    });


    /*
    |--------------------------------------------------------------------------
    | DATATABLES
    |--------------------------------------------------------------------------
    */

    table = $('#dokter-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('master-dokter.data') }}",

        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center'
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
                name: 'spesialis',
                defaultContent: '-'
            },

            {
                data: 'alamat',
                name: 'alamat',
                defaultContent: '-'
            },

            {
                data: 'poli_nama',
                name: 'poli_nama',
                defaultContent: '-'
            },

            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }

        ],

        language: {

            search: "",

            searchPlaceholder: "Cari dokter...",

            lengthMenu: "Tampilkan _MENU_ data",

            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            emptyTable: "Belum ada data dokter",

            zeroRecords: "Data dokter tidak ditemukan",

            processing: "Memuat data...",

            paginate: {

                first: "Awal",

                last: "Akhir",

                next: "Lanjut",

                previous: "Kembali"

            }

        }

    });


    /*
    |--------------------------------------------------------------------------
    | TAMBAH DATA
    |--------------------------------------------------------------------------
    */

    $('#formTambahDokter').on('submit', function (e) {

        e.preventDefault();

        let form = $(this);

        let btn = $('#btnSimpanTambah');

        btn.prop('disabled', true);

        btn.html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'
        );

        $.ajax({

            url: "{{ route('master-dokter.store') }}",

            type: "POST",

            data: form.serialize(),

            dataType: "json",

            headers: {

                'Accept': 'application/json'

            },

            success: function (response) {

                btn.prop('disabled', false);

                btn.html(
                    '<i class="fas fa-floppy-disk me-1"></i> Simpan Data'
                );

                if (response.success === true) {

                    $('#modalTambahDokter').modal('hide');

                    form[0].reset();

                    $('#tambah_poli_id')
                        .val('')
                        .trigger('change');

                    table.ajax.reload(null, false);

                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil!',

                        text: response.message,

                        timer: 1800,

                        showConfirmButton: false

                    });

                }

            },

            error: function (xhr) {

                btn.prop('disabled', false);

                btn.html(
                    '<i class="fas fa-floppy-disk me-1"></i> Simpan Data'
                );

                alertError(xhr);

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | LIHAT DATA
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.btn-view', function () {

        let rowData = table
            .row($(this).closest('tr'))
            .data();

        if (!rowData) {
            return;
        }

        $('#lihat_nama')
            .text(rowData.nama || '-');

        $('#lihat_jenis_kelamin')
            .text(
                rowData.jenis_kelamin_raw === 'laki-laki'
                    ? 'Laki-laki'
                    : 'Perempuan'
            );

        $('#lihat_tanggal_lahir')
            .text(rowData.tanggal_lahir || '-');

        $('#lihat_spesialis')
            .text(rowData.spesialis_raw || '-');

        $('#lihat_poli')
            .text(rowData.poli_nama || '-');

        $('#lihat_alamat')
            .text(rowData.alamat_raw || '-');

        $('#modalLihatDokter').modal('show');

    });


    /*
    |--------------------------------------------------------------------------
    | EDIT DATA
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.btn-edit', function () {

        let rowData = table
            .row($(this).closest('tr'))
            .data();

        if (!rowData) {
            return;
        }

        $('#edit_id')
            .val(rowData.id);

        $('#edit_nama')
            .val(rowData.nama);

        $('#edit_jenis_kelamin')
            .val(rowData.jenis_kelamin_raw);

        $('#edit_tanggal_lahir')
            .val(rowData.tanggal_lahir_raw);

        $('#edit_spesialis')
            .val(rowData.spesialis_raw);

        $('#edit_alamat')
            .val(rowData.alamat_raw);

        $('#edit_poli_id')
            .val(rowData.poli_id_raw)
            .trigger('change');

        $('#modalEditDokter').modal('show');

    });


    /*
    |--------------------------------------------------------------------------
    | UPDATE DATA
    |--------------------------------------------------------------------------
    */

    $('#formEditDokter').on('submit', function (e) {

        e.preventDefault();

        let form = $(this);

        let id = $('#edit_id').val();

        let btn = $('#btnSimpanEdit');

        let url = "{{ url('master-dokter') }}/" + id;

        btn.prop('disabled', true);

        btn.html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Memperbarui...'
        );

        $.ajax({

            url: url,

            type: "POST",

            data: form.serialize(),

            dataType: "json",

            headers: {

                'Accept': 'application/json'

            },

            success: function (response) {

                btn.prop('disabled', false);

                btn.html(
                    '<i class="fas fa-floppy-disk me-1"></i> Perbarui Data'
                );

                if (response.success === true) {

                    $('#modalEditDokter').modal('hide');

                    table.ajax.reload(null, false);

                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil!',

                        text: response.message,

                        timer: 1800,

                        showConfirmButton: false

                    });

                }

            },

            error: function (xhr) {

                btn.prop('disabled', false);

                btn.html(
                    '<i class="fas fa-floppy-disk me-1"></i> Perbarui Data'
                );

                alertError(xhr);

            }

        });

    });


    /*
    |--------------------------------------------------------------------------
    | HAPUS DATA
    |--------------------------------------------------------------------------
    */

    $(document).on('click', '.btn-delete', function () {

        let id = $(this).data('id');

        if (!id) {

            Swal.fire(
                'Gagal!',
                'ID dokter tidak ditemukan.',
                'error'
            );

            return;
        }

        let url = "{{ url('master-dokter') }}/" + id;

        Swal.fire({

            title: 'Apakah Anda Yakin?',

            text: 'Data dokter ini akan dihapus!',

            icon: 'warning',

            showCancelButton: true,

            confirmButtonColor: '#dc2626',

            cancelButtonColor: '#64748b',

            confirmButtonText: 'Ya, Hapus!',

            cancelButtonText: 'Batal'

        }).then(function (result) {

            if (!result.isConfirmed) {
                return;
            }

            $.ajax({

                url: url,

                type: 'DELETE',

                data: {

                    _token: '{{ csrf_token() }}'

                },

                dataType: 'json',

                headers: {

                    'Accept': 'application/json'

                },

                success: function (response) {

                    if (response.success === true) {

                        table.ajax.reload(null, false);

                        Swal.fire({

                            icon: 'success',

                            title: 'Terhapus!',

                            text: response.message,

                            timer: 1800,

                            showConfirmButton: false

                        });

                    }

                },

                error: function (xhr) {

                    alertError(xhr);

                }

            });

        });

    });


    /*
    |--------------------------------------------------------------------------
    | ERROR HANDLER
    |--------------------------------------------------------------------------
    */

    function alertError(xhr) {

        let msg = 'Terjadi kesalahan pada server.';

        if (xhr.responseJSON) {

            if (xhr.responseJSON.errors) {

                msg = Object.values(
                    xhr.responseJSON.errors
                )
                .flat()
                .join('<br>');

            } else if (xhr.responseJSON.message) {

                msg = xhr.responseJSON.message;

            }

        }

        Swal.fire({

            icon: 'error',

            title: 'Gagal!',

            html: msg

        });

    }

});

</script>

@endpush
