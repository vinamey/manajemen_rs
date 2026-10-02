<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Kasir</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--blue-main);
            color: white;
            z-index: 1000;
        }

        .logo {
            height: 68px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .logo i {
            margin-right: 10px;
        }

        .menu {
            padding: 18px 10px;
        }

        .menu-title {
            font-size: 10px;
            opacity: .7;
            padding: 0 10px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 11px 12px;
            margin-bottom: 4px;
            border-radius: 8px;
            font-size: 13px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,.16);
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        /* =========================
           LOGOUT
        ========================= */

        .logout-area {
            position: absolute;
            bottom: 10px;
            width: 100%;
            padding: 0 12px;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: white;
            color: #dc3545;
            padding: 9px;
            border-radius: 7px;
            font-weight: 600;
            font-size: 13px;
        }

        .logout-btn:hover {
            background: #f8f9fa;
        }

        /* =========================
           CONTENT
        ========================= */

        .content {
            margin-left: 200px;
            min-height: 100vh;
        }

        .topbar {
            height: 68px;
            background: white;
            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 22px;
        }

        .topbar-title {
            font-size: 13px;
            font-weight: 600;
            color: #222;
        }

        .user-info {
            font-size: 13px;
            color: #555;
        }

        .page {
            padding: 25px 22px;
        }

        .page-title {
            color: var(--blue-main);
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 24px;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 25px;
        }

        /* =========================
           WELCOME CARD
        ========================= */

        .welcome-card {
            background: white;
            border-radius: 13px;
            border: 1px solid #e5e7eb;
            padding: 22px;
            margin-bottom: 20px;
        }

        .welcome-card h4 {
            font-weight: 700;
            margin-bottom: 7px;
            font-size: 20px;
        }

        .welcome-card p {
            color: #6b7280;
            margin-bottom: 0;
            font-size: 13px;
        }

        /* =========================
           STAT CARD
        ========================= */

        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 13px;
            padding: 16px;
            height: 100%;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 8px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 16px;
            margin-bottom: 13px;
        }

        .stat-title {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 21px;
            font-weight: 700;
            color: #1f2937;
        }

        /* =========================
           PAYMENT CARD
        ========================= */

        .payment-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 13px;
            padding: 22px;
            margin-top: 20px;
        }

        .payment-card h5 {
            font-weight: 700;
            margin-bottom: 6px;
            font-size: 17px;
        }

        .payment-card p {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .btn-payment {
            background: var(--blue-main);
            color: white;
            border: none;
            padding: 10px 17px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-payment:hover {
            background: var(--blue-dark);
            color: white;
        }

    </style>

</head>

<body>


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <div class="sidebar">

        {{-- LOGO --}}
        <div class="logo">

            <i class="fa-solid fa-hospital"></i>

            SIM RS

        </div>


        {{-- MENU --}}
        <div class="menu">

            <div class="menu-title">
                Menu Kasir
            </div>


            {{-- DASHBOARD --}}
            <a
                href="{{ route('kasir.dashboard') }}"
                class="active"
            >

                <i class="fa-solid fa-house"></i>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- RESEP DARI DOKTER --}}
            <a href="{{ route('kasir.resep') }}">

                <i class="fa-solid fa-file-prescription"></i>

                <span>
                    Resep dari Dokter
                </span>

            </a>


            {{-- PEMBAYARAN OBAT --}}
            <a href="{{ route('kasir.pembayaran') }}">

                <i class="fa-solid fa-money-bill-wave"></i>

                <span>
                    Pembayaran Obat
                </span>

            </a>

        </div>


        {{-- LOGOUT --}}
        <div class="logout-area">

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout-btn"
                >

                    <i class="fa-solid fa-right-from-bracket me-2"></i>

                    Logout

                </button>

            </form>

        </div>

    </div>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <div class="content">


        {{-- TOPBAR --}}
        <div class="topbar">

            <div class="topbar-title">
                Dashboard Kasir
            </div>


            <div class="user-info">

                <i class="fa-solid fa-user me-2"></i>

                {{ auth()->user()->name }}

            </div>

        </div>


        {{-- PAGE --}}
        <div class="page">


            {{-- TITLE --}}
            <h3 class="page-title">
                Dashboard Kasir
            </h3>

            <div class="page-subtitle">
                Kelola pembayaran obat pasien
            </div>


            {{-- WELCOME --}}
            <div class="welcome-card">

                <h4>
                    Selamat Datang, {{ auth()->user()->name }}!
                </h4>

                <p>
                    Silakan gunakan menu Kasir untuk melihat resep dokter
                    dan memproses pembayaran obat pasien.
                </p>

            </div>


            {{-- =================================================
                 STATISTIK
            ================================================== --}}

            <div class="row g-3">


                {{-- PEMBAYARAN HARI INI --}}
                <div class="col-md-4">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="fa-solid fa-receipt"></i>

                        </div>

                        <div class="stat-title">
                            Pembayaran Hari Ini
                        </div>

                        <div class="stat-value">
                            0
                        </div>

                    </div>

                </div>


                {{-- RESEP MENUNGGU PEMBAYARAN --}}
                <div class="col-md-4">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="fa-solid fa-file-prescription"></i>

                        </div>

                        <div class="stat-title">
                            Resep Menunggu Pembayaran
                        </div>

                        <div class="stat-value">
                            0
                        </div>

                    </div>

                </div>


                {{-- TOTAL PENDAPATAN --}}
                <div class="col-md-4">

                    <div class="stat-card">

                        <div class="stat-icon">

                            <i class="fa-solid fa-money-bill"></i>

                        </div>

                        <div class="stat-title">
                            Total Pendapatan
                        </div>

                        <div class="stat-value">
                            Rp0
                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 PEMBAYARAN OBAT
            ================================================== --}}

            <div class="payment-card">

                <h5>

                    <i class="fa-solid fa-money-bill-wave text-primary me-2"></i>

                    Pembayaran Obat

                </h5>

                <p>
                    Lihat resep yang perlu diproses dan lakukan pembayaran obat pasien.
                </p>


                <a
                    href="{{ route('kasir.pembayaran') }}"
                    class="btn-payment"
                >

                    <i class="fa-solid fa-credit-card me-2"></i>

                    Buka Pembayaran

                </a>

            </div>


        </div>

    </div>


</body>

</html>
