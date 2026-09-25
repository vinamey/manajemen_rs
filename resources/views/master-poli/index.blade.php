@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Poli')

@section('content')

<style>

/* =====================================================
   GLOBAL
===================================================== */

.main-wrapper {
    padding: 20px 28px;
    background: #f4f6f9;
    min-height: calc(100vh - 70px);
    font-family: 'Public Sans', sans-serif, Arial;
}

.card-container {
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    padding: 24px;
}


/* =====================================================
   HEADER
===================================================== */

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.header-title-box {
    display: flex;
    align-items: center;
    gap: 12px;
}

.header-icon {
    width: 40px;
    height: 40px;
    background: #e8f1fd;
    color: #1e78f6;
    border-radius: 10px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 18px;
    flex-shrink: 0;
}

.header-text h5 {
    margin: 0;
    font-size: 18px;
    font-weight: 700;
    color: #1a202c;
}

.header-text small {
    display: block;
    font-size: 11px;
    color: #8c98a4;
    margin-top: 3px;
}


/* =====================================================
   TOMBOL TAMBAH
===================================================== */

.btn-tambah {
    background: #1e78f6 !important;
    border: none !important;
    color: #ffffff !important;

    font-size: 11px;
    font-weight: 600;

    padding: 10px 18px;
    border-radius: 8px;

    display: inline-flex;
    align-items: center;
    gap: 6px;

    cursor: pointer;

    box-shadow: 0 3px 8px rgba(30, 120, 246, 0.3);

    transition: 0.2s;
}

.btn-tambah:hover {
    background: #1565c0 !important;
    color: #ffffff !important;
}


/* =====================================================
   TABLE
===================================================== */

.table-container {
    width: 100%;
    border-radius: 8px;
    overflow: hidden;
}

.custom-table {
    width: 100%;
    margin: 0;
    border-collapse: collapse;
    font-size: 11px;
}

.custom-table thead th {
    background: #1e78f6 !important;
    color: #ffffff !important;

    font-size: 11px;
    font-weight: 600;

    padding: 12px 14px;

    border: none !important;
    text-align: left;
}

.custom-table tbody td {
    padding: 14px;

    vertical-align: middle;

    border-bottom: 1px solid #f1f3f5;

    color: #2c3e50 !important;
    background: #ffffff !important;

    font-size: 11px;
}

.custom-table tbody tr:last-child td {
    border-bottom: none;
}

.custom-table tbody tr:hover td {
    background: #f8fafc !important;
}

.text-center {
    text-align: center !important;
}

.text-muted-no {
    color: #6c757d;
    font-weight: 500;
}


/* =====================================================
   BADGE KODE
===================================================== */

.kode-badge {
    display: inline-block;

    background: #e8f1fd !important;
    color: #1e78f6 !important;

    padding: 4px 10px;

    border-radius: 6px;

    font-size: 10px !important;
    font-weight: 600;
}


/* =====================================================
   BADGE NAMA
===================================================== */

.nama-badge {
    display: inline-block !important;

    background-color: #fef0d5 !important;
    color: #e67e22 !important;

    padding: 5px 12px !important;

    border-radius: 6px !important;

    font-size: 10px !important;
    font-weight: 600 !important;
}


/* =====================================================
   AKSI
===================================================== */

.aksi-column {
    white-space: nowrap;
    text-align: center;
}

.btn-aksi {
    border: none !important;

    padding: 6px 12px;

    border-radius: 6px;

    font-size: 10px !important;
    font-weight: 500;

    margin-left: 3px;

    line-height: 1.2;

    text-decoration: none !important;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 4px;

    cursor: pointer;

    transition: 0.2s;
}

.btn-lihat {
    background: #e3f2fd !important;
    color: #0288d1 !important;
}

.btn-lihat:hover {
    background: #cce8f8 !important;
    color: #0277bd !important;
}

.btn-edit {
    background: #1e78f6 !important;
    color: #ffffff !important;
}

.btn-edit:hover {
    background: #1565c0 !important;
    color: #ffffff !important;
}

.btn-hapus {
    background: #ff4d4f !important;
    color: #ffffff !important;
}

.btn-hapus:hover {
    background: #d9363e !important;
    color: #ffffff !important;
}


/* =====================================================
   DATA KOSONG
===================================================== */

.empty-data {
    color: #a0aec0 !important;

    font-size: 11px !important;

    padding: 30px !important;

    text-align: center;
}


/* =====================================================
   MODAL GLOBAL
===================================================== */

.modal-content {
    border: none !important;

    border-radius: 10px !important;

    overflow: hidden;

    box-shadow:
        0 12px 35px rgba(0, 0, 0, 0.18);
}


/* =====================================================
   UKURAN MODAL
===================================================== */

#modalTambahPoli .modal-dialog,
[id^="modalEditPoli"] .modal-dialog,
[id^="modalLihatPoli"] .modal-dialog {

    max-width: 470px;
}


/* =====================================================
   HEADER MODAL
===================================================== */

.modal-header {
    background: #1877f2 !important;

    color: #ffffff !important;

    border: none !important;

    padding: 14px 18px !important;
}

.modal-header .modal-title {

    margin: 0;

    color: #ffffff !important;

    font-size: 14px;

    font-weight: 600;

    display: flex;
    align-items: center;
}

.modal-header .modal-title i {
    color: #ffffff !important;
}


/* =====================================================
   BODY MODAL
===================================================== */

.modal-body {

    background: #ffffff !important;

    padding: 20px 18px !important;
}


/* =====================================================
   LABEL
===================================================== */

.modal-body .form-label {

    display: block;

    font-size: 10px;

    font-weight: 600;

    color: #526071;

    margin-bottom: 6px;
}


/* =====================================================
   INPUT
===================================================== */

.modal-body .form-control {

    width: 100%;

    height: 36px;

    border: 1px solid #d5dde8 !important;

    border-radius: 6px;

    padding: 7px 10px;

    font-size: 10px;

    color: #374151;

    background: #ffffff !important;

    box-shadow: none !important;

    outline: none;
}

.modal-body .form-control:focus {

    border-color: #1877f2 !important;

    box-shadow:
        0 0 0 2px rgba(24, 119, 242, 0.10) !important;
}


/* =====================================================
   READONLY
===================================================== */

.modal-body .form-control[readonly] {

    background: #f8fafc !important;

    color: #4b5563;
}


/* =====================================================
   FOOTER MODAL
===================================================== */

.modal-footer {

    background: #f8fafc !important;

    border-top: 1px solid #eef1f5 !important;

    padding: 12px 18px !important;

    display: flex;

    justify-content: flex-end;

    gap: 7px;
}


/* =====================================================
   BUTTON BATAL
===================================================== */

.btn-batal {

    background: #edf2f7 !important;

    color: #64748b !important;

    border: none !important;

    padding: 7px 14px !important;

    border-radius: 6px !important;

    font-size: 10px !important;

    font-weight: 600;

    cursor: pointer;
}

.btn-batal:hover {

    background: #e2e8f0 !important;

    color: #475569 !important;
}


/* =====================================================
   BUTTON SIMPAN
===================================================== */

.btn-simpan {

    background: #1877f2 !important;

    color: #ffffff !important;

    border: none !important;

    padding: 7px 14px !important;

    border-radius: 6px !important;

    font-size: 10px !important;

    font-weight: 600;

    cursor: pointer;
}

.btn-simpan:hover {

    background: #0f58c6 !important;

    color: #ffffff !important;
}


/* =====================================================
   ICON
===================================================== */

.modal-header i {
    font-size: 14px;
}


/* =====================================================
   BACKDROP
===================================================== */

.modal-backdrop {
    background-color: #000 !important;
}

.modal-backdrop.show {
    opacity: 0.5 !important;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 768px) {

    .main-wrapper {
        padding: 12px;
    }

    .card-container {
        padding: 15px;
    }

    .page-header {
        align-items: flex-start;

        gap: 15px;
    }

    .header-text h5 {
        font-size: 16px;
    }

    .table-container {
        overflow-x: auto;
    }

    .custom-table {
        min-width: 650px;
    }

    #modalTambahPoli .modal-dialog,
    [id^="modalEditPoli"] .modal-dialog,
    [id^="modalLihatPoli"] .modal-dialog {

        max-width: calc(100% - 30px);

        margin: 15px auto;
    }
}

</style>


{{-- =====================================================
     HALAMAN MASTER POLI
===================================================== --}}

<div class="main-wrapper">

    <div class="card-container">

        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="page-header">

            <div class="header-title-box">

                <div class="header-icon">

                    <i class="bi bi-hospital"></i>

                </div>

                <div class="header-text">

                    <h5>
                        Master Poli
                    </h5>

                    <small>
                        Data poli yang terdaftar
                    </small>

                </div>

            </div>


            {{-- TOMBOL TAMBAH --}}

            <button
                type="button"
                class="btn-tambah"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPoli"
            >

                <i class="bi bi-plus-lg"></i>

                + Tambah Poli

            </button>

        </div>


        {{-- =================================================
             TABLE
        ================================================== --}}

        <div class="table-container">

            <table class="custom-table">

                <thead>

                    <tr>

                        <th
                            class="text-center"
                            width="60px"
                        >
                            No
                        </th>

                        <th width="22%">
                            Kode Poli
                        </th>

                        <th>
                            Nama Poli
                        </th>

                        <th
                            class="text-center"
                            width="240px"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($polis as $index => $poli)

                        <tr>

                            {{-- NO --}}

                            <td class="text-center text-muted-no">

                                {{ $index + 1 }}

                            </td>


                            {{-- KODE --}}

                            <td>

                                <span class="kode-badge">

                                    {{ $poli->kode }}

                                </span>

                            </td>


                            {{-- NAMA --}}

                            <td>

                                <span class="nama-badge">

                                    {{ $poli->nama }}

                                </span>

                            </td>


                            {{-- AKSI --}}

                            <td class="aksi-column">

                                <div class="d-inline-flex">

                                    {{-- LIHAT --}}

                                    <button
                                        type="button"
                                        class="btn-aksi btn-lihat"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLihatPoli{{ $poli->id }}"
                                    >

                                        <i class="bi bi-eye"></i>

                                        Lihat

                                    </button>


                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        class="btn-aksi btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditPoli{{ $poli->id }}"
                                    >

                                        <i class="bi bi-pencil-square"></i>

                                        Edit

                                    </button>


                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route('master-poli.destroy', $poli->id) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data poli ini?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-aksi btn-hapus"
                                        >

                                            <i class="bi bi-trash"></i>

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
                                class="empty-data"
                            >

                                <i
                                    class="bi bi-inbox"
                                    style="font-size: 28px;"
                                ></i>

                                <div style="margin-top: 8px;">
                                    Belum ada data poli.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- =====================================================
     MODAL TAMBAH POLI
===================================================== --}}

<div
    class="modal fade"
    id="modalTambahPoli"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-plus-circle me-2"></i>

                    Tambah Poli

                </h5>

            </div>


            {{-- FORM --}}

            <form
                action="{{ route('master-poli.store') }}"
                method="POST"
            >

                @csrf


                {{-- BODY --}}

                <div class="modal-body">


                    {{-- KODE POLI --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Kode Poli

                        </label>

                        <input
                            type="text"
                            name="kode"
                            class="form-control"
                            placeholder="Contoh: POL004"
                            value="{{ old('kode') }}"
                            autocomplete="off"
                            required
                        >

                    </div>


                    {{-- NAMA POLI --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Poli

                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Contoh: Poli Mata"
                            value="{{ old('nama') }}"
                            autocomplete="off"
                            required
                        >

                    </div>


                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn-simpan"
                    >

                        <i class="bi bi-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- =====================================================
     MODAL LIHAT & EDIT
===================================================== --}}

@foreach ($polis as $poli)


    {{-- =================================================
         MODAL LIHAT
    ================================================== --}}

    <div
        class="modal fade"
        id="modalLihatPoli{{ $poli->id }}"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-hospital me-2"></i>

                        Detail Poli

                    </h5>

                </div>


                {{-- BODY --}}

                <div class="modal-body">


                    {{-- KODE --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Kode Poli

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $poli->kode }}"
                            readonly
                        >

                    </div>


                    {{-- NAMA --}}

                    <div class="mb-3">

                        <label class="form-label">

                            Nama Poli

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="{{ $poli->nama }}"
                            readonly
                        >

                    </div>


                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal"
                        data-bs-dismiss="modal"
                    >

                        Tutup

                    </button>

                </div>

            </div>

        </div>

    </div>



    {{-- =================================================
         MODAL EDIT
    ================================================== --}}

    <div
        class="modal fade"
        id="modalEditPoli{{ $poli->id }}"
        tabindex="-1"
        aria-hidden="true"
    >

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                {{-- HEADER --}}

                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="bi bi-pencil-square me-2"></i>

                        Edit Poli

                    </h5>

                </div>


                {{-- FORM --}}

                <form
                    action="{{ route('master-poli.update', $poli->id) }}"
                    method="POST"
                >

                    @csrf

                    @method('PUT')


                    {{-- BODY --}}

                    <div class="modal-body">


                        {{-- KODE --}}

                        <div class="mb-3">

                            <label class="form-label">

                                Kode Poli

                            </label>

                            <input
                                type="text"
                                name="kode"
                                class="form-control"
                                value="{{ $poli->kode }}"
                                autocomplete="off"
                                required
                            >

                        </div>


                        {{-- NAMA --}}

                        <div class="mb-3">

                            <label class="form-label">

                                Nama Poli

                            </label>

                            <input
                                type="text"
                                name="nama"
                                class="form-control"
                                value="{{ $poli->nama }}"
                                autocomplete="off"
                                required
                            >

                        </div>


                    </div>


                    {{-- FOOTER --}}

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn-batal"
                            data-bs-dismiss="modal"
                        >

                            Batal

                        </button>


                        <button
                            type="submit"
                            class="btn-simpan"
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


@endforeach


@endsection
