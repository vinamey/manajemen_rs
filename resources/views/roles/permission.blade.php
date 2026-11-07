@extends('layouts.superadmin')

@section('page-title', 'Pengaturan Permission')
@section('navbar-title', 'Pengaturan Permission')

@section('content')

@php
    // Permission yang sudah dimiliki role
    $selectedPermissions = $role->permissions->pluck('name')->toArray();
@endphp

<style>
    :root {
        --blue: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #eaf3ff;
        --bg: #f4f6f9;
        --text: #2f3542;
    }

    body {
        background: var(--bg) !important;
    }

    .permission-container {
        padding: 25px;
    }

    .permission-header {
        background: var(--blue);
        color: white;
        padding: 20px 24px;
        border-radius: 12px;
        margin-bottom: 20px;
        box-shadow: 0 4px 12px rgba(24, 119, 242, .15);
    }

    .permission-header h4 {
        font-size: 21px;
        font-weight: 700;
        margin: 0;
    }

    .permission-header p {
        font-size: 13px;
        margin: 6px 0 0;
        opacity: .9;
    }

    .role-info {
        background: white;
        border: 1px solid #e3e8ef;
        border-radius: 12px;
        padding: 17px 20px;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .role-icon {
        width: 48px;
        height: 48px;
        background: var(--blue-light);
        color: var(--blue);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .role-info small {
        color: #7b8190;
        font-size: 12px;
    }

    .role-info h5 {
        margin: 3px 0 0;
        font-weight: 700;
        color: var(--text);
    }

    .permission-card {
        background: white;
        border: 1px solid #e3e8ef;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 14px rgba(0, 0, 0, .04);
    }

    .permission-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf0f4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .permission-card-header h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
    }

    .permission-tools {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .permission-search {
        border: 1px solid #dce1e8;
        border-radius: 7px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
    }

    .permission-search:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, .1);
    }

    .btn-select-all {
        background: var(--blue-light);
        color: var(--blue);
        border: none;
        border-radius: 7px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-select-all:hover {
        background: #d9eaff;
    }

    .permission-body {
        padding: 20px;
    }

    .permission-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 13px 15px;
        border: 1px solid #e7ebf1;
        border-radius: 9px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: .2s;
    }

    .permission-item:hover {
        background: #f7faff;
        border-color: #b8d6ff;
    }

    .permission-item:has(input:checked) {
        background: #f0f7ff;
        border-color: #8bbcff;
    }

    .permission-item input {
        width: 18px;
        height: 18px;
        accent-color: var(--blue);
        cursor: pointer;
        flex-shrink: 0;
    }

    .permission-item span {
        font-size: 13px;
        font-weight: 600;
        color: #3f4653;
    }

    .permission-empty {
        text-align: center;
        padding: 35px;
        color: #8b929e;
    }

    .permission-footer {
        padding: 16px 20px;
        border-top: 1px solid #edf0f4;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .permission-count {
        font-size: 13px;
        color: #737b89;
    }

    .btn-back {
        background: #eef0f3;
        color: #555;
        border: none;
        border-radius: 8px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-save {
        background: var(--blue);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: var(--blue-dark);
        color: white;
    }

    @media (max-width: 768px) {
        .permission-container {
            padding: 15px;
        }

        .permission-card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .permission-search {
            width: 100%;
        }
    }
</style>

<div class="permission-container">

    {{-- HEADER --}}
    <div class="permission-header">
        <h4>
            <i class="fa-solid fa-shield-halved me-2"></i>
            Pengaturan Hak Akses
        </h4>

        <p>
            Atur menu dan fitur yang boleh diakses oleh setiap role.
        </p>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- INFORMASI ROLE --}}
    <div class="role-info">
        <div class="role-icon">
            <i class="fa-solid fa-user-shield"></i>
        </div>

        <div>
            <small>Permission untuk role</small>
            <h5>{{ $role->name }}</h5>
        </div>
    </div>

    {{-- FORM PERMISSION --}}
    <form action="{{ route('roles.permission.store', $role->id) }}"
          method="POST">

        @csrf

        <div class="permission-card">

            <div class="permission-card-header">

                <h5>
                    <i class="fa-solid fa-list-check me-2"></i>
                    Daftar Hak Akses
                </h5>

                <div class="permission-tools">

                    <input type="text"
                           id="searchPermission"
                           class="permission-search"
                           placeholder="Cari permission...">

                    <button type="button"
                            class="btn-select-all"
                            id="selectAll">
                        Pilih Semua
                    </button>

                    <button type="button"
                            class="btn-select-all"
                            id="deselectAll">
                        Hapus Pilihan
                    </button>

                </div>

            </div>

            <div class="permission-body">

                @forelse($permissions as $permission)

                    <label class="permission-item"
                           data-permission="{{ strtolower($permission->name) }}">

                        <input type="checkbox"
                               class="permission-checkbox"
                               name="permission[]"
                               value="{{ $permission->name }}"
                               {{ in_array($permission->name, $selectedPermissions) ? 'checked' : '' }}>

                        <span>
                            {{ ucwords(str_replace(['-', '_'], ' ', $permission->name)) }}
                        </span>

                    </label>

                @empty

                    <div class="permission-empty">
                        <i class="fa-solid fa-shield-halved fs-1 d-block mb-2"></i>
                        Belum ada permission yang tersedia.
                    </div>

                @endforelse

            </div>

            <div class="permission-footer">

                <div class="permission-count">
                    Permission dipilih:
                    <strong id="selectedCount">0</strong>
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('roles.index') }}"
                       class="btn-back">
                        <i class="fa-solid fa-arrow-left me-1"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk me-1"></i>
                        Simpan Permission
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const checkboxes = document.querySelectorAll('.permission-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const searchInput = document.getElementById('searchPermission');

    // Menghitung permission yang dicentang
    function updateCount() {
        const total = document.querySelectorAll(
            '.permission-checkbox:checked'
        ).length;

        selectedCount.textContent = total;
    }

    // Perubahan checkbox
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', updateCount);
    });

    // Pilih semua permission yang sedang terlihat
    document.getElementById('selectAll').addEventListener('click', function () {

        document.querySelectorAll('.permission-item').forEach(function (item) {

            if (item.style.display !== 'none') {
                item.querySelector('.permission-checkbox').checked = true;
            }

        });

        updateCount();
    });

    // Hapus semua pilihan yang sedang terlihat
    document.getElementById('deselectAll').addEventListener('click', function () {

        document.querySelectorAll('.permission-item').forEach(function (item) {

            if (item.style.display !== 'none') {
                item.querySelector('.permission-checkbox').checked = false;
            }

        });

        updateCount();
    });

    // Pencarian permission
    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase();

        document.querySelectorAll('.permission-item').forEach(function (item) {

            const permission = item.dataset.permission;

            item.style.display = permission.includes(keyword)
                ? 'flex'
                : 'none';

        });

    });

    // Hitung permission saat halaman pertama dibuka
    updateCount();

});
</script>

@endsection
