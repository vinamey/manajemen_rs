@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4>Edit Dokter</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-dokter.update',$dokter->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Nama Dokter</label>

                <input type="text"
                       name="nama_dokter"
                       class="form-control"
                       value="{{ $dokter->nama_dokter }}">

            </div>

            <div class="mb-3">

                <label>Spesialis</label>

                <input type="text"
                       name="spesialis"
                       class="form-control"
                       value="{{ $dokter->spesialis }}">

            </div>

            <div class="mb-3">

                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ $dokter->no_hp }}">

            </div>

            <div class="mb-3">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    class="form-control">{{ $dokter->alamat }}</textarea>

            </div>

            <button class="btn btn-primary">

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