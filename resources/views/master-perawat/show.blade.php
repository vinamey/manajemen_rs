@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Perawat</h4>
    </div>

    <div class="card-body">

        <div class="mb-3">
            <label class="fw-bold">Nama Perawat</label>
            <div class="form-control bg-light">
                {{ $perawat->Nama }}
            </div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Jenis Kelamin</label>
            <div class="form-control bg-light">
                {{ ucfirst($perawat->Jenis_Kelamin) }}
            </div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Tanggal Lahir</label>
            <div class="form-control bg-light">
                {{ $perawat->Tanggal_Lahir }}
            </div>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Alamat</label>
            <div class="form-control bg-light">
                {{ $perawat->Alamat }}
            </div>
        </div>

        <a href="{{ route('master-perawat.edit', $perawat->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-perawat.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection