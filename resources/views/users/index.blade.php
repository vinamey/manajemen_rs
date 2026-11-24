@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard User Management')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #eaf3ff;
        --bg-page: #f4f6fa;
        --text-dark: #263238;
    }

    body {
        background: var(--bg-page) !important;
    }

    /* =========================
       HEADER DATA USER
    ========================= */

    .user-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .user-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .user-title-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #e8f2ff;
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .user-title h2 {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #252525;
    }

    .user-title p {
        margin: 2px 0 0;
        color: #7b8794;
        font-size: 13px;
    }

    /* =========================
       BUTTON TAMBAH
    ========================= */

    .btn-tambah-user {
        background: var(--blue-main);
        color: white;
        border: none;
        border-radius: 7px;
        padding: 9px 17px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-tambah-user:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* =========================
       CARD TABLE
    ========================= */

    .user-table-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.07);
    }

    .user-table-wrapper {
        overflow-x: auto;
    }

    .user-table {
        width: 100%;
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .user-table thead th {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 13px 14px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .user-table tbody td {
        padding: 13px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #edf0f3;
        color: #606b75;
        font-size: 12px;
    }

    .user-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-table tbody tr:hover {
        background: #f8fbff;
    }

    /* =========================
       NOMOR
    ========================= */

    .number-cell {
        width: 55px;
        text-align: center;
        color: #6c757d !important;
    }

    /* =========================
       USER NAME
    ========================= */

    .user-name-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        min-width: 32px;
        border-radius: 50%;
        background: #e6f1ff;
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .user-name {
        color: #20252a;
        font-weight: 600;
        font-size: 13px;
    }

    .user-id {
        color: #8b949e;
        font-size: 10px;
        margin-top: 2px;
    }

    /* =========================
       EMAIL
    ========================= */

    .email-text {
        color: #68737d;
        font-size: 12px;
    }

    /* =========================
       ROLE BADGE
    ========================= */

    .role-badge {
        display: inline-block;
        padding: 5px 11px;
        border-radius: 6px;
        background: #e9f3ff;
        color: #1877f2;
        font-size: 10px;
        font-weight: 600;
    }

    .role-empty {
        color: #9aa1a8;
        font-size: 11px;
    }

    /* =========================
       ACTION
    ========================= */

    .action-buttons {
        display: flex;
        align-items: center;
        gap: 4px;
        white-space: nowrap;
    }

    .btn-action {
        border: none;
        border-radius: 6px;
        padding: 7px 10px;
        font-size: 10px;
        font-weight: 500;
        min-width: 60px;
    }

            .btn-ubah {
            background: #e5f4ff;
            color: #1684d8;
        }

        .btn-ubah:hover {
            background: #d2ecff;
            color: #1684d8;
        }

    .btn-edit {
        background: #1877f2;
        color: white;
    }

    .btn-edit:hover {
        background: #0f58c6;
        color: white;
    }

    .btn-delete {
        background: #ff4d55;
        color: white;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    /* =========================
       ALERT
    ========================= */

    .success-alert {
        border: none;
        border-radius: 8px;
        background: #e8f8ee;
        color: #198754;
        font-size: 13px;
        margin-bottom: 18px;
    }

    /* =========================
       MODAL
    ========================= */

    .user-modal .modal-dialog {
        max-width: 500px;
    }

    .user-modal .modal-content {
        border: none;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.20);
    }

    .user-modal .modal-header {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 14px 16px;
    }

    .user-modal .modal-title {
        font-size: 14px;
        font-weight: 600;
    }

    .user-modal .modal-body {
        padding: 17px 16px 10px;
    }

    .user-modal .modal-footer {
        background: #f8f9fa;
        border-top: 1px solid #edf0f3;
        padding: 11px 16px;
    }

    .form-label-user {
        display: block;
        font-size: 10px;
        color: #637083;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .user-form-control {
        width: 100%;
        height: 40px;
        border: 1px solid #d9e0e8;
        border-radius: 7px;
        padding: 0 12px;
        font-size: 12px;
        color: #495057;
        outline: none;
    }

    .user-form-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.10);
    }

    .user-select {
        width: 100%;
        height: 40px;
        border: 1px solid #d9e0e8;
        border-radius: 7px;
        padding: 0 12px;
        font-size: 12px;
        color: #495057;
        background: white;
        outline: none;
    }

    .user-select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.10);
    }

    .modal-label-group {
        margin-bottom: 13px;
    }

    .btn-modal-save {
        background: var(--blue-main);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 15px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-modal-save:hover {
        background: var(--blue-dark);
        color: white;
    }

    .btn-modal-cancel {
        background: transparent;
        border: none;
        color: #444;
        font-size: 11px;
        padding: 8px 12px;
    }

    .btn-modal-cancel:hover {
        color: #000;
    }

    .modal-error {
        background: #fff1f1;
        border: 1px solid #ffd4d4;
        color: #d63343;
        border-radius: 7px;
        padding: 9px 11px;
        font-size: 11px;
        margin-bottom: 12px;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .user-page-header {
            align-items: flex-start;
            gap: 15px;
        }

        .user-title h2 {
            font-size: 21px;
        }

        .action-buttons {
            flex-wrap: wrap;
        }

        .user-table {
            min-width: 850px;
        }
    }
</style>


<div class="container-fluid px-4 py-4">

    {{-- =========================
         NOTIFIKASI BERHASIL
    ========================== --}}
    @if(session('success'))
        <div class="alert success-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- =========================
         HEADER
    ========================== --}}
    <div class="user-page-header">

        <div class="user-title">

            <div class="user-title-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div>
                <h2>User Management</h2>
                <p>Data pengguna sistem yang terdaftar</p>
            </div>

        </div>


        <button
            type="button"
            class="btn btn-tambah-user"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahUser"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Tambah User
        </button>

    </div>


    {{-- =========================
         TABLE
    ========================== --}}
    <div class="user-table-card">

        <div class="user-table-wrapper">

            <table class="user-table">

                <thead>

                    <tr>
                        <th width="55">No</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th width="230">Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- NO --}}
                            <td class="number-cell">
                                {{ $loop->iteration }}
                            </td>


                            {{-- NAMA --}}
                            <td>

                                <div class="user-name-wrapper">

                                    <div class="user-avatar">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                    <div>

                                        <div class="user-name">
                                            {{ $user->name }}
                                        </div>

                                        <div class="user-id">
                                            ID: {{ $user->id }}
                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- EMAIL --}}
                            <td>
                                <span class="email-text">
                                    {{ $user->email }}
                                </span>
                            </td>


                            {{-- ROLE --}}
                            <td>

                                @if($user->roles->count())

                                    @foreach($user->roles as $role)

                                        <span class="role-badge">
                                            {{ $role->name }}
                                        </span>

                                    @endforeach

                                @else

                                    <span class="role-empty">
                                        Belum ada role
                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-buttons">

                                    {{-- UBAH PASSWORD --}}
                                    <button
                                        type="button"
                                        class="btn-action btn-ubah"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalUbahPassword{{ $user->id }}"
                                    >
                                        <i class="bi bi-pencil-square me-1"></i>
                                        Ubah
                                    </button>


                                    {{-- EDIT --}}
                                    <button
                                        type="button"
                                        class="btn-action btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser{{ $user->id }}"
                                    >
                                        <i class="bi bi-pencil-square me-1"></i>
                                        Edit
                                    </button>


                                    {{-- HAPUS --}}
                                    <form
                                        action="{{ route('users.destroy', $user->id) }}"
                                        method="POST"
                                        class="d-inline"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        >
                                            <i class="bi bi-trash-fill me-1"></i>
                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                        {{-- ==================================================
                             MODAL EDIT USER
                        =================================================== --}}
                        <div
                            class="modal fade user-modal"
                            id="modalEditUser{{ $user->id }}"
                            tabindex="-1"
                            aria-hidden="true"
                        >

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Edit User
                                        </h5>

                                    </div>


                                    <form
                                        action="{{ route('users.update', $user->id) }}"
                                        method="POST"
                                    >

                                        @csrf
                                        @method('PUT')


                                        <div class="modal-body">

                                            <div class="modal-label-group">

                                                <label class="form-label-user">
                                                    Nama User
                                                </label>

                                                <input
                                                    type="text"
                                                    name="name"
                                                    class="user-form-control"
                                                    value="{{ $user->name }}"
                                                    placeholder="Masukkan nama user"
                                                    required
                                                >

                                            </div>


                                            <div class="modal-label-group">

                                                <label class="form-label-user">
                                                    Email
                                                </label>

                                                <input
                                                    type="email"
                                                    name="email"
                                                    class="user-form-control"
                                                    value="{{ $user->email }}"
                                                    placeholder="Masukkan email user"
                                                    required
                                                >

                                            </div>


                                            <div class="modal-label-group">

                                                <label class="form-label-user">
                                                    Role
                                                </label>

                                                <select
                                                    name="role"
                                                    class="user-select"
                                                    required
                                                >

                                                    <option value="">
                                                        -- Pilih Role --
                                                    </option>

                                                    @foreach($roles as $role)

                                                        <option
                                                            value="{{ $role->name }}"
                                                            {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}
                                                        >
                                                            {{ $role->name }}
                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>


                                            <div class="modal-label-group">

                                                <label class="form-label-user">
                                                    Password Baru
                                                    <span style="font-weight:400;color:#9aa1a8;">
                                                        (opsional)
                                                    </span>
                                                </label>

                                                <input
                                                    type="password"
                                                    name="password"
                                                    class="user-form-control"
                                                    placeholder="Kosongkan jika tidak ingin mengubah password"
                                                >

                                            </div>

                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn-modal-cancel"
                                                data-bs-dismiss="modal"
                                            >
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="btn-modal-save"
                                            >
                                                <i class="bi bi-save-fill me-1"></i>
                                                Simpan Perubahan
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>


                        {{-- ==================================================
                            MODAL UBAH PASSWORD
                        =================================================== --}}
                        <div
                            class="modal fade user-modal"
                            id="modalUbahPassword{{ $user->id }}"
                            tabindex="-1"
                            aria-hidden="true"
                        >

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title">
                                            <i class="bi bi-pencil-square me-2"></i>
                                            Ubah Password
                                        </h5>

                                    </div>

                                    <form
                                        action="{{ route('users.reset-password.update', $user->id) }}"
                                        method="POST"
                                    >

                                        @csrf


                                        <div class="modal-body">

                                            <div
                                                style="
                                                    background:#eaf3ff;
                                                    border-radius:8px;
                                                    padding:10px 12px;
                                                    margin-bottom:15px;
                                                "
                                            >

                                                <div
                                                    style="
                                                        font-size:11px;
                                                        font-weight:600;
                                                        color:#1877f2;
                                                    "
                                                >
                                                    <i class="bi bi-person-fill me-1"></i>
                                                    {{ $user->name }}
                                                </div>

                                                <div
                                                    style="
                                                        font-size:10px;
                                                        color:#77818c;
                                                        margin-top:2px;
                                                    "
                                                >
                                                    {{ $user->email }}
                                                </div>

                                            </div>


                                            <div class="modal-label-group">

                                                <label class="form-label-user">
                                                    Password Baru
                                                </label>

                                                <input
                                                    type="password"
                                                    name="password"
                                                    class="user-form-control"
                                                    placeholder="Masukkan password baru"
                                                    minlength="8"
                                                    required
                                                >

                                            </div>


                                            <div class="modal-label-group">

                                                <label class="form-label-user">
                                                    Konfirmasi Password
                                                </label>

                                                <input
                                                    type="password"
                                                    name="password_confirmation"
                                                    class="user-form-control"
                                                    placeholder="Masukkan kembali password"
                                                    minlength="8"
                                                    required
                                                >

                                            </div>


                                            <div
                                                style="
                                                    background:#f8f9fa;
                                                    border-left:3px solid #1877f2;
                                                    padding:8px 10px;
                                                    border-radius:5px;
                                                    font-size:10px;
                                                    color:#737b83;
                                                "
                                            >
                                                <i class="bi bi-info-circle me-1"></i>
                                                Password minimal 8 karakter.
                                            </div>

                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn-modal-cancel"
                                                data-bs-dismiss="modal"
                                            >
                                                Batal
                                            </button>

                                            <button
                                                type="submit"
                                                class="btn-modal-save"
                                            >
                                                <i class="bi bi-key-fill me-1"></i>
                                                Ubah Password
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <tr>

                            <td
                                colspan="5"
                                class="text-center"
                                style="padding:40px;color:#89929c;"
                            >
                                <i
                                    class="bi bi-people"
                                    style="font-size:30px;"
                                ></i>

                                <div style="margin-top:8px;">
                                    Belum ada data user.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ==================================================
     MODAL TAMBAH USER
=================================================== --}}
<div
    class="modal fade user-modal"
    id="modalTambahUser"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="bi bi-person-plus-fill me-2"></i>
                    Tambah User
                </h5>

            </div>


            <form
                action="{{ route('users.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">

                    <div class="modal-label-group">

                        <label class="form-label-user">
                            Nama User
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="user-form-control"
                            placeholder="Masukkan nama user"
                            required
                        >

                    </div>


                    <div class="modal-label-group">

                        <label class="form-label-user">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="user-form-control"
                            placeholder="Masukkan email user"
                            required
                        >

                    </div>


                    <div class="modal-label-group">

                        <label class="form-label-user">
                            Role
                        </label>

                        <select
                            name="role"
                            class="user-select"
                            required
                        >

                            <option value="">
                                -- Pilih Role --
                            </option>

                            @foreach($roles as $role)

                                <option value="{{ $role->name }}">
                                    {{ $role->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="modal-label-group">

                        <label class="form-label-user">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="user-form-control"
                            placeholder="Masukkan password"
                            minlength="8"
                            required
                        >

                    </div>


                    <div class="modal-label-group">

                        <label class="form-label-user">
                            Konfirmasi Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="user-form-control"
                            placeholder="Masukkan ulang password"
                            minlength="8"
                            required
                        >

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-modal-save"
                    >
                        <i class="bi bi-save-fill me-1"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
