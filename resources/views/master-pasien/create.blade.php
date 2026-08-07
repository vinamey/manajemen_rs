@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4>Tambah Pasien</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-pasien.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label>No RM</label>
                <input type="text" name="no_rm" class="form-control">
            </div>

            <div class="mb-3">
                <label>Nama Pasien</label>
                <input type="text" name="nama" class="form-control">
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" class="form-control">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>

            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>

            <button class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-pasien.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection