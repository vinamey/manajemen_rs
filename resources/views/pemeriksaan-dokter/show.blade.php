@extends('layouts.superadmin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h3 class="fw-bold mb-1">
                <i class="bi bi-clipboard2-pulse me-2"></i>
                Detail Pemeriksaan Dokter
            </h3>

            <p class="text-muted mb-0">
                Informasi pemeriksaan pasien
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('pemeriksaan-dokter.edit', $pemeriksaanDokter->id) }}"
               class="btn btn-warning">

                <i class="bi bi-pencil me-1"></i>
                Edit

            </a>

            <a href="{{ route('pemeriksaan-dokter.index') }}"
               class="btn btn-secondary">

                <i class="bi bi-arrow-left me-1"></i>
                Kembali

            </a>

        </div>

    </div>


    {{-- DATA PASIEN --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0 fw-bold">
                <i class="bi bi-person-vcard me-2"></i>
                Data Pendaftaran
            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <small class="text-muted">
                        No. Antrian
                    </small>

                    <div class="fw-bold fs-5">
                        {{ $pemeriksaanDokter->pendaftaran->nomor_antrian ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <small class="text-muted">
                        Nama Pasien
                    </small>

                    <div class="fw-semibold">
                        {{ $pemeriksaanDokter->pendaftaran->pasien->nama ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <small class="text-muted">
                        Poli
                    </small>

                    <div class="fw-semibold">
                        {{ $pemeriksaanDokter->pendaftaran->poli->nama ?? '-' }}
                    </div>

                </div>


                <div class="col-md-6 mb-3">

                    <small class="text-muted">
                        Dokter Pemeriksa
                    </small>

                    <div class="fw-semibold">
                        {{ $pemeriksaanDokter->dokter->nama ?? '-' }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- HASIL PEMERIKSAAN --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header">

            <h5 class="mb-0 fw-bold">
                <i class="bi bi-clipboard2-check me-2"></i>
                Hasil Pemeriksaan
            </h5>

        </div>

        <div class="card-body">

            <div class="mb-4">

                <label class="fw-bold mb-2">
                    Keluhan Pasien
                </label>

                <div class="p-3 bg-light rounded">
                    {{ $pemeriksaanDokter->keluhan }}
                </div>

            </div>


            <div>

                <label class="fw-bold mb-2">
                    Resep Obat
                </label>

                <div class="p-3 bg-light rounded">
                    {{ $pemeriksaanDokter->resep_obat }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection