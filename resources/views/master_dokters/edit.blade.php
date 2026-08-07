<!DOCTYPE html>
<html>
<head>
    <title>Edit Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Edit Data Dokter</h2>

    <form action="{{ route('master-dokters.update', $dokter->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Dokter</label>
            <input type="text"
                   name="nama"
                   class="form-control"
                   value="{{ old('nama', $dokter->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="laki-laki" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                    Laki-laki
                </option>
                <option value="perempuan" {{ old('jenis_kelamin', $dokter->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date"
                   name="tanggal_lahir"
                   class="form-control"
                   value="{{ old('tanggal_lahir', $dokter->tanggal_lahir) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat"
                      class="form-control"
                      rows="3" required>{{ old('alamat', $dokter->alamat) }}</textarea>
        </div>


        <div class="mb-3">
            <label class="form-label">Spesialis</label>
            <input type="text"
                   name="spesialis"
                   class="form-control"
                   value="{{ old('spesialis', $dokter->spesialis) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Poli</label>
            <select name="poli_id" class="form-select" required>
                <option value="">-- Pilih Poli --</option>
                @foreach($polis as $poli)
                    <option value="{{ $poli->id }}"
                        {{ old('poli_id', $dokter->poli_id) == $poli->id ? 'selected' : '' }}>
                        {{ $poli->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('master-dokters.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

</body>
</html>
