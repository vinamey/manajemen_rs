@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Tindakan')

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

    .master-tindakan {
        padding: 12px 0;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header-tindakan {
        margin-bottom: 22px;
    }

    .header-icon-box-tindakan {
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

    .page-title-tindakan {
        font-size: 22px;
        font-weight: 700;

        color: #1e293b;

        margin: 0;

        line-height: 1.2;
    }

    .page-subtitle-tindakan {
        font-size: 12px;

        color: #64748b;

        margin: 3px 0 0;
    }


    /* =========================================================
       BUTTON TAMBAH
    ========================================================= */

    .btn-blue-primary-tindakan {
        background-color: var(--blue-main) !important;

        border: none !important;

        color: #ffffff !important;

        border-radius: 8px;

        padding: 9px 15px;

        font-size: 13px;

        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary-tindakan:hover {
        background-color: var(--blue-dark) !important;

        color: #ffffff !important;

        transform: translateY(-1px);
    }


    /* =========================================================
       ALERT
    ========================================================= */

    .alert-tindakan {
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

    .card-table-tindakan {
        border: none !important;

        border-radius: 12px !important;

        overflow: hidden;

        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .table-tindakan {
        margin-bottom: 0;
    }


    /* =========================================================
       TABLE HEADER
    ========================================================= */

    .table-tindakan thead th {
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

    .table-tindakan tbody td {
        padding: 12px 16px;

        font-size: 13px;

        color: #475569;

        border-bottom: 1px solid #f1f5f9;

        vertical-align: middle;
    }

    .table-tindakan tbody tr {
        transition: 0.15s ease;
    }

    .table-tindakan tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }

    .table-tindakan tbody tr:last-child td {
        border-bottom: none;
    }


    /* =========================================================
       TINDAKAN PROFILE
    ========================================================= */

    .tindakan-name {
        color: #1e293b;

        font-weight: 600;

        margin-bottom: 2px;
    }

    .tindakan-id {
        color: #94a3b8;

        font-size: 10px;
    }


    .avatar-tindakan {
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

    .badge-code-tindakan {
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

    .btn-action-view-tindakan {
        background-color: #e0f2fe !important;

        color: #0284c7 !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-view-tindakan:hover {
        background-color: #bae6fd !important;

        color: #0369a1 !important;
    }


    .btn-action-edit-tindakan {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-edit-tindakan:hover {
        background-color: var(--blue-dark) !important;

        color: #ffffff !important;
    }


    .btn-action-delete-tindakan {
        background-color: #ef4444 !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 6px;

        font-size: 11px;

        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-delete-tindakan:hover {
        background-color: #dc2626 !important;

        color: #ffffff !important;
    }


    /* =========================================================
       MODAL
    ========================================================= */

    .modal-tindakan .modal-dialog {
        max-width: 460px;
    }

    .modal-tindakan .modal-content {
        border: none;

        border-radius: 14px;

        overflow: hidden;

        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }


    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-tindakan .modal-header {
        background-color: var(--blue-main);

        color: #ffffff;

        border: none;

        padding: 15px 18px;
    }

    .modal-tindakan .modal-title {
        font-size: 16px;

        font-weight: 700;
    }

    .modal-tindakan .modal-header .btn-close {
        filter: brightness(0) invert(1);

        opacity: 0.9;
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .modal-tindakan .modal-body {
        padding: 20px 18px;

        background-color: #ffffff;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .form-label-tindakan {
        display: block;

        font-size: 11px;

        font-weight: 600;

        color: #64748b;

        margin-bottom: 6px;
    }

    .form-control-tindakan {
        width: 100%;

        border: 1px solid #d7e0ea;

        border-radius: 8px;

        padding: 9px 11px;

        font-size: 12px;

        color: #334155;

        background-color: #ffffff;

        transition: 0.2s ease;
    }

    .form-control-tindakan:focus {
        border-color: var(--blue-main);

        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12);

        outline: none;
    }

    .form-group-tindakan {
        margin-bottom: 13px;
    }


    /* =========================================================
       MODAL FOOTER
    ========================================================= */

    .modal-tindakan .modal-footer {
        background-color: #f8fafc;

        border: none;

        padding: 12px 18px;
    }


    .btn-modal-cancel-tindakan {
        background-color: #f1f5f9 !important;

        color: #64748b !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 15px;

        font-size: 12px;

        font-weight: 600;
    }

    .btn-modal-cancel-tindakan:hover {
        background-color: #e2e8f0 !important;
    }


    .btn-modal-save-tindakan {
        background-color: var(--blue-main) !important;

        color: #ffffff !important;

        border: none !important;

        border-radius: 7px;

        padding: 8px 16px;

        font-size: 12px;

        font-weight: 600;
    }

    .btn-modal-save-tindakan:hover {
        background-color: var(--blue-dark) !important;
    }


    /* =========================================================
       DETAIL
    ========================================================= */

    .detail-tindakan-table {
        width: 100%;

        margin: 0;
    }

    .detail-tindakan-table td {
        padding: 9px 5px;

        border-bottom: 1px solid #f1f5f9;

        font-size: 12px;

        vertical-align: top;
    }

    .detail-tindakan-table tr:last-child td {
        border-bottom: none;
    }

    .detail-tindakan-label {
        width: 120px;

        color: #64748b;

        font-weight: 600;
    }

    .detail-tindakan-value {
        color: #1e293b;

        font-weight: 500;
    }


    /* =========================================================
       EMPTY DATA
    ========================================================= */

    .empty-tindakan {
        padding: 45px 20px !important;

        color: #94a3b8 !important;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .page-header-tindakan {
            flex-direction: column;

            align-items: flex-start !important;

            gap: 15px;
        }

        .btn-blue-primary-tindakan {
            width: 100%;
        }

        .table-tindakan {
            min-width: 700px;
        }

        .modal-tindakan .modal-dialog {
            max-width: calc(100% - 25px);

            margin: 12px auto;
        }
    }

</style>


<div class="container-fluid master-tindakan">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center page-header-tindakan">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box-tindakan">

                <i class="fas fa-notes-medical"></i>

            </div>


            <div>

                <h3 class="page-title-tindakan">

                    Master Tindakan

                </h3>


                <p class="page-subtitle-tindakan">

                    Data tindakan yang tersedia

                </p>

            </div>

        </div>


        {{-- TOMBOL TAMBAH --}}

        <button
            type="button"
            class="btn btn-blue-primary-tindakan"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahTindakan"
        >

            <i class="fas fa-plus me-1"></i>

            Tambah Tindakan

        </button>

    </div>


    {{-- =====================================================
         ALERT SUCCESS
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-tindakan">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =====================================================
         ALERT ERROR
    ====================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger alert-tindakan">

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

    <div class="card card-table-tindakan">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-tindakan align-middle">

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
                                Nama Tindakan
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

                        @forelse($tindakans as $tindakan)

                            <tr id="tindakan-{{ $tindakan->id }}">


                                {{-- NO --}}

                                <td class="text-center text-muted">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- KODE --}}

                                <td>

                                    <span class="badge badge-code-tindakan">

                                        {{ $tindakan->kode }}

                                    </span>

                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="avatar-tindakan">

                                            <i class="fas fa-notes-medical"></i>

                                        </div>


                                        <div>

                                            <div class="tindakan-name">

                                                {{ $tindakan->nama }}

                                            </div>


                                            <div class="tindakan-id">

                                                ID: {{ $tindakan->id }}

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
                                            class="btn btn-sm btn-action-view-tindakan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatTindakan{{ $tindakan->id }}"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat

                                        </button>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit-tindakan"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditTindakan{{ $tindakan->id }}"
                                        >

                                            <i class="fas fa-edit me-1"></i>

                                            Edit

                                        </button>


                                        {{-- HAPUS --}}

                                        <form
                                            action="{{ route('master-tindakan.destroy', $tindakan->id) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus tindakan {{ $tindakan->nama }}?')"
                                        >

                                            @csrf

                                            @method('DELETE')


                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-action-delete-tindakan"
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
                                    class="text-center empty-tindakan"
                                >

                                    <i class="fas fa-notes-medical fa-2x mb-2 d-block"></i>

                                    Belum ada data tindakan.

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
     MODAL TAMBAH TINDAKAN
========================================================= --}}

<div
    class="modal fade modal-tindakan"
    id="modalTambahTindakan"
    tabindex="-1"
    aria-labelledby="modalTambahTindakanLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-notes-medical"></i>

                    <h5
                        class="modal-title"
                        id="modalTambahTindakanLabel"
                    >

                        Tambah Tindakan

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
                action="{{ route('master-tindakan.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">


                    {{-- KODE --}}

                    <div class="form-group-tindakan">

                        <label
                            for="tambah_kode"
                            class="form-label-tindakan"
                        >

                            Kode Tindakan

                        </label>


                        <input
                            type="text"
                            id="tambah_kode"
                            name="kode"
                            class="form-control-tindakan"
                            placeholder="Masukkan kode tindakan"
                            value="{{ old('kode') }}"
                            required
                        >

                    </div>


                    {{-- NAMA --}}

                    <div class="form-group-tindakan mb-0">

                        <label
                            for="tambah_nama"
                            class="form-label-tindakan"
                        >

                            Nama Tindakan

                        </label>


                        <input
                            type="text"
                            id="tambah_nama"
                            name="nama"
                            class="form-control-tindakan"
                            placeholder="Masukkan nama tindakan"
                            value="{{ old('nama') }}"
                            required
                        >

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel-tindakan"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-modal-save-tindakan"
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

@foreach($tindakans as $tindakan)


    {{-- =====================================================
         MODAL LIHAT
    ====================================================== --}}

    <div
        class="modal fade modal-tindakan"
        id="modalLihatTindakan{{ $tindakan->id }}"
        tabindex="-1"
        aria-labelledby="modalLihatTindakanLabel{{ $tindakan->id }}"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <div class="d-flex align-items-center gap-2">

                        <i class="fas fa-notes-medical"></i>

                        <h5
                            class="modal-title"
                            id="modalLihatTindakanLabel{{ $tindakan->id }}"
                        >

                            Detail Tindakan

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

                    <table class="detail-tindakan-table">


                        <tr>

                            <td class="detail-tindakan-label">
                                ID
                            </td>

                            <td class="detail-tindakan-value">

                                {{ $tindakan->id }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-tindakan-label">
                                Kode
                            </td>

                            <td class="detail-tindakan-value">

                                {{ $tindakan->kode }}

                            </td>

                        </tr>


                        <tr>

                            <td class="detail-tindakan-label">
                                Nama Tindakan
                            </td>

                            <td class="detail-tindakan-value">

                                {{ $tindakan->nama }}

                            </td>

                        </tr>


                    </table>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel-tindakan"
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
        class="modal fade modal-tindakan"
        id="modalEditTindakan{{ $tindakan->id }}"
        tabindex="-1"
        aria-labelledby="modalEditTindakanLabel{{ $tindakan->id }}"
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
                            id="modalEditTindakanLabel{{ $tindakan->id }}"
                        >

                            Edit Tindakan

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
                    action="{{ route('master-tindakan.update', $tindakan->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    <div class="modal-body">


                        {{-- KODE --}}

                        <div class="form-group-tindakan">

                            <label
                                for="edit_kode_{{ $tindakan->id }}"
                                class="form-label-tindakan"
                            >

                                Kode Tindakan

                            </label>


                            <input
                                type="text"
                                id="edit_kode_{{ $tindakan->id }}"
                                name="kode"
                                class="form-control-tindakan"
                                value="{{ $tindakan->kode }}"
                                required
                            >

                        </div>


                        {{-- NAMA --}}

                        <div class="form-group-tindakan mb-0">

                            <label
                                for="edit_nama_{{ $tindakan->id }}"
                                class="form-label-tindakan"
                            >

                                Nama Tindakan

                            </label>


                            <input
                                type="text"
                                id="edit_nama_{{ $tindakan->id }}"
                                name="nama"
                                class="form-control-tindakan"
                                value="{{ $tindakan->nama }}"
                                required
                            >

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-modal-cancel-tindakan"
                            data-bs-dismiss="modal"
                        >

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn btn-modal-save-tindakan"
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
