@extends('layouts.superadmin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            <i class="bi bi-clipboard2-pulse me-2"></i>
            Tambah Pemeriksaan Dokter
        </h3>

        <p class="text-muted mb-0">
            Masukkan hasil pemeriksaan pasien
        </p>

    </div>


    {{-- FORM --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <form action="{{ route('pemeriksaan-dokter.store') }}"
                  method="POST">

                @csrf


                {{-- PENDAFTARAN --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Pasien / No. Antrian
                        <span class="text-danger">*</span>
                    </label>

                    <select name="pendaftaran_id"
                            class="form-select @error('pendaftaran_id') is-invalid @enderror"
                            required>

                        <option value="">
                            -- Pilih Pasien --
                        </option>

                        @foreach($pendaftarans as $pendaftaran)

                            <option value="{{ $pendaftaran->id }}"
                                {{ old('pendaftaran_id') == $pendaftaran->id ? 'selected' : '' }}>

                                {{ $pendaftaran->nomor_antrian ?? '-' }}
                                -
                                {{ $pendaftaran->pasien->nama ?? '-' }}
                                |
                                {{ $pendaftaran->poli->nama ?? '-' }}

                            </option>

                        @endforeach

                    </select>

                    @error('pendaftaran_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- DOKTER --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Dokter
                        <span class="text-danger">*</span>
                    </label>

                    <select name="dokter_id"
                            class="form-select @error('dokter_id') is-invalid @enderror"
                            required>

                        <option value="">
                            -- Pilih Dokter --
                        </option>

                        @foreach($dokters as $dokter)

                            <option value="{{ $dokter->id }}"
                                {{ old('dokter_id') == $dokter->id ? 'selected' : '' }}>

                                {{ $dokter->nama }}

                            </option>

                        @endforeach

                    </select>

                    @error('dokter_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- KELUHAN --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Keluhan
                        <span class="text-danger">*</span>
                    </label>

                    <textarea name="keluhan"
                              rows="5"
                              class="form-control @error('keluhan') is-invalid @enderror"
                              placeholder="Masukkan keluhan pasien..."
                              required>{{ old('keluhan') }}</textarea>

                    @error('keluhan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- RESEP OBAT --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Resep Obat
                        <span class="text-danger">*</span>
                    </label>

                    <input type="number"
                           name="resep_obat"
                           value="{{ old('resep_obat') }}"
                           class="form-control @error('resep_obat') is-invalid @enderror"
                           placeholder="Masukkan ID resep obat"
                           required>

                    @error('resep_obat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <small class="text-muted">
                        Isi sesuai ID resep obat.
                    </small>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('pemeriksaan-dokter.index') }}"
                       class="btn btn-secondary">

                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>
                        Simpan Pemeriksaan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection