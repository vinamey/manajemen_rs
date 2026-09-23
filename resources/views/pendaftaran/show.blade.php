@extends('layouts.superadmin')

@section('content')

<style>
    /* ==========================================
       TAMPILAN CETAK
       ========================================== */

    @media print {

        /* Sembunyikan semua elemen halaman */
        body * {
            visibility: hidden;
        }

        /* Hanya area cetak yang ditampilkan */
        .print-area,
        .print-area * {
            visibility: visible;
        }

        /* Area cetak memenuhi halaman */
        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
        }

        /* Elemen yang tidak ingin dicetak */
        .no-print {
            display: none !important;
        }

        /* Hilangkan shadow */
        .card {
            box-shadow: none !important;
        }

        /* Background putih */
        body {
            background: white !important;
        }

        /* Rapikan container */
        .container-fluid {
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Warna tetap terlihat saat print */
        .bg-primary,
        .bg-success,
        .bg-dark {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .badge {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

    }
</style>


{{-- ================================================= --}}
{{-- AREA YANG AKAN DICETAK --}}
{{-- ================================================= --}}

<div class="print-area">

    <div class="container-fluid">


        {{-- ========================================== --}}
        {{-- HEADER --}}
        {{-- ========================================== --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-file-earmark-medical"></i>

                    Detail Pendaftaran Pasien

                </h3>

                <p class="text-muted mb-0">

                    Informasi lengkap data pendaftaran pasien

                </p>

            </div>


            {{-- Tombol tidak ikut dicetak --}}

            <div class="d-flex gap-2 no-print">

                <a href="{{ route('pendaftaran.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali ke Daftar

                </a>


                <button type="button"
                        onclick="window.print()"
                        class="btn btn-primary">

                    <i class="bi bi-printer"></i>

                    Cetak Bukti

                </button>

            </div>

        </div>



        {{-- ========================================== --}}
        {{-- NOMOR ANTRIAN --}}
        {{-- ========================================== --}}

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body text-center py-4">

                <p class="text-muted mb-2">

                    NOMOR ANTRIAN

                </p>

                <h1 class="fw-bold text-primary mb-2">

                    {{ $pendaftaran->nomor_antrian }}

                </h1>


                {{-- STATUS --}}

                <td>
    @if($pendaftaran->status === 'menunggu')
        <span class="badge bg-warning text-dark">
            Menunggu
        </span>
    @elseif($pendaftaran->status === 'selesai')
        <span class="badge bg-success">
            Selesai
        </span>
    @endif
</td>
            </div>

        </div>



        {{-- ========================================== --}}
        {{-- INFORMASI PASIEN & PEMERIKSAAN --}}
        {{-- ========================================== --}}

        <div class="row">


            {{-- INFORMASI PASIEN --}}

            <div class="col-lg-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">

                            <i class="bi bi-person-fill"></i>

                            Informasi Pasien

                        </h5>

                    </div>


                    <div class="card-body">


                        {{-- Nama Pasien --}}

                        <div class="mb-4">

                            <small class="text-muted d-block mb-1">

                                Nama Pasien

                            </small>

                            <h5 class="fw-bold mb-0">

                                {{ $pendaftaran->pasien->nama ?? '-' }}

                            </h5>

                        </div>



                        {{-- ID Pasien --}}

                        <div class="mb-4">

                            <small class="text-muted d-block mb-1">

                                ID Pasien

                            </small>

                            <span class="fw-semibold">

                                #{{ $pendaftaran->pasien_id }}

                            </span>

                        </div>



                        {{-- Tanggal Pendaftaran --}}

                        <div>

                            <small class="text-muted d-block mb-1">

                                Tanggal Pendaftaran

                            </small>

                            <span class="fw-semibold">

                                <i class="bi bi-calendar-event"></i>

                                {{ \Carbon\Carbon::parse(
                                    $pendaftaran->tanggal_pendaftaran
                                )->translatedFormat('d F Y') }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>



            {{-- INFORMASI PEMERIKSAAN --}}

            <div class="col-lg-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-header bg-success text-white">

                        <h5 class="mb-0">

                            <i class="bi bi-hospital"></i>

                            Informasi Pemeriksaan

                        </h5>

                    </div>


                    <div class="card-body">


                        {{-- Dokter --}}

                        <div class="mb-4">

                            <small class="text-muted d-block mb-1">

                                Dokter

                            </small>

                            <h5 class="fw-bold mb-0">

                                <i class="bi bi-person-badge"></i>

                                {{ $pendaftaran->dokter->nama ?? '-' }}

                            </h5>

                        </div>



                        {{-- Poli --}}

                        <div class="mb-4">

                            <small class="text-muted d-block mb-1">

                                Poli

                            </small>

                            <span class="fw-semibold">

                                <i class="bi bi-building"></i>

                                {{ $pendaftaran->poli->nama ?? '-' }}

                            </span>

                        </div>



                        {{-- Kamar --}}

                        <div>

                            <small class="text-muted d-block mb-1">

                                Kamar

                            </small>

                            <span class="fw-semibold">

                                <i class="bi bi-door-open"></i>

                                {{ $pendaftaran->kamar->nama
                                    ?? 'Tidak menggunakan kamar' }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================== --}}
        {{-- STATUS PENDAFTARAN --}}
        {{-- ========================================== --}}

        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-dark text-white">

                <h5 class="mb-0">

                    <i class="bi bi-clipboard-check"></i>

                    Status Pendaftaran

                </h5>

            </div>


            <div class="card-body">

                <div class="row text-center">


                    {{-- MENUNGGU --}}

                    <div class="col-md-4 mb-3">

                        <div class="border rounded p-3
                            {{ $pendaftaran->status == 'menunggu'
                                ? 'border-warning'
                                : '' }}">

                            <i class="bi bi-clock fs-3 text-warning"></i>

                            <h6 class="mt-2">

                                Menunggu

                            </h6>


                            @if($pendaftaran->status == 'menunggu')

                                <span class="badge bg-warning text-dark">

                                    Status Saat Ini

                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- DIPERIKSA --}}

                    <div class="col-md-4 mb-3">

                        <div class="border rounded p-3
                            {{ $pendaftaran->status == 'diperiksa'
                                ? 'border-info'
                                : '' }}">

                            <i class="bi bi-heart-pulse fs-3 text-info"></i>

                            <h6 class="mt-2">

                                Diperiksa

                            </h6>


                            @if($pendaftaran->status == 'diperiksa')

                                <span class="badge bg-info">

                                    Status Saat Ini

                                </span>

                            @endif

                        </div>

                    </div>



                    {{-- SELESAI --}}

                    <div class="col-md-4 mb-3">

                        <div class="border rounded p-3
                            {{ $pendaftaran->status == 'selesai'
                                ? 'border-success'
                                : '' }}">

                            <i class="bi bi-check-circle fs-3 text-success"></i>

                            <h6 class="mt-2">

                                Selesai

                            </h6>


                            @if($pendaftaran->status == 'selesai')

                                <span class="badge bg-success">

                                    Status Saat Ini

                                </span>

                            @endif

                        </div>

                    </div>


                </div>

            </div>

        </div>



        {{-- ========================================== --}}
        {{-- TOMBOL BAWAH --}}
        {{-- ========================================== --}}

        <div class="d-flex justify-content-between mb-4 no-print">

            <a href="{{ route('pendaftaran.index') }}"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>

                Kembali ke Daftar

            </a>


            <button type="button"
                    onclick="window.print()"
                    class="btn btn-primary">

                <i class="bi bi-printer"></i>

                Cetak Bukti Pendaftaran

            </button>

        </div>


    </div>

</div>

@endsection