
@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Pendaftaran Pasien')

@section('content')

{{-- ========================================
    KARTU STATISTIK
======================================== --}}
<div class="row mb-4">

    {{-- TOTAL PENDAFTARAN --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Pendaftaran</small>
                        <h3 class="mb-0 mt-2">{{ $totalPendaftaran }}</h3>
                    </div>
                    <div class="fs-1">👥</div>
                </div>
            </div>
        </div>
    </div>

    {{-- MENUNGGU --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Menunggu</small>
                        <h3 class="mb-0 mt-2 text-warning">{{ $totalMenunggu }}</h3>
                    </div>
                    <div class="fs-1">⏳</div>
                </div>
            </div>
        </div>
    </div>

    {{-- DIPERIKSA --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Diperiksa</small>
                        <h3 class="mb-0 mt-2 text-info">{{ $totalDiperiksa ?? 0 }}</h3>
                    </div>
                    <div class="fs-1">🩺</div>
                </div>
            </div>
        </div>
    </div>

    {{-- SELESAI --}}
    <div class="col-md-3 mb-3">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Selesai</small>
                        <h3 class="mb-0 mt-2 text-success">{{ $totalSelesai }}</h3>
                    </div>
                    <div class="fs-1">✅</div>
                </div>
            </div>
        </div>
    </div>

</div>


{{-- ========================================
    CARD PENDAFTARAN
======================================== --}}
<div class="card shadow pendaftaran-card">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Pendaftaran Pasien</h4>

        <button type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPendaftaran">

            <i class="fas fa-plus"></i> Daftar Pasien

        </button>

    </div>


    <div class="card-body">

        {{-- PESAN BERHASIL --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- PESAN KAMAR PENUH --}}
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- PESAN ERROR --}}
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


        {{-- ========================================
            SEARCH DAN FILTER
        ======================================== --}}
        <form action="{{ route('pendaftaran.index') }}"
              method="GET"
              class="mb-4">

            <div class="row g-3">

                {{-- SEARCH --}}
                <div class="col-md-4">
                    <label class="form-label">🔍 Cari Data</label>

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Nama pasien, dokter, atau no antrian..."
                           value="{{ request('search') }}">
                </div>

                {{-- FILTER POLI --}}
                <div class="col-md-2">
                    <label class="form-label">🏥 Poli</label>

                    <select name="poli_id" class="form-select">
                        <option value="">Semua Poli</option>

                        @foreach($polis as $poli)
                            <option value="{{ $poli->id }}"
                                {{ request('poli_id') == $poli->id ? 'selected' : '' }}>
                                {{ $poli->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FILTER STATUS --}}
                <div class="col-md-2">
                    <label class="form-label">📋 Status</label>

                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>

                        <option value="menunggu"
                            {{ request('status') == 'menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>

                        <option value="diperiksa"
                            {{ request('status') == 'diperiksa' ? 'selected' : '' }}>
                            Diperiksa
                        </option>

                        <option value="selesai"
                            {{ request('status') == 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>
                    </select>
                </div>

                {{-- FILTER TANGGAL --}}
                <div class="col-md-2">
                    <label class="form-label">📅 Tanggal</label>

                    <input type="date"
                           name="tanggal"
                           class="form-control"
                           value="{{ request('tanggal') }}">
                </div>

                {{-- BUTTON --}}
                <div class="col-md-2 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Cari
                    </button>

                    <a href="{{ route('pendaftaran.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>
        </form>


        {{-- ========================================
            TABEL PENDAFTARAN
        ======================================== --}}
        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">
                    <tr>
                        <th>No Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Kamar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($pendaftarans as $pendaftaran)

                        <tr>

                            {{-- NOMOR ANTRIAN --}}
                            <td>{{ $pendaftaran->nomor_antrian ?? '-' }}</td>

                            {{-- PASIEN --}}
                            <td>{{ $pendaftaran->pasien->nama ?? '-' }}</td>

                            {{-- DOKTER --}}
                            <td>{{ $pendaftaran->dokter->nama ?? '-' }}</td>

                            {{-- POLI --}}
                            <td>{{ $pendaftaran->poli->nama ?? '-' }}</td>

                            {{-- KAMAR --}}
                            <td>{{ $pendaftaran->kamar->nama ?? '-' }}</td>

                            {{-- TANGGAL --}}
                            <td>
                                {{ $pendaftaran->tanggal_pendaftaran
                                    ? \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d-m-Y')
                                    : '-' }}
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @if($pendaftaran->status === 'menunggu')
                                    <span class="badge bg-warning text-dark">
                                        Menunggu
                                    </span>

                                @elseif($pendaftaran->status === 'diperiksa')
                                    <span class="badge bg-info">
                                        Diperiksa
                                    </span>

                                @elseif($pendaftaran->status === 'selesai')
                                    <span class="badge bg-success">
                                        Selesai
                                    </span>

                                @else
                                    <span class="badge bg-secondary">
                                        {{ ucfirst($pendaftaran->status ?? '-') }}
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td class="text-nowrap">

                                {{-- LIHAT --}}
                                <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}"
                                   class="btn btn-info btn-sm">
                                    Lihat
                                </a>

                                {{-- EDIT --}}
                                <button type="button"
                                        class="btn btn-warning btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $pendaftaran->id }}">
                                    Edit
                                </button>

                                {{-- HAPUS --}}
                                <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open me-2"></i>
                                Belum ada data pendaftaran pasien
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $pendaftarans->links() }}
        </div>

    </div>
</div>



{{-- ========================================
    MODAL EDIT
    DILETAKKAN DI LUAR TABEL
======================================== --}}
@foreach($pendaftarans as $pendaftaran)

    <div class="modal fade"
         id="editModal{{ $pendaftaran->id }}"
         tabindex="-1"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                {{-- HEADER --}}
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        Edit Pendaftaran Pasien
                    </h5>

                    <button type="button"
                            class="btn-close btn-close-white"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                {{-- FORM EDIT --}}
                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        {{-- PASIEN --}}
                        <div class="mb-3">
                            <label class="form-label">Pasien</label>

                            <select name="pasien_id" class="form-select" required>
                                @foreach($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}"
                                        {{ $pendaftaran->pasien_id == $pasien->id ? 'selected' : '' }}>
                                        {{ $pasien->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- DOKTER --}}
                        <div class="mb-3">
                            <label class="form-label">Dokter</label>

                            <select name="dokter_id" class="form-select" required>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}"
                                        {{ $pendaftaran->dokter_id == $dokter->id ? 'selected' : '' }}>
                                        {{ $dokter->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- POLI --}}
                        <div class="mb-3">
                            <label class="form-label">Poli</label>

                            <select name="poli_id" class="form-select" required>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}"
                                        {{ $pendaftaran->poli_id == $poli->id ? 'selected' : '' }}>
                                        {{ $poli->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- KAMAR --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Kamar
                                <small class="text-muted">(Opsional)</small>
                            </label>

                            <select name="kamar_id" class="form-select">

                                <option value="">
                                    -- Tidak Memilih Kamar --
                                </option>

                                @foreach($kamars as $kamar)

                                    @php
                                        $kamarPenuh = (int) $kamar->jumlah_pasien >= 4;

                                        $kamarSaatIni =
                                            (int) $pendaftaran->kamar_id === (int) $kamar->id;

                                        $nonaktif = $kamarPenuh && !$kamarSaatIni;
                                    @endphp

                                    <option
                                        value="{{ $kamar->id }}"
                                        {{ $kamarSaatIni ? 'selected' : '' }}
                                        {{ $nonaktif ? 'disabled' : '' }}
                                    >
                                        {{ $kamar->nama }}

                                        @if($kamarPenuh)
                                            (Penuh)
                                        @endif
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        {{-- TANGGAL --}}
                        <div class="mb-3">
                            <label class="form-label">
                                Tanggal Pendaftaran
                            </label>

                            <input type="date"
                                   name="tanggal_pendaftaran"
                                   class="form-control"
                                   value="{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('Y-m-d') }}"
                                   required>
                        </div>

                        {{-- STATUS --}}
                        <div class="mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select" required>

                                <option value="menunggu"
                                    {{ $pendaftaran->status == 'menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>

                                <option value="diperiksa"
                                    {{ $pendaftaran->status == 'diperiksa' ? 'selected' : '' }}>
                                    Diperiksa
                                </option>

                                <option value="selesai"
                                    {{ $pendaftaran->status == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                            </select>
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            Update Data
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

@endforeach


{{-- ========================================
    MODAL TAMBAH PENDAFTARAN
======================================== --}}
<div class="modal fade"
     id="modalTambahPendaftaran"
     tabindex="-1"
     aria-labelledby="modalTambahPendaftaranLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content modal-tambah">

            {{-- HEADER --}}
            <div class="modal-header modal-tambah-header">

                <h6 class="modal-title fw-bold"
                    id="modalTambahPendaftaranLabel">

                    <i class="fas fa-user-plus me-1"></i>
                    Tambah Pendaftaran

                </h6>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            {{-- FORM --}}
            <form action="{{ route('pendaftaran.store') }}" method="POST">

                @csrf

                <div class="modal-body modal-tambah-body">

                    {{-- PASIEN --}}
                    <div class="mb-3">
                        <label for="pasien_id" class="form-label">
                            Pasien
                        </label>

                        <select name="pasien_id"
                                id="pasien_id"
                                class="form-select"
                                required>

                            <option value="">-- Pilih Pasien --</option>

                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}">
                                    {{ $pasien->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- DOKTER --}}
                    <div class="mb-3">
                        <label for="dokter_id" class="form-label">
                            Dokter
                        </label>

                        <select name="dokter_id"
                                id="dokter_id"
                                class="form-select"
                                required>

                            <option value="">-- Pilih Dokter --</option>

                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}"
                                        data-poli-id="{{ $dokter->poli_id }}"
                                        data-poli-nama="{{ $dokter->poli->nama ?? '' }}">
                                    {{ $dokter->nama }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- POLI OTOMATIS --}}
                    <div class="mb-3">
                        <label for="poli_display" class="form-label">
                            Poli
                        </label>

                        <input type="text"
                               id="poli_display"
                               class="form-control"
                               placeholder="Poli akan otomatis mengikuti dokter"
                               readonly>

                        <input type="hidden"
                               name="poli_id"
                               id="poli_id">
                    </div>

                    
                    {{-- KAMAR --}}
                    <div class="mb-3">

                        <label for="kamar_id" class="form-label">
                            Kamar
                            <span class="text-muted">(Opsional)</span>
                        </label>

                        <select name="kamar_id"
                                id="kamar_id"
                                class="form-select">

                            <option value="">-- Pilih Kamar --</option>

                            @foreach($kamars as $kamar)

                                @php
                                    $kamarPenuh = (int) $kamar->jumlah_pasien >= 4;
                                @endphp

                                <option
                                    value="{{ $kamar->id }}"
                                    {{ $kamarPenuh ? 'disabled' : '' }}
                                >
                                    {{ $kamar->nama }}

                                    @if($kamarPenuh)
                                        (Penuh)
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- TANGGAL --}}
                    <div class="mb-2">
                        <label for="tanggal_pendaftaran" class="form-label">
                            Tanggal Pendaftaran
                        </label>

                        <input type="date"
                               name="tanggal_pendaftaran"
                               id="tanggal_pendaftaran"
                               class="form-control"
                               value="{{ date('Y-m-d') }}"
                               required>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer modal-tambah-footer">

                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>


{{-- ========================================
    STYLE
======================================== --}}
<style>

    .pendaftaran-card {
        border: none !important;
        border-radius: 14px !important;
        overflow: hidden;
        background: #ffffff !important;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.08) !important;
    }

    .pendaftaran-card .card-header {
        background: #1677f2 !important;
        color: #ffffff !important;
        border: none !important;
        padding: 14px 18px !important;
    }

    .pendaftaran-card .card-header h4 {
        color: #ffffff !important;
        font-weight: 600;
        margin: 0;
    }

    .pendaftaran-card .card-header .btn-success {
        background: #1677f2 !important;
        border-color: #1677f2 !important;
        color: #ffffff !important;
        border-radius: 7px !important;
        font-weight: 500;
    }

    .pendaftaran-card .card-header .btn-success:hover {
        background: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    .pendaftaran-card .form-label {
        color: #475569 !important;
        font-weight: 500;
    }

    .pendaftaran-card .form-control,
    .pendaftaran-card .form-select {
        border: 1px solid #d5dde8 !important;
        border-radius: 7px !important;
        color: #334155 !important;
        background: #ffffff !important;
    }

    .pendaftaran-card .form-control:focus,
    .pendaftaran-card .form-select:focus {
        border-color: #1677f2 !important;
        box-shadow: 0 0 0 0.15rem rgba(22, 119, 242, 0.15) !important;
    }

    .pendaftaran-card .btn-primary {
        background: #1677f2 !important;
        border-color: #1677f2 !important;
        border-radius: 7px !important;
    }

    .pendaftaran-card .btn-primary:hover {
        background: #0d6efd !important;
        border-color: #0d6efd !important;
    }

    .pendaftaran-card .btn-secondary {
        background: #6c757d !important;
        border-color: #6c757d !important;
        border-radius: 7px !important;
    }

    .pendaftaran-card .table thead th {
        background-color: #1677f2 !important;
        color: #ffffff !important;
        border-color: #1677f2 !important;
        font-weight: 600;
        vertical-align: middle;
        white-space: nowrap;
    }

    .pendaftaran-card .table tbody td {
        color: #334155 !important;
        border-color: #e5eaf0 !important;
        vertical-align: middle;
    }

    .pendaftaran-card .table tbody tr:hover {
        background: #f8fbff !important;
    }

    .pendaftaran-card .btn-info {
        background: #dff1ff !important;
        border-color: #dff1ff !important;
        color: #0879c9 !important;
        border-radius: 7px !important;
    }

    .pendaftaran-card .btn-info:hover {
        background: #c9e9ff !important;
        color: #0069b4 !important;
    }

    .pendaftaran-card .btn-warning {
        background: #1677f2 !important;
        border-color: #1677f2 !important;
        color: #ffffff !important;
        border-radius: 7px !important;
    }

    .pendaftaran-card .btn-warning:hover {
        background: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
    }

    .pendaftaran-card .btn-danger {
        background: #ef3340 !important;
        border-color: #ef3340 !important;
        color: #ffffff !important;
        border-radius: 7px !important;
    }

    .pendaftaran-card .btn-danger:hover {
        background: #dc2633 !important;
        border-color: #dc2633 !important;
    }

    .pendaftaran-card .badge {
        border-radius: 6px !important;
        padding: 5px 9px !important;
        font-weight: 500 !important;
    }

    .pendaftaran-card .badge.bg-warning {
        background: #fff3cd !important;
        color: #9a6b00 !important;
    }

    .pendaftaran-card .badge.bg-info {
        background: #dff1ff !important;
        color: #0879c9 !important;
    }

    .pendaftaran-card .badge.bg-success {
        background: #d9f7e5 !important;
        color: #159447 !important;
    }

    /* MODAL TAMBAH */
    .modal-tambah {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }

    .modal-tambah-header {
        background: #1677f2;
        color: white;
        padding: 14px 16px;
        border: none;
    }

    .modal-tambah-header .modal-title {
        font-size: 14px;
    }

    .modal-tambah-body {
        padding: 18px 16px 12px;
        background: white;
    }

    .modal-tambah-body .form-label {
        font-size: 11px;
        color: #52627a;
        margin-bottom: 5px;
    }

    .modal-tambah-body .form-control,
    .modal-tambah-body .form-select {
        height: 34px;
        font-size: 11px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
    }

    .modal-tambah-body input[readonly] {
        background: #f8fafc;
    }

    .modal-tambah-footer {
        background: #f8fafc;
        border-top: 1px solid #edf0f4;
        padding: 12px 16px;
    }

    .modal-tambah-footer .btn {
        font-size: 11px;
        border-radius: 6px;
        padding: 8px 14px;
    }

    .modal-tambah-footer .btn-primary {
        background: #1677f2;
        border-color: #1677f2;
    }

</style>


{{-- ========================================
    JAVASCRIPT POLI OTOMATIS
======================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const dokterSelect = document.getElementById('dokter_id');
    const poliDisplay = document.getElementById('poli_display');
    const poliId = document.getElementById('poli_id');

    if (!dokterSelect || !poliDisplay || !poliId) {
        return;
    }

    function updatePoli() {

        const selectedOption =
            dokterSelect.options[dokterSelect.selectedIndex];

        if (!selectedOption || selectedOption.value === '') {

            poliDisplay.value = '';
            poliDisplay.placeholder =
                'Poli akan otomatis mengikuti dokter';

            poliId.value = '';

            return;
        }

        const idPoli = selectedOption.getAttribute('data-poli-id');
        const namaPoli = selectedOption.getAttribute('data-poli-nama');

        poliId.value = idPoli || '';

        if (namaPoli && namaPoli.trim() !== '') {

            poliDisplay.value = namaPoli;

        } else {

            poliDisplay.value = 'Dokter belum memiliki poli';

        }
    }

    dokterSelect.addEventListener('change', updatePoli);

    updatePoli();

});
</script>

@endsection
