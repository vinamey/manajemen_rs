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
<<<<<<< HEAD
        width: 44px;
        height: 44px;
        background: var(--blue-light-bg);
        border-radius: 11px;
=======
        width: 42px;
        height: 42px;
        background-color: var(--blue-light-bg);
        border-radius: 10px;
>>>>>>> main
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

<<<<<<< HEAD
=======

    /* =========================================================
       BUTTON PRIMARY
    ========================================================= */

>>>>>>> main
    .btn-blue-primary {
        background: var(--blue-main) !important;
        border: none !important;
<<<<<<< HEAD
        color: #fff !important;
=======
        color: #ffffff !important;
>>>>>>> main
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 13px;
        font-weight: 600;
<<<<<<< HEAD
=======
        transition: all 0.2s ease;
>>>>>>> main
    }

    .btn-blue-primary:hover {
        background: var(--blue-dark) !important;
    }


    /* =========================================================
       TABLE CARD
    ========================================================= */
<<<<<<< HEAD
    .card-table-dokter {
        background: #fff;
        border: none;
        border-radius: 13px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.06);
        padding: 18px;
=======

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
>>>>>>> main
    }

    .table-responsive {
        overflow-x: auto;
    }

<<<<<<< HEAD
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
=======
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
>>>>>>> main
        vertical-align: middle;
    }

    #dokter-table tbody tr:hover td {
        background: var(--blue-soft);
    }


    /* =========================================================
       BADGE
    ========================================================= */
<<<<<<< HEAD
    .badge-gender {
        display: inline-flex;
=======

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
>>>>>>> main
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
<<<<<<< HEAD
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
=======
        font-size: 13px;
        flex-shrink: 0;
>>>>>>> main
    }


    /* =========================================================
       DATATABLE
    ========================================================= */
<<<<<<< HEAD
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
=======

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
>>>>>>> main
    }


    /* =========================================================
       MODAL
    ========================================================= */
<<<<<<< HEAD
    .modal-dokter .modal-dialog {
        max-width: 500px;
    }

    .modal-dokter .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 15px 40px rgba(15,23,42,.18);
=======

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
>>>>>>> main
    }


    /* =========================================================
       MODAL HEADER
    ========================================================= */

    .modal-dokter .modal-header {
<<<<<<< HEAD
        background: var(--blue-main);
        color: #fff;
        border: none;
        padding: 15px 18px;
=======
        background-color: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 15px 18px !important;
        border-radius: 14px 14px 0 0 !important;
>>>>>>> main
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
<<<<<<< HEAD
        padding: 20px 18px;
        background: #fff;
    }

    .modal-dokter .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 12px 18px;
    }
=======
        padding: 20px 18px !important;
        background-color: #ffffff !important;
        overflow: visible !important;
    }

>>>>>>> main

    /* =========================================================
       FORM
    ========================================================= */
    .form-group-dokter {
        margin-bottom: 13px;
    }

    .form-group-dokter {
        width: 100% !important;
        margin-bottom: 13px !important;
    }

    .form-label-dokter {
<<<<<<< HEAD
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
=======
        display: block !important;
        width: 100% !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #64748b !important;
        margin-bottom: 6px !important;
>>>>>>> main
    }

    .form-control-dokter,
    .form-select-dokter {
<<<<<<< HEAD
        width: 100%;
        border: 1px solid #d7e0ea;
        border-radius: 8px;
        padding: 9px 11px;
        font-size: 12px;
        color: #334155;
        background: #fff;
        outline: none;
=======
        width: 100% !important;
        height: 38px !important;
        box-sizing: border-box !important;
        border: 1px solid #d7e0ea !important;
        border-radius: 8px !important;
        padding: 9px 11px !important;
        font-size: 12px !important;
        color: #334155 !important;
        background-color: #ffffff !important;
>>>>>>> main
    }

    .form-control-dokter:focus,
    .form-select-dokter:focus {
<<<<<<< HEAD
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
=======
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
>>>>>>> main
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

<<<<<<< HEAD
<div class="container-fluid master-dokter">

    {{-- HEADER --}}
=======

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

>>>>>>> main
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
    aria-labelledby="modalTambahDokterLabel"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

<<<<<<< HEAD
=======
            {{-- HEADER --}}

>>>>>>> main
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

            <form id="formTambahDokter">
                @csrf

                <div class="modal-body">

<<<<<<< HEAD
=======
                    {{-- NAMA DOKTER --}}

>>>>>>> main
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
<<<<<<< HEAD
                            placeholder="Masukkan alamat dokter"
=======
                            rows="3"
                            placeholder="Ketikkan alamat lengkap..."
>>>>>>> main
                        ></textarea>
                    </div>

<<<<<<< HEAD
=======

                    {{-- POLI SELECT2 --}}

>>>>>>> main
                    <div class="form-group-dokter mb-0">
                        <label class="form-label-dokter">
                            Poli
                        </label>

                        <select
                            name="poli_id"
<<<<<<< HEAD
                            id="tambah_poli_id"
                            class="form-select-dokter"
                        >
                            <option value="">
                                -- Pilih Poli --
                            </option>
=======
                            class="select2-poli"
                            required
                        >

                            <option value=""></option>
>>>>>>> main

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

<<<<<<< HEAD
=======

>>>>>>> main
            <form id="formEditDokter">
                @csrf

                <input
                    type="hidden"
                    id="edit_id"
                >

                <div class="modal-body">

<<<<<<< HEAD
=======
                    {{-- NAMA --}}

>>>>>>> main
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
<<<<<<< HEAD
                            id="edit_poli_id"
                            class="form-select-dokter"
                        >
                            <option value="">
                                -- Pilih Poli --
                            </option>
=======
                            class="form-select-dokter select2-poli"
                        >

                            <option value=""></option>
>>>>>>> main

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
<<<<<<< HEAD
     SCRIPT
=======
     MODAL LIHAT
>>>>>>> main
========================================================= --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<<<<<<< HEAD
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
=======
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

>>>>>>> main
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

<<<<<<< HEAD
        button.html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'
=======
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
>>>>>>> main
        );

        $.ajax({
            url: "{{ route('master-dokter.store') }}",
            type: "POST",
            data: $(form).serialize(),

<<<<<<< HEAD
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
=======
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
>>>>>>> main

        const row = table.row(
            $(this).closest('tr')
        ).data();

        if (!row) {
            return;
        }

<<<<<<< HEAD
        $('#lihat_nama').text(
            row.nama || '-'
=======

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
>>>>>>> main
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

<<<<<<< HEAD
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
=======
>>>>>>> main
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

<<<<<<< HEAD
        $.ajax({
            url: "{{ url('master-dokter') }}/" + id,
            type: "POST",
            data: formData,
=======
                document.getElementById(
                    'edit_alamat'
                ).value =
                    this.dataset.alamat || '';


                $('#edit_poli_id')
                    .val(
                        this.dataset.poli_id || ''
                    )
                    .trigger('change');
>>>>>>> main

            success: function (response) {

                const modalElement =
                    document.getElementById(
                        'modalEditDokter'
                    );

                const modal =
                    bootstrap.Modal.getInstance(
                        modalElement
                    );

<<<<<<< HEAD
                if (modal) {
                    modal.hide();
=======

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

>>>>>>> main
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
