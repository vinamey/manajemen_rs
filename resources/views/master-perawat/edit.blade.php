@extends('layouts.superadmin')

@section('page-title', 'Edit Perawat')

@section('content')

<style>
    .form-card {
        max-width: 900px;
        margin: 20px auto;
        background: white;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
    }

    .form-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        padding: 22px 25px;
    }

    .form-header h4 {
        margin: 0;
        font-weight: 700;
    }

    .form-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border: 1px solid #dbe3ee;
        border-radius: 10px;
        padding: 11px 13px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
    }

    .btn-update {
        background: #0d6efd;
        border: none;
        border-radius: 10px;
        padding: 11px 22px;
        color: white;
        font-weight: 600;
    }

    .btn-update:hover {
        background: #0b5ed7;
        color: white;
    }

    .btn-kembali {
        border-radius: 10px;
        padding: 10px 20px;
    }
</style>

<div class="form-card">

    {{-- HEADER --}}
    <div class="form-header">

        <h4>
            <i class="fa-solid fa-user-pen me-2"></i>
            Edit Data Perawat
        </h4>

    </div>

    {{-- BODY --}}
    <div class="form-body">

        @if($errors->any())

            <div class="alert alert-danger border-0 rounded-3">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('master-perawat.update', $perawat->id) }}"
              method="POST">

            @csrf

            @method('PUT')

            <div class="row g-4">

                {{-- NAMA --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Nama Perawat
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama', $perawat->Nama) }}"
                           placeholder="Masukkan nama perawat"
                           required>

                </div>

                {{-- JENIS KELAMIN --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="laki-laki"
                            {{ old('jenis_kelamin', $perawat->Jenis_Kelamin) == 'laki-laki' ? 'selected' : '' }}>

                            Laki-laki

                        </option>

                        <option value="perempuan"
                            {{ old('jenis_kelamin', $perawat->Jenis_Kelamin) == 'perempuan' ? 'selected' : '' }}>

                            Perempuan

                        </option>

                    </select>

                </div>

                {{-- TANGGAL LAHIR --}}
                <div class="col-md-6">

                    <label class="form-label">
                        Tanggal Lahir
                    </label>

                    <input type="date"
                           name="tanggal_lahir"
                           class="form-control"
                           value="{{ old('tanggal_lahir', $perawat->Tanggal_Lahir ? \Carbon\Carbon::parse($perawat->Tanggal_Lahir)->format('Y-m-d') : '') }}"
                           required>

                </div>

                {{-- ALAMAT --}}
                <div class="col-12">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea name="alamat"
                              class="form-control"
                              rows="4"
                              placeholder="Masukkan alamat perawat"
                              required>{{ old('alamat', $perawat->Alamat) }}</textarea>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('master-perawat.index') }}"
                   class="btn btn-light btn-kembali">

                    Kembali

                </a>

                <button type="submit"
                        class="btn-update">

                    <i class="fa-solid fa-floppy-disk me-1"></i>
                    Update Perawat

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
