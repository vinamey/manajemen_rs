
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Direktur - SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f1f6ff;
            font-family: Arial, sans-serif;
            color: #183153;
        }

        .sidebar {
            width: 210px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #1877f2, #0860d5);
            color: white;
            z-index: 1000;
        }

        .brand {
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 5px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .brand i { font-size: 27px; }
        .brand span { font-size: 19px; font-weight: bold; }

        .sidebar-menu { padding: 20px 10px; }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 12px 15px;
            margin-bottom: 8px;
            border-radius: 11px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: .2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,.22);
        }

        .main-wrapper {
            margin-left: 210px;
            min-height: 100vh;
        }

        .topbar {
            height: 62px;
            background: white;
            padding: 0 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e4ebf6;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left { display: flex; align-items: center; }
        .topbar-title { font-size: 15px; font-weight: 600; margin: 0; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .user-avatar {
            width: 33px;
            height: 33px;
            background: #dceaff;
            color: #1673ed;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 16px;
        }

        .user-role { font-size: 13px; font-weight: 600; }

        .btn-logout {
            background: #e83b50;
            color: white;
            border: none;
            padding: 8px 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-logout:hover { background: #c9273d; color: white; }

        .content { padding: 24px; }

        .heading-card {
            background: linear-gradient(115deg, #dceaff, #ffffff);
            border: 1px solid #e2ecfc;
            border-radius: 16px;
            padding: 18px 23px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(35,91,160,.06);
            display: flex;
            align-items: center;
            gap: 17px;
        }

        .heading-icon {
            width: 62px;
            height: 62px;
            border-radius: 17px;
            background: linear-gradient(145deg, #58aaff, #0870ed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        .heading-card h2 {
            font-size: 23px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .heading-card p {
            font-size: 13px;
            color: #526b91;
            margin: 0;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .stat-card {
            min-height: 112px;
            background: linear-gradient(145deg, #fff, #f8fbff);
            border: 1px solid #e6edfa;
            border-radius: 17px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 4px 12px rgba(35,91,160,.07);
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 16px rgba(35,91,160,.11);
        }

        .stat-icon {
            width: 62px;
            height: 62px;
            min-width: 62px;
            border-radius: 17px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 26px;
        }

        .stat-info h6 {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .stat-info h3 {
            font-size: 29px;
            font-weight: 700;
            margin: 0;
        }

        .patient-icon, .medicine-icon {
            background: #dcecff;
            color: #1678f2;
        }

        .patient-info h3, .medicine-info h3 { color: #1678f2; }

        .doctor-icon, .room-icon {
            background: #d8f7ed;
            color: #0ba77d;
        }

        .doctor-info h3, .room-info h3 { color: #0ba77d; }

        .nurse-icon {
            background: #e9e1ff;
            color: #7045d9;
        }

        .nurse-info h3 { color: #7045d9; }

        .bottom-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        .income-card {
            margin-top: 20px;
            background: linear-gradient(135deg, #fff, #f2f7ff);
            border: 1px solid #e1eafa;
            border-radius: 18px;
            padding: 20px 23px;
            box-shadow: 0 5px 15px rgba(35,91,160,.07);
        }

        .income-layout {
            display: grid;
            grid-template-columns: 1fr 1.25fr;
            gap: 22px;
            align-items: center;
        }

        .income-left {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 8px 18px 8px 0;
            border-right: 2px solid #e0eafa;
        }

        .income-icon {
            width: 68px;
            height: 68px;
            min-width: 68px;
            background: linear-gradient(145deg, #58aaff, #0870ed);
            color: white;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .income-info h5 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .income-info p {
            font-size: 12px;
            color: #526b91;
            margin-bottom: 5px;
        }

        .income-amount {
            font-size: 34px;
            font-weight: 700;
            color: #0870ed;
            margin-bottom: 8px;
            white-space: nowrap;
        }

        .income-comparison {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
            color: #526b91;
            font-size: 12px;
        }

        .income-percent {
            background: #d6f7ed;
            color: #079b71;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .income-right { min-width: 0; }

        .chart-header {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 14px;
        }

        .period-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #edf4ff;
            color: #1769d1;
            border: 1px solid #cfe0fc;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .chart-area {
            height: 120px;
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            gap: 10px;
            border-bottom: 2px solid #dbe7f7;
            padding: 0 8px;
        }

        .chart-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            height: 100%;
        }

        .chart-bar {
            width: 60%;
            max-width: 52px;
            min-width: 18px;
            border-radius: 9px 9px 0 0;
            background: #c6ddff;
        }

        .chart-bar.current {
            background: linear-gradient(180deg, #3995ff, #0870ed);
        }

        .chart-month {
            font-size: 11px;
            color: #36557e;
            margin-top: 8px;
        }

        @media (max-width: 1100px) {
            .stat-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 850px) {
            .income-layout { grid-template-columns: 1fr; }
            .income-left {
                border-right: none;
                border-bottom: 2px solid #e0eafa;
                padding-bottom: 18px;
            }
        }

        @media (max-width: 768px) {
            .sidebar { width: 65px; }
            .brand { height: 75px; }
            .brand span { display: none; }
            .sidebar-menu { padding: 15px 7px; }

            .sidebar-menu a {
                justify-content: center;
                padding: 13px 5px;
                font-size: 0;
            }

            .sidebar-menu a i { font-size: 18px; }
            .main-wrapper { margin-left: 65px; }
            .content { padding: 15px; }
            .stat-grid, .bottom-grid { grid-template-columns: 1fr; }
            .topbar { padding: 0 12px; }
            .topbar-title { font-size: 13px; }
            .topbar-right { gap: 8px; }
            .user-avatar { display: none; }
            .user-role { font-size: 11px; }

            .btn-logout {
                padding: 7px 9px;
                font-size: 11px;
            }

            .heading-card { padding: 15px; gap: 12px; }

            .heading-icon {
                width: 52px;
                height: 52px;
                font-size: 22px;
            }

            .heading-card h2 { font-size: 19px; }
            .heading-card p { font-size: 11px; }
            .income-card { padding: 17px 14px; }
            .income-amount { font-size: 28px; }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div class="brand">
            <i class="fas fa-hospital"></i>
            <span>SIM RS</span>
        </div>

        <div class="sidebar-menu">

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('direktur.laporan') }}"
               class="{{ request()->routeIs('direktur.laporan') ? 'active' : '' }}">
                <i class="fas fa-chart-column"></i>
                Laporan
            </a>

            <!-- MENU PENGELUARAN -->
            <a href="{{ route('direktur.pengeluaran.index') }}"
               class="{{ request()->routeIs('direktur.pengeluaran.*') ? 'active' : '' }}">
                <i class="fas fa-wallet"></i>
                Pengeluaran
            </a>

        </div>

    </div>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">

        <!-- NAVBAR -->
        <div class="topbar">

            <div class="topbar-left">
                <h1 class="topbar-title">
                    @yield('navbar-title', 'Dashboard Direktur')
                </h1>
            </div>

            <div class="topbar-right">

                <div class="user-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <span class="user-role">
                    {{ Auth::user()->name ?? 'Direktur' }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf

                    <button type="submit" class="btn-logout"
                        onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="fas fa-right-from-bracket me-1"></i>
                        Logout
                    </button>
                </form>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="content">

            @hasSection('content')
                @yield('content')
            @else

                <div class="heading-card">
                    <div class="heading-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <div>
                        <h2>Dashboard Direktur</h2>
                        <p>Ringkasan informasi sistem manajemen rumah sakit</p>
                    </div>
                </div>

                <div class="stat-grid">

                    <div class="stat-card">
                        <div class="stat-icon patient-icon">
                            <i class="fas fa-bed-pulse"></i>
                        </div>
                        <div class="stat-info patient-info">
                            <h6>Jumlah Pasien</h6>
                            <h3>{{ $totalPasien ?? 0 }}</h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon doctor-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <div class="stat-info doctor-info">
                            <h6>Jumlah Dokter</h6>
                            <h3>{{ $totalDokter ?? 0 }}</h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon nurse-icon">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <div class="stat-info nurse-info">
                            <h6>Jumlah Perawat</h6>
                            <h3>{{ $totalPerawat ?? 0 }}</h3>
                        </div>
                    </div>

                </div>

                <div class="bottom-grid">

                    <div class="stat-card">
                        <div class="stat-icon medicine-icon">
                            <i class="fas fa-pills"></i>
                        </div>
                        <div class="stat-info medicine-info">
                            <h6>Jumlah Obat</h6>
                            <h3>{{ $totalObat ?? 0 }}</h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon room-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="stat-info room-info">
                            <h6>Jumlah Kamar</h6>
                            <h3>{{ $totalKamar ?? 0 }}</h3>
                        </div>
                    </div>

                </div>

                <div class="income-card">
                    <div class="income-layout">

                        <div class="income-left">
                            <div class="income-icon">
                                <i class="fas fa-briefcase-medical"></i>
                            </div>

                            <div class="income-info">
                                <h5>Pendapatan</h5>
                                <p>Total pendapatan rumah sakit</p>

                                <div class="income-amount">
                                    Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}
                                </div>

                                <div class="income-comparison">
                                    <span class="income-percent">
                                        <i class="fas fa-arrow-trend-up"></i> 0%
                                    </span>
                                    <span>Dibanding periode sebelumnya</span>
                                </div>
                            </div>
                        </div>

                        <div class="income-right">
                            <div class="chart-header">
                                <span class="period-label">
                                    <i class="far fa-calendar-days"></i>
                                    6 Bulan
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </div>

                            <div class="chart-area">
                                <div class="chart-column">
                                    <div class="chart-bar" style="height: 40%;"></div>
                                    <span class="chart-month">Jan</span>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-bar" style="height: 53%;"></div>
                                    <span class="chart-month">Feb</span>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-bar" style="height: 65%;"></div>
                                    <span class="chart-month">Mar</span>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-bar" style="height: 55%;"></div>
                                    <span class="chart-month">Apr</span>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-bar" style="height: 80%;"></div>
                                    <span class="chart-month">Mei</span>
                                </div>
                                <div class="chart-column">
                                    <div class="chart-bar current" style="height: 80%;"></div>
                                    <span class="chart-month">Jun</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            @endif

        </div>

    </div>

</body>
</html>
