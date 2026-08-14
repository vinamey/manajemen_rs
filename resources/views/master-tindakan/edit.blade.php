@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">
        <h4>Edit Tindakan</h4>
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

        <form action="{{ route('master-tindakan.update', $tindakan->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">
                    Kode Tindakan
                </label>

                <input type="text"
                       name="kode"
                       class="form-control"
                       value="{{ old('kode', $tindakan->kode) }}"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Nama Tindakan
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       value="{{ old('nama', $tindakan->nama) }}"
                       required>

            </div>

            <button type="submit"
                    class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('master-tindakan.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection