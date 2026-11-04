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
    width: 230px;
    background: linear-gradient(180deg, #1877ed, #1551ad);
    color: #fff;
    padding: 22px 15px 12px;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    z-index: 1000;
}

.brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 5px 20px;
    border-bottom: 1px solid rgba(255,255,255,.18);
    flex-shrink: 0;
}

.brand-icon {
    width: 40px;
    height: 40px;
    flex-shrink: 0;
    border-radius: 9px;
    background: rgba(255,255,255,.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.brand-name {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: white;
}

.brand-subtitle {
    font-size: 9px;
    margin-top: 4px;
    color: #e4efff;
    white-space: nowrap;
}

.menu-label {
    font-size: 10px;
    font-weight: bold;
    letter-spacing: 1px;
    color: #d2e4ff;
    margin: 25px 8px 12px;
}

.menu-link {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
    color: #fff;
    padding: 13px;
    border-radius: 9px;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
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
    padding-left: 10px;
}

.menu-link i {
    width: 18px;
    text-align: center;
    font-size: 16px;
    flex-shrink: 0;
}

.sidebar-bottom {
    margin-top: auto;
    padding-top: 20px;
}

.sidebar-info {
    border: 1px solid rgba(255,255,255,.2);
    background: rgba(255,255,255,.09);
    border-radius: 9px;
    padding: 12px;
    font-size: 10px;
    line-height: 1.7;
    margin-bottom: 12px;
}

.logout-btn {
    display: block;
    width: 100%;
    padding: 12px;
    border-radius: 9px;
    text-align: center;
    background: #fff;
    color: #e63946;
    font-size: 12px;
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
    margin-left: 230px;
    width: calc(100% - 230px);
    min-height: 100vh;
    padding: 32px 35px;
    overflow-wrap: break-word;
}

/* TOPBAR */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
}

/* JUDUL DASHBOARD */
.page-title {
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 8px;
    color: #243650;
}

.page-subtitle {
    font-size: 14px;
    color: #7b8ba5;
    margin: 0;
    line-height: 1.6;
}

/* PROFIL PERAWAT */
.profile {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(20,60,120,.06);
    flex-shrink: 0;
}

.profile-icon {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #1877ed;
    background: #e8f2ff;
    border-radius: 10px;
    font-size: 18px;
}

.profile-name {
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 4px;
}

.profile-role {
    font-size: 11px;
    color: #7b8ba5;
}


/* BANNER SAMBUTAN */
.welcome {
    position: relative;
    overflow: hidden;
    background: linear-gradient(110deg, #1979f5, #1855bd);
    color: white;
    border-radius: 16px;
    padding: 32px;
    margin-bottom: 32px;
    box-shadow: 0 8px 18px rgba(24,103,220,.12);
}

.welcome::before {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    border: 22px solid rgba(255,255,255,.08);
    border-radius: 50%;
    right: 35px;
    top: -85px;
    pointer-events: none;
}

.welcome-content {
    position: relative;
    z-index: 1;
    padding-right: 90px;
}

.welcome h2 {
    font-size: 23px;
    font-weight: 700;
    margin: 0 0 12px;
}

.welcome p {
    font-size: 14px;
    line-height: 1.8;
    max-width: 650px;
    margin: 0;
}

.welcome-icon {
    position: absolute;
    right: 25px;
    top: 50%;
    transform: translateY(-50%);
    width: 60px;
    height: 60px;
    border-radius: 14px;
    background: rgba(255,255,255,.16);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 28px;
}

        /* MENU UTAMA */
        .section-title {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .section-description {
            color: #7b8ba5;
            font-size: 13px;
            margin-bottom: 18px;
        }

        /* KARTU DATA PASIEN SAJA */
.menu-card {
    width: 100%;
    max-width: 600px;
    min-height: 190px;
    background: #fff;
    border-radius: 14px;
    padding: 22px;
    box-shadow: 0 3px 10px rgba(20,60,120,.04);
    display: flex;
    flex-direction: column;
}

.card-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    margin-bottom: 12px;
    color: #1877ed;
    background: #e8f2ff;
}

.menu-card h3 {
    font-size: 17px;
    font-weight: 700;
    margin: 0 0 8px;
}

.menu-card p {
    font-size: 13px;
    color: #7b8ba5;
    line-height: 1.7;
    margin: 0 0 15px;
}

.card-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    border-top: 1px solid #f0f3f8;
    padding-top: 12px;
    margin-top: auto;
    color: #1877ed;
    text-decoration: none;
    font-size: 12px;
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
                padding: 20px 14px;
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
                width: 100%;
                max-width: 100%;
                min-height: 160px;
                padding: 16px;
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

