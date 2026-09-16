@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Kategori')

@section('content')

<style>
    :root {
        --blue-main: #1d7af2;
        --blue-dark: #1565c0;
        --blue-light: #e8f1fd;
    }

    body {
        background: #f4f6f9 !important;
        font-family: 'Public Sans', sans-serif, -apple-system, BlinkMacSystemFont;
    }

    /* =========================
       WRAPPER & CARD
    ========================= */
    .kategori-wrapper {
        padding: 20px 24px;
    }

    .main-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        padding: 20px;
    }

    /* =========================
       HEADER
    ========================= */
    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .kategori-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kategori-icon {
        width: 38px;
        height: 38px;
        background: var(--blue-light);
        color: var(--blue-main);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .kategori-title h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1a202c;
        line-height: 1.2;
    }

    .kategori-title small {
        display: block;
        font-size: 11px;
        color: #8c98a4;
        margin-top: 3px;
    }

    /* =========================
       TOMBOL TAMBAH
    ========================= */
    .btn-tambah {
        background: var(--blue-main) !important;
        border: none !important;
        color: #ffffff !important;
        font-size: 11px;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none !important;
        box-shadow: 0 2px 5px rgba(29, 122, 242, 0.3) !important;
    }

    .btn-tambah:hover {
        background: var(--blue-dark) !important;
        color: #ffffff !important;
    }

    /* =========================
       TABLE
    ========================= */
    .table-container {
        border-radius: 8px;
        overflow: hidden;
    }

    .table-kategori {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        font-size: 11px;
    }

    .table-kategori thead th {
        background: var(--blue-main) !important;
        color: #ffffff !important;
        font-size: 11px;
        font-weight: 600;
        padding: 10px 12px;
        border: none !important;
        text-align: left;
    }

    .table-kategori thead th.text-center {
        text-align: center;
    }

    .table-kategori thead th.aksi-header {
        text-align: center !important;
        width: 240px;
    }

    .table-kategori tbody td {
        padding: 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f5;
        color: #2c3e50 !important;
        background: #ffffff !important;
        font-size: 11px;
    }

    .table-kategori tbody tr:last-child td {
        border-bottom: none;
    }

    .table-kategori tbody tr:hover td {
        background: #f8fafc !important;
    }

    /* =========================
       ELEMENT TABLE
    ========================= */
    .nomor {
        text-align: center;
        color: #6c757d !important;
        font-weight: 500;
    }

    .kode-badge {
        display: inline-block;
        background: #e8f1fd !important;
        color: var(--blue-main) !important;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 10px !important;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .nama-kategori-badge {
        display: inline-block !important;
        background-color: #fff1e6 !important;
        color: #e67e22 !important;
        padding: 4px 12px !important;
        border-radius: 8px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        line-height: 1.2 !important;
        white-space: nowrap;
    }

    /* =========================
       AKSI
    ========================= */
    .aksi {
        white-space: nowrap;
        text-align: center !important;
        padding-right: 18px !important;
    }

    .aksi form {
        display: inline-flex !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .btn-aksi {
        border: none !important;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 10px !important;
        font-weight: 500;
        color: #ffffff !important;
        margin: 0 2px;
        line-height: 1.2;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        cursor: pointer;
        min-width: 55px;
    }

    .btn-lihat {
        background: #4fc3f7 !important;
    }

    .btn-edit {
        background: var(--blue-main) !important;
    }

    .btn-hapus {
        background: #ff4d4f !important;
    }

    .btn-aksi:hover {
        opacity: 0.88;
        color: #ffffff !important;
    }

    .empty-data {
        color: #a0aec0 !important;
        font-size: 11px !important;
        padding: 24px !important;
        text-align: center;
    }

    /* =========================
       MODAL
    ========================= */
    .modal-kategori .modal-dialog {
        max-width: 350px;
        margin: 1.75rem auto;
    }

    .modal-kategori .modal-content {
        border: none !important;
        border-radius: 8px !important;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.18);
    }

    /* HEADER MODAL */
    .modal-kategori .modal-header {
        background: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 11px 12px !important;
        min-height: 34px;
    }

    .modal-kategori .modal-title {
        font-size: 11px !important;
        font-weight: 600 !important;
        margin: 0 !important;
        color: #ffffff !important;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .modal-kategori .modal-title i {
        font-size: 10px;
    }

    /* HILANGKAN TOMBOL X */
    .modal-kategori .btn-close {
        display: none !important;
    }

    /* BODY MODAL */
    .modal-kategori .modal-body {
        background: #ffffff !important;
        padding: 13px 11px 10px 11px !important;
    }

    .form-group-kategori {
        margin-bottom: 9px;
    }

    .form-group-kategori label {
        display: block;
        font-size: 8px !important;
        font-weight: 500 !important;
        color: #4b5563 !important;
        margin-bottom: 4px !important;
    }

    .form-control-kategori {
        width: 100%;
        height: 25px !important;
        border: 1px solid #d9e1ea !important;
        border-radius: 4px !important;
        padding: 4px 7px !important;
        font-size: 8px !important;
        color: #374151 !important;
        background: #ffffff !important;
        outline: none !important;
        box-shadow: none !important;
    }

    .form-control-kategori:focus {
        border-color: var(--blue-main) !important;
        box-shadow: 0 0 0 2px rgba(29, 122, 242, 0.08) !important;
    }

    .form-control-kategori::placeholder {
        color: #a8b1bd !important;
        font-size: 8px !important;
    }

    .form-control-kategori[readonly] {
        background: #f8fafc !important;
        cursor: default;
    }

    /* FOOTER MODAL */
    .modal-kategori .modal-footer {
        background: #f5f7fa !important;
        border: none !important;
        padding: 9px 11px !important;
        display: flex;
        justify-content: flex-end;
        gap: 5px;
    }

    .btn-batal-kategori {
        border: none !important;
        background: transparent !important;
        color: #555555 !important;
        font-size: 8px !important;
        padding: 5px 9px !important;
        border-radius: 4px !important;
        font-weight: 500;
    }

    .btn-batal-kategori:hover {
        background: #e9ecef !important;
    }

    .btn-simpan-kategori {
        background: var(--blue-main) !important;
        color: #ffffff !important;
        border: none !important;
        font-size: 8px !important;
        font-weight: 600 !important;
        padding: 5px 9px !important;
        border-radius: 4px !important;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-simpan-kategori:hover {
        background: var(--blue-dark) !important;
        color: #ffffff !important;
    }

    /* BACKDROP */
    .modal-backdrop.show {
        opacity: 0.55 !important;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .kategori-wrapper {
            padding: 12px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table-kategori {
            min-width: 700px;
        }

        .modal-kategori .modal-dialog {
            max-width: calc(100% - 30px);
        }
    }
</style>

<div class="kategori-wrapper">

    <div class="main-card">

        {{-- HEADER --}}
        <div class="kategori-header">

            <div class="kategori-title">

                <div class="kategori-icon">
                    <i class="fas fa-tags"></i>
                </div>

                <div>
                    <h5>Master Kategori</h5>
                    <small>Data kategori yang terdaftar</small>
                </div>
            </div>

            {{-- TOMBOL TAMBAH --}}
            <button type="button"
                    class="btn-tambah"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahKategori">

                <i class="fas fa-plus"></i>
                Tambah Kategori

            </button>

        </div>


        {{-- TABLE --}}
        <div class="table-container">

            <table class="table-kategori">

                <thead>

                    <tr>

                        <th class="text-center" style="width: 50px;">
                            No
                        </th>

                        <th style="width: 25%;">
                            Kode Kategori
                        </th>

                        <th>
                            Nama Kategori
                        </th>

                        <th class="aksi-header">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($kategoris as $kategori)

                        <tr>

                            {{-- NOMOR --}}
                            <td class="nomor">
                                {{ $loop->iteration }}
                            </td>


                            {{-- KODE --}}
                            <td>

                                <span class="kode-badge">
                                    {{ $kategori->kode }}
                                </span>

                            </td>


                            {{-- NAMA --}}
                            <td>

                                <span class="nama-kategori-badge">
                                    {{ $kategori->nama }}
                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td class="aksi">

                                {{-- LIHAT --}}
                                <button type="button"
                                        class="btn-aksi btn-lihat"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLihatKategori{{ $kategori->id }}">

                                    <i class="fas fa-eye"></i>
                                    Lihat

                                </button>


                                {{-- EDIT --}}
                                <button type="button"
                                        class="btn-aksi btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditKategori{{ $kategori->id }}">

                                    <i class="fas fa-edit"></i>
                                    Edit

                                </button>


                                {{-- HAPUS --}}
                                <form action="{{ route('master-kategori.destroy', $kategori->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-aksi btn-hapus">

                                        <i class="fas fa-trash"></i>
                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="empty-data">
                                Belum ada data kategori.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ==========================================================
     MODAL TAMBAH KATEGORI
========================================================== --}}

<div class="modal fade modal-kategori"
     id="modalTambahKategori"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-tags"></i>
                    Tambah Kategori

                </h5>

            </div>


            {{-- FORM --}}
            <form action="{{ route('master-kategori.store') }}"
                  method="POST">

                @csrf

                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="form-group-kategori">

                        <label>
                            Kode Kategori
                        </label>

                        <input type="text"
                               name="kode"
                               class="form-control-kategori"
                               placeholder="Masukkan kode kategori"
                               required>

                    </div>


                    {{-- NAMA --}}
                    <div class="form-group-kategori">

                        <label>
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control-kategori"
                               placeholder="Masukkan nama kategori"
                               required>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn-batal-kategori"
                            data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn-simpan-kategori">

                        <i class="fas fa-save"></i>
                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ==========================================================
     MODAL LIHAT & EDIT
========================================================== --}}

@foreach($kategoris as $kategori)

    {{-- =========================
         MODAL LIHAT
    ========================= --}}

    <div class="modal fade modal-kategori"
         id="modalLihatKategori{{ $kategori->id }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fas fa-eye"></i>
                        Lihat Kategori

                    </h5>

                </div>


                {{-- BODY --}}
                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="form-group-kategori">

                        <label>
                            Kode Kategori
                        </label>

                        <input type="text"
                               class="form-control-kategori"
                               value="{{ $kategori->kode }}"
                               readonly>

                    </div>


                    {{-- NAMA --}}
                    <div class="form-group-kategori">

                        <label>
                            Nama Kategori
                        </label>

                        <input type="text"
                               class="form-control-kategori"
                               value="{{ $kategori->nama }}"
                               readonly>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button type="button"
                            class="btn-batal-kategori"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================
         MODAL EDIT
    ========================= --}}

    <div class="modal fade modal-kategori"
         id="modalEditKategori{{ $kategori->id }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header">

                    <h5 class="modal-title">

                        <i class="fas fa-edit"></i>
                        Edit Kategori

                    </h5>

                </div>


                {{-- FORM EDIT --}}
                <form action="{{ route('master-kategori.update', $kategori->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        {{-- KODE --}}
                        <div class="form-group-kategori">

                            <label>
                                Kode Kategori
                            </label>

                            <input type="text"
                                   name="kode"
                                   class="form-control-kategori"
                                   value="{{ $kategori->kode }}"
                                   placeholder="Masukkan kode kategori"
                                   required>

                        </div>


                        {{-- NAMA --}}
                        <div class="form-group-kategori">

                            <label>
                                Nama Kategori
                            </label>

                            <input type="text"
                                   name="nama"
                                   class="form-control-kategori"
                                   value="{{ $kategori->nama }}"
                                   placeholder="Masukkan nama kategori"
                                   required>

                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <div class="modal-footer">

                        <button type="button"
                                class="btn-batal-kategori"
                                data-bs-dismiss="modal">

                            Batal

                        </button>


                        <button type="submit"
                                class="btn-simpan-kategori">

                            <i class="fas fa-save"></i>
                            Simpan Data

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endforeach

@endsection
