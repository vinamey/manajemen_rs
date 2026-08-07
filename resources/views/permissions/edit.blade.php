@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning text-dark">
        <h4>Edit Permission</h4>
    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">Nama Permission</label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $permission->name) }}"
                    required>

            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>

</div>

@endsection