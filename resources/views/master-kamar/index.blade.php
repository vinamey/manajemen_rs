@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Kamar')

@section('content')

<style>
    :root {
        --kamar-blue: #1877f2;
        --kamar-blue-dark: #0f58c6;
        --kamar-blue-light: #e8f1fd;
        --kamar-bg: #f4f6f9;
    }

    .kamar-page {
        padding: 20px 28px;
        background: var(--kamar-bg);
        min-height: calc(100vh - 70px);
    }

    /* ================= HEADER ================= */

    .kamar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .kamar-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kamar-icon {
        width: 42px;
        height: 42px;
        background: var(--kamar-blue-light);
        color: var(--kamar-blue);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .kamar-title {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
        color: #1f2937;
    }

    .kamar-subtitle {
        margin: 3px 0 0;
        font-size: 11px;
        color: #8b95a5;
    }

    /* ================= BUTTON TAMBAH ================= */

    .btn-tambah-kamar {
        background: var(--kamar-blue);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 11px;
        font-weight: 600;
        box-shadow: 0 3px 8px rgba(24, 119, 242, 0.25);
    }

    .btn-tambah-kamar:hover {
        background: var(--kamar-blue-dark);
        color: white;
    }

    /* ================= CARD ================= */

    .kamar-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.04);
    }

    /* ================= TABLE ================= */

    .kamar-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
    }

    .kamar-table thead th {
        background: var(--kamar-blue);
        color: white;
        padding: 13px 14px;
        font-size: 11px;
        font-weight: 600;
        border: none;
        white-space: nowrap;
    }

    .kamar-table tbody td {
        padding: 14px;
        font-size: 11px;
        color: #657184;
        vertical-align: middle;
        border-bottom: 1px solid #eef1f5;
    }

    .kamar-table tbody tr:last-child td {
        border-bottom: none;
    }

    .kamar-table tbody tr:hover td {
        background: #f8fbff;
    }

    /* ================= BADGE KODE ================= */

    .kode-badge {
        display: inline-block;
        background: #e8f1fd;
        color: var(--kamar-blue);
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 600;
    }

    /* ================= BADGE NAMA ================= */

    .nama-badge {
        display: inline-block;
        background: #fef0d5;
        color: #e67e22;
        padding: 5px 11px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 600;
    }

    /* ================= STATUS ================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 10px;
        border-radius: 6px;
        font-size: 10px;
        font-weight: 600;
    }

    .status-tersedia {
        background: #e8f8ef;
        color: #198754;
    }

    .status-terisi {
        background: #fff0f0;
        color: #dc3545;
    }

    /* ================= AKSI ================= */

    .aksi-column {
        white-space: nowrap;
    }

    .btn-aksi-kamar {
        border: none;
        border-radius: 6px;
        padding: 7px 10px;
        font-size: 10px;
        font-weight: 600;
        margin-right: 3px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-lihat-kamar {
        background: #e3f2fd;
        color: #0288d1;
    }

    .btn-lihat-kamar:hover {
        background: #cce9fa;
        color: #0288d1;
    }

    .btn-edit-kamar {
        background: var(--kamar-blue);
        color: white;
    }

    .btn-edit-kamar:hover {
        background: var(--kamar-blue-dark);
        color: white;
    }

    .btn-hapus-kamar {
        background: #ef4444;
        color: white;
    }

    .btn-hapus-kamar:hover {
        background: #dc2626;
        color: white;
    }

    /* ================= EMPTY ================= */

    .empty-data {
        padding: 45px 20px !important;
        text-align: center;
        color: #9ca3af !important;
        font-size: 11px !important;
    }

    /* ================= MODAL ================= */

    .kamar-modal .modal-dialog {
        max-width: 500px;
    }

    .kamar-modal .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
    }

    .kamar-modal .modal-header {
        background: var(--kamar-blue);
        color: white;
        padding: 14px 18px;
        border: none;
    }

    .kamar-modal .modal-title {
        font-size: 14px;
        font-weight: 600;
    }

    .kamar-modal .modal-body {
        padding: 20px;
    }

    .kamar-modal .modal-footer {
        background: #f8fafc;
        padding: 12px 18px;
        border-top: 1px solid #edf0f4;
    }

    .kamar-modal .form-label {
        font-size: 11px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .kamar-modal .form-control,
    .kamar-modal .form-select {
        font-size: 11px;
        border-radius: 7px;
        padding: 9px 11px;
        border: 1px solid #d9e1ea;
    }

    .kamar-modal .form-control:focus,
    .kamar-modal .form-select:focus {
        border-color: var(--kamar-blue);
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.12);
    }

    .btn-batal-kamar {
        background: #e9eef5;
        color: #64748b;
        border: none;
        border-radius: 6px;
        padding: 8px 14px;
        font-size: 10px;
        font-weight: 600;
    }

    .btn-simpan-kamar {
        background: var(--kamar-blue);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 14px;
        font-size: 10px;
        font-weight: 600;
    }

    .btn-simpan-kamar:hover {
        background: var(--kamar-blue-dark);
        color: white;
    }

    .detail-box {
        background: #f8fafc;
        border: 1px solid #edf0f4;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
    }

    .detail-label {
        font-size: 10px;
        color: #8b95a5;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
    }

    /* Hilangkan X */

    .kamar-modal .btn-close {
        display: none !important;
    }

    @media (max-width: 768px) {
        .kamar-page {
            padding: 12px;
        }

        .kamar-header {
            align-items: flex-start;
            gap: 12px;
        }

        .kamar-table {
            min-width: 700px;
        }

        .table-responsive {
            overflow-x: auto;
        }
    }
</style>


<div class="kamar-page">

    {{-- ================= HEADER ================= --}}

    <div class="kamar-header">

        <div class="kamar-title-wrapper">

            <div class="kamar-icon">
                <i class="fas fa-bed"></i>
            </div>

            <div>
                <h2 class="kamar-title">
                    Master Kamar
                </h2>

                <p class="kamar-subtitle">
                    Data kamar yang terdaftar
                </p>
            </div>

        </div>


        <button type="button"
                class="btn btn-tambah-kamar"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahKamar">

            <i class="fas fa-plus me-1"></i>
            Tambah Kamar

        </button>

    </div>


    {{-- ================= TABLE ================= --}}

    <div class="kamar-card">

        <div class="table-responsive">

            <table class="kamar-table">

                <thead>

                    <tr>

                        <th width="7%" class="text-center">
                            No
                        </th>

                        <th width="22%">
                            Kode Kamar
                        </th>

                        <th width="30%">
                            Nama Kamar
                        </th>

                        <th width="20%">
                            Status
                        </th>

                        <th width="21%">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($kamars as $index => $kamar)

                        <tr>

                            {{-- NO --}}

                            <td class="text-center">

                                {{ $index + 1 }}

                            </td>


                            {{-- KODE --}}

                            <td>

                                <span class="kode-badge">

                                    {{ $kamar->kode }}

                                </span>

                            </td>


                            {{-- NAMA --}}

                            <td>

                                <span class="nama-badge">

                                    {{ $kamar->nama }}

                                </span>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($kamar->status === 'tersedia')

                                    <span class="status-badge status-tersedia">

                                        <i class="fas fa-check-circle"></i>

                                        Tersedia

                                    </span>

                                @elseif($kamar->status === 'terisi')

                                    <span class="status-badge status-terisi">

                                        <i class="fas fa-user"></i>

                                        Terisi

                                    </span>

                                @else

                                    <span class="status-badge status-terisi">

                                        {{ ucfirst($kamar->status) }}

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}

                            <td class="aksi-column">

                                {{-- LIHAT --}}

                                <button type="button"
                                        class="btn btn-aksi-kamar btn-lihat-kamar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalLihatKamar{{ $kamar->id }}">

                                    <i class="fas fa-eye"></i>
                                    Lihat

                                </button>


                                {{-- EDIT --}}

                                <button type="button"
                                        class="btn btn-aksi-kamar btn-edit-kamar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditKamar{{ $kamar->id }}">

                                    <i class="fas fa-edit"></i>
                                    Edit

                                </button>


                                {{-- HAPUS --}}

                                <form action="{{ route('master-kamar.destroy', $kamar->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data kamar ini?');">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-aksi-kamar btn-hapus-kamar">

                                        <i class="fas fa-trash"></i>
                                        Hapus

                                    </button>

                                </form>

                            </td>

                        </tr>


                        {{-- ================================================= --}}
                        {{-- MODAL LIHAT --}}
                        {{-- ================================================= --}}

                        <div class="modal fade kamar-modal"
                             id="modalLihatKamar{{ $kamar->id }}"
                             tabindex="-1"
                             aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            <i class="fas fa-eye me-2"></i>

                                            Detail Kamar

                                        </h5>

                                    </div>


                                    <div class="modal-body">

                                        <div class="detail-box">

                                            <div class="detail-label">
                                                Kode Kamar
                                            </div>

                                            <div class="detail-value">
                                                {{ $kamar->kode }}
                                            </div>

                                        </div>


                                        <div class="detail-box">

                                            <div class="detail-label">
                                                Nama Kamar
                                            </div>

                                            <div class="detail-value">
                                                {{ $kamar->nama }}
                                            </div>

                                        </div>


                                        <div class="detail-box">

                                            <div class="detail-label">
                                                Status
                                            </div>

                                            <div class="detail-value">

                                                @if($kamar->status === 'tersedia')

                                                    <span class="status-badge status-tersedia">

                                                        <i class="fas fa-check-circle"></i>

                                                        Tersedia

                                                    </span>

                                                @else

                                                    <span class="status-badge status-terisi">

                                                        <i class="fas fa-user"></i>

                                                        Terisi

                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>


                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-batal-kamar"
                                                data-bs-dismiss="modal">

                                            Tutup

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- MODAL EDIT --}}
                        {{-- ================================================= --}}

                        <div class="modal fade kamar-modal"
                             id="modalEditKamar{{ $kamar->id }}"
                             tabindex="-1"
                             aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">

                                            <i class="fas fa-edit me-2"></i>

                                            Edit Kamar

                                        </h5>

                                    </div>


                                    <form action="{{ route('master-kamar.update', $kamar->id) }}"
                                          method="POST">

                                        @csrf

                                        @method('PUT')


                                        <div class="modal-body">

                                            {{-- KODE --}}

                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Kode Kamar
                                                </label>

                                                <input type="text"
                                                       name="kode"
                                                       class="form-control"
                                                       value="{{ $kamar->kode }}"
                                                       placeholder="Contoh: KMR001"
                                                       required>

                                            </div>


                                            {{-- NAMA --}}

                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Nama Kamar
                                                </label>

                                                <input type="text"
                                                       name="nama"
                                                       class="form-control"
                                                       value="{{ $kamar->nama }}"
                                                       placeholder="Contoh: Melati"
                                                       required>

                                            </div>


                                            {{-- STATUS --}}

                                            <div class="mb-3">

                                                <label class="form-label">
                                                    Status
                                                </label>

                                                <select name="status"
                                                        class="form-select"
                                                        required>

                                                    <option value="">
                                                        -- Pilih Status --
                                                    </option>

                                                    <option value="tersedia"
                                                        {{ $kamar->status === 'tersedia' ? 'selected' : '' }}>
                                                        Tersedia
                                                    </option>

                                                    <option value="terisi"
                                                        {{ $kamar->status === 'terisi' ? 'selected' : '' }}>
                                                        Terisi
                                                    </option>

                                                </select>

                                            </div>

                                        </div>


                                        <div class="modal-footer">

                                            <button type="button"
                                                    class="btn btn-batal-kamar"
                                                    data-bs-dismiss="modal">

                                                Batal

                                            </button>


                                            <button type="submit"
                                                    class="btn btn-simpan-kamar">

                                                <i class="fas fa-save me-1"></i>

                                                Simpan Perubahan

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="empty-data">

                                <i class="fas fa-inbox fa-2x d-block mb-2"></i>

                                Belum ada data kamar.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ================================================= --}}
{{-- MODAL TAMBAH --}}
{{-- ================================================= --}}

<div class="modal fade kamar-modal"
     id="modalTambahKamar"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-plus-circle me-2"></i>

                    Tambah Kamar

                </h5>

            </div>


            <form action="{{ route('master-kamar.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">

                    {{-- KODE --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Kode Kamar
                        </label>

                        <input type="text"
                               name="kode"
                               class="form-control"
                               value="{{ old('kode') }}"
                               placeholder="Contoh: KMR001"
                               required>

                    </div>


                    {{-- NAMA --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Kamar
                        </label>

                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ old('nama') }}"
                               placeholder="Contoh: Melati"
                               required>

                    </div>


                    {{-- STATUS --}}

                    <div class="mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option value="tersedia"
                                {{ old('status') === 'tersedia' ? 'selected' : '' }}>
                                Tersedia
                            </option>

                            <option value="terisi"
                                {{ old('status') === 'terisi' ? 'selected' : '' }}>
                                Terisi
                            </option>

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-batal-kamar"
                            data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn btn-simpan-kamar">

                        <i class="fas fa-save me-1"></i>

                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
