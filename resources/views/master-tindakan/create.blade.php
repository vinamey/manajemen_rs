@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Tindakan</h4>
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

        <form action="{{ route('master-tindakan.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Kode Tindakan
                </label>

                <input type="text"
                       name="kode"
                       class="form-control"
                       placeholder="Contoh: TDK001"
                       value="{{ old('kode') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nama Tindakan
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="Contoh: Pemeriksaan Umum"
                       value="{{ old('nama') }}"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-tindakan.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection