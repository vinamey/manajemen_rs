@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Perawat</h4>
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

        <form action="{{ route('master-perawat.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label>Nama Perawat</label>
                <input type="text"
                       name="Nama"
                       class="form-control"
                       value="{{ old('Nama') }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="Jenis_Kelamin"
                        class="form-control"
                        required>

                    <option value="">-- Pilih Jenis Kelamin --</option>

                    <option value="laki-laki"
                        {{ old('Jenis_Kelamin') == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="perempuan"
                        {{ old('Jenis_Kelamin') == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>
            </div>

            <div class="mb-3">
                <label>Tanggal Lahir</label>

                <input type="date"
                       name="Tanggal_Lahir"
                       class="form-control"
                       value="{{ old('Tanggal_Lahir') }}"
                       required>
            </div>

            <div class="mb-3">
                <label>Alamat</label>

                <textarea name="Alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('Alamat') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-perawat.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection