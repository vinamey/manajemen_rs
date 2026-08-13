@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Supplier</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('master-supplier.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Kode Supplier</label>
                <input type="text"
                       name="kode_supplier"
                       class="form-control"
                       value="{{ old('kode_supplier') }}"
                       placeholder="Contoh: SUP001"
                       required>
            </div>

            <div class="mb-3">
                <label>Nama Supplier</label>
                <input type="text"
                       name="nama_supplier"
                       class="form-control"
                       value="{{ old('nama_supplier') }}"
                       placeholder="Nama supplier"
                       required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp') }}"
                       placeholder="08xxxxxxxxxx"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email') }}"
                       placeholder="supplier@email.com">
            </div>

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