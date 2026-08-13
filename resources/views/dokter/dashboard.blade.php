<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:250px;
            height:100vh;
            position:fixed;
            background:#0d6efd;
            color:white;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px 20px;
        }

        .sidebar a:hover{
            background:#0b5ed7;
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

    <hr class="bg-light">

    <a href="#">🏠 Dashboard</a>

    <a href="#">🧑‍🤝‍🧑 Data Pasien</a>

    <a href="#">📅 Jadwal Praktek</a>

    <a href="#">🩺 Rekam Medis</a>

    <a href="#">💊 Resep Obat</a>

    <a href="#">👤 Profil</a>

    <form action="{{ route('logout') }}" method="POST" class="p-3">
        @csrf
        <button class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>


<div class="content">

    <div class="row">

        <div class="col-md-12">

            <div class="card shadow">

                <div class="card-body">

                    <h2>Selamat Datang, Dokter 👨‍⚕️</h2>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">

                            <table class="table">

                                <tr>
                                    <th>Nama</th>
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

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="row">

        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Total Pasien</h5>

                    <h2>120</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Jadwal Hari Ini</h5>

                    <h2>8</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Rekam Medis</h5>

                    <h2>56</h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Resep Obat</h5>

                    <h2>35</h2>

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            Menu Dokter

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-primary w-100 mb-3">
                        Data Pasien
                    </a>

                </div>

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-success w-100 mb-3">
                        Jadwal Praktek
                    </a>

                </div>

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-warning w-100 mb-3">
                        Rekam Medis
                    </a>

                </div>

                <div class="col-md-3">

                    <a href="#" class="btn btn-outline-danger w-100 mb-3">
                        Resep Obat
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>