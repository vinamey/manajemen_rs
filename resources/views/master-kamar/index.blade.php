@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Kamar')

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
        background: #e8f1fd !important;
        color: #1e78f6 !important;
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
       ALERT NOTIFIKASI (SESUAI GAMBAR)
    ========================= */
    .custom-alert-success {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-left: 4px solid #1e78f6;
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .custom-alert-success .alert-icon {
        width: 22px;
        height: 22px;
        background-color: #0f5132;
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        flex-shrink: 0;
    }

    .custom-alert-success .alert-text {
        color: #2c3e50;
        font-size: 13px;
        font-weight: 500;
        margin: 0;
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
       BADGES & STATUS
    ========================= */
    .text-center {
        text-align: center;
    }

    .text-muted-no {
        color: #6c757d;
        font-weight: 500;
    }

    .kode-badge {
        display: inline-block;
        background: #e8f1fd !important;
        color: #1e78f6 !important;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 10px !important;
        font-weight: 600;
    }

    .status-badge {
        display: inline-block !important;
        padding: 5px 12px !important;
        border-radius: 6px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
    }

    .status-aktif {
        background-color: #d1e7dd !important;
        color: #0f5132 !important;
    }

    .status-perbaikan {
        background-color: #fef0d5 !important;
        color: #e67e22 !important;
    }

    .status-tidak-aktif {
        background-color: #f8d7da !important;
        color: #842029 !important;
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

    .empty-data {
        color: #a0aec0 !important;
        font-size: 11px !important;
        padding: 24px !important;
        text-align: center;
    }

    /* =========================
       MODAL DESAIN PERSIS GAMBAR
    ========================= */
    .modal-content {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: #1e78f6 !important;
        color: #ffffff !important;
        padding: 16px 20px !important;
        border-bottom: none !important;
    }

    .modal-title {
        font-size: 14px !important;
        font-weight: 600 !important;
        color: #ffffff !important;
    }

    .modal-body {
        padding: 24px 20px 12px 20px !important;
    }

    .modal-body .form-label {
        font-size: 11px !important;
        font-weight: 600 !important;
        color: #4a5568 !important;
        margin-bottom: 6px !important;
    }

    .modal-body .form-control,
    .modal-body .form-select {
        font-size: 11px !important;
        border-radius: 8px !important;
        border: 1px solid #e2e8f0 !important;
        padding: 10px 12px !important;
        color: #4a5568 !important;
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: #1e78f6 !important;
        box-shadow: 0 0 0 3px rgba(30, 120, 246, 0.15) !important;
    }

    .modal-footer {
        border-top: 1px solid #edf2f7 !important;
        padding: 14px 20px !important;
        gap: 8px;
    }

    .btn-modal-batal {
        background: #6c757d !important;
        color: #ffffff !important;
        border: none !important;
        padding: 8px 20px !important;
        border-radius: 8px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
    }

    .btn-modal-simpan {
        background: #1e78f6 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 8px 20px !important;
        border-radius: 8px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-modal-batal:hover {
        background: #5a6268 !important;
    }

    .btn-modal-simpan:hover {
        background: #1565c0 !important;
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
                    <i class="fas fa-bed"></i>
                </div>
                <div class="header-text">
                    <h5>Master Kamar</h5>
                    <small>Data kamar yang terdaftar</small>
                </div>
            </div>

            <button type="button"
                    class="btn-tambah"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahKamar">
                <i class="fas fa-plus"></i>
                Tambah Kamar
            </button>
        </div>

        {{-- ALERT NOTIFIKASI BERHASIL --}}
        @if(session('success'))
            <div class="custom-alert-success">
                <div class="alert-icon">
                    <i class="fas fa-check"></i>
                </div>
                <div class="alert-text">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        {{-- TABLE CONTAINER --}}
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th class="text-center" width="60px">No</th>
                        <th width="20%">Kode</th>
                        <th>Nama Kamar</th>
                        <th width="20%">Status</th>
                        <th class="text-center" width="220px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($kamars as $kamar)
                        <tr>
                            <td class="text-center text-muted-no">{{ $loop->iteration }}</td>

                            <td>
                                <span class="kode-badge">
                                    {{ $kamar->kode }}
                                </span>
                            </td>

                            <td style="font-weight: 600; color: #2c3e50;">
                                {{ $kamar->nama }}
                            </td>

                            <td>
                                @if($kamar->status == 'aktif')
                                    <span class="status-badge status-aktif">
                                        Aktif
                                    </span>
                                @elseif($kamar->status == 'rusak' || $kamar->status == 'perbaikan')
                                    <span class="status-badge status-perbaikan">
                                        Perbaikan
                                    </span>
                                @else
                                    <span class="status-badge status-tidak-aktif">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td class="aksi-column">
                                <div class="d-inline-flex">
                                    {{-- LIHAT --}}
                                    <button type="button"
                                            class="btn-aksi btn-lihat"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalLihatKamar{{ $kamar->id }}">
                                        <i class="fas fa-eye"></i> Lihat
                                    </button>

                                    {{-- EDIT --}}
                                    <button type="button"
                                            class="btn-aksi btn-edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEditKamar{{ $kamar->id }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('master-kamar.destroy', $kamar->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-aksi btn-hapus">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-data">
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

{{-- MODAL TAMBAH KAMAR --}}
<div class="modal fade"
     id="modalTambahKamar"
     tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kamar</h5>
            </div>

            <form action="{{ route('master-kamar.store') }}" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Kamar</label>
                        <input type="text"
                               name="kode"
                               class="form-control"
                               placeholder="Contoh: KMR001"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kamar</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Contoh: Kamar Mawar 01"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Status --</option>
                            <option value="aktif">Terisi</option>
                            <option value="tidak aktif">Tersedia</option>
                         
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-modal-simpan">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL LIHAT & EDIT KAMAR (DITARUH DI LUAR TABEL) --}}
@foreach($kamars as $kamar)
    {{-- MODAL LIHAT KAMAR --}}
    <div class="modal fade"
         id="modalLihatKamar{{ $kamar->id }}"
         tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kamar</h5>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Kode Kamar</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $kamar->kode }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kamar</label>
                        <input type="text"
                               class="form-control"
                               value="{{ $kamar->nama }}"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text"
                               class="form-control"
                               value="{{ ucfirst($kamar->status) }}"
                               readonly>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT KAMAR --}}
    <div class="modal fade"
         id="modalEditKamar{{ $kamar->id }}"
         tabindex="-1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kamar</h5>
                </div>

                <form action="{{ route('master-kamar.update', $kamar->id) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Kamar</label>
                            <input type="text"
                                   name="kode"
                                   class="form-control"
                                   value="{{ $kamar->kode }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Kamar</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ $kamar->nama }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="aktif" {{ $kamar->status == 'terisi' || $kamar->status == 'tersedia' ? 'selected' : '' }}>Terisi (Ready)</option>
                                <option value="perbaikan" {{ $kamar->status == 'tersedia' || $kamar->status == 'maintenance' ? 'selected' : '' }}>Tersedia (Maintenance)</option>

                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn-modal-batal"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn-modal-simpan">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection
