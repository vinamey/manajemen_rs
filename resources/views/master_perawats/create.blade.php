<!DOCTYPE html>
<html>
<head>
    <title>Tambah Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2>Tambah Data Perawat</h2>

<form action="{{ route('master-perawat.store') }}" method="POST">

@csrf

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control">
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>

<select name="jenis_kelamin" class="form-control">

<option value="">-- Pilih Jenis Kelamin --</option>
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
<textarea name="alamat" class="form-control" rows="3"></textarea>
</div>

<button type="submit" class="btn btn-primary">
    Simpan
</button>

<a href="{{ route('master-perawat.index') }}" class="btn btn-secondary">
    Kembali
</a>

</form>

</div>

</body>
</html>
