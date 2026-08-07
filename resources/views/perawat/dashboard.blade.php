<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body style="background-color:#f8f9fa;">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">
            Sistem Informasi Manajemen Rumah Sakit
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Dashboard Perawat</h3>
        </div>

        <div class="card-body">

            <h4>Selamat Datang</h4>

            <hr>

            <table class="table table-bordered">

                <tr>
                    <th width="200">Nama</th>
                    <td>{{ auth()->user()->name }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ auth()->user()->email }}</td>
                </tr>

                <tr>
                    <th>Role</th>
                    <td>{{ auth()->user()->getRoleNames()->first() }}</td>
                </tr>

            </table>

            <div class="alert alert-success mt-3">
                Anda berhasil login sebagai <b>Perawat</b>.
            </div>

            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="card text-center border-primary">
                        <div class="card-body">
                            <h5>Data Pasien</h5>
                            <p>Kelola data pasien.</p>
                            <a href="#" class="btn btn-primary">Masuk</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center border-success">
                        <div class="card-body">
                            <h5>Jadwal Perawatan</h5>
                            <p>Lihat jadwal perawatan pasien.</p>
                            <a href="#" class="btn btn-success">Masuk</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-center border-warning">
                        <div class="card-body">
                            <h5>Rekam Medis</h5>
                            <p>Lihat data rekam medis.</p>
                            <a href="#" class="btn btn-warning text-white">Masuk</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>