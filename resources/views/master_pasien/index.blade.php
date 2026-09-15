@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Pasien')

@section('content')

<style>
    /* =========================================================
       COLOR
    ========================================================= */

    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --blue-soft: #f0f7ff;
        --border: #dbe3ef;
    }


    /* =========================================================
       TABLE CARD
    ========================================================= */

    .card-table-custom {
        border: none !important;
        border-radius: 12px;
        overflow: hidden;

        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }


    /* =========================================================
       PAGE HEADER
    ========================================================= */

    .header-icon-box {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        background-color: var(--blue-light);
        color: var(--blue-main);

        border-radius: 10px;

        font-size: 18px;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .table-custom thead th {
        padding: 14px 16px;

        background-color: var(--blue-main) !important;
        color: #ffffff !important;

        border: none !important;

        font-size: 13px;
        font-weight: 600;

        white-space: nowrap;
    }

    .table-custom tbody td {
        padding: 12px 16px;

        border-bottom: 1px solid #f1f5f9;

        vertical-align: middle;
    }

    .table-custom tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }


    /* =========================================================
       AVATAR
    ========================================================= */

    .avatar-icon-blue {
        width: 32px;
        height: 32px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;

        background-color: var(--blue-light);
        color: var(--blue-main);

        border-radius: 50%;

        font-size: 13px;
    }


    /* =========================================================
       BADGE
    ========================================================= */

    .badge-pill-soft-red {
        padding: 6px 14px;

        background-color: #ffeccc !important;
        color: #d93838 !important;

        border-radius: 6px;

        font-weight: 500;
    }

    .badge-pill-soft-blue {
        padding: 6px 14px;

        background-color: #e0f2fe !important;
        color: #0284c7 !important;

        border-radius: 6px;

        font-weight: 500;
    }

    .badge-pill-soft-green {
        padding: 6px 14px;

        background-color: #dcfce7 !important;
        color: #15803d !important;

        border-radius: 6px;

        font-weight: 500;
    }

    .badge-pill-gray {
        padding: 6px 14px;

        background-color: #f1f5f9 !important;
        color: #64748b !important;

        border-radius: 6px;

        font-weight: 500;
    }


    /* =========================================================
       BUTTON
    ========================================================= */

    .btn-blue-primary {
        padding: 8px 15px;

        background-color: var(--blue-main) !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 8px;

        font-size: 13px;
        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
    }


    /* =========================================================
       ACTION BUTTON
    ========================================================= */

    .btn-action-view {
        padding: 5px 10px;

        background-color: #e0f2fe !important;
        color: #0284c7 !important;

        border: none !important;
        border-radius: 6px;

        font-size: 12px;
    }

    .btn-action-view:hover {
        background-color: #bae6fd !important;
    }

    .btn-blue-edit {
        padding: 5px 10px;

        background-color: var(--blue-main) !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 6px;

        font-size: 12px;
    }

    .btn-blue-edit:hover {
        background-color: var(--blue-dark) !important;
    }

    .btn-blue-delete {
        padding: 5px 10px;

        background-color: #ef4444 !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 6px;

        font-size: 12px;
    }

    .btn-blue-delete:hover {
        background-color: #dc2626 !important;
    }


    /* =========================================================
       MODAL TAMBAH & EDIT
    ========================================================= */

    .modal-pasien .modal-dialog {
        max-width: 420px;
        margin: 1.75rem auto;
    }

    .modal-pasien .modal-content {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.18) !important;
    }


    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-header-blue {
        width: 100%;

        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;

        padding: 14px 18px;

        background-color: var(--blue-main);
        color: #ffffff;

        border: none;
    }

    .modal-header-blue .title-wrapper {
        display: flex;
        align-items: center;

        gap: 8px;
    }

    .modal-header-blue .title-wrapper i {
        font-size: 15px;
    }

    .modal-header-blue .modal-title {
        margin: 0;

        color: #ffffff;

        font-size: 15px;
        font-weight: 700;
    }

    .modal-header-blue .btn-close {
        margin: 0 !important;
        padding: 6px;

        flex-shrink: 0;
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .modal-pasien .modal-body-custom {
        padding: 18px;
    }

    .modal-pasien .form-label {
        display: block;

        margin-bottom: 5px;

        color: #64748b;

        font-size: 11px;
        font-weight: 600;
    }

    .modal-pasien .form-control-blue {
        width: 100%;
        min-height: 38px;

        padding: 7px 10px;

        background-color: #ffffff;

        border: 1px solid #cbd5e1;
        border-radius: 7px;

        color: #334155;

        font-size: 13px;

        transition: 0.2s ease;
    }

    .modal-pasien .form-control-blue:focus {
        border-color: var(--blue-main);

        box-shadow:
            0 0 0 3px rgba(24, 119, 242, 0.12);

        outline: none;
    }

    .modal-pasien textarea.form-control-blue {
        min-height: 70px;

        resize: vertical;
    }


    /* =========================================================
       MODAL FOOTER
    ========================================================= */

    .modal-pasien .modal-footer-custom {
        display: flex;
        align-items: center;
        justify-content: flex-end;

        gap: 8px;

        padding: 12px 18px;

        background-color: #f8fafc;

        border-top: 1px solid #eef2f7;
    }

    .modal-pasien .modal-footer-custom .btn {
        padding: 7px 15px;

        border-radius: 7px;

        font-size: 12px;
    }


    /* =========================================================
       MODAL DETAIL & HAPUS
    ========================================================= */

    .modal-standard .modal-content {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;

        box-shadow:
            0 15px 40px rgba(0, 0, 0, 0.18) !important;
    }

    .modal-standard .modal-header-blue {
        padding: 15px 18px;
    }


    /* =========================================================
       SUCCESS POPUP
    ========================================================= */

    .success-modal-overlay {
        position: fixed;

        inset: 0;

        z-index: 99999;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 20px;

        background: rgba(0, 0, 0, 0.42);

        animation: successOverlayShow 0.2s ease;
    }

    .success-modal-box {
        width: 100%;
        max-width: 410px;

        padding: 32px 28px 28px;

        background: #ffffff;

        border-radius: 5px;

        text-align: center;

        box-shadow:
            0 20px 50px rgba(0, 0, 0, 0.20);

        animation: successModalShow 0.3s ease;
    }

    .success-check {
        width: 70px;
        height: 70px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin: 0 auto 26px;

        border: 3px solid #d9efcf;

        border-radius: 50%;

        color: #9bdc7b;

        font-size: 36px;
    }

    .success-check i {
        font-size: 36px;
    }

    .success-title {
        margin: 0 0 10px;

        color: #555555;

        font-size: 24px;
        font-weight: 600;
    }

    .success-text {
        margin: 0;

        color: #666666;

        font-size: 15px;
        line-height: 1.5;
    }


    /* =========================================================
       ANIMATION
    ========================================================= */

    @keyframes successOverlayShow {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes successModalShow {
        from {
            opacity: 0;
            transform: scale(0.92);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 576px) {

        .modal-pasien .modal-dialog {
            max-width: calc(100% - 24px);

            margin: 12px auto;
        }

        .modal-pasien .modal-body-custom {
            padding: 16px;
        }

        .success-modal-box {
            max-width: 350px;
        }
    }
</style>


{{-- =========================================================
     MAIN CONTENT
========================================================= --}}

<div class="container-fluid py-3">


    {{-- =====================================================
         HEADER
    ===================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box">
                <i class="fas fa-user-injured"></i>
            </div>

            <div>

                <h3 class="fw-bold mb-0 text-dark">
                    Data Pasien
                </h3>

                <p class="text-muted small mb-0">
                    Data pasien yang terdaftar
                </p>

            </div>

        </div>


        {{-- BUTTON TAMBAH --}}

        <button
            type="button"
            class="btn btn-blue-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPasien"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Pasien
        </button>

    </div>


    {{-- =====================================================
         TABLE
    ===================================================== --}}

    <div class="card card-table-custom">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-custom align-middle mb-0">

                    <thead>

                        <tr>

                            <th
                                class="text-center"
                                width="50"
                            >
                                No
                            </th>

                            <th>
                                Nama Pasien
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

                            <th>
                                Asuransi
                            </th>

                            <th>
                                Gol. Darah
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

                        @forelse($pasiens as $pasien)

                            <tr>

                                {{-- NO --}}

                                <td class="text-center text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="avatar-icon-blue">
                                            <i class="fas fa-user"></i>
                                        </div>

                                        <div>

                                            <div class="fw-bold text-dark">
                                                {{ $pasien->nama }}
                                            </div>

                                            <small
                                                class="text-muted"
                                                style="font-size: 11px;"
                                            >
                                                ID: {{ $pasien->id }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS KELAMIN --}}

                                <td>

                                    @if($pasien->jenis_kelamin === 'laki-laki')

                                        <span class="badge badge-pill-soft-blue">
                                            Laki-laki
                                        </span>

                                    @else

                                        <span class="badge badge-pill-soft-red">
                                            Perempuan
                                        </span>

                                    @endif

                                </td>


                                {{-- TANGGAL LAHIR --}}

                                <td class="text-secondary small">
                                    {{ $pasien->tanggal_lahir }}
                                </td>


                                {{-- ALAMAT --}}

                                <td class="text-secondary small">
                                    {{ $pasien->alamat }}
                                </td>


                                {{-- ASURANSI --}}

                                <td>

                                    @if($pasien->status_asuransi === '01')

                                        <span class="badge badge-pill-soft-green">
                                            Memiliki Asuransi
                                        </span>

                                    @else

                                        <span class="badge badge-pill-gray">
                                            Tidak Memiliki Asuransi
                                        </span>

                                    @endif

                                </td>


                                <td>

                                    <span class="badge badge-pill-soft-red">
                                        {{ strtoupper($pasien->golongan_darah) }}
                                    </span>

                                </td>


                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">


                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatPasien{{ $pasien->id }}"
                                        >
                                            <i class="fas fa-eye me-1"></i>
                                            Lihat
                                        </button>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-blue-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPasien{{ $pasien->id }}"
                                        >
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </button>




                                        <button
                                            type="button"
                                            class="btn btn-sm btn-blue-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalHapusPasien{{ $pasien->id }}"
                                        >
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus
                                        </button>

                                    </div>

                                </td>

                            </tr>



                            <div
                                class="modal fade modal-standard"
                                id="modalLihatPasien{{ $pasien->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <div class="modal-header-blue">

                                            <div class="title-wrapper">

                                                <i class="fas fa-user"></i>

                                                <h5 class="modal-title">
                                                    Detail Pasien
                                                </h5>

                                            </div>

                                        </div>


                                        <div class="p-4">

                                            <div class="row g-3">

                                                <div class="col-12 border-bottom pb-2">

                                                    <small class="text-muted d-block fw-semibold mb-1">
                                                        Nama Pasien
                                                    </small>

                                                    <span class="fw-bold text-dark">
                                                        {{ $pasien->nama }}
                                                    </span>

                                                </div>


                                                <div class="col-6 border-bottom pb-2">

                                                    <small class="text-muted d-block fw-semibold mb-1">
                                                        Jenis Kelamin
                                                    </small>

                                                    <span class="text-dark">
                                                        {{ ucfirst($pasien->jenis_kelamin) }}
                                                    </span>

                                                </div>


                                                <div class="col-6 border-bottom pb-2">

                                                    <small class="text-muted d-block fw-semibold mb-1">
                                                        Tanggal Lahir
                                                    </small>

                                                    <span class="text-dark">
                                                        {{ $pasien->tanggal_lahir }}
                                                    </span>

                                                </div>


                                                <div class="col-6 border-bottom pb-2">

                                                    <small class="text-muted d-block fw-semibold mb-1">
                                                        Status Asuransi
                                                    </small>

                                                    <span class="text-dark">

                                                        {{
                                                            $pasien->status_asuransi === '01'
                                                                ? 'Memiliki Asuransi'
                                                                : 'Tidak Memiliki Asuransi'
                                                        }}

                                                    </span>

                                                </div>


                                                <div class="col-6 border-bottom pb-2">

                                                    <small class="text-muted d-block fw-semibold mb-1">
                                                        Golongan Darah
                                                    </small>

                                                    <span class="text-dark fw-bold">
                                                        {{ strtoupper($pasien->golongan_darah) }}
                                                    </span>

                                                </div>


                                                <div class="col-12">

                                                    <small class="text-muted d-block fw-semibold mb-1">
                                                        Alamat
                                                    </small>

                                                    <div class="text-dark">
                                                        {{ $pasien->alamat }}
                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="modal-footer border-0 pt-0 px-4 pb-4">
                  <button type="button"
                        class="btn text-white fw-medium px-4 py-2 rounded-3 border-0"
                        style="background-color: #1d72f3;"
                        data-bs-dismiss="modal">
                    Tutup
                </button>

            </div>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 MODAL EDIT
                            ================================================= --}}

                            <div
                                class="modal fade modal-pasien"
                                id="modalEditPasien{{ $pasien->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        {{-- HEADER --}}

                                        <div class="modal-header-blue">

                                            <div class="title-wrapper">

                                                <i class="fas fa-user-edit"></i>

                                                <h5 class="modal-title">
                                                    Edit Pasien
                                                </h5>

                                            </div>


                                        </div>


                                        {{-- FORM --}}

                                        <form
                                            action="{{ route('master-pasien.update', $pasien->id) }}"
                                            method="POST"
                                        >

                                            @csrf
                                            @method('PUT')


                                            <div class="modal-body-custom">

                                                <div class="row g-2">

                                                    {{-- NAMA --}}

                                                    <div class="col-12">

                                                        <label class="form-label">
                                                            Nama Pasien
                                                        </label>

                                                        <input
                                                            type="text"
                                                            name="nama"
                                                            class="form-control form-control-blue"
                                                            value="{{ old('nama', $pasien->nama) }}"
                                                            required
                                                        >

                                                    </div>


                                                    {{-- JENIS KELAMIN --}}

                                                    <div class="col-12">

                                                        <label class="form-label">
                                                            Jenis Kelamin
                                                        </label>

                                                        <select
                                                            name="jenis_kelamin"
                                                            class="form-select form-control-blue"
                                                            required
                                                        >

                                                            <option
                                                                value="laki-laki"
                                                                {{ $pasien->jenis_kelamin === 'laki-laki' ? 'selected' : '' }}
                                                            >
                                                                Laki-laki
                                                            </option>

                                                            <option
                                                                value="perempuan"
                                                                {{ $pasien->jenis_kelamin === 'perempuan' ? 'selected' : '' }}
                                                            >
                                                                Perempuan
                                                            </option>

                                                        </select>

                                                    </div>


                                                    {{-- TANGGAL LAHIR --}}

                                                    <div class="col-12">

                                                        <label class="form-label">
                                                            Tanggal Lahir
                                                        </label>

                                                        <input
                                                            type="date"
                                                            name="tanggal_lahir"
                                                            class="form-control form-control-blue"
                                                            value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}"
                                                            required
                                                        >

                                                    </div>


                                                    {{-- ALAMAT --}}

                                                    <div class="col-12">

                                                        <label class="form-label">
                                                            Alamat
                                                        </label>

                                                        <textarea
                                                            name="alamat"
                                                            class="form-control form-control-blue"
                                                            rows="2"
                                                            placeholder="Ketikkan alamat lengkap..."
                                                            required
                                                        >{{ old('alamat', $pasien->alamat) }}</textarea>

                                                    </div>


                                                    {{-- STATUS ASURANSI --}}

                                                    <div class="col-12">

                                                        <label class="form-label">
                                                            Status Asuransi
                                                        </label>

                                                        <select
                                                            name="status_asuransi"
                                                            class="form-select form-control-blue"
                                                            required
                                                        >

                                                            <option
                                                                value="01"
                                                                {{ $pasien->status_asuransi === '01' ? 'selected' : '' }}
                                                            >
                                                                Ya
                                                            </option>

                                                            <option
                                                                value="0"
                                                                {{ $pasien->status_asuransi === '0' ? 'selected' : '' }}
                                                            >
                                                                Tidak
                                                            </option>

                                                        </select>

                                                    </div>


                                                    {{-- GOLONGAN DARAH --}}

                                                    <div class="col-12">

                                                        <label class="form-label">
                                                            Golongan Darah
                                                        </label>

                                                        <select
                                                            name="golongan_darah"
                                                            class="form-select form-control-blue"
                                                            required
                                                        >

                                                            <option
                                                                value="A"
                                                                {{ $pasien->golongan_darah === 'A' ? 'selected' : '' }}
                                                            >
                                                                A
                                                            </option>

                                                            <option
                                                                value="B"
                                                                {{ $pasien->golongan_darah === 'B' ? 'selected' : '' }}
                                                            >
                                                                B
                                                            </option>

                                                            <option
                                                                value="AB"
                                                                {{ $pasien->golongan_darah === 'AB' ? 'selected' : '' }}
                                                            >
                                                                AB
                                                            </option>

                                                            <option
                                                                value="O"
                                                                {{ $pasien->golongan_darah === 'O' ? 'selected' : '' }}
                                                            >
                                                                O
                                                            </option>

                                                        </select>

                                                    </div>

                                                </div>

                                            </div>


                                            {{-- FOOTER --}}

                                            <div class="modal-footer-custom">

                                                <button
                                                    type="button"
                                                    class="btn btn-light"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Batal
                                                </button>

                                                <button
                                                    type="submit"
                                                    class="btn btn-blue-primary"
                                                >
                                                    <i class="fas fa-save me-1"></i>
                                                    Update Data
                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                 MODAL HAPUS
                            ================================================= --}}

                            <div
                                class="modal fade modal-standard"
                                id="modalHapusPasien{{ $pasien->id }}"
                                tabindex="-1"
                                aria-hidden="true"
                            >

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <div class="modal-header bg-danger text-white">

                                            <div class="d-flex align-items-center gap-2">

                                                <i class="fas fa-trash"></i>

                                                <h5 class="modal-title fw-bold mb-0">
                                                    Konfirmasi Hapus
                                                </h5>

                                            </div>


                                        </div>


                                        <div class="modal-body p-4 text-center">

                                            <i
                                                class="fas fa-exclamation-triangle text-danger mb-3"
                                                style="font-size: 40px;"
                                            ></i>

                                            <p class="mb-0">

                                                Apakah kamu yakin ingin menghapus data pasien

                                                <strong>
                                                    {{ $pasien->nama }}
                                                </strong>?

                                            </p>

                                        </div>


                                        <div class="modal-footer bg-light border-0 justify-content-center">

                                            <button
                                                type="button"
                                                class="btn btn-light px-4"
                                                data-bs-dismiss="modal"
                                            >
                                                Batal
                                            </button>

                                            <form
                                                action="{{ route('master-pasien.destroy', $pasien->id) }}"
                                                method="POST"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger px-4"
                                                >
                                                    <i class="fas fa-trash me-1"></i>
                                                    Ya, Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5 text-muted"
                                >

                                    <i class="fas fa-users-slash fa-2x mb-2 d-block"></i>

                                    Belum Ada Data Pasien

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- PAGINATION --}}

    @if(method_exists($pasiens, 'links'))

        <div class="mt-3">
            {{ $pasiens->links() }}
        </div>

    @endif

</div>


{{-- =========================================================
     MODAL TAMBAH PASIEN
========================================================= --}}

<div
    class="modal fade modal-pasien"
    id="modalTambahPasien"
    tabindex="-1"
    aria-labelledby="modalTambahPasienLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}

            <div class="modal-header-blue">

                <div class="title-wrapper">

                    <i class="fas fa-user-plus"></i>

                    <h5
                        class="modal-title"
                        id="modalTambahPasienLabel"
                    >
                        Tambah Pasien
                    </h5>

                </div>

               

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('master-pasien.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body-custom">

                    <div class="row g-2">

                        {{-- NAMA --}}

                        <div class="col-12">

                            <label
                                for="nama"
                                class="form-label"
                            >
                                Nama Pasien
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-control form-control-blue @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama pasien"
                                required
                            >

                            @error('nama')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- JENIS KELAMIN --}}

                        <div class="col-12">

                            <label
                                for="jenis_kelamin"
                                class="form-label"
                            >
                                Jenis Kelamin
                            </label>

                            <select
                                id="jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-select form-control-blue @error('jenis_kelamin') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    -- Pilih Jenis Kelamin --
                                </option>

                                <option
                                    value="laki-laki"
                                    {{ old('jenis_kelamin') === 'laki-laki' ? 'selected' : '' }}
                                >
                                    Laki-laki
                                </option>

                                <option
                                    value="perempuan"
                                    {{ old('jenis_kelamin') === 'perempuan' ? 'selected' : '' }}
                                >
                                    Perempuan
                                </option>

                            </select>

                            @error('jenis_kelamin')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- TANGGAL LAHIR --}}

                        <div class="col-12">

                            <label
                                for="tanggal_lahir"
                                class="form-label"
                            >
                                Tanggal Lahir
                            </label>

                            <input
                                type="date"
                                id="tanggal_lahir"
                                name="tanggal_lahir"
                                class="form-control form-control-blue @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir') }}"
                                required
                            >

                            @error('tanggal_lahir')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- ALAMAT --}}

                        <div class="col-12">

                            <label
                                for="alamat"
                                class="form-label"
                            >
                                Alamat
                            </label>

                            <textarea
                                id="alamat"
                                name="alamat"
                                class="form-control form-control-blue @error('alamat') is-invalid @enderror"
                                rows="2"
                                placeholder="Ketikkan alamat lengkap..."
                                required
                            >{{ old('alamat') }}</textarea>

                            @error('alamat')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- STATUS ASURANSI --}}

                        <div class="col-12">

                            <label
                                for="status_asuransi"
                                class="form-label"
                            >
                                Status Asuransi
                            </label>

                            <select
                                id="status_asuransi"
                                name="status_asuransi"
                                class="form-select form-control-blue @error('status_asuransi') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    -- Pilih Status Asuransi --
                                </option>

                                <option
                                    value="01"
                                    {{ old('status_asuransi') === '01' ? 'selected' : '' }}
                                >
                                    Ya
                                </option>

                                <option
                                    value="0"
                                    {{ old('status_asuransi') === '0' ? 'selected' : '' }}
                                >
                                    Tidak
                                </option>

                            </select>

                            @error('status_asuransi')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- GOLONGAN DARAH --}}

                        <div class="col-12">

                            <label
                                for="golongan_darah"
                                class="form-label"
                            >
                                Golongan Darah
                            </label>

                            <select
                                id="golongan_darah"
                                name="golongan_darah"
                                class="form-select form-control-blue @error('golongan_darah') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    -- Pilih Golongan Darah --
                                </option>

                                <option
                                    value="A"
                                    {{ old('golongan_darah') === 'A' ? 'selected' : '' }}
                                >
                                    A
                                </option>

                                <option
                                    value="B"
                                    {{ old('golongan_darah') === 'B' ? 'selected' : '' }}
                                >
                                    B
                                </option>

                                <option
                                    value="AB"
                                    {{ old('golongan_darah') === 'AB' ? 'selected' : '' }}
                                >
                                    AB
                                </option>

                                <option
                                    value="O"
                                    {{ old('golongan_darah') === 'O' ? 'selected' : '' }}
                                >
                                    O
                                </option>

                            </select>

                            @error('golongan_darah')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer-custom">

                    <button
                        type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-blue-primary"
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
     SUCCESS POPUP
========================================================= --}}

@if(session('success'))

    <div
        class="success-modal-overlay"
        id="successModal"
    >

        <div class="success-modal-box">

            <div class="success-check">

                <i class="fas fa-check"></i>

            </div>

            <h2 class="success-title">
                Berhasil!
            </h2>

            <p class="success-text">
                {{ session('success') }}
            </p>

        </div>

    </div>

@endif


{{-- =========================================================
     SUCCESS POPUP SCRIPT
========================================================= --}}

@if(session('success'))

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const successModal =
            document.getElementById('successModal');

        if (!successModal) {
            return;
        }

        setTimeout(function () {

            successModal.style.transition =
                'opacity 0.25s ease';

            successModal.style.opacity = '0';

            setTimeout(function () {
                successModal.remove();
            }, 250);

        }, 2000);

    });
</script>

@endif


{{-- =========================================================
     VALIDATION ERROR
========================================================= --}}

@if($errors->any())

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const modalElement =
            document.getElementById('modalTambahPasien');

        if (modalElement) {

            const modal =
                new bootstrap.Modal(modalElement);

            modal.show();
        }

    });
</script>

@endif


@endsection
