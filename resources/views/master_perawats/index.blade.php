<!DOCTYPE html>
<html>
<head>
    <title>Data Perawat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h2>Data Perawat</h2>

        <a href="{{ route('master-perawat.create') }}" class="btn btn-primary">
            + Tambah Perawat
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th width="170">Aksi</th>
            </tr>
        </thead>

        <tbody>

        @forelse($perawats as $perawat)

        <tr>

            <td>{{ $loop->iteration }}</td>
            <td>{{ $perawat->nama }}</td>
            <td>{{ $perawat->jenis_kelamin }}</td>
            <td>{{ $perawat->tanggal_lahir }}</td>
            <td>{{ $perawat->alamat }}</td>

            <td>

                <a href="{{ route('master-perawat.edit',$perawat->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('master-perawat.destroy',$perawat->id) }}"
                      method="POST"
                      style="display:inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                        Hapus
                    </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="6" class="text-center">
                Data Perawat Belum Ada
            </td>
        </tr>

        @endforelse

        </tbody>

    </table>

</div>

</body>
</html>
