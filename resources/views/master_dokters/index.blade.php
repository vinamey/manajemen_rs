<!DOCTYPE html>
<html>
<head>
    <title>Data Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">Data Dokter</h2>

    <a href="{{ route('master-dokters.create') }}"
       class="btn btn-primary mb-3">
        + Tambah Dokter
    </a>


    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <table class="table table-bordered">

        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Spesalis</th>
                <th>Poli</th>
                <th>Aksi</th>
            </tr>
        </thead>


        <tbody>

        @foreach($dokters as $dokter)

            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>{{ $dokter->nama }}</td>

                <td>{{ $dokter->jenis_kelamin }}</td>

                <td>{{ $dokter->tanggal_lahir }}</td>

                <td>{{ $dokter->spesalis }}</td>

                <td>
                    {{ $dokter->poli->nama ?? '-' }}
                </td>


                <td>

                    <a href="{{ route('master-dokters.edit',$dokter->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>


                    <form action="{{ route('master-dokters.destroy',$dokter->id) }}"
                          method="POST"
                          style="display:inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus data dokter?')">
                            Hapus
                        </button>

                    </form>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>


</div>

</body>
</html>
