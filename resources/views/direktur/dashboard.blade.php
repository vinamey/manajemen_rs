
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Direktur - SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f1f6ff;
            font-family: Arial, sans-serif;
            color: #183153;
        }

        /* SIDEBAR */
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

        .brand i {
            font-size: 27px;
        }

        .brand span {
            font-size: 19px;
            font-weight: bold;
        }

        .sidebar-menu {
            padding: 20px 10px;
        }

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

        /* MAIN */
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

        .topbar-title {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

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

        .user-role {
            font-size: 13px;
            font-weight: 600;
        }

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

        .btn-logout:hover {
            background: #c9273d;
            color: white;
        }

        .content {
            padding: 24px;
        }

        /* HEADING */
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

        /* STATISTIK */
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

        .patient-icon,
        .medicine-icon {
            background: #dcecff;
            color: #1678f2;
        }

        .patient-info h3,
        .medicine-info h3 {
            color: #1678f2;
        }

        .doctor-icon,
        .room-icon {
            background: #d8f7ed;
            color: #0ba77d;
        }

        .doctor-info h3,
        .room-info h3 {
            color: #0ba77d;
        }

        .nurse-icon {
            background: #e9e1ff;
            color: #7045d9;
        }

        .nurse-info h3 {
            color: #7045d9;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            margin-top: 16px;
        }

        /* KARTU PENDAPATAN */
        .income-card {
            width: 100%;
            margin-top: 20px;
            background: #fff;
            border: 1px solid #e3ecfa;
            border-radius: 18px;
            padding: 22px;
            box-shadow: 0 5px 18px rgba(35,91,160,.06);
            scroll-margin-top: 80px;
        }

        .income-layout {
            display: grid;
            grid-template-columns: 0.9fr 1.7fr;
            gap: 24px;
            align-items: center;
        }

        .income-left {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding-right: 20px;
            border-right: 1px solid #e5edf8;
            min-width: 0;
        }

        .income-icon {
            width: 55px;
            height: 55px;
            min-width: 55px;
            background: linear-gradient(145deg, #58aaff, #0870ed);
            color: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
        }

        .income-info {
            min-width: 0;
        }

        .income-info h5 {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .income-info p {
            font-size: 12px;
            color: #71829b;
            margin-bottom: 9px;
        }

        .income-amount {
            font-size: 27px;
            font-weight: 800;
            color: #0870ed;
            margin-bottom: 10px;
            overflow-wrap: anywhere;
        }

        .income-comparison {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
            color: #71829b;
            font-size: 11px;
        }

        .income-percent {
            background: #e5f2ff;
            color: #0870ed;
            padding: 6px 10px;
            border-radius: 20px;
            font-weight: 700;
        }

        /* GRAFIK BATANG */
        .income-right {
            width: 100%;
            min-width: 0;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 13px;
            gap: 10px;
        }

        .chart-title {
            font-size: 14px;
            font-weight: 700;
            color: #183153;
            margin: 0;
        }

        .chart-subtitle {
            font-size: 11px;
            color: #91a0b5;
            margin: 4px 0 0;
        }

        .period-label {
            background: #edf5ff;
            color: #1769d1;
            border: 1px solid #d5e6ff;
            padding: 7px 11px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            outline: none;
            min-width: 105px;
        }

        .period-label:focus {
            border-color: #8bbaff;
            box-shadow: 0 0 0 3px rgba(23,105,209,.1);
        }

        .chart-area {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: stretch;
            justify-content: space-around;
            gap: 8px;
            padding: 8px 5px 0;
            border-bottom: 1px solid #dfe8f5;
            background: repeating-linear-gradient(
                to bottom,
                transparent 0,
                transparent 43px,
                #f0f4fa 44px
            );
        }

        .chart-column {
            flex: 1;
            min-width: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
        }

        .chart-bar {
            position: relative;
            width: 58%;
            max-width: 38px;
            min-width: 9px;
            border-radius: 7px 7px 2px 2px;
            background: linear-gradient(180deg, #a9d1ff, #6daaf1);
            box-shadow: 0 3px 7px rgba(23,105,209,.10);
            transition: height .3s ease, filter .2s ease;
            cursor: pointer;
        }

        .chart-bar:hover {
            filter: brightness(.94);
        }

        .chart-bar.selected {
            background: linear-gradient(180deg, #45a0ff, #0860d5);
            box-shadow: 0 4px 11px rgba(8,96,213,.23);
        }

        .chart-month {
            font-size: 10px;
            color: #8292aa;
            margin-top: 8px;
            white-space: nowrap;
        }

        .chart-month.selected {
            color: #0860d5;
            font-weight: 800;
        }

        .chart-legend {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 11px;
            font-size: 10px;
            color: #8292aa;
        }

        .legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #0870ed;
        }

        @media (max-width: 1100px) {
            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 850px) {
            .income-layout {
                grid-template-columns: 1fr;
            }

            .income-left {
                border-right: none;
                border-bottom: 1px solid #e5edf8;
                padding: 0 0 18px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 65px;
            }

            .brand {
                height: 75px;
            }

            .brand span {
                display: none;
            }

            .sidebar-menu {
                padding: 15px 7px;
            }

            .sidebar-menu a {
                justify-content: center;
                padding: 13px 5px;
                font-size: 0;
            }

            .sidebar-menu a i {
                font-size: 18px;
            }

            .main-wrapper {
                margin-left: 65px;
            }

            .content {
                padding: 15px;
            }

            .stat-grid,
            .bottom-grid {
                grid-template-columns: 1fr;
            }

            .topbar {
                padding: 0 12px;
            }

            .topbar-title {
                font-size: 13px;
            }

            .user-avatar {
                display: none;
            }

            .user-role {
                font-size: 11px;
            }

            .btn-logout {
                padding: 7px 9px;
                font-size: 11px;
            }

            .heading-card {
                padding: 15px;
                gap: 12px;
            }

            .heading-icon {
                width: 52px;
                height: 52px;
                font-size: 22px;
            }

            .heading-card h2 {
                font-size: 19px;
            }

            .heading-card p {
                font-size: 11px;
            }

            .income-card {
                padding: 17px 14px;
            }

            .chart-area {
                height: 155px;
                gap: 3px;
                padding: 8px 2px 0;
            }

            .chart-bar {
                width: 65%;
                min-width: 7px;
            }

            .chart-month {
                font-size: 9px;
            }
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
                    <button type="submit"
                            class="btn-logout"
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

                <!-- HEADING -->
                <div class="heading-card">
                    <div class="heading-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>

                    <div>
                        <h2>Dashboard Direktur</h2>
                        <p>Ringkasan informasi sistem manajemen rumah sakit</p>
                    </div>
                </div>

                <!-- STATISTIK -->
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

                <!-- OBAT DAN KAMAR -->
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

                <!-- PENDAPATAN -->
                <div class="income-card" id="grafik-pendapatan">

                    <div class="income-layout">

                        <!-- RINGKASAN PENDAPATAN -->
                        <div class="income-left">

                            <div class="income-icon">
                                <i class="fas fa-briefcase-medical"></i>
                            </div>

                            <div class="income-info">
                                <h5>Pendapatan</h5>

                                <p>
                                    Total pendapatan bulan
                                    {{ $namaBulan[$bulan] ?? '' }}
                                    {{ $tahun ?? '' }}
                                </p>

                                <div class="income-amount">
                                    Rp {{ number_format($pendapatan ?? 0, 0, ',', '.') }}
                                </div>

                                <div class="income-comparison">
                                    <span class="income-percent">
                                        <i class="fas fa-calendar-check"></i>
                                        {{ $namaBulan[$bulan] ?? '' }}
                                    </span>

                                    <span>Pendapatan bulan terpilih</span>
                                </div>
                            </div>

                        </div>

                        <!-- GRAFIK BATANG -->
                        <div class="income-right">

                            <div class="chart-header">

                                <div>
                                    <h6 class="chart-title">
                                        Grafik Pendapatan
                                    </h6>
                                    <p class="chart-subtitle">
                                        Januari - Desember {{ $tahun }}
                                    </p>
                                </div>

                                <form action="{{ route('dashboard') }}"
                                      method="GET"
                                      id="formPeriode">

                                    <select name="bulan"
                                            class="period-label"
                                            onchange="document.getElementById('formPeriode').submit()">

                                        @foreach ($namaBulan as $nomor => $nama)
                                            <option value="{{ $nomor }}"
                                                {{ $bulan == $nomor ? 'selected' : '' }}>
                                                {{ $nama }}
                                            </option>
                                        @endforeach

                                    </select>

                                    <input type="hidden" name="tahun" value="{{ $tahun }}">
                                    <input type="hidden" name="grafik" value="1">
                                </form>

                            </div>

                            <div class="chart-area">

                                @foreach ($grafikPendapatan as $item)

                                    <div class="chart-column">

                                        <div
                                            class="chart-bar {{ $bulan == $item['nomor'] ? 'selected' : '' }}"
                                            style="height: {{ max(5, $item['tinggi']) }}%;"
                                            title="{{ $item['bulan'] }} {{ $tahun }}: Rp {{ number_format($item['total'], 0, ',', '.') }}">
                                        </div>

                                        <span class="chart-month {{ $bulan == $item['nomor'] ? 'selected' : '' }}">
                                            {{ $item['singkatan'] }}
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                            <div class="chart-legend">
                                <span class="legend-dot"></span>
                                <span>Bulan yang dipilih</span>
                            </div>

                        </div>

                    </div>
                </div>

            @endif

        </div>
    </div>

    <!-- SCROLL OTOMATIS KE GRAFIK -->
    @if(request()->has('grafik'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const grafik = document.getElementById('grafik-pendapatan');

                if (grafik) {
                    setTimeout(function () {
                        grafik.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 100);
                }
            });
        </script>
    @endif

</body>
</html>
