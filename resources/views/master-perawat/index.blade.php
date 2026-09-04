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
        padding: 12px 0;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header-perawat {
        margin-bottom: 22px;
    }

    .header-icon-box-perawat {
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

    .btn-blue-primary-perawat {
        background-color: var(--blue-main) !important;
        border: none !important;

        color: #ffffff !important;

        border-radius: 8px;

        padding: 9px 15px;

        font-size: 13px;
        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary-perawat:hover {
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
    }


    /* =========================================================
       TABLE CARD
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


    /* =========================================================
       TABLE HEADER
    ========================================================= */

    .table-perawat thead th {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        font-size: 13px;
        font-weight: 600;

        padding: 14px 16px;

        white-space: nowrap;
    }


    /* =========================================================
       TABLE BODY
    ========================================================= */

    .table-perawat tbody td {
        padding: 12px 16px;

        font-size: 13px;

        color: #475569;

        border-bottom: 1px solid #f1f5f9;

        vertical-align: middle;
    }

    .table-perawat tbody tr {
        transition: 0.15s ease;
    }

    .table-perawat tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }

    .table-perawat tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       PERAWAT NAME
    ========================================================= */

    .perawat-name {
        color: #1e293b;

        font-weight: 600;

        margin-bottom: 2px;
    }

    .perawat-id {
        color: #94a3b8;

        font-size: 10px;
    }


    /* =========================================================
       AVATAR
    ========================================================= */

    .avatar-perawat {
        width: 32px;
        height: 32px;

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
       BADGE JENIS KELAMIN
    ========================================================= */

    .badge-blue-soft-perawat {
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

    .btn-action-view-perawat {
        background-color: #e0f2fe !important;

        color: #0284c7 !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-view-perawat:hover {
        background-color: #bae6fd !important;

        color: #0369a1 !important;
    }


    .btn-action-edit-perawat {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-edit-perawat:hover {
        background-color: var(--blue-dark) !important;

        color: #ffffff !important;
    }


    .btn-action-delete-perawat {
        background-color: #ef4444 !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-delete-perawat:hover {
        background-color: #dc2626 !important;

        color: #ffffff !important;
    }


    /* =========================================================
       MODAL
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


    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-perawat .modal-header {
        background-color: var(--blue-main);

        color: #ffffff;

        border: none;

        padding: 15px 18px;
    }

    .modal-perawat .modal-title {
        font-size: 16px;

        font-weight: 700;
    }

    .modal-perawat .modal-header .btn-close {
        filter: brightness(0) invert(1);

        opacity: 0.9;
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .modal-perawat .modal-body {
        padding: 20px 18px;

        background-color: #ffffff;
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

        transition: 0.2s ease;
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


    /* =========================================================
       MODAL FOOTER
    ========================================================= */

    .modal-perawat .modal-footer {

        background-color: #f8fafc;

        border: none;

        padding: 12px 18px;
    }


    .btn-modal-cancel-perawat {

        background-color: #f1f5f9 !important;

        color: #64748b !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 15px;

        font-size: 12px;

        font-weight: 600;
    }

    .btn-modal-cancel-perawat:hover {

        background-color: #e2e8f0 !important;
    }


    .btn-modal-save-perawat {

        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 16px;

        font-size: 12px;

        font-weight: 600;
    }

    .btn-modal-save-perawat:hover {

        background-color: var(--blue-dark) !important;
    }


    /* =========================================================
       DETAIL MODAL
    ========================================================= */

    .detail-perawat-table {
        width: 100%;
        margin: 0;
    }

    .detail-perawat-table td {

        padding: 9px 5px;

        border-bottom: 1px solid #f1f5f9;

        font-size: 12px;

        vertical-align: top;
    }

    .detail-perawat-table tr:last-child td {
        border-bottom: none;
    }

    .detail-perawat-label {

        width: 120px;

        color: #64748b;

        font-weight: 600;
    }

    .detail-perawat-value {

        color: #1e293b;

        font-weight: 500;
    }


    /* =========================================================
       EMPTY TABLE
    ========================================================= */

    .empty-perawat {

        padding: 45px 20px !important;

        color: #94a3b8 !important;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .page-header-perawat {

            flex-direction: column;

            align-items: flex-start !important;

            gap: 15px;
        }

        .btn-blue-primary-perawat {

            width: 100%;
        }

        .table-perawat {

            min-width: 800px;
        }

        .modal-perawat .modal-dialog {

            max-width: calc(100% - 25px);

            margin: 12px auto;
        }
    }

</style>


<div class="container-fluid master-perawat">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center page-header-perawat">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box-perawat">

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


        {{-- TOMBOL TAMBAH --}}

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


    {{-- =====================================================
         ALERT SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-perawat">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         ALERT ERROR
    ====================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger alert-perawat">

            <strong>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <div class="card card-table-perawat">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-perawat align-middle">

                    <thead>

                        <tr>

                            <th
                                class="text-center"
                                width="50"
                            >
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


                            <th
                                class="text-center"
                                width="220"
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($perawats as $perawat)

                            <tr id="perawat-{{ $perawat->id }}">


                                {{-- NO --}}

                                <td class="text-center text-muted">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <div class="d-flex align-items-center gap-2">


                                        <div class="avatar-perawat">

                                            <i class="fas fa-user-nurse"></i>

                                        </div>


                                        <div>

                                            <div class="perawat-name">

                                                {{ $perawat->nama }}

                                            </div>


                                            <div class="perawat-id">

                                                ID: {{ $perawat->id }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS KELAMIN --}}

                                <td>

                                    <span class="badge badge-blue-soft-perawat">

                                        {{ ucfirst($perawat->jenis_kelamin) }}

                                    </span>

                                </td>


                                {{-- TANGGAL LAHIR --}}

                                <td>

                                    {{ $perawat->tanggal_lahir }}

                                </td>


                                {{-- ALAMAT --}}

                                <td>

                                    {{ $perawat->alamat ?? '-' }}

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">


                                        {{-- LIHAT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view-perawat"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatPerawat{{ $perawat->id }}"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat

                                        </button>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit-perawat"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPerawat{{ $perawat->id }}"
                                        >

                                            <i class="fas fa-edit me-1"></i>

                                            Edit

                                        </button>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('master-perawat.destroy', $perawat->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data perawat {{ $perawat->nama }}?')"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-action-delete-perawat"
                                            >

                                                <i class="fas fa-trash me-1"></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="text-center empty-perawat"
                                >

                                    <i class="fas fa-user-nurse fa-2x mb-2 d-block"></i>

                                    Belum ada data perawat

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
    aria-labelledby="modalTambahPerawatLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER MODAL --}}

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-plus"></i>

                    <h5
                        class="modal-title"
                        id="modalTambahPerawatLabel"
                    >

                        Tambah Perawat

                    </h5>

                </div>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- FORM TAMBAH --}}

            <form
                action="{{ route('master-perawat.store') }}"
                method="POST"
            >

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
                            value="{{ old('nama') }}"
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
                            value="{{ old('tanggal_lahir') }}"
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
                            required
                        >{{ old('alamat') }}</textarea>

                    </div>

                </div>


                {{-- FOOTER --}}

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
     MODAL LIHAT PERAWAT
========================================================= --}}

@foreach($perawats as $perawat)

    <div
        class="modal fade modal-perawat"
        id="modalLihatPerawat{{ $perawat->id }}"
        tabindex="-1"
        aria-labelledby="modalLihatPerawatLabel{{ $perawat->id }}"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <div class="d-flex align-items-center gap-2">

                        <i class="fas fa-user-nurse"></i>

                        <h5
                            class="modal-title"
                            id="modalLihatPerawatLabel{{ $perawat->id }}"
                        >

                            Detail Perawat

                        </h5>

                    </div>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                {{-- BODY --}}

                <div class="modal-body">

                    <table class="detail-perawat-table">

                        <tr>

                            <td class="detail-perawat-label">
                                ID Perawat
                            </td>

                            <td class="detail-perawat-value">

                                {{ $perawat->id }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-perawat-label">
                                Nama Perawat
                            </td>

                            <td class="detail-perawat-value">

                                {{ $perawat->nama }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-perawat-label">
                                Jenis Kelamin
                            </td>

                            <td class="detail-perawat-value">

                                {{ ucfirst($perawat->jenis_kelamin) }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-perawat-label">
                                Tanggal Lahir
                            </td>

                            <td class="detail-perawat-value">

                                {{ $perawat->tanggal_lahir }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-perawat-label">
                                Alamat
                            </td>

                            <td class="detail-perawat-value">

                                {{ $perawat->alamat ?? '-' }}

                            </td>

                        </tr>

                    </table>

                </div>


                {{-- FOOTER --}}

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



    {{-- =====================================================
         MODAL EDIT PERAWAT
    ====================================================== --}}

    <div
        class="modal fade modal-perawat"
        id="modalEditPerawat{{ $perawat->id }}"
        tabindex="-1"
        aria-labelledby="modalEditPerawatLabel{{ $perawat->id }}"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <div class="d-flex align-items-center gap-2">

                        <i class="fas fa-user-edit"></i>

                        <h5
                            class="modal-title"
                            id="modalEditPerawatLabel{{ $perawat->id }}"
                        >

                            Edit Perawat

                        </h5>

                    </div>


                    <button
                        type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>

                </div>


                {{-- FORM EDIT --}}

                <form
                    action="{{ route('master-perawat.update', $perawat->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">


                        {{-- NAMA --}}

                        <div class="form-group-perawat">

                            <label
                                for="edit_nama_{{ $perawat->id }}"
                                class="form-label-perawat"
                            >

                                Nama Perawat

                            </label>


                            <input
                                type="text"
                                id="edit_nama_{{ $perawat->id }}"
                                name="nama"
                                class="form-control-perawat"
                                value="{{ old('nama', $perawat->nama) }}"
                                placeholder="Masukkan nama perawat"
                                required
                            >

                        </div>


                        {{-- JENIS KELAMIN --}}

                        <div class="form-group-perawat">

                            <label
                                for="edit_jenis_kelamin_{{ $perawat->id }}"
                                class="form-label-perawat"
                            >

                                Jenis Kelamin

                            </label>


                            <select
                                id="edit_jenis_kelamin_{{ $perawat->id }}"
                                name="jenis_kelamin"
                                class="form-select-perawat"
                                required
                            >

                                <option
                                    value="laki-laki"
                                    {{ strtolower($perawat->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}
                                >

                                    Laki-laki

                                </option>


                                <option
                                    value="perempuan"
                                    {{ strtolower($perawat->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}
                                >

                                    Perempuan

                                </option>

                            </select>

                        </div>


                        {{-- TANGGAL LAHIR --}}

                        <div class="form-group-perawat">

                            <label
                                for="edit_tanggal_lahir_{{ $perawat->id }}"
                                class="form-label-perawat"
                            >

                                Tanggal Lahir

                            </label>


                            <input
                                type="date"
                                id="edit_tanggal_lahir_{{ $perawat->id }}"
                                name="tanggal_lahir"
                                class="form-control-perawat"
                                value="{{ $perawat->tanggal_lahir }}"
                                required
                            >

                        </div>


                        {{-- ALAMAT --}}

                        <div class="form-group-perawat mb-0">

                            <label
                                for="edit_alamat_{{ $perawat->id }}"
                                class="form-label-perawat"
                            >

                                Alamat

                            </label>


                            <textarea
                                id="edit_alamat_{{ $perawat->id }}"
                                name="alamat"
                                class="form-control-perawat"
                                rows="3"
                                placeholder="Ketikkan alamat lengkap..."
                                required
                            >{{ $perawat->alamat }}</textarea>

                        </div>

                    </div>


                    {{-- FOOTER --}}

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

@endforeach


@endsection
