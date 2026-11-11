@extends('layouts.superadmin')

@section('navbar-title', 'Detail Frekuensi')

@section('content')
<style>
    .frekuensi-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 22px 18px;
    }

    .frekuensi-card {
        background: white;
        border-radius: 10px;
        padding: 22px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        max-width: 650px;
    }

    .frekuensi-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .frekuensi-subtitle {
        font-size: 11px;
        color: #6b7280;
        margin-bottom: 22px;
    }

    .detail-group {
        margin-bottom: 16px;
    }

    .detail-label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
    }

    .detail-value {
        width: 100%;
        min-height: 38px;
        border: 1px solid #e1e7ef;
        border-radius: 6px;
        background: #f8fafc;
        padding: 10px;
        font-size: 11px;
        color: #374151;
    }

    .btn-kembali-frekuensi {
        background: #eef2f7;
        color: #64748b;
        border-radius: 6px;
        padding: 9px 15px;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-edit-frekuensi {
        background: #1877f2;
        color: white;
        border-radius: 6px;
        padding: 9px 15px;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-edit-frekuensi:hover {
        background: #0f58c6;
        color: white;
    }
</style>

<div class="frekuensi-page">

    <div class="frekuensi-card">

        <h2 class="frekuensi-title">
            <i class="fas fa-eye" style="color:#1877f2;"></i>
            Detail Frekuensi
        </h2>

        <p class="frekuensi-subtitle">
            Informasi lengkap data frekuensi.
        </p>

        <div class="detail-group">
            <label class="detail-label">Kode Frekuensi</label>
            <div class="detail-value">
                {{ $frekuensi->kode ?? '-' }}
            </div>
        </div>

        <div class="detail-group">
            <label class="detail-label">Nama Frekuensi</label>
            <div class="detail-value">
                {{ $frekuensi->nama ?? '-' }}
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('master-frekuensi.index') }}"
               class="btn-kembali-frekuensi">
                Kembali
            </a>

            <a href="{{ route('master-frekuensi.edit', $frekuensi->id) }}"
               class="btn-edit-frekuensi">
                <i class="fas fa-edit"></i>
                Edit Data
            </a>
        </div>

    </div>
</div>
@endsection