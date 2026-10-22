@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Role Management')

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

    .role-container {
        padding: 25px;
    }

    /* =========================
       HEADER
    ========================= */

    .role-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .role-title {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: var(--text);
    }

    .role-subtitle {
        margin: 5px 0 0;
        color: #7b8190;
        font-size: 14px;
    }

    /* =========================
       BUTTON TAMBAH
    ========================= */

    .btn-add-role {
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

    .btn-add-role:hover {
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

    .role-card {
        background: white;
        border-radius: 15px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .05);
        overflow: hidden;
    }

    .role-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .role-table thead {
        background: var(--blue);
        color: white;
    }

    .role-table th {
        padding: 15px 18px;
        font-size: 13px;
        font-weight: 600;
        border: none;
    }

    .role-table td {
        padding: 15px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #edf0f4;
        color: #3f4653;
        font-size: 14px;
    }

    .role-table tbody tr:last-child td {
        border-bottom: none;
    }

    .role-table tbody tr:hover {
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
       ROLE
    ========================= */

    .role-name-wrapper {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .role-icon {
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

    .role-name {
        font-weight: 600;
        color: #303641;
    }

    /* =========================
       AKSI
    ========================= */

    .action-cell {
        width: 330px;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
    }

    .btn-role {
        border: none;
        border-radius: 7px;
        padding: 7px 11px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
        transition: .2s;
    }

    .btn-permission {
        background: #e8f4ff;
        color: #1877f2;
    }

    .btn-permission:hover {
        background: #d8ebff;
        color: #0f58c6;
    }

    .btn-edit {
        background: #fff4df;
        color: #d88900;
    }

    .btn-edit:hover {
        background: #ffe9c2;
        color: #b87300;
    }

    .btn-delete {
        background: #ffe9e9;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #ffd9d9;
        color: #b02a37;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-data {
        padding: 45px 20px !important;
        text-align: center;
        color: #8b929e;
    }

    .empty-data i {
        font-size: 38px;
        display: block;
        margin-bottom: 10px;
        color: #b7bec9;
    }

    /* =========================
       MODAL UMUM
    ========================= */

    .role-modal .modal-content {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .15);
    }

    .role-modal .modal-header {
        background: var(--blue);
        color: white;
        border-bottom: none;
        padding: 17px 20px;
    }

    .role-modal .modal-title {
        font-size: 18px;
        font-weight: 600;
    }

    .role-modal .modal-body {
        padding: 22px;
    }

    .role-modal .modal-footer {
        border-top: 1px solid #edf0f4;
        padding: 15px 20px;
    }

    .role-modal .form-label {
        color: #353b45;
        font-size: 14px;
        margin-bottom: 7px;
    }

    .role-modal .form-control {
        border-radius: 9px;
        border: 1px solid #dfe3e8;
        padding: 10px 12px;
        font-size: 14px;
    }

    .role-modal .form-control:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, .10);
    }

    /* =========================
       TOMBOL MODAL
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
       INFO PERMISSION
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
       PERMISSION GRID
    ========================= */

    .permission-list {
        max-height: 390px;
        overflow-y: auto;
        padding: 3px;
    }

    .permission-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .permission-item {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8f9fb;
        border: 1px solid #e7e9ed;
        border-radius: 10px;
        padding: 12px 13px;
        cursor: pointer;
        transition: .2s;
        min-height: 52px;
    }

    .permission-item:hover {
        background: #eef6ff;
        border-color: #cfe2ff;
    }

    .permission-item input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: var(--blue);
        flex-shrink: 0;
    }

    .permission-item label {
        margin: 0;
        cursor: pointer;
        font-size: 13px;
        color: #3f4653;
        flex: 1;
        line-height: 1.3;
    }

    .permission-item:has(input:checked) {
        background: #eef6ff;
        border-color: #9ec8ff;
    }

    .permission-item:has(input:checked) label {
        color: #1264cf;
        font-weight: 600;
    }

    .permission-empty {
        text-align: center;
        padding: 30px;
        color: #888;
        grid-column: 1 / -1;
    }

    /* =========================
       PERMISSION COUNT
    ========================= */

    .permission-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .permission-heading-title {
        font-size: 14px;
        font-weight: 600;
        color: #353b45;
    }

    .permission-heading-badge {
        background: #eaf3ff;
        color: var(--blue);
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11px;
        font-weight: 600;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 992px) {
        .permission-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {

        .role-container {
            padding: 15px;
        }

        .role-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .role-card {
            overflow-x: auto;
        }

        .role-table {
            min-width: 750px;
        }

        .permission-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="role-container">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="role-header">

        <div>
            <h2 class="role-title">
                Role Management
            </h2>

            <p class="role-subtitle">
                Kelola role pengguna dan hak akses sistem
            </p>
        </div>

        {{-- TAMBAH ROLE --}}
        <button type="button"
                class="btn btn-add-role"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahRole">

            <i class="bi bi-plus-lg me-1"></i>
            Tambah Role

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

    <div class="role-card">

        <table class="role-table">

            <thead>

                <tr>

                    <th class="text-center">
                        No
                    </th>

                    <th>
                        Nama Role
                    </th>

                    <th class="text-center">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($roles as $role)

                    <tr>

                        {{-- NO --}}
                        <td class="number-cell">
                            {{ $loop->iteration }}
                        </td>


                        {{-- ROLE --}}
                        <td>

                            <div class="role-name-wrapper">

                                <div class="role-icon">

                                    <i class="bi bi-person-badge-fill"></i>

                                </div>

                                <span class="role-name">
                                    {{ $role->name }}
                                </span>

                            </div>

                        </td>


                        {{-- AKSI --}}
                        <td class="action-cell">

                            <div class="action-buttons">

                                {{-- PERMISSION --}}
                                <button type="button"
                                        class="btn-role btn-permission"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPermission{{ $role->id }}">

                                    <i class="bi bi-shield-check"></i>

                                    Permission

                                </button>


                                {{-- EDIT --}}
                                <button type="button"
                                        class="btn-role btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditRole{{ $role->id }}">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </button>


                                {{-- HAPUS --}}
                                <form action="{{ route('roles.destroy', $role->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-role btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus role {{ $role->name }}?')">

                                        <i class="bi bi-trash3"></i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- =====================================================
                         MODAL EDIT ROLE
                    ====================================================== --}}

                    <div class="modal fade role-modal"
                         id="modalEditRole{{ $role->id }}"
                         tabindex="-1"
                         aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        <i class="bi bi-pencil-square me-2"></i>

                                        Edit Role

                                    </h5>

                                </div>


                                <form action="{{ route('roles.update', $role->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PUT')


                                    <div class="modal-body">

                                        <div class="mb-3">

                                            <label class="form-label fw-semibold">

                                                Nama Role

                                            </label>

                                            <input type="text"
                                                   name="name"
                                                   class="form-control"
                                                   value="{{ $role->name }}"
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


                    {{-- =====================================================
                         MODAL PERMISSION
                    ====================================================== --}}

                    <div class="modal fade role-modal"
                         id="modalPermission{{ $role->id }}"
                         tabindex="-1"
                         aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-lg">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title">

                                        <i class="bi bi-shield-lock-fill me-2"></i>

                                        Permission Role: {{ $role->name }}

                                    </h5>

                                </div>


                                <form action="{{ route('roles.permission.store', $role->id) }}"
                                      method="POST">

                                    @csrf


                                    <div class="modal-body">

                                        {{-- INFO --}}
                                        <div class="permission-info">

                                            <i class="bi bi-info-circle me-1"></i>

                                            Pilih permission yang ingin diberikan
                                            kepada role

                                            <strong>{{ $role->name }}</strong>.

                                        </div>


                                        {{-- JUDUL --}}
                                        <div class="permission-heading">

                                            <span class="permission-heading-title">

                                                Daftar Permission

                                            </span>

                                            <span class="permission-heading-badge">

                                                {{ $permissions->count() }} Permission

                                            </span>

                                        </div>


                                        {{-- LIST PERMISSION --}}
                                        <div class="permission-list">

                                            <div class="permission-grid">

                                                @forelse($permissions as $permission)

                                                    <div class="permission-item">

                                                        <input type="checkbox"
                                                               name="permission[]"
                                                               value="{{ $permission->name }}"
                                                               id="permission{{ $role->id }}_{{ $permission->id }}"
                                                               @if($role->hasPermissionTo($permission->name))
                                                                   checked
                                                               @endif
                                                        >

                                                        <label for="permission{{ $role->id }}_{{ $permission->id }}">

                                                            {{ $permission->name }}

                                                        </label>

                                                    </div>

                                                @empty

                                                    <div class="permission-empty">

                                                        <i class="bi bi-shield-x fs-3 d-block mb-2"></i>

                                                        Belum ada permission yang tersedia.

                                                    </div>

                                                @endforelse

                                            </div>

                                        </div>

                                    </div>


                                    {{-- FOOTER --}}
                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-modal-cancel"
                                                data-bs-dismiss="modal">

                                            Batal

                                        </button>


                                        <button type="submit"
                                                class="btn btn-modal-save">

                                            <i class="bi bi-check2-circle me-1"></i>

                                            Simpan Permission

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

                            <i class="bi bi-person-badge"></i>

                            Belum ada data role.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =====================================================
     MODAL TAMBAH ROLE
====================================================== --}}

<div class="modal fade role-modal"
     id="modalTambahRole"
     tabindex="-1"
     aria-labelledby="modalTambahRoleLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="modalTambahRoleLabel">

                    <i class="bi bi-person-plus-fill me-2"></i>

                    Tambah Role

                </h5>

            </div>


            <form action="{{ route('roles.store') }}"
                  method="POST">

                @csrf


                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">

                            Nama Role

                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Masukkan nama role"
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
     AUTO OPEN MODAL TAMBAH JIKA VALIDASI ERROR
====================================================== --}}

@if($errors->any())

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const modal = document.getElementById('modalTambahRole');

            if (modal) {

                const bootstrapModal = new bootstrap.Modal(modal);

                bootstrapModal.show();

            }

        });

    </script>

@endif

@endsection
