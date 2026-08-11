<!DOCTYPE html>
<html>
<head>
    <title>Edit Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2>Edit Data Perawat</h2>

<form action="{{ route('master-perawat.update',$perawat->id) }}" method="POST">

@csrf
@method('PUT')

<div class="mb-3">
<label>Nama</label>
<input type="text"
       name="nama"
       class="form-control"
       value="{{ $perawat->nama }}">
</div>

<div class="mb-3">

<label>Jenis Kelamin</label>

<select name="jenis_kelamin" class="form-control">

<option value="laki-laki"
{{ $perawat->jenis_kelamin=='laki-laki' ? 'selected' : '' }}>
Laki-laki
</option>

<option value="perempuan"
{{ $perawat->jenis_kelamin=='perempuan' ? 'selected' : '' }}>
Perempuan
</option>

</select>

</div>

<div class="mb-3">

<label>Tanggal Lahir</label>

<input type="date"
       name="tanggal_lahir"
       class="form-control"
       value="{{ $perawat->tanggal_lahir }}">

</div>

<div class="mb-3">

<label>Alamat</label>

<textarea name="alamat"
          class="form-control"
          rows="3">{{ $perawat->alamat }}</textarea>

</div>

<button type="submit" class="btn btn-success">
    Update
</button>

<a href="{{ route('master-perawat.index') }}" class="btn btn-secondary">
    Kembali
</a>

</form>

</div>

</body>
</html>
