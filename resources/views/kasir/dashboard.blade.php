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

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--blue-main);
            color: white;
            z-index: 1000;
        }

        .logo {
            height: 65px;
            display: flex;
            align-items: center;
            padding-left: 25px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .logo i {
            margin-right: 10px;
        }

        .menu {
            padding: 20px 12px;
        }

        .menu-title {
            font-size: 12px;
            opacity: .7;
            padding: 0 13px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,.16);
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        .logout-area {
            position: absolute;
            bottom: 15px;
            width: 100%;
            padding: 0 15px;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: white;
            color: #dc3545;
            padding: 10px;
            border-radius: 8px;
            font-weight: 600;
        }

        /* CONTENT */
        .content {
            margin-left: 250px;
            min-height: 100vh;
        }

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
            font-size: 14px;
            color: #555;
        }

        .page {
            padding: 28px;
        }

        .page-title {
            color: var(--blue-main);
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* WELCOME */
        .welcome-card {
            background: white;
            border-radius: 15px;
            border: 1px solid #e5e7eb;
            padding: 25px;
            margin-bottom: 25px;
        }

        .welcome-card h4 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-card p {
            color: #6b7280;
            margin-bottom: 0;
        }

        /* STAT CARD */
        .stat-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            padding: 20px;
            height: 100%;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            margin-bottom: 15px;
        }

        .stat-title {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
        }

        /* PAYMENT CARD */
     .payment-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 15px;
    padding: 45px;
    margin-top: 25px;
    width: fit-content;
    min-width: 400px;
}

        .payment-card h5 {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .payment-card p {
            color: #6b7280;
            font-size: 14px;
        }

        .btn-payment {
            background: var(--blue-main);
            color: white;
            border: none;
            padding: 11px 20px;
            border-radius: 9px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        .btn-payment:hover {
            background: var(--blue-dark);
            color: white;
        }

        .btn-payment:disabled {
    background: #9ca3af;
    color: white;
    cursor: not-allowed;
    opacity: 0.7;
}
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-hospital"></i>
            SIM RS
        </div>

       <div class="menu">

    <div class="menu-title">
        Menu Kasir
    </div>

    <a
        href="{{ route('kasir.dashboard') }}"
        class="active"
    >
        <i class="fa-solid fa-house"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('kasir.resep') }}">
        <i class="fa-solid fa-file-prescription"></i>
        <span>Resep dari Dokter</span>
    </a>

    <a href="{{ route('kasir.pembayaran') }}">
        <i class="fa-solid fa-money-bill-wave"></i>
        <span>Pembayaran Obat</span>
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


    {{-- CONTENT --}}
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
                    Silakan gunakan menu Pembayaran Obat untuk memproses pembayaran pasien.
                </p>

            </div>


            {{-- STAT --}}
            <div class="row g-4">

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


                <div class="col-md-4">

                    <div class="stat-card">

                        <div class="stat-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>

                        <div class="stat-title">
    Resep Menunggu Pembayaran
</div>

<div class="stat-value">
    {{ $jumlahResepMenunggu }}
</div>

                    </div>

                </div>


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


{{-- PAYMENT MENU --}}
<div class="payment-card">

    <h5>
        <i class="fa-solid fa-money-bill-wave text-primary me-2"></i>
        Pembayaran Obat
    </h5>

    <p>
        Lihat resep pasien dan proses pembayaran obat.
    </p>

    <a href="{{ route('kasir.pembayaran') }}" class="btn-payment">
        <i class="fa-solid fa-arrow-right me-2"></i>
        Buka Pembayaran
    </a>

</div>


            </div>

        </div>

    </div>

</body>
</html>
