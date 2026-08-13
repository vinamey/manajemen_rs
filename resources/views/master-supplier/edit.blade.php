@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4>Edit Supplier</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('master-supplier.update', $masterSupplier->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kode Supplier</label>

                <input type="text"
                       name="kode_supplier"
                       class="form-control"
                       value="{{ old('kode_supplier', $masterSupplier->kode_supplier) }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Nama Supplier</label>

                <input type="text"
                       name="nama_supplier"
                       class="form-control"
                       value="{{ old('nama_supplier', $masterSupplier->nama_supplier) }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat', $masterSupplier->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp', $masterSupplier->no_hp) }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Email</label>

                <input type="email"
                       name="email"
                       class="form-control"
                       value="{{ old('email', $masterSupplier->email) }}">
            </div>

            <button type="submit"
                    class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('master-supplier.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection