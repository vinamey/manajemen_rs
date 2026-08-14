<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apoteker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#198754;
            color:white;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 20px;
        }

        .sidebar a:hover{
            background:#157347;
        }

        .content{
            margin-left:250px;
            padding:30px;
        }

        .card{
            border:none;
            border-radius:15px;
        }
    </style>

</head>
<body>

<div class="sidebar">

    <h3 class="text-center mt-4">
        SIM Rumah Sakit
    </h3>

    <hr>

    <a href="#">🏠 Dashboard</a>
    <a href="#">💊 Data Obat</a>
    <a href="#">📦 Stok Obat</a>
    <a href="#">📝 Resep Dokter</a>
    <a href="#">📋 Riwayat Pengeluaran Obat</a>
    <a href="#">👤 Profil</a>

    <form action="{{ route('logout') }}" method="POST" class="p-3">
        @csrf
        <button class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>

<div class="content">

    <div class="card shadow">

        <div class="card-body">

            <h2>Selamat Datang, Apoteker 💊</h2>

            <hr>

            <table class="table">

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

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Total Obat</h5>

                    <h2>250</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Stok Menipis</h5>

                    <h2>12</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Resep Hari Ini</h5>

                    <h2>37</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Obat Keluar</h5>

                    <h2>58</h2>

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="card shadow">

        <div class="card-header bg-success text-white">

            Menu Apoteker

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-success w-100 mb-3">
                        Data Obat
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-primary w-100 mb-3">
                        Stok Obat
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-warning w-100 mb-3">
                        Resep Dokter
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" class="btn btn-outline-danger w-100 mb-3">
                        Pengeluaran Obat
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>