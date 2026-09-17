@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Poli')

@section('content')

<style>
    /* =========================
       GLOBAL & CARD CONTAINER
    ========================= */
    .main-wrapper {
        padding: 20px 28px;
        background: #f4f6f9;
        font-family: 'Public Sans', sans-serif, -apple-system, BlinkMacSystemFont;
    }

    .card-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        padding: 24px;
    }

    /* =========================
       HEADER SECTION
    ========================= */
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
        line-height: 1.2;
    }

    .header-text small {
        display: block;
        font-size: 11px;
        color: #8c98a4;
        margin-top: 3px;
    }

    /* =========================
       TOMBOL TAMBAH
    ========================= */
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
        box-shadow: 0 3px 8px rgba(30, 120, 246, 0.3) !important;
        transition: background 0.2s;
    }

    .btn-tambah:hover {
        background: #1565c0 !important;
    }

    /* =========================
       TABLE STYLING
    ========================= */
    .table-container {
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

    /* =========================
       BADGES & TEXT (PERSIS GAMBAR)
    ========================= */
    .text-center {
        text-align: center;
    }

    .text-muted-no {
        color: #6c757d;
        font-weight: 500;
    }

    /* Badge Kode (Biru Soft) */
    .kode-badge {
        display: inline-block;
        background: #e8f1fd !important;
        color: #1e78f6 !important;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 10px !important;
        font-weight: 600;
    }

    /* Badge Nama (Krem / Peach Soft - Sesuai Gambar) */
    .nama-badge {
        display: inline-block !important;
        background-color: #fef0d5 !important;
        color: #e67e22 !important;
        padding: 5px 12px !important;
        border-radius: 6px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
    }

    /* =========================
       AKSI BUTTONS
    ========================= */
    .aksi-column {
        white-space: nowrap;
        text-align: right;
    }

    .btn-aksi {
        border: none !important;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 10px !important;
        font-weight: 500;
        color: #ffffff !important;
        margin-left: 3px;
        line-height: 1.2;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        cursor: pointer;
    }

    .btn-lihat {
        background: #e3f2fd !important;
        color: #0288d1 !important;
    }

    .btn-edit {
        background: #1e78f6 !important;
        color: #ffffff !important;
    }

    .btn-hapus {
        background: #ff4d4f !important;
        color: #ffffff !important;
    }

    .btn-aksi:hover {
        opacity: 0.88;
    }

    .btn-batal {
        background: #e2e8f0;
        color: #4a5568;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-simpan {
        background: #1e78f6;
        color: #ffffff;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
    }

    .empty-data {
        color: #a0aec0 !important;
        font-size: 11px !important;
        padding: 24px !important;
        text-align: center;
    }

    @media (max-width: 768px) {
        .main-wrapper {
            padding: 12px;
        }
        .table-container {
            overflow-x: auto;
        }
        .custom-table {
            min-width: 650px;
        }
    }
</style>

<div class="main-wrapper">
    <div class="card-container">

        {{-- HEADER --}}
        <div class="page-header">
            <div class="header-title-box">
                <div class="header-icon">
                    <i class="bi bi-hospital"></i>
                </div>
                <div class="header-text">
                    <h5>Master Poli</h5>
                    <small>Data poli yang terdaftar</small>
                </div>
            </div>

            <button type="button"
                    class="btn-tambah"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahPoli">
                <i class="bi bi-plus-lg"></i>
                Tambah Poli
            </button>
        </div>

        {{-- TABLE CONTAINER --}}
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="text-center" width="60px">No</th>
                        <th width="22%">Kode Poli</th>
                        <th>Nama Poli</th>
                        <th class="text-center" width="220px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($polis as $index => $poli)
                        <tr>
                            <td class="text-center text-muted-no">{{ $index + 1 }}</td>

                            <td>
                                <span class="kode-badge">
                                    {{ $poli->kode }}
                                </span>
                            </td>

                            <td>
                                <span class="nama-badge">
                                    {{ $poli->nama }}
                                </span>
                            </td>

                            <td class="aksi-column">
                                <div class="d-inline-flex">
                                    {{-- LIHAT --}}
                                    <button type="button"
                                            class="btn-aksi btn-lihat"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatPoli{{ $poli->id }}">
                                        <i class="bi bi-eye"></i>
                                        Lihat
                                    </button>

                                    {{-- EDIT --}}
                                    <button type="button"
                                            class="btn-aksi btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditPoli{{ $poli->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </button>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('master-poli.destroy', $poli->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data poli ini?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-aksi btn-hapus">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        {{-- MODAL LIHAT --}}
                        <div class="modal fade"
                             id="modalLihatPoli{{ $poli->id }}"
                             tabindex="-1"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="bi bi-hospital me-2"></i>
                                            Detail Poli
                                        </h5>
                                    </div>

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Kode Poli</label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $poli->kode }}"
                                                   readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Nama Poli</label>
                                            <input type="text"
                                                   class="form-control"
                                                   value="{{ $poli->nama }}"
                                                   readonly>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button"
                                                class="btn-batal"
                                                data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade"
                             id="modalEditPoli{{ $poli->id }}"
                             tabindex="-1"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Edit Poli
                                        </h5>
                                    </div>

                                    <form action="{{ route('master-poli.update', $poli->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Kode Poli</label>
                                                <input type="text"
                                                       name="kode"
                                                       class="form-control"
                                                       value="{{ $poli->kode }}"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Nama Poli</label>
                                                <input type="text"
                                                       name="nama"
                                                       class="form-control"
                                                       value="{{ $poli->nama }}"
                                                       required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button"
                                                    class="btn-batal"
                                                    data-bs-dismiss="modal">
                                                Batal
                                            </button>

                                            <button type="submit" class="btn-simpan">
                                                <i class="bi bi-check-circle me-1"></i>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @empty
                        <tr>
                            <td colspan="4" class="empty-data">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data poli.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade"
     id="modalTambahPoli"
     tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Poli
                </h5>
            </div>

            <form action="{{ route('master-poli.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Poli</label>
                        <input type="text"
                               name="kode"
                               class="form-control"
                               placeholder="Contoh: POL004"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Poli</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Contoh: Poli Mata"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan">
                        <i class="bi bi-save me-1"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
