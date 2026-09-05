@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            + Tambah Pendaftaran Pasien
        </h4>

    </div>


    <div class="card-body">

        {{-- Menampilkan Error Validasi --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Terjadi kesalahan!</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('pendaftaran.store') }}"
              method="POST">

            @csrf


            {{-- ============================= --}}
            {{-- PILIH PASIEN --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Pasien

                </label>

                <select name="pasien_id"
                        class="form-select"
                        required>

                    <option value="">
                        -- Pilih Pasien --
                    </option>

                    @foreach($pasiens as $pasien)

                        <option value="{{ $pasien->id }}"
                            {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>

                            {{ $pasien->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ============================= --}}
            {{-- PILIH DOKTER --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Dokter

                </label>

                <select name="dokter_id"
                        class="form-select"
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

            </div>


            {{-- ============================= --}}
            {{-- PILIH POLI --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Poli

                </label>

                <select name="poli_id"
                        class="form-select"
                        required>

                    <option value="">
                        -- Pilih Poli --
                    </option>

                    @foreach($polis as $poli)

                        <option value="{{ $poli->id }}"
                            {{ old('poli_id') == $poli->id ? 'selected' : '' }}>

                            {{ $poli->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ============================= --}}
            {{-- PILIH KAMAR --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Kamar
                    <small class="text-muted">
                        (Opsional)
                    </small>

                </label>

                <select name="kamar_id"
                        class="form-select">

                    <option value="">
                        -- Pilih Kamar --
                    </option>

                    @foreach($kamars as $kamar)

                        <option value="{{ $kamar->id }}"
                            {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>

                             {{ $kamar->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ============================= --}}
            {{-- TANGGAL PENDAFTARAN --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Tanggal Pendaftaran

                </label>

                <input type="date"
                       name="tanggal_pendaftaran"
                       class="form-control"
                       value="{{ old('tanggal_pendaftaran', date('Y-m-d')) }}"
                       required>

            </div>


            {{-- ============================= --}}
            {{-- BUTTON --}}
            {{-- ============================= --}}

            <div class="d-flex gap-2">

                <button type="submit"
                        class="btn btn-success">

                    💾 Simpan Pendaftaran

                </button>


                <a href="{{ route('pendaftaran.index') }}"
                   class="btn btn-secondary">

                    ← Kembali

                </a>

            </div>

        </form> 

    </div>

</div>

@endsection