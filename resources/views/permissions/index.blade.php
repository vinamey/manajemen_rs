@extends('layouts.superadmin')

@section('navbar-title', 'Permission Management')

@section('content')

<style>
    :root {
        --permission-blue: #1877f2;
        --permission-blue-dark: #0f58c6;
        --permission-blue-light: #eaf3ff;
        --permission-bg: #f4f6f9;
    }

    body {
        background: var(--permission-bg) !important;
    }

    .permission-container {
        padding: 20px 10px;
    }

    /* =========================
       HEADER
    ========================= */

    .permission-header {
        background: var(--permission-blue);
        color: white;
        border-radius: 10px;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        box-shadow: 0 4px 12px rgba(24, 119, 242, 0.15);
    }

    .permission-header h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .permission-header p {
        margin: 3px 0 0;
        font-size: 12px;
        opacity: .9;
    }

    /* =========================
       BUTTON TAMBAH
    ========================= */

    .btn-tambah-permission {
        background: #20a464;
        color: white !important;
        border: none;
        border-radius: 7px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-tambah-permission:hover {
        background: #188653;
        color: white !important;
        transform: translateY(-1px);
    }

    /* =========================
       CARD TABLE
    ========================= */

    .permission-card {
        background: white;
        border-radius: 12px;
        border: 1px solid #e3e7ed;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .05);
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
    background: #1877f2 !important;
    color: white;
}

    .permission-table thead th {
        padding: 12px 15px;
        font-size: 13px;
        font-weight: 600;
        border: none;
    }

    .permission-table tbody td {
        padding: 11px 15px;
        font-size: 13px;
        color: #3f4650;
        border-bottom: 1px solid #edf0f4;
        vertical-align: middle;
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
        font-weight: 600;
        color: #707784;
    }

    /* =========================
       NAMA PERMISSION
    ========================= */

    .permission-name-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .permission-icon {
        width: 34px;
        height: 34px;
        background: var(--permission-blue-light);
        color: var(--permission-blue);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .permission-name {
        font-weight: 600;
        color: #303640;
    }

    /* =========================
       AKSI
    ========================= */

    .action-cell {
        width: 190px;
        text-align: center;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
    }

    .btn-action {
        border: none;
        border-radius: 7px;
        padding: 7px 11px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: .2s;
    }

    /* EDIT */

    .btn-edit-permission {
        background: #fff1d6;
        color: #d48600;
    }

    .btn-edit-permission:hover {
        background: #ffe4b3;
        color: #b66f00;
    }

    /* HAPUS */

    .btn-hapus-permission {
        background: #ffe5e8;
        color: #dc3545;
    }

    .btn-hapus-permission:hover {
        background: #ffd5d9;
        color: #b02a37;
    }

    /* =========================
       EMPTY
    ========================= */

    .empty-permission {
        text-align: center;
        padding: 45px 20px !important;
        color: #8a929e;
    }

    .empty-permission i {
        display: block;
        font-size: 35px;
        margin-bottom: 8px;
        color: #b7bec8;
    }

    /* =========================
       ALERT
    ========================= */

    .permission-alert {
        border-radius: 9px;
        border: none;
        font-size: 13px;
    }

    /* =========================
       MODAL
    ========================= */

    .permission-modal .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0, 0, 0, .15);
    }

    .permission-modal .modal-header {
        background: var(--permission-blue);
        color: white;
        border: none;
        padding: 15px 18px;
    }

    .permission-modal .modal-title {
        font-size: 17px;
        font-weight: 600;
    }

    .permission-modal .modal-body {
        padding: 20px;
    }

    .permission-modal .modal-footer {
        border-top: 1px solid #edf0f4;
        padding: 13px 18px;
    }

    .permission-modal .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #343a40;
        margin-bottom: 7px;
    }

    .permission-modal .form-control {
        border-radius: 8px;
        border: 1px solid #d9dee5;
        padding: 10px 12px;
        font-size: 13px;
    }

    .permission-modal .form-control:focus {
        border-color: var(--permission-blue);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, .10);
    }

    .permission-info {
        background: #f1f7ff;
        border: 1px solid #d9eaff;
        border-radius: 8px;
        padding: 11px 13px;
        color: #59616d;
        font-size: 12px;
        margin-bottom: 17px;
    }

    .permission-info i {
        color: var(--permission-blue);
    }

    /* =========================
       MODAL BUTTON
    ========================= */

    .btn-modal-batal {
        background: #eef0f3;
        color: #555;
        border: none;
        border-radius: 7px;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-batal:hover {
        background: #dfe3e8;
        color: #333;
    }

    .btn-modal-simpan {
        background: var(--permission-blue);
        color: white;
        border: none;
        border-radius: 7px;
        padding: 8px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-simpan:hover {
        background: var(--permission-blue-dark);
        color: white;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .permission-container {
            padding: 15px 5px;
        }

        .permission-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .permission-header .btn-tambah-permission {
            width: 100%;
        }

        .permission-card {
            overflow-x: auto;
        }

        .permission-table {
            min-width: 650px;
        }
    }
</style>


<div class="permission-container">

    {{-- =========================
         HEADER
    ========================= --}}

    <div class="permission-header">

        <div>
            <h4>
                <i class="bi bi-shield-check me-2"></i>
                Permission Management
            </h4>

            <p>
                Kelola permission atau hak akses sistem
            </p>
        </div>


        {{-- TAMBAH PERMISSION --}}

        <button type="button"
                class="btn btn-tambah-permission"
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

        <div class="alert alert-success permission-alert mb-3">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- =========================
         ERROR
    ========================= --}}

    @if(session('error'))

        <div class="alert alert-danger permission-alert mb-3">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            {{ session('error') }}

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

                        {{-- NO --}}

                        <td class="number-cell">
                            {{ $loop->iteration }}
                        </td>


                        {{-- NAMA --}}

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
                                        class="btn-action btn-edit-permission"
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
                                            class="btn-action btn-hapus-permission"
                                            onclick="return confirm('Yakin ingin menghapus permission ini?')">

                                        <i class="bi bi-trash3"></i>

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>


                    {{-- =================================================
                         MODAL EDIT
                    ================================================== --}}

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
                                            hak akses sistem.

                                        </div>


                                        <div class="mb-3">

                                            <label class="form-label">
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
                                                class="btn btn-modal-batal"
                                                data-bs-dismiss="modal">

                                            Batal

                                        </button>


                                        <button type="submit"
                                                class="btn btn-modal-simpan">

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
                            class="empty-permission">

                            <i class="bi bi-shield-x"></i>

                            Tidak ada Permission.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH PERMISSION
========================================================= --}}

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

                        Tambahkan permission baru untuk digunakan
                        sebagai hak akses sistem.

                    </div>


                    <div class="mb-3">

                        <label class="form-label">
                            Nama Permission
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Contoh: master dokter"
                               required
                               autocomplete="off">

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-modal-batal"
                            data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button type="submit"
                            class="btn btn-modal-simpan">

                        <i class="bi bi-save me-1"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
