@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4>Edit Dokter</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('master-dokter.update', $dokter->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Kode Dokter</label>

                <input type="text"
                       name="kode_dokter"
                       class="form-control"
                       value="{{ old('kode_dokter', $dokter->kode_dokter) }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Nama Dokter</label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       value="{{ old('nama', $dokter->nama) }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin"
                        class="form-control"
                        required>

                    <option value="laki-laki"
                        {{ $dokter->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="perempuan"
                        {{ $dokter->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label>Spesialis</label>

                <input type="text"
                       name="spesialis"
                       class="form-control"
                       value="{{ old('spesialis', $dokter->spesialis) }}">
            </div>

            <div class="mb-3">
                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp', $dokter->no_hp) }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3">{{ old('alamat', $dokter->alamat) }}</textarea>
            </div>

            <button type="submit"
                    class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-dokter.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection