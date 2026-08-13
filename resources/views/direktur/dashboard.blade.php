<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Direktur</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#212529;
            color:white;
        }

        .sidebar h3{
            padding-top:20px;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:12px 20px;
        }

        .sidebar a:hover{
            background:#343a40;
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

    <h3 class="text-center">
        SIM Rumah Sakit
    </h3>

    <hr>

    <a href="#">🏠 Dashboard</a>

    <a href="#">📊 Statistik Rumah Sakit</a>

    <a href="#">📈 Laporan Pasien</a>

    <a href="#">💰 Laporan Keuangan</a>

    <a href="#">🩺 Laporan Dokter</a>

    <a href="#">💊 Laporan Obat</a>

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

            <h2>Selamat Datang, Direktur 👔</h2>

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

                    <h5>Total Pasien</h5>

                    <h2>1.250</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Total Dokter</h5>

                    <h2>35</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Total Obat</h5>

                    <h2>520</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow text-center">

                <div class="card-body">

                    <h5>Pendapatan</h5>

                    <h2>Rp250 Jt</h2>

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="card shadow">

        <div class="card-header bg-dark text-white">

            Menu Direktur

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-dark w-100 mb-3">
                        Statistik Rumah Sakit
                    </a>

                </div>

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-primary w-100 mb-3">
                        Laporan Pasien
                    </a>

                </div>

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-success w-100 mb-3">
                        Laporan Keuangan
                    </a>

                </div>

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-warning w-100 mb-3">
                        Laporan Obat
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>