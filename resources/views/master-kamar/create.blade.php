@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4>Tambah Kamar</h4>
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

        <form action="{{ route('master-kamar.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Kode Kamar
                </label>

                <input type="text"
                       name="kode"
                       class="form-control"
                       placeholder="Contoh: KMR001"
                       value="{{ old('kode') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nama Kamar
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       placeholder="Contoh: Kamar Mawar"
                       value="{{ old('nama') }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Status
                </label>

                <select name="status"
                        class="form-control"
                        required>

                    <option value="">
                        -- Pilih Status --
                    </option>

                    <option value="tersedia">
                        Tersedia
                    </option>

                    <option value="terisi">
                        Terisi
                    </option>

                </select>

            </div>

            <button type="submit"
                    class="btn btn-success">
                Simpan
            </button>

            <a href="{{ route('master-kamar.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection