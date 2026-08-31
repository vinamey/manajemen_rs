<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDIXA - Modern Integrated Health Center</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f7ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0284c7',
                            600: '#0265d2',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    },
                    boxShadow: {
                        'blue-glow': '0 10px 30px -10px rgba(2, 132, 199, 0.25)',
                        'card-float': '0 20px 40px -15px rgba(12, 74, 110, 0.08)',
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            overflow-x: hidden;
        }

        /* Light Blue Gradient Background */
        .bg-light-mesh {
            background-color: #f8fafc;
            background-image:
                radial-gradient(at 0% 0%, rgba(224, 242, 254, 0.8) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(186, 230, 253, 0.6) 0px, transparent 50%),
                radial-gradient(at 50% 100%, rgba(240, 247, 255, 0.9) 0px, transparent 60%);
            background-attachment: fixed;
        }

        /* Clean Glassmorphism */
        .glass-header {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
        }

        .light-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .light-card:hover {
            transform: translateY(-6px);
            border-color: #38bdf8;
            box-shadow: 0 20px 35px -10px rgba(2, 132, 199, 0.15);
        }

        /* Gradient Text */
        .text-gradient-blue {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .animate-float {
            animation: float 4s ease-in-out infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #bae6fd; border-radius: 9999px; }
        ::-webkit-scrollbar-thumb:hover { background: #0284c7; }
    </style>
</head>
<body class="bg-light-mesh selection:bg-brand-500 selection:text-white min-h-screen">

    <!-- TOP BAR DARURAT -->
    <div class="bg-gradient-to-r from-brand-900 to-brand-700 text-white text-xs py-2.5 px-6 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span class="flex items-center gap-2.5">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500"></span>
                    </span>
                    <i class="fa-solid fa-phone-volume text-brand-200"></i> Emergency UGD: <strong class="text-white font-extrabold tracking-wide">(021) 555-9111</strong>
                </span>
                <span class="hidden md:flex items-center gap-2 text-brand-100">
                    <i class="fa-regular fa-clock text-brand-300"></i> Poliklinik Jam: <span class="text-white font-semibold">08:00 - 21:00 WIB</span>
                </span>
            </div>
            <button onclick="openJanjiModal('')" class="bg-white hover:bg-brand-50 text-brand-700 font-extrabold px-4 py-1.5 rounded-full text-[11px] transition-all duration-300 shadow-sm flex items-center gap-2 tracking-wider uppercase">
                <i class="fa-solid fa-bolt text-brand-500"></i> Buat Janji Dokter
            </button>
        </div>
    </div>

    <!-- NAVBAR GLASS LIGHT -->
    <header class="glass-header sticky top-9 z-40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- Logo Medixa -->
            <a href="#" class="flex items-center space-x-3.5 group">
                <div class="w-11 h-11 bg-gradient-to-tr from-brand-600 to-brand-400 text-white rounded-2xl flex items-center justify-center text-xl shadow-blue-glow group-hover:rotate-6 transition duration-300 font-black">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div>
                    <span class="text-2xl font-black tracking-wider text-slate-800 flex items-center">
                        MEDIXA<span class="text-brand-500">.</span>
                    </span>
                    <span class="block text-[9px] font-bold text-brand-600 uppercase tracking-widest -mt-1">Smart Hospital Platform</span>
                </div>
            </a>

            <!-- Menu Utama -->
            <nav class="hidden md:flex items-center space-x-8 text-xs font-bold text-slate-600 uppercase tracking-wider">
                <a href="#layanan" class="hover:text-brand-600 transition duration-200 py-1 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-brand-500 hover:after:w-full after:transition-all">Layanan Medis</a>
                <a href="#dokter" class="hover:text-brand-600 transition duration-200 py-1 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-brand-500 hover:after:w-full after:transition-all">Jadwal Dokter</a>
                <a href="#antrian" class="hover:text-brand-600 transition duration-200 py-1 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-brand-500 hover:after:w-full after:transition-all">Live Antrian</a>
                <a href="#fasilitas" class="hover:text-brand-600 transition duration-200 py-1 relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-0.5 after:bg-brand-500 hover:after:w-full after:transition-all">Fasilitas</a>
            </nav>

            <!-- Akses Portal -->
            <button onclick="toggleModal('loginModal')" class="bg-brand-50 border border-brand-200 text-brand-700 hover:bg-brand-600 hover:text-white px-5 py-2.5 rounded-2xl font-extrabold text-xs transition duration-300 shadow-sm flex items-center space-x-2 tracking-wider">
                <i class="fa-solid fa-shield-halved"></i>
                <span>LOGIN</span>
            </button>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="relative py-20 overflow-hidden">
        <!-- Ambient Glowing Orbs -->
        <div class="absolute top-10 left-10 w-96 h-96 bg-brand-200/50 blur-[100px] rounded-full pointer-events-none"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-sky-200/60 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                <div class="inline-flex items-center gap-2.5 bg-white border border-brand-200 text-brand-700 text-xs font-bold px-4 py-2 rounded-full shadow-sm">
                    <i class="fa-solid fa-microchip text-brand-500"></i> Smart Medical AI-Integrated Center
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 leading-[1.15] tracking-tight">
                    Layanan Kesehatan <br>
                    <span class="text-gradient-blue">Masa Depan</span>
                </h1>

                <p class="text-slate-600 leading-relaxed text-base sm:text-lg max-w-2xl mx-auto lg:mx-0 font-normal">
                    Platform kesehatan terpadu berbasis AI. Pantau nomor antrian poliklinik realtime, rekam medis digital, dan booking dokter spesialis instan.
                </p>

                <!-- Tombol Aksi Utama -->
                <div class="flex flex-wrap gap-4 pt-2 justify-center lg:justify-start">
                    <button onclick="openJanjiModal('')" class="bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-600 text-white font-black text-sm px-8 py-4 rounded-2xl shadow-blue-glow hover:scale-105 transition duration-300 flex items-center gap-3 group">
                        <i class="fa-solid fa-calendar-plus group-hover:rotate-12 transition duration-200"></i>
                        <span>Buat Janji Konsultasi</span>
                    </button>
                    <button onclick="openStatusModal()" class="bg-white border border-slate-300 text-slate-700 hover:border-brand-500 hover:text-brand-600 font-bold text-sm px-8 py-4 rounded-2xl transition duration-300 shadow-sm flex items-center gap-3">
                        <i class="fa-solid fa-magnifying-glass text-brand-500"></i>
                        <span>Cek Status Reservasi</span>
                    </button>
                </div>

                <!-- Stats Bar -->
                <div class="pt-8 grid grid-cols-3 gap-6 border-t border-slate-200 max-w-lg mx-auto lg:mx-0">
                    <div>
                        <span class="block text-3xl font-black text-brand-600">45+</span>
                        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Dokter Spesialis</span>
                    </div>
                    <div>
                        <span class="block text-3xl font-black text-brand-600">24/7</span>
                        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">UGD & Trauma</span>
                    </div>
                    <div>
                        <span class="block text-3xl font-black text-brand-600">99.8%</span>
                        <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Akurasi Medis</span>
                    </div>
                </div>
            </div>

            <!-- Widget Realtime Live Antrian RS -->
            <div id="antrian" class="lg:col-span-5 animate-float">
                <div class="bg-white p-8 rounded-3xl relative overflow-hidden shadow-card-float border border-brand-100">

                    <div class="flex justify-between items-center pb-6 border-b border-slate-100">
                        <div>
                            <div class="flex items-center gap-2.5">
                                <h3 class="font-black text-slate-900 text-lg tracking-wide">MONITOR POLIKLINIK</h3>
                                <span class="relative flex h-2.5 w-2.5">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                            </div>
                            <p class="text-xs text-brand-600 font-medium mt-0.5">Realtime Live Sync System</p>
                        </div>
                        <span class="bg-emerald-50 text-emerald-600 border border-emerald-200 text-[10px] font-black px-3.5 py-1 rounded-full tracking-widest uppercase shadow-sm">
                            LIVE
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 my-6">
                        <div class="bg-brand-50/60 p-5 rounded-2xl border border-brand-100 relative overflow-hidden group">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Poli Jantung</span>
                            <span class="text-4xl font-black text-brand-600 my-1 block tracking-tight">A-024</span>
                            <span class="text-[10px] font-bold text-slate-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-door-open text-brand-500"></i> Ruang Diagnostik 01
                            </span>
                        </div>
                        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 relative overflow-hidden group">
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Poli Anak</span>
                            <span class="text-4xl font-black text-slate-800 my-1 block tracking-tight">B-012</span>
                            <span class="text-[10px] font-bold text-slate-500 flex items-center gap-1.5">
                                <i class="fa-solid fa-door-open text-brand-400"></i> Ruang Pediatrik 03
                            </span>
                        </div>
                    </div>

                    <div id="fasilitas" class="bg-slate-50 p-4 rounded-2xl flex items-center justify-between text-xs border border-slate-200">
                        <div class="flex items-center space-x-3.5">
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-brand-600 border border-slate-200 shadow-sm">
                                <i class="fa-solid fa-bed-pulse text-lg"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">Ketersediaan Bed Kamar</p>
                                <p class="text-[10px] text-slate-500">VIP: <span class="text-brand-600 font-bold">4 Bed</span> | Kelas 1: <span class="text-brand-600 font-bold">12 Bed</span></p>
                            </div>
                        </div>
                        <button onclick="alert('Update Kamar Rawat Inap:\n- VIP: 4 Kamar Tersedia\n- Kelas 1: 12 Bed Tersedia\n- Kelas 2: 8 Bed Tersedia')" class="bg-white hover:bg-brand-50 text-brand-600 px-3.5 py-2 rounded-xl font-bold text-[11px] border border-brand-200 transition shadow-sm">
                            Detail
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION LAYANAN UNGGULAN -->
    <section id="layanan" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
                <span class="text-xs font-black text-brand-600 uppercase tracking-widest bg-brand-50 px-4 py-1.5 rounded-full border border-brand-200">Spesialisasi Unggulan</span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">Pusat Layanan Medis</h2>
                <p class="text-slate-600 text-sm leading-relaxed">Fasilitas perawatan tingkat lanjut dengan dukungan tim dokter spesialis dan peralatan medis mutakhir.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="light-card p-8 rounded-3xl space-y-6 flex flex-col justify-between border-t-4 border-t-brand-500">
                    <div class="space-y-4">
                        <div class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm font-black border border-brand-100">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Jantung & Kardiologi</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Pemeriksaan kardiologi komprehensif, kateterisasi jantung intervensi, dan rehabilitasi pasca operasi berstandar internasional.
                        </p>
                    </div>
                    <button onclick="openJanjiModal('dr. Ahmad Rizky, Sp.JP')" class="inline-flex items-center gap-2 text-xs font-black text-brand-600 hover:text-brand-800 uppercase tracking-wider group pt-2">
                        <span>Konsultasi Jantung</span>
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition duration-200"></i>
                    </button>
                </div>

                <!-- Card 2 -->
                <div class="light-card p-8 rounded-3xl space-y-6 flex flex-col justify-between border-t-4 border-t-sky-500">
                    <div class="space-y-4">
                        <div class="w-14 h-14 bg-sky-50 text-sky-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm font-black border border-sky-100">
                            <i class="fa-solid fa-brain"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Neuro & Bedah Saraf</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Penanganan gangguan saraf terpadu, Pusat Stroke 24 Jam, dan pemindaian MRI High-Precision untuk akurasi diagnosis maksimal.
                        </p>
                    </div>
                    <button onclick="openJanjiModal('')" class="inline-flex items-center gap-2 text-xs font-black text-brand-600 hover:text-brand-800 uppercase tracking-wider group pt-2">
                        <span>Konsultasi Saraf</span>
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition duration-200"></i>
                    </button>
                </div>

                <!-- Card 3 -->
                <div class="light-card p-8 rounded-3xl space-y-6 flex flex-col justify-between border-t-4 border-t-teal-500">
                    <div class="space-y-4">
                        <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm font-black border border-teal-100">
                            <i class="fa-solid fa-baby"></i>
                        </div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Kesehatan Ibu & Anak</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Layanan kebidanan, pemantauan janin 4D, imunisasi lengkap, serta unit perawatan intensif bayi baru lahir (NICU) terpadu.
                        </p>
                    </div>
                    <button onclick="openJanjiModal('dr. Sarah Amalia, Sp.A')" class="inline-flex items-center gap-2 text-xs font-black text-brand-600 hover:text-brand-800 uppercase tracking-wider group pt-2">
                        <span>Konsultasi Dokter Anak</span>
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition duration-200"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION DOKTER SPESIALIS -->
    <section id="dokter" class="py-20 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-4">
                <div>
                    <span class="text-xs font-black text-brand-600 uppercase tracking-widest bg-brand-50 px-4 py-1.5 rounded-full border border-brand-200">Tim Dokter Senior</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">Jadwal Dokter Spesialis</h2>
                    <p class="text-slate-600 text-sm mt-1">Pilih dokter spesialis dan tentukan jadwal kunjungan Anda</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Dokter 1 -->
                <div class="light-card p-6 rounded-3xl text-center space-y-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-24 h-24 mx-auto bg-brand-50 rounded-full flex items-center justify-center text-brand-600 text-4xl border-2 border-brand-200">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-base">dr. Ahmad Rizky, Sp.JP</h4>
                            <p class="text-xs text-brand-600 font-bold mt-0.5">Spesialis Jantung</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-2xl text-[11px] text-slate-600 border border-slate-200">
                            <p class="font-black text-slate-800">Senin - Kamis</p>
                            <p class="text-slate-500">09.00 - 14.00 WIB</p>
                        </div>
                    </div>
                    <button onclick="openJanjiModal('dr. Ahmad Rizky, Sp.JP')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black text-xs py-3 rounded-xl transition duration-300 shadow-sm">
                        Buat Janji
                    </button>
                </div>

                <!-- Dokter 2 -->
                <div class="light-card p-6 rounded-3xl text-center space-y-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-24 h-24 mx-auto bg-brand-50 rounded-full flex items-center justify-center text-brand-600 text-4xl border-2 border-brand-200">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-base">dr. Sarah Amalia, Sp.A</h4>
                            <p class="text-xs text-brand-600 font-bold mt-0.5">Spesialis Anak</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-2xl text-[11px] text-slate-600 border border-slate-200">
                            <p class="font-black text-slate-800">Selasa & Sabtu</p>
                            <p class="text-slate-500">10.00 - 16.00 WIB</p>
                        </div>
                    </div>
                    <button onclick="openJanjiModal('dr. Sarah Amalia, Sp.A')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black text-xs py-3 rounded-xl transition duration-300 shadow-sm">
                        Buat Janji
                    </button>
                </div>

                <!-- Dokter 3 -->
                <div class="light-card p-6 rounded-3xl text-center space-y-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-24 h-24 mx-auto bg-brand-50 rounded-full flex items-center justify-center text-brand-600 text-4xl border-2 border-brand-200">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-base">dr. Budi Santoso, Sp.PD</h4>
                            <p class="text-xs text-brand-600 font-bold mt-0.5">Penyakit Dalam</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-2xl text-[11px] text-slate-600 border border-slate-200">
                            <p class="font-black text-slate-800">Rabu - Jumat</p>
                            <p class="text-slate-500">13.00 - 18.00 WIB</p>
                        </div>
                    </div>
                    <button onclick="openJanjiModal('dr. Budi Santoso, Sp.PD')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black text-xs py-3 rounded-xl transition duration-300 shadow-sm">
                        Buat Janji
                    </button>
                </div>

                <!-- Dokter 4 -->
                <div class="light-card p-6 rounded-3xl text-center space-y-5 flex flex-col justify-between">
                    <div class="space-y-3">
                        <div class="w-24 h-24 mx-auto bg-brand-50 rounded-full flex items-center justify-center text-brand-600 text-4xl border-2 border-brand-200">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <div>
                            <h4 class="font-extrabold text-slate-900 text-base">dr. Maya Indah, Sp.M</h4>
                            <p class="text-xs text-brand-600 font-bold mt-0.5">Spesialis Mata</p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-2xl text-[11px] text-slate-600 border border-slate-200">
                            <p class="font-black text-slate-800">Senin & Jumat</p>
                            <p class="text-slate-500">08.00 - 12.00 WIB</p>
                        </div>
                    </div>
                    <button onclick="openJanjiModal('dr. Maya Indah, Sp.M')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black text-xs py-3 rounded-xl transition duration-300 shadow-sm">
                        Buat Janji
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER RS -->
    <footer class="bg-slate-900 text-slate-300 py-16 text-xs border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-10 mb-12">
            <div class="space-y-4">
                <div class="flex items-center space-x-3 text-white font-black text-xl">
                    <div class="w-9 h-9 bg-brand-500 text-white rounded-xl flex items-center justify-center text-base font-black">
                        <i class="fa-solid fa-notes-medical"></i>
                    </div>
                    <span>MEDIXA<span class="text-brand-400">.</span></span>
                </div>
                <p class="text-slate-400 leading-relaxed">Platform rumah sakit terintegrasi berbasis AI dan rekam medis digital mutakhir.</p>
            </div>
            <div>
                <h5 class="text-white font-bold mb-4 uppercase tracking-wider text-[11px] text-brand-400">Poliklinik</h5>
                <ul class="space-y-2.5 font-medium">
                    <li><a href="#dokter" class="hover:text-white transition">Poli Jantung & Kardiologi</a></li>
                    <li><a href="#dokter" class="hover:text-white transition">Poli Kesehatan Anak</a></li>
                    <li><a href="#dokter" class="hover:text-white transition">Poli Penyakit Dalam</a></li>
                    <li><a href="#dokter" class="hover:text-white transition">Poli Spesialis Mata</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold mb-4 uppercase tracking-wider text-[11px] text-brand-400">Layanan Pasien</h5>
                <ul class="space-y-2.5 font-medium">
                    <li><button onclick="toggleModal('loginModal')" class="hover:text-white transition text-left">Portal Rekam Medis Pasien</button></li>
                    <li><a href="#antrian" class="hover:text-white transition">Cek Ketersediaan Bed Kamar</a></li>
                    <li><button onclick="openJanjiModal('')" class="hover:text-white transition text-left">Jadwal Operasi & Tindakan</button></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold mb-4 uppercase tracking-wider text-[11px] text-brand-400">Kontak Darurat</h5>
                <p class="text-slate-400 leading-relaxed">Jl. Jendral Sudirman No. 88, Pusat Medis Kota</p>
                <p class="mt-3 text-white font-black text-sm flex items-center gap-2">
                    <i class="fa-solid fa-phone text-brand-400"></i> (021) 555-9111
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 pt-8 border-t border-slate-800 text-center text-slate-500 text-[11px]">
            <p>© 2026 MEDIXA Hospital Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- MODAL CEK STATUS PASIEN -->
    <div id="statusModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-md hidden transition-all duration-300">
        <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl relative mx-4 border border-slate-200">
            <button onclick="toggleModal('statusModal')" class="absolute top-6 right-6 w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-xl mx-auto mb-3 border border-brand-100">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <h3 class="text-xl font-black text-slate-900">Cek Status Reservasi</h3>
                <p class="text-xs text-slate-500 mt-1">Masukkan Kode Reservasi atau No. Rekam Medis</p>
            </div>

            <div id="statusSearchForm" class="space-y-4">
                <div class="bg-brand-50 p-3.5 rounded-2xl border border-brand-100">
                    <p class="text-[11px] text-slate-600 font-medium">💡 Contoh kode: <strong class="text-brand-700">RES-8821</strong></p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">KODE RESERVASI / REKAM MEDIS</label>
                    <input type="text" id="inputKodeRM" placeholder="Contoh: RES-8821" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs uppercase font-bold text-slate-800 focus:outline-none focus:border-brand-500 transition">
                </div>
                <button onclick="cekStatusPasien()" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black py-3.5 rounded-xl text-xs transition duration-300 shadow-blue-glow">
                    CEK STATUS SEKARANG
                </button>
            </div>

            <!-- Tampilan Hasil Status -->
            <div id="statusResult" class="hidden space-y-4">
                <div class="bg-slate-50 border border-emerald-200 p-5 rounded-2xl text-xs space-y-3">
                    <div class="flex justify-between items-center border-b border-slate-200 pb-2.5">
                        <span class="font-bold text-emerald-600 flex items-center gap-1.5">
                            <i class="fa-solid fa-circle-check text-emerald-500"></i> TERKONFIRMASI
                        </span>
                        <span class="bg-emerald-100 border border-emerald-200 text-emerald-700 text-[10px] font-bold px-2.5 py-0.5 rounded-full">Aktif</span>
                    </div>
                    <div class="text-slate-600 space-y-2 pt-1">
                        <p class="flex justify-between"><span>Kode Reservasi:</span> <strong id="resKode" class="text-brand-600 font-black">RES-8821</strong></p>
                        <p class="flex justify-between"><span>Nama Pasien:</span> <strong id="resNama" class="text-slate-800">Budi Santoso</strong></p>
                        <p class="flex justify-between"><span>Dokter Tujuan:</span> <strong id="resDokter" class="text-slate-800">dr. Ahmad Rizky, Sp.JP</strong></p>
                        <p class="flex justify-between"><span>Tanggal Kunjungan:</span> <strong id="resTanggal" class="text-slate-800">Besok (10:00 WIB)</strong></p>

                        <div class="bg-white p-3.5 rounded-xl border border-brand-200 mt-3 flex justify-between items-center shadow-sm">
                            <span class="text-[11px] text-slate-500 font-bold">Nomor Antrian Poli:</span>
                            <span id="resAntrian" class="text-3xl font-black text-brand-600">A-025</span>
                        </div>
                    </div>
                </div>

                <button onclick="resetCekStatus()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3 rounded-xl text-xs transition">
                    Cek Kode Lain
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL PORTAL LOGIN PASIEN -->
    <div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-md hidden transition-all duration-300">
        <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl relative mx-4 border border-slate-200">
            <button onclick="toggleModal('loginModal')" class="absolute top-6 right-6 w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-xl mx-auto mb-3 border border-brand-100">
                    <i class="fa-solid fa-hospital-user"></i>
                </div>
                <h3 class="text-xl font-black text-slate-900">Portal Masuk </h3>
                <p class="text-xs text-slate-500 mt-1">Akses Rekam Medis Digital & Hasil Lab</p>
            </div>
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">

    @csrf
    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">
            EMAIL
        </label>

        <input
        type="email"
        name="email"
        required
        placeholder="Masukkan Email"
        class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 mb-1.5">
            PASSWORD
        </label>

        <input
            type="password"
            name="password"
            required
            placeholder="Masukkan Password"
            class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-brand-500 transition">
    </div>

    <button
        type="submit"
        class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black py-3.5 rounded-xl text-xs transition duration-300 shadow-blue-glow">

        LOGIN

    </button>

</form>
    <!-- MODAL BUAT JANJI TEMU DOKTER -->
    <div id="janjiModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-md hidden transition-all duration-300">
        <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl relative mx-4 border border-slate-200">
            <button onclick="toggleModal('janjiModal')" class="absolute top-6 right-6 w-8 h-8 rounded-full bg-slate-100 text-slate-500 hover:text-slate-800 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-xl mx-auto mb-3 border border-brand-100">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h3 class="text-xl font-black text-slate-900">Buat Janji Dokter</h3>
                <p class="text-xs text-slate-500 mt-1">Reservasi Konsultasi Dokter Spesialis</p>
            </div>
            <form onsubmit="handleJanjiSubmit(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">NAMA PASIEN</label>
                    <input type="text" id="janjiNama" required placeholder="Nama Lengkap Pasien" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-brand-500 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">PILIH DOKTER SPESIALIS</label>
                    <select id="modalDokterSelect" class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-brand-500 transition">
                        <option value="dr. Ahmad Rizky, Sp.JP">dr. Ahmad Rizky, Sp.JP (Jantung)</option>
                        <option value="dr. Sarah Amalia, Sp.A">dr. Sarah Amalia, Sp.A (Anak)</option>
                        <option value="dr. Budi Santoso, Sp.PD">dr. Budi Santoso, Sp.PD (Penyakit Dalam)</option>
                        <option value="dr. Maya Indah, Sp.M">dr. Maya Indah, Sp.M (Mata)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">TANGGAL KUNJUNGAN</label>
                    <input type="date" id="janjiTanggal" required class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800 focus:outline-none focus:border-brand-500 transition">
                </div>
                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-black py-3.5 rounded-xl text-xs transition duration-300 shadow-blue-glow">
                    KONFIRMASI RESERVASI
                </button>
            </form>
        </div>
    </div>

    <!-- SCRIPT UTILITY INTERAKTIF -->
    <script>
        let dataReservasiTerakhir = null;

        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function openJanjiModal(namaDokter) {
            if (namaDokter) {
                document.getElementById('modalDokterSelect').value = namaDokter;
            }
            toggleModal('janjiModal');
        }

        function openStatusModal() {
            if (dataReservasiTerakhir) {
                document.getElementById('inputKodeRM').value = dataReservasiTerakhir.kode;
                tampilkanDetailStatus(dataReservasiTerakhir);
            } else {
                resetCekStatus();
            }
            toggleModal('statusModal');
        }

        function handleJanjiSubmit(e) {
            e.preventDefault();

            const nama = document.getElementById('janjiNama').value;
            const dokter = document.getElementById('modalDokterSelect').value;
            const tanggal = document.getElementById('janjiTanggal').value;

            const randomNum = Math.floor(1000 + Math.random() * 9000);
            const kodeReservasi = 'RES-' + randomNum;
            const noAntrian = 'A-0' + Math.floor(10 + Math.random() * 20);

            dataReservasiTerakhir = {
                kode: kodeReservasi,
                nama: nama,
                dokter: dokter,
                tanggal: tanggal,
                antrian: noAntrian
            };

            toggleModal('janjiModal');

            alert(`🎉 RESERVASI BERHASIL!\n\nNama: ${nama}\nKode Reservasi: ${kodeReservasi}\nNomor Antrian: ${noAntrian}\n\nKode otomatis tersimpan di menu Cek Status.`);

            openStatusModal();
        }

        function cekStatusPasien() {
            const inputRM = document.getElementById('inputKodeRM').value.trim();
            if (!inputRM) {
                alert('Silakan masukkan Kode Reservasi terlebih dahulu.');
                return;
            }

            if (dataReservasiTerakhir && inputRM.toUpperCase() === dataReservasiTerakhir.kode.toUpperCase()) {
                tampilkanDetailStatus(dataReservasiTerakhir);
            } else {
                const dummyData = {
                    kode: inputRM.toUpperCase(),
                    nama: "Pasien Medixa",
                    dokter: "dr. Ahmad Rizky, Sp.JP",
                    tanggal: "Hari Ini / Besok",
                    antrian: "A-0" + Math.floor(10 + Math.random() * 30)
                };
                tampilkanDetailStatus(dummyData);
            }
        }

        function tampilkanDetailStatus(data) {
            document.getElementById('resKode').innerText = data.kode;
            document.getElementById('resNama').innerText = data.nama;
            document.getElementById('resDokter').innerText = data.dokter;
            document.getElementById('resTanggal').innerText = data.tanggal;
            document.getElementById('resAntrian').innerText = data.antrian;

            document.getElementById('statusSearchForm').classList.add('hidden');
            document.getElementById('statusResult').classList.remove('hidden');
        }

        function resetCekStatus() {
            document.getElementById('statusSearchForm').classList.remove('hidden');
            document.getElementById('statusResult').classList.add('hidden');
            document.getElementById('inputKodeRM').value = '';
        }

        // function handleLogin(e) {
        //     e.preventDefault();
        //     alert('Login Berhasil! Mengalihkan ke Dashboard Pasien...');
        //     toggleModal('loginModal');
        // }
    </script>
</body>
</html>
