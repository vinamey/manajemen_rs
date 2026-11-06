<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Kasir - SIM RS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
            color: var(--text-dark);
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--blue-main);
            color: white;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .logo {
            height: 65px;
            display: flex;
            align-items: center;
            padding: 0 25px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .logo i {
            margin-right: 12px;
        }

        .menu {
            padding: 25px 12px;
            flex: 1;
        }

        .menu-title {
            font-size: 11px;
            opacity: .75;
            padding: 0 13px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            padding: 13px 14px;
            margin-bottom: 7px;
            border-radius: 8px;
            font-size: 14px;
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,.20);
        }

        .menu a i {
            width: 20px;
            text-align: center;
        }

        .logout-area {
            padding: 15px;
            border-top: 1px solid rgba(255,255,255,.15);
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: white;
            color: #dc3545;
            padding: 11px;
            border-radius: 8px;
            font-weight: 600;
            transition: .2s;
        }

        .logout-btn:hover {
            background: #fce7e7;
        }

        /* =========================
           MAIN CONTENT
        ========================= */

        .content {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* TOPBAR */

        .topbar {
            height: 65px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
        }

        .topbar-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .user-info {
            font-size: 13px;
            color: #555;
        }

        /* PAGE */

        .page {
            padding: 30px;
        }

        .page-title {
            color: var(--blue-main);
            font-weight: 700;
            font-size: 25px;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 25px;
        }

        /* =========================
           WELCOME CARD
        ========================= */

        .welcome-card {
            background: white;
            border-radius: 14px;
            border: 1px solid #e5e7eb;
            padding: 25px;
            margin-bottom: 25px;
        }

        .welcome-card h4 {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-card p {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 0;
        }

        /* =========================
           STAT CARD
        ========================= */

        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 18px rgba(0,0,0,.06);
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .stat-title {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 7px;
        }

        .stat-value {
            font-size: 25px;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* =========================
           PAYMENT CARD
        ========================= */

        .payment-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 25px;
            height: 100%;
            transition: .2s;
        }

        .payment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 18px rgba(0,0,0,.06);
        }

        .payment-icon {
            width: 45px;
            height: 45px;
            background: var(--blue-light);
            color: var(--blue-main);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-size: 19px;
            margin-bottom: 15px;
        }

        .payment-card h5 {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 9px;
        }

        .payment-card p {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 18px;
        }

        .btn-payment {
            background: var(--blue-main);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: .2s;
        }

        .btn-payment:hover {
            background: var(--blue-dark);
            color: white;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 768px) {

            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
            }

            .page {
                padding: 20px;
            }

            .topbar {
                padding: 0 18px;
            }

            .page-title {
                font-size: 21px;
            }
        }

        @media (max-width: 576px) {

            .sidebar {
                width: 65px;
            }

            .logo {
                justify-content: center;
                padding: 0;
                font-size: 0;
            }

            .logo i {
                font-size: 21px;
                margin: 0;
            }

            .menu {
                padding: 20px 8px;
            }

            .menu-title,
            .menu a span {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 14px 5px;
            }

            .logout-area {
                padding: 10px 7px;
            }

            .logout-btn {
                font-size: 0;
            }

            .logout-btn i {
                font-size: 16px;
                margin: 0 !important;
            }

            .content {
                margin-left: 65px;
            }

            .page {
                padding: 15px;
            }

            .welcome-card {
                padding: 18px;
            }

            .topbar {
                padding: 0 12px;
            }

            .topbar-title {
                font-size: 12px;
            }
        }
    </style>

</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================= -->

    <div class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-hospital"></i>
            SIM RS
        </div>

        <div class="menu">

            <div class="menu-title">
                Menu Kasir
            </div>

            <a href="{{ route('kasir.dashboard') }}" class="active">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>


            <a href="{{ route('kasir.pembayaran') }}">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Pembayaran Obat</span>
            </a>

        </div>

        <!-- LOGOUT -->

        <div class="logout-area">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Logout
                </button>

            </form>

        </div>

    </div>


    <!-- =========================
         CONTENT
    ========================= -->

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <div class="topbar-title">
                Dashboard Kasir
            </div>

            <div class="user-info">
                <i class="fa-solid fa-user me-2"></i>
                {{ auth()->user()->name }}
            </div>

        </div>


        <!-- PAGE -->

        <div class="page">

            <h3 class="page-title">
                Dashboard Kasir
            </h3>

            <div class="page-subtitle">
                Kelola pembayaran obat pasien
            </div>


            <!-- WELCOME CARD -->

            <div class="welcome-card">

                <h4>
                    Selamat Datang, {{ auth()->user()->name }}!
                </h4>

                <p>
                    Silakan gunakan menu Pembayaran Obat untuk memproses pembayaran pasien.
                </p>

            </div>

<!-- CARD RESEP DAN PEMBAYARAN -->

<div class="row g-4">



    <!-- PEMBAYARAN OBAT -->

<div class="col-lg-12 col-md-12">
        <div class="payment-card">

            <div class="payment-icon">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>

            <h5>
                Pembayaran Obat
            </h5>

            <p>
                Lihat resep pasien dan proses pembayaran obat dengan mudah dan cepat.
            </p>

            <div class="stat-value mb-3">
                <i class="fa-solid fa-cash-register text-primary"></i>
            </div>

            <a href="{{ route('kasir.pembayaran') }}" class="btn-payment">
                <i class="fa-solid fa-arrow-right me-2"></i>
                Buka Pembayaran
            </a>

        </div>

    </div>

</div>


        </div>

    </div>

</body>

</html>

