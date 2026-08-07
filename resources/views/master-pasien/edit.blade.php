@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4>Edit Pasien</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-pasien.update',$pasien->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>No RM</label>
                <input type="text"
                       name="no_rm"
                       value="{{ $pasien->no_rm }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Nama</label>
                <input type="text"
                       name="nama"
                       value="{{ $pasien->nama }}"
                       class="form-control">
            </div>

            <div class="mb-3">

                <label>Jenis Kelamin</label>

                <select name="jenis_kelamin" class="form-control">

                    <option value="L" {{ $pasien->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>

                    <option value="P" {{ $pasien->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>

                </select>

            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text"
                       name="no_hp"
                       value="{{ $pasien->no_hp }}"
                       class="form-control">
            </div>

            <button class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-pasien.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection