@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4 class="mb-0">Edit Pasien</h4>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Data belum berhasil diperbarui!</strong>

                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('master-pasien.update', $pasien->id) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">

                <label class="form-label">
                    Nama Pasien
                </label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama', $pasien->nama) }}"
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

                    <option value="laki-laki"
                        {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="perempuan"
                        {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
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
                    value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}"
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
                    required>{{ old('alamat', $pasien->alamat) }}</textarea>

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

                    <option value="01"
                        {{ old('status_asuransi', $pasien->status_asuransi) == '01' ? 'selected' : '' }}>
                        Memiliki Asuransi
                    </option>

                    <option value="0"
                        {{ old('status_asuransi', $pasien->status_asuransi) == '0' ? 'selected' : '' }}>
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

                    <option value="A"
                        {{ old('golongan_darah', $pasien->golongan_darah) == 'A' ? 'selected' : '' }}>
                        A
                    </option>

                    <option value="B"
                        {{ old('golongan_darah', $pasien->golongan_darah) == 'B' ? 'selected' : '' }}>
                        B
                    </option>

                    <option value="AB"
                        {{ old('golongan_darah', $pasien->golongan_darah) == 'AB' ? 'selected' : '' }}>
                        AB
                    </option>

                    <option value="O"
                        {{ old('golongan_darah', $pasien->golongan_darah) == 'O' ? 'selected' : '' }}>
                        O
                    </option>

                </select>

            </div>


            <button
                type="submit"
                class="btn btn-primary">

                Update

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