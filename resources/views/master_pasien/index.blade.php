<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">


    <div class="d-flex justify-content-between mb-3">

        <h2>Data Pasien</h2>

        <a href="{{ route('master-pasien.create') }}" class="btn btn-primary">
            + Tambah Pasien
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
                <th>Status Asuransi</th>
                <th>Golongan Darah</th>
                <th width="170">Aksi</th>

            </tr>

        </thead>



        <tbody>


        @forelse($pasiens as $pasien)


            <tr>


                <td>
                    {{ $loop->iteration }}
                </td>


                <td>
                    {{ $pasien->nama }}
                </td>


                <td>
                    {{ $pasien->jenis_kelamin }}
                </td>


                <td>
                    {{ $pasien->tanggal_lahir }}
                </td>


                <td>
                    {{ $pasien->alamat }}
                </td>


                <td>
                    {{ $pasien->status_asuransi }}
                </td>


                <td>
                    {{ $pasien->golongan_darah }}
                </td>



                <td>


                    <a href="{{ route('master-pasien.edit',$pasien->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>




                    <form action="{{ route('master-pasien.destroy',$pasien->id) }}"
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

                <td colspan="8" class="text-center">

                    Data Pasien Belum Ada

                </td>

            </tr>


        @endforelse



        </tbody>


    </table>



    {{ $pasiens->links() }}



</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
