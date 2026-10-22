<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIM RS - Sistem Informasi Rumah Sakit</title>


    <!-- =========================================================
         TAILWIND CSS
    ========================================================== -->

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- =========================================================
         FONT
    ========================================================== -->

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


    <!-- =========================================================
         FONT AWESOME
    ========================================================== -->

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <style>

        * {
            scroll-behavior: smooth;
        }


        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #ffffff;
            color: #17365d;
        }


        /* =====================================================
           CUSTOM SCROLLBAR
        ===================================================== */

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #edf7ff;
        }

        ::-webkit-scrollbar-thumb {
            background: #1d8ff0;
            border-radius: 20px;
        }


        /* =====================================================
           NAVBAR
        ===================================================== */

        .navbar {
            transition: all .3s ease;
        }

        .navbar.scrolled {
            box-shadow: 0 8px 30px rgba(19, 91, 150, .08);
        }


        .nav-link {
            position: relative;
            color: #294b70;
            font-size: 13px;
            font-weight: 600;
            transition: .3s;
        }

        .nav-link:hover {
            color: #087bea;
        }

        .nav-link.active {
            color: #087bea;
        }

        .nav-link.active::after {
            content: "";

            position: absolute;

            left: 0;
            right: 0;

            bottom: -9px;

            margin: auto;

            width: 28px;
            height: 2px;

            border-radius: 20px;

            background: #087bea;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .hero {
            position: relative;
            overflow: hidden;

            background:
                radial-gradient(
                    circle at 80% 25%,
                    rgba(255,255,255,.95),
                    transparent 28%
                ),
                linear-gradient(
                    135deg,
                    #eef9ff 0%,
                    #e2f4ff 45%,
                    #f8fcff 100%
                );
        }


        .hero::before {
            content: "";

            position: absolute;

            width: 500px;
            height: 500px;

            border-radius: 50%;

            background: rgba(255, 255, 255, .45);

            top: -260px;
            right: -120px;
        }


        .hero::after {
            content: "";

            position: absolute;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            background: rgba(176, 226, 255, .20);

            bottom: -180px;
            left: -100px;
        }


        .hero-content {
            position: relative;
            z-index: 5;
        }


        .hero-badge {
            display: inline-flex;

            align-items: center;

            gap: 8px;

            padding: 7px 13px;

            border-radius: 999px;

            background: rgba(255,255,255,.75);

            border: 1px solid #ccecff;

            color: #087bea;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: .4px;
        }


        .hero-title {
            font-size: clamp(38px, 5vw, 64px);

            line-height: 1.08;

            font-weight: 800;

            color: #123963;
        }


        .hero-title span {
            color: #087bea;
        }


        .hero-description {
            max-width: 540px;

            color: #617c99;

            line-height: 1.8;

            font-size: 14px;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn-primary {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 9px;

            background: linear-gradient(
                135deg,
                #0c8af0,
                #0873df
            );

            color: white;

            padding: 13px 22px;

            border-radius: 10px;

            font-size: 13px;

            font-weight: 700;

            box-shadow:
                0 10px 25px rgba(8, 123, 234, .20);

            transition: .3s;
        }


        .btn-primary:hover {
            transform: translateY(-2px);

            box-shadow:
                0 14px 30px rgba(8, 123, 234, .28);
        }


        .btn-secondary {
            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 9px;

            background: white;

            color: #087bea;

            padding: 12px 22px;

            border-radius: 10px;

            border: 1px solid #bde2fb;

            font-size: 13px;

            font-weight: 700;

            transition: .3s;
        }


        .btn-secondary:hover {
            background: #f2faff;

            transform: translateY(-2px);
        }


        /* =====================================================
           HERO INFORMATION CARD
        ===================================================== */

        .queue-card {
            background: rgba(255,255,255,.94);

            border: 1px solid rgba(176, 222, 248, .8);

            box-shadow:
                0 25px 60px rgba(41, 112, 160, .15);

            border-radius: 18px;

            backdrop-filter: blur(12px);
        }


        .queue-item {
            border: 1px solid #e1f1fb;

            border-radius: 12px;

            transition: .3s;
        }


        .queue-item:hover {
            border-color: #b9e1fb;

            background: #f8fcff;

            transform: translateY(-2px);
        }


        /* =====================================================
           SECTION
        ===================================================== */

        .section-badge {
            display: inline-flex;

            align-items: center;

            padding: 6px 11px;

            background: #edf8ff;

            border: 1px solid #c9eaff;

            color: #087bea;

            border-radius: 999px;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: .7px;

            text-transform: uppercase;
        }


        .section-title {
            font-size: clamp(25px, 3vw, 34px);

            color: #143c67;

            font-weight: 800;
        }


        .section-subtitle {
            color: #7890a9;

            font-size: 13px;

            line-height: 1.8;
        }


        /* =====================================================
           SERVICE CARD
        ===================================================== */

        .service-card {
            position: relative;

            overflow: hidden;

            background: white;

            border: 1px solid #dceffb;

            border-radius: 17px;

            padding: 25px;

            transition: .35s;

            height: 100%;
        }


        .service-card::after {
            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            background: #eff9ff;

            border-radius: 50%;

            right: -45px;
            top: -45px;

            transition: .35s;
        }


        .service-card:hover {
            transform: translateY(-7px);

            border-color: #b4def7;

            box-shadow:
                0 18px 45px rgba(31, 126, 188, .11);
        }


        .service-card:hover::after {
            transform: scale(1.5);
        }


        .service-icon {
            position: relative;

            z-index: 2;

            width: 52px;
            height: 52px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 15px;

            background: #eaf7ff;

            color: #087bea;

            font-size: 20px;

            margin-bottom: 18px;
        }


        .service-card h3 {
            position: relative;

            z-index: 2;

            color: #173e67;

            font-size: 16px;

            font-weight: 800;
        }


        .service-card p {
            position: relative;

            z-index: 2;

            color: #7a91a9;

            font-size: 11px;

            line-height: 1.8;
        }


        .service-arrow {
            position: relative;

            z-index: 2;

            margin-top: 18px;

            color: #087bea;

            font-size: 11px;

            font-weight: 700;
        }


        /* =====================================================
           MASTER DATA
        ===================================================== */

        .master-card {
            background: white;

            border: 1px solid #deeff9;

            border-radius: 15px;

            padding: 16px;

            transition: .3s;
        }


        .master-card:hover {
            transform: translateY(-4px);

            box-shadow:
                0 15px 35px rgba(27, 112, 170, .08);

            border-color: #c4e5f8;
        }


        /* =====================================================
           FLOW
        ===================================================== */

        .flow-card {
            background: white;

            border: 1px solid #dceef9;

            border-radius: 15px;

            padding: 22px;

            height: 100%;

            position: relative;

            transition: .3s;
        }


        .flow-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 15px 35px rgba(28, 117, 177, .10);
        }


        .flow-number {
            position: absolute;

            top: 14px;
            left: 14px;

            width: 26px;
            height: 26px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #dff2ff;

            color: #087bea;

            font-size: 10px;

            font-weight: 800;
        }


        .flow-icon {
            width: 50px;
            height: 50px;

            margin: 5px auto 15px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            background: #edf8ff;

            color: #087bea;

            font-size: 18px;
        }


        .flow-card h3 {
            text-align: center;

            color: #173e67;

            font-size: 13px;

            font-weight: 800;
        }


        .flow-card p {
            text-align: center;

            color: #8297ad;

            font-size: 10px;

            line-height: 1.7;
        }


        .flow-arrow {
            display: flex;

            align-items: center;
            justify-content: center;

            color: #8bcdf3;

            font-size: 18px;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer {
            background: #0d1d34;

            color: white;
        }


        .footer-title {
            font-size: 11px;

            font-weight: 800;

            color: white;

            margin-bottom: 15px;
        }


        .footer-link {
            display: block;

            color: #aabbd0;

            font-size: 10px;

            margin-bottom: 9px;

            transition: .25s;
        }


        .footer-link:hover {
            color: #65bdff;

            transform: translateX(2px);
        }


        .footer-bottom {
            border-top:
                1px solid rgba(255,255,255,.08);

            color: #8497ac;

            font-size: 9px;
        }


        /* =====================================================
           ANIMATION
        ===================================================== */

        .fade-up {
            animation:
                fadeUp .8s ease both;
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


        /* =====================================================
           LOGIN MODAL
        ===================================================== */

        .login-modal {

            position: fixed;

            inset: 0;

            z-index: 9999;

            display: none;

            align-items: center;

            justify-content: center;

            padding: 20px;

            background:
                rgba(15, 32, 52, .58);

            backdrop-filter:
                blur(7px);

            -webkit-backdrop-filter:
                blur(7px);

            opacity: 0;

            transition:
                opacity .25s ease;
        }


        .login-modal.show {

            display: flex;

            opacity: 1;
        }


        .login-modal-card {

            width: 100%;

            max-width: 430px;

            background: #ffffff;

            border-radius: 22px;

            padding: 28px 24px 25px;

            box-shadow:
                0 30px 80px
                rgba(10, 45, 80, .25);

            position: relative;

            transform:
                translateY(20px)
                scale(.97);

            transition:
                transform .3s ease,
                opacity .3s ease;

            opacity: 0;
        }


        .login-modal.show
        .login-modal-card {

            transform:
                translateY(0)
                scale(1);

            opacity: 1;
        }


        /* CLOSE */

        .login-close {

            position: absolute;

            top: 18px;
            right: 18px;

            width: 32px;
            height: 32px;

            border: none;

            border-radius: 50%;

            background: #f1f5f9;

            color: #7b8da3;

            display: flex;

            align-items: center;
            justify-content: center;

            cursor: pointer;

            transition: .25s;
        }


        .login-close:hover {

            background: #e5edf5;

            color: #31516f;

            transform:
                rotate(90deg);
        }


        /* ICON */

        .login-modal-icon {

            width: 48px;
            height: 48px;

            margin:
                0 auto 12px;

            border-radius: 14px;

            background: #edf7ff;

            color: #087bea;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 20px;
        }


        /* TITLE */

        .login-modal-title {

            text-align: center;

            color: #182b43;

            font-size: 18px;

            font-weight: 800;

            margin: 0;
        }


        .login-modal-subtitle {

            text-align: center;

            color: #98a7b7;

            font-size: 10px;

            margin-top: 5px;

            margin-bottom: 23px;
        }


        /* FORM */

        .login-form-group {

            margin-bottom: 16px;
        }


        .login-form-label {

            display: block;

            color: #394b5f;

            font-size: 10px;

            font-weight: 800;

            margin-bottom: 7px;

            text-transform: uppercase;
        }


        .login-form-input {

            width: 100%;

            height: 43px;

            padding: 0 13px;

            border:
                1px solid #d9e5f0;

            border-radius: 10px;

            background: #edf4fd;

            color: #243b53;

            font-size: 12px;

            outline: none;

            transition: .25s;
        }


        .login-form-input:focus {

            background: #ffffff;

            border-color: #55aef0;

            box-shadow:
                0 0 0 3px
                rgba(8, 123, 234, .08);
        }


        .login-form-input::placeholder {
            color: #a2afbc;
        }


        /* PASSWORD */

        .password-wrapper {
            position: relative;
        }


        .password-wrapper
        .login-form-input {

            padding-right: 42px;
        }


        .password-toggle {

            position: absolute;

            right: 13px;

            top: 50%;

            transform:
                translateY(-50%);

            border: none;

            background: transparent;

            color: #91a3b5;

            cursor: pointer;

            font-size: 12px;
        }


        .password-toggle:hover {
            color: #087bea;
        }


        /* LOGIN BUTTON */

        .login-submit {

            width: 100%;

            height: 43px;

            border: none;

            border-radius: 10px;

            background: #087bea;

            color: white;

            font-size: 10px;

            font-weight: 800;

            cursor: pointer;

            transition: .25s;

            box-shadow:
                0 8px 18px
                rgba(8, 123, 234, .18);
        }


        .login-submit:hover {

            background: #076dcc;

            transform:
                translateY(-1px);

            box-shadow:
                0 12px 24px
                rgba(8, 123, 234, .25);
        }


        /* ERROR */

        .login-error {

            background: #fff1f2;

            border:
                1px solid #fecdd3;

            color: #be123c;

            border-radius: 9px;

            padding: 9px 11px;

            font-size: 10px;

            margin-bottom: 15px;
        }


        /* BODY LOCK */

        body.login-open {
            overflow: hidden;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 768px) {

            .hero-title {
                font-size: 40px;
            }


            .hero {
                padding-top: 45px;
            }


            .queue-card {
                margin-top: 35px;
            }


            .flow-arrow {

                transform:
                    rotate(90deg);

                margin:
                    8px 0;
            }


            .nav-link.active::after {
                display: none;
            }

        }


        @media (max-width: 500px) {

            .login-modal {
                padding: 15px;
            }


            .login-modal-card {

                padding:
                    25px 19px 22px;

                border-radius: 19px;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         NAVBAR
    ========================================================== -->

    <header id="navbar"
        class="navbar fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md">

        <div class="max-w-7xl mx-auto px-5 lg:px-8">

            <div class="h-[72px] flex items-center justify-between">


                <!-- LOGO -->

                <a href="{{ url('/') }}"
                    class="flex items-center gap-3">

                    <div
                        class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center text-white shadow-lg shadow-blue-200">

                        <i class="fa-solid fa-hospital text-lg"></i>

                    </div>


                    <div>

                        <div
                            class="font-extrabold text-[#173e67] text-lg leading-none">

                            SIM RS

                        </div>


                        <div
                            class="text-[8px] text-[#7890a9] mt-1">

                            Sistem Informasi Rumah Sakit

                        </div>

                    </div>

                </a>


                <!-- DESKTOP MENU -->

                <nav
                    class="hidden md:flex items-center gap-8">

                    <a href="#beranda"
                        class="nav-link active">

                        Beranda

                    </a>


                    <a href="#layanan"
                        class="nav-link">

                        Layanan

                    </a>


                    <a href="#pendaftaran"
                        class="nav-link">

                        Pendaftaran

                    </a>


                    <a href="#informasi"
                        class="nav-link">

                        Informasi

                    </a>

                </nav>


                <!-- LOGIN DESKTOP -->

                <button
                    type="button"
                    onclick="openLoginModal()"
                    class="hidden md:inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition shadow-lg shadow-blue-100">

                    <i class="fa-solid fa-right-to-bracket"></i>

                    Login

                </button>


                <!-- MOBILE BUTTON -->

                <button
                    id="mobileMenuButton"
                    type="button"
                    class="md:hidden w-10 h-10 rounded-xl bg-blue-50 text-blue-600">

                    <i class="fa-solid fa-bars"></i>

                </button>

            </div>


            <!-- MOBILE MENU -->

            <div id="mobileMenu"
                class="hidden md:hidden pb-5 border-t border-blue-50">

                <div
                    class="flex flex-col gap-4 pt-5">


                    <a href="#beranda"
                        class="mobile-nav-link text-sm font-semibold text-slate-600">

                        Beranda

                    </a>


                    <a href="#layanan"
                        class="mobile-nav-link text-sm font-semibold text-slate-600">

                        Layanan

                    </a>


                    <a href="#pendaftaran"
                        class="mobile-nav-link text-sm font-semibold text-slate-600">

                        Pendaftaran

                    </a>


                    <a href="#informasi"
                        class="mobile-nav-link text-sm font-semibold text-slate-600">

                        Informasi

                    </a>


                    <button
                        type="button"
                        onclick="openLoginModal(); closeMobileMenu();"
                        class="inline-flex justify-center items-center gap-2 bg-blue-500 text-white py-3 rounded-xl text-sm font-bold">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        Login

                    </button>

                </div>

            </div>

        </div>

    </header>


    <!-- =========================================================
         HERO
    ========================================================== -->

    <section id="beranda"
        class="hero min-h-[680px] pt-[72px] flex items-center">

        <div
            class="max-w-7xl mx-auto px-5 lg:px-8 w-full">

            <div
                class="grid lg:grid-cols-2 gap-12 items-center">


                <!-- LEFT -->

                <div
                    class="hero-content fade-up">


                    <div
                        class="hero-badge mb-6">

                        <i class="fa-solid fa-heart-pulse"></i>

                        SISTEM INFORMASI RUMAH SAKIT

                    </div>


                    <h1
                        class="hero-title mb-6">

                        Sistem Informasi

                        <br>

                        <span>Rumah Sakit</span>

                    </h1>


                    <p
                        class="hero-description mb-8">

                        Sistem informasi rumah sakit terintegrasi
                        untuk membantu proses pendaftaran pasien,
                        pemeriksaan dokter, pengelolaan resep obat,
                        hasil pemeriksaan, dan pengelolaan data rumah sakit.

                    </p>


                    <!-- BUTTON -->

                    <div
                        class="flex flex-wrap gap-3 mb-9">

                        <a href="#pendaftaran"
                            class="btn-primary">

                            <i class="fa-solid fa-user-plus"></i>

                            Daftar Pasien

                        </a>


                        <a href="#layanan"
                            class="btn-secondary">

                            <i class="fa-regular fa-eye"></i>

                            Lihat Layanan

                        </a>

                    </div>


                    <!-- MINI FEATURES -->

                    <div
                        class="flex flex-wrap gap-5">


                        <div
                            class="flex items-center gap-2">

                            <div
                                class="w-9 h-9 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm">

                                <i class="fa-solid fa-shield-heart text-sm"></i>

                            </div>


                            <div>

                                <div
                                    class="text-[9px] font-bold text-[#315a7f]">

                                    Data Terintegrasi

                                </div>

                                <div
                                    class="text-[8px] text-slate-400">

                                    Terstruktur

                                </div>

                            </div>

                        </div>


                        <div
                            class="flex items-center gap-2">

                            <div
                                class="w-9 h-9 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm">

                                <i class="fa-solid fa-clock text-sm"></i>

                            </div>


                            <div>

                                <div
                                    class="text-[9px] font-bold text-[#315a7f]">

                                    Proses Cepat

                                </div>

                                <div
                                    class="text-[8px] text-slate-400">

                                    dan Mudah

                                </div>

                            </div>

                        </div>


                        <div
                            class="flex items-center gap-2">

                            <div
                                class="w-9 h-9 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm">

                                <i class="fa-solid fa-hospital text-sm"></i>

                            </div>


                            <div>

                                <div
                                    class="text-[9px] font-bold text-[#315a7f]">

                                    SIM RS

                                </div>

                                <div
                                    class="text-[8px] text-slate-400">

                                    Sistem Terintegrasi

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- RIGHT -->

                <div
                    class="relative">


                    <div
                        class="absolute -top-10 right-5 w-40 h-40 rounded-full bg-white/50 blur-2xl">
                    </div>


                    <!-- INFORMATION CARD -->

                    <div
                        class="queue-card p-5 max-w-[470px] ml-auto relative z-10">


                        <div
                            class="flex items-center justify-between mb-5">

                            <div>

                                <div
                                    class="text-[9px] uppercase tracking-wider text-blue-500 font-bold">

                                    SIM RS

                                </div>


                                <h3
                                    class="text-lg font-extrabold text-[#173e67] mt-1">

                                    Fitur Pelayanan

                                </h3>

                            </div>


                            <div
                                class="px-2.5 py-1.5 rounded-lg bg-green-50 text-green-600 text-[9px] font-bold">

                                <i
                                    class="fa-solid fa-circle text-[5px] mr-1">
                                </i>

                                ONLINE

                            </div>

                        </div>


                        <div
                            class="flex items-center gap-2 text-[10px] text-slate-400 mb-4">

                            <i
                                class="fa-regular fa-calendar text-blue-400">
                            </i>

                            {{ now()->translatedFormat('d F Y') }}

                        </div>


                        <!-- FEATURE 1 -->

                        <div
                            class="queue-item p-3 flex items-center justify-between mb-3">

                            <div
                                class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">

                                    <i class="fa-solid fa-user-plus"></i>

                                </div>


                                <div>

                                    <div
                                        class="text-[10px] font-bold text-[#234d73]">

                                        Pendaftaran Pasien

                                    </div>


                                    <div
                                        class="text-[9px] text-slate-400 mt-1">

                                        Kelola pendaftaran pasien

                                    </div>

                                </div>

                            </div>


                            <i
                                class="fa-solid fa-check text-blue-500 text-xs">
                            </i>

                        </div>


                        <!-- FEATURE 2 -->

                        <div
                            class="queue-item p-3 flex items-center justify-between mb-3">

                            <div
                                class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl bg-cyan-50 flex items-center justify-center text-cyan-500">

                                    <i class="fa-solid fa-stethoscope"></i>

                                </div>


                                <div>

                                    <div
                                        class="text-[10px] font-bold text-[#234d73]">

                                        Pemeriksaan Dokter

                                    </div>


                                    <div
                                        class="text-[9px] text-slate-400 mt-1">

                                        Kelola pemeriksaan pasien

                                    </div>

                                </div>

                            </div>


                            <i
                                class="fa-solid fa-check text-cyan-500 text-xs">
                            </i>

                        </div>


                        <!-- FEATURE 3 -->

                        <div
                            class="queue-item p-3 flex items-center justify-between mb-3">

                            <div
                                class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-sky-500">

                                    <i class="fa-solid fa-pills"></i>

                                </div>


                                <div>

                                    <div
                                        class="text-[10px] font-bold text-[#234d73]">

                                        Resep & Obat

                                    </div>


                                    <div
                                        class="text-[9px] text-slate-400 mt-1">

                                        Kelola data dan resep obat

                                    </div>

                                </div>

                            </div>


                            <i
                                class="fa-solid fa-check text-sky-500 text-xs">
                            </i>

                        </div>


                        <!-- FEATURE 4 -->

                        <div
                            class="queue-item p-3 flex items-center justify-between mb-5">

                            <div
                                class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-500">

                                    <i class="fa-solid fa-file-medical"></i>

                                </div>


                                <div>

                                    <div
                                        class="text-[10px] font-bold text-[#234d73]">

                                        Hasil Pemeriksaan

                                    </div>


                                    <div
                                        class="text-[9px] text-slate-400 mt-1">

                                        Simpan hasil pemeriksaan

                                    </div>

                                </div>

                            </div>


                            <i
                                class="fa-solid fa-check text-indigo-500 text-xs">
                            </i>

                        </div>


                        <a href="#layanan"
                            class="w-full flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-xl text-[10px] font-bold transition">

                            Lihat Layanan

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         LAYANAN
    ========================================================== -->

    <section id="layanan"
        class="py-24 bg-white">

        <div
            class="max-w-7xl mx-auto px-5 lg:px-8">


            <div
                class="text-center max-w-2xl mx-auto mb-12">

                <span class="section-badge">

                    Fitur Utama

                </span>


                <h2
                    class="section-title mt-4">

                    Layanan Rumah Sakit

                </h2>


                <p
                    class="section-subtitle mt-3">

                    Fitur sistem informasi yang mendukung
                    proses kerja rumah sakit mulai dari data,
                    pendaftaran, pemeriksaan, obat,
                    hingga hasil pemeriksaan.

                </p>

            </div>


            <!-- SERVICES -->

            <div
                class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">


                <!-- PENDAFTARAN -->

                <div class="service-card">

                    <div class="service-icon">

                        <i class="fa-solid fa-user-plus"></i>

                    </div>


                    <h3>
                        Pendaftaran Pasien
                    </h3>


                    <p class="mt-3">

                        Kelola data pendaftaran pasien
                        dengan proses yang lebih mudah
                        dan terstruktur.

                    </p>


                    <div class="service-arrow">

                        Pendaftaran Pasien

                        <i
                            class="fa-solid fa-arrow-right ml-1">
                        </i>

                    </div>

                </div>


                <!-- PEMERIKSAAN -->

                <div class="service-card">

                    <div class="service-icon">

                        <i class="fa-solid fa-stethoscope"></i>

                    </div>


                    <h3>
                        Pemeriksaan Dokter
                    </h3>


                    <p class="mt-3">

                        Kelola pemeriksaan pasien,
                        keluhan, diagnosa, tindakan,
                        dan resep dokter.

                    </p>


                    <div class="service-arrow">

                        Pemeriksaan Dokter

                        <i
                            class="fa-solid fa-arrow-right ml-1">
                        </i>

                    </div>

                </div>


                <!-- HASIL -->

                <div class="service-card">

                    <div class="service-icon">

                        <i class="fa-solid fa-file-medical"></i>

                    </div>


                    <h3>
                        Hasil Pemeriksaan
                    </h3>


                    <p class="mt-3">

                        Catat dan kelola hasil
                        pemeriksaan pasien secara
                        lebih rapi dan terintegrasi.

                    </p>


                    <div class="service-arrow">

                        Hasil Pemeriksaan

                        <i
                            class="fa-solid fa-arrow-right ml-1">
                        </i>

                    </div>

                </div>


                <!-- OBAT -->

                <div class="service-card">

                    <div class="service-icon">

                        <i class="fa-solid fa-pills"></i>

                    </div>


                    <h3>
                        Resep & Stok Obat
                    </h3>


                    <p class="mt-3">

                        Kelola data obat, kategori obat,
                        satuan obat, resep, dan persediaan.

                    </p>


                    <div class="service-arrow">

                        Kelola Obat

                        <i
                            class="fa-solid fa-arrow-right ml-1">
                        </i>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         MASTER DATA / INFORMASI
    ========================================================== -->

    <section id="informasi"
        class="py-20 bg-[#f7fcff]">

        <div
            class="max-w-7xl mx-auto px-5 lg:px-8">


            <div
                class="grid lg:grid-cols-2 gap-14 items-center">


                <!-- LEFT -->

                <div>

                    <span class="section-badge">

                        Sistem Terintegrasi

                    </span>


                    <h2
                        class="section-title mt-4">

                        Semua Data Rumah Sakit

                        <span class="text-blue-500">

                            Terhubung

                        </span>

                    </h2>


                    <p
                        class="section-subtitle mt-5 max-w-xl">

                        SIM RS membantu menghubungkan
                        berbagai data yang digunakan
                        dalam pelayanan rumah sakit
                        sehingga proses kerja menjadi
                        lebih terorganisir.

                    </p>


                    <!-- DATA LIST -->

                    <div
                        class="mt-8 grid sm:grid-cols-2 gap-3">


                        <!-- DOKTER -->

                        <div
                            class="master-card flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i
                                    class="fa-solid fa-user-doctor text-sm">
                                </i>

                            </div>


                            <div>

                                <div
                                    class="text-[11px] font-bold text-[#234d73]">

                                    Data Dokter

                                </div>


                                <div
                                    class="text-[9px] text-slate-400">

                                    Dokter & poli

                                </div>

                            </div>

                        </div>


                        <!-- PASIEN -->

                        <div
                            class="master-card flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i
                                    class="fa-solid fa-user-injured text-sm">
                                </i>

                            </div>


                            <div>

                                <div
                                    class="text-[11px] font-bold text-[#234d73]">

                                    Data Pasien

                                </div>


                                <div
                                    class="text-[9px] text-slate-400">

                                    Master pasien

                                </div>

                            </div>

                        </div>


                        <!-- OBAT -->

                        <div
                            class="master-card flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i
                                    class="fa-solid fa-capsules text-sm">
                                </i>

                            </div>


                            <div>

                                <div
                                    class="text-[11px] font-bold text-[#234d73]">

                                    Master Obat

                                </div>


                                <div
                                    class="text-[9px] text-slate-400">

                                    Obat & kategori

                                </div>

                            </div>

                        </div>


                        <!-- PERAWAT -->

                        <div
                            class="master-card flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i
                                    class="fa-solid fa-user-nurse text-sm">
                                </i>

                            </div>


                            <div>

                                <div
                                    class="text-[11px] font-bold text-[#234d73]">

                                    Data Perawat

                                </div>


                                <div
                                    class="text-[9px] text-slate-400">

                                    Data tenaga perawat

                                </div>

                            </div>

                        </div>


                        <!-- KAMAR -->

                        <div
                            class="master-card flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i
                                    class="fa-solid fa-bed text-sm">
                                </i>

                            </div>


                            <div>

                                <div
                                    class="text-[11px] font-bold text-[#234d73]">

                                    Data Kamar

                                </div>


                                <div
                                    class="text-[9px] text-slate-400">

                                    Kamar rumah sakit

                                </div>

                            </div>

                        </div>


                        <!-- TINDAKAN -->

                        <div
                            class="master-card flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i
                                    class="fa-solid fa-notes-medical text-sm">
                                </i>

                            </div>


                            <div>

                                <div
                                    class="text-[11px] font-bold text-[#234d73]">

                                    Data Tindakan

                                </div>


                                <div
                                    class="text-[9px] text-slate-400">

                                    Tindakan medis

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- RIGHT -->

                <div
                    class="relative">


                    <div
                        class="bg-white border border-blue-100 rounded-3xl p-7 shadow-xl shadow-blue-100/30">


                        <div
                            class="flex items-center justify-between mb-7">


                            <div>

                                <div
                                    class="text-[9px] uppercase tracking-widest text-blue-500 font-bold">

                                    SIM RS

                                </div>


                                <h3
                                    class="text-xl font-extrabold text-[#173e67] mt-1">

                                    Sistem Terintegrasi

                                </h3>

                            </div>


                            <div
                                class="w-11 h-11 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">

                                <i class="fa-solid fa-hospital"></i>

                            </div>

                        </div>


                        <div class="space-y-5">


                            <!-- PENDAFTARAN -->

                            <div>

                                <div
                                    class="flex justify-between text-[10px] mb-2">

                                    <span
                                        class="font-bold text-slate-600">

                                        Pendaftaran Pasien

                                    </span>


                                    <span
                                        class="text-blue-500">

                                        Terhubung

                                    </span>

                                </div>


                                <div
                                    class="h-2 bg-blue-50 rounded-full overflow-hidden">

                                    <div
                                        class="h-full w-[95%] bg-blue-500 rounded-full">
                                    </div>

                                </div>

                            </div>


                            <!-- PEMERIKSAAN -->

                            <div>

                                <div
                                    class="flex justify-between text-[10px] mb-2">

                                    <span
                                        class="font-bold text-slate-600">

                                        Pemeriksaan Dokter

                                    </span>


                                    <span
                                        class="text-blue-500">

                                        Terhubung

                                    </span>

                                </div>


                                <div
                                    class="h-2 bg-blue-50 rounded-full overflow-hidden">

                                    <div
                                        class="h-full w-[90%] bg-cyan-500 rounded-full">
                                    </div>

                                </div>

                            </div>


                            <!-- OBAT -->

                            <div>

                                <div
                                    class="flex justify-between text-[10px] mb-2">

                                    <span
                                        class="font-bold text-slate-600">

                                        Resep & Obat

                                    </span>


                                    <span
                                        class="text-blue-500">

                                        Terhubung

                                    </span>

                                </div>


                                <div
                                    class="h-2 bg-blue-50 rounded-full overflow-hidden">

                                    <div
                                        class="h-full w-[85%] bg-sky-500 rounded-full">
                                    </div>

                                </div>

                            </div>


                            <!-- HASIL -->

                            <div>

                                <div
                                    class="flex justify-between text-[10px] mb-2">

                                    <span
                                        class="font-bold text-slate-600">

                                        Hasil Pemeriksaan

                                    </span>


                                    <span
                                        class="text-blue-500">

                                        Terhubung

                                    </span>

                                </div>


                                <div
                                    class="h-2 bg-blue-50 rounded-full overflow-hidden">

                                    <div
                                        class="h-full w-[88%] bg-indigo-400 rounded-full">
                                    </div>

                                </div>

                            </div>


                            <!-- STATUS -->

                            <div
                                class="mt-7 p-4 rounded-xl bg-blue-50 flex items-center gap-3">


                                <div
                                    class="w-9 h-9 rounded-lg bg-white flex items-center justify-center text-green-500">

                                    <i
                                        class="fa-solid fa-check">
                                    </i>

                                </div>


                                <div>

                                    <div
                                        class="text-[10px] font-extrabold text-[#234d73]">

                                        Sistem berjalan dengan baik

                                    </div>


                                    <div
                                        class="text-[9px] text-slate-400 mt-1">

                                        Data pelayanan siap digunakan

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         ALUR PELAYANAN
    ========================================================== -->

    <section id="pendaftaran"
        class="py-24 bg-white">

        <div
            class="max-w-7xl mx-auto px-5 lg:px-8">


            <div
                class="text-center max-w-2xl mx-auto mb-12">

                <span class="section-badge">

                    Alur Pelayanan

                </span>


                <h2
                    class="section-title mt-4">

                    Alur Pelayanan Pasien

                </h2>


                <p
                    class="section-subtitle mt-3">

                    Proses pelayanan pasien dari pendaftaran
                    hingga mendapatkan hasil pemeriksaan.

                </p>

            </div>


            <div
                class="grid lg:grid-cols-[1fr_auto_1fr_auto_1fr_auto_1fr] gap-3 items-center">


                <!-- STEP 1 -->

                <div class="flow-card">

                    <div class="flow-number">
                        1
                    </div>


                    <div class="flow-icon">

                        <i
                            class="fa-solid fa-user-plus">
                        </i>

                    </div>


                    <h3>
                        Daftar Pasien
                    </h3>


                    <p class="mt-2">

                        Lakukan proses pendaftaran
                        pasien melalui sistem.

                    </p>

                </div>


                <div class="flow-arrow hidden lg:flex">

                    <i
                        class="fa-solid fa-arrow-right">
                    </i>

                </div>


                <!-- STEP 2 -->

                <div class="flow-card">

                    <div class="flow-number">
                        2
                    </div>


                    <div class="flow-icon">

                        <i
                            class="fa-solid fa-stethoscope">
                        </i>

                    </div>


                    <h3>
                        Pemeriksaan Dokter
                    </h3>


                    <p class="mt-2">

                        Dokter melakukan pemeriksaan
                        sesuai keluhan pasien.

                    </p>

                </div>


                <div class="flow-arrow hidden lg:flex">

                    <i
                        class="fa-solid fa-arrow-right">
                    </i>

                </div>


                <!-- STEP 3 -->

                <div class="flow-card">

                    <div class="flow-number">
                        3
                    </div>


                    <div class="flow-icon">

                        <i
                            class="fa-solid fa-pills">
                        </i>

                    </div>


                    <h3>
                        Resep Obat
                    </h3>


                    <p class="mt-2">

                        Dokter dapat memberikan resep
                        obat sesuai hasil pemeriksaan.

                    </p>

                </div>


                <div class="flow-arrow hidden lg:flex">

                    <i
                        class="fa-solid fa-arrow-right">
                    </i>

                </div>


                <!-- STEP 4 -->

                <div class="flow-card">

                    <div class="flow-number">
                        4
                    </div>


                    <div class="flow-icon">

                        <i
                            class="fa-solid fa-file-medical">
                        </i>

                    </div>


                    <h3>
                        Hasil Pemeriksaan
                    </h3>


                    <p class="mt-2">

                        Hasil pemeriksaan pasien
                        tersimpan dalam sistem.

                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================================
         FOOTER
    ========================================================== -->

    <footer class="footer">


        <div
            class="max-w-7xl mx-auto px-5 lg:px-8 py-14">


            <div
                class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">


                <!-- BRAND -->

                <div>

                    <div
                        class="flex items-center gap-3 mb-5">


                        <div
                            class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center">

                            <i
                                class="fa-solid fa-hospital text-white">
                            </i>

                        </div>


                        <div>

                            <div
                                class="font-extrabold text-white">

                                SIM RS

                            </div>


                            <div
                                class="text-[8px] text-slate-400">

                                Sistem Informasi Rumah Sakit

                            </div>

                        </div>

                    </div>


                    <p
                        class="text-[10px] leading-6 text-slate-400 max-w-xs">

                        Mewujudkan pelayanan kesehatan
                        yang lebih baik dengan teknologi
                        informasi yang terintegrasi.

                    </p>

                </div>


                <!-- HUBUNGI -->

                <div>

                    <div class="footer-title">

                        Hubungi Kami

                    </div>


                    <div class="space-y-3">


                        <div
                            class="flex items-start gap-2">

                            <i
                                class="fa-solid fa-phone text-blue-400 text-[10px] mt-1">
                            </i>


                            <span
                                class="text-[10px] text-slate-400">

                                (021) 555-9111

                            </span>

                        </div>


                        <div
                            class="flex items-start gap-2">

                            <i
                                class="fa-solid fa-location-dot text-blue-400 text-[10px] mt-1">
                            </i>


                            <span
                                class="text-[10px] text-slate-400">

                                Jl. Kesehatan No. 123

                            </span>

                        </div>


                        <div
                            class="flex items-start gap-2">

                            <i
                                class="fa-solid fa-envelope text-blue-400 text-[10px] mt-1">
                            </i>


                            <span
                                class="text-[10px] text-slate-400">

                                info@simrs.id

                            </span>

                        </div>

                    </div>

                </div>


                <!-- LINK CEPAT -->

                <div>

                    <div class="footer-title">

                        Link Cepat

                    </div>


                    <a
                        href="#beranda"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Beranda

                    </a>


                    <a
                        href="#layanan"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Layanan

                    </a>


                    <a
                        href="#pendaftaran"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Pendaftaran

                    </a>


                    <a
                        href="#informasi"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Informasi

                    </a>

                </div>


                <!-- LAYANAN -->

                <div>

                    <div class="footer-title">

                        Fitur SIM RS

                    </div>


                    <a
                        href="#informasi"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Master Data

                    </a>


                    <a
                        href="#layanan"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Stok Obat

                    </a>


                    <a
                        href="#pendaftaran"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Pendaftaran Pasien

                    </a>


                    <a
                        href="#layanan"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Pemeriksaan Dokter

                    </a>


                    <a
                        href="#layanan"
                        class="footer-link">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Hasil Pemeriksaan

                    </a>


                    <button
                        type="button"
                        onclick="openLoginModal()"
                        class="footer-link text-left">

                        <i
                            class="fa-solid fa-angle-right mr-1">
                        </i>

                        Login Sistem

                    </button>

                </div>

            </div>

        </div>


        <!-- FOOTER BOTTOM -->

        <div class="footer-bottom">

            <div
                class="max-w-7xl mx-auto px-5 lg:px-8 py-5">


                <div
                    class="flex flex-col md:flex-row justify-between items-center gap-3">


                    <div>

                        © {{ date('Y') }}
                        SIM RS.
                        All rights reserved.

                    </div>


                    <div>

                        Sistem Informasi Rumah Sakit

                    </div>

                </div>

            </div>

        </div>

    </footer>


    <!-- =========================================================
         LOGIN MODAL
    ========================================================== -->

    <div
        id="loginModal"
        class="login-modal"
        onclick="closeLoginModal(event)">


        <div
            class="login-modal-card"
            onclick="event.stopPropagation()">


            <!-- CLOSE -->

            <button
                type="button"
                class="login-close"
                onclick="closeLoginModal()">

                <i class="fa-solid fa-xmark"></i>

            </button>


            <!-- ICON -->

            <div class="login-modal-icon">

                <i class="fa-solid fa-user-doctor"></i>

            </div>


            <!-- TITLE -->

            <h2 class="login-modal-title">

                Portal Masuk

            </h2>


            <p class="login-modal-subtitle">

                Akses Rekam Medis Digital & Hasil Lab

            </p>


            <!-- LOGIN FORM -->

            <form
                action="{{ route('login.post') }}"
                method="POST">

                @csrf


                <!-- EMAIL -->

                <div class="login-form-group">

                    <label
                        class="login-form-label">

                        Email

                    </label>


                    <input
                        type="email"
                        name="email"
                        class="login-form-input"
                        placeholder="Masukkan email"
                        autocomplete="email"
                        value="{{ old('email') }}"
                        required>

                </div>


                <!-- PASSWORD -->

                <div class="login-form-group">

                    <label
                        class="login-form-label">

                        Password

                    </label>


                    <div class="password-wrapper">

                        <input
                            type="password"
                            name="password"
                            id="loginPassword"
                            class="login-form-input"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required>


                        <button
                            type="button"
                            class="password-toggle"
                            onclick="toggleLoginPassword()">

                            <i
                                id="passwordEye"
                                class="fa-regular fa-eye">
                            </i>

                        </button>

                    </div>

                </div>


                <!-- ERROR -->

                @if ($errors->any())

                    <div class="login-error">

                        <i
                            class="fa-solid fa-circle-exclamation mr-1">
                        </i>

                        {{ $errors->first() }}

                    </div>

                @endif


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="login-submit">

                    LOGIN

                </button>

            </form>

        </div>

    </div>


    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>


        /* =====================================================
           NAVBAR SCROLL
        ====================================================== */

        const navbar =
            document.getElementById('navbar');


        window.addEventListener(
            'scroll',
            function () {

                if (window.scrollY > 20) {

                    navbar.classList.add('scrolled');

                } else {

                    navbar.classList.remove('scrolled');

                }

            }
        );


        /* =====================================================
           MOBILE MENU
        ====================================================== */

        const mobileMenuButton =
            document.getElementById(
                'mobileMenuButton'
            );


        const mobileMenu =
            document.getElementById(
                'mobileMenu'
            );


        if (mobileMenuButton) {

            mobileMenuButton.addEventListener(
                'click',
                function () {

                    mobileMenu.classList.toggle(
                        'hidden'
                    );

                }
            );

        }


        /* =====================================================
           CLOSE MOBILE MENU
        ====================================================== */

        function closeMobileMenu() {

            if (mobileMenu) {

                mobileMenu.classList.add(
                    'hidden'
                );

            }

        }


        document
            .querySelectorAll('.mobile-nav-link')
            .forEach(function (link) {

                link.addEventListener(
                    'click',
                    function () {

                        closeMobileMenu();

                    }
                );

            });


        /* =====================================================
           ACTIVE NAVIGATION
        ====================================================== */

        const sections =
            document.querySelectorAll(
                'section[id]'
            );


        const navLinks =
            document.querySelectorAll(
                '.nav-link'
            );


        window.addEventListener(
            'scroll',
            function () {


                let current = '';


                sections.forEach(
                    function (section) {

                        const sectionTop =
                            section.offsetTop - 130;


                        if (
                            window.scrollY >=
                            sectionTop
                        ) {

                            current =
                                section.getAttribute(
                                    'id'
                                );

                        }

                    }
                );


                navLinks.forEach(
                    function (link) {

                        link.classList.remove(
                            'active'
                        );


                        const href =
                            link.getAttribute(
                                'href'
                            );


                        if (
                            href ===
                            '#' + current
                        ) {

                            link.classList.add(
                                'active'
                            );

                        }

                    }
                );

            }
        );


        /* =====================================================
           LOGIN MODAL
        ====================================================== */

        function openLoginModal() {

            const modal =
                document.getElementById(
                    'loginModal'
                );


            if (!modal) {
                return;
            }


            modal.classList.add('show');


            document.body.classList.add(
                'login-open'
            );


            setTimeout(
                function () {

                    const email =
                        modal.querySelector(
                            'input[name="email"]'
                        );


                    if (email) {

                        email.focus();

                    }

                },
                250
            );

        }


        /* =====================================================
           CLOSE LOGIN MODAL
        ====================================================== */

        function closeLoginModal(event) {


            if (
                event &&
                event.target &&
                event.target.id !==
                'loginModal'
            ) {

                return;

            }


            const modal =
                document.getElementById(
                    'loginModal'
                );


            if (!modal) {
                return;
            }


            modal.classList.remove(
                'show'
            );


            document.body.classList.remove(
                'login-open'
            );

        }


        /* =====================================================
           PASSWORD SHOW / HIDE
        ====================================================== */

        function toggleLoginPassword() {


            const password =
                document.getElementById(
                    'loginPassword'
                );


            const eye =
                document.getElementById(
                    'passwordEye'
                );


            if (
                !password ||
                !eye
            ) {

                return;

            }


            if (
                password.type ===
                'password'
            ) {


                password.type =
                    'text';


                eye.classList.remove(
                    'fa-eye'
                );


                eye.classList.add(
                    'fa-eye-slash'
                );


            } else {


                password.type =
                    'password';


                eye.classList.remove(
                    'fa-eye-slash'
                );


                eye.classList.add(
                    'fa-eye'
                );

            }

        }


        /* =====================================================
           ESCAPE KEY
        ====================================================== */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key ===
                    'Escape'
                ) {

                    closeLoginModal();

                }

            }
        );


        /* =====================================================
           FADE ANIMATION
        ====================================================== */

        const observer =
            new IntersectionObserver(
                function (entries) {

                    entries.forEach(
                        function (entry) {

                            if (
                                entry.isIntersecting
                            ) {

                                entry.target
                                    .classList
                                    .add('fade-up');


                                observer.unobserve(
                                    entry.target
                                );

                            }

                        }
                    );

                },
                {
                    threshold: 0.12
                }
            );


        document
            .querySelectorAll(
                '.service-card, .flow-card, .master-card'
            )
            .forEach(
                function (element) {

                    observer.observe(
                        element
                    );

                }
            );


        /* =====================================================
           OPEN LOGIN MODAL IF LOGIN ERROR EXISTS
        ====================================================== */

        @if ($errors->any())

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    openLoginModal();

                }
            );

        @endif


    </script>


</body>

</html>