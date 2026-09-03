@extends('layouts.superadmin')

@section('page-title', 'Tambah Perawat')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        {{-- HEADER --}}
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-person-plus-fill me-2"></i>
                Tambah Perawat
            </h4>
        </div>

        {{-- BODY --}}
        <div class="card-body">

            {{-- ERROR VALIDATION --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM --}}
            <form
                action="{{ route('master-perawat.store') }}"
                method="POST"
            >

                @csrf

                {{-- NAMA --}}
                <div class="mb-3">
                    <label
                        for="nama"
                        class="form-label fw-semibold"
                    >
                        Nama Perawat
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama perawat"
                        required
                    >
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="mb-3">
                    <label
                        for="jenis_kelamin"
                        class="form-label fw-semibold"
                    >
                        Jenis Kelamin
                    </label>

                    <select
                        id="jenis_kelamin"
                        name="jenis_kelamin"
                        class="form-select"
                        required
                    >
                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option
                            value="laki-laki"
                            {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}
                        >
                            Laki-laki
                        </option>

                        <option
                            value="perempuan"
                            {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}
                        >
                            Perempuan
                        </option>
                    </select>
                </div>

                {{-- TANGGAL LAHIR --}}
                <div class="mb-3">
                    <label
                        for="tanggal_lahir"
                        class="form-label fw-semibold"
                    >
                        Tanggal Lahir
                    </label>

                    <input
                        type="date"
                        id="tanggal_lahir"
                        name="tanggal_lahir"
                        class="form-control"
                        value="{{ old('tanggal_lahir') }}"
                        required
                    >
                </div>

                {{-- ALAMAT --}}
                <div class="mb-3">
                    <label
                        for="alamat"
                        class="form-label fw-semibold"
                    >
                        Alamat
                    </label>

                    <textarea
                        id="alamat"
                        name="alamat"
                        class="form-control"
                        rows="4"
                        placeholder="Masukkan alamat perawat"
                        required
                    >{{ old('alamat') }}</textarea>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan
                    </button>

                    <a
                        href="{{ route('master-perawat.index') }}"
                        class="btn btn-secondary"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
