@extends('layouts.superadmin')

@section('content')

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-info text-white">
            <h4>Permission Role : {{ $role->name }}</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('roles.permission.store', $role->id) }}" method="POST">

                @csrf

                <div class="row">

                    @foreach($permissions as $permission)

                        <div class="col-md-4 mb-2">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    name="permission[]"
                                    value="{{ $permission->name }}"
                                    id="permission{{ $permission->id }}"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                >

                                <label class="form-check-label"
                                       for="permission{{ $permission->id }}">

                                    {{ $permission->name }}

                                </label>

                            </div>

                        </div>

                    @endforeach

                </div>

                <hr>

                <button class="btn btn-success">
                    Simpan Permission
                </button>

                <a href="{{ route('roles.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection