@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah User</h4>
    </div>

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label>Nama</label>

                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Password</label>

                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label>Role</label>

                <select name="role" class="form-control" required>

                    <option value="">-- Pilih Role --</option>

                    @foreach($roles as $role)

                        <option value="{{ $role->name }}">
                            {{ $role->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <button class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection