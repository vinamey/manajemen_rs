<!DOCTYPE html>
<html>
<head>
    <title>Edit Role</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning text-dark">
            <h3>Edit Role</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('roles.update',$role->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Role</label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name',$role->name) }}">

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <button class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('roles.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>