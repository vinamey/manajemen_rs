@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4>Tambah Perawat</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-perawat.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label>Nama Perawat</label>

                <input type="text"
                       name="nama_perawat"
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

            <a href="{{ route('master-perawat.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

@endsection