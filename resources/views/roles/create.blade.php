@extends('layouts.superadmin')

@section('page-title', 'Tambah Role')

@section('content')

<style>
    :root {
        --role-blue: #1877f2;
        --role-blue-dark: #0f58c6;
        --role-bg: #f4f6f9;
    }

    body {
        background: var(--role-bg) !important;
    }

    .role-form-wrapper {
        max-width: 650px;
        margin: 20px auto;
    }

    .role-form-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .role-form-header {
        background: var(--role-blue);
        color: white;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .role-form-header-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255,255,255,0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .role-form-header h4 {
        margin: 0;
        font-size: 19px;
        font-weight: 700;
    }

    .role-form-header p {
        margin: 2px 0 0;
        font-size: 12px;
        opacity: 0.85;
    }

    .role-form-body {
        padding: 25px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #444;
        margin-bottom: 7px;
    }

    .form-control {
        border: 1px solid #dfe3e8;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
        min-height: 43px;
    }

    .form-control:focus {
        border-color: var(--role-blue);
        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.10);
    }

    .btn-save {
        background: var(--role-blue);
        color: white;
        border: none;
        border-radius: 7px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: var(--role-blue-dark);
        color: white;
    }

    .btn-back {
        background: #eef1f4;
        color: #555;
        border: none;
        border-radius: 7px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #e1e5e9;
        color: #333;
    }

    .button-wrapper {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        margin-top: 22px;
    }

    .alert {
        border-radius: 8px;
        font-size: 13px;
    }
</style>


<div class="role-form-wrapper">

    <div class="role-form-card">

        {{-- HEADER --}}
        <div class="role-form-header">

            <div class="role-form-header-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>

            <div>
                <h4>Tambah Role</h4>
                <p>Tambahkan role pengguna baru</p>
            </div>

        </div>


        {{-- BODY --}}
        <div class="role-form-body">

            {{-- ERROR VALIDATION --}}
            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>
                        Terdapat kesalahan:
                    </strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form action="{{ route('roles.store') }}" method="POST">

                @csrf


                {{-- NAMA ROLE --}}
                <div class="mb-3">

                    <label for="name" class="form-label">
                        Nama Role
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Masukkan nama role"
                        value="{{ old('name') }}"
                        required
                        autofocus>

                </div>


                {{-- BUTTON --}}
                <div class="button-wrapper">

                    <a href="{{ route('roles.index') }}"
                       class="btn btn-back">

                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-save">

                        <i class="bi bi-check-lg me-1"></i>
                        Simpan Role

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endsection
