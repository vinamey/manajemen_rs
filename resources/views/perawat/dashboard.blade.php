<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat - SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fc;
            color: #243650;
            font-size: 13px;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 170px;
            background: linear-gradient(180deg, #1877ed, #1551ad);
            color: #fff;
            padding: 18px 12px 10px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 5px 17px;
            border-bottom: 1px solid rgba(255,255,255,.18);
            flex-shrink: 0;
        }

        .brand-icon {
            width: 30px;
            height: 30px;
            flex-shrink: 0;
            border-radius: 8px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .brand-name {
            font-size: 14px;
            font-weight: 700;
            margin: 0;
            color: white;
        }

        .brand-subtitle {
            font-size: 6px;
            margin-top: 3px;
            color: #e4efff;
            white-space: nowrap;
        }

        .menu-label {
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #d2e4ff;
            margin: 20px 7px 9px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 9px;
            width: 100%;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 9px;
            font-weight: 600;
            margin-bottom: 4px;
            transition: background .2s;
            flex-shrink: 0;
        }

        .menu-link:hover,
        .menu-link.active {
            color: #fff;
            background: rgba(255,255,255,.2);
        }

        .menu-link.active {
            border-left: 3px solid white;
            padding-left: 7px;
        }

        .menu-link i {
            width: 14px;
            text-align: center;
            font-size: 12px;
            flex-shrink: 0;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .sidebar-info {
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.09);
            border-radius: 8px;
            padding: 9px;
            font-size: 7px;
            line-height: 1.7;
            margin-bottom: 10px;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            background: #fff;
            color: #e63946;
            font-size: 9px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #fff0f0;
            color: #c82333;
        }

        /* AREA KONTEN UTAMA */
        .main {
            margin-left: 170px;
            width: calc(100% - 170px);
            min-height: 100vh;
            padding: 24px;
            overflow-wrap: break-word;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .page-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 6px;
            color: #243650;
        }

        .page-subtitle {
            font-size: 10px;
            color: #7b8ba5;
            margin: 0;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 8px 11px;
            background: white;
            border-radius: 11px;
            box-shadow: 0 3px 15px rgba(20,60,120,.04);
            flex-shrink: 0;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1877ed;
            background: #e8f2ff;
            border-radius: 8px;
        }

        .profile-name {
            font-size: 9px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .profile-role {
            font-size: 8px;
            color: #7b8ba5;
        }

        /* BANNER SAMBUTAN */
        .welcome {
            position: relative;
            overflow: hidden;
            background: linear-gradient(110deg, #1979f5, #1855bd);
            color: white;
            border-radius: 14px;
            padding: 23px 22px;
            margin-bottom: 24px;
            box-shadow: 0 8px 18px rgba(24,103,220,.12);
        }

        .welcome::before {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            border: 20px solid rgba(255,255,255,.08);
            border-radius: 50%;
            right: 35px;
            top: -75px;
            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 1;
            padding-right: 75px;
        }

        .welcome h2 {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .welcome p {
            font-size: 10px;
            line-height: 1.8;
            max-width: 480px;
            margin: 0;
        }

        .welcome-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,.16);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        /* MENU UTAMA */
        .section-title {
            font-size: 13px;
            font-weight: 700;
            margin: 0 0 6px;
        }

        .section-description {
            color: #7b8ba5;
            font-size: 9px;
            margin: 0 0 13px;
        }

        /* KARTU DATA PASIEN SAJA */
        .menu-card {
            width: 30%;
            min-height: 115px;
            background: #fff;
            border-radius: 12px;
            padding: 13px 15px;
            box-shadow: 0 3px 10px rgba(20,60,120,.04);
            display: flex;
            flex-direction: column;
        }

        .card-icon {
            width: 29px;
            height: 29px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-bottom: 8px;
            color: #1877ed;
            background: #e8f2ff;
        }

        .menu-card h3 {
            font-size: 11px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .menu-card p {
            font-size: 8px;
            color: #7b8ba5;
            line-height: 1.6;
            margin: 0 0 10px;
        }

        .card-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border-top: 1px solid #f0f3f8;
            padding-top: 8px;
            margin-top: auto;
            color: #1877ed;
            text-decoration: none;
            font-size: 8px;
            font-weight: 700;
        }

        .card-link:hover {
            color: #0f58c6;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            color: #8a9bb5;
            font-size: 8px;
            padding: 22px 0 8px;
        }

        /* RESPONSIVE */
        @media (max-width: 650px) {
            .sidebar {
                width: 62px;
                padding: 15px 7px 10px;
            }

            .brand {
                justify-content: center;
                padding: 0 0 15px;
            }

            .brand-text,
            .menu-label,
            .menu-link span,
            .sidebar-info,
            .logout-text {
                display: none;
            }

            .menu-link {
                justify-content: center;
                padding: 11px 5px;
            }

            .menu-link.active {
                padding-left: 5px;
            }

            .menu-link i {
                font-size: 14px;
            }

            .main {
                margin-left: 62px;
                width: calc(100% - 62px);
                padding: 16px 12px;
            }

            .topbar {
                align-items: flex-start;
            }

            .page-title {
                font-size: 15px;
            }

            .page-subtitle {
                max-width: 220px;
                line-height: 1.5;
            }

            .profile {
                padding: 6px;
                gap: 5px;
            }

            .profile-icon {
                width: 25px;
                height: 25px;
            }

            .welcome {
                padding: 18px 14px;
                margin-bottom: 20px;
            }

            .welcome h2 {
                font-size: 13px;
            }

            .welcome p {
                font-size: 9px;
            }

            .welcome-content {
                padding-right: 42px;
            }

            .welcome-icon {
                right: 10px;
                width: 35px;
                height: 35px;
                font-size: 16px;
            }

            .menu-card {
                min-height: 115px;
                padding: 12px;
            }
        }
    </style>
</head>

<body>

@php
    $user = auth()->user();
@endphp

{{-- SIDEBAR --}}
<aside class="sidebar">

    <div class="brand">
        <div class="brand-icon">
            <i class="fas fa-hospital"></i>
        </div>

        <div class="brand-text">
            <div class="brand-name">SIM RS</div>
            <div class="brand-subtitle">Sistem Informasi Rumah Sakit</div>
        </div>
    </div>

    <div class="menu-label">MENU PERAWAT</div>

    <a href="{{ route('perawat.dashboard') }}"
       class="menu-link active">
        <i class="fas fa-house"></i>
        <span>Dashboard</span>
    </a>

    <a href="{{ route('perawat.pasien.index') }}"
       class="menu-link">
        <i class="fas fa-hospital-user"></i>
        <span>Data Pasien</span>
    </a>

    <div class="sidebar-bottom">
        <div class="sidebar-info">
            <strong>
                <i class="fas fa-shield-heart me-1"></i>
                Pelayanan Kesehatan
            </strong>
            <br>
            Gunakan data pasien dengan teliti dan jaga kerahasiaan informasi medis.
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-right-from-bracket me-1"></i>
                <span class="logout-text">Logout</span>
            </button>
        </form>
    </div>

</aside>

{{-- KONTEN DASHBOARD --}}
<main class="main">

    <header class="topbar">
        <div>
            <h1 class="page-title">Dashboard Perawat</h1>
            <p class="page-subtitle">
                Kelola informasi pasien untuk pelayanan keperawatan.
            </p>
        </div>

        <div class="profile">
            <div class="profile-icon">
                <i class="fas fa-user-nurse"></i>
            </div>

            <div>
                <div class="profile-name">
                    {{ $user->name ?? 'Perawat' }}
                </div>
                <div class="profile-role">Perawat</div>
            </div>
        </div>
    </header>

    {{-- BANNER SAMBUTAN --}}
    <section class="welcome">
        <div class="welcome-content">
            <h2>Selamat Datang, Perawat!</h2>
            <p>
                Selamat bekerja. Melalui dashboard ini, kamu dapat
                melihat data pasien untuk mendukung pelayanan
                keperawatan di rumah sakit.
            </p>
        </div>

        <div class="welcome-icon">
            <i class="fas fa-user-nurse"></i>
        </div>
    </section>

    {{-- MENU UTAMA: HANYA DATA PASIEN --}}
    <section>
        <h2 class="section-title">Menu Utama</h2>


        <div class="menu-card">
            <div class="card-icon">
                <i class="fas fa-hospital-user"></i>
            </div>

            <h3>Data Pasien</h3>

            <p>
                Melihat informasi pasien yang terdaftar,
                termasuk nama dan informasi pasien rumah sakit.
            </p>

            <a href="{{ route('perawat.pasien.index') }}" class="card-link">
                <span>Lihat Data Pasien</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>

    

</main>

</body>
</html>

