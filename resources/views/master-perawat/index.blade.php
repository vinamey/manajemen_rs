@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Perawat')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light-bg: #e7f3ff;
        --blue-soft: #f0f7ff;
    }

    .master-perawat {
        padding: 12px 0;
    }

    /* HEADER */
    .page-header-perawat {
        margin-bottom: 22px;
    }

    .header-icon-box-perawat {
        width: 42px;
        height: 42px;
        background: var(--blue-light-bg);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue-main);
        font-size: 18px;
        flex-shrink: 0;
    }

    .page-title-perawat {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.2;
    }

    .page-subtitle-perawat {
        font-size: 12px;
        color: #64748b;
        margin: 3px 0 0;
    }

    /* BUTTON TAMBAH */
    .btn-blue-primary-perawat {
        background: var(--blue-main) !important;
        border: none !important;
        color: white !important;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-blue-primary-perawat:hover {
        background: var(--blue-dark) !important;
        transform: translateY(-1px);
    }

    /* ALERT */
    .alert-perawat {
        border: none;
        border-left: 3px solid var(--blue-main);
        border-radius: 10px;
        background: white;
        box-shadow: 0 3px 12px rgba(0,0,0,.05);
        padding: 12px 15px;
        margin-bottom: 18px;
    }

    /* CARD */
    .card-table-perawat {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,.05) !important;
        background: white;
        padding: 18px;
    }

    /* DATATABLE */
    #perawat-table {
        width: 100% !important;
        margin-bottom: 0 !important;
    }

    #perawat-table thead th {
        background: var(--blue-main) !important;
        color: white !important;
        border: none !important;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 16px;
        white-space: nowrap;
    }

    #perawat-table tbody td {
        padding: 12px 16px;
        font-size: 13px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    #perawat-table tbody tr:hover {
        background: var(--blue-soft) !important;
    }

    /* BADGE GENDER */
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

    /* ACTION */
    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
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
        color: white;
    }

    .btn-edit:hover {
        background: var(--blue-dark);
        color: white;
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
    }

    /* DATATABLE CONTROLS */
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 16px;
        font-size: 12px;
        color: #64748b;
    }

    .dataTables_wrapper .dataTables_length select {
        border: 1px solid #d7e0ea;
        border-radius: 7px;
        padding: 5px 28px 5px 8px;
        font-size: 12px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d7e0ea;
        border-radius: 7px;
        padding: 7px 10px;
        margin-left: 6px;
        font-size: 12px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.10);
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 16px !important;
        font-size: 12px;
        color: #64748b;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 12px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border: none !important;
        border-radius: 6px !important;
        font-size: 12px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--blue-main) !important;
        color: white !important;
        border: none !important;
    }

    /* MODAL */
    .modal-perawat .modal-dialog {
        max-width: 470px;
    }

    .modal-perawat .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15,23,42,.18);
    }

    .modal-perawat .modal-header {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 15px 18px;
    }

    .modal-perawat .modal-title {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .modal-perawat .modal-body {
        padding: 20px 18px;
        background: white;
    }

    .modal-perawat .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 12px 18px;
    }

    /* FORM */
    .form-group-perawat {
        margin-bottom: 14px;
    }

    .form-label-perawat {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
    }

    .form-control-perawat,
    .form-select-perawat {
        width: 100%;
        border: 1px solid #d7e0ea;
        border-radius: 8px;
        padding: 9px 11px;
        font-size: 12px;
        color: #334155;
        background: white;
        transition: .2s;
    }

    .form-control-perawat:focus,
    .form-select-perawat:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.12);
        outline: none;
    }

    textarea.form-control-perawat {
        min-height: 80px;
        resize: vertical;
    }

    .btn-modal-cancel-perawat {
        background: #f1f5f9 !important;
        color: #64748b !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save-perawat {
        background: var(--blue-main) !important;
        color: white !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save-perawat:hover {
        background: var(--blue-dark) !important;
    }

    /* DETAIL */
    .detail-perawat-table {
        width: 100%;
    }

    .detail-perawat-table td {
        padding: 10px 5px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 12px;
        vertical-align: top;
    }

    .detail-perawat-table tr:last-child td {
        border-bottom: none;
    }

    .detail-perawat-label {
        width: 130px;
        color: #64748b;
        font-weight: 600;
    }

    .detail-perawat-value {
        color: #1e293b;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .page-header-perawat {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 15px;
        }

        .btn-blue-primary-perawat {
            width: 100%;
        }

        .modal-perawat .modal-dialog {
            max-width: calc(100% - 25px);
            margin: 12px auto;
        }
    }
</style>

<div class="container-fluid master-perawat">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center page-header-perawat">
        <div class="d-flex align-items-center gap-3">
            <div class="header-icon-box-perawat">
                <i class="fas fa-user-nurse"></i>
            </div>

            <div>
                <h3 class="page-title-perawat">Master Perawat</h3>
                <p class="page-subtitle-perawat">
                    Data perawat yang terdaftar
                </p>
            </div>
        </div>

        <button
            type="button"
            class="btn btn-blue-primary-perawat"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPerawat"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Perawat
        </button>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-perawat">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-perawat">
            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABLE --}}
    <div class="card card-table-perawat">
        <div class="table-responsive">
            <table
                id="perawat-table"
                class="table align-middle"
            >
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Perawat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
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
    class="modal fade modal-perawat"
    id="modalTambahPerawat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    <h5 class="modal-title">Tambah Perawat</h5>
                </div>
            </div>

            <form
                action="{{ route('master-perawat.store') }}"
                method="POST"
            >
                @csrf

                <div class="modal-body">

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">
                            Nama Perawat
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control-perawat"
                            placeholder="Masukkan nama perawat"
                            value="{{ old('nama') }}"
                            required
                        >
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">
                            Jenis Kelamin
                        </label>

                        <select
                            name="jenis_kelamin"
                            class="form-select-perawat"
                            required
                        >
                            <option value="">
                                -- Pilih Jenis Kelamin --
                            </option>

                            <option
                                value="laki-laki"
                                {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}
                            >
                                Laki-laki
                            </option>

                            <option
                                value="perempuan"
                                {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}
                            >
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="tanggal_lahir"
                            class="form-control-perawat"
                            value="{{ old('tanggal_lahir') }}"
                            required
                        >
                    </div>

                    <div class="form-group-perawat mb-0">
                        <label class="form-label-perawat">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control-perawat"
                            placeholder="Masukkan alamat lengkap"
                            required
                        >{{ old('alamat') }}</textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-modal-cancel-perawat"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save-perawat"
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
    class="modal fade modal-perawat"
    id="modalLihatPerawat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-nurse"></i>
                    <h5 class="modal-title">
                        Detail Perawat
                    </h5>
                </div>
            </div>

            <div class="modal-body">
                <table class="detail-perawat-table">
                    <tr>
                        <td class="detail-perawat-label">
                            Nama Perawat
                        </td>
                        <td
                            class="detail-perawat-value"
                            id="lihat_nama"
                        >
                            -
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-perawat-label">
                            Jenis Kelamin
                        </td>
                        <td
                            class="detail-perawat-value"
                            id="lihat_jenis_kelamin"
                        >
                            -
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-perawat-label">
                            Tanggal Lahir
                        </td>
                        <td
                            class="detail-perawat-value"
                            id="lihat_tanggal_lahir"
                        >
                            -
                        </td>
                    </tr>

                    <tr>
                        <td class="detail-perawat-label">
                            Alamat
                        </td>
                        <td
                            class="detail-perawat-value"
                            id="lihat_alamat"
                        >
                            -
                        </td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-modal-cancel-perawat"
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
    class="modal fade modal-perawat"
    id="modalEditPerawat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-edit"></i>
                    <h5 class="modal-title">
                        Edit Perawat
                    </h5>
                </div>
            </div>

            <form
                id="formEditPerawat"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">
                            Nama Perawat
                        </label>

                        <input
                            type="text"
                            id="edit_nama"
                            name="nama"
                            class="form-control-perawat"
                            required
                        >
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">
                            Jenis Kelamin
                        </label>

                        <select
                            id="edit_jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select-perawat"
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

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="edit_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-perawat"
                            required
                        >
                    </div>

                    <div class="form-group-perawat mb-0">
                        <label class="form-label-perawat">
                            Alamat
                        </label>

                        <textarea
                            id="edit_alamat"
                            name="alamat"
                            class="form-control-perawat"
                            required
                        ></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-modal-cancel-perawat"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save-perawat"
                    >
                        <i class="fas fa-save me-1"></i>
                        Update Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


{{-- DATATABLE CSS --}}
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css"
>

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DATATABLE JS --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {

    /* =========================================================
       DATATABLE
    ========================================================= */
    const table = $('#perawat-table').DataTable({

        processing: false,
        serverSide: true,

        ajax: "{{ route('master-perawat.data') }}",

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
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ],

        order: [],

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        language: {
            processing: "Memuat data...",
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            infoFiltered: "(disaring dari _MAX_ total data)",
            zeroRecords: "Data perawat tidak ditemukan",
            emptyTable: "Belum ada data perawat",
            paginate: {
                first: "Pertama",
                last: "Terakhir",
                next: "Berikutnya",
                previous: "Sebelumnya"
            }
        }
    });


    /* =========================================================
       MODAL LIHAT
    ========================================================= */
    $('#perawat-table').on('click', '.btn-view', function () {

        const data = table.row(
            $(this).closest('tr')
        ).data();

        if (!data) {
            return;
        }

        $('#lihat_nama').text(
            data.nama ?? '-'
        );

        let gender = data.jenis_kelamin_raw;

        if (gender === 'laki-laki' || gender === 'laki_laki') {
            gender = 'Laki-laki';
        } else if (gender === 'perempuan') {
            gender = 'Perempuan';
        } else {
            gender = '-';
        }

        $('#lihat_jenis_kelamin').text(gender);

        $('#lihat_tanggal_lahir').text(
            formatTanggalIndonesia(
                data.tanggal_lahir_raw
            )
        );

        $('#lihat_alamat').text(
            data.alamat_raw || '-'
        );

        const modal = new bootstrap.Modal(
            document.getElementById('modalLihatPerawat')
        );

        modal.show();
    });


    /* =========================================================
       MODAL EDIT
    ========================================================= */
    $('#perawat-table').on('click', '.btn-edit', function () {

        const data = table.row(
            $(this).closest('tr')
        ).data();

        if (!data) {
            return;
        }

        $('#edit_nama').val(
            data.nama
        );

        $('#edit_jenis_kelamin').val(
            data.jenis_kelamin_raw
        );

        $('#edit_tanggal_lahir').val(
            data.tanggal_lahir_raw
        );

        $('#edit_alamat').val(
            data.alamat_raw
        );

        let updateUrl =
            "{{ route('master-perawat.update', ':id') }}";

        updateUrl = updateUrl.replace(
            ':id',
            data.id
        );

        $('#formEditPerawat').attr(
            'action',
            updateUrl
        );

        const modal = new bootstrap.Modal(
            document.getElementById('modalEditPerawat')
        );

        modal.show();
    });


    /* =========================================================
       FORMAT TANGGAL
    ========================================================= */
    function formatTanggalIndonesia(tanggal) {

        if (!tanggal) {
            return '-';
        }

        const bagian = tanggal.split('-');

        if (bagian.length !== 3) {
            return tanggal;
        }

        return bagian[2] + '-' +
               bagian[1] + '-' +
               bagian[0];
    }

});
</script>

@endsection
