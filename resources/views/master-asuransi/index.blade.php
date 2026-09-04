@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Asuransi')

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

    .master-asuransi {
        padding: 12px 0;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header-asuransi {
        margin-bottom: 22px;
    }

    .header-icon-box-asuransi {
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

    .page-title-asuransi {
        font-size: 22px;
        font-weight: 700;

        color: #1e293b;

        margin: 0;

        line-height: 1.2;
    }

    .page-subtitle-asuransi {
        font-size: 12px;

        color: #64748b;

        margin: 3px 0 0;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */

    .btn-blue-primary-asuransi {
        background-color: var(--blue-main) !important;

        border: none !important;

        color: #ffffff !important;

        border-radius: 8px;

        padding: 9px 15px;

        font-size: 13px;

        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary-asuransi:hover {
        background-color: var(--blue-dark) !important;

        color: #ffffff !important;

        transform: translateY(-1px);
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-asuransi {
        border: none;

        border-left: 3px solid var(--blue-main);

        border-radius: 10px;

        background-color: #ffffff;

        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);

        padding: 12px 15px;

        margin-bottom: 18px;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .card-table-asuransi {
        border: none !important;

        border-radius: 12px !important;

        overflow: hidden;

        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .table-asuransi {
        margin-bottom: 0;
    }


    .table-asuransi thead th {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        font-size: 13px;

        font-weight: 600;

        padding: 14px 16px;

        white-space: nowrap;
    }


    .table-asuransi tbody td {
        padding: 12px 16px;

        font-size: 13px;

        color: #475569;

        border-bottom: 1px solid #f1f5f9;

        vertical-align: middle;
    }


    .table-asuransi tbody tr {
        transition: 0.15s ease;
    }


    .table-asuransi tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }


    .table-asuransi tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       ASURANSI PROFILE
    ========================================================= */

    .asuransi-name {
        color: #1e293b;

        font-weight: 600;

        margin-bottom: 2px;
    }


    .asuransi-id {
        color: #94a3b8;

        font-size: 10px;
    }


    .avatar-asuransi {
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
       BADGE KODE
    ========================================================= */

    .badge-code-asuransi {
        background-color: #e0f2fe !important;

        color: #0284c7 !important;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 12px;

        border-radius: 6px;
    }


    /* =========================================================
       BADGE JENIS
    ========================================================= */

    .badge-jenis-asuransi {
        background-color: #e7f3ff !important;

        color: var(--blue-main) !important;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 12px;

        border-radius: 6px;
    }


    /* =========================================================
       ACTION BUTTON
    ========================================================= */

    .btn-action-view-asuransi {
        background-color: #e0f2fe !important;

        color: #0284c7 !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }


    .btn-action-view-asuransi:hover {
        background-color: #bae6fd !important;

        color: #0369a1 !important;
    }


    .btn-action-edit-asuransi {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }


    .btn-action-edit-asuransi:hover {
        background-color: var(--blue-dark) !important;

        color: #ffffff !important;
    }


    .btn-action-delete-asuransi {
        background-color: #ef4444 !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }


    .btn-action-delete-asuransi:hover {
        background-color: #dc2626 !important;

        color: #ffffff !important;
    }


    /* =========================================================
       MODAL
    ========================================================= */

    .modal-asuransi .modal-dialog {
        max-width: 460px;
    }


    .modal-asuransi .modal-content {
        border: none;

        border-radius: 14px;

        overflow: hidden;

        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }


    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-asuransi .modal-header {
        background-color: var(--blue-main);

        color: #ffffff;

        border: none;

        padding: 15px 18px;
    }


    .modal-asuransi .modal-title {
        font-size: 16px;

        font-weight: 700;
    }


    .modal-asuransi .modal-header .btn-close {
        filter: brightness(0) invert(1);

        opacity: 0.9;
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .modal-asuransi .modal-body {
        padding: 20px 18px;

        background-color: #ffffff;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .form-label-asuransi {
        display: block;

        font-size: 11px;

        font-weight: 600;

        color: #64748b;

        margin-bottom: 6px;
    }


    .form-control-asuransi,
    .form-select-asuransi {

        width: 100%;

        border: 1px solid #d7e0ea;

        border-radius: 8px;

        padding: 9px 11px;

        font-size: 12px;

        color: #334155;

        background-color: #ffffff;

        transition: 0.2s ease;
    }


    .form-control-asuransi:focus,
    .form-select-asuransi:focus {

        border-color: var(--blue-main);

        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12);

        outline: none;
    }


    .form-group-asuransi {
        margin-bottom: 13px;
    }


    /* =========================================================
       MODAL FOOTER
    ========================================================= */

    .modal-asuransi .modal-footer {

        background-color: #f8fafc;

        border: none;

        padding: 12px 18px;
    }


    .btn-modal-cancel-asuransi {

        background-color: #f1f5f9 !important;

        color: #64748b !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 15px;

        font-size: 12px;

        font-weight: 600;
    }


    .btn-modal-cancel-asuransi:hover {

        background-color: #e2e8f0 !important;
    }


    .btn-modal-save-asuransi {

        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 16px;

        font-size: 12px;

        font-weight: 600;
    }


    .btn-modal-save-asuransi:hover {

        background-color: var(--blue-dark) !important;
    }


    /* =========================================================
       DETAIL
    ========================================================= */

    .detail-asuransi-table {

        width: 100%;

        margin: 0;
    }


    .detail-asuransi-table td {

        padding: 9px 5px;

        border-bottom: 1px solid #f1f5f9;

        font-size: 12px;

        vertical-align: top;
    }


    .detail-asuransi-table tr:last-child td {

        border-bottom: none;
    }


    .detail-asuransi-label {

        width: 120px;

        color: #64748b;

        font-weight: 600;
    }


    .detail-asuransi-value {

        color: #1e293b;

        font-weight: 500;
    }


    /* =========================================================
       EMPTY DATA
    ========================================================= */

    .empty-asuransi {

        padding: 45px 20px !important;

        color: #94a3b8 !important;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .page-header-asuransi {

            flex-direction: column;

            align-items: flex-start !important;

            gap: 15px;
        }


        .btn-blue-primary-asuransi {

            width: 100%;
        }


        .table-asuransi {

            min-width: 700px;
        }


        .modal-asuransi .modal-dialog {

            max-width: calc(100% - 25px);

            margin: 12px auto;
        }

    }

</style>


<div class="container-fluid master-asuransi">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center page-header-asuransi">


        <div class="d-flex align-items-center gap-3">


            <div class="header-icon-box-asuransi">

                <i class="fas fa-shield-alt"></i>

            </div>


            <div>

                <h3 class="page-title-asuransi">

                    Master Asuransi

                </h3>


                <p class="page-subtitle-asuransi">

                    Data jenis asuransi yang tersedia

                </p>

            </div>

        </div>


        {{-- TOMBOL TAMBAH --}}

        <button
            type="button"
            class="btn btn-blue-primary-asuransi"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahAsuransi"
        >

            <i class="fas fa-plus me-1"></i>

            Tambah Asuransi

        </button>

    </div>


    {{-- =====================================================
         ALERT SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-asuransi">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         ALERT ERROR
    ====================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger alert-asuransi">

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

    <div class="card card-table-asuransi">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-asuransi align-middle">


                    <thead>

                        <tr>

                            <th
                                class="text-center"
                                width="50"
                            >
                                No
                            </th>


                            <th>
                                Kode
                            </th>


                            <th>
                                Jenis Asuransi
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


                        @forelse($asuransis as $asuransi)


                            <tr id="asuransi-{{ $asuransi->id }}">


                                {{-- NO --}}

                                <td class="text-center text-muted">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- KODE --}}

                                <td>

                                    <span class="badge badge-code-asuransi">

                                        {{ $asuransi->kode }}

                                    </span>

                                </td>


                                {{-- NAMA / JENIS --}}

                                <td>

                                    <div class="d-flex align-items-center gap-2">


                                        <div class="avatar-asuransi">

                                            <i class="fas fa-shield-alt"></i>

                                        </div>


                                        <div>

                                            <div class="asuransi-name">

                                                {{ $asuransi->nama }}

                                            </div>


                                            <div class="asuransi-id">

                                                ID: {{ $asuransi->id }}

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">


                                        {{-- LIHAT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view-asuransi"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatAsuransi{{ $asuransi->id }}"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat

                                        </button>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit-asuransi"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditAsuransi{{ $asuransi->id }}"
                                        >

                                            <i class="fas fa-edit me-1"></i>

                                            Edit

                                        </button>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('master-asuransi.destroy', $asuransi->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus asuransi {{ $asuransi->nama }}?')"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-action-delete-asuransi"
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
                                    colspan="4"
                                    class="text-center empty-asuransi"
                                >

                                    <i class="fas fa-shield-alt fa-2x mb-2 d-block"></i>

                                    Belum ada data asuransi.

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
     MODAL TAMBAH ASURANSI
========================================================= --}}

<div
    class="modal fade modal-asuransi"
    id="modalTambahAsuransi"
    tabindex="-1"
    aria-labelledby="modalTambahAsuransiLabel"
    aria-hidden="true"
>


    <div class="modal-dialog modal-dialog-centered">


        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">


                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-shield-alt"></i>


                    <h5
                        class="modal-title"
                        id="modalTambahAsuransiLabel"
                    >

                        Tambah Asuransi

                    </h5>

                </div>


                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('master-asuransi.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">


                    {{-- KODE --}}

                    <div class="form-group-asuransi">


                        <label
                            for="tambah_kode_asuransi"
                            class="form-label-asuransi"
                        >

                            Kode Asuransi

                        </label>


                        <input
                            type="text"
                            id="tambah_kode_asuransi"
                            name="kode"
                            class="form-control-asuransi"
                            placeholder="Contoh: ASR001"
                            value="{{ old('kode') }}"
                            required
                        >

                    </div>


                    {{-- JENIS ASURANSI --}}

                    <div class="form-group-asuransi mb-0">


                        <label
                            for="tambah_nama_asuransi"
                            class="form-label-asuransi"
                        >

                            Jenis Asuransi

                        </label>


                        <select
                            id="tambah_nama_asuransi"
                            name="nama"
                            class="form-select-asuransi"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Asuransi --
                            </option>


                            <option
                                value="Gigi"
                                {{ old('nama') == 'Gigi' ? 'selected' : '' }}
                            >
                                Gigi
                            </option>


                            <option
                                value="Rawat Inap"
                                {{ old('nama') == 'Rawat Inap' ? 'selected' : '' }}
                            >
                                Rawat Inap
                            </option>


                            <option
                                value="Penyakit Kritis"
                                {{ old('nama') == 'Penyakit Kritis' ? 'selected' : '' }}
                            >
                                Penyakit Kritis
                            </option>


                            <option
                                value="Rawat Jalan"
                                {{ old('nama') == 'Rawat Jalan' ? 'selected' : '' }}
                            >
                                Rawat Jalan
                            </option>

                        </select>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">


                    <button
                        type="button"
                        class="btn btn-modal-cancel-asuransi"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-modal-save-asuransi"
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
     MODAL LIHAT & EDIT
========================================================= --}}

@foreach($asuransis as $asuransi)


    {{-- =====================================================
         MODAL LIHAT
    ====================================================== --}}

    <div
        class="modal fade modal-asuransi"
        id="modalLihatAsuransi{{ $asuransi->id }}"
        tabindex="-1"
        aria-labelledby="modalLihatAsuransiLabel{{ $asuransi->id }}"
        aria-hidden="true"
    >


        <div class="modal-dialog modal-dialog-centered">


            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">


                    <div class="d-flex align-items-center gap-2">

                        <i class="fas fa-shield-alt"></i>


                        <h5
                            class="modal-title"
                            id="modalLihatAsuransiLabel{{ $asuransi->id }}"
                        >

                            Detail Asuransi

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


                    <table class="detail-asuransi-table">


                        <tr>

                            <td class="detail-asuransi-label">
                                ID
                            </td>

                            <td class="detail-asuransi-value">

                                {{ $asuransi->id }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-asuransi-label">
                                Kode
                            </td>

                            <td class="detail-asuransi-value">

                                {{ $asuransi->kode }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-asuransi-label">
                                Jenis Asuransi
                            </td>

                            <td class="detail-asuransi-value">

                                {{ $asuransi->nama }}

                            </td>

                        </tr>


                    </table>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">


                    <button
                        type="button"
                        class="btn btn-modal-cancel-asuransi"
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
    ====================================================== --}}

    <div
        class="modal fade modal-asuransi"
        id="modalEditAsuransi{{ $asuransi->id }}"
        tabindex="-1"
        aria-labelledby="modalEditAsuransiLabel{{ $asuransi->id }}"
        aria-hidden="true"
    >


        <div class="modal-dialog modal-dialog-centered">


            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">


                    <div class="d-flex align-items-center gap-2">

                        <i class="fas fa-edit"></i>


                        <h5
                            class="modal-title"
                            id="modalEditAsuransiLabel{{ $asuransi->id }}"
                        >

                            Edit Asuransi

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
                    action="{{ route('master-asuransi.update', $asuransi->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">


                        {{-- KODE --}}

                        <div class="form-group-asuransi">


                            <label
                                for="edit_kode_asuransi_{{ $asuransi->id }}"
                                class="form-label-asuransi"
                            >

                                Kode Asuransi

                            </label>


                            <input
                                type="text"
                                id="edit_kode_asuransi_{{ $asuransi->id }}"
                                name="kode"
                                class="form-control-asuransi"
                                value="{{ $asuransi->kode }}"
                                required
                            >

                        </div>


                        {{-- JENIS ASURANSI --}}

                        <div class="form-group-asuransi mb-0">


                            <label
                                for="edit_nama_asuransi_{{ $asuransi->id }}"
                                class="form-label-asuransi"
                            >

                                Jenis Asuransi

                            </label>


                            <select
                                id="edit_nama_asuransi_{{ $asuransi->id }}"
                                name="nama"
                                class="form-select-asuransi"
                                required
                            >


                                <option
                                    value="Gigi"
                                    {{ $asuransi->nama == 'Gigi' ? 'selected' : '' }}
                                >
                                    Gigi
                                </option>


                                <option
                                    value="Rawat Inap"
                                    {{ $asuransi->nama == 'Rawat Inap' ? 'selected' : '' }}
                                >
                                    Rawat Inap
                                </option>


                                <option
                                    value="Penyakit Kritis"
                                    {{ $asuransi->nama == 'Penyakit Kritis' ? 'selected' : '' }}
                                >
                                    Penyakit Kritis
                                </option>


                                <option
                                    value="Rawat Jalan"
                                    {{ $asuransi->nama == 'Rawat Jalan' ? 'selected' : '' }}
                                >
                                    Rawat Jalan
                                </option>


                            </select>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">


                        <button
                            type="button"
                            class="btn btn-modal-cancel-asuransi"
                            data-bs-dismiss="modal"
                        >

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-modal-save-asuransi"
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
