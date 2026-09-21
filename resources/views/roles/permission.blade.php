@extends('layouts.superadmin')

@section('page-title', 'Permission Management')

@section('content')



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

    /* =========================
       HEADER
    ========================= */

    .permission-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .permission-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: var(--text);
    }

    .permission-subtitle {
        margin: 5px 0 0;
        color: #7b8190;
        font-size: 14px;
    }

    /* =========================
       BUTTON TAMBAH
    ========================= */

    .btn-add-permission {
        background: var(--blue);
        color: white !important;
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(24, 119, 242, .18);
        transition: .2s;
    }

    .btn-add-permission:hover {
        background: var(--blue-dark);
        color: white !important;
        transform: translateY(-1px);
    }

    /* =========================
       ALERT
    ========================= */

    .alert {
        border-radius: 10px;
        border: none;
    }

    /* =========================
       CARD TABLE
    ========================= */

    .permission-card {
        background: #ffffff;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
        overflow: hidden;
    }

    /* =========================
       TABLE
    ========================= */

    .permission-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .permission-table thead {
        background: var(--blue);
        color: white;
    }

    .permission-table th {
        padding: 15px 18px;
        font-size: 13px;
        font-weight: 600;
        border: none;
    }

    .permission-table td {
        padding: 14px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #edf0f4;
        color: #3f4653;
        font-size: 14px;
    }

    .permission-table tbody tr:last-child td {
        border-bottom: none;
    }

    .permission-table tbody tr:hover {
        background: #f8fbff;
    }

    /* =========================
       NOMOR
    ========================= */

    .number-cell {
        width: 70px;
        text-align: center;
        color: #737b89;
        font-weight: 600;
    }

    /* =========================
       NAMA PERMISSION
    ========================= */

    .permission-name-wrapper {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .permission-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--blue-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .permission-name {
        font-weight: 600;
        color: #303641;
    }

    /* =========================
       AKSI
    ========================= */

    .action-cell {
        width: 230px;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-permission-action {
        border: none;
        border-radius: 7px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: .2s;
    }

    /* EDIT */

    .btn-edit-permission {
        background: #fff4df;
        color: #d88900;
    }

    .btn-edit-permission:hover {
        background: #ffe9c2;
        color: #b87300;
    }

    /* HAPUS */

    .btn-delete-permission {
        background: #ffe9e9;
        color: #dc3545;
    }

    .btn-delete-permission:hover {
        background: #ffd9d9;
        color: #b02a37;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-data {
        padding: 50px 20px !important;
        text-align: center;
        color: #8b929e;
    }

    .empty-data i {
        font-size: 40px;
        display: block;
        margin-bottom: 10px;
        color: #b7bec9;
    }

    /* =========================
       MODAL
    ========================= */

    .permission-modal .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .15);
    }

    .permission-modal .modal-header {
        background: var(--blue);
        color: white;
        border-bottom: none;
        padding: 17px 20px;
    }

    .permission-modal .modal-title {
        font-size: 18px;
        font-weight: 600;
    }

    .permission-modal .modal-body {
        padding: 22px;
    }

    .permission-modal .modal-footer {
        border-top: 1px solid #edf0f4;
        padding: 15px 20px;
    }

    .permission-modal .form-label {
        color: #353b45;
        font-size: 14px;
        margin-bottom: 7px;
    }

    .permission-modal .form-control {
        border-radius: 9px;
        border: 1px solid #dfe3e8;
        padding: 10px 12px;
        font-size: 14px;
    }

    .permission-modal .form-control:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, .10);
    }

    /* =========================
       INFO
    ========================= */

    .permission-info {
        background: #f4f8ff;
        border: 1px solid #dceaff;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 18px;
        color: #4b5563;
        font-size: 13px;
    }

    .permission-info i {
        color: var(--blue);
    }

    /* =========================
       MODAL BUTTON
    ========================= */

    .btn-modal-cancel {
        border-radius: 8px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        background: #eef0f3;
        color: #555;
    }

    .btn-modal-cancel:hover {
        background: #e1e4e8;
        color: #333;
    }

    .btn-modal-save {
        background: var(--blue);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-modal-save:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .permission-container {
            padding: 15px;
        }

        .permission-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .permission-card {
            overflow-x: auto;
        }

        .permission-table {
            min-width: 700px;
        }
    }
</style>


<div class="permission-container">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="permission-header">

        <div>

            <h2 class="permission-title">
                Permission Management
            </h2>

            <p class="permission-subtitle">
                Kelola permission atau hak akses sistem
            </p>

        </div>


        {{-- TAMBAH PERMISSION --}}

        <button type="button"
                class="btn btn-add-permission"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPermission">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Permission

        </button>

    </div>


    {{-- =========================
         SUCCESS
    ========================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
         ERROR
    ========================= --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show mb-4">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
         TABLE
    ========================= --}}

    <div class="permission-card">

        <table class="permission-table">

            <thead>

                <tr>

                    <th class="text-center">
                        No
                    </th>

                    <th>
                        Nama Permission
                    </th>

                    <th class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($permissions as $permission)

                    <tr>

                        {{-- NOMOR --}}

                        <td class="number-cell">
                            {{ $loop->iteration }}
                        </td>


                        {{-- NAMA PERMISSION --}}

                        <td>

                            <div class="permission-name-wrapper">

                                <div class="permission-icon">

                                    <i class="bi bi-shield-check"></i>

                                </div>

                                <span class="permission-name">

                                    {{ $permission->name }}

                                </span>

                            </div>

                        </td>


                        {{-- AKSI --}}

                        <td class="action-cell">

                            <div class="action-buttons">

                                {{-- EDIT --}}

                                <button type="button"
                                        class="btn-permission-action btn-edit-permission"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditPermission{{ $permission->id }}">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </button>


                                {{-- HAPUS --}}

                                <form action="{{ route('permissions.destroy', $permission->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-permission-action btn-delete-permission"
                                            onclick="return confirm('Yakin ingin menghapus permission {{ $permission->name }}?')">

                                        <i class="bi bi-trash3"></i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- =====================================================
                         MODAL EDIT
                    ====================================================== --}}

                    <div class="modal fade permission-modal"
                         id="modalEditPermission{{ $permission->id }}"
                         tabindex="-1"
                         aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        <i class="bi bi-pencil-square me-2"></i>

                                        Edit Permission

                                    </h5>

                                </div>


                                <form action="{{ route('permissions.update', $permission->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PUT')


                                    <div class="modal-body">

                                        <div class="permission-info">

                                            <i class="bi bi-info-circle me-1"></i>

                                            Ubah nama permission sesuai kebutuhan
                                            sistem.

                                        </div>


                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Nama Permission

                                            </label>

                                            <input type="text"
                                                   name="name"
                                                   class="form-control"
                                                   value="{{ $permission->name }}"
                                                   required
                                                   autocomplete="off">

                                        </div>

                                    </div>


                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-modal-cancel"
                                                data-bs-dismiss="modal">

                                            Batal

                                        </button>


                                        <button type="submit"
                                                class="btn btn-modal-save">

                                            <i class="bi bi-save me-1"></i>

                                            Simpan Perubahan

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td colspan="3"
                            class="empty-data">

                            <i class="bi bi-shield-x"></i>

                            Belum ada data permission.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =====================================================
     MODAL TAMBAH PERMISSION
====================================================== --}}

<div class="modal fade permission-modal"
     id="modalTambahPermission"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-shield-plus me-2"></i>

                    Tambah Permission

                </h5>

            </div>


            <form action="{{ route('permissions.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">

                    <div class="permission-info">

                        <i class="bi bi-info-circle me-1"></i>

                        Tambahkan permission baru untuk hak akses
                        sistem.

                    </div>


                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nama Permission

                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Contoh: master dokter"
                               value="{{ old('name') }}"
                               required
                               autocomplete="off">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-modal-cancel"
                            data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn btn-modal-save">

                        <i class="bi bi-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
     AUTO OPEN MODAL JIKA VALIDASI ERROR
====================================================== --}}

@if($errors->any())

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const modalElement =
                document.getElementById('modalTambahPermission');

            if (modalElement) {

                const modal =
                    new bootstrap.Modal(modalElement);

                modal.show();

            }

        });

    </script>

@endif

@endsection@extends('layouts.superadmin')

@section('page-title', 'Permission Management')

@section('content')

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

    /* =========================
       HEADER
    ========================= */

    .permission-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .permission-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: var(--text);
    }

    .permission-subtitle {
        margin: 5px 0 0;
        color: #7b8190;
        font-size: 14px;
    }

    /* =========================
       BUTTON TAMBAH
    ========================= */

    .btn-add-permission {
        background: var(--blue);
        color: white !important;
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(24, 119, 242, .18);
        transition: .2s;
    }

    .btn-add-permission:hover {
        background: var(--blue-dark);
        color: white !important;
        transform: translateY(-1px);
    }

    /* =========================
       ALERT
    ========================= */

    .alert {
        border-radius: 10px;
        border: none;
    }

    /* =========================
       CARD TABLE
    ========================= */

    .permission-card {
        background: #ffffff;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
        overflow: hidden;
    }

    /* =========================
       TABLE
    ========================= */

    .permission-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .permission-table thead {
        background: var(--blue);
        color: white;
    }

    .permission-table th {
        padding: 15px 18px;
        font-size: 13px;
        font-weight: 600;
        border: none;
    }

    .permission-table td {
        padding: 14px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #edf0f4;
        color: #3f4653;
        font-size: 14px;
    }

    .permission-table tbody tr:last-child td {
        border-bottom: none;
    }

    .permission-table tbody tr:hover {
        background: #f8fbff;
    }

    /* =========================
       NOMOR
    ========================= */

    .number-cell {
        width: 70px;
        text-align: center;
        color: #737b89;
        font-weight: 600;
    }

    /* =========================
       NAMA PERMISSION
    ========================= */

    .permission-name-wrapper {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .permission-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: var(--blue-light);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .permission-name {
        font-weight: 600;
        color: #303641;
    }

    /* =========================
       AKSI
    ========================= */

    .action-cell {
        width: 230px;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-permission-action {
        border: none;
        border-radius: 7px;
        padding: 7px 12px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: .2s;
    }

    /* EDIT */

    .btn-edit-permission {
        background: #fff4df;
        color: #d88900;
    }

    .btn-edit-permission:hover {
        background: #ffe9c2;
        color: #b87300;
    }

    /* HAPUS */

    .btn-delete-permission {
        background: #ffe9e9;
        color: #dc3545;
    }

    .btn-delete-permission:hover {
        background: #ffd9d9;
        color: #b02a37;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-data {
        padding: 50px 20px !important;
        text-align: center;
        color: #8b929e;
    }

    .empty-data i {
        font-size: 40px;
        display: block;
        margin-bottom: 10px;
        color: #b7bec9;
    }

    /* =========================
       MODAL
    ========================= */

    .permission-modal .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .15);
    }

    .permission-modal .modal-header {
        background: var(--blue);
        color: white;
        border-bottom: none;
        padding: 17px 20px;
    }

    .permission-modal .modal-title {
        font-size: 18px;
        font-weight: 600;
    }

    .permission-modal .modal-body {
        padding: 22px;
    }

    .permission-modal .modal-footer {
        border-top: 1px solid #edf0f4;
        padding: 15px 20px;
    }

    .permission-modal .form-label {
        color: #353b45;
        font-size: 14px;
        margin-bottom: 7px;
    }

    .permission-modal .form-control {
        border-radius: 9px;
        border: 1px solid #dfe3e8;
        padding: 10px 12px;
        font-size: 14px;
    }

    .permission-modal .form-control:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, .10);
    }

    /* =========================
       INFO
    ========================= */

    .permission-info {
        background: #f4f8ff;
        border: 1px solid #dceaff;
        border-radius: 10px;
        padding: 12px 14px;
        margin-bottom: 18px;
        color: #4b5563;
        font-size: 13px;
    }

    .permission-info i {
        color: var(--blue);
    }

    /* =========================
       MODAL BUTTON
    ========================= */

    .btn-modal-cancel {
        border-radius: 8px;
        padding: 9px 16px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        background: #eef0f3;
        color: #555;
    }

    .btn-modal-cancel:hover {
        background: #e1e4e8;
        color: #333;
    }

    .btn-modal-save {
        background: var(--blue);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-modal-save:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .permission-container {
            padding: 15px;
        }

        .permission-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .permission-card {
            overflow-x: auto;
        }

        .permission-table {
            min-width: 700px;
        }
    }
</style>


<div class="permission-container">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="permission-header">

        <div>

            <h2 class="permission-title">
                Permission Management
            </h2>

            <p class="permission-subtitle">
                Kelola permission atau hak akses sistem
            </p>

        </div>


        {{-- TAMBAH PERMISSION --}}

        <button type="button"
                class="btn btn-add-permission"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPermission">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Permission

        </button>

    </div>


    {{-- =========================
         SUCCESS
    ========================= --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
         ERROR
    ========================= --}}

    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show mb-4">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- =========================
         TABLE
    ========================= --}}

    <div class="permission-card">

        <table class="permission-table">

            <thead>

                <tr>

                    <th class="text-center">
                        No
                    </th>

                    <th>
                        Nama Permission
                    </th>

                    <th class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($permissions as $permission)

                    <tr>

                        {{-- NOMOR --}}

                        <td class="number-cell">
                            {{ $loop->iteration }}
                        </td>


                        {{-- NAMA PERMISSION --}}

                        <td>

                            <div class="permission-name-wrapper">

                                <div class="permission-icon">

                                    <i class="bi bi-shield-check"></i>

                                </div>

                                <span class="permission-name">

                                    {{ $permission->name }}

                                </span>

                            </div>

                        </td>


                        {{-- AKSI --}}

                        <td class="action-cell">

                            <div class="action-buttons">

                                {{-- EDIT --}}

                                <button type="button"
                                        class="btn-permission-action btn-edit-permission"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditPermission{{ $permission->id }}">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </button>


                                {{-- HAPUS --}}

                                <form action="{{ route('permissions.destroy', $permission->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-permission-action btn-delete-permission"
                                            onclick="return confirm('Yakin ingin menghapus permission {{ $permission->name }}?')">

                                        <i class="bi bi-trash3"></i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- =====================================================
                         MODAL EDIT
                    ====================================================== --}}

                    <div class="modal fade permission-modal"
                         id="modalEditPermission{{ $permission->id }}"
                         tabindex="-1"
                         aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        <i class="bi bi-pencil-square me-2"></i>

                                        Edit Permission

                                    </h5>

                                </div>


                                <form action="{{ route('permissions.update', $permission->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PUT')


                                    <div class="modal-body">

                                        <div class="permission-info">

                                            <i class="bi bi-info-circle me-1"></i>

                                            Ubah nama permission sesuai kebutuhan
                                            sistem.

                                        </div>


                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Nama Permission

                                            </label>

                                            <input type="text"
                                                   name="name"
                                                   class="form-control"
                                                   value="{{ $permission->name }}"
                                                   required
                                                   autocomplete="off">

                                        </div>

                                    </div>


                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-modal-cancel"
                                                data-bs-dismiss="modal">

                                            Batal

                                        </button>


                                        <button type="submit"
                                                class="btn btn-modal-save">

                                            <i class="bi bi-save me-1"></i>

                                            Simpan Perubahan

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <tr>

                        <td colspan="3"
                            class="empty-data">

                            <i class="bi bi-shield-x"></i>

                            Belum ada data permission.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =====================================================
     MODAL TAMBAH PERMISSION
====================================================== --}}

<div class="modal fade permission-modal"
     id="modalTambahPermission"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="bi bi-shield-plus me-2"></i>

                    Tambah Permission

                </h5>

            </div>


            <form action="{{ route('permissions.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">

                    <div class="permission-info">

                        <i class="bi bi-info-circle me-1"></i>

                        Tambahkan permission baru untuk hak akses
                        sistem.

                    </div>


                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nama Permission

                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Contoh: master dokter"
                               value="{{ old('name') }}"
                               required
                               autocomplete="off">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-modal-cancel"
                            data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn btn-modal-save">

                        <i class="bi bi-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
     AUTO OPEN MODAL JIKA VALIDASI ERROR
====================================================== --}}

@if($errors->any())

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const modalElement =
                document.getElementById('modalTambahPermission');

            if (modalElement) {

                const modal =
                    new bootstrap.Modal(modalElement);

                modal.show();

            }

        });

    </script>

@endif

@endsection

