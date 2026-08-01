<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDIXA - Integrated Health & Hospital Center</title>

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
                            50: '#eff6ff',
                            100: '#dbeaff',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        cyanmed: {
                            400: '#22d3ee',
                            500: '#06b6d4',
                            600: '#0891b2',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f4f8fc;
            color: #0f172a;
        }

        .med-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 10px 30px -10px rgba(37, 99, 235, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .med-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -12px rgba(37, 99, 235, 0.15);
            border-color: #bfdbfe;
        }

        .badge-cyan {
            background: #e0f2fe;
            color: #0369a1;
        }
    </style>
</head>
<body class="selection:bg-brand-500 selection:text-white">

    <!-- TOP BAR Darurat -->
    <div class="bg-brand-900 text-white text-xs py-2 px-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <span><i class="fa-solid fa-phone-volume text-cyanmed-400 mr-2"></i>UGD 24 Jam: <strong>(021) 555-9111</strong></span>
            <span class="hidden md:inline"><i class="fa-solid fa-clock text-cyanmed-400 mr-2"></i>Jam Operasional Poliklinik: 08:00 - 21:00 WIB</span>
        </div>
        <button onclick="openJanjiModal('')" class="bg-cyanmed-500 hover:bg-cyanmed-600 text-slate-900 font-extrabold px-3 py-1 rounded text-[11px] transition">
            BUAT JANJI DOKTER
        </button>
    </div>

    <!-- NAVBAR CLEAN WHITE & BLUE -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- Logo Medixa -->
            <a href="#" class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-brand-600 text-white rounded-xl flex items-center justify-center text-xl shadow-lg shadow-brand-500/30">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div>
                    <span class="text-2xl font-black text-slate-900 tracking-tight">MEDIXA</span>
                    <span class="block text-[10px] font-bold text-brand-600 uppercase tracking-wider">Hospital & Clinical Center</span>
                </div>
            </a>

            <!-- Menu Utama -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="#layanan" class="hover:text-brand-600 transition">Layanan Medis</a>
                <a href="#dokter" class="hover:text-brand-600 transition">Jadwal Dokter</a>
                <a href="#antrian" class="hover:text-brand-600 transition">Cek Antrian</a>
                <a href="#fasilitas" class="hover:text-brand-600 transition">Fasilitas RS</a>
            </nav>

            <!-- Akses Rekam Medis / Status Pasien -->
            <button onclick="toggleModal('loginModal')" class="bg-brand-50 border border-brand-200 text-brand-700 hover:bg-brand-600 hover:text-white px-5 py-2.5 rounded-xl font-bold text-xs transition flex items-center space-x-2">
                <i class="fa-solid fa-user-check"></i>
                <span>LOGIN</span>
            </button>
        </div>
    </header>

    <!-- HERO SECTION: Patient Center -->
    <section class="py-16 bg-gradient-to-b from-brand-50/50 to-transparent">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-7 space-y-6">
                <span class="badge-cyan text-xs font-bold px-3.5 py-1.5 rounded-full inline-flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved"></i> Layanan Kesehatan Terakreditasi Paripurna
                </span>

                <h1 class="text-4xl sm:text-5xl font-black text-slate-900 leading-tight">
                    Pusat Layanan Kesehatan <br>
                    <span class="text-brand-600">Terpadu & Digital</span>
                </h1>

                <p class="text-slate-600 leading-relaxed text-base">
                    Akses rekam medis, pendaftaran antrian rawat jalan, dan konsultasi spesialis secara daring dengan sistem manajemen rumah sakit terintegrasi.
                </p>

                <!-- Tombol Aksi Cepat -->
                <div class="flex flex-wrap gap-4 pt-2">
                    <button onclick="openJanjiModal('')" class="bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm px-6 py-3.5 rounded-xl shadow-lg shadow-brand-600/30 transition flex items-center gap-2">
                        <i class="fa-solid fa-calendar-plus"></i> Buat Janji Konsultasi
                    </button>
                    <button onclick="openStatusModal()" class="bg-white border border-slate-200 text-slate-700 hover:border-brand-300 font-bold text-sm px-6 py-3.5 rounded-xl transition flex items-center gap-2">
                        <i class="fa-solid fa-id-card text-brand-600"></i> Cek Status Janji / Pasien
                    </button>
                </div>
            </div>

            <!-- Widget Realtime Live Antrian RS -->
            <div id="antrian" class="lg:col-span-5 space-y-4">
                <div class="med-card p-6 rounded-3xl relative overflow-hidden">
                    <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                        <div>
                            <h3 class="font-bold text-slate-900">Monitor Antrian Poliklinik</h3>
                            <p class="text-xs text-slate-500">Update Realtime Hari Ini</p>
                        </div>
                        <span class="bg-emerald-100 text-emerald-800 text-[10px] font-extrabold px-2.5 py-1 rounded-md animate-pulse">LIVE</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 my-6">
                        <div class="bg-brand-50 p-4 rounded-2xl border border-brand-100">
                            <span class="text-xs font-semibold text-brand-800 block">Poli Jantung</span>
                            <span class="text-3xl font-black text-brand-600">A-024</span>
                            <span class="text-[10px] text-slate-500 block mt-1">Sedang Dilayani: Ruang 1</span>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <span class="text-xs font-semibold text-slate-600 block">Poli Anak</span>
                            <span class="text-3xl font-black text-slate-800">B-012</span>
                            <span class="text-[10px] text-slate-500 block mt-1">Sedang Dilayani: Ruang 3</span>
                        </div>
                    </div>

                    <div id="fasilitas" class="bg-slate-900 text-white p-4 rounded-2xl flex items-center justify-between text-xs">
                        <div class="flex items-center space-x-3">
                            <i class="fa-solid fa-bed-pulse text-cyanmed-400 text-lg"></i>
                            <div>
                                <p class="font-bold">Ketersediaan Bed Kamar</p>
                                <p class="text-[10px] text-slate-300">VIP: 4 Bed | Kelas 1: 12 Bed Available</p>
                            </div>
                        </div>
                        <button onclick="alert('Ketersediaan Kamar Terupdate:\n- VIP: 4 Kamar Tersedia\n- Kelas 1: 12 Bed Tersedia\n- Kelas 2: 8 Bed Tersedia')" class="text-cyanmed-400 hover:underline font-bold text-[11px]">
                            Cek Kamar
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION LAYANAN UNGGULAN -->
    <section id="layanan" class="py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-xl mx-auto space-y-2 mb-12">
                <h2 class="text-3xl font-black text-slate-900">Layanan Medis Unggulan</h2>
                <p class="text-slate-500 text-sm">Fasilitas dan penanganan medis terbaik berstandar internasional</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="med-card p-8 rounded-3xl space-y-4">
                    <div class="w-14 h-14 bg-brand-100 text-brand-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Pusat Jantung & Pembuluh Darah</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Pemeriksaan kardiologi komprehensif, kateterisasi jantung, dan rehabilitasi pasca operasi dengan tim dokter spesialis senior.
                    </p>
                    <button onclick="openJanjiModal('dr. Ahmad Rizky, Sp.JP')" class="inline-block text-xs font-bold text-brand-600 hover:underline">Pelajari Layanan &rarr;</button>
                </div>

                <!-- Card 2 -->
                <div class="med-card p-8 rounded-3xl space-y-4">
                    <div class="w-14 h-14 bg-cyan-100 text-cyanmed-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Neuro & Bedah Saraf</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Penanganan gangguan saraf, stroke center, dan pemindaian MRI high-definition untuk akurasi diagnosis yang lebih tinggi.
                    </p>
                    <button onclick="openJanjiModal('')" class="inline-block text-xs font-bold text-brand-600 hover:underline">Pelajari Layanan &rarr;</button>
                </div>

                <!-- Card 3 -->
                <div class="med-card p-8 rounded-3xl space-y-4">
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                        <i class="fa-solid fa-baby"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">Kesehatan Ibu & Anak</h3>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Layanan kebidanan, kandungan, imunisasi anak lengkap, dan perawatan neonatal intensif (NICU) terpadu.
                    </p>
                    <button onclick="openJanjiModal('dr. Sarah Amalia, Sp.A')" class="inline-block text-xs font-bold text-brand-600 hover:underline">Pelajari Layanan &rarr;</button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION DOKTER SPESIALIS -->
    <section id="dokter" class="py-16 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12">
                <div>
                    <h2 class="text-3xl font-black text-slate-900">Tim Dokter Medixa</h2>
                    <p class="text-slate-500 text-sm mt-1">Jadwal praktek dokter spesialis dan konsultan</p>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Dokter 1 -->
                <div class="med-card p-6 rounded-3xl text-center space-y-3">
                    <div class="w-24 h-24 mx-auto bg-slate-100 rounded-full flex items-center justify-center text-slate-400 text-4xl border-2 border-brand-200">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">dr. Ahmad Rizky, Sp.JP</h4>
                        <p class="text-xs text-brand-600 font-medium">Spesialis Jantung & Pembuluh</p>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl text-[11px] text-slate-600">
                        <p><strong>Praktek:</strong> Senin - Kamis</p>
                        <p class="text-slate-400">09.00 - 14.00 WIB</p>
                    </div>
                    <button onclick="openJanjiModal('dr. Ahmad Rizky, Sp.JP')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs py-2.5 rounded-xl transition">
                        Buat Janji
                    </button>
                </div>

                <!-- Dokter 2 -->
                <div class="med-card p-6 rounded-3xl text-center space-y-3">
                    <div class="w-24 h-24 mx-auto bg-slate-100 rounded-full flex items-center justify-center text-slate-400 text-4xl border-2 border-cyanmed-400">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">dr. Sarah Amalia, Sp.A</h4>
                        <p class="text-xs text-brand-600 font-medium">Spesialis Kesehatan Anak</p>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl text-[11px] text-slate-600">
                        <p><strong>Praktek:</strong> Selasa & Sabtu</p>
                        <p class="text-slate-400">10.00 - 16.00 WIB</p>
                    </div>
                    <button onclick="openJanjiModal('dr. Sarah Amalia, Sp.A')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs py-2.5 rounded-xl transition">
                        Buat Janji
                    </button>
                </div>

                <!-- Dokter 3 -->
                <div class="med-card p-6 rounded-3xl text-center space-y-3">
                    <div class="w-24 h-24 mx-auto bg-slate-100 rounded-full flex items-center justify-center text-slate-400 text-4xl border-2 border-brand-200">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">dr. Budi Santoso, Sp.PD</h4>
                        <p class="text-xs text-brand-600 font-medium">Spesialis Penyakit Dalam</p>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl text-[11px] text-slate-600">
                        <p><strong>Praktek:</strong> Rabu - Jumat</p>
                        <p class="text-slate-400">13.00 - 18.00 WIB</p>
                    </div>
                    <button onclick="openJanjiModal('dr. Budi Santoso, Sp.PD')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs py-2.5 rounded-xl transition">
                        Buat Janji
                    </button>
                </div>

                <!-- Dokter 4 -->
                <div class="med-card p-6 rounded-3xl text-center space-y-3">
                    <div class="w-24 h-24 mx-auto bg-slate-100 rounded-full flex items-center justify-center text-slate-400 text-4xl border-2 border-cyanmed-400">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-base">dr. Maya Indah, Sp.M</h4>
                        <p class="text-xs text-brand-600 font-medium">Spesialis Mata / Ophtalmology</p>
                    </div>
                    <div class="bg-slate-50 p-2.5 rounded-xl text-[11px] text-slate-600">
                        <p><strong>Praktek:</strong> Senin & Jumat</p>
                        <p class="text-slate-400">08.00 - 12.00 WIB</p>
                    </div>
                    <button onclick="openJanjiModal('dr. Maya Indah, Sp.M')" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs py-2.5 rounded-xl transition">
                        Buat Janji
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER RS -->
    <footer class="bg-slate-900 text-slate-400 py-12 text-xs">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8 mb-8">
            <div class="space-y-3">
                <div class="flex items-center space-x-2 text-white font-bold text-lg">
                    <i class="fa-solid fa-hospital text-brand-500"></i>
                    <span>MEDIXA HEALTH</span>
                </div>
                <p>Rumah sakit terintegrasi dengan teknologi digital rekam medis terkini.</p>
            </div>
            <div>
                <h5 class="text-white font-bold mb-3 uppercase tracking-wider text-[11px]">Poliklinik</h5>
                <ul class="space-y-2">
                    <li><a href="#dokter" class="hover:text-white">Poli Jantung & Pembuluh</a></li>
                    <li><a href="#dokter" class="hover:text-white">Poli Anak & Tumbuh Tumbuh</a></li>
                    <li><a href="#dokter" class="hover:text-white">Poli Penyakit Dalam</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold mb-3 uppercase tracking-wider text-[11px]">Layanan Pasien</h5>
                <ul class="space-y-2">
                    <li><button onclick="toggleModal('loginModal')" class="hover:text-white text-left">Portal Rekam Medis Pasien</button></li>
                    <li><a href="#antrian" class="hover:text-white">Cek Ketersediaan Bed Kamar</a></li>
                    <li><button onclick="openJanjiModal('')" class="hover:text-white text-left">Jadwal Operasi & Tindakan</button></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold mb-3 uppercase tracking-wider text-[11px]">Lokasi Utama</h5>
                <p>Jl. Jendral Sudirman No. 88, Pusat Medis Kota</p>
                <p class="mt-2 text-white font-bold">Call Center: (021) 555-9111</p>
            </div>
        </div>
        <div class="text-center pt-8 border-t border-slate-800 text-[11px]">
            <p>© 2026 MEDIXA Hospital Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- MODAL CEK STATUS PASIEN -->
    <div id="statusModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm hidden">
        <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl relative mx-4">
            <button onclick="toggleModal('statusModal')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <div class="text-center mb-6">
                <i class="fa-solid fa-id-card text-4xl text-brand-600 mb-2"></i>
                <h3 class="text-xl font-bold text-slate-900">Cek Status Janji / Pasien</h3>
                <p class="text-xs text-slate-500">Masukkan Kode Reservasi atau No. Rekam Medis Kamu</p>
            </div>

            <div id="statusSearchForm" class="space-y-4">
                <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-200">
                    <p class="text-[11px] text-slate-500 mb-1">💡 <strong>Petunjuk Cepat:</strong></p>
                    <p class="text-[11px] text-slate-600">Jika sudah daftar janji, kode otomatis terisi. Atau masukkan kode contoh: <strong class="text-brand-600">RES-8821</strong></p>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">KODE RESERVASI / REKAM MEDIS</label>
                    <input type="text" id="inputKodeRM" placeholder="Contoh: RES-8821 atau RM-9982" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs uppercase font-bold focus:outline-none focus:border-brand-600">
                </div>
                <button onclick="cekStatusPasien()" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl text-xs transition">
                    CEK STATUS SEKARANG
                </button>
            </div>

            <!-- Tampilan Hasil Status -->
            <div id="statusResult" class="hidden space-y-4 pt-2">
                <div class="bg-emerald-50 border border-emerald-200 p-4 rounded-2xl text-xs space-y-2">
                    <div class="flex justify-between items-center border-b border-emerald-200/60 pb-2">
                        <span class="font-bold text-emerald-900">Status: TERKONFIRMASI</span>
                        <span class="bg-emerald-200 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded">Aktif</span>
                    </div>
                    <div class="text-slate-700 space-y-1.5 pt-1">
                        <p><strong>Kode Reservasi:</strong> <span id="resKode" class="font-extrabold text-brand-600">RES-8821</span></p>
                        <p><strong>Nama Pasien:</strong> <span id="resNama">Budi Santoso</span></p>
                        <p><strong>Dokter Tujuan:</strong> <span id="resDokter">dr. Ahmad Rizky, Sp.JP</span></p>
                        <p><strong>Tanggal Kunjungan:</strong> <span id="resTanggal">Besok (10:00 WIB)</span></p>
                        <div class="bg-white p-2.5 rounded-xl border border-emerald-200 mt-2 flex justify-between items-center">
                            <span class="text-[11px] text-slate-500 font-semibold">Nomor Antrian Poli:</span>
                            <span id="resAntrian" class="text-xl font-black text-brand-600">A-025</span>
                        </div>
                    </div>
                </div>

                <button onclick="resetCekStatus()" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-2.5 rounded-xl text-xs transition">
                    Cek Kode Lain
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL PORTAL LOGIN PASIEN / STAF -->
    <div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm hidden">
        <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl relative mx-4">
            <button onclick="toggleModal('loginModal')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <div class="text-center mb-6">
                <i class="fa-solid fa-hospital-user text-4xl text-brand-600 mb-2"></i>
                <h3 class="text-xl font-bold text-slate-900">Portal Masuk Pasien / Staf</h3>
                <p class="text-xs text-slate-500">Masukkan Nomor Rekam Medis (RM) atau ID Staf</p>
            </div>
            <form onsubmit="handleLogin(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NO. REKAM MEDIS / ID</label>
                    <input type="text" required placeholder="Contoh: RM-998231" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">KATA SANDI</label>
                    <input type="password" required placeholder="12345678" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-brand-600">
                </div>
                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl text-xs transition">
                    MASUK KONTROL PANEL
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL BUAT JANJI TEMU DOKTER -->
    <div id="janjiModal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/50 backdrop-blur-sm hidden">
        <div class="bg-white w-full max-w-md p-8 rounded-3xl shadow-2xl relative mx-4">
            <button onclick="toggleModal('janjiModal')" class="absolute top-5 right-5 text-slate-400 hover:text-slate-700">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <div class="text-center mb-6">
                <i class="fa-solid fa-calendar-check text-4xl text-brand-600 mb-2"></i>
                <h3 class="text-xl font-bold text-slate-900">Buat Janji Dokter</h3>
                <p class="text-xs text-slate-500">Isi formulir untuk reservasi antrian berobat</p>
            </div>
            <form onsubmit="handleJanjiSubmit(event)" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">NAMA PASIEN</label>
                    <input type="text" id="janjiNama" required placeholder="Nama Lengkap Pasien" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-brand-600">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">PILIH DOKTER SPESIALIS</label>
                    <select id="modalDokterSelect" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-brand-600">
                        <option value="dr. Ahmad Rizky, Sp.JP">dr. Ahmad Rizky, Sp.JP (Jantung)</option>
                        <option value="dr. Sarah Amalia, Sp.A">dr. Sarah Amalia, Sp.A (Anak)</option>
                        <option value="dr. Budi Santoso, Sp.PD">dr. Budi Santoso, Sp.PD (Penyakit Dalam)</option>
                        <option value="dr. Maya Indah, Sp.M">dr. Maya Indah, Sp.M (Mata)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">TANGGAL KUNJUNGAN</label>
                    <input type="date" id="janjiTanggal" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-brand-600">
                </div>
                <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl text-xs transition">
                    KONFIRMASI RESERVASI
                </button>
            </form>
        </div>
    </div>

    <!-- SCRIPT UTILITY INTERAKTIF -->
    <script>
        // Data Sementara Reservasi Pasien
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
            // Jika pasien sudah pernah bikin janji, otomatis langsung tampilkan datanya
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

            // Generate Kode Reservasi & Antrian Otomatis
            const randomNum = Math.floor(1000 + Math.random() * 9000);
            const kodeReservasi = 'RES-' + randomNum;
            const noAntrian = 'A-0' + Math.floor(10 + Math.random() * 20);

            // Simpan data ke memory
            dataReservasiTerakhir = {
                kode: kodeReservasi,
                nama: nama,
                dokter: dokter,
                tanggal: tanggal,
                antrian: noAntrian
            };

            toggleModal('janjiModal');

            // Tampilkan Alert Sukses dengan Kode Reservasi Pasien
            alert(`🎉 RESERVASI BERHASIL!\n\nNama: ${nama}\nKode Reservasi Anda: ${kodeReservasi}\nNomor Antrian: ${noAntrian}\n\nSilakan gunakan Kode Reservasi (${kodeReservasi}) ini pada menu Cek Status Pasien.`);

            // Buka Modal Status Pasien Secara Otomatis
            openStatusModal();
        }

        function cekStatusPasien() {
            const inputRM = document.getElementById('inputKodeRM').value.trim();
            if (!inputRM) {
                alert('Silakan masukkan Kode Reservasi atau No. Rekam Medis terlebih dahulu.');
                return;
            }

            // Jika kode cocok dengan janji terakhir
            if (dataReservasiTerakhir && inputRM.toUpperCase() === dataReservasiTerakhir.kode.toUpperCase()) {
                tampilkanDetailStatus(dataReservasiTerakhir);
            } else {
                // Generasi data dummy untuk peragaan kode acak
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

        function handleLogin(e) {
            e.preventDefault();
            alert('Login Berhasil! Mengalihkan ke Kontrol Panel Pasien...');
            toggleModal('loginModal');
        }
    </script>
</body>
</html>
