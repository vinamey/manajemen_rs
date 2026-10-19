@extends('layouts.superadmin')

@section('content')
<style>
    .hasil-detail-page {
        padding: 20px 22px;
        min-height: calc(100vh - 60px);
        background: #f4f6fa;
    }

    .hasil-detail-header {
        background: linear-gradient(110deg, #1877f2, #0f58c6);
        color: #fff;
        padding: 22px 24px;
        border-radius: 17px;
        margin-bottom: 22px;
        box-shadow: 0 8px 20px rgba(24, 119, 242, .15);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .hasil-detail-header h3 {
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .hasil-detail-header p {
        margin: 0;
        color: rgba(255, 255, 255, .9);
        font-size: 14px;
    }

    .btn-detail-kembali {
        background: rgba(255, 255, 255, .17);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, .4);
        border-radius: 9px;
        padding: 9px 15px;
        font-weight: 600;
        white-space: nowrap;
        text-decoration: none;
    }

    .btn-detail-kembali:hover {
        background: #fff;
        color: #125fc4;
    }

    .hasil-detail-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 7px 22px rgba(31, 45, 61, .07);
    }

    .hasil-detail-card-header {
        padding: 17px 22px;
        background: #e7f1ff;
        border-bottom: 1px solid #d5e6ff;
        color: #164f9f;
        font-size: 17px;
        font-weight: 700;
    }

    .hasil-detail-card-header i {
        color: #1877f2;
        margin-right: 9px;
    }

    .hasil-detail-body {
        padding: 22px;
    }

    .hasil-detail-table {
        margin-bottom: 0;
        border-color: #e3eaf3;
    }

    .hasil-detail-table th {
        width: 28%;
        background: #f1f6ff;
        color: #25466f;
        font-weight: 600;
        padding: 13px 15px;
        vertical-align: middle;
    }

    .hasil-detail-table td {
        padding: 13px 15px;
        color: #35445b;
        vertical-align: middle;
        background: #fff;
        overflow-wrap: anywhere;
    }

    .hasil-detail-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        padding-top: 17px;
        border-top: 1px solid #edf0f5;
    }

    .btn-detail-edit {
        background: #1877f2;
        color: #fff;
        border: 1px solid #1877f2;
        border-radius: 9px;
        padding: 10px 17px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-detail-edit:hover {
        background: #0f58c6;
        border-color: #0f58c6;
        color: #fff;
    }

    @media (max-width: 768px) {
        .hasil-detail-page {
            padding: 15px 10px;
        }

        .hasil-detail-header {
            padding: 20px;
            align-items: flex-start;
            flex-direction: column;
        }

        .hasil-detail-header h3 {
            font-size: 21px;
        }

        .hasil-detail-body {
            padding: 14px;
        }

        .hasil-detail-table th {
            width: 38%;
            padding: 10px;
        }

        .hasil-detail-table td {
            padding: 10px;
        }

        .hasil-detail-actions {
            flex-direction: column;
        }

        .hasil-detail-actions a {
            text-align: center;
        }
    }
</style>

<div class="hasil-detail-page">

    {{-- HEADER --}}
    <div class="hasil-detail-header">
        <div>
            <h3>
                <i class="fas fa-file-medical me-2"></i>
                Detail Hasil Pemeriksaan
            </h3>
            <p>Informasi lengkap hasil pemeriksaan pasien.</p>
        </div>

        <a href="{{ route('hasil-pemeriksaan.index') }}"
           class="btn-detail-kembali">
            <i class="fas fa-arrow-left me-1"></i>
            Kembali
        </a>
    </div>

    {{-- DETAIL CARD --}}
    <div class="hasil-detail-card">

        <div class="hasil-detail-card-header">
            <i class="fas fa-notes-medical"></i>
            Informasi Hasil Pemeriksaan
        </div>

        <div class="hasil-detail-body">
            <div class="table-responsive">
                <table class="table table-bordered hasil-detail-table">
                    <tbody>
                        <tr>
                            <th>Tanggal Pemeriksaan</th>
                            <td>
                                {{ $hasilPemeriksaan->tanggal_pemeriksaan->format('d-m-Y') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Pasien</th>
                            <td>
                                {{ $hasilPemeriksaan->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Dokter</th>
                            <td>
                                {{ $hasilPemeriksaan->pemeriksaan?->dokter?->nama ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Keluhan</th>
                            <td>{{ $hasilPemeriksaan->keluhan }}</td>
                        </tr>

                        <tr>
                            <th>Diagnosis</th>
                            <td>{{ $hasilPemeriksaan->diagnosa }}</td>
                        </tr>

                        <tr>
                            <th>Tindakan Medis</th>
                            <td>
                                {{ $hasilPemeriksaan->tindakan?->nama ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Suhu Tubuh</th>
                            <td>{{ $hasilPemeriksaan->suhu_tubuh }} °C</td>
                        </tr>

                        <tr>
                            <th>Berat Badan</th>
                            <td>{{ $hasilPemeriksaan->berat_badan }} kg</td>
                        </tr>

                        <tr>
                            <th>Tinggi Badan</th>
                            <td>{{ $hasilPemeriksaan->tinggi_badan }} cm</td>
                        </tr>

                        <tr>
                            <th>Catatan Pemeriksaan</th>
                            <td>{{ $hasilPemeriksaan->catatan }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- TOMBOL EDIT --}}
            <div class="hasil-detail-actions">
                <a href="{{ route('hasil-pemeriksaan.edit', $hasilPemeriksaan->id) }}"
                   class="btn-detail-edit">
                    <i class="fas fa-pen-to-square me-1"></i>
                    Edit Hasil Pemeriksaan
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
