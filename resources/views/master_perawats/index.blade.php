@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Perawat')

@section('content')

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
    .master-perawat {
        padding: 12px 0 30px;
    }

    /* =========================================================
       HEADER
    ========================================================= */
    .page-header-perawat {
        margin-bottom: 22px;
    }

    .header-icon-box {
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

    /* =========================================================
       BUTTON PRIMARY
    ========================================================= */
    .btn-blue-primary {
        background-color: var(--blue-main) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-blue-primary:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* =========================================================
       ALERT
    ========================================================= */
    .alert-perawat {
        border: none;
        border-left: 3px solid var(--blue-main);
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        padding: 12px 15px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .card-table-perawat {
        border: none !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .table-perawat {
        margin-bottom: 0;
    }

    .table-perawat thead th {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table-perawat tbody td {
        padding: 12px 16px;
        font-size: 13px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-perawat tbody tr {
        transition: all 0.15s ease;
    }

    .table-perawat tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }

    /* =========================================================
       PERAWAT NAME
    ========================================================= */
    .nurse-name {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .nurse-id {
        color: #94a3b8;
        font-size: 10px;
    }

    .avatar-perawat {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background-color: var(--blue-light-bg);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* =========================================================
       BADGES
    ========================================================= */
    .badge-blue-soft {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    /* =========================================================
       ACTION BUTTON
    ========================================================= */
    .btn-action-view {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 10px;
    }

    .btn-action-view:hover {
        background-color: #bae6fd !important;
        color: #0369a1 !important;
    }

    .btn-action-edit {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 10px;
    }

    .btn-action-edit:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
    }

    .btn-action-delete {
        background-color: #ef4444 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 10px;
    }

    .btn-action-delete:hover {
        background-color: #dc2626 !important;
    }

    /* =========================================================
       MODAL UMUM
    ========================================================= */
    .modal-perawat .modal-dialog {
        max-width: 460px;
    }

    .modal-perawat .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }

    .modal-perawat .modal-header {
        background-color: var(--blue-main);
        color: #ffffff;
        border: none;
        padding: 15px 18px;
    }

    .modal-perawat .modal-title {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    /*
       PENTING:
       Jika layout/bootstrap menyisipkan tombol X,
       tombol tersebut tetap akan disembunyikan.
    */
    .modal-perawat .btn-close {
        display: none !important;
    }

    .modal-perawat .modal-body {
        padding: 20px 18px;
        background-color: #ffffff;
    }

    .modal-perawat .modal-footer {
        background-color: #f8fafc;
        border: none;
        padding: 12px 18px;
    }

    /* =========================================================
       FORM
    ========================================================= */
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
        background-color: #ffffff;
        transition: all 0.2s ease;
    }

    .form-control-perawat:focus,
    .form-select-perawat:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12);
        outline: none;
    }

    textarea.form-control-perawat {
        min-height: 78px;
        resize: vertical;
    }

    .form-group-perawat {
        margin-bottom: 13px;
    }

    .btn-modal-cancel {
        background-color: #f1f5f9 !important;
        color: #64748b !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-cancel:hover {
        background-color: #e2e8f0 !important;
    }

    .btn-modal-save {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save:hover {
        background-color: var(--blue-dark) !important;
    }

    /* =========================================================
       DETAIL PERAWAT
    ========================================================= */
    .detail-modal-perawat {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }

    .detail-header-perawat {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 13px 16px !important;
        min-height: 42px;
    }

    .detail-header-perawat .modal-title {
        font-size: 13px !important;
        font-weight: 700;
        margin: 0;
    }

    .detail-header-perawat i {
        font-size: 13px;
    }

    .detail-body-perawat {
        padding: 0 14px !important;
        background-color: #ffffff;
    }

    .detail-full-perawat {
        padding: 13px 5px;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row-perawat {
        margin: 0 !important;
        padding: 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row-perawat > div {
        padding: 13px 5px;
    }

    .detail-row-perawat > div:first-child {
        border-right: 1px solid #e5e7eb;
    }

    .detail-label-perawat {
        font-size: 10px;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .detail-value-perawat {
        font-size: 12px;
        color: #475569;
        line-height: 1.4;
    }

    .detail-full-perawat .fw-bold {
        color: #334155;
        font-weight: 700 !important;
    }

    .alamat-detail-perawat {
        border-bottom: none;
        padding-bottom: 14px;
    }

    .detail-footer-perawat {
        background-color: #ffffff !important;
        border: none !important;
        padding: 8px 10px 16px !important;
        justify-content: flex-end;
    }

    .detail-footer-perawat .btn {
        min-width: 72px;
        padding: 8px 16px !important;
        font-size: 12px !important;
        border-radius: 7px !important;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */
    .empty-perawat {
        padding: 45px 20px !important;
        color: #94a3b8 !important;
        font-size: 13px;
    }
</style>


<div class="container-fluid master-perawat">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center page-header-perawat">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box">
                <i class="fas fa-user-nurse"></i>
            </div>

            <div>
                <h3 class="page-title-perawat">
                    Master Perawat
                </h3>

                <p class="page-subtitle-perawat">
                    Data perawat yang terdaftar
                </p>
            </div>

        </div>

        <button
            type="button"
            class="btn btn-blue-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPerawat"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Perawat
        </button>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-perawat">
            <i class="fas fa-check-circle me-2 text-success"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- TABLE --}}
    <div class="card card-table-perawat">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-perawat align-middle">

                    <thead>
                        <tr>

                            <th width="50" class="text-center">
                                No
                            </th>

                            <th>
                                Nama Perawat
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

                            <th width="220" class="text-center">
                                Aksi
                            </th>

                        </tr>
                    </thead>


                    <tbody id="tabelPerawat">

                        @forelse($perawats as $perawat)

                            <tr id="perawat-{{ $perawat->id }}">

                                {{-- NO --}}
                                <td class="text-center nomor text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="avatar-perawat">
                                            <i class="fas fa-user-nurse"></i>
                                        </div>

                                        <div>

                                            <div class="nurse-name data-nama">
                                                {{ $perawat->nama }}
                                            </div>

                                            <div class="nurse-id">
                                                ID: {{ $perawat->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS KELAMIN --}}
                                <td>

                                    <span class="badge badge-blue-soft data-jenis-kelamin">

                                        @if($perawat->jenis_kelamin === 'laki-laki')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                    </span>

                                </td>


                                {{-- TANGGAL LAHIR --}}
                                <td>

                                    <span class="data-tanggal-lahir">
                                        {{ $perawat->tanggal_lahir }}
                                    </span>

                                </td>


                                {{-- ALAMAT --}}
                                <td>

                                    <span class="data-alamat">
                                        {{ $perawat->alamat ?? '-' }}
                                    </span>

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- LIHAT --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view btn-view"
                                            data-id="{{ $perawat->id }}"
                                            data-nama="{{ $perawat->nama }}"
                                            data-jenis_kelamin="{{ $perawat->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $perawat->tanggal_lahir }}"
                                            data-alamat="{{ $perawat->alamat }}"
                                        >
                                            <i class="fas fa-eye me-1"></i>
                                            Lihat
                                        </button>


                                        {{-- EDIT --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit btn-edit"
                                            data-id="{{ $perawat->id }}"
                                            data-nama="{{ $perawat->nama }}"
                                            data-jenis_kelamin="{{ $perawat->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $perawat->tanggal_lahir }}"
                                            data-alamat="{{ $perawat->alamat }}"
                                        >
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </button>


                                        {{-- HAPUS --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete btn-hapus"
                                            data-id="{{ $perawat->id }}"
                                            data-nama="{{ $perawat->nama }}"
                                        >
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr id="barisKosong">

                                <td
                                    colspan="6"
                                    class="text-center empty-perawat"
                                >
                                    <i class="fas fa-user-nurse fa-2x mb-2 d-block"></i>
                                    Belum ada data perawat.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH PERAWAT
========================================================= --}}

<div
    class="modal fade modal-perawat"
    id="modalTambahPerawat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER TANPA X --}}
            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-plus"></i>

                    <h5 class="modal-title">
                        Tambah Perawat
                    </h5>

                </div>

            </div>


            {{-- FORM --}}
            <form id="formTambahPerawat">

                @csrf

                <div class="modal-body">

                    {{-- NAMA --}}
                    <div class="form-group-perawat">

                        <label
                            for="tambah_nama"
                            class="form-label-perawat"
                        >
                            Nama Perawat
                        </label>

                        <input
                            type="text"
                            id="tambah_nama"
                            name="nama"
                            class="form-control-perawat"
                            placeholder="Masukkan nama perawat"
                            required
                        >

                    </div>


                    {{-- JENIS KELAMIN --}}
                    <div class="form-group-perawat">

                        <label
                            for="tambah_jenis_kelamin"
                            class="form-label-perawat"
                        >
                            Jenis Kelamin
                        </label>

                        <select
                            id="tambah_jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select-perawat"
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


                    {{-- TANGGAL LAHIR --}}
                    <div class="form-group-perawat">

                        <label
                            for="tambah_tanggal_lahir"
                            class="form-label-perawat"
                        >
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="tambah_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-perawat"
                            required
                        >

                    </div>


                    {{-- ALAMAT --}}
                    <div class="form-group-perawat mb-0">

                        <label
                            for="tambah_alamat"
                            class="form-label-perawat"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="tambah_alamat"
                            name="alamat"
                            class="form-control-perawat"
                            rows="3"
                            placeholder="Ketikkan alamat lengkap..."
                        ></textarea>

                    </div>

                </div>


                {{-- FOOTER --}}
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
                        <i class="fas fa-save me-1"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL EDIT PERAWAT
========================================================= --}}

<div
    class="modal fade modal-perawat"
    id="modalEditPerawat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER TANPA X --}}
            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-edit"></i>

                    <h5 class="modal-title">
                        Edit Perawat
                    </h5>

                </div>

            </div>


            {{-- FORM --}}
            <form id="formEditPerawat">

                @csrf

                <input
                    type="hidden"
                    id="edit_id"
                >


                <div class="modal-body">

                    {{-- NAMA --}}
                    <div class="form-group-perawat">

                        <label
                            for="edit_nama"
                            class="form-label-perawat"
                        >
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


                    {{-- JENIS KELAMIN --}}
                    <div class="form-group-perawat">

                        <label
                            for="edit_jenis_kelamin"
                            class="form-label-perawat"
                        >
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


                    {{-- TANGGAL LAHIR --}}
                    <div class="form-group-perawat">

                        <label
                            for="edit_tanggal_lahir"
                            class="form-label-perawat"
                        >
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


                    {{-- ALAMAT --}}
                    <div class="form-group-perawat mb-0">

                        <label
                            for="edit_alamat"
                            class="form-label-perawat"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="edit_alamat"
                            name="alamat"
                            class="form-control-perawat"
                            rows="3"
                        ></textarea>

                    </div>

                </div>


                {{-- FOOTER --}}
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
                        <i class="fas fa-save me-1"></i>
                        Update Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL LIHAT / DETAIL PERAWAT
========================================================= --}}

<div
    class="modal fade modal-perawat"
    id="modalLihatPerawat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content detail-modal-perawat">

            {{-- HEADER TANPA X --}}
            <div class="modal-header detail-header-perawat">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user"></i>

                    <h5 class="modal-title">
                        Detail Perawat
                    </h5>

                </div>

            </div>


            {{-- BODY --}}
            <div class="modal-body detail-body-perawat">

                {{-- NAMA PERAWAT --}}
                <div class="detail-full-perawat">

                    <div class="detail-label-perawat">
                        Nama Perawat
                    </div>

                    <div
                        class="detail-value-perawat fw-bold"
                        id="lihat_nama"
                    >
                        -
                    </div>

                </div>


                {{-- JENIS KELAMIN + TANGGAL LAHIR --}}
                <div class="row detail-row-perawat">

                    <div class="col-6">

                        <div class="detail-label-perawat">
                            Jenis Kelamin
                        </div>

                        <div
                            class="detail-value-perawat"
                            id="lihat_jenis_kelamin"
                        >
                            -
                        </div>

                    </div>


                    <div class="col-6">

                        <div class="detail-label-perawat">
                            Tanggal Lahir
                        </div>

                        <div
                            class="detail-value-perawat"
                            id="lihat_tanggal_lahir"
                        >
                            -
                        </div>

                    </div>

                </div>


                {{-- ALAMAT --}}
                <div class="detail-full-perawat alamat-detail-perawat">

                    <div class="detail-label-perawat">
                        Alamat
                    </div>

                    <div
                        class="detail-value-perawat"
                        id="lihat_alamat"
                    >
                        -
                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer detail-footer-perawat">

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
     SWEETALERT
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       CSRF
    ===================================================== */

    const csrfInput = document.querySelector(
        '#formTambahPerawat input[name="_token"]'
    );

    const csrfToken = csrfInput
        ? csrfInput.value
        : '';


    /* =====================================================
       URL
    ===================================================== */

    const storeUrl = @json(
        route('master-perawat.store')
    );

    const baseUrl = @json(
        url('master-perawat')
    );


    /* =====================================================
       FORM TAMBAH
    ===================================================== */

    const formTambah = document.getElementById(
        'formTambahPerawat'
    );

    formTambah.addEventListener(
        'submit',
        function (e) {

            e.preventDefault();

            const button = document.getElementById(
                'btnSimpanTambah'
            );

            button.disabled = true;

            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';

            const formData = new FormData(
                formTambah
            );


            fetch(storeUrl, {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },

                body: formData
            })

            .then(async response => {

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })

            .then(data => {

                const modalElement =
                    document.getElementById(
                        'modalTambahPerawat'
                    );

                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );

                if (modal) {
                    modal.hide();
                }

                formTambah.reset();


                const barisKosong =
                    document.getElementById(
                        'barisKosong'
                    );

                if (barisKosong) {
                    barisKosong.remove();
                }


                tambahBarisKeTabel(
                    data.data
                );

                perbaruiNomor();


                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        data.message ||
                        'Data perawat berhasil ditambahkan.',
                    timer: 1800,
                    showConfirmButton: false
                });


                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Simpan Data';
            })

            .catch(error => {

                tampilkanError(error);

                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Simpan Data';
            });

        }
    );


    /* =====================================================
       EVENT AWAL EDIT
    ===================================================== */

    document
        .querySelectorAll('.btn-edit')
        .forEach(button => {
            pasangEventEdit(button);
        });


    /* =====================================================
       EVENT AWAL LIHAT
    ===================================================== */

    document
        .querySelectorAll('.btn-view')
        .forEach(button => {
            pasangEventLihat(button);
        });


    /* =====================================================
       FORM EDIT
    ===================================================== */

    const formEdit =
        document.getElementById(
            'formEditPerawat'
        );

    formEdit.addEventListener(
        'submit',
        function (e) {

            e.preventDefault();

            const id =
                document.getElementById(
                    'edit_id'
                ).value;


            const button =
                document.getElementById(
                    'btnSimpanEdit'
                );

            button.disabled = true;

            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';


            const formData =
                new FormData(formEdit);

            formData.append(
                '_method',
                'PUT'
            );


            fetch(
                baseUrl + '/' + id,
                {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    body: formData
                }
            )

            .then(async response => {

                const data =
                    await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })

            .then(data => {

                updateBarisTabel(
                    data.data
                );


                const modalElement =
                    document.getElementById(
                        'modalEditPerawat'
                    );

                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );

                if (modal) {
                    modal.hide();
                }


                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        data.message ||
                        'Data perawat berhasil diperbarui.',
                    timer: 1800,
                    showConfirmButton: false
                });


                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Update Data';
            })

            .catch(error => {

                tampilkanError(error);

                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Update Data';
            });

        }
    );


    /* =====================================================
       EVENT AWAL HAPUS
    ===================================================== */

    document
        .querySelectorAll('.btn-hapus')
        .forEach(button => {
            pasangEventHapus(button);
        });


    /* =====================================================
       TAMBAH BARIS KE TABLE
    ===================================================== */

    function tambahBarisKeTabel(perawat) {

        const tabel =
            document.getElementById(
                'tabelPerawat'
            );


        const row =
            document.createElement('tr');

        row.id =
            'perawat-' + perawat.id;


        row.innerHTML = `
            <td class="text-center nomor text-muted">
                1
            </td>

            <td>
                <div class="d-flex align-items-center gap-2">

                    <div class="avatar-perawat">
                        <i class="fas fa-user-nurse"></i>
                    </div>

                    <div>

                        <div class="nurse-name data-nama">
                            ${escapeHtml(perawat.nama)}
                        </div>

                        <div class="nurse-id">
                            ID: ${escapeHtml(perawat.id)}
                        </div>

                    </div>

                </div>
            </td>

            <td>
                <span class="badge badge-blue-soft data-jenis-kelamin">
                    ${ucfirst(perawat.jenis_kelamin)}
                </span>
            </td>

            <td>
                <span class="data-tanggal-lahir">
                    ${escapeHtml(perawat.tanggal_lahir)}
                </span>
            </td>

            <td>
                <span class="data-alamat">
                    ${escapeHtml(perawat.alamat || '-')}
                </span>
            </td>

            <td class="text-center">

                <div class="d-flex justify-content-center gap-1">

                    <button
                        type="button"
                        class="btn btn-sm btn-action-view btn-view"
                        data-id="${escapeAttr(perawat.id)}"
                        data-nama="${escapeAttr(perawat.nama)}"
                        data-jenis_kelamin="${escapeAttr(perawat.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(perawat.tanggal_lahir)}"
                        data-alamat="${escapeAttr(perawat.alamat || '')}"
                    >
                        <i class="fas fa-eye me-1"></i>
                        Lihat
                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-action-edit btn-edit"
                        data-id="${escapeAttr(perawat.id)}"
                        data-nama="${escapeAttr(perawat.nama)}"
                        data-jenis_kelamin="${escapeAttr(perawat.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(perawat.tanggal_lahir)}"
                        data-alamat="${escapeAttr(perawat.alamat || '')}"
                    >
                        <i class="fas fa-edit me-1"></i>
                        Edit
                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-action-delete btn-hapus"
                        data-id="${escapeAttr(perawat.id)}"
                        data-nama="${escapeAttr(perawat.nama)}"
                    >
                        <i class="fas fa-trash me-1"></i>
                        Hapus
                    </button>

                </div>

            </td>
        `;


        tabel.prepend(row);


        const editButton =
            row.querySelector(
                '.btn-edit'
            );

        const viewButton =
            row.querySelector(
                '.btn-view'
            );

        const hapusButton =
            row.querySelector(
                '.btn-hapus'
            );


        pasangEventEdit(
            editButton
        );

        pasangEventLihat(
            viewButton
        );

        pasangEventHapus(
            hapusButton
        );
    }


    /* =====================================================
       UPDATE BARIS
    ===================================================== */

    function updateBarisTabel(perawat) {

        const row =
            document.getElementById(
                'perawat-' + perawat.id
            );

        if (!row) {
            return;
        }


        row.querySelector(
            '.data-nama'
        ).innerText =
            perawat.nama;


        row.querySelector(
            '.data-jenis-kelamin'
        ).innerText =
            ucfirst(
                perawat.jenis_kelamin
            );


        row.querySelector(
            '.data-tanggal-lahir'
        ).innerText =
            perawat.tanggal_lahir;


        row.querySelector(
            '.data-alamat'
        ).innerText =
            perawat.alamat || '-';


        /* UPDATE BUTTON EDIT */
        const editButton =
            row.querySelector(
                '.btn-edit'
            );

        editButton.dataset.nama =
            perawat.nama;

        editButton.dataset.jenis_kelamin =
            perawat.jenis_kelamin;

        editButton.dataset.tanggal_lahir =
            perawat.tanggal_lahir;

        editButton.dataset.alamat =
            perawat.alamat || '';


        /* UPDATE BUTTON LIHAT */
        const viewButton =
            row.querySelector(
                '.btn-view'
            );

        if (viewButton) {

            viewButton.dataset.nama =
                perawat.nama;

            viewButton.dataset.jenis_kelamin =
                perawat.jenis_kelamin;

            viewButton.dataset.tanggal_lahir =
                perawat.tanggal_lahir;

            viewButton.dataset.alamat =
                perawat.alamat || '';
        }
    }


    /* =====================================================
       EVENT LIHAT
    ===================================================== */

    function pasangEventLihat(button) {

        if (!button) {
            return;
        }


        button.addEventListener(
            'click',
            function () {

                document.getElementById(
                    'lihat_nama'
                ).innerText =
                    this.dataset.nama || '-';


                document.getElementById(
                    'lihat_jenis_kelamin'
                ).innerText =
                    ucfirst(
                        this.dataset.jenis_kelamin || ''
                    );


                document.getElementById(
                    'lihat_tanggal_lahir'
                ).innerText =
                    this.dataset.tanggal_lahir || '-';


                document.getElementById(
                    'lihat_alamat'
                ).innerText =
                    this.dataset.alamat || '-';


                const modalElement =
                    document.getElementById(
                        'modalLihatPerawat'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();

            }
        );
    }


    /* =====================================================
       EVENT EDIT
    ===================================================== */

    function pasangEventEdit(button) {

        if (!button) {
            return;
        }


        button.addEventListener(
            'click',
            function () {

                document.getElementById(
                    'edit_id'
                ).value =
                    this.dataset.id;


                document.getElementById(
                    'edit_nama'
                ).value =
                    this.dataset.nama || '';


                document.getElementById(
                    'edit_jenis_kelamin'
                ).value =
                    this.dataset.jenis_kelamin || '';


                document.getElementById(
                    'edit_tanggal_lahir'
                ).value =
                    this.dataset.tanggal_lahir || '';


                document.getElementById(
                    'edit_alamat'
                ).value =
                    this.dataset.alamat || '';


                const modalElement =
                    document.getElementById(
                        'modalEditPerawat'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();

            }
        );
    }


    /* =====================================================
       EVENT HAPUS
    ===================================================== */

    function pasangEventHapus(button) {

        if (!button) {
            return;
        }


        button.addEventListener(
            'click',
            function () {

                const id =
                    this.dataset.id;

                const nama =
                    this.dataset.nama;


                Swal.fire({

                    title:
                        'Hapus perawat?',

                    text:
                        'Data "' +
                        nama +
                        '" akan dihapus.',

                    icon:
                        'warning',

                    showCancelButton:
                        true,

                    confirmButtonText:
                        'Ya, hapus',

                    cancelButtonText:
                        'Batal',

                    reverseButtons:
                        true

                })

                .then(result => {

                    if (!result.isConfirmed) {
                        return;
                    }


                    fetch(
                        baseUrl + '/' + id,
                        {
                            method: 'DELETE',

                            headers: {
                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    )

                    .then(
                        async response => {

                            const data =
                                await response.json();

                            if (!response.ok) {
                                throw data;
                            }

                            return data;
                        }
                    )

                    .then(data => {

                        const row =
                            document.getElementById(
                                'perawat-' + id
                            );

                        if (row) {
                            row.remove();
                        }


                        perbaruiNomor();


                        Swal.fire({

                            icon:
                                'success',

                            title:
                                'Berhasil!',

                            text:
                                data.message ||
                                'Data perawat berhasil dihapus.',

                            timer:
                                1800,

                            showConfirmButton:
                                false

                        });

                    })

                    .catch(error => {

                        tampilkanError(
                            error
                        );

                    });

                });

            }
        );
    }


    /* =====================================================
       NOMOR TABLE
    ===================================================== */

    function perbaruiNomor() {

        const rows =
            document.querySelectorAll(
                '#tabelPerawat tr'
            );


        rows.forEach(
            (row, index) => {

                const nomor =
                    row.querySelector(
                        '.nomor'
                    );

                if (nomor) {
                    nomor.innerText =
                        index + 1;
                }

            }
        );
    }


    /* =====================================================
       ERROR
    ===================================================== */

    function tampilkanError(error) {

        let pesan =
            'Terjadi kesalahan.';


        if (error.errors) {

            pesan =
                Object.values(
                    error.errors
                )
                .flat()
                .join('<br>');

        }

        else if (error.message) {

            pesan =
                error.message;

        }


        Swal.fire({

            icon:
                'error',

            title:
                'Gagal!',

            html:
                pesan

        });
    }


    /* =====================================================
       UC FIRST
    ===================================================== */

    function ucfirst(text) {

        if (!text) {
            return '';
        }


        return (
            text.charAt(0).toUpperCase() +
            text.slice(1)
        );
    }


    /* =====================================================
       ESCAPE HTML
    ===================================================== */

    function escapeHtml(text) {

        if (
            text === null ||
            text === undefined
        ) {
            return '';
        }


        return String(text)

            .replace(
                /&/g,
                '&amp;'
            )

            .replace(
                /</g,
                '&lt;'
            )

            .replace(
                />/g,
                '&gt;'
            )

            .replace(
                /"/g,
                '&quot;'
            )

            .replace(
                /'/g,
                '&#039;'
            );
    }


    /* =====================================================
       ESCAPE ATTRIBUTE
    ===================================================== */

    function escapeAttr(text) {
        return escapeHtml(text);
    }

});
</script>   

@endsection@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Perawat')

@section('content')

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
    .master-perawat {
        padding: 12px 0 30px;
    }

    /* =========================================================
       HEADER
    ========================================================= */
    .page-header-perawat {
        margin-bottom: 22px;
    }

    .header-icon-box {
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

    /* =========================================================
       BUTTON PRIMARY
    ========================================================= */
    .btn-blue-primary {
        background-color: var(--blue-main) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-blue-primary:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* =========================================================
       ALERT
    ========================================================= */
    .alert-perawat {
        border: none;
        border-left: 3px solid var(--blue-main);
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        padding: 12px 15px;
        margin-bottom: 18px;
        font-size: 13px;
    }

    /* =========================================================
       TABLE
    ========================================================= */
    .card-table-perawat {
        border: none !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .table-perawat {
        margin-bottom: 0;
    }

    .table-perawat thead th {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table-perawat tbody td {
        padding: 12px 16px;
        font-size: 13px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-perawat tbody tr {
        transition: all 0.15s ease;
    }

    .table-perawat tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }

    /* =========================================================
       PERAWAT NAME
    ========================================================= */
    .nurse-name {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .nurse-id {
        color: #94a3b8;
        font-size: 10px;
    }

    .avatar-perawat {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background-color: var(--blue-light-bg);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    /* =========================================================
       BADGES
    ========================================================= */
    .badge-blue-soft {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 12px;
        border-radius: 6px;
    }

    /* =========================================================
       ACTION BUTTON
    ========================================================= */
    .btn-action-view {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 10px;
    }

    .btn-action-view:hover {
        background-color: #bae6fd !important;
        color: #0369a1 !important;
    }

    .btn-action-edit {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 10px;
    }

    .btn-action-edit:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
    }

    .btn-action-delete {
        background-color: #ef4444 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 10px;
    }

    .btn-action-delete:hover {
        background-color: #dc2626 !important;
    }

    /* =========================================================
       MODAL UMUM
    ========================================================= */
    .modal-perawat .modal-dialog {
        max-width: 460px;
    }

    .modal-perawat .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }

    .modal-perawat .modal-header {
        background-color: var(--blue-main);
        color: #ffffff;
        border: none;
        padding: 15px 18px;
    }

    .modal-perawat .modal-title {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    /*
       PENTING:
       Jika layout/bootstrap menyisipkan tombol X,
       tombol tersebut tetap akan disembunyikan.
    */
    .modal-perawat .btn-close {
        display: none !important;
    }

    .modal-perawat .modal-body {
        padding: 20px 18px;
        background-color: #ffffff;
    }

    .modal-perawat .modal-footer {
        background-color: #f8fafc;
        border: none;
        padding: 12px 18px;
    }

    /* =========================================================
       FORM
    ========================================================= */
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
        background-color: #ffffff;
        transition: all 0.2s ease;
    }

    .form-control-perawat:focus,
    .form-select-perawat:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12);
        outline: none;
    }

    textarea.form-control-perawat {
        min-height: 78px;
        resize: vertical;
    }

    .form-group-perawat {
        margin-bottom: 13px;
    }

    .btn-modal-cancel {
        background-color: #f1f5f9 !important;
        color: #64748b !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-cancel:hover {
        background-color: #e2e8f0 !important;
    }

    .btn-modal-save {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 7px;
        padding: 8px 16px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save:hover {
        background-color: var(--blue-dark) !important;
    }

    /* =========================================================
       DETAIL PERAWAT
    ========================================================= */
    .detail-modal-perawat {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }

    .detail-header-perawat {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 13px 16px !important;
        min-height: 42px;
    }

    .detail-header-perawat .modal-title {
        font-size: 13px !important;
        font-weight: 700;
        margin: 0;
    }

    .detail-header-perawat i {
        font-size: 13px;
    }

    .detail-body-perawat {
        padding: 0 14px !important;
        background-color: #ffffff;
    }

    .detail-full-perawat {
        padding: 13px 5px;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row-perawat {
        margin: 0 !important;
        padding: 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row-perawat > div {
        padding: 13px 5px;
    }

    .detail-row-perawat > div:first-child {
        border-right: 1px solid #e5e7eb;
    }

    .detail-label-perawat {
        font-size: 10px;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .detail-value-perawat {
        font-size: 12px;
        color: #475569;
        line-height: 1.4;
    }

    .detail-full-perawat .fw-bold {
        color: #334155;
        font-weight: 700 !important;
    }

    .alamat-detail-perawat {
        border-bottom: none;
        padding-bottom: 14px;
    }

    .detail-footer-perawat {
        background-color: #ffffff !important;
        border: none !important;
        padding: 8px 10px 16px !important;
        justify-content: flex-end;
    }

    .detail-footer-perawat .btn {
        min-width: 72px;
        padding: 8px 16px !important;
        font-size: 12px !important;
        border-radius: 7px !important;
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */
    .empty-perawat {
        padding: 45px 20px !important;
        color: #94a3b8 !important;
        font-size: 13px;
    }
</style>


<div class="container-fluid master-perawat">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center page-header-perawat">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box">
                <i class="fas fa-user-nurse"></i>
            </div>

            <div>
                <h3 class="page-title-perawat">
                    Master Perawat
                </h3>

                <p class="page-subtitle-perawat">
                    Data perawat yang terdaftar
                </p>
            </div>

        </div>

        <button
            type="button"
            class="btn btn-blue-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPerawat"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Perawat
        </button>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-perawat">
            <i class="fas fa-check-circle me-2 text-success"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- TABLE --}}
    <div class="card card-table-perawat">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-perawat align-middle">

                    <thead>
                        <tr>

                            <th width="50" class="text-center">
                                No
                            </th>

                            <th>
                                Nama Perawat
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

                            <th width="220" class="text-center">
                                Aksi
                            </th>

                        </tr>
                    </thead>


                    <tbody id="tabelPerawat">

                        @forelse($perawats as $perawat)

                            <tr id="perawat-{{ $perawat->id }}">

                                {{-- NO --}}
                                <td class="text-center nomor text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="avatar-perawat">
                                            <i class="fas fa-user-nurse"></i>
                                        </div>

                                        <div>

                                            <div class="nurse-name data-nama">
                                                {{ $perawat->nama }}
                                            </div>

                                            <div class="nurse-id">
                                                ID: {{ $perawat->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS KELAMIN --}}
                                <td>

                                    <span class="badge badge-blue-soft data-jenis-kelamin">

                                        @if($perawat->jenis_kelamin === 'laki-laki')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                    </span>

                                </td>


                                {{-- TANGGAL LAHIR --}}
                                <td>

                                    <span class="data-tanggal-lahir">
                                        {{ $perawat->tanggal_lahir }}
                                    </span>

                                </td>


                                {{-- ALAMAT --}}
                                <td>

                                    <span class="data-alamat">
                                        {{ $perawat->alamat ?? '-' }}
                                    </span>

                                </td>


                                {{-- AKSI --}}
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- LIHAT --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view btn-view"
                                            data-id="{{ $perawat->id }}"
                                            data-nama="{{ $perawat->nama }}"
                                            data-jenis_kelamin="{{ $perawat->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $perawat->tanggal_lahir }}"
                                            data-alamat="{{ $perawat->alamat }}"
                                        >
                                            <i class="fas fa-eye me-1"></i>
                                            Lihat
                                        </button>


                                        {{-- EDIT --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit btn-edit"
                                            data-id="{{ $perawat->id }}"
                                            data-nama="{{ $perawat->nama }}"
                                            data-jenis_kelamin="{{ $perawat->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $perawat->tanggal_lahir }}"
                                            data-alamat="{{ $perawat->alamat }}"
                                        >
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </button>


                                        {{-- HAPUS --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete btn-hapus"
                                            data-id="{{ $perawat->id }}"
                                            data-nama="{{ $perawat->nama }}"
                                        >
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr id="barisKosong">

                                <td
                                    colspan="6"
                                    class="text-center empty-perawat"
                                >
                                    <i class="fas fa-user-nurse fa-2x mb-2 d-block"></i>
                                    Belum ada data perawat.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH PERAWAT
========================================================= --}}

<div
    class="modal fade modal-perawat"
    id="modalTambahPerawat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER TANPA X --}}
            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-plus"></i>

                    <h5 class="modal-title">
                        Tambah Perawat
                    </h5>

                </div>

            </div>


            {{-- FORM --}}
            <form id="formTambahPerawat">

                @csrf

                <div class="modal-body">

                    {{-- NAMA --}}
                    <div class="form-group-perawat">

                        <label
                            for="tambah_nama"
                            class="form-label-perawat"
                        >
                            Nama Perawat
                        </label>

                        <input
                            type="text"
                            id="tambah_nama"
                            name="nama"
                            class="form-control-perawat"
                            placeholder="Masukkan nama perawat"
                            required
                        >

                    </div>


                    {{-- JENIS KELAMIN --}}
                    <div class="form-group-perawat">

                        <label
                            for="tambah_jenis_kelamin"
                            class="form-label-perawat"
                        >
                            Jenis Kelamin
                        </label>

                        <select
                            id="tambah_jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select-perawat"
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


                    {{-- TANGGAL LAHIR --}}
                    <div class="form-group-perawat">

                        <label
                            for="tambah_tanggal_lahir"
                            class="form-label-perawat"
                        >
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="tambah_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-perawat"
                            required
                        >

                    </div>


                    {{-- ALAMAT --}}
                    <div class="form-group-perawat mb-0">

                        <label
                            for="tambah_alamat"
                            class="form-label-perawat"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="tambah_alamat"
                            name="alamat"
                            class="form-control-perawat"
                            rows="3"
                            placeholder="Ketikkan alamat lengkap..."
                        ></textarea>

                    </div>

                </div>


                {{-- FOOTER --}}
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
                        <i class="fas fa-save me-1"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL EDIT PERAWAT
========================================================= --}}

<div
    class="modal fade modal-perawat"
    id="modalEditPerawat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER TANPA X --}}
            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-edit"></i>

                    <h5 class="modal-title">
                        Edit Perawat
                    </h5>

                </div>

            </div>


            {{-- FORM --}}
            <form id="formEditPerawat">

                @csrf

                <input
                    type="hidden"
                    id="edit_id"
                >


                <div class="modal-body">

                    {{-- NAMA --}}
                    <div class="form-group-perawat">

                        <label
                            for="edit_nama"
                            class="form-label-perawat"
                        >
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


                    {{-- JENIS KELAMIN --}}
                    <div class="form-group-perawat">

                        <label
                            for="edit_jenis_kelamin"
                            class="form-label-perawat"
                        >
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


                    {{-- TANGGAL LAHIR --}}
                    <div class="form-group-perawat">

                        <label
                            for="edit_tanggal_lahir"
                            class="form-label-perawat"
                        >
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


                    {{-- ALAMAT --}}
                    <div class="form-group-perawat mb-0">

                        <label
                            for="edit_alamat"
                            class="form-label-perawat"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="edit_alamat"
                            name="alamat"
                            class="form-control-perawat"
                            rows="3"
                        ></textarea>

                    </div>

                </div>


                {{-- FOOTER --}}
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
                        <i class="fas fa-save me-1"></i>
                        Update Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL LIHAT / DETAIL PERAWAT
========================================================= --}}

<div
    class="modal fade modal-perawat"
    id="modalLihatPerawat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content detail-modal-perawat">

            {{-- HEADER TANPA X --}}
            <div class="modal-header detail-header-perawat">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user"></i>

                    <h5 class="modal-title">
                        Detail Perawat
                    </h5>

                </div>

            </div>


            {{-- BODY --}}
            <div class="modal-body detail-body-perawat">

                {{-- NAMA PERAWAT --}}
                <div class="detail-full-perawat">

                    <div class="detail-label-perawat">
                        Nama Perawat
                    </div>

                    <div
                        class="detail-value-perawat fw-bold"
                        id="lihat_nama"
                    >
                        -
                    </div>

                </div>


                {{-- JENIS KELAMIN + TANGGAL LAHIR --}}
                <div class="row detail-row-perawat">

                    <div class="col-6">

                        <div class="detail-label-perawat">
                            Jenis Kelamin
                        </div>

                        <div
                            class="detail-value-perawat"
                            id="lihat_jenis_kelamin"
                        >
                            -
                        </div>

                    </div>


                    <div class="col-6">

                        <div class="detail-label-perawat">
                            Tanggal Lahir
                        </div>

                        <div
                            class="detail-value-perawat"
                            id="lihat_tanggal_lahir"
                        >
                            -
                        </div>

                    </div>

                </div>


                {{-- ALAMAT --}}
                <div class="detail-full-perawat alamat-detail-perawat">

                    <div class="detail-label-perawat">
                        Alamat
                    </div>

                    <div
                        class="detail-value-perawat"
                        id="lihat_alamat"
                    >
                        -
                    </div>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="modal-footer detail-footer-perawat">

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
     SWEETALERT
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       CSRF
    ===================================================== */

    const csrfInput = document.querySelector(
        '#formTambahPerawat input[name="_token"]'
    );

    const csrfToken = csrfInput
        ? csrfInput.value
        : '';


    /* =====================================================
       URL
    ===================================================== */

    const storeUrl = @json(
        route('master-perawat.store')
    );

    const baseUrl = @json(
        url('master-perawat')
    );


    /* =====================================================
       FORM TAMBAH
    ===================================================== */

    const formTambah = document.getElementById(
        'formTambahPerawat'
    );

    formTambah.addEventListener(
        'submit',
        function (e) {

            e.preventDefault();

            const button = document.getElementById(
                'btnSimpanTambah'
            );

            button.disabled = true;

            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';

            const formData = new FormData(
                formTambah
            );


            fetch(storeUrl, {
                method: 'POST',

                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },

                body: formData
            })

            .then(async response => {

                const data = await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })

            .then(data => {

                const modalElement =
                    document.getElementById(
                        'modalTambahPerawat'
                    );

                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );

                if (modal) {
                    modal.hide();
                }

                formTambah.reset();


                const barisKosong =
                    document.getElementById(
                        'barisKosong'
                    );

                if (barisKosong) {
                    barisKosong.remove();
                }


                tambahBarisKeTabel(
                    data.data
                );

                perbaruiNomor();


                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        data.message ||
                        'Data perawat berhasil ditambahkan.',
                    timer: 1800,
                    showConfirmButton: false
                });


                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Simpan Data';
            })

            .catch(error => {

                tampilkanError(error);

                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Simpan Data';
            });

        }
    );


    /* =====================================================
       EVENT AWAL EDIT
    ===================================================== */

    document
        .querySelectorAll('.btn-edit')
        .forEach(button => {
            pasangEventEdit(button);
        });


    /* =====================================================
       EVENT AWAL LIHAT
    ===================================================== */

    document
        .querySelectorAll('.btn-view')
        .forEach(button => {
            pasangEventLihat(button);
        });


    /* =====================================================
       FORM EDIT
    ===================================================== */

    const formEdit =
        document.getElementById(
            'formEditPerawat'
        );

    formEdit.addEventListener(
        'submit',
        function (e) {

            e.preventDefault();

            const id =
                document.getElementById(
                    'edit_id'
                ).value;


            const button =
                document.getElementById(
                    'btnSimpanEdit'
                );

            button.disabled = true;

            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';


            const formData =
                new FormData(formEdit);

            formData.append(
                '_method',
                'PUT'
            );


            fetch(
                baseUrl + '/' + id,
                {
                    method: 'POST',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },

                    body: formData
                }
            )

            .then(async response => {

                const data =
                    await response.json();

                if (!response.ok) {
                    throw data;
                }

                return data;
            })

            .then(data => {

                updateBarisTabel(
                    data.data
                );


                const modalElement =
                    document.getElementById(
                        'modalEditPerawat'
                    );

                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );

                if (modal) {
                    modal.hide();
                }


                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        data.message ||
                        'Data perawat berhasil diperbarui.',
                    timer: 1800,
                    showConfirmButton: false
                });


                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Update Data';
            })

            .catch(error => {

                tampilkanError(error);

                button.disabled = false;

                button.innerHTML =
                    '<i class="fas fa-save me-1"></i> Update Data';
            });

        }
    );


    /* =====================================================
       EVENT AWAL HAPUS
    ===================================================== */

    document
        .querySelectorAll('.btn-hapus')
        .forEach(button => {
            pasangEventHapus(button);
        });


    /* =====================================================
       TAMBAH BARIS KE TABLE
    ===================================================== */

    function tambahBarisKeTabel(perawat) {

        const tabel =
            document.getElementById(
                'tabelPerawat'
            );


        const row =
            document.createElement('tr');

        row.id =
            'perawat-' + perawat.id;


        row.innerHTML = `
            <td class="text-center nomor text-muted">
                1
            </td>

            <td>
                <div class="d-flex align-items-center gap-2">

                    <div class="avatar-perawat">
                        <i class="fas fa-user-nurse"></i>
                    </div>

                    <div>

                        <div class="nurse-name data-nama">
                            ${escapeHtml(perawat.nama)}
                        </div>

                        <div class="nurse-id">
                            ID: ${escapeHtml(perawat.id)}
                        </div>

                    </div>

                </div>
            </td>

            <td>
                <span class="badge badge-blue-soft data-jenis-kelamin">
                    ${ucfirst(perawat.jenis_kelamin)}
                </span>
            </td>

            <td>
                <span class="data-tanggal-lahir">
                    ${escapeHtml(perawat.tanggal_lahir)}
                </span>
            </td>

            <td>
                <span class="data-alamat">
                    ${escapeHtml(perawat.alamat || '-')}
                </span>
            </td>

            <td class="text-center">

                <div class="d-flex justify-content-center gap-1">

                    <button
                        type="button"
                        class="btn btn-sm btn-action-view btn-view"
                        data-id="${escapeAttr(perawat.id)}"
                        data-nama="${escapeAttr(perawat.nama)}"
                        data-jenis_kelamin="${escapeAttr(perawat.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(perawat.tanggal_lahir)}"
                        data-alamat="${escapeAttr(perawat.alamat || '')}"
                    >
                        <i class="fas fa-eye me-1"></i>
                        Lihat
                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-action-edit btn-edit"
                        data-id="${escapeAttr(perawat.id)}"
                        data-nama="${escapeAttr(perawat.nama)}"
                        data-jenis_kelamin="${escapeAttr(perawat.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(perawat.tanggal_lahir)}"
                        data-alamat="${escapeAttr(perawat.alamat || '')}"
                    >
                        <i class="fas fa-edit me-1"></i>
                        Edit
                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-action-delete btn-hapus"
                        data-id="${escapeAttr(perawat.id)}"
                        data-nama="${escapeAttr(perawat.nama)}"
                    >
                        <i class="fas fa-trash me-1"></i>
                        Hapus
                    </button>

                </div>

            </td>
        `;


        tabel.prepend(row);


        const editButton =
            row.querySelector(
                '.btn-edit'
            );

        const viewButton =
            row.querySelector(
                '.btn-view'
            );

        const hapusButton =
            row.querySelector(
                '.btn-hapus'
            );


        pasangEventEdit(
            editButton
        );

        pasangEventLihat(
            viewButton
        );

        pasangEventHapus(
            hapusButton
        );
    }


    /* =====================================================
       UPDATE BARIS
    ===================================================== */

    function updateBarisTabel(perawat) {

        const row =
            document.getElementById(
                'perawat-' + perawat.id
            );

        if (!row) {
            return;
        }


        row.querySelector(
            '.data-nama'
        ).innerText =
            perawat.nama;


        row.querySelector(
            '.data-jenis-kelamin'
        ).innerText =
            ucfirst(
                perawat.jenis_kelamin
            );


        row.querySelector(
            '.data-tanggal-lahir'
        ).innerText =
            perawat.tanggal_lahir;


        row.querySelector(
            '.data-alamat'
        ).innerText =
            perawat.alamat || '-';


        /* UPDATE BUTTON EDIT */
        const editButton =
            row.querySelector(
                '.btn-edit'
            );

        editButton.dataset.nama =
            perawat.nama;

        editButton.dataset.jenis_kelamin =
            perawat.jenis_kelamin;

        editButton.dataset.tanggal_lahir =
            perawat.tanggal_lahir;

        editButton.dataset.alamat =
            perawat.alamat || '';


        /* UPDATE BUTTON LIHAT */
        const viewButton =
            row.querySelector(
                '.btn-view'
            );

        if (viewButton) {

            viewButton.dataset.nama =
                perawat.nama;

            viewButton.dataset.jenis_kelamin =
                perawat.jenis_kelamin;

            viewButton.dataset.tanggal_lahir =
                perawat.tanggal_lahir;

            viewButton.dataset.alamat =
                perawat.alamat || '';
        }
    }


    /* =====================================================
       EVENT LIHAT
    ===================================================== */

    function pasangEventLihat(button) {

        if (!button) {
            return;
        }


        button.addEventListener(
            'click',
            function () {

                document.getElementById(
                    'lihat_nama'
                ).innerText =
                    this.dataset.nama || '-';


                document.getElementById(
                    'lihat_jenis_kelamin'
                ).innerText =
                    ucfirst(
                        this.dataset.jenis_kelamin || ''
                    );


                document.getElementById(
                    'lihat_tanggal_lahir'
                ).innerText =
                    this.dataset.tanggal_lahir || '-';


                document.getElementById(
                    'lihat_alamat'
                ).innerText =
                    this.dataset.alamat || '-';


                const modalElement =
                    document.getElementById(
                        'modalLihatPerawat'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();

            }
        );
    }


    /* =====================================================
       EVENT EDIT
    ===================================================== */

    function pasangEventEdit(button) {

        if (!button) {
            return;
        }


        button.addEventListener(
            'click',
            function () {

                document.getElementById(
                    'edit_id'
                ).value =
                    this.dataset.id;


                document.getElementById(
                    'edit_nama'
                ).value =
                    this.dataset.nama || '';


                document.getElementById(
                    'edit_jenis_kelamin'
                ).value =
                    this.dataset.jenis_kelamin || '';


                document.getElementById(
                    'edit_tanggal_lahir'
                ).value =
                    this.dataset.tanggal_lahir || '';


                document.getElementById(
                    'edit_alamat'
                ).value =
                    this.dataset.alamat || '';


                const modalElement =
                    document.getElementById(
                        'modalEditPerawat'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();

            }
        );
    }


    /* =====================================================
       EVENT HAPUS
    ===================================================== */

    function pasangEventHapus(button) {

        if (!button) {
            return;
        }


        button.addEventListener(
            'click',
            function () {

                const id =
                    this.dataset.id;

                const nama =
                    this.dataset.nama;


                Swal.fire({

                    title:
                        'Hapus perawat?',

                    text:
                        'Data "' +
                        nama +
                        '" akan dihapus.',

                    icon:
                        'warning',

                    showCancelButton:
                        true,

                    confirmButtonText:
                        'Ya, hapus',

                    cancelButtonText:
                        'Batal',

                    reverseButtons:
                        true

                })

                .then(result => {

                    if (!result.isConfirmed) {
                        return;
                    }


                    fetch(
                        baseUrl + '/' + id,
                        {
                            method: 'DELETE',

                            headers: {
                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'Accept':
                                    'application/json',

                                'X-Requested-With':
                                    'XMLHttpRequest'
                            }
                        }
                    )

                    .then(
                        async response => {

                            const data =
                                await response.json();

                            if (!response.ok) {
                                throw data;
                            }

                            return data;
                        }
                    )

                    .then(data => {

                        const row =
                            document.getElementById(
                                'perawat-' + id
                            );

                        if (row) {
                            row.remove();
                        }


                        perbaruiNomor();


                        Swal.fire({

                            icon:
                                'success',

                            title:
                                'Berhasil!',

                            text:
                                data.message ||
                                'Data perawat berhasil dihapus.',

                            timer:
                                1800,

                            showConfirmButton:
                                false

                        });

                    })

                    .catch(error => {

                        tampilkanError(
                            error
                        );

                    });

                });

            }
        );
    }


    /* =====================================================
       NOMOR TABLE
    ===================================================== */

    function perbaruiNomor() {

        const rows =
            document.querySelectorAll(
                '#tabelPerawat tr'
            );


        rows.forEach(
            (row, index) => {

                const nomor =
                    row.querySelector(
                        '.nomor'
                    );

                if (nomor) {
                    nomor.innerText =
                        index + 1;
                }

            }
        );
    }


    /* =====================================================
       ERROR
    ===================================================== */

    function tampilkanError(error) {

        let pesan =
            'Terjadi kesalahan.';


        if (error.errors) {

            pesan =
                Object.values(
                    error.errors
                )
                .flat()
                .join('<br>');

        }

        else if (error.message) {

            pesan =
                error.message;

        }


        Swal.fire({

            icon:
                'error',

            title:
                'Gagal!',

            html:
                pesan

        });
    }


    /* =====================================================
       UC FIRST
    ===================================================== */

    function ucfirst(text) {

        if (!text) {
            return '';
        }


        return (
            text.charAt(0).toUpperCase() +
            text.slice(1)
        );
    }


    /* =====================================================
       ESCAPE HTML
    ===================================================== */

    function escapeHtml(text) {

        if (
            text === null ||
            text === undefined
        ) {
            return '';
        }


        return String(text)

            .replace(
                /&/g,
                '&amp;'
            )

            .replace(
                /</g,
                '&lt;'
            )

            .replace(
                />/g,
                '&gt;'
            )

            .replace(
                /"/g,
                '&quot;'
            )

            .replace(
                /'/g,
                '&#039;'
            );
    }


    /* =====================================================
       ESCAPE ATTRIBUTE
    ===================================================== */

    function escapeAttr(text) {
        return escapeHtml(text);
    }

});
</script>

@endsection
