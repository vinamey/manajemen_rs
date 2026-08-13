@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4 class="mb-0">Edit Kategori</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('master-kategori.update', $kategori->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Nama Kategori
                </label>

                <input type="text"
                       name="nama_kategori"
                       class="form-control"
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-kategori.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection