
@extends('layouts.superadmin')

@section('page-title', 'Detail Pemeriksaan Dokter')

@section('content')

<style>
    .detail-header {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        color: #fff;
        border-radius: 14px;
        padding: 22px 25px;
        margin-bottom: 24px;
        box-shadow: 0 6px 20px rgba(24,119,242,.15);
    }

    .detail-header h3 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .detail-header p {
        margin-bottom: 0;
        opacity: .9;
    }

    .detail-card {
        background: #fff;
        border: none;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(0,0,0,.05);
        margin-bottom: 22px;
    }

    .detail-card-header {
        background: #e7f3ff;
        color: #0f58c6;
        padding: 16px 20px;
        border-bottom: 1px solid #dbeafe;
    }

    .detail-card-header h5 {
        margin: 0;
        font-weight: 700;
    }

    .detail-card-body {
        padding: 22px;
    }

    .detail-label {
        color: #64748b;
        font-size: 13px;
        margin-bottom: 6px;
    }

    .detail-value {
        color: #1f2937;
        font-weight: 600;
        overflow-wrap: anywhere;
    }

    .detail-box {
        background: #f4f8ff;
        border: 1px solid #e0ecff;
        border-radius: 10px;
        padding: 15px;
        color: #374151;
        white-space: pre-line;
    }

    .btn-back {
        background: #fff;
        color: #0f58c6;
        border: 1px solid #dbeafe;
        border-radius: 8px;
        padding: 9px 16px;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #e7f3ff;
        color: #0f58c6;
    }

    .table-resep {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .table-resep thead th {
        background: #1877f2 !important;
        color: #fff !important;
        padding: 12px 14px;
        border: 1px solid #dbe2ea;
        white-space: nowrap;
        font-size: 13px;
    }

    .table-resep tbody td {
        padding: 12px 14px;
        border: 1px solid #dbe2ea;
        color: #374151;
        vertical-align: middle;
        font-size: 13px;
    }

    .table-resep tbody tr:hover {
        background: #f4f8ff;
    }

    .nama-obat {
        color: #0f58c6 !important;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .detail-header {
            padding: 18px;
        }

        .detail-card-body {
            padding: 15px;
        }
    }
</style>

{{-- HEADER --}}
<div class="detail-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3>
                <i class="fa-solid fa-stethoscope me-2"></i>
                Detail Pemeriksaan Dokter
            </h3>
            <p>Informasi pemeriksaan pasien dan resep obat.</p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pemeriksaan-dokter.edit', $pemeriksaan->id) }}"
               class="btn btn-light text-primary fw-semibold">
                <i class="fa-solid fa-pen-to-square me-1"></i>
                Edit
            </a>

            <a href="{{ route('pemeriksaan-dokter.index') }}"
               class="btn-back">
                <i class="fa-solid fa-arrow-left me-1"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

{{-- NOTIFIKASI --}}
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- DATA PENDAFTARAN --}}
<div class="detail-card">
    <div class="detail-card-header">
        <h5>
            <i class="fa-solid fa-user me-2"></i>
            Data Pendaftaran Pasien
        </h5>
    </div>

    <div class="detail-card-body">
        <div class="row g-4">

            <div class="col-md-6">
                <div class="detail-label">No. Antrian</div>
                <div class="detail-value">
                    {{ $pemeriksaan->pendaftaran->nomor_antrian ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Nama Pasien</div>
                <div class="detail-value">
                    {{ $pemeriksaan->pendaftaran->pasien->nama ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Poli</div>
                <div class="detail-value">
                    {{ $pemeriksaan->pendaftaran->poli->nama ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Dokter Pemeriksa</div>
                <div class="detail-value">
                    {{ $pemeriksaan->dokter->nama ?? '-' }}
                </div>
            </div>

            <div class="col-md-6">
                <div class="detail-label">Tanggal Pemeriksaan</div>
                <div class="detail-value">
                    {{ $pemeriksaan->created_at
                        ? $pemeriksaan->created_at->format('d-m-Y H:i')
                        : '-' }}
                </div>
            </div>

        </div>
    </div>
</div>

{{-- HASIL PEMERIKSAAN --}}
<div class="detail-card">
    <div class="detail-card-header">
        <h5>
            <i class="fa-solid fa-clipboard-check me-2"></i>
            Hasil Pemeriksaan
        </h5>
    </div>

    <div class="detail-card-body">

        <div class="mb-4">
            <div class="detail-label">Keluhan Pasien</div>
            <div class="detail-box">
                {{ $pemeriksaan->keluhan ?: '-' }}
            </div>
        </div>

        {{-- RESEP OBAT --}}
        <div class="mt-4">
            <h6 class="fw-bold mb-3">Resep Obat</h6>

            @php
                $daftarObat = $pemeriksaan->resep
                    ? $pemeriksaan->resep->obat
                    : collect();
            @endphp

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-resep">
                    <thead>
                        <tr>
                            <th style="width: 55px;">No.</th>
                            <th>Nama Obat</th>
                            <th>Jumlah</th>
                            <th>Dosis</th>
                            <th>Frekuensi</th>
                            <th>Aturan Pakai</th>
                            <th>Lama Pemakaian</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($daftarObat as $index => $obat)
                            @php
                                $teksAturan = $obat->pivot->aturan_pakai ?? '';

                                $dosis = '-';
                                $frekuensi = '-';
                                $aturanPakai = '-';
                                $lama = '-';

                                $bagianAturan = explode('|', $teksAturan);

                                foreach ($bagianAturan as $bagian) {
                                    $bagian = trim($bagian);

                                    if (stripos($bagian, 'Dosis:') === 0) {
                                        $dosis = trim(substr($bagian, strlen('Dosis:')));
                                    } elseif (stripos($bagian, 'Frekuensi:') === 0) {
                                        $frekuensi = trim(substr($bagian, strlen('Frekuensi:')));
                                    } elseif (stripos($bagian, 'Aturan:') === 0) {
                                        $aturanPakai = trim(substr($bagian, strlen('Aturan:')));
                                    } elseif (stripos($bagian, 'Lama:') === 0) {
                                        $lama = trim(substr($bagian, strlen('Lama:')));
                                    } elseif ($bagian !== '') {
                                        $aturanPakai = $bagian;
                                    }
                                }

                                if ($frekuensi !== '-' && is_numeric($frekuensi)) {
                                    $frekuensi .= ' kali sehari';
                                }

                                if ($lama !== '-' && is_numeric($lama)) {
                                    $lama .= ' hari';
                                }
                            @endphp

                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td class="nama-obat">
                                    {{ $obat->nama ?? '-' }}
                                </td>

                                <td>{{ $obat->pivot->nilai ?? '-' }}</td>

                                <td>{{ $dosis }}</td>

                                <td>{{ $frekuensi }}</td>

                                <td>{{ $aturanPakai }}</td>

                                <td>{{ $lama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fa-solid fa-pills fa-2x mb-2 d-block"></i>
                                    Belum ada resep obat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
