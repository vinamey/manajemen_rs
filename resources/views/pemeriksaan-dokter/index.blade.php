
@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Pemeriksaan Dokter')

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

    .table thead th {
        background: #1877f2 !important;
        color: #ffffff !important;
        font-weight: 700;
        border: 1px solid #dbe2ea;
        padding: 12px 10px;
        white-space: nowrap;
        font-size: 13px;
    }

    .table tbody td {
        background: #ffffff;
        color: #374151;
        vertical-align: middle;
        padding: 10px;
        border: 1px solid #e5e7eb;
    }

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

    .empty-resep {
        text-align: center;
        color: #9ca3af;
        padding: 25px;
    }

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

    #modalTambahPemeriksaan .modal-dialog {
        max-height: 95vh;
    }

    #modalTambahPemeriksaan .modal-content {
        max-height: 95vh;
        display: flex;
        flex-direction: column;
    }

    #modalTambahPemeriksaan .modal-body {
        overflow-y: auto;
        max-height: calc(95vh - 130px);
    }

    #modalTambahPemeriksaan .modal-body::-webkit-scrollbar {
        width: 7px;
    }

    #modalTambahPemeriksaan .modal-body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    #modalTambahPemeriksaan .modal-body::-webkit-scrollbar-thumb {
        background: #94a3b8;
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

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
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

                                <a
                                    href="{{ route('pemeriksaan-dokter.show', $pemeriksaan->id) }}"
                                    class="btn-aksi btn-lihat"
                                    title="Lihat"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a
                                    href="{{ route('pemeriksaan-dokter.edit', $pemeriksaan->id) }}"
                                    class="btn-aksi btn-edit"
                                    title="Edit"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

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

            {{-- HEADER MODAL --}}
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

            {{-- FORM PEMERIKSAAN --}}
            <form
                action="{{ route('pemeriksaan-dokter.store') }}"
                method="POST"
                id="formPemeriksaan"
            >
                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- PILIH PASIEN --}}
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

                        {{-- DOKTER --}}
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

                        {{-- POLI --}}
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

                        <div class="mb-3">
                            <h5 class="mb-1">
                                <i class="fa-solid fa-pills text-primary me-2"></i>
                                Resep Obat
                            </h5>

                            <small class="text-muted">
                                Pilih obat dan satuan sesuai stok yang tersedia.
                            </small>
                        </div>

                        {{-- INPUT OBAT --}}
                        <div class="row g-3">

                            {{-- NAMA OBAT --}}
                            <div class="col-12">
                                <label for="obat_id" class="form-label">
                                    Obat
                                </label>

                                <select id="obat_id" class="form-select">
                                    <option value="">
                                        -- Pilih Obat --
                                    </option>

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

                            {{-- SATUAN OBAT --}}
                            <div class="col-md-6">
                                <label for="satuan_obat_id" class="form-label">
                                    Satuan Obat
                                </label>

                                <select
                                    id="satuan_obat_id"
                                    class="form-select"
                                    disabled
                                >
                                    <option value="">
                                        -- Pilih obat terlebih dahulu --
                                    </option>
                                </select>

                                <small class="text-muted">
                                    Satuan mengikuti stok obat yang dipilih.
                                </small>
                            </div>

                            {{-- JUMLAH --}}
                            <div class="col-md-6">
                                <label for="jumlah_obat" class="form-label">
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


                           {{-- FREKUENSI --}}
                            <div class="col-md-6">
                                <label for="frekuensi_obat" class="form-label">
                                    Frekuensi
                                </label>

                                <select
                                    id="frekuensi_obat"
                                    class="form-select"
                                >
                                    <option value="">
                                        -- Pilih Frekuensi --
                                    </option>

                                    @forelse($frekuensis as $frekuensi)
                                        <option value="{{ $frekuensi->nama }}">
                                            {{ $frekuensi->nama }}
                                        </option>
                                    @empty
                                        <option value="" disabled>
                                            Belum ada data frekuensi
                                        </option>
                                    @endforelse

                                </select>
                            </div>

                            {{-- LAMA --}}
                            <div class="col-md-6">
                                <label for="lama_obat" class="form-label">
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
                                <label for="aturan_pakai" class="form-label">
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

                            {{-- TOMBOL TAMBAH OBAT --}}
                            <div class="col-12">
                                <button
                                    type="button"
                                    id="btnTambahkanObat"
                                    class="btn btn-success"
                                >
                                    <i class="fa-solid fa-plus me-1"></i>
                                    Tambahkan Obat
                                </button>
                            </div>

                        </div>

                        <hr class="my-4">

                        {{-- DAFTAR OBAT --}}
                        <h6 class="mb-3">
                            <i class="fa-solid fa-list me-2"></i>
                            Daftar Obat yang Diresepkan
                        </h6>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Frekuensi</th>
                                        <th>Lama</th>
                                        <th>Aturan Pakai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="resepTableBody">
                                    <tr>
                                        <td colspan="9" class="empty-resep">
                                            Belum ada obat ditambahkan.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- HIDDEN JSON --}}
                        <input
                            type="hidden"
                            name="resep_obat"
                            id="resep_obat"
                            value="[]"
                        >

                        {{-- TOMBOL SIMPAN --}}
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-prescription-bottle-medical me-1"></i>
                                Simpan Pemeriksaan dan Resep
                            </button>
                        </div>

                    </div>

                </div>
            </form>

        </div>
    </div>
</div>

{{-- DATA STOK OBAT DARI LARAVEL --}}
@php
    $dataStokObat = ($stokObats ?? collect())->map(function ($stok) {
        return [
            'obat_id' => $stok->obat_id,
            'satuan_obat_id' => $stok->satuan_obat_id,

            // Ambil nama satuan dari kolom "nama"
            'nama_satuan' => $stok->satuanObat->nama ?? 'Satuan tidak ditemukan',

            'stok_tersedia' => $stok->stok_tersedia,
        ];
    })->values()->toArray();
@endphp

{{-- JAVASCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    let daftarObat = [];

    const formPemeriksaan = document.getElementById('formPemeriksaan');
    const modalPemeriksaanEl = document.getElementById('modalTambahPemeriksaan');

    const pasienSelect = document.getElementById('pendaftaran_id');
    const dokterInput = document.getElementById('dokter_nama');
    const poliInput = document.getElementById('poli_nama');
    const keluhanInput = document.getElementById('keluhan');

    const selectObat = document.getElementById('obat_id');
    const selectSatuan = document.getElementById('satuan_obat_id');

    const jumlahInput = document.getElementById('jumlah_obat');
    const frekuensiInput = document.getElementById('frekuensi_obat');
    const lamaInput = document.getElementById('lama_obat');
    const aturanInput = document.getElementById('aturan_pakai');

    const tombolTambah = document.getElementById('btnTambahkanObat');
    const tbody = document.getElementById('resepTableBody');
    const hiddenResep = document.getElementById('resep_obat');

    const wrapper = document.querySelector('.aturan-pakai-wrapper');
    const dropdownAturan = document.getElementById('aturanPakaiDropdown');

    // DATA STOK OBAT DARI LARAVEL
    const dataStokObat = @json($dataStokObat);

    // CEK ELEMEN
    if (
        !formPemeriksaan ||
        !modalPemeriksaanEl ||
        !selectObat ||
        !selectSatuan ||
        !tombolTambah ||
        !tbody ||
        !hiddenResep
    ) {
        console.error('Elemen form pemeriksaan atau resep tidak ditemukan.');
        return;
    }

    // FILTER SATUAN BERDASARKAN OBAT YANG DIPILIH
    function filterSatuanObat() {

        const obatId = selectObat.value;

        selectSatuan.innerHTML = '';

        if (!obatId) {
            selectSatuan.innerHTML = `
                <option value="">
                    -- Pilih obat terlebih dahulu --
                </option>
            `;

            selectSatuan.disabled = true;
            return;
        }

        const satuanTersedia = dataStokObat.filter(function (stok) {
            return String(stok.obat_id) === String(obatId);
        });

        if (satuanTersedia.length === 0) {
            selectSatuan.innerHTML = `
                <option value="">
                    Stok untuk obat ini belum tersedia
                </option>
            `;

            selectSatuan.disabled = true;
            return;
        }

        selectSatuan.disabled = false;

        const pilihanAwal = document.createElement('option');
        pilihanAwal.value = '';
        pilihanAwal.textContent = '-- Pilih Satuan --';

        selectSatuan.appendChild(pilihanAwal);

        satuanTersedia.forEach(function (stok) {

            const option = document.createElement('option');

            option.value = stok.satuan_obat_id;
            option.dataset.stok = stok.stok_tersedia;

            option.textContent =
                stok.nama_satuan +
                ' (Stok: ' + stok.stok_tersedia + ')';

            selectSatuan.appendChild(option);
        });
    }

    // KETIKA OBAT DIPILIH
    selectObat.addEventListener('change', function () {
        filterSatuanObat();
    });

    // FILTER ATURAN PAKAI
    function filterAturanPakai(keyword) {

        if (!dropdownAturan) return;

        const options = dropdownAturan.querySelectorAll('.aturan-pakai-option');
        const search = keyword.trim().toLowerCase();

        let ditemukan = 0;

        options.forEach(function (option) {

            const cocok = option.dataset.value
                .toLowerCase()
                .includes(search);

            option.style.display = cocok ? 'block' : 'none';

            if (cocok) {
                ditemukan++;
            }
        });

        let noResult = dropdownAturan.querySelector(
            '.aturan-pakai-no-result'
        );

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

    // DROPDOWN ATURAN PAKAI
    if (aturanInput && wrapper && dropdownAturan) {

        aturanInput.addEventListener('focus', function () {
            wrapper.classList.add('active');
            filterAturanPakai(this.value);
        });

        aturanInput.addEventListener('input', function () {
            wrapper.classList.add('active');
            filterAturanPakai(this.value);
        });

        dropdownAturan.addEventListener('click', function (event) {

            const option = event.target.closest('.aturan-pakai-option');

            if (!option) return;

            aturanInput.value = option.dataset.value;
            wrapper.classList.remove('active');
        });

        document.addEventListener('click', function (event) {

            if (!wrapper.contains(event.target)) {
                wrapper.classList.remove('active');
            }
        });

        aturanInput.addEventListener('keydown', function (event) {

            if (event.key === 'Escape') {
                wrapper.classList.remove('active');
                aturanInput.blur();
            }

            if (
                event.key === 'Enter' &&
                wrapper.classList.contains('active')
            ) {

                const visibleOption = Array.from(
                    dropdownAturan.querySelectorAll('.aturan-pakai-option')
                ).find(function (option) {
                    return option.style.display !== 'none';
                });

                if (visibleOption) {
                    event.preventDefault();
                    visibleOption.click();
                }
            }
        });
    }

    // RESET INPUT OBAT
    function resetFormObat() {

        selectObat.value = '';

        selectSatuan.innerHTML = `
            <option value="">
                -- Pilih obat terlebih dahulu --
            </option>
        `;

        selectSatuan.disabled = true;

        jumlahInput.value = '';
        frekuensiInput.value = '';
        lamaInput.value = '';
        aturanInput.value = '';

        if (wrapper) {
            wrapper.classList.remove('active');
        }

        filterAturanPakai('');
    }

    // TAMPILKAN DAFTAR OBAT
    function tampilkanObat() {

        tbody.innerHTML = '';

        if (daftarObat.length === 0) {

            const row = document.createElement('tr');
            const cell = document.createElement('td');

            cell.colSpan = 9;
            cell.className = 'empty-resep';
            cell.textContent = 'Belum ada obat ditambahkan.';

            row.appendChild(cell);
            tbody.appendChild(row);

            hiddenResep.value = '[]';

            return;
        }

        daftarObat.forEach(function (obat, index) {

            const row = document.createElement('tr');

            const data = [
                index + 1,
                obat.nama_obat,
                obat.nama_satuan,
                obat.jumlah,
                obat.frekuensi,
                obat.lama ? obat.lama + ' hari' : '-',
                obat.aturan_pakai || '-'
            ];

            data.forEach(function (value) {

                const cell = document.createElement('td');
                cell.textContent = value;

                row.appendChild(cell);
            });

            // TOMBOL HAPUS
            const actionCell = document.createElement('td');
            const tombolHapus = document.createElement('button');

            tombolHapus.type = 'button';
            tombolHapus.className = 'btn btn-sm btn-danger';
            tombolHapus.innerHTML = '<i class="fa-solid fa-trash"></i>';
            tombolHapus.title = 'Hapus obat';

            tombolHapus.addEventListener('click', function () {
                daftarObat.splice(index, 1);
                tampilkanObat();
            });

            actionCell.appendChild(tombolHapus);
            row.appendChild(actionCell);
            tbody.appendChild(row);
        });

        // KIRIM DATA RESEP KE CONTROLLER
        hiddenResep.value = JSON.stringify(daftarObat);
    }

    // TAMBAHKAN OBAT KE DAFTAR
    tombolTambah.addEventListener('click', function () {

        const obatId = selectObat.value;
        const satuanId = selectSatuan.value;

        const jumlah = jumlahInput.value.trim();
        const frekuensi = frekuensiInput.value.trim();
        const lama = lamaInput.value.trim();
        const aturan = aturanInput.value.trim();

        // VALIDASI OBAT
        if (!obatId) {
            alert('Silakan pilih obat terlebih dahulu.');
            selectObat.focus();
            return;
        }

        // VALIDASI SATUAN
        if (!satuanId) {
            alert('Silakan pilih satuan obat terlebih dahulu.');
            selectSatuan.focus();
            return;
        }

        // VALIDASI JUMLAH
        if (
            !jumlah ||
            !Number.isInteger(Number(jumlah)) ||
            Number(jumlah) < 1
        ) {
            alert('Jumlah obat harus berupa bilangan bulat minimal 1.');
            jumlahInput.focus();
            return;
        }
        // VALIDASI FREKUENSI
        if (!frekuensi) {
            alert('Silakan pilih frekuensi obat.');
            frekuensiInput.focus();
            return;
        }

        const optionObat = selectObat.options[
            selectObat.selectedIndex
        ];

        // CEK OBAT DAN SATUAN YANG DIPILIH
        const stokTerpilih = dataStokObat.find(function (stok) {

            return (
                String(stok.obat_id) === String(obatId) &&
                String(stok.satuan_obat_id) === String(satuanId)
            );
        });

        if (!stokTerpilih) {
            alert('Satuan tidak sesuai dengan stok obat yang dipilih.');
            return;
        }

        // CEK JUMLAH STOK
        if (Number(jumlah) > Number(stokTerpilih.stok_tersedia)) {
            alert(
                'Jumlah obat melebihi stok yang tersedia. Stok tersedia: ' +
                stokTerpilih.stok_tersedia
            );
            jumlahInput.focus();
            return;
        }

        // MASUKKAN KE DAFTAR RESEP
        daftarObat.push({

            obat_id: Number(obatId),

            satuan_obat_id: Number(satuanId),

            nama_obat: optionObat.text.trim(),

            nama_satuan: stokTerpilih.nama_satuan,

            jumlah: Number(jumlah),

            frekuensi: frekuensi,

            lama: lama,

            aturan_pakai: aturan
        });

        tampilkanObat();
        resetFormObat();

        alert('Obat berhasil ditambahkan ke daftar resep.');
    });

    // ISI DOKTER DAN POLI OTOMATIS
    function isiDataPendaftaran() {

        if (!pasienSelect || !dokterInput || !poliInput) {
            return;
        }

        const option = pasienSelect.options[
            pasienSelect.selectedIndex
        ];

        dokterInput.value = option?.dataset.dokter || '';
        poliInput.value = option?.dataset.poli || '';

        if (keluhanInput && option?.dataset.keluhan) {
            keluhanInput.value = option.dataset.keluhan;
        }
    }

    if (pasienSelect) {
        pasienSelect.addEventListener(
            'change',
            isiDataPendaftaran
        );
    }

    // VALIDASI SEBELUM FORM DIKIRIM
    formPemeriksaan.addEventListener('submit', function (event) {

        if (!pasienSelect.value) {
            event.preventDefault();
            alert('Silakan pilih pasien terlebih dahulu.');
            pasienSelect.focus();
            return;
        }

        if (daftarObat.length === 0) {
            event.preventDefault();
            alert('Silakan tambahkan minimal satu obat ke dalam resep.');
            return;
        }

        hiddenResep.value = JSON.stringify(daftarObat);
    });

    // RESET FORM KETIKA MODAL DITUTUP
    modalPemeriksaanEl.addEventListener(
        'hidden.bs.modal',
        function () {

            daftarObat = [];

            formPemeriksaan.reset();

            resetFormObat();

            tampilkanObat();

            if (dokterInput) dokterInput.value = '';
            if (poliInput) poliInput.value = '';
        }
    );

    // TAMPILAN AWAL
    filterSatuanObat();
    filterAturanPakai('');
    tampilkanObat();

});
</script>

@endsection
