@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4 class="mb-0">Edit Dokter</h4>
    </div>

    <div class="card-body">

        {{-- Pesan error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('master-dokter.update', $dokter->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            {{-- Nama Dokter --}}
            <div class="mb-3">
                <label for="nama" class="form-label">
                    Nama Dokter
                </label>

                <input type="text"
                       id="nama"
                       name="nama"
                       class="form-control"
                       value="{{ old('nama', $dokter->nama) }}"
                       required>
            </div>


            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">
                    Jenis Kelamin
                </label>

                <select id="jenis_kelamin"
                        name="jenis_kelamin"
                        class="form-control"
                        required>

                    <option value="laki-laki"
                        {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="perempuan"
                        {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>


            {{-- Tanggal Lahir --}}
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">
                    Tanggal Lahir
                </label>

                <input type="date"
                       id="tanggal_lahir"
                       name="tanggal_lahir"
                       class="form-control"
                       value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}"
                       required>
            </div>


            {{-- Spesialis --}}
            {{-- Tetap tampil tetapi tidak dapat diubah --}}
            <div class="mb-3">
                <label for="spesialis" class="form-label">
                    Spesialis
                </label>

                <input type="text"
                       id="spesialis"
                       class="form-control"
                       value="{{ old('spesialis', $dokter->spesialis) }}"
                       readonly>

                <small class="text-muted">
                    Spesialis tidak dapat diubah saat edit.
                </small>
            </div>


            {{-- Alamat --}}
            <div class="mb-3">
                <label for="alamat" class="form-label">
                    Alamat
                </label>

                <textarea id="alamat"
                          name="alamat"
                          class="form-control"
                          rows="3"
                          placeholder="Masukkan alamat dokter">{{ old('alamat', $dokter->alamat) }}</textarea>
            </div>


            {{-- Tombol --}}
            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('master-dokter.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
