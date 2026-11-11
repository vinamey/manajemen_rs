@extends('layouts.superadmin')

@section('navbar-title', 'Tambah Frekuensi')

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

    .form-group-frekuensi {
        margin-bottom: 16px;
    }

    .form-label-frekuensi {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 6px;
    }

    .form-control-frekuensi {
        width: 100%;
        height: 38px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 8px 10px;
        font-size: 11px;
        outline: none;
    }

    .form-control-frekuensi:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 2px rgba(24,119,242,.10);
    }

    .btn-simpan-frekuensi {
        background: #1877f2;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 9px 15px;
        font-size: 10px;
        font-weight: 600;
    }

    .btn-simpan-frekuensi:hover {
        background: #0f58c6;
        color: white;
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

    .error-frekuensi {
        color: #dc3545;
        font-size: 10px;
        margin-top: 4px;
    }
</style>

<div class="frekuensi-page">

    <div class="frekuensi-card">

        <h2 class="frekuensi-title">
            <i class="fas fa-clock" style="color:#1877f2;"></i>
            Tambah Frekuensi
        </h2>

        <p class="frekuensi-subtitle">
            Silakan masukkan data frekuensi baru.
        </p>

        <form action="{{ route('master-frekuensi.store') }}" method="POST">
            @csrf

            <div class="form-group-frekuensi">
                <label class="form-label-frekuensi">Kode Frekuensi</label>

                <input type="text"
                       name="kode"
                       class="form-control-frekuensi"
                       placeholder="Masukkan kode frekuensi"
                       value="{{ old('kode') }}">

                @error('kode')
                    <div class="error-frekuensi">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group-frekuensi">
                <label class="form-label-frekuensi">Nama Frekuensi</label>

                <input type="text"
                       name="nama"
                       class="form-control-frekuensi"
                       placeholder="Masukkan nama frekuensi"
                       value="{{ old('nama') }}"
                       required>

                @error('nama')
                    <div class="error-frekuensi">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('master-frekuensi.index') }}"
                   class="btn-kembali-frekuensi">
                    Kembali
                </a>

                <button type="submit" class="btn-simpan-frekuensi">
                    <i class="fas fa-save"></i>
                    Simpan Data
                </button>
            </div>

        </form>
    </div>
</div>
@endsection