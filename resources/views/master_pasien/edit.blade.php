<!DOCTYPE html>
<html>
<head>
    <title>Edit Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4>Edit Data Pasien</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master-pasien.update', $pasien->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control" value="{{ $pasien->nama }}">
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="laki-laki" {{ $pasien->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ $pasien->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ $pasien->tanggal_lahir }}">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control">{{ $pasien->alamat }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Status Asuransi</label>
                    <select name="status_asuransi" class="form-control">
                        <option value="01" {{ $pasien->status_asuransi == '01' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ $pasien->status_asuransi == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Golongan Darah</label>
                    <select name="golongan_darah" class="form-control">
                        <option value="A" {{ $pasien->golongan_darah == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $pasien->golongan_darah == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ $pasien->golongan_darah == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ $pasien->golongan_darah == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    Update
                </button>

                <a href="{{ route('master-pasien.index') }}" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>
