<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Data Pasien</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master-pasien.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label>Status Asuransi</label>
                    <select name="status_asuransi" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option value="01">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Golongan Darah</label>
                    <select name="golongan_darah" class="form-control">
                        <option value="">-- Pilih --</option>
                        <option>A</option>
                        <option>B</option>
                        <option>AB</option>
                        <option>O</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
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
