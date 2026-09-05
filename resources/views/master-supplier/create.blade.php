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