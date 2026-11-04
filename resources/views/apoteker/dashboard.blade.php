<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apoteker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --blue-soft: #f4f8ff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            color: var(--text-dark);
        }

        /* =========================================
           SIDEBAR
        ========================================= */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, var(--blue-main), var(--blue-dark));
            color: white;
            padding-top: 20px;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.08);
            z-index: 1000;
        }

        .logo {
            text-align: center;
            font-weight: 700;
            font-size: 21px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: white;
            color: var(--blue-main);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 22px;
        }

        .sidebar-line {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.25);
            margin: 0 18px 15px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
            padding: 0 20px;
            margin-bottom: 7px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: white;
            color: var(--blue-main);
            font-weight: 600;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        /* =========================================
           LOGOUT
        ========================================= */
        .logout-box {
            position: absolute;
            bottom: 20px;
            left: 12px;
            right: 12px;
        }

        .logout-btn {
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            width: 100%;
            padding: 11px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: white;
            color: var(--blue-main);
        }

        /* =========================================
           CONTENT
        ========================================= */
        .content {
            margin-left: 250px;
            padding: 30px;
        }

        .page-title {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        /* =========================================
           WELCOME CARD
        ========================================= */
        .welcome-card {
            background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
            color: white;
            border: none;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(24, 119, 242, 0.18);
        }

        .welcome-card h3 {
            font-weight: 700;
        }

        .welcome-card p {
            margin-bottom: 0;
            opacity: 0.9;
        }

        /* =========================================
           STAT CARD
        ========================================= */
        .stat-card {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .stat-title {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 5px;
        }

        .stat-number {
            color: #111827;
            font-size: 27px;
            font-weight: 700;
        }

        /* =========================================
           MENU CARD
        ========================================= */
        .menu-card {
            background: white;
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .menu-header {
            padding: 18px 22px;
            border-bottom: 1px solid #edf0f5;
            font-size: 18px;
            font-weight: 700;
        }

        .menu-body {
            padding: 22px;
        }

        /* =========================================
           MENU BUTTON
        ========================================= */
        .menu-button {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 75px;
            padding: 15px;
            border: 1px solid #dce9fb;
            border-radius: 13px;
            background: white;
            color: #1f2937;
            text-decoration: none;
            transition: 0.2s;
        }

        .menu-button:hover {
            background: var(--blue-soft);
            border-color: var(--blue-main);
            color: var(--blue-main);
            transform: translateY(-2px);
        }

        .menu-button-icon {
            width: 43px;
            height: 43px;
            border-radius: 11px;
            background: var(--blue-light);
            color: var(--blue-main);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .menu-button-title {
            font-weight: 600;
            font-size: 14px;
        }

        .menu-button-desc {
            color: #8a94a6;
            font-size: 11px;
            margin-top: 2px;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */
        @media(max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">💊</div>
            SIM RS
        </div>

        <hr class="sidebar-line">

        <div class="menu-title">Menu Apoteker</div>

        <a href="{{ route('apoteker.dashboard') }}" class="active">
            <span class="menu-icon">🏠</span> Dashboard
        </a>
        <a href="{{ route('apoteker.obat.index') }}">
            <span class="menu-icon">💊</span> Data Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}">
            <span class="menu-icon">🛒</span> Log Stok Obat
        </a>


       <a href="{{ route('apoteker.supplier.index') }}">
    <span class="menu-icon">🏢</span> Supplier Obat
</a>

       <a href="{{ route('apoteker.resep.index') }}">
    <i class="fa-solid fa-file-prescription"></i>
    <span>Resep Dokter</span>
</a>
        <div class="logout-box">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    🚪 &nbsp; Logout
                </button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        <div class="page-title">Dashboard Apoteker</div>

        <!-- WELCOME -->
        <div class="welcome-card mb-4">
            <h3>Selamat Datang, {{ auth()->user()->name }} 👋</h3>
            <p>Anda masuk sebagai Apoteker. Kelola kebutuhan obat rumah sakit melalui dashboard ini.</p>
        </div>







            <!-- MENU APOTEKER -->
            <div class="menu-card">
                <div class="menu-header">Menu Apoteker</div>
                <div class="menu-body">
                    <div class="row g-3">
                        <!-- DATA OBAT -->
                        <div class="col-md-6 col-xl-4">
                           <a href="{{ route('apoteker.obat.index') }}" class="menu-button">
                                <div class="menu-button-icon">💊</div>
                                <div>
                                    <div class="menu-button-title">Data Obat</div>
                                    <div class="menu-button-desc">Melihat dan mengelola data obat</div>
                                </div>
                            </a>
                        </div>

                       
<!-- LOG STOK OBAT -->
<div class="col-md-6 col-xl-4">
    <a href="{{ route('log-stok-obat.index') }}" class="menu-button">
        <div class="menu-button-icon">📦</div>
        <div>
            <div class="menu-button-title">Log Stok Obat</div>
            <div class="menu-button-desc">Lihat riwayat perubahan stok obat</div>
        </div>
    </a>
</div>



                        <!-- SUPPLIER OBAT -->
                        <div class="col-md-6 col-xl-4">
                            <a href="{{ route('apoteker.supplier.index') }}" class="menu-button">
                                <div class="menu-button-icon">🏢</div>
                                <div>
                                    <div class="menu-button-title">Supplier Obat</div>
                                    <div class="menu-button-desc">
                                        Melihat data supplier obat
                                    </div>
                                </div>
                            </a>
                        </div>


<!-- RESEP DOKTER -->
<div class="col-md-6 col-xl-4">
    <a href="{{ route('apoteker.resep.index') }}" class="menu-button">
        <div class="menu-button-icon">
            <i class="fa-solid fa-file-prescription"></i>
        </div>

        <div>
            <div class="menu-button-title">Resep Dokter</div>
            <div class="menu-button-desc">
                Melihat resep dari dokter
            </div>
        </div>
    </a>
</div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>
