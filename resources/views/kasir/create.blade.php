<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Data Kasir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Data Kasir</h4>
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

            <form action="{{ route('kasir.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Nama Kasir
                    </label>

                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama kasir"
                           required>
                </div>


                <div class="mb-3">
                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin"
                            class="form-select"
                            required>

                        <option value="">
                            -- Pilih Jenis Kelamin --
                        </option>

                        <option value="laki-laki"
                            {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="perempuan"
                            {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
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
                           value="{{ old('no_hp') }}"
                           placeholder="Masukkan nomor HP"
                           required>
                </div>


                <button type="submit"
                        class="btn btn-success">
                    Simpan
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
