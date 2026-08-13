@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Permission</h4>
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

        <form action="{{ route('permissions.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Permission</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    placeholder="Contoh : user.create"
                    value="{{ old('name') }}"
                    required>

                <small class="text-muted">
                    Contoh: user.create, user.edit, role.delete
                </small>
            </div>

            <button type="submit" class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection