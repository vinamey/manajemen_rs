@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Dokter</h4>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('master-dokter.store') }}" method="POST">

            @csrf


            <div class="mb-3">
                <label>Nama Dokter</label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       value="{{ old('nama') }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin"
                        class="form-control"
                        required>

                    <option value="">-- Pilih --</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>

                </select>
            </div>

            <div class="mb-3">
                <label>Spesialis</label>
                <input type="text"
                       name="spesialis"
                       class="form-control"
                       value="{{ old('spesialis') }}">
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ old('no_hp') }}">
            </div>

            <div class="mb-3">
                <label>Alamat</label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3">{{ old('alamat') }}</textarea>
            </div>

            <button type="submit"
                    class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-dokter.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection