@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Dokter')

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

    .master-dokter {
        padding: 12px 0 30px;
    }


    /* =========================================================
       HEADER
    ========================================================= */

    .page-header-dokter {
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

    .page-title-dokter {
        font-size: 22px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        line-height: 1.2;
    }

    .page-subtitle-dokter {
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

    .alert-dokter {
        border: none;
        border-left: 3px solid var(--blue-main);
        border-radius: 10px;
        background-color: #ffffff;
        box-shadow:
            0 3px 12px rgba(0, 0, 0, 0.05);
        padding: 12px 15px;
        margin-bottom: 18px;
        font-size: 13px;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .card-table-dokter {
        border: none !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow:
            0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .table-dokter {
        margin-bottom: 0;
    }

    .table-dokter thead th {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        font-size: 13px;
        font-weight: 600;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .table-dokter tbody td {
        padding: 12px 16px;
        font-size: 13px;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-dokter tbody tr {
        transition: all 0.15s ease;
    }

    .table-dokter tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }


    /* =========================================================
       DOKTER NAME
    ========================================================= */

    .doctor-name {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .doctor-id {
        color: #94a3b8;
        font-size: 10px;
    }

    .avatar-dokter {
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

    .badge-green-soft {
        background-color: #dcfce7 !important;
        color: #15803d !important;
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
       MODAL TAMBAH / EDIT DOKTER
    ========================================================= */

    .modal-dokter .modal-dialog {
        width: calc(100% - 30px) !important;
        max-width: 430px !important;
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
        max-width: 430px !important;
        margin: auto !important;
        border: none !important;
        border-radius: 14px !important;
        overflow: visible !important;
        box-shadow:
            0 15px 40px rgba(15, 23, 42, 0.18) !important;
    }


    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-dokter .modal-header {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 15px 18px !important;
        border-radius: 14px 14px 0 0 !important;
    }

    .modal-dokter .modal-title {
        font-size: 15px !important;
        font-weight: 700 !important;
        margin: 0 !important;
    }


    /* =========================================================
       MODAL BODY
    ========================================================= */

    .modal-dokter .modal-body {
        padding: 20px 18px !important;
        background-color: #ffffff !important;
        overflow: visible !important;
    }


    /* =========================================================
       FORM
    ========================================================= */

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
        box-shadow:
            0 0 0 3px rgba(24, 119, 242, 0.12) !important;
        outline: none !important;
    }

    textarea.form-control-dokter {
        height: auto !important;
        min-height: 78px !important;
        resize: vertical !important;
    }


    /* =========================================================
       SELECT2 POLI
    ========================================================= */

    .select2-container {
        width: 100% !important;
        max-width: 100% !important;
    }

    .select2-container--default
    .select2-selection--single {
        width: 100% !important;
        height: 38px !important;
        min-height: 38px !important;
        box-sizing: border-box !important;
        border: 1px solid #d7e0ea !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        padding: 0 11px !important;
        position: relative !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        width: 100% !important;
        color: #334155 !important;
        font-size: 12px !important;
        line-height: 36px !important;
        padding: 0 28px 0 0 !important;
        margin: 0 !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__placeholder {
        color: #94a3b8 !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        width: 20px !important;
        height: 36px !important;
        top: 1px !important;
        right: 7px !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow b {
        border-color:
            #64748b
            transparent
            transparent
            transparent !important;
    }


    /* =========================================================
       SELECT2 SAAT DIBUKA
    ========================================================= */

    .select2-container--default.select2-container--open
    .select2-selection--single {
        border-color: var(--blue-main) !important;
        box-shadow:
            0 0 0 3px rgba(24, 119, 242, 0.12) !important;
    }


    /* =========================================================
       DROPDOWN SELECT2
    ========================================================= */

    .select2-container--default
    .select2-dropdown {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        border: 1px solid var(--blue-main) !important;
        border-radius: 8px !important;
        background-color: #ffffff !important;
        box-shadow:
            0 5px 15px rgba(15, 23, 42, 0.12) !important;
        overflow: hidden !important;
        z-index: 999999 !important;
    }


    /* =========================================================
       SEARCH SELECT2
    ========================================================= */

    .select2-search--dropdown {
        padding: 7px !important;
        background-color: #ffffff !important;
    }

    .select2-search--dropdown
    .select2-search__field {
        width: 100% !important;
        height: 30px !important;
        box-sizing: border-box !important;
        border: 1px solid #d7e0ea !important;
        border-radius: 6px !important;
        padding: 5px 8px !important;
        font-size: 11px !important;
        color: #334155 !important;
        outline: none !important;
    }

    .select2-search--dropdown
    .select2-search__field:focus {
        border-color: var(--blue-main) !important;
        box-shadow:
            0 0 0 2px rgba(24, 119, 242, 0.10) !important;
    }


    /* =========================================================
       LIST POLI
    ========================================================= */

    .select2-results {
        overflow: hidden !important;
    }

    .select2-results__options {
        max-height: 125px !important;
        overflow-y: auto !important;
        padding: 0 !important;
    }

    .select2-results__option {
        padding: 8px 10px !important;
        font-size: 11px !important;
        line-height: 1.4 !important;
        color: #334155 !important;
        background-color: #ffffff !important;
        cursor: pointer !important;
    }

    .select2-results__option--highlighted[aria-selected] {
        background-color: #e7f3ff !important;
        color: var(--blue-main) !important;
    }

    .select2-results__option[aria-selected="true"] {
        background-color: #e7f3ff !important;
        color: var(--blue-main) !important;
    }


    /* =========================================================
       SCROLLBAR
    ========================================================= */

    .select2-results__options::-webkit-scrollbar {
        width: 6px !important;
    }

    .select2-results__options::-webkit-scrollbar-track {
        background: #f1f5f9 !important;
    }

    .select2-results__options::-webkit-scrollbar-thumb {
        background: #94a3b8 !important;
        border-radius: 10px !important;
    }


    /* =========================================================
       KHUSUS SELECT2 DALAM MODAL
    ========================================================= */

    #modalTambahDokter .select2-container,
    #modalEditDokter .select2-container {
        width: 100% !important;
        max-width: 100% !important;
    }

    #modalTambahDokter .select2-dropdown,
    #modalEditDokter .select2-dropdown {
        width: 100% !important;
        min-width: 100% !important;
        max-width: 100% !important;
    }


    /* =========================================================
       MODAL FOOTER
    ========================================================= */

    .modal-dokter .modal-footer {
        background-color: #f8fafc !important;
        border: none !important;
        padding: 12px 18px !important;
        border-radius: 0 0 14px 14px !important;
    }

</style>


{{-- =========================================================
     LIBRARY
========================================================= --}}

<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>


{{-- =========================================================
     CONTENT
========================================================= --}}

<div class="container-fluid master-dokter">

    {{-- HEADER --}}

    <div class="d-flex justify-content-between align-items-center page-header-dokter">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box">
                <i class="fas fa-user-md"></i>
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


    {{-- SUCCESS --}}

    @if(session('success'))

        <div class="alert alert-dokter">

            <i class="fas fa-check-circle me-2 text-success"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- TABLE --}}

    <div class="card card-table-dokter">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-dokter align-middle">

                    <thead>

                        <tr>

                            <th width="50" class="text-center">
                                No
                            </th>

                            <th>
                                Nama Dokter
                            </th>

                            <th>
                                Jenis Kelamin
                            </th>

                            <th>
                                Tanggal Lahir
                            </th>

                            <th>
                                Spesialis
                            </th>

                            <th>
                                Alamat
                            </th>

                            <th>
                                Poli
                            </th>

                            <th width="220" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="tabelDokter">

                        @forelse($dokters as $dokter)

                            @php

                                $poliDokter = $polis->firstWhere(
                                    'id',
                                    $dokter->poli_id
                                );

                            @endphp


                            <tr id="dokter-{{ $dokter->id }}">

                                {{-- NO --}}

                                <td class="text-center nomor text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="avatar-dokter">
                                            <i class="fas fa-user-md"></i>
                                        </div>

                                        <div>

                                            <div class="doctor-name data-nama">
                                                {{ $dokter->nama }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS KELAMIN --}}

                                <td>

                                    <span class="badge badge-blue-soft data-jenis-kelamin">

                                        @if($dokter->jenis_kelamin === 'laki-laki')
                                            Laki-laki
                                        @else
                                            Perempuan
                                        @endif

                                    </span>

                                </td>


                                {{-- TANGGAL LAHIR --}}

                                <td>

                                    <span class="data-tanggal-lahir">
                                        {{ $dokter->tanggal_lahir }}
                                    </span>

                                </td>


                                {{-- SPESIALIS --}}

                                <td>

                                    <span class="data-spesialis">
                                        {{ $dokter->spesialis ?? '-' }}
                                    </span>

                                </td>


                                {{-- ALAMAT --}}

                                <td>

                                    <span class="data-alamat">
                                        {{ $dokter->alamat ?? '-' }}
                                    </span>

                                </td>


                                {{-- POLI --}}

                                <td>

                                    <span class="badge badge-green-soft data-poli">
                                        {{ $poliDokter->nama ?? '-' }}
                                    </span>

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- LIHAT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-view btn-view"

                                            data-id="{{ $dokter->id }}"
                                            data-nama="{{ $dokter->nama }}"
                                            data-jenis_kelamin="{{ $dokter->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $dokter->tanggal_lahir }}"
                                            data-spesialis="{{ $dokter->spesialis }}"
                                            data-alamat="{{ $dokter->alamat }}"
                                            data-poli="{{ $poliDokter->nama ?? '-' }}"
                                        >

                                            <i class="fas fa-eye me-1"></i>
                                            Lihat

                                        </button>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit btn-edit"

                                            data-id="{{ $dokter->id }}"
                                            data-nama="{{ $dokter->nama }}"
                                            data-jenis_kelamin="{{ $dokter->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $dokter->tanggal_lahir }}"
                                            data-spesialis="{{ $dokter->spesialis }}"
                                            data-alamat="{{ $dokter->alamat }}"
                                            data-poli_id="{{ $dokter->poli_id }}"
                                        >

                                            <i class="fas fa-edit me-1"></i>
                                            Edit

                                        </button>


                                        {{-- HAPUS --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete btn-hapus"

                                            data-id="{{ $dokter->id }}"
                                            data-nama="{{ $dokter->nama }}"
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
                                    colspan="8"
                                    class="text-center empty-dokter"
                                >

                                    <i class="fas fa-user-md fa-2x mb-2 d-block"></i>

                                    Belum ada data dokter.

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
     MODAL TAMBAH DOKTER
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

            {{-- HEADER --}}

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-plus"></i>

                    <h5
                        class="modal-title"
                        id="modalTambahDokterLabel"
                    >
                        Tambah Dokter
                    </h5>

                </div>

            </div>


            {{-- FORM --}}

            <form id="formTambahDokter">

                @csrf

                <div class="modal-body">

                    {{-- NAMA DOKTER --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_nama"
                            class="form-label-dokter"
                        >
                            Nama Dokter
                        </label>

                        <input
                            type="text"
                            id="tambah_nama"
                            name="nama"
                            class="form-control-dokter"
                            placeholder="Masukkan nama dokter"
                            required
                        >

                    </div>


                    {{-- JENIS KELAMIN --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_jenis_kelamin"
                            class="form-label-dokter"
                        >
                            Jenis Kelamin
                        </label>

                        <select
                            id="tambah_jenis_kelamin"
                            name="jenis_kelamin"
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


                    {{-- TANGGAL LAHIR --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_tanggal_lahir"
                            class="form-label-dokter"
                        >
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="tambah_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >

                    </div>


                    {{-- SPESIALIS --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_spesialis"
                            class="form-label-dokter"
                        >
                            Spesialis
                        </label>

                        <input
                            type="text"
                            id="tambah_spesialis"
                            name="spesialis"
                            class="form-control-dokter"
                            placeholder="Masukkan spesialis"
                        >

                    </div>


                    {{-- ALAMAT --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_alamat"
                            class="form-label-dokter"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="tambah_alamat"
                            name="alamat"
                            class="form-control-dokter"
                            rows="3"
                            placeholder="Ketikkan alamat lengkap..."
                        ></textarea>

                    </div>


                    {{-- POLI SELECT2 --}}

                    <div class="form-group-dokter mb-0">

                        <label
                            for="tambah_poli_id"
                            class="form-label-dokter"
                        >
                            Poli
                        </label>

                        <select
                            id="tambah_poli_id"
                            name="poli_id"
                            class="select2-poli"
                            required
                        >

                            <option value=""></option>

                            @foreach($polis as $poli)

                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama }}
                                </option>

                            @endforeach

                        </select>

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
     MODAL EDIT DOKTER
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

                    <i class="fas fa-user-edit"></i>

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

                    {{-- NAMA --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_nama"
                            class="form-label-dokter"
                        >
                            Nama Dokter
                        </label>

                        <input
                            type="text"
                            id="edit_nama"
                            name="nama"
                            class="form-control-dokter"
                            required
                        >

                    </div>


                    {{-- JENIS KELAMIN --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_jenis_kelamin"
                            class="form-label-dokter"
                        >
                            Jenis Kelamin
                        </label>

                        <select
                            id="edit_jenis_kelamin"
                            name="jenis_kelamin"
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


                    {{-- TANGGAL LAHIR --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_tanggal_lahir"
                            class="form-label-dokter"
                        >
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="edit_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >

                    </div>


                    {{-- SPESIALIS --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_spesialis"
                            class="form-label-dokter"
                        >
                            Spesialis
                        </label>

                        <input
                            type="text"
                            id="edit_spesialis"
                            name="spesialis"
                            class="form-control-dokter"
                        >

                    </div>


                    {{-- ALAMAT --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_alamat"
                            class="form-label-dokter"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="edit_alamat"
                            name="alamat"
                            class="form-control-dokter"
                            rows="3"
                        ></textarea>

                    </div>


                    {{-- POLI --}}

                    <div class="form-group-dokter mb-0">

                        <label
                            for="edit_poli_id"
                            class="form-label-dokter"
                        >
                            Poli
                        </label>

                        <select
                            id="edit_poli_id"
                            name="poli_id"
                            class="form-select-dokter select2-poli"
                        >

                            <option value=""></option>

                            @foreach($polis as $poli)

                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama }}
                                </option>

                            @endforeach

                        </select>

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
     MODAL LIHAT
========================================================= --}}

<div
    class="modal fade modal-dokter"
    id="modalLihatDokter"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content detail-modal-dokter">

            <div class="modal-header detail-header-dokter">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user"></i>

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
                        class="detail-value-dokter fw-bold"
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


            <div class="modal-footer detail-footer-dokter">

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


{{-- =========================================================
     JQUERY
========================================================= --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


{{-- =========================================================
     SELECT2
========================================================= --}}

<script
    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
</script>


<script>

document.addEventListener('DOMContentLoaded', function () {


    /* =====================================================
       SELECT2 POLI TAMBAH
    ===================================================== */

    $('#tambah_poli_id').select2({

        dropdownParent: $('#modalTambahDokter'),

        width: '100%',

        placeholder: 'Pilih Poli',

        allowClear: false,

        minimumResultsForSearch: 0,

        dropdownAutoWidth: false

    });


    /* =====================================================
       SELECT2 POLI EDIT
    ===================================================== */

    $('#edit_poli_id').select2({

        dropdownParent: $('#modalEditDokter'),

        width: '100%',

        placeholder: 'Pilih Poli',

        allowClear: false,

        minimumResultsForSearch: 0,

        dropdownAutoWidth: false

    });


    /* =====================================================
       CSRF
    ===================================================== */

    const csrfInput = document.querySelector(
        '#formTambahDokter input[name="_token"]'
    );

    const csrfToken = csrfInput
        ? csrfInput.value
        : '';


    /* =====================================================
       URL
    ===================================================== */

    const storeUrl = @json(
        route('master-dokter.store')
    );

    const baseUrl = @json(
        url('master-dokter')
    );


    /* =====================================================
       FORM TAMBAH
    ===================================================== */

    const formTambah =
        document.getElementById(
            'formTambahDokter'
        );


    formTambah.addEventListener(
        'submit',
        function (e) {

            e.preventDefault();


            const button =
                document.getElementById(
                    'btnSimpanTambah'
                );


            button.disabled = true;

            button.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';


            const formData =
                new FormData(formTambah);


            fetch(storeUrl, {

                method: 'POST',

                headers: {

                    'X-CSRF-TOKEN':
                        csrfToken,

                    'Accept':
                        'application/json',

                    'X-Requested-With':
                        'XMLHttpRequest'

                },

                body: formData

            })

            .then(async response => {

                const contentType =
                    response.headers.get(
                        'content-type'
                    ) || '';


                if (
                    contentType.includes(
                        'application/json'
                    )
                ) {

                    const data =
                        await response.json();


                    if (!response.ok) {
                        throw data;
                    }


                    return data;

                }


                throw {

                    message:
                        'Server mengembalikan halaman HTML. Status: ' +
                        response.status

                };

            })

            .then(data => {

                const modalElement =
                    document.getElementById(
                        'modalTambahDokter'
                    );


                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );


                if (modal) {
                    modal.hide();
                }


                formTambah.reset();


                $('#tambah_poli_id')
                    .val('')
                    .trigger('change');


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
                        'Data dokter berhasil ditambahkan.',

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
       EVENT EDIT AWAL
    ===================================================== */

    document
        .querySelectorAll('.btn-edit')
        .forEach(button => {

            pasangEventEdit(button);

        });


    /* =====================================================
       EVENT LIHAT AWAL
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
            'formEditDokter'
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

                        'X-CSRF-TOKEN':
                            csrfToken,

                        'Accept':
                            'application/json',

                        'X-Requested-With':
                            'XMLHttpRequest'

                    },

                    body: formData

                }
            )

            .then(async response => {

                const contentType =
                    response.headers.get(
                        'content-type'
                    ) || '';


                if (
                    contentType.includes(
                        'application/json'
                    )
                ) {

                    const data =
                        await response.json();


                    if (!response.ok) {
                        throw data;
                    }


                    return data;

                }


                throw {

                    message:
                        'Server mengembalikan HTML. Status: ' +
                        response.status

                };

            })

            .then(data => {

                updateBarisTabel(
                    data.data
                );


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


                Swal.fire({

                    icon: 'success',

                    title: 'Berhasil!',

                    text:
                        data.message ||
                        'Data dokter berhasil diperbarui.',

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
       EVENT HAPUS AWAL
    ===================================================== */

    document
        .querySelectorAll('.btn-hapus')
        .forEach(button => {

            pasangEventHapus(button);

        });


    /* =====================================================
       TAMBAH BARIS
    ===================================================== */

    function tambahBarisKeTabel(dokter) {

        const tabel =
            document.getElementById(
                'tabelDokter'
            );


        let namaPoli = '-';


        @foreach($polis as $poli)

            if (
                dokter.poli_id ==
                {{ $poli->id }}
            ) {

                namaPoli =
                    @json($poli->nama);

            }

        @endforeach


        const row =
            document.createElement('tr');


        row.id =
            'dokter-' + dokter.id;


        row.innerHTML = `

            <td class="text-center nomor text-muted">
                1
            </td>


            <td>

                <div class="d-flex align-items-center gap-2">

                    <div class="avatar-dokter">
                        <i class="fas fa-user-md"></i>
                    </div>

                    <div>

                        <div class="doctor-name data-nama">
                            ${escapeHtml(dokter.nama)}
                        </div>

                    </div>

                </div>

            </td>


            <td>

                <span class="badge badge-blue-soft data-jenis-kelamin">

                    ${ucfirst(dokter.jenis_kelamin)}

                </span>

            </td>


            <td>

                <span class="data-tanggal-lahir">

                    ${escapeHtml(dokter.tanggal_lahir)}

                </span>

            </td>


            <td>

                <span class="data-spesialis">

                    ${escapeHtml(
                        dokter.spesialis || '-'
                    )}

                </span>

            </td>


            <td>

                <span class="data-alamat">

                    ${escapeHtml(
                        dokter.alamat || '-'
                    )}

                </span>

            </td>


            <td>

                <span class="badge badge-green-soft data-poli">

                    ${escapeHtml(namaPoli)}

                </span>

            </td>


            <td class="text-center">

                <div class="d-flex justify-content-center gap-1">

                    <button
                        type="button"
                        class="btn btn-sm btn-action-view btn-view"

                        data-id="${escapeAttr(dokter.id)}"
                        data-nama="${escapeAttr(dokter.nama)}"
                        data-jenis_kelamin="${escapeAttr(dokter.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(dokter.tanggal_lahir)}"
                        data-spesialis="${escapeAttr(dokter.spesialis || '')}"
                        data-alamat="${escapeAttr(dokter.alamat || '')}"
                        data-poli="${escapeAttr(namaPoli)}"
                    >

                        <i class="fas fa-eye me-1"></i>
                        Lihat

                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-action-edit btn-edit"

                        data-id="${escapeAttr(dokter.id)}"
                        data-nama="${escapeAttr(dokter.nama)}"
                        data-jenis_kelamin="${escapeAttr(dokter.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(dokter.tanggal_lahir)}"
                        data-spesialis="${escapeAttr(dokter.spesialis || '')}"
                        data-alamat="${escapeAttr(dokter.alamat || '')}"
                        data-poli_id="${escapeAttr(dokter.poli_id || '')}"
                    >

                        <i class="fas fa-edit me-1"></i>
                        Edit

                    </button>


                    <button
                        type="button"
                        class="btn btn-sm btn-action-delete btn-hapus"

                        data-id="${escapeAttr(dokter.id)}"
                        data-nama="${escapeAttr(dokter.nama)}"
                    >

                        <i class="fas fa-trash me-1"></i>
                        Hapus

                    </button>

                </div>

            </td>

        `;


        tabel.prepend(row);


        pasangEventEdit(
            row.querySelector('.btn-edit')
        );


        pasangEventLihat(
            row.querySelector('.btn-view')
        );


        pasangEventHapus(
            row.querySelector('.btn-hapus')
        );

    }


    /* =====================================================
       UPDATE BARIS
    ===================================================== */

    function updateBarisTabel(dokter) {

        const row =
            document.getElementById(
                'dokter-' + dokter.id
            );


        if (!row) {
            return;
        }


        let namaPoli = '-';


        @foreach($polis as $poli)

            if (
                dokter.poli_id ==
                {{ $poli->id }}
            ) {

                namaPoli =
                    @json($poli->nama);

            }

        @endforeach


        row.querySelector(
            '.data-nama'
        ).innerText =
            dokter.nama;


        row.querySelector(
            '.data-jenis-kelamin'
        ).innerText =
            ucfirst(
                dokter.jenis_kelamin
            );


        row.querySelector(
            '.data-tanggal-lahir'
        ).innerText =
            dokter.tanggal_lahir;


        row.querySelector(
            '.data-spesialis'
        ).innerText =
            dokter.spesialis || '-';


        row.querySelector(
            '.data-alamat'
        ).innerText =
            dokter.alamat || '-';


        row.querySelector(
            '.data-poli'
        ).innerText =
            namaPoli;


        const editButton =
            row.querySelector(
                '.btn-edit'
            );


        if (editButton) {

            editButton.dataset.nama =
                dokter.nama;

            editButton.dataset.jenis_kelamin =
                dokter.jenis_kelamin;

            editButton.dataset.tanggal_lahir =
                dokter.tanggal_lahir;

            editButton.dataset.spesialis =
                dokter.spesialis || '';

            editButton.dataset.alamat =
                dokter.alamat || '';

            editButton.dataset.poli_id =
                dokter.poli_id || '';

        }


        const viewButton =
            row.querySelector(
                '.btn-view'
            );


        if (viewButton) {

            viewButton.dataset.nama =
                dokter.nama;

            viewButton.dataset.jenis_kelamin =
                dokter.jenis_kelamin;

            viewButton.dataset.tanggal_lahir =
                dokter.tanggal_lahir;

            viewButton.dataset.spesialis =
                dokter.spesialis || '';

            viewButton.dataset.alamat =
                dokter.alamat || '';

            viewButton.dataset.poli =
                namaPoli;

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
                    'lihat_spesialis'
                ).innerText =
                    this.dataset.spesialis || '-';


                document.getElementById(
                    'lihat_poli'
                ).innerText =
                    this.dataset.poli || '-';


                document.getElementById(
                    'lihat_alamat'
                ).innerText =
                    this.dataset.alamat || '-';


                const modalElement =
                    document.getElementById(
                        'modalLihatDokter'
                    );


                const modal =
                    new bootstrap.Modal(
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
                    'edit_spesialis'
                ).value =
                    this.dataset.spesialis || '';


                document.getElementById(
                    'edit_alamat'
                ).value =
                    this.dataset.alamat || '';


                $('#edit_poli_id')
                    .val(
                        this.dataset.poli_id || ''
                    )
                    .trigger('change');


                const modalElement =
                    document.getElementById(
                        'modalEditDokter'
                    );


                const modal =
                    new bootstrap.Modal(
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
                        'Hapus dokter?',

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

                            method:
                                'DELETE',

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

                            const contentType =
                                response.headers.get(
                                    'content-type'
                                ) || '';


                            if (
                                contentType.includes(
                                    'application/json'
                                )
                            ) {

                                const data =
                                    await response.json();


                                if (!response.ok) {
                                    throw data;
                                }


                                return data;

                            }


                            throw {

                                message:
                                    'Server mengembalikan HTML. Status: ' +
                                    response.status

                            };

                        }
                    )

                    .then(data => {

                        const row =
                            document.getElementById(
                                'dokter-' + id
                            );


                        if (row) {
                            row.remove();
                        }


                        perbaruiNomor();


                        const jumlahBaris =
                            document.querySelectorAll(
                                '#tabelDokter tr'
                            );


                        if (jumlahBaris.length === 0) {

                            const tabel =
                                document.getElementById(
                                    'tabelDokter'
                                );


                            tabel.innerHTML = `

                                <tr id="barisKosong">

                                    <td
                                        colspan="8"
                                        class="text-center empty-dokter"
                                    >

                                        <i class="fas fa-user-md fa-2x mb-2 d-block"></i>

                                        Belum ada data dokter.

                                    </td>

                                </tr>

                            `;

                        }


                        Swal.fire({

                            icon:
                                'success',

                            title:
                                'Berhasil!',

                            text:
                                data.message ||
                                'Data dokter berhasil dihapus.',

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
                '#tabelDokter tr'
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


    /* =====================================================
       RESET SELECT2 SAAT MODAL DITUTUP
    ===================================================== */

    $('#modalTambahDokter').on(
        'hidden.bs.modal',
        function () {

            $('#tambah_poli_id')
                .val('')
                .trigger('change');

        }
    );


    /* =====================================================
       RESET FORM TAMBAH SAAT MODAL DIBUKA
    ===================================================== */

    $('#modalTambahDokter').on(
        'show.bs.modal',
        function () {

            $('#formTambahDokter')[0].reset();

            $('#tambah_poli_id')
                .val('')
                .trigger('change');

        }
    );


});

</script>


@endsection