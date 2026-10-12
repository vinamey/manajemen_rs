
@extends('layouts.superadmin')

@section('page-title', 'Dashboard Pemeriksaan Dokter')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --blue-soft: #f4f8ff;
        --text-dark: #1f2937;
    }

    body {
        background: #f4f6fa;
    }

    .page-header {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        color: white;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(24,119,242,.18);
    }

    .page-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .page-header p {
        margin: 5px 0 0;
        opacity: .85;
    }

    .card-main {
        border: none;
        border-radius: 18px;
        background: white;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
        overflow: hidden;
    }

    .card-header-custom {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .card-header-custom h5 {
        margin: 0;
        font-weight: 700;
        color: var(--text-dark);
    }

    .btn-blue,
    .btn-add-obat {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 10px 17px;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-blue:hover,
    .btn-add-obat:hover {
        background: var(--blue-dark);
        color: white;
    }


/* HEADER TABEL BIRU */
.table thead th {
    background: #1877f2 !important;
    color: #ffffff !important;
    font-weight: 700;
    border: 1px solid #dbe2ea;
    padding: 12px 10px;
    white-space: nowrap;
    font-size: 13px;
}

/* ISI TABEL */
.table tbody td {
    background: #ffffff;
    color: #374151;
    vertical-align: middle;
    padding: 10px;
    border: 1px solid #e5e7eb;
}

/* EFEK SAAT BARIS DISOROT */
.table tbody tr:hover td {
    background: #f0f7ff;
}


    .badge-blue {
        display: inline-block;
        background: var(--blue-light);
        color: var(--blue-dark);
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 600;
    }

    /* TOMBOL AKSI: LIHAT, EDIT, HAPUS */
    .aksi-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-aksi {
        width: 29px;
        height: 29px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 7px;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
        transition: all .2s ease;
        flex-shrink: 0;
    }

    .btn-lihat {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-lihat:hover {
        background: #bae6fd;
        color: #0369a1;
    }

    .btn-edit {
        background: #1877f2;
        color: #fff;
    }

    .btn-edit:hover {
        background: #0f58c6;
        color: #fff;
    }

    .btn-hapus {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-hapus:hover {
        background: #fecaca;
        color: #b91c1c;
    }

    .form-hapus {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    .modal-content {
        border: none;
        border-radius: 18px;
        overflow: visible;
        box-shadow: 0 15px 45px rgba(0,0,0,.18);
    }

    .modal-header-blue {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        color: white;
        padding: 18px 22px;
        border-radius: 18px 18px 0 0;
    }

    .modal-header-blue h5 {
        margin: 0;
        font-weight: 700;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .form-control,
    .form-select {
        border-radius: 9px;
        border: 1px solid #dbe2ea;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 .2rem rgba(24,119,242,.12);
    }

    .resep-box {
        background: var(--blue-soft);
        border: 1px solid #dbeafe;
        border-radius: 13px;
        padding: 15px;
    }

    .table-resep {
        background: white;
        border-radius: 10px;
        overflow-x: auto;
    }

    .table-resep thead th {
        background: var(--blue-light);
        font-size: 13px;
    }

    .empty-resep {
        text-align: center;
        color: #9ca3af;
        padding: 25px;
    }

    /* DROPDOWN ATURAN PAKAI */
    .aturan-pakai-wrapper {
        position: relative;
        width: 100%;
    }

    .aturan-pakai-input-wrapper {
        position: relative;
    }

    #aturan_pakai {
        width: 100%;
        padding-right: 42px;
        background: #fff;
    }

    .aturan-pakai-arrow {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #64748b;
        pointer-events: none;
        transition: transform .2s ease;
    }

    .aturan-pakai-wrapper.active .aturan-pakai-arrow {
        transform: translateY(-50%) rotate(180deg);
    }

    .aturan-pakai-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #d8dee8;
        border-radius: 8px;
        max-height: 220px;
        overflow-y: auto;
        z-index: 1060;
        box-shadow: 0 8px 20px rgba(0,0,0,.12);
    }

    .aturan-pakai-wrapper.active .aturan-pakai-dropdown {
        display: block;
    }

    .aturan-pakai-option {
        padding: 11px 14px;
        font-size: 14px;
        color: #374151;
        cursor: pointer;
        background: white;
    }

    .aturan-pakai-option:hover {
        background: #eef5ff;
        color: #1769e0;
    }

    .aturan-pakai-no-result {
        padding: 12px 14px;
        color: #94a3b8;
        font-size: 14px;
        text-align: center;
    }

    .aturan-pakai-dropdown::-webkit-scrollbar {
        width: 6px;
    }

    .aturan-pakai-dropdown::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    @media (max-width: 576px) {
        .page-header {
            padding: 18px;
        }

        .card-header-custom {
            align-items: flex-start;
        }

        .aksi-wrapper {
            gap: 4px;
        }
    }


/* Modal tambah pemeriksaan */
#modalPemeriksaan .modal-dialog {
    max-width: 900px;
    width: calc(100% - 32px);
    margin: 1.75rem auto;
}

#modalPemeriksaan .modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
}

#modalPemeriksaan .modal-body {
    padding: 24px;
}

#modalPemeriksaan .form-control,
#modalPemeriksaan .form-select {
    width: 100%;
    min-height: 42px;
    border-radius: 8px;
}

#modalPemeriksaan textarea.form-control {
    min-height: 100px;
}

@media (max-width: 576px) {
    #modalPemeriksaan .modal-body {
        padding: 16px;
    }
}


#modalTambahPemeriksaan .modal-footer {
    display: flex !important;
    justify-content: flex-end;
    gap: 10px;
    padding: 16px 20px;
    border-top: 1px solid #dee2e6;
    background: #fff;
    position: relative;
    z-index: 5;
}

#modalTambahPemeriksaan .modal-footer button {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
}


</style>

{{-- HEADER --}}
<div class="page-header">
    <h3>
        <i class="fa-solid fa-stethoscope me-2"></i>
        Dashboard Pemeriksaan Dokter
    </h3>
    <p>Kelola pemeriksaan pasien dan resep obat dokter.</p>
</div>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- TABEL PEMERIKSAAN --}}
<div class="card-main">
    <div class="card-header-custom">
        <h5>
            <i class="fa-solid fa-notes-medical me-2 text-primary"></i>
            Data Pemeriksaan Dokter
        </h5>

        <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPemeriksaan"
        >
            <i class="fa-solid fa-plus me-1"></i>
            Tambah Pemeriksaan
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th width="60">No</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Keluhan</th>
                    <th>Tanggal</th>
                    <th width="130" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pemeriksaans as $pemeriksaan)
                    <tr>
                        <td>
                            {{ $pemeriksaans->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <strong>
                                {{ $pemeriksaan->pendaftaran->pasien->nama ?? '-' }}
                            </strong>
                        </td>

                        <td>
                            {{ $pemeriksaan->dokter->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $pemeriksaan->keluhan ?? '-' }}
                        </td>

                        <td>
                            <span class="badge-blue">
                                {{ $pemeriksaan->created_at
                                    ? $pemeriksaan->created_at->format('d/m/Y')
                                    : '-' }}
                            </span>
                        </td>

                        <td class="text-center">
                            <div class="aksi-wrapper">
                                {{-- LIHAT --}}
                                <a
                                    href="{{ route('pemeriksaan-dokter.show', $pemeriksaan->id) }}"
                                    class="btn-aksi btn-lihat"
                                    title="Lihat"
                                    aria-label="Lihat pemeriksaan"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                {{-- EDIT --}}
                                <a
                                    href="{{ route('pemeriksaan-dokter.edit', $pemeriksaan->id) }}"
                                    class="btn-aksi btn-edit"
                                    title="Edit"
                                    aria-label="Edit pemeriksaan"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- HAPUS --}}
                                <form
                                    action="{{ route('pemeriksaan-dokter.destroy', $pemeriksaan->id) }}"
                                    method="POST"
                                    class="form-hapus"
                                    onsubmit="return confirm('Yakin ingin menghapus data pemeriksaan ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn-aksi btn-hapus"
                                        title="Hapus"
                                        aria-label="Hapus pemeriksaan"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-file-medical fa-2x mb-2"></i>
                            <br>
                            Belum ada data pemeriksaan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pemeriksaans->hasPages())
        <div class="p-3">
            {{ $pemeriksaans->links() }}
        </div>
    @endif
</div>

{{-- MODAL TAMBAH PEMERIKSAAN --}}
<div
    class="modal fade"
    id="modalTambahPemeriksaan"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header modal-header-blue">
                <h5 class="mb-0">
                    <i class="fa-solid fa-file-medical me-2"></i>
                    Tambah Pemeriksaan Dokter
                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>
            </div>

            {{-- FORM --}}
            <form
                action="{{ route('pemeriksaan-dokter.store') }}"
                method="POST"
                id="formPemeriksaan"
            >
                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        {{-- PILIH PASIEN DARI PENDAFTARAN --}}
                        <div class="col-md-6">
                            <label for="pendaftaran_id" class="form-label">
                                Pasien
                            </label>

                            <select
                                name="pendaftaran_id"
                                id="pendaftaran_id"
                                class="form-select"
                                required
                            >
                                <option value="">
                                    -- Pilih Pasien dari Pendaftaran --
                                </option>

                                @foreach($pendaftarans as $pendaftaran)
                                    <option
                                        value="{{ $pendaftaran->id }}"
                                        data-dokter="{{ $pendaftaran->dokter?->nama ?? '' }}"
                                        data-poli="{{ $pendaftaran->poli?->nama ?? '' }}"
                                        data-keluhan="{{ $pendaftaran->keluhan ?? '' }}"
                                    >
                                        {{ $pendaftaran->pasien?->nama_pasien
                                            ?? $pendaftaran->pasien?->nama
                                            ?? 'Pasien tidak ditemukan' }}
                                        @if($pendaftaran->nomor_antrian)
                                            - Antrian {{ $pendaftaran->nomor_antrian }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            <small class="text-muted">
                                Pilih pasien yang sudah terdaftar.
                                Data dokter dan poli akan terisi otomatis.
                            </small>
                        </div>

                        {{-- DOKTER OTOMATIS --}}
                        <div class="col-md-6">
                            <label for="dokter_nama" class="form-label">
                                Dokter
                            </label>

                            <input
                                type="text"
                                id="dokter_nama"
                                class="form-control"
                                placeholder="Dokter terisi otomatis"
                                readonly
                            >
                        </div>

                        {{-- POLI OTOMATIS --}}
                        <div class="col-md-6">
                            <label for="poli_nama" class="form-label">
                                Poli
                            </label>

                            <input
                                type="text"
                                id="poli_nama"
                                class="form-control"
                                placeholder="Poli terisi otomatis"
                                readonly
                            >
                        </div>

                        {{-- KELUHAN --}}
                        <div class="col-12">
                            <label for="keluhan" class="form-label">
                                Keluhan
                            </label>

                            <textarea
                                name="keluhan"
                                id="keluhan"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan keluhan pasien..."
                                required
                            ></textarea>
                        </div>

                    </div>

                    <hr class="my-4">

                    {{-- RESEP OBAT --}}
                    <div class="resep-box">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <div>
                                <h5 class="mb-1">
                                    <i class="fa-solid fa-pills text-primary me-2"></i>
                                    Resep Obat
                                </h5>
                                <small class="text-muted">
                                    Tambahkan obat yang diresepkan dokter.
                                </small>
                            </div>

                            <button
                                type="button"
                                class="btn-add-obat"
                                data-bs-toggle="modal"
                                data-bs-target="#modalTambahObat"
                            >
                                <i class="fa-solid fa-plus me-1"></i>
                                Tambah Obat
                            </button>
                        </div>

                        <input
                            type="hidden"
                            name="resep_obat"
                            id="resep_obat"
                            value="[]"
                        >

                        <div class="table-responsive table-resep">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th width="50">No</th>
                                        <th>Obat</th>
                                        <th>Jumlah</th>
                                        <th>Dosis</th>
                                        <th>Frekuensi</th>
                                        <th>Aturan Pakai</th>
                                        <th>Lama</th>
                                        <th width="70">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="resepTableBody">
                                    <tr>
                                        <td colspan="8" class="empty-resep">
                                            <i class="fa-solid fa-pills fa-2x mb-2"></i>
                                            <br>
                                            Belum ada obat yang ditambahkan.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save me-1"></i>
                        Simpan Pemeriksaan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH OBAT --}}
<div
    class="modal fade"
    id="modalTambahObat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-blue">
                <h5>
                    <i class="fa-solid fa-pills me-2"></i>
                    Tambah Obat Resep
                </h5>
                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Tutup"
                ></button>
            </div>

            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="obat_id">Obat</label>
                        <select id="obat_id" class="form-select">
                            <option value="">-- Pilih Obat --</option>
                            @foreach($obats ?? [] as $obat)
                                <option value="{{ $obat->id }}">
                                    {{ $obat->nama }}
                                    @if($obat->kategori)
                                        - {{ $obat->kategori->nama }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="jumlah_obat">
                            Jumlah Obat
                        </label>
                        <input
                            type="number"
                            id="jumlah_obat"
                            class="form-control"
                            min="1"
                            step="1"
                            placeholder="Contoh: 10"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="dosis_obat">Dosis</label>
                        <input
                            type="text"
                            id="dosis_obat"
                            class="form-control"
                            placeholder="Contoh: 500 mg"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="frekuensi_obat">
                            Frekuensi
                        </label>
                        <input
                            type="text"
                            id="frekuensi_obat"
                            class="form-control"
                            placeholder="Contoh: 3"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="lama_obat">
                            Lama Pemakaian (hari)
                        </label>
                        <input
                            type="number"
                            id="lama_obat"
                            class="form-control"
                            min="1"
                            step="1"
                            placeholder="Contoh: 5"
                        >
                    </div>

                    {{-- ATURAN PAKAI --}}
                    <div class="col-12">
                        <label class="form-label" for="aturan_pakai">
                            Aturan Pakai
                        </label>

                        <div class="aturan-pakai-wrapper">
                            <div class="aturan-pakai-input-wrapper">
                                <input
                                    type="text"
                                    id="aturan_pakai"
                                    class="form-control"
                                    placeholder="Ketik untuk mencari aturan pakai..."
                                    autocomplete="off"
                                >
                                <span class="aturan-pakai-arrow">▾</span>
                            </div>

                            <div
                                id="aturanPakaiDropdown"
                                class="aturan-pakai-dropdown"
                            >
                                @foreach([
                                    'Sebelum makan',
                                    'Sesudah makan',
                                    'Saat makan',
                                    'Sebelum tidur',
                                    'Sesudah bangun tidur',
                                    'Pagi hari',
                                    'Siang hari',
                                    'Sore hari',
                                    'Malam hari',
                                    'Sebelum makan & sebelum tidur',
                                    'Sesudah makan & sebelum tidur',
                                    'Saat diperlukan',
                                    'Sesuai petunjuk dokter',
                                    'Dengan air putih',
                                    'Dikonsumsi bersama makanan'
                                ] as $aturan)
                                    <div
                                        class="aturan-pakai-option"
                                        data-value="{{ $aturan }}"
                                    >
                                        {{ $aturan }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="btnTambahkanObat"
                >
                    <i class="fa-solid fa-plus me-1"></i>
                    Tambahkan Obat
                </button>
            </div>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    let daftarObat = [];

    const formPemeriksaan = document.getElementById('formPemeriksaan');
    const modalPemeriksaanEl = document.getElementById('modalTambahPemeriksaan');
    const modalObatEl = document.getElementById('modalTambahObat');
    const wrapper = document.querySelector('.aturan-pakai-wrapper');
    const inputAturan = document.getElementById('aturan_pakai');
    const dropdownAturan = document.getElementById('aturanPakaiDropdown');

    /*
     * Aturan pakai: buka dropdown dan cari pilihan.
     */
    function filterAturanPakai(keyword) {
        const options = dropdownAturan.querySelectorAll('.aturan-pakai-option');
        const search = keyword.trim().toLowerCase();
        let ditemukan = 0;

        options.forEach(function (option) {
            const cocok = option.dataset.value.toLowerCase().includes(search);
            option.style.display = cocok ? 'block' : 'none';
            if (cocok) ditemukan++;
        });

        let noResult = dropdownAturan.querySelector('.aturan-pakai-no-result');

        if (ditemukan === 0) {
            if (!noResult) {
                noResult = document.createElement('div');
                noResult.className = 'aturan-pakai-no-result';
                noResult.textContent = 'Aturan pakai tidak ditemukan';
                dropdownAturan.appendChild(noResult);
            }
            noResult.style.display = 'block';
        } else if (noResult) {
            noResult.style.display = 'none';
        }
    }

    inputAturan.addEventListener('focus', function () {
        wrapper.classList.add('active');
        filterAturanPakai(this.value);
    });

    inputAturan.addEventListener('input', function () {
        wrapper.classList.add('active');
        filterAturanPakai(this.value);
    });

    dropdownAturan.addEventListener('click', function (event) {
        const option = event.target.closest('.aturan-pakai-option');
        if (!option) return;

        inputAturan.value = option.dataset.value;
        wrapper.classList.remove('active');
        inputAturan.dispatchEvent(new Event('change', { bubbles: true }));
    });

    document.addEventListener('click', function (event) {
        if (!wrapper.contains(event.target)) {
            wrapper.classList.remove('active');
        }
    });

    inputAturan.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            wrapper.classList.remove('active');
            inputAturan.blur();
        }

        if (event.key === 'Enter' && wrapper.classList.contains('active')) {
            const visibleOption = dropdownAturan.querySelector(
                '.aturan-pakai-option[style*="display: block"]'
            );

            if (visibleOption) {
                event.preventDefault();
                visibleOption.click();
            }
        }
    });

    /*
     * Reset input obat.
     */
    function resetFormObat() {
        document.getElementById('obat_id').value = '';
        document.getElementById('jumlah_obat').value = '';
        document.getElementById('dosis_obat').value = '';
        document.getElementById('frekuensi_obat').value = '';
        document.getElementById('aturan_pakai').value = '';
        document.getElementById('lama_obat').value = '';
        wrapper.classList.remove('active');
        filterAturanPakai('');
    }

    /*
     * Tambahkan obat ke daftar resep.
     */
    document.getElementById('btnTambahkanObat').addEventListener('click', function () {
        const selectObat = document.getElementById('obat_id');
        const jumlah = document.getElementById('jumlah_obat').value.trim();
        const dosis = document.getElementById('dosis_obat').value.trim();
        const frekuensi = document.getElementById('frekuensi_obat').value.trim();
        const aturan = document.getElementById('aturan_pakai').value.trim();
        const lama = document.getElementById('lama_obat').value.trim();

        if (!selectObat.value) {
            alert('Silakan pilih obat terlebih dahulu.');
            selectObat.focus();
            return;
        }

        if (!jumlah || Number(jumlah) < 1 || !Number.isInteger(Number(jumlah))) {
            alert('Jumlah obat harus berupa bilangan bulat minimal 1.');
            document.getElementById('jumlah_obat').focus();
            return;
        }

        if (!dosis) {
            alert('Silakan isi dosis obat.');
            document.getElementById('dosis_obat').focus();
            return;
        }

        if (!frekuensi) {
            alert('Silakan isi frekuensi obat.');
            document.getElementById('frekuensi_obat').focus();
            return;
        }

        const option = selectObat.options[selectObat.selectedIndex];

        daftarObat.push({
            obat_id: selectObat.value,
            nama_obat: option.text.trim(),
            jumlah: Number(jumlah),
            dosis: dosis,
            frekuensi: frekuensi,
            aturan_pakai: aturan,
            lama: lama
        });

        tampilkanObat();
        resetFormObat();

        /*
         * Tutup modal obat lalu kembalikan fokus ke modal pemeriksaan.
         */
        bootstrap.Modal.getOrCreateInstance(modalObatEl).hide();
    });

    /*
     * Render ulang tabel resep.
     */
    function tampilkanObat() {
        const tbody = document.getElementById('resepTableBody');
        const hiddenResep = document.getElementById('resep_obat');

        tbody.innerHTML = '';

        if (daftarObat.length === 0) {
            const row = document.createElement('tr');
            const cell = document.createElement('td');

            cell.colSpan = 8;
            cell.className = 'empty-resep';
            cell.innerHTML =
                '<i class="fa-solid fa-pills fa-2x mb-2"></i><br>' +
                'Belum ada obat yang ditambahkan.';

            row.appendChild(cell);
            tbody.appendChild(row);
            hiddenResep.value = '[]';
            return;
        }

        daftarObat.forEach(function (obat, index) {
            const row = document.createElement('tr');

            function tambahCell(value) {
                const cell = document.createElement('td');
                cell.textContent = value;
                row.appendChild(cell);
            }

            tambahCell(index + 1);
            tambahCell(obat.nama_obat);
            tambahCell(obat.jumlah);
            tambahCell(obat.dosis);
            tambahCell(obat.frekuensi + ' x sehari');
            tambahCell(obat.aturan_pakai || '-');
            tambahCell(obat.lama ? obat.lama + ' hari' : '-');

            const actionCell = document.createElement('td');
            const deleteButton = document.createElement('button');

            deleteButton.type = 'button';
            deleteButton.className = 'btn btn-sm btn-danger';
            deleteButton.title = 'Hapus obat';
            deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>';

            deleteButton.addEventListener('click', function () {
                daftarObat.splice(index, 1);
                tampilkanObat();
            });

            actionCell.appendChild(deleteButton);
            row.appendChild(actionCell);
            tbody.appendChild(row);
        });

        hiddenResep.value = JSON.stringify(daftarObat);
    }

    /*
     * Pastikan JSON resep terbaru terkirim saat form disimpan.
     */
    formPemeriksaan.addEventListener('submit', function () {
        document.getElementById('resep_obat').value =
            JSON.stringify(daftarObat);
    });

    /*
     * Bersihkan resep ketika modal tambah pemeriksaan ditutup,
     * supaya tidak terbawa ke pemeriksaan baru berikutnya.
     */
    modalPemeriksaanEl.addEventListener('hidden.bs.modal', function () {
        daftarObat = [];
        tampilkanObat();
        formPemeriksaan.reset();
        resetFormObat();
    });

    modalPemeriksaanEl.addEventListener('shown.bs.modal', function () {
        tampilkanObat();
    });

    /*
     * Setelah modal obat tertutup, modal pemeriksaan tetap terbuka.
     */
    modalObatEl.addEventListener('hidden.bs.modal', function () {
        wrapper.classList.remove('active');
    });

    tampilkanObat();
    filterAturanPakai('');

    // Mengisi dokter dan poli otomatis dari pendaftaran pasien
    const pasienSelect = document.getElementById('pendaftaran_id');
    const dokterInput = document.getElementById('dokter_nama');
    const poliInput = document.getElementById('poli_nama');

    function isiDataPendaftaran() {
        if (!pasienSelect || !dokterInput || !poliInput) {
            return;
        }

        const option = pasienSelect.options[pasienSelect.selectedIndex];

        dokterInput.value = option?.dataset.dokter || '';
        poliInput.value = option?.dataset.poli || '';
    }

    if (pasienSelect) {
        pasienSelect.addEventListener('change', isiDataPendaftaran);
        isiDataPendaftaran();
    }
});
</script>

@endsection

