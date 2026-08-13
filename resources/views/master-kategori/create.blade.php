@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">Tambah Kategori</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-kategori.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input type="text"
                       name="nama_kategori"
                       class="form-control"
                       placeholder="Contoh: Antibiotik"
                       value="{{ old('nama_kategori') }}"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection