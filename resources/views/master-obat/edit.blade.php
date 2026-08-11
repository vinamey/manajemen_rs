@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4 class="mb-0">Edit Obat</h4>

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

        <form action="{{ route('master-obat.update', $obat->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Kode Obat</label>

                <input type="text"
                       name="kode_obat"
                       class="form-control"
                       value="{{ old('kode_obat', $obat->kode_obat) }}"
                       required>

            </div>

            <div class="mb-3">

                <label>Nama Obat</label>

                <input type="text"
                       name="nama_obat"
                       class="form-control"
                       value="{{ old('nama_obat', $obat->nama_obat) }}"
                       required>

            </div>

            <div class="mb-3">

                <label>Kategori</label>

                <input type="text"
                       name="kategori"
                       class="form-control"
                       value="{{ old('kategori', $obat->kategori) }}"
                       required>

            </div>

            <div class="mb-3">

                <label>Satuan</label>

                <input type="text"
                       name="satuan"
                       class="form-control"
                       value="{{ old('satuan', $obat->satuan) }}"
                       required>

            </div>

            <div class="mb-3">

                <label>Harga</label>

                <input type="number"
                       name="harga"
                       class="form-control"
                       value="{{ old('harga', $obat->harga) }}"
                       min="0"
                       required>

            </div>

            <div class="mb-3">

                <label>Stok</label>

                <input type="number"
                       name="stok"
                       class="form-control"
                       value="{{ old('stok', $obat->stok) }}"
                       min="0"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('master-obat.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection