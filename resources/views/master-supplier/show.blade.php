@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Supplier</h4>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="fw-bold">Kode Supplier</label>
            <input type="text"
                   class="form-control"
                   value="{{ $masterSupplier->kode_supplier }}"
                   readonly>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Nama Supplier</label>
            <input type="text"
                   class="form-control"
                   value="{{ $masterSupplier->nama_supplier }}"
                   readonly>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Alamat</label>
            <textarea class="form-control"
                      rows="3"
                      readonly>{{ $masterSupplier->alamat }}</textarea>
        </div>

        <div class="mb-3">
            <label class="fw-bold">No HP</label>
            <input type="text"
                   class="form-control"
                   value="{{ $masterSupplier->no_hp }}"
                   readonly>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Email</label>
            <input type="text"
                   class="form-control"
                   value="{{ $masterSupplier->email ?? '-' }}"
                   readonly>
        </div>

        <a href="{{ route('master-supplier.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('master-supplier.edit', $masterSupplier->id) }}"
           class="btn btn-warning">
            Edit
        </a>

    </div>

</div>

@endsection