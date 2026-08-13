@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Dokter</h4>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label class="fw-bold">Kode Dokter</label>
                <div class="form-control bg-light">
                    {{ $dokter->kode_dokter }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="fw-bold">Nama Dokter</label>
                <div class="form-control bg-light">
                    {{ $dokter->nama }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="fw-bold">Jenis Kelamin</label>
                <div class="form-control bg-light">
                    {{ ucfirst($dokter->jenis_kelamin) }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="fw-bold">Spesialis</label>
                <div class="form-control bg-light">
                    {{ $dokter->spesialis ?? '-' }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="fw-bold">No HP</label>
                <div class="form-control bg-light">
                    {{ $dokter->no_hp ?? '-' }}
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="fw-bold">Alamat</label>
                <div class="form-control bg-light">
                    {{ $dokter->alamat ?? '-' }}
                </div>
            </div>

        </div>

        <a href="{{ route('master-dokter.edit', $dokter->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-dokter.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection