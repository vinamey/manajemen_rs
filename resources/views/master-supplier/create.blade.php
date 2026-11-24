
@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Supplier</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('master-supplier.store') }}" method="POST">
            @csrf

            <!-- Nama Supplier -->
            <div class="mb-3">
                <label>Nama Supplier</label>

                <input type="text"
                       name="nama"
                       class="form-control @error('nama') is-invalid @enderror"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama supplier"
                       required>

                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Tombol -->
            <button type="submit" class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-supplier.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection
