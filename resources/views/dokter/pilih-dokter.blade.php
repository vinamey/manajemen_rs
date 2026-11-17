
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Dokter - SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .container-pilih {
            max-width: 850px;
            margin: 65px auto;
            padding: 20px;
        }

        .header-pilih {
            text-align: center;
            margin-bottom: 30px;
        }

        .header-pilih h2 {
            color: #0f58c6;
            font-weight: 700;
        }

        .header-pilih p {
            color: #6c757d;
        }

        .dokter-card {
            background: white;
            border: 1px solid #e3eaf3;
            border-radius: 12px;
            padding: 20px;
            height: 100%;
            transition: 0.2s;
        }

        .dokter-card:hover {
            border-color: #1877f2;
            box-shadow: 0 5px 18px rgba(24, 119, 242, 0.12);
            transform: translateY(-3px);
        }

        .dokter-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #e7f3ff;
            color: #1877f2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 14px;
        }

        .nama-dokter {
            font-weight: 700;
            color: #263445;
            margin-bottom: 15px;
        }

        .btn-pilih {
            background: #1877f2;
            color: white;
            border: none;
            border-radius: 7px;
            padding: 9px 15px;
            width: 100%;
        }

        .btn-pilih:hover {
            background: #0f58c6;
            color: white;
        }

        .btn-logout {
            border-radius: 7px;
        }
    </style>
</head>

<body>

<div class="container-pilih">

    <div class="header-pilih">
        <h2>Pilih Dokter</h2>
        <p>Silakan pilih nama dokter untuk masuk ke Dashboard Dokter SIM RS.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($dokters->isEmpty())
        <div class="alert alert-warning text-center">
            Belum ada data dokter. Silakan tambahkan dokter melalui Master Dokter.
        </div>
    @else
        <div class="row g-3">

            @foreach($dokters as $dokter)
                <div class="col-md-4 col-sm-6">
                    <div class="dokter-card">

                        <div class="dokter-icon">
                            <i class="bi bi-person-badge"></i>
                        </div>

                        <div class="nama-dokter">
                            {{ $dokter->nama }}
                        </div>

                        <form action="{{ route('dokter.simpan') }}" method="POST">
                            @csrf

                            <input
                                type="hidden"
                                name="dokter_id"
                                value="{{ $dokter->id }}"
                            >

                            <button type="submit" class="btn btn-pilih">
                                Pilih Dokter
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach

        </div>
    @endif

    <div class="text-center mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger btn-logout">
                Keluar / Logout
            </button>
        </form>
    </div>

</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</body>
</html>
