@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Perawat')

@section('content')

<style>
    body {
        background-color: #f4f7fe;
    }

    .perawat-container {
        padding: 5px;
    }

    /* --- PAGE HEADER --- */
    .page-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-left-title {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .header-left-title i {
        font-size: 22px;
        color: #2563eb;
        margin-top: 2px;
    }

    .header-left-title h3 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }

    .header-left-title p {
        font-size: 13px;
        color: #64748b;
        margin: 4px 0 0 0;
    }

    .btn-tambah-primary {
        background-color: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 10px 22px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-tambah-primary:hover {
        background-color: #1d4ed8;
        color: #ffffff;
    }

    /* --- ALERT SUCCESS --- */
    .alert-banner-cyan {
        background-color: #cff4fc;
        color: #055160;
        border-radius: 8px;
        padding: 12px 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
    }

    .alert-banner-cyan .btn-close-alert {
        background: none;
        border: none;
        font-size: 16px;
        color: #055160;
        opacity: 0.6;
        cursor: pointer;
    }

    .alert-banner-cyan .btn-close-alert:hover {
        opacity: 1;
    }

    /* --- TABLE CONTAINER --- */
    .table-card-wrapper {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .custom-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead th {
        background-color: #2563eb;
        color: #ffffff;
        font-weight: 600;
        font-size: 13px;
        padding: 14px 16px;
        border: none;
        white-space: nowrap;
    }

    .custom-table thead tr th:first-child {
        border-top-left-radius: 12px;
    }

    .custom-table thead tr th:last-child {
        border-top-right-radius: 12px;
    }

    .custom-table tbody td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #64748b;
        font-size: 13px;
        vertical-align: middle;
    }

    /* --- USER AVATAR & NAME --- */
    .user-profile-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar-circle {
        width: 30px;
        height: 30px;
        background-color: #e0f2fe;
        color: #0284c7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .user-profile-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    .user-profile-id {
        font-size: 11px;
        color: #94a3b8;
        display: block;
        margin-top: 2px;
    }

    /* --- GENDER BADGE --- */
    .badge-perempuan {
        background-color: #ffedd5;
        color: #ea580c;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    .badge-lakilaki {
        background-color: #dbeafe;
        color: #2563eb;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    /* --- ACTION BUTTONS (PERSIS GAMBAR) --- */
    .action-group-horizontal {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-act-item {
        border-radius: 6px;
        border: none;
        height: 42px;
        padding: 0 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
        gap: 2px;
        cursor: pointer;
        min-width: 44px;
    }

    .btn-act-item i {
        font-size: 13px;
    }

    .btn-act-lihat {
        background-color: #e0f2fe;
        color: #0284c7;
    }

    .btn-act-lihat:hover {
        background-color: #bae6fd;
    }

    .btn-act-edit {
        background-color: #2563eb;
        color: #ffffff;
    }

    .btn-act-edit:hover {
        background-color: #1d4ed8;
    }

    .btn-act-hapus {
        background-color: #ef4444;
        color: #ffffff;
    }

    .btn-act-hapus:hover {
        background-color: #dc2626;
    }

    /* --- MODAL --- */
    .modal-rounded {
        border-radius: 12px;
        border: none;
        overflow: hidden;
    }

    .modal-header-blue {
        background-color: #2563eb;
        color: #ffffff;
        padding: 16px 20px;
    }

    .modal-header-blue .btn-close {
        filter: brightness(0) invert(1);
    }
</style>

<div class="perawat-container">

    {{-- HEADER HALAMAN --}}
    <div class="page-header-flex">
        <div class="header-left-title">
            <i class="bi bi-person-badge"></i>
            <div>
                <h3>Daftar Perawat</h3>
                <p>Data perawat yang terdaftar</p>
            </div>
        </div>

        <button type="button" class="btn-tambah-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPerawat">
            <i class="bi bi-plus-lg"></i> Tambah Perawat
        </button>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="alert-banner-cyan" id="alertSuccess">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close-alert" onclick="document.getElementById('alertSuccess').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- ERROR VALIDASI FORM --}}
    @if($errors->any())
        <div class="alert alert-danger border-0 rounded-3 mb-3">
            <strong class="d-block mb-1">Terjadi Kesalahan:</strong>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABEL DATA PERAWAT --}}
    <div class="table-card-wrapper">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Perawat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perawats as $index => $perawat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="user-profile-flex">
                                    <div class="avatar-circle">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <div class="user-profile-name">{{ $perawat->nama }}</div>
                                        <span class="user-profile-id">ID: {{ $perawat->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if(strtolower($perawat->jenis_kelamin) == 'perempuan')
                                    <span class="badge-perempuan">Perempuan</span>
                                @else
                                    <span class="badge-lakilaki">Laki-laki</span>
                                @endif
                            </td>
                            <td>
                                {{ $perawat->tanggal_lahir ? \Carbon\Carbon::parse($perawat->tanggal_lahir)->format('Y-m-d') : '-' }}
                            </td>
                            <td class="text-lowercase">{{ $perawat->alamat ?? '-' }}</td>
                            <td>
                                <div class="action-group-horizontal">
                                    {{-- TOMBOL LIHAT --}}
                                    <button type="button" class="btn-act-item btn-act-lihat" data-bs-toggle="modal" data-bs-target="#modalLihatPerawat{{ $perawat->id }}">
                                        <i class="bi bi-eye-fill"></i>
                                        <span>Lihat</span>
                                    </button>

                                    {{-- TOMBOL EDIT --}}
                                    <button type="button" class="btn-act-item btn-act-edit" data-bs-toggle="modal" data-bs-target="#modalEditPerawat{{ $perawat->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </button>

                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('master-perawat.destroy', $perawat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-act-item btn-act-hapus">
                                            <i class="bi bi-trash-fill"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada data perawat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH DATA --}}
<div class="modal fade" id="modalTambahPerawat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-rounded">
            <div class="modal-header modal-header-blue">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Perawat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master-perawat.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Nama Perawat</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama perawat" value="{{ old('nama') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Ketikkan alamat lengkap...">{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT & LIHAT DATA --}}
@foreach($perawats as $perawat)

{{-- MODAL DETAIL / LIHAT --}}
<div class="modal fade" id="modalLihatPerawat{{ $perawat->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-rounded">
            <div class="modal-header modal-header-blue">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-eye-fill me-1"></i> Detail Perawat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <table class="table table-borderless mb-0">
                    <tr><td class="fw-bold text-muted" width="130">ID Perawat</td><td>: #{{ $perawat->id }}</td></tr>
                    <tr><td class="fw-bold text-muted">Nama</td><td>: {{ $perawat->nama }}</td></tr>
                    <tr><td class="fw-bold text-muted">Jenis Kelamin</td><td>: {{ $perawat->jenis_kelamin }}</td></tr>
                    <tr><td class="fw-bold text-muted">Tanggal Lahir</td><td>: {{ $perawat->tanggal_lahir }}</td></tr>
                    <tr><td class="fw-bold text-muted">Alamat</td><td>: {{ $perawat->alamat ?? '-' }}</td></tr>
                </table>
            </div>
            <div class="modal-footer border-0 p-3 pt-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEditPerawat{{ $perawat->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-rounded">
            <div class="modal-header modal-header-blue">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-pencil-square me-1"></i> Edit Perawat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master-perawat.update', $perawat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Nama Perawat</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $perawat->nama) }}" placeholder="Masukkan nama perawat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $perawat->tanggal_lahir) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Ketikkan alamat lengkap...">{{ old('alamat', $perawat->alamat) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Perawat')

@section('content')

<style>
    body {
        background-color: #f4f7fe;
    }

    .perawat-container {
        padding: 5px;
    }

    /* --- PAGE HEADER --- */
    .page-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-left-title {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .header-left-title i {
        font-size: 22px;
        color: #2563eb;
        margin-top: 2px;
    }

    .header-left-title h3 {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }

    .header-left-title p {
        font-size: 13px;
        color: #64748b;
        margin: 4px 0 0 0;
    }

    .btn-tambah-primary {
        background-color: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 10px 22px;
        font-weight: 600;
        font-size: 14px;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-tambah-primary:hover {
        background-color: #1d4ed8;
        color: #ffffff;
    }

    /* --- ALERT SUCCESS --- */
    .alert-banner-cyan {
        background-color: #cff4fc;
        color: #055160;
        border-radius: 8px;
        padding: 12px 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 14px;
    }

    .alert-banner-cyan .btn-close-alert {
        background: none;
        border: none;
        font-size: 16px;
        color: #055160;
        opacity: 0.6;
        cursor: pointer;
    }

    .alert-banner-cyan .btn-close-alert:hover {
        opacity: 1;
    }

    /* --- TABLE CONTAINER --- */
    .table-card-wrapper {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .custom-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table thead th {
        background-color: #2563eb;
        color: #ffffff;
        font-weight: 600;
        font-size: 13px;
        padding: 14px 16px;
        border: none;
        white-space: nowrap;
    }

    .custom-table thead tr th:first-child {
        border-top-left-radius: 12px;
    }

    .custom-table thead tr th:last-child {
        border-top-right-radius: 12px;
    }

    .custom-table tbody td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        color: #64748b;
        font-size: 13px;
        vertical-align: middle;
    }

    /* --- USER AVATAR & NAME --- */
    .user-profile-flex {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar-circle {
        width: 30px;
        height: 30px;
        background-color: #e0f2fe;
        color: #0284c7;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .user-profile-name {
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }

    .user-profile-id {
        font-size: 11px;
        color: #94a3b8;
        display: block;
        margin-top: 2px;
    }

    /* --- GENDER BADGE --- */
    .badge-perempuan {
        background-color: #ffedd5;
        color: #ea580c;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    .badge-lakilaki {
        background-color: #dbeafe;
        color: #2563eb;
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    /* --- ACTION BUTTONS (PERSIS GAMBAR) --- */
    .action-group-horizontal {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-act-item {
        border-radius: 6px;
        border: none;
        height: 42px;
        padding: 0 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
        gap: 2px;
        cursor: pointer;
        min-width: 44px;
    }

    .btn-act-item i {
        font-size: 13px;
    }

    .btn-act-lihat {
        background-color: #e0f2fe;
        color: #0284c7;
    }

    .btn-act-lihat:hover {
        background-color: #bae6fd;
    }

    .btn-act-edit {
        background-color: #2563eb;
        color: #ffffff;
    }

    .btn-act-edit:hover {
        background-color: #1d4ed8;
    }

    .btn-act-hapus {
        background-color: #ef4444;
        color: #ffffff;
    }

    .btn-act-hapus:hover {
        background-color: #dc2626;
    }

    /* --- MODAL --- */
    .modal-rounded {
        border-radius: 12px;
        border: none;
        overflow: hidden;
    }

    .modal-header-blue {
        background-color: #2563eb;
        color: #ffffff;
        padding: 16px 20px;
    }

    .modal-header-blue .btn-close {
        filter: brightness(0) invert(1);
    }
</style>

<div class="perawat-container">

    {{-- HEADER HALAMAN --}}
    <div class="page-header-flex">
        <div class="header-left-title">
            <i class="bi bi-person-badge"></i>
            <div>
                <h3>Daftar Perawat</h3>
                <p>Data perawat yang terdaftar</p>
            </div>
        </div>

        <button type="button" class="btn-tambah-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPerawat">
            <i class="bi bi-plus-lg"></i> Tambah Perawat
        </button>
    </div>

    {{-- ALERT SUKSES --}}
    @if(session('success'))
        <div class="alert-banner-cyan" id="alertSuccess">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close-alert" onclick="document.getElementById('alertSuccess').remove()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- ERROR VALIDASI FORM --}}
    @if($errors->any())
        <div class="alert alert-danger border-0 rounded-3 mb-3">
            <strong class="d-block mb-1">Terjadi Kesalahan:</strong>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABEL DATA PERAWAT --}}
    <div class="table-card-wrapper">
        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Perawat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($perawats as $index => $perawat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="user-profile-flex">
                                    <div class="avatar-circle">
                                        <i class="bi bi-person-fill"></i>
                                    </div>
                                    <div>
                                        <div class="user-profile-name">{{ $perawat->nama }}</div>
                                        <span class="user-profile-id">ID: {{ $perawat->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if(strtolower($perawat->jenis_kelamin) == 'perempuan')
                                    <span class="badge-perempuan">Perempuan</span>
                                @else
                                    <span class="badge-lakilaki">Laki-laki</span>
                                @endif
                            </td>
                            <td>
                                {{ $perawat->tanggal_lahir ? \Carbon\Carbon::parse($perawat->tanggal_lahir)->format('Y-m-d') : '-' }}
                            </td>
                            <td class="text-lowercase">{{ $perawat->alamat ?? '-' }}</td>
                            <td>
                                <div class="action-group-horizontal">
                                    {{-- TOMBOL LIHAT --}}
                                    <button type="button" class="btn-act-item btn-act-lihat" data-bs-toggle="modal" data-bs-target="#modalLihatPerawat{{ $perawat->id }}">
                                        <i class="bi bi-eye-fill"></i>
                                        <span>Lihat</span>
                                    </button>

                                    {{-- TOMBOL EDIT --}}
                                    <button type="button" class="btn-act-item btn-act-edit" data-bs-toggle="modal" data-bs-target="#modalEditPerawat{{ $perawat->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                        <span>Edit</span>
                                    </button>

                                    {{-- TOMBOL HAPUS --}}
                                    <form action="{{ route('master-perawat.destroy', $perawat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-act-item btn-act-hapus">
                                            <i class="bi bi-trash-fill"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada data perawat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH DATA --}}
<div class="modal fade" id="modalTambahPerawat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-rounded">
            <div class="modal-header modal-header-blue">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Perawat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master-perawat.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Nama Perawat</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama perawat" value="{{ old('nama') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Ketikkan alamat lengkap...">{{ old('alamat') }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL EDIT & LIHAT DATA --}}
@foreach($perawats as $perawat)

{{-- MODAL DETAIL / LIHAT --}}
<div class="modal fade" id="modalLihatPerawat{{ $perawat->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-rounded">
            <div class="modal-header modal-header-blue">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-eye-fill me-1"></i> Detail Perawat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <table class="table table-borderless mb-0">
                    <tr><td class="fw-bold text-muted" width="130">ID Perawat</td><td>: #{{ $perawat->id }}</td></tr>
                    <tr><td class="fw-bold text-muted">Nama</td><td>: {{ $perawat->nama }}</td></tr>
                    <tr><td class="fw-bold text-muted">Jenis Kelamin</td><td>: {{ $perawat->jenis_kelamin }}</td></tr>
                    <tr><td class="fw-bold text-muted">Tanggal Lahir</td><td>: {{ $perawat->tanggal_lahir }}</td></tr>
                    <tr><td class="fw-bold text-muted">Alamat</td><td>: {{ $perawat->alamat ?? '-' }}</td></tr>
                </table>
            </div>
            <div class="modal-footer border-0 p-3 pt-0">
                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEditPerawat{{ $perawat->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-rounded">
            <div class="modal-header modal-header-blue">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-pencil-square me-1"></i> Edit Perawat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('master-perawat.update', $perawat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Nama Perawat</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $perawat->nama) }}" placeholder="Masukkan nama perawat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $perawat->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $perawat->tanggal_lahir) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Ketikkan alamat lengkap...">{{ old('alamat', $perawat->alamat) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-3 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection
