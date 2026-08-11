<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Edit Dokter</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
```

</head>

<body style="background-color: #f4f8fc;">

<div class="container mt-5">

```
<div class="card shadow-sm border-0">

    <div class="card-body p-4">

        <h2 class="mb-4">
            <i class="bi bi-pencil-square text-primary me-2"></i>
            Edit Data Dokter
        </h2>

        {{-- PESAN ERROR --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Terjadi kesalahan:</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('master-dokters.update', $dokter->id) }}"
              method="POST">

            @csrf

            @method('PUT')


            {{-- NAMA DOKTER --}}
            <div class="mb-3">

                <label class="form-label fw-bold">
                    Nama Dokter
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       value="{{ old('nama', $dokter->nama) }}"
                       required>

            </div>


            {{-- JENIS KELAMIN --}}
            <div class="mb-3">

                <label class="form-label fw-bold">
                    Jenis Kelamin
                </label>

                <select name="jenis_kelamin"
                        class="form-select"
                        required>

                    <option value="laki-laki"
                        {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="perempuan"
                        {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                        Perempuan
                    </option>

                </select>

            </div>


            {{-- TANGGAL LAHIR --}}
            <div class="mb-3">

                <label class="form-label fw-bold">
                    Tanggal Lahir
                </label>

                <input type="date"
                       name="tanggal_lahir"
                       class="form-control"
                       value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}"
                       required>

            </div>


            {{-- ALAMAT --}}
            <div class="mb-3">

                <label class="form-label fw-bold">
                    Alamat
                </label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ old('alamat', $dokter->alamat) }}</textarea>

            </div>


            {{-- SPESIALIS --}}
            <div class="mb-3">

                <label class="form-label fw-bold">

                    Spesialis

                    <span class="badge bg-secondary ms-1">
                        <i class="bi bi-lock-fill"></i>
                        Tidak dapat diubah
                    </span>

                </label>

                <input type="text"
                       class="form-control bg-light"
                       value="{{ $dokter->spesialis }}"
                       readonly>

                <small class="text-muted">

                    <i class="bi bi-info-circle me-1"></i>

                    Spesialis tidak dapat diubah pada halaman edit.

                </small>

            </div>


            {{-- POLI --}}
            <div class="mb-3">

                <label class="form-label fw-bold">
                    Poli
                </label>

                <select name="poli_id"
                        class="form-select"
                        required>

                    <option value="">
                        -- Pilih Poli --
                    </option>

                    @foreach($polis as $poli)

                        <option value="{{ $poli->id }}"
                            {{ old('poli_id', $dokter->poli_id) == $poli->id ? 'selected' : '' }}>

                            {{ $poli->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- TOMBOL --}}
            <div class="mt-4">

                <button type="submit"
                        class="btn btn-success">

                    <i class="bi bi-save me-1"></i>

                    Update

                </button>

                <a href="{{ route('master-dokters.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-1"></i>

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
