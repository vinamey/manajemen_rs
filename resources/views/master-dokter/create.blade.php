@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4>Tambah Dokter</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-dokter.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Nama Dokter</label>

                <input type="text"
                       name="nama_dokter"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>Spesialis</label>

                <input type="text"
                       name="spesialis"
                       class="form-control"
                       required>

            </div>

            <div class="mb-3">

                <label>No HP</label>

                <input type="text"
                       name="no_hp"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Alamat</label>

                <textarea name="alamat"
                          class="form-control"></textarea>

            </div>

            <button class="btn btn-success">

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