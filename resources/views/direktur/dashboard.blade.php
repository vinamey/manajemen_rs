<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Direktur - SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: #0d6efd;
            color: white;
            z-index: 1000;
        }

        .brand {
            padding: 20px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 22px;
            transition: background 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #0b5ed7;
        }

        /* MAIN CONTENT & TOPBAR CONTAINER */
        .main-wrapper {
            margin-left: 250px;
        }

        /* TOPBAR / NAVBAR ATAS */
        .topbar {
            background: white;
            height: 65px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .topbar .title {
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-role {
            font-size: 14px;
            color: #4b5563;
            font-weight: 500;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.2s;
        }

        .btn-logout:hover {
            background-color: #bb2d3b;
            color: white;
        }

        /* CONTENT AREA */
        .content {
            padding: 30px;
        }

        .card-stat {
            border: none;
            border-radius: 15px;
            padding: 25px;
            background: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, .08);
        }

        .card-stat h6 {
            color: #6c757d;
        }

        .card-stat h3 {
            color: #0d6efd;
            font-weight: bold;
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-hospital me-2"></i>
            SIM RS
        </div>

        <a href="{{ route('dashboard') }}" class="active">
            <i class="fas fa-home me-2"></i>
            Dashboard
        </a>

        <a href="{{ route('direktur.laporan') }}">
            <i class="fas fa-chart-column me-2"></i>
            Laporan
        </a>
    </div>

    {{-- MAIN WRAPPER --}}
    <div class="main-wrapper">

        {{-- TOPBAR ATAS --}}
        <div class="topbar">
            <h1 class="title">Dashboard Direktur</h1>

            <div class="topbar-right">
                <span class="user-role">
                    {{ Auth::user()->name ?? 'Direktur' }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-logout"
                        onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- AREA KONTEN DASHBOARD UTAMA --}}
        <div class="content">

            <h2 class="fw-bold">
                Dashboard Direktur
            </h2>

            <p class="text-muted mb-4">
                Ringkasan informasi sistem manajemen rumah sakit
            </p>

            <div class="row g-4">

                <div class="row g-4">

                    {{-- PASIEN --}}
                    <div class="col-md-4">
                        <div class="card-stat">
                            <h6><i class="fas fa-user-injured me-2"></i> Jumlah Pasien</h6>
                            <h3>{{ $totalPasien ?? 0 }}</h3>
                        </div>
                    </div>

                    {{-- DOKTER --}}
                    <div class="col-md-4">
                        <div class="card-stat">
                            <h6><i class="fas fa-user-doctor me-2"></i> Jumlah Dokter</h6>
                            <h3>{{ $totalDokter ?? 0 }}</h3>
                        </div>
                    </div>

                    {{-- PERAWAT --}}
                    <div class="col-md-4">
                        <div class="card-stat">
                            <h6><i class="fas fa-user-nurse me-2"></i> Jumlah Perawat</h6>
                            <h3>{{ $totalPerawat ?? 0 }}</h3>
                        </div>
                    </div>

                    {{-- PENDAPATAN --}}
                    <div class="col-md-4">
                        <div class="card-stat">
                            <h6><i class="fas fa-money-bill-wave me-2"></i> Pendapatan</h6>
                            <h3>Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>

                    {{-- OBAT --}}
                    <div class="col-md-4">
                        <div class="card-stat">
                            <h6><i class="fas fa-pills me-2"></i> Jumlah Obat</h6>
                            <h3>{{ $totalObat ?? 0 }}</h3>
                        </div>
                    </div>

                    {{-- KAMAR --}}
                    <div class="col-md-4">
                        <div class="card-stat">
                            <h6><i class="fas fa-bed me-2"></i> Jumlah Kamar</h6>
                            <h3>{{ $totalKamar ?? 0 }}</h3>
                        </div>
                    </div>

                </div>

            </div>

</body>

</html>
