@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4>Edit Perawat</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('master-perawat.update', $perawat->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Perawat</label>

                <input type="text"
                       name="Nama"
                       class="form-control"
                       value="{{ old('Nama', $perawat->Nama) }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="Jenis_Kelamin"
                        class="form-control"
                        required>

                    <option value="laki-laki"
                        {{ $perawat->Jenis_Kelamin == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="perempuan"
                        {{ $perawat->Jenis_Kelamin == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>

                <input type="date"
                       name="Tanggal_Lahir"
                       class="form-control"
                       value="{{ $perawat->Tanggal_Lahir }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>

                <textarea name="Alamat"
                          class="form-control"
                          rows="3"
                          required>{{ $perawat->Alamat }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-perawat.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection