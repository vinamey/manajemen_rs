<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Kasir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-warning">
            <h4 class="mb-0">Edit Data Kasir</h4>
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

            <form action="{{ route('kasir.update', $kasir->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">
                        Nama Kasir
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama', $kasir->nama) }}"
                           required>
                </div>


                <div class="mb-3">
                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin" class="form-select" required>

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="laki-laki"
                            {{ old('jenis_kelamin', $kasir->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="perempuan"
                            {{ old('jenis_kelamin', $kasir->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">
                        No HP
                    </label>

                    <input type="text"
                           name="no_hp"
                           class="form-control"
                           value="{{ old('no_hp', $kasir->no_hp) }}"
                           required>
                </div>


                <button type="submit" class="btn btn-warning">
                    Simpan Perubahan
                </button>

                <a href="{{ route('kasir.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>
