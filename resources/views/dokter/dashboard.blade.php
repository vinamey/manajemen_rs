
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <style>
        :root {
            --primary: #1877f2;
            --primary-dark: #1048a7;
            --background: #f4f7fc;
            --text: #24334b;
            --muted: #7d8ba1;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
        }

        /* SIDEBAR */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            padding: 27px 18px;
            color: white;
            background: linear-gradient(165deg, #176de0, #1048a7);
            box-shadow: 5px 0 25px rgba(18, 75, 160, .12);
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.18);
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.18);
            border-radius: 14px;
            font-size: 22px;
        }

        .brand h5 {
            margin: 0;
            font-weight: 750;
            letter-spacing: .3px;
        }

        .brand small {
            color: #d9e9ff;
            font-size: 10px;
        }

        .menu-label {
            margin: 28px 12px 12px;
            color: #b9d7ff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 15px;
            margin-bottom: 8px;
            color: #e4efff;
            text-decoration: none;
            border-radius: 12px;
            transition: .2s ease;
            font-size: 13px;
            font-weight: 500;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .menu-link:hover,
        .menu-link.active {
            color: white;
            background: rgba(255,255,255,.17);
        }

        .menu-link.active {
            box-shadow: inset 3px 0 white;
        }

        /* INFORMASI SIDEBAR */
        .sidebar-note {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 85px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 14px;
            background: rgba(255,255,255,.09);
            font-size: 11px;
            color: #e4efff;
            line-height: 1.7;
        }

        /* TOMBOL LOGOUT */
        .logout-area {
            position: absolute;
            bottom: 22px;
            left: 18px;
            right: 18px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 12px;
            background: white;
            color: #dc3545;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .logout-btn:hover {
            background: #ffe8eb;
            color: #b02a37;
        }

        /* KONTEN */
        .main {
            margin-left: 255px;
            min-height: 100vh;
            padding: 30px 34px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 26px;
            font-weight: 750;
            margin: 0;
            letter-spacing: -.5px;
        }

        .page-subtitle {
            margin: 7px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 15px;
            background: white;
            border: 1px solid #e9eef6;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(31,61,100,.04);
        }

        .profile-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            color: var(--primary);
            background: #e8f2ff;
            border-radius: 13px;
            font-size: 18px;
        }

        .profile strong {
            display: block;
            font-size: 12px;
        }

        .profile small {
            color: var(--muted);
            font-size: 11px;
        }

        /* WELCOME */
        .welcome {
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 30px;
            color: white;
            border-radius: 22px;
            background: linear-gradient(115deg, #1877f2, #1456bd);
            box-shadow: 0 12px 30px rgba(24,119,242,.17);
        }

        .welcome::after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: 50px;
            top: -125px;
            border: 35px solid rgba(255,255,255,.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .welcome h2 {
            font-size: 24px;
            font-weight: 750;
            margin-bottom: 10px;
        }

        .welcome p {
            max-width: 520px;
            margin: 0;
            color: #e4efff;
            font-size: 13px;
            line-height: 1.8;
        }

        .welcome-icon {
            position: relative;
            z-index: 1;
            width: 88px;
            height: 88px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 25px;
            background: rgba(255,255,255,.15);
            font-size: 43px;
        }

        /* MENU UTAMA */
        .section-heading {
            margin: 32px 0 18px;
        }

        .section-heading h4 {
            margin: 0;
            font-size: 17px;
            font-weight: 750;
        }

        .section-heading p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 12px;
        }

        .feature-card {
            display: block;
            height: 100%;
            padding: 25px;
            text-decoration: none;
            color: var(--text);
            background: white;
            border: 1px solid #e8edf5;
            border-radius: 19px;
            box-shadow: 0 6px 24px rgba(34,60,100,.035);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .feature-card:hover {
            color: var(--text);
            transform: translateY(-4px);
            box-shadow: 0 14px 32px rgba(34,80,150,.11);
        }

        .feature-icon {
            width: 55px;
            height: 55px;
            display: grid;
            place-items: center;
            border-radius: 16px;
            font-size: 23px;
            margin-bottom: 20px;
        }

        .icon-patient {
            color: #1877f2;
            background: #e8f2ff;
        }

        .icon-prescription {
            color: #087f8c;
            background: #e1f8f7;
        }

        .feature-card h5 {
            font-size: 16px;
            font-weight: 750;
            margin-bottom: 10px;
        }

        .feature-card p {
            min-height: 44px;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .feature-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding-top: 16px;
            border-top: 1px solid #edf1f7;
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
        }

        /* INFORMASI */
        .info-panel {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-top: 25px;
            padding: 19px 21px;
            background: #eaf3ff;
            border: 1px solid #d9e9ff;
            border-radius: 15px;
        }

        .info-panel > i {
            margin-top: 3px;
            color: var(--primary);
            font-size: 18px;
        }

        .info-panel strong {
            font-size: 12px;
        }

        .info-panel p {
            color: #62738b;
            font-size: 12px;
            line-height: 1.7;
            margin: 5px 0 0;
        }

        .footer {
            padding-top: 28px;
            text-align: center;
            color: #98a4b6;
            font-size: 11px;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .sidebar {
                width: 215px;
            }

            .main {
                margin-left: 215px;
                padding: 24px 20px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: 0;
                padding: 18px;
                overflow: visible;
            }

            .brand {
                padding-bottom: 17px;
            }

            .menu-label {
                margin-top: 17px;
            }

            .sidebar-note {
                display: none;
            }

            .logout-area {
                position: static;
                margin-top: 18px;
            }

            .main {
                margin-left: 0;
                padding: 22px 16px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-title {
                font-size: 23px;
            }

            .welcome {
                padding: 23px;
            }

            .welcome h2 {
                font-size: 20px;
            }

            .welcome-icon {
                width: 62px;
                height: 62px;
                border-radius: 18px;
                font-size: 30px;
            }
        }

        @media (max-width: 400px) {
            .welcome-icon {
                display: none;
            }

            .feature-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">
                <i class="fa-solid fa-hospital"></i>
            </div>

            <div>
                <h5>SIM RS</h5>
                <small>Sistem Informasi Rumah Sakit</small>
            </div>
        </div>

        <div class="menu-label">MENU DOKTER</div>

        <a href="{{ route('dokter.dashboard') }}"
           class="menu-link active">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('dokter.pasien.index') }}"
           class="menu-link">
            <i class="fa-solid fa-hospital-user"></i>
            <span>Data Pasien</span>
        </a>

        <a href="{{ route('dokter.resep.index') }}"
           class="menu-link">
            <i class="fa-solid fa-prescription"></i>
            <span>Resep Obat</span>
        </a>

        {{-- INFORMASI SIDEBAR --}}
        <div class="sidebar-note">
            <i class="fa-solid fa-shield-heart me-1"></i>
            <strong>Pelayanan Kesehatan</strong>
            <br>
            Gunakan data pasien dengan teliti dan jaga kerahasiaan informasi medis.
        </div>

        {{-- TOMBOL LOGOUT --}}
        <div class="logout-area">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="main">

        {{-- HEADER --}}
        <div class="topbar">
            <div>
                <h1 class="page-title">Dashboard Dokter</h1>
                <p class="page-subtitle">
                    Kelola informasi pasien dan pelayanan medis.
                </p>
            </div>

            <div class="profile">
                <div class="profile-icon">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <div>
                    <strong>{{ auth()->user()->name ?? 'Dokter' }}</strong>
                    <small>Dokter</small>
                </div>
            </div>
        </div>

        {{-- WELCOME --}}
        <section class="welcome">
            <div>
                <h2>Selamat Datang, Dokter!</h2>
                <p>
                    Selamat bekerja. Melalui dashboard ini, dokter dapat
                    melihat data pasien serta melakukan pemeriksaan dan
                    memberikan resep obat sesuai hasil pemeriksaan.
                </p>
            </div>

            <div class="welcome-icon">
                <i class="fa-solid fa-user-doctor"></i>
            </div>
        </section>

        {{-- MENU UTAMA --}}
        <div class="section-heading">
            <h4>Menu Utama</h4>
            <p>Pilih fitur yang ingin kamu gunakan.</p>
        </div>

        <div class="row g-4">

            {{-- KARTU DATA PASIEN --}}
            <div class="col-md-6">
                <a href="{{ route('dokter.pasien.index') }}"
                   class="feature-card">

                    <div class="feature-icon icon-patient">
                        <i class="fa-solid fa-hospital-user"></i>
                    </div>

                    <h5>Data Pasien</h5>

                    <p>
                        Melihat informasi pasien yang terdaftar,
                        termasuk identitas dan data pendaftaran pasien.
                    </p>

                    <div class="feature-action">
                        <span>Lihat Data Pasien</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            </div>

            {{-- KARTU PEMERIKSAAN DAN RESEP --}}
            <div class="col-md-6">
                <a href="{{ route('dokter.pemeriksaan.index') }}"
                   class="feature-card">

                    <div class="feature-icon icon-prescription">
                        <i class="fa-solid fa-prescription"></i>
                    </div>

                    <h5>Pemeriksaan &amp; Resep Obat</h5>

                    <p>
                        Melakukan pemeriksaan pasien dan memberikan
                        resep obat berdasarkan hasil pemeriksaan.
                    </p>

                    <div class="feature-action">
                        <span>Buka Pemeriksaan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </a>
            </div>

        </div>

        {{-- INFORMASI --}}
        <div class="info-panel">
            <i class="fa-solid fa-circle-info"></i>

            <div>
                <strong>Informasi</strong>
                <p>
                    Pastikan identitas pasien sudah benar sebelum
                    melakukan pemeriksaan atau memberikan resep obat.
                </p>
            </div>
        </div>

        {{-- FOOTER --}}
        <div class="footer">
            &copy; {{ date('Y') }} SIM RS — Sistem Informasi Rumah Sakit
        </div>

    </main>

</body>
</html>
