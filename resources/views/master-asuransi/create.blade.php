@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Asuransi</h4>
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

        <form action="{{ route('master-asuransi.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Kode Asuransi
                </label>

                <input type="text"
                       name="kode"
                       class="form-control"
                       placeholder="Contoh: BPJS"
                       value="{{ old('kode') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nama Asuransi
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="Contoh: BPJS Kesehatan"
                       value="{{ old('nama') }}"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-asuransi.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection