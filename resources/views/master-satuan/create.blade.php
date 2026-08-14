@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Tambah Satuan Obat</h4>
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

        <form action="{{ route('master-satuan.store') }}" method="POST">

            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Satuan</label>

                <input type="text"
                       name="nama_satuan"
                       class="form-control"
                       placeholder="Contoh: Tablet"
                       value="{{ old('nama_satuan') }}"
                       required>
            </div>

            <button type="submit" class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-satuan.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection