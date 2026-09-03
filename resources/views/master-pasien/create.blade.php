@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Tambah Pasien</h4>
    </div>

    <div class="card-body">

        {{-- Pesan error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Data belum tersimpan!</strong>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Tambah Pasien --}}
        <form action="{{ route('master-pasien.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">
                    Nama Pasien
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama pasien"
                    required>
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label class="form-label">
                    Jenis Kelamin
                </label>

                <select
                    name="jenis_kelamin"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Jenis Kelamin --
                    </option>

                    <option
                        value="laki-laki"
                        {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option
                        value="perempuan"
                        {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="mb-3">
                <label class="form-label">
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    name="tanggal_lahir"
                    class="form-control"
                    value="{{ old('tanggal_lahir') }}"
                    required>
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label class="form-label">
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    class="form-control"
                    rows="3"
                    placeholder="Masukkan alamat pasien"
                    required>{{ old('alamat') }}</textarea>
            </div>

            {{-- Status Asuransi --}}
            <div class="mb-3">
                <label class="form-label">
                    Status Asuransi
                </label>

                <select
                    name="status_asuransi"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Status Asuransi --
                    </option>

                    <option
                        value="01"
                        {{ old('status_asuransi') == '01' ? 'selected' : '' }}>
                        Memiliki Asuransi
                    </option>

                    <option
                        value="0"
                        {{ old('status_asuransi') == '0' ? 'selected' : '' }}>
                        Tidak Memiliki Asuransi
                    </option>

                </select>
            </div>

            {{-- Golongan Darah --}}
            <div class="mb-3">
                <label class="form-label">
                    Golongan Darah
                </label>

                <select
                    name="golongan_darah"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Golongan Darah --
                    </option>

                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>

                </select>
            </div>

            {{-- Tombol --}}
            <button
                type="submit"
                class="btn btn-success">
                Simpan
            </button>

            <a
                href="{{ route('master-pasien.index') }}"
                class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection
