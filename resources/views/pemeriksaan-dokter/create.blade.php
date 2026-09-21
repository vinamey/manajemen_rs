@extends('layouts.superadmin')

@section('content')

<style>
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 4px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 22px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
    }

    .form-card-header {
        background: #f0f7ff;
        border-bottom: 1px solid #dbeafe;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-card-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #dbeafe;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .form-card-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: #173b7a;
    }

    .form-card-body {
        padding: 25px 22px;
    }

    .form-label {
        font-weight: 600;
        color: #212529;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .required {
        color: #dc3545;
    }

    .form-control,
    .form-select {
        border: 1px solid #d8dee8;
        border-radius: 7px;
        min-height: 44px;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .input-icon {
        position: relative;
    }

    .input-icon i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #0d6efd;
        z-index: 5;
        pointer-events: none;
    }

    .input-icon .form-control,
    .input-icon .form-select {
        padding-left: 42px;
    }

    .textarea-icon {
        position: relative;
    }

    .textarea-icon i {
        position: absolute;
        left: 14px;
        top: 16px;
        color: #0d6efd;
        z-index: 5;
        pointer-events: none;
    }

    .textarea-icon textarea {
        padding-left: 42px;
    }

    .form-help {
        font-size: 12px;
        color: #6c757d;
        margin-top: 5px;
    }

    .form-footer {
        background: #f8fbff;
        border-top: 1px solid #e5edf8;
        padding: 16px 22px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .btn-kembali {
        background: #6c757d;
        border-color: #6c757d;
        color: white;
        border-radius: 7px;
        padding: 9px 18px;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-kembali:hover {
        background: #5c636a;
        border-color: #565e64;
        color: white;
    }

    .btn-simpan {
        background: #0d6efd;
        border-color: #0d6efd;
        color: white;
        border-radius: 7px;
        padding: 9px 18px;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-simpan:hover {
        background: #0b5ed7;
        border-color: #0a58ca;
        color: white;
    }

    .alert {
        border-radius: 8px;
    }
</style>

<div class="container-fluid">

    {{-- ========================= --}}
    {{-- JUDUL HALAMAN --}}
    {{-- ========================= --}}
    <div class="mb-3">
        <h1 class="page-title">Tambah Pemeriksaan Dokter</h1>
        <div class="page-subtitle">
            Masukkan hasil pemeriksaan pasien
        </div>
    </div>


    {{-- ========================= --}}
    {{-- VALIDATION ERROR --}}
    {{-- ========================= --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <div class="fw-semibold mb-1">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                Terjadi kesalahan:
            </div>

            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- ========================= --}}
    {{-- FORM CARD --}}
    {{-- ========================= --}}
    <div class="form-card">

        {{-- HEADER CARD --}}
        <div class="form-card-header">

            <div class="form-card-icon">
                <i class="fa-solid fa-stethoscope"></i>
            </div>

            <div>
                <h5 class="form-card-title">
                    Form Pemeriksaan Dokter
                </h5>
            </div>

        </div>


        {{-- BODY FORM --}}
        <div class="form-card-body">

            <form action="{{ route('pemeriksaan-dokter.store') }}" method="POST">

                @csrf

                <div class="row g-4">

                    {{-- ========================= --}}
                    {{-- PASIEN / NO ANTRIAN --}}
                    {{-- ========================= --}}
                    <div class="col-md-6">

                        <label for="pendaftaran_id" class="form-label">
                            Pasien / No. Antrian
                            <span class="required">*</span>
                        </label>

                        <div class="input-icon">

                            <i class="fa-solid fa-user"></i>

                            <select
                                name="pendaftaran_id"
                                id="pendaftaran_id"
                                class="form-select @error('pendaftaran_id') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    -- Pilih Pasien --
                                </option>

                                @foreach ($pendaftarans as $pendaftaran)

                                    <option
                                        value="{{ $pendaftaran->id }}"
                                        {{ old('pendaftaran_id') == $pendaftaran->id ? 'selected' : '' }}
                                    >
                                        {{ $pendaftaran->nomor_antrian }}
                                        -
                                        {{ $pendaftaran->pasien->nama ?? 'Nama pasien tidak tersedia' }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('pendaftaran_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ========================= --}}
                    {{-- DOKTER --}}
                    {{-- ========================= --}}
                    <div class="col-md-6">

                        <label for="dokter_id" class="form-label">
                            Dokter
                            <span class="required">*</span>
                        </label>

                        <div class="input-icon">

                            <i class="fa-solid fa-user-doctor"></i>

                            <select
                                name="dokter_id"
                                id="dokter_id"
                                class="form-select @error('dokter_id') is-invalid @enderror"
                                required
                            >

                                <option value="">
                                    -- Pilih Dokter --
                                </option>

                                @foreach ($dokters as $dokter)

                                    <option
                                        value="{{ $dokter->id }}"
                                        {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}
                                    >
                                        {{ $dokter->nama }}
                                        @if ($dokter->spesialis)
                                            - {{ $dokter->spesialis }}
                                        @endif
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('dokter_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ========================= --}}
                    {{-- KELUHAN --}}
                    {{-- ========================= --}}
                    <div class="col-12">

                        <label for="keluhan" class="form-label">
                            Keluhan Pasien
                            <span class="required">*</span>
                        </label>

                        <div class="textarea-icon">

                            <i class="fa-solid fa-file-medical"></i>

                            <textarea
                                name="keluhan"
                                id="keluhan"
                                class="form-control @error('keluhan') is-invalid @enderror"
                                placeholder="Masukkan keluhan pasien..."
                                required
                            >{{ old('keluhan') }}</textarea>

                        </div>

                        @error('keluhan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ========================= --}}
                    {{-- RESEP OBAT --}}
                    {{-- ========================= --}}
                    <div class="col-12">

                        <label for="resep_obat" class="form-label">
                            Resep Obat
                            <span class="required">*</span>
                        </label>

                        <div class="input-icon">

                            <i class="fa-solid fa-pills"></i>

                            <input
                                type="number"
                                name="resep_obat"
                                id="resep_obat"
                                class="form-control @error('resep_obat') is-invalid @enderror"
                                value="{{ old('resep_obat') }}"
                                placeholder="Masukkan ID resep obat"
                                min="1"
                                required
                            >

                        </div>

                        <div class="form-help">
                            Isi sesuai ID resep obat.
                        </div>

                        @error('resep_obat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

        </div>


        {{-- ========================= --}}
        {{-- FOOTER / BUTTON --}}
        {{-- ========================= --}}
        <div class="form-footer">

            <a
                href="{{ route('pemeriksaan-dokter.index') }}"
                class="btn btn-kembali"
            >
                <i class="fa-solid fa-arrow-left me-1"></i>
                Kembali
            </a>

            <button
                type="submit"
                class="btn btn-simpan"
            >
                <i class="fa-solid fa-floppy-disk me-1"></i>
                Simpan Pemeriksaan
            </button>

        </div>

            </form>

    </div>

</div>

@endsection