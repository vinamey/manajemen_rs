
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin - MEDIXA</title>


    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <!-- Bootstrap Icons -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
          rel="stylesheet">


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            background: #f4f8fc;

            font-family:
                'Segoe UI',
                Tahoma,
                Geneva,
                Verdana,
                sans-serif;

            color: #1e293b;

            overflow-x: hidden;
        }


        /* =====================================================
           ANIMATIONS
        ===================================================== */


        @keyframes floating {

            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }

        }


        @keyframes pulse {

            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }

        }


        @keyframes glow {

            0% {
                box-shadow:
                    0 0 0 rgba(255,255,255,0);
            }

            50% {
                box-shadow:
                    0 0 25px rgba(255,255,255,0.25);
            }

            100% {
                box-shadow:
                    0 0 0 rgba(255,255,255,0);
            }

        }


        @keyframes fadeUp {

            from {

                opacity: 0;

                transform:
                    translateY(25px);

            }

            to {

                opacity: 1;

                transform:
                    translateY(0);

            }

        }


        @keyframes shine {

            0% {
                transform:
                    translateX(-100%);
            }

            100% {
                transform:
                    translateX(100%);
            }

        }


        @keyframes heartbeat {

            0% {
                transform: scale(1);
            }

            25% {
                transform: scale(1.12);
            }

            40% {
                transform: scale(1);
            }

            60% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }

        }


        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {

            position: fixed;

            left: 0;

            top: 0;

            width: 265px;

            height: 100vh;

            background:
                linear-gradient(
                    180deg,
                    #075985,
                    #0369a1,
                    #0284c7
                );

            color: white;

            z-index: 1000;

            box-shadow:
                8px 0 30px
                rgba(15,23,42,0.10);

            overflow-y: auto;
        }


        /* LOGO */

        .logo-area {

            padding:
                30px 20px;

            text-align: center;

            border-bottom:
                1px solid
                rgba(255,255,255,0.15);
        }


        .logo-icon {

            width: 65px;

            height: 65px;

            margin:
                0 auto 14px;

            border-radius: 20px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(255,255,255,0.16);

            border:
                1px solid
                rgba(255,255,255,0.25);

            font-size: 30px;

            animation:
                heartbeat 2.5s
                ease-in-out infinite;

            box-shadow:
                0 10px 25px
                rgba(0,0,0,0.08);
        }


        .logo-title {

            font-size: 22px;

            font-weight: 800;

            margin: 0;

            letter-spacing: 1px;
        }


        .logo-subtitle {

            display: block;

            margin-top: 5px;

            font-size: 10px;

            color:
                rgba(255,255,255,0.70);
        }


        /* MENU TITLE */

        .menu-title {

            padding:
                25px 22px 8px;

            font-size: 10px;

            font-weight: 700;

            letter-spacing: 1.5px;

            color:
                rgba(255,255,255,0.50);

            text-transform: uppercase;
        }


        /* MENU */

        .menu a {

            display: flex;

            align-items: center;

            gap: 13px;

            margin:
                5px 13px;

            padding:
                13px 15px;

            border-radius: 13px;

            color:
                rgba(255,255,255,0.82);

            text-decoration: none;

            font-size: 14px;

            font-weight: 500;

            transition:
                all .3s ease;
        }


        .menu a i {

            width: 22px;

            text-align: center;

            font-size: 18px;

            transition:
                transform .3s ease;
        }


        .menu a:hover {

            color: white;

            background:
                rgba(255,255,255,0.14);

            transform:
                translateX(5px);
        }


        .menu a:hover i {

            transform:
                scale(1.2)
                rotate(-5deg);
        }


        .menu a.active {

            color: white;

            background:
                rgba(255,255,255,0.18);

            box-shadow:
                inset 4px 0 0 white,
                0 5px 15px
                rgba(0,0,0,0.05);
        }


        /* =====================================================
           MAIN CONTENT
        ===================================================== */

        .main-content {

            margin-left: 265px;

            min-height: 100vh;

            padding:
                28px 32px;
        }


        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {

            background: white;

            border:
                1px solid #e2e8f0;

            border-radius: 20px;

            padding:
                18px 22px;

            margin-bottom: 25px;

            display: flex;

            justify-content:
                space-between;

            align-items: center;

            box-shadow:
                0 6px 22px
                rgba(15,23,42,0.04);

            animation:
                fadeUp .7s ease both;
        }


        .welcome-title {

            font-size: 22px;

            font-weight: 800;

            margin-bottom: 4px;
        }


        .welcome-text {

            color: #64748b;

            font-size: 13px;

            margin: 0;
        }


        .admin-profile {

            display: flex;

            align-items: center;

            gap: 11px;
        }


        .admin-icon {

            width: 45px;

            height: 45px;

            border-radius: 14px;

            background: #e0f2fe;

            color: #0284c7;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 20px;

            animation:
                floating 3s
                ease-in-out infinite;
        }


        .admin-name {

            font-weight: 700;

            font-size: 13px;

            margin: 0;
        }


        .admin-role {

            color: #64748b;

            font-size: 11px;

            margin:
                2px 0 0;
        }


        /* =====================================================
           WELCOME BANNER
        ===================================================== */

        .welcome-banner {

            position: relative;

            overflow: hidden;

            background:
                linear-gradient(
                    135deg,
                    #075985,
                    #0369a1,
                    #0284c7,
                    #0ea5e9
                );

            background-size:
                300% 300%;

            border-radius: 24px;

            padding: 30px;

            color: white;

            margin-bottom: 25px;

            box-shadow:
                0 15px 35px
                rgba(2,132,199,0.20);

            animation:
                gradientMove 8s
                ease infinite,
                fadeUp .8s ease both;
        }


        @keyframes gradientMove {

            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }

        }


        .welcome-banner::before {

            content: "";

            position: absolute;

            width: 270px;

            height: 270px;

            border-radius: 50%;

            right: -80px;

            top: -120px;

            background:
                rgba(255,255,255,0.08);

            animation:
                floating 5s
                ease-in-out infinite;
        }


        .welcome-banner::after {

            content: "";

            position: absolute;

            width: 150px;

            height: 150px;

            border-radius: 50%;

            right: 130px;

            bottom: -90px;

            background:
                rgba(255,255,255,0.06);

        }


        .banner-content {

            position: relative;

            z-index: 2;
        }


        .welcome-banner h2 {

            font-size: 27px;

            font-weight: 800;

            margin-bottom: 8px;
        }


        .welcome-banner p {

            color:
                rgba(255,255,255,0.82);

            font-size: 13px;

            max-width: 680px;

            margin-bottom: 18px;
        }


        .date-badge {

            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding:
                8px 13px;

            border-radius: 11px;

            background:
                rgba(255,255,255,0.13);

            border:
                1px solid
                rgba(255,255,255,0.12);

            font-size: 11px;

            font-weight: 600;

            animation:
                glow 3s
                ease-in-out infinite;
        }


        /* =====================================================
           STAT CARD
        ===================================================== */

        .stat-card {

            position: relative;

            overflow: hidden;

            background: white;

            border:
                1px solid #e2e8f0;

            border-radius: 20px;

            padding: 23px;

            height: 100%;

            box-shadow:
                0 6px 20px
                rgba(15,23,42,0.035);

            opacity: 0;

            animation:
                fadeUp .8s
                ease forwards;

            transition:
                all .3s ease;
        }


        .stat-card:nth-child(1) {
            animation-delay: .15s;
        }


        .stat-card:nth-child(2) {
            animation-delay: .3s;
        }


        .stat-card:nth-child(3) {
            animation-delay: .45s;
        }


        .stat-card:hover {

            transform:
                translateY(-7px);

            box-shadow:
                0 18px 35px
                rgba(15,23,42,0.10);
        }


        .stat-card::after {

            content: "";

            position: absolute;

            width: 100px;

            height: 100px;

            border-radius: 50%;

            right: -40px;

            bottom: -40px;

            background:
                rgba(14,165,233,0.05);
        }


        /* ICON */

        .stat-icon {

            width: 55px;

            height: 55px;

            border-radius: 16px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 23px;

            margin-bottom: 17px;

            animation:
                floating 3s
                ease-in-out infinite;
        }


        .stat-card:nth-child(1)
        .stat-icon {

            animation-delay: 0s;
        }


        .stat-card:nth-child(2)
        .stat-icon {

            animation-delay: .5s;
        }


        .stat-card:nth-child(3)
        .stat-icon {

            animation-delay: 1s;
        }


        .blue {

            background: #e0f2fe;

            color: #0284c7;
        }


        .green {

            background: #dcfce7;

            color: #16a34a;
        }


        .cyan {

            background: #cffafe;

            color: #0891b2;
        }


        .purple {

            background: #f3e8ff;

            color: #9333ea;
        }


        .orange {

            background: #ffedd5;

            color: #ea580c;
        }


        .stat-label {

            font-size: 11px;

            color: #64748b;

            font-weight: 700;

            letter-spacing: .5px;

            margin-bottom: 5px;
        }


        .stat-number {

            font-size: 30px;

            font-weight: 800;

            color: #0f172a;

            margin: 0;
        }


        /* =====================================================
           SECTION CARD
        ===================================================== */

        .section-card {

            background: white;

            border:
                1px solid #e2e8f0;

            border-radius: 21px;

            padding: 24px;

            height: 100%;

            box-shadow:
                0 6px 20px
                rgba(15,23,42,0.035);

            animation:
                fadeUp 1s ease both;
        }


        .section-title {

            font-size: 16px;

            font-weight: 800;

            margin-bottom: 4px;
        }


        .section-subtitle {

            color: #64748b;

            font-size: 11px;

            margin-bottom: 20px;
        }


        /* =====================================================
           QUICK MENU
        ===================================================== */

        .quick-menu {

            display: grid;

            grid-template-columns:
                repeat(2, 1fr);

            gap: 12px;
        }


        .quick-link {

            text-decoration: none;

            color: #334155;

            border:
                1px solid #e2e8f0;

            border-radius: 15px;

            padding: 14px;

            display: flex;

            align-items: center;

            gap: 12px;

            background: #fafcff;

            transition:
                all .3s ease;
        }


        .quick-link:hover {

            color: #0284c7;

            border-color: #7dd3fc;

            background: #f0f9ff;

            transform:
                translateY(-4px);

            box-shadow:
                0 10px 22px
                rgba(14,165,233,0.10);
        }


        .quick-icon {

            width: 42px;

            height: 42px;

            flex-shrink: 0;

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 18px;

            animation:
                floating 3.5s
                ease-in-out infinite;
        }


        .quick-link:nth-child(1)
        .quick-icon {
            animation-delay: 0s;
        }


        .quick-link:nth-child(2)
        .quick-icon {
            animation-delay: .4s;
        }


        .quick-link:nth-child(3)
        .quick-icon {
            animation-delay: .8s;
        }


        .quick-link:nth-child(4)
        .quick-icon {
            animation-delay: 1.2s;
        }


        .quick-link:nth-child(5)
        .quick-icon {
            animation-delay: 1.6s;
        }


        .quick-name {

            font-size: 12px;

            font-weight: 700;

            margin: 0;
        }


        .quick-desc {

            font-size: 10px;

            color: #94a3b8;

            margin:
                3px 0 0;
        }


        /* =====================================================
           INFORMATION
        ===================================================== */

        .info-item {

            display: flex;

            align-items: center;

            gap: 12px;

            padding:
                13px 0;

            border-bottom:
                1px solid #f1f5f9;
        }


        .info-item:last-child {

            border-bottom: none;
        }


        .info-icon {

            width: 40px;

            height: 40px;

            flex-shrink: 0;

            border-radius: 12px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #f0f9ff;

            color: #0284c7;

            font-size: 17px;

            transition:
                all .3s ease;
        }


        .info-item:hover .info-icon {

            transform:
                rotate(8deg)
                scale(1.08);
        }


        .info-text strong {

            display: block;

            font-size: 12px;

            color: #334155;
        }


        .info-text span {

            display: block;

            font-size: 10px;

            color: #94a3b8;

            margin-top: 2px;
        }


        /* =====================================================
           ONLINE STATUS
        ===================================================== */

        .status-online {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            color: #16a34a !important;

            font-weight: 600;
        }


        .status-dot {

            width: 8px;

            height: 8px;

            border-radius: 50%;

            background: #22c55e;

            display: inline-block;

            animation:
                pulse 1.5s
                infinite;

            box-shadow:
                0 0 0 4px
                #dcfce7;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .dashboard-footer {

            margin-top: 25px;

            padding: 18px;

            text-align: center;

            color: #94a3b8;

            font-size: 11px;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991px) {

            .sidebar {

                position: relative;

                width: 100%;

                height: auto;
            }


            .main-content {

                margin-left: 0;

                padding: 20px;
            }


            .topbar {

                flex-direction: column;

                align-items: flex-start;

                gap: 15px;
            }

        }


        @media (max-width: 575px) {

            .main-content {

                padding: 15px;
            }


            .welcome-banner {

                padding: 22px;
            }


            .welcome-banner h2 {

                font-size: 21px;
            }


            .quick-menu {

                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<div class="sidebar">


    <div class="logo-area">


        <div class="logo-icon">

            <i class="bi bi-hospital-fill"></i>

        </div>


        <h4 class="logo-title">

            MEDIXA

        </h4>


        <span class="logo-subtitle">

            Hospital Management System

        </span>

    </div>



    <div class="menu-title">

        Menu Utama

    </div>



    <div class="menu">


        <a href="/dashboard"
           class="active">

            <i class="bi bi-grid-1x2-fill"></i>

            <span>
                Dashboard
            </span>

        </a>


        <a href="/master-pasien">

            <i class="bi bi-people-fill"></i>

            <span>
                Data Pasien
            </span>

        </a>


        <a href="/master-dokters">

            <i class="bi bi-person-badge-fill"></i>

            <span>
                Data Dokter
            </span>

        </a>


        <a href="/master-perawat">

            <i class="bi bi-heart-pulse-fill"></i>

            <span>
                Data Perawat
            </span>

        </a>


        <a href="/master-apoteker">

            <i class="bi bi-capsule"></i>

            <span>
                Data Apoteker
            </span>

        </a>


        <a href="/kasir">

            <i class="bi bi-cash-stack"></i>

            <span>
                Data Kasir
            </span>

        </a>


    </div>

</div>



<!-- =====================================================
     MAIN CONTENT
===================================================== -->

<div class="main-content">


    <!-- TOPBAR -->

    <div class="topbar">


        <div>

            <h1 class="welcome-title">

                Dashboard Admin

            </h1>


            <p class="welcome-text">

                Kelola data operasional rumah sakit dengan mudah.

            </p>

        </div>



        <div class="admin-profile">


            <div class="admin-icon">

                <i class="bi bi-person-fill"></i>

            </div>


            <div>

                <p class="admin-name">

                    Administrator

                </p>


                <p class="admin-role">

                    Admin Rumah Sakit

                </p>

            </div>

        </div>

    </div>



    <!-- =================================================
         WELCOME BANNER
    ================================================== -->

    <div class="welcome-banner">


        <div class="banner-content">


            <h2>

                Selamat Datang di MEDIXA 👋

            </h2>


            <p>

                Sistem Informasi Manajemen Rumah Sakit untuk membantu
                pengelolaan data pasien, tenaga medis, apoteker,
                dan kasir secara lebih mudah.

            </p>


            <div class="date-badge">

                <i class="bi bi-calendar3"></i>

                {{ date('d F Y') }}

            </div>

        </div>

    </div>



    <!-- =================================================
         STATISTICS
    ================================================== -->

    <div class="row g-4 mb-4">


        <!-- PASIEN -->

        <div class="col-sm-6 col-xl-4">

            <div class="stat-card">


                <div class="stat-icon blue">

                    <i class="bi bi-people-fill"></i>

                </div>


                <div class="stat-label">

                    TOTAL PASIEN

                </div>


                <h2 class="stat-number counter"
                    data-target="{{ $totalPasien }}">

                    0

                </h2>

            </div>

        </div>



        <!-- DOKTER -->

        <div class="col-sm-6 col-xl-4">

            <div class="stat-card">


                <div class="stat-icon green">

                    <i class="bi bi-person-badge-fill"></i>

                </div>


                <div class="stat-label">

                    TOTAL DOKTER

                </div>


                <h2 class="stat-number counter"
                    data-target="{{ $totalDokter }}">

                    0

                </h2>

            </div>

        </div>



        <!-- PERAWAT -->

        <div class="col-sm-6 col-xl-4">

            <div class="stat-card">


                <div class="stat-icon cyan">

                    <i class="bi bi-heart-pulse-fill"></i>

                </div>


                <div class="stat-label">

                    TOTAL PERAWAT

                </div>


                <h2 class="stat-number counter"
                    data-target="{{ $totalPerawat }}">

                    0

                </h2>

            </div>

        </div>

    </div>



    <!-- =================================================
         LOWER SECTION
    ================================================== -->

    <div class="row g-4">


        <!-- QUICK MENU -->

        <div class="col-lg-7">


            <div class="section-card">


                <h3 class="section-title">

                    Menu Cepat

                </h3>


                <p class="section-subtitle">

                    Akses data rumah sakit dengan cepat.

                </p>



                <div class="quick-menu">


                    <a href="/master-pasien"
                       class="quick-link">


                        <div class="quick-icon blue">

                            <i class="bi bi-people-fill"></i>

                        </div>


                        <div>

                            <p class="quick-name">

                                Data Pasien

                            </p>


                            <p class="quick-desc">

                                Kelola data pasien

                            </p>

                        </div>

                    </a>



                    <a href="/master-dokters"
                       class="quick-link">


                        <div class="quick-icon green">

                            <i class="bi bi-person-badge-fill"></i>

                        </div>


                        <div>

                            <p class="quick-name">

                                Data Dokter

                            </p>


                            <p class="quick-desc">

                                Kelola data dokter

                            </p>

                        </div>

                    </a>



                    <a href="/master-perawat"
                       class="quick-link">


                        <div class="quick-icon cyan">

                            <i class="bi bi-heart-pulse-fill"></i>

                        </div>


                        <div>

                            <p class="quick-name">

                                Data Perawat

                            </p>


                            <p class="quick-desc">

                                Kelola data perawat

                            </p>

                        </div>

                    </a>



                    <a href="/master-apoteker"
                       class="quick-link">


                        <div class="quick-icon purple">

                            <i class="bi bi-capsule"></i>

                        </div>


                        <div>

                            <p class="quick-name">

                                Data Apoteker

                            </p>


                            <p class="quick-desc">

                                Kelola data apoteker

                            </p>

                        </div>

                    </a>



                    <a href="/kasir"
                       class="quick-link">


                        <div class="quick-icon orange">

                            <i class="bi bi-cash-stack"></i>

                        </div>


                        <div>

                            <p class="quick-name">

                                Data Kasir

                            </p>


                            <p class="quick-desc">

                                Kelola data kasir

                            </p>

                        </div>

                    </a>

                </div>

            </div>

        </div>



        <!-- INFORMASI SISTEM -->

        <div class="col-lg-5">


            <div class="section-card">


                <h3 class="section-title">

                    Informasi Sistem

                </h3>


                <p class="section-subtitle">

                    Informasi aplikasi rumah sakit.

                </p>



                <div class="info-item">


                    <div class="info-icon">

                        <i class="bi bi-hospital-fill"></i>

                    </div>


                    <div class="info-text">

                        <strong>

                            MEDIXA Hospital

                        </strong>


                        <span>

                            Sistem Informasi Rumah Sakit

                        </span>

                    </div>

                </div>



                <div class="info-item">


                    <div class="info-icon">

                        <i class="bi bi-person-check-fill"></i>

                    </div>


                    <div class="info-text">

                        <strong>

                            Administrator

                        </strong>


                        <span>

                            Hak akses Admin Rumah Sakit

                        </span>

                    </div>

                </div>



                <div class="info-item">


                    <div class="info-icon">

                        <i class="bi bi-calendar-check-fill"></i>

                    </div>


                    <div class="info-text">

                        <strong>

                            Tanggal Sistem

                        </strong>


                        <span>

                            {{ date('d F Y') }}

                        </span>

                    </div>

                </div>



                <div class="info-item">


                    <div class="info-icon">

                        <i class="bi bi-shield-check"></i>

                    </div>


                    <div class="info-text">

                        <strong>

                            Status Sistem

                        </strong>


                        <span class="status-online">

                            <span class="status-dot"></span>

                            Sistem berjalan normal

                        </span>

                    </div>

                </div>


            </div>

        </div>

    </div>



    <!-- FOOTER -->

    <div class="dashboard-footer">

        <i class="bi bi-hospital me-1"></i>

        MEDIXA Hospital Management System

        &copy; {{ date('Y') }}

    </div>


</div>



<!-- =====================================================
     COUNTER ANIMATION
===================================================== -->

<script>

document.addEventListener("DOMContentLoaded", function () {

    const counters =
        document.querySelectorAll(".counter");


    counters.forEach(counter => {

        const target =
            Number(counter.getAttribute("data-target"));


        let current = 0;


        const duration = 1200;

        const startTime =
            performance.now();


        function updateCounter(currentTime) {

            const elapsed =
                currentTime - startTime;


            const progress =
                Math.min(elapsed / duration, 1);


            /*
             * Ease Out
             */

            const ease =
                1 - Math.pow(1 - progress, 3);


            current =
                Math.floor(target * ease);


            counter.textContent =
                current.toLocaleString('id-ID');


            if (progress < 1) {

                requestAnimationFrame(updateCounter);

            } else {

                counter.textContent =
                    target.toLocaleString('id-ID');

            }

        }


        requestAnimationFrame(updateCounter);

    });

});

</script>



<!-- Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

