@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4>Edit Perawat</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-perawat.update',$perawat->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Nama Perawat</label>

                <input type="text"
                       name="nama_perawat"
                       class="form-control"
                       value="{{ $perawat->nama_perawat }}">

            </div>

            <div class="mb-3">

                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       class="form-control"
                       value="{{ $perawat->no_hp }}">

            </div>

            <div class="mb-3">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    class="form-control">{{ $perawat->alamat }}</textarea>

            </div>

            <button class="btn btn-primary">

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