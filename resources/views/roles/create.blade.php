<!DOCTYPE html>
<html>
<head>
    <title>Tambah Role</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Tambah Role</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('roles.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Nama Role</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>
                </div>

                <button class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>