@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Pasien')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --blue-soft: #f0f7ff;
        --border: #dbe3ef;
    }

    body {
        background-color: #eef5ff !important;
    }

    .container-fluid {
        background-color: #eef5ff;
        width: 100%;
        min-height: auto !important;
        margin: 0 !important;
        padding: 12px 28px 25px !important;
    }

    /* ==============================
       HEADER
    ============================== */

    .page-header-pasien {
        background: linear-gradient(
            135deg,
            #1877f2,
            #0f58c6
        );
        border-radius: 14px;
        padding: 18px 22px;
        margin: 0 0 18px 0 !important;
        box-shadow: 0 5px 15px rgba(24, 119, 242, 0.18);
    }

    .header-icon-box {
        width: 46px;
        height: 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(255, 255, 255, 0.18);
        color: #ffffff;
        border-radius: 11px;
        font-size: 20px;
    }

    .page-header-pasien h3 {
        color: #ffffff !important;
        font-size: 20px;
    }

    .page-header-pasien p {
        color: rgba(255, 255, 255, 0.85) !important;
    }

    /* ==============================
       BUTTON TAMBAH
    ============================== */

    .btn-blue-primary {
        padding: 9px 16px;
        background-color: #ffffff !important;
        color: var(--blue-main) !important;
        border: none !important;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: 0.2s ease;
    }

    .btn-blue-primary:hover {
        background-color: #e7f3ff !important;
        color: var(--blue-dark) !important;
    }

    /* ==============================
       TABLE CARD
    ============================== */

    .card-table-custom {
        border: none !important;
        border-radius: 14px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 5px 18px rgba(24, 119, 242, 0.10) !important;
        margin: 0 !important;
    }

    .table-title-bar {
        padding: 15px 18px;
        background-color: #ffffff;
        border-bottom: 1px solid #e5edf8;
    }

    .table-title-bar .title {
        color: #1e293b;
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    .table-title-bar .subtitle {
        color: #64748b;
        font-size: 12px;
        margin: 2px 0 0;
    }

    /* ==============================
       TABLE
    ============================== */

    .table-custom {
        width: 100%;
        margin: 0 !important;
    }

    .table-custom thead th {
        padding: 14px 15px;
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-custom tbody td {
        padding: 13px 15px;
        border-bottom: 1px solid #e7eef7;
        vertical-align: middle;
        font-size: 12px;
    }

    .table-custom tbody tr {
        transition: 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* ==============================
       AVATAR
    ============================== */

    .avatar-icon-blue {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background-color: var(--blue-light);
        color: var(--blue-main);
        border-radius: 50%;
        font-size: 13px;
    }

    /* ==============================
       BADGE
    ============================== */

    .badge-pill-soft-red {
        padding: 6px 12px;
        background-color: #ffe9e9 !important;
        color: #d93838 !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-pill-soft-blue {
        padding: 6px 12px;
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-pill-soft-green {
        padding: 6px 12px;
        background-color: #dcfce7 !important;
        color: #15803d !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-pill-gray {
        padding: 6px 12px;
        background-color: #f1f5f9 !important;
        color: #64748b !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    /* ==============================
       ACTION BUTTON
    ============================== */

    .btn-action-view {
        padding: 6px 10px;
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-action-view:hover {
        background-color: #bae6fd !important;
        color: #0369a1 !important;
    }

    .btn-blue-edit {
        padding: 6px 10px;
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-blue-edit:hover {
        background-color: var(--blue-dark) !important;
    }

    .btn-blue-delete {
        padding: 6px 10px;
        background-color: #ef4444 !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-blue-delete:hover {
        background-color: #dc2626 !important;
    }

    /* ==============================
       MODAL
    ============================== */

    .modal-pasien .modal-dialog {
        max-width: 420px;
        margin: 1.75rem auto;
    }

    .modal-standard .modal-dialog {
        max-width: 430px;
        margin: 1.75rem auto;
    }

    .modal-pasien .modal-content,
    .modal-standard .modal-content {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18) !important;
    }

    .modal-header-blue {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 18px;
        background: linear-gradient(
            135deg,
            #1877f2,
            #0f58c6
        );
        color: #ffffff;
        border: none;
    }

    .modal-header-blue .title-wrapper {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .modal-header-blue .modal-title {
        margin: 0;
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
    }

    .modal-body-custom {
        padding: 18px;
        background-color: #ffffff;
    }

    .form-label {
        display: block;
        margin-bottom: 5px;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
    }

    .form-control-blue {
        width: 100%;
        min-height: 38px;
        padding: 7px 10px;
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 7px;
        color: #334155;
        font-size: 13px;
    }

    .form-control-blue:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12);
        outline: none;
    }

    textarea.form-control-blue {
        min-height: 70px;
        resize: vertical;
    }

    .modal-footer-custom {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
        padding: 12px 18px;
        background-color: #f4f8ff;
        border-top: 1px solid #e2ebf7;
    }

    .modal-footer-custom .btn {
        padding: 7px 15px;
        border-radius: 7px;
        font-size: 12px;
    }

    /* ==============================
       DETAIL
    ============================== */

    .detail-box {
        padding: 18px;
        background-color: #ffffff;
    }

    .detail-item {
        background-color: #f5f9ff;
        border: 1px solid #e2ecf8;
        border-radius: 9px;
        padding: 10px 12px;
    }

    .detail-label {
        display: block;
        color: #64748b;
        font-size: 10px;
        font-weight: 600;
        margin-bottom: 3px;
    }

    .detail-value {
        color: #1e293b;
        font-size: 13px;
        font-weight: 600;
    }

    /* ==============================
       SUCCESS
    ============================== */

    .success-modal-overlay {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 88, 198, 0.20);
        animation: successOverlayShow 0.2s ease;
    }

    .success-modal-box {
        width: 100%;
        max-width: 410px;
        padding: 32px 28px 28px;
        background: #ffffff;
        border-radius: 14px;
        text-align: center;
        box-shadow: 0 20px 50px rgba(24, 119, 242, 0.20);
        animation: successModalShow 0.3s ease;
    }

    .success-check {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border: 3px solid #bfdbfe;
        border-radius: 50%;
        color: var(--blue-main);
        font-size: 32px;
    }

    .success-title {
        margin: 0 0 8px;
        color: #1e293b;
        font-size: 23px;
        font-weight: 700;
    }

    .success-text {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }

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

    @media (max-width: 768px) {
        .container-fluid {
            padding: 12px !important;
        }

        .page-header-pasien {
            padding: 15px;
        }

        .page-header-pasien h3 {
            font-size: 18px;
        }

        .table-custom thead th,
        .table-custom tbody td {
            padding: 10px;
        }

        .modal-pasien .modal-dialog,
        .modal-standard .modal-dialog {
            max-width: calc(100% - 24px);
            margin: 12px auto;
        }
    }
</style>


{{-- =========================================================
     MAIN CONTENT
========================================================= --}}

<div class="container-fluid">

    {{-- ================= HEADER ================= --}}

    <div class="page-header-pasien">

        <div class="d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-3">

                <div class="header-icon-box">
                    <i class="fas fa-user-injured"></i>
                </div>

                <div>
                    <h3 class="fw-bold mb-0">
                        Data Pasien
                    </h3>

                    <p class="small mb-0">
                        Data pasien yang terdaftar
                    </p>
                </div>

            </div>


            {{-- TAMBAH HANYA ADMIN & SUPER ADMIN --}}

            @if(
                auth()->user()->hasRole('super admin') ||
                auth()->user()->hasRole('admin rumah sakit')
            )

                <button
                    type="button"
                    class="btn btn-blue-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahPasien"
                >
                    <i class="fas fa-plus me-1"></i>
                    Tambah Pasien
                </button>

            @endif

        </div>

    </div>


    {{-- ================= TABLE ================= --}}

    <div class="card card-table-custom">

        <div class="table-title-bar">

            <p class="title">
                <i class="fas fa-users me-2 text-primary"></i>
                Daftar Pasien
            </p>

            <p class="subtitle">
                Informasi pasien yang sudah terdaftar di rumah sakit
            </p>

        </div>


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


                                {{-- GOLONGAN DARAH --}}

                                <td>

                                    <span class="badge badge-pill-soft-red">
                                        {{ strtoupper($pasien->golongan_darah) }}
                                    </span>

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- LIHAT SEMUA ROLE --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatPasien{{ $pasien->id }}"
                                        >
                                            <i class="fas fa-eye me-1"></i>
                                            Lihat
                                        </button>


                                        {{-- EDIT & HAPUS ADMIN SAJA --}}

                                        @if(
                                            auth()->user()->hasRole('super admin') ||
                                            auth()->user()->hasRole('admin rumah sakit')
                                        )

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

                                        @endif

                                    </div>

                                </td>

                            </tr>

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
     SEMUA MODAL DILETAKKAN DI LUAR TABLE
========================================================= --}}


@foreach($pasiens as $pasien)

    {{-- =====================================================
         MODAL LIHAT
    ====================================================== --}}

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


                <div class="detail-box">

                    <div class="row g-2">

                        <div class="col-12">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Nama Pasien
                                </span>

                                <span class="detail-value">
                                    {{ $pasien->nama }}
                                </span>

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Jenis Kelamin
                                </span>

                                <span class="detail-value">
                                    {{ ucfirst($pasien->jenis_kelamin) }}
                                </span>

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Tanggal Lahir
                                </span>

                                <span class="detail-value">
                                    {{ $pasien->tanggal_lahir }}
                                </span>

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Status Asuransi
                                </span>

                                <span class="detail-value">

                                    {{
                                        $pasien->status_asuransi === '01'
                                            ? 'Memiliki Asuransi'
                                            : 'Tidak Memiliki Asuransi'
                                    }}

                                </span>

                            </div>

                        </div>


                        <div class="col-6">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Golongan Darah
                                </span>

                                <span class="detail-value">
                                    {{ strtoupper($pasien->golongan_darah) }}
                                </span>

                            </div>

                        </div>


                        <div class="col-12">

                            <div class="detail-item">

                                <span class="detail-label">
                                    Alamat
                                </span>

                                <span class="detail-value">
                                    {{ $pasien->alamat }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer border-0 px-4 pb-4">

                    <button
                        type="button"
                        class="btn text-white fw-medium px-4 py-2 rounded-3 border-0"
                        style="background-color: #1877f2;"
                        data-bs-dismiss="modal"
                    >
                        Tutup
                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         MODAL EDIT
         ADMIN & SUPER ADMIN SAJA
    ====================================================== --}}

    @if(
        auth()->user()->hasRole('super admin') ||
        auth()->user()->hasRole('admin rumah sakit')
    )

        <div
            class="modal fade modal-pasien"
            id="modalEditPasien{{ $pasien->id }}"
            tabindex="-1"
            aria-hidden="true"
        >

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header-blue">

                        <div class="title-wrapper">

                            <i class="fas fa-user-edit"></i>

                            <h5 class="modal-title">
                                Edit Pasien
                            </h5>

                        </div>

                    </div>


                    <form
                        action="{{ route('master-pasien.update', $pasien->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        <div class="modal-body-custom">

                            <div class="row g-2">

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


                                <div class="col-12">

                                    <label class="form-label">
                                        Alamat
                                    </label>

                                    <textarea
                                        name="alamat"
                                        class="form-control form-control-blue"
                                        rows="2"
                                        required
                                    >{{ old('alamat', $pasien->alamat) }}</textarea>

                                </div>


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
                                style="background-color: #1877f2 !important; color: #fff !important;"
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
        ================================================== --}}

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

    @endif

@endforeach



{{-- =========================================================
     MODAL TAMBAH PASIEN
     ADMIN & SUPER ADMIN SAJA
========================================================= --}}

@if(
    auth()->user()->hasRole('super admin') ||
    auth()->user()->hasRole('admin rumah sakit')
)

    <div
        class="modal fade modal-pasien"
        id="modalTambahPasien"
        tabindex="-1"
        aria-labelledby="modalTambahPasienLabel"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

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
                            style="background-color: #1877f2 !important; color: #fff !important;"
                        >

                            <i class="fas fa-save me-1"></i>
                            Simpan Data

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endif



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



{{-- SUCCESS SCRIPT --}}

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



{{-- VALIDATION ERROR --}}

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
