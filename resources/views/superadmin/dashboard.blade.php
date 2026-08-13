@extends('layouts.superadmin')

@section('content')

<h3 class="mb-4">
    Dashboard Super Admin
</h3>

<div class="row">

    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h5>Total User</h5>
                <h2>{{ $totalUser }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h5>Total Dokter</h5>
                <h2>{{ $totalDokter }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white shadow">
            <div class="card-body">
                <h5>Total Pasien</h5>
                <h2>{{ $totalPasien }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white shadow">
            <div class="card-body">
                <h5>Total Obat</h5>
                <h2>{{ $totalObat }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-4 mb-3">
        <div class="card shadow border-start border-primary border-4">
            <div class="card-body">
                <h5>Pendaftaran Pasien</h5>
                <h3>{{ $totalPendaftaran }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow border-start border-success border-4">
            <div class="card-body">
                <h5>Pemeriksaan Dokter</h5>
                <h3>{{ $totalPemeriksaan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow border-start border-danger border-4">
            <div class="card-body">
                <h5>Pembayaran</h5>
                <h3>{{ $totalPembayaran }}</h3>
            </div>
        </div>
    </div>

</div>

@endsection