<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Apoteker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header bg-warning">
            <h4>Edit Data Apoteker</h4>
        </div>

        <div class="card-body">

            {{-- Menampilkan error --}}
            @if ($errors->any())
                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>
            @endif


            <form action="{{ route('master-apoteker.update', $apoteker->id) }}"
                  method="POST">

                @csrf

                @method('PUT')


                {{-- Nama Apoteker --}}
                <div class="mb-3">

                    <label class="form-label">
                        Nama Apoteker
                    </label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama', $apoteker->nama) }}"
                        placeholder="Masukkan nama apoteker"
                        required
                    >

                </div>


                {{-- No HP --}}
                <div class="mb-3">

                    <label class="form-label">
                        No. HP
                    </label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp', $apoteker->no_hp) }}"
                        placeholder="Masukkan nomor HP"
                        required
                    >

                </div>


                {{-- Tombol --}}
                <button type="submit" class="btn btn-success">
                    Simpan Perubahan
                </button>

                <a href="{{ route('master-apoteker.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>
