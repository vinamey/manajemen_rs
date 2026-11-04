
@php
    $user = auth()->user();

    $isApoteker = $user->hasRole('apoteker');
    $isDokter = $user->hasRole('dokter');

    $roleName = $isApoteker ? 'Apoteker' : ($isDokter ? 'Dokter' : 'Kasir');
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resep Dokter - SIM RS</title>

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
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            color: #555;
        }

        /* =========================
           PAGE
        ========================= */

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
           BANNER RESEP
        ========================= */

        .page-header {
            background: linear-gradient(
                120deg,
                #1877f2 0%,
                #1263d9 55%,
                #0f58c6 100%
            );
            color: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(24,119,242,.10);
        }

        .page-header h4 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 21px;
            font-weight: 700;
            margin: 0;
        }

        .page-header p {
            font-size: 13px;
            margin: 9px 0 0;
            color: rgba(255,255,255,.95);
        }

        /* =========================
           KARTU DAFTAR RESEP
        ========================= */

        .recipe-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,.025);
        }

        .recipe-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 20px 22px;
            border-bottom: 1px solid #edf0f4;
        }

        .recipe-card-title {
            min-width: 0;
        }

        .recipe-card-header h5 {
            margin: 0;
            color: #243247;
            font-size: 17px;
            font-weight: 700;
        }

        .recipe-card-header p {
            margin: 7px 0 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        /* =========================
           SEARCH
        ========================= */

        .search-box {
            position: relative;
            width: 350px;
            max-width: 100%;
            flex-shrink: 0;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #8a9bb3;
            font-size: 14px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            height: 43px;
            padding: 10px 14px 10px 40px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            outline: none;
            background: white;
            color: var(--text-dark);
            font-size: 12px;
            transition: .2s;
        }

        .search-input:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24,119,242,.09);
        }

        .search-input::placeholder {
            color: #8a94a6;
        }

        /* =========================
           TABEL RESEP
        ========================= */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        .recipe-table {
            width: 100%;
            min-width: 1000px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .recipe-table thead th {
            padding: 15px 12px;
            background: var(--blue-main);
            color: white;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
            border: none;
            vertical-align: middle;
        }

        .recipe-table thead th:first-child {
            padding-left: 19px;
        }

        .recipe-table tbody td {
            padding: 15px 12px;
            background: white;
            color: #374151;
            font-size: 12px;
            vertical-align: middle;
            border-bottom: 1px solid #edf0f4;
        }

        .recipe-table tbody tr:last-child td {
            border-bottom: none;
        }

        .recipe-table tbody tr:hover td {
            background: #f6f9ff;
        }

        .patient-name {
            min-width: 120px;
            color: var(--blue-dark);
            font-weight: 700;
        }

        .doctor-name {
            font-weight: 600;
            white-space: nowrap;
        }

        .medicine-badge {
            display: inline-block;
            padding: 6px 9px;
            background: var(--blue-light);
            color: var(--blue-dark);
            border-radius: 7px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .quantity-badge {
            display: inline-block;
            padding: 6px 9px;
            background: #eaf9f0;
            color: #16834b;
            border-radius: 7px;
            font-size: 11px;
            font-weight: 700;
        }

        .instruction-cell {
            min-width: 100px;
        }

        .instruction-value {
            display: inline-block;
            padding: 6px 8px;
            background: #edf5ff;
            color: #1859a9;
            border-radius: 6px;
            font-size: 11px;
            line-height: 1.5;
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .aturan-pakai {
            min-width: 120px;
            max-width: 200px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        /* =========================
           EMPTY STATE
        ========================= */

        .empty-state {
            padding: 65px 20px;
            text-align: center;
            color: #6b7280;
        }

        .empty-state i {
            display: block;
            margin-bottom: 13px;
            color: #b8c8dc;
            font-size: 40px;
        }

        .empty-state h6 {
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
            font-weight: 700;
        }

        .empty-state p {
            margin: 0;
            color: #718096;
            font-size: 12px;
        }

        .no-search-result {
            display: none;
            padding: 35px 15px;
            color: var(--text-muted);
            font-size: 12px;
            text-align: center;
        }

        /* =========================
           FOOTER
        ========================= */

        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 18px 22px;
            border-top: 1px solid #edf0f4;
        }

        .table-info-text {
            margin: 0;
            color: var(--text-muted);
            font-size: 12px;
        }

        .pagination {
            margin: 0;
        }

        .pagination .page-link {
            color: var(--blue-main);
            font-size: 12px;
        }

        .pagination .active .page-link {
            background: var(--blue-main);
            border-color: var(--blue-main);
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

            .recipe-card-header {
                align-items: stretch;
                flex-direction: column;
            }

            .search-box {
                width: 100%;
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

            .topbar {
                padding: 0 12px;
            }

            .topbar-title {
                font-size: 12px;
            }

            .page-header {
                padding: 18px;
            }

            .page-header h4 {
                font-size: 17px;
            }

            .recipe-card-header {
                padding: 15px;
            }

            .pagination-wrapper {
                align-items: flex-start;
                flex-direction: column;
                padding: 15px;
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

            <a href="{{ route('kasir.dashboard') }}"
               class="{{ request()->routeIs('kasir.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kasir.resep') }}"
               class="{{ request()->routeIs('kasir.resep') ? 'active' : '' }}">
                <i class="fa-solid fa-file-prescription"></i>
                <span>Resep dari Dokter</span>
            </a>

            <a href="{{ route('kasir.pembayaran') }}"
               class="{{ request()->routeIs('kasir.pembayaran') ? 'active' : '' }}">
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
                Resep Dokter
            </div>

            <div class="user-info">
                <i class="fa-solid fa-user me-2"></i>
                {{ $user->name }}
                <span class="text-muted">({{ $roleName }})</span>
            </div>

        </div>


        <!-- PAGE -->

        <div class="page">

            <!-- BANNER RESEP -->

            <section class="page-header">

                <h4>
                    <i class="fa-solid fa-file-prescription"></i>
                    Resep Dokter
                </h4>

                <p>
                    Daftar resep obat dari hasil pemeriksaan dokter.
                </p>

            </section>


            <!-- DAFTAR RESEP -->

            <section class="recipe-card">

                <!-- JUDUL DAN SEARCH -->

                <div class="recipe-card-header">

                    <div class="recipe-card-title">

                        <h5>
                            Daftar Resep Obat
                        </h5>

                        <p>
                            Informasi pasien, dokter, dan obat yang diresepkan.
                        </p>

                    </div>

                    <div class="search-box">

                        <i class="fa-solid fa-magnifying-glass"></i>

                        <input
                            type="text"
                            id="searchResep"
                            class="search-input"
                            placeholder="Cari pasien, dokter, atau obat..."
                            autocomplete="off"
                            aria-label="Cari resep dokter"
                        >

                    </div>

                </div>


                <!-- TABEL -->

                <div class="table-responsive">

                    <table class="table recipe-table">

                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Dosis</th>
                                <th>Frekuensi</th>
                                <th>Aturan Pakai</th>
                                <th>Lama</th>
                            </tr>
                        </thead>

                        <tbody id="resepTableBody">

                            @forelse($resepObats as $index => $resep)

                                @forelse($resep->obat as $obat)

                                    @php
                                        $teks = $obat->pivot->aturan_pakai ?? '';

                                        $dosis = [];
                                        $frekuensi = [];
                                        $aturan = [];
                                        $lama = [];

                                        preg_match('/Dosis:\s*(.*?)(?=\s*\|\s*Frekuensi:|$)/i', $teks, $dosis);
                                        preg_match('/Frekuensi:\s*(.*?)(?=\s*\|\s*Aturan:|$)/i', $teks, $frekuensi);
                                        preg_match('/Aturan:\s*(.*?)(?=\s*\|\s*Lama:|$)/i', $teks, $aturan);
                                        preg_match('/Lama:\s*(.*)/i', $teks, $lama);

                                        $namaPasien = $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-';
                                        $namaDokter = $resep->pemeriksaan?->dokter?->nama ?? '-';
                                        $namaObat = $obat->nama ?? '-';
                                    @endphp

                                    <tr class="resep-row">

                                        <td>
                                            {{ $resepObats->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <div class="patient-name">
                                                {{ $namaPasien }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="doctor-name">
                                                <i class="fa-solid fa-user-doctor text-primary me-1"></i>
                                                {{ $namaDokter }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="medicine-badge">
                                                {{ $namaObat }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="quantity-badge">
                                                {{ $obat->pivot->nilai ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="instruction-cell">
                                            <span class="instruction-value">
                                                {{ trim($dosis[1] ?? '-') ?: '-' }}
                                            </span>
                                        </td>

                                        <td class="instruction-cell">
                                            <span class="instruction-value">
                                                {{ trim($frekuensi[1] ?? '-') ?: '-' }}
                                            </span>
                                        </td>

                                        <td class="instruction-cell">
                                            <div class="aturan-pakai">
                                                <span class="instruction-value">
                                                    {{ trim($aturan[1] ?? '-') ?: '-' }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="instruction-cell">
                                            <span class="instruction-value">
                                                {{ trim($lama[1] ?? '-') ?: '-' }}
                                            </span>
                                        </td>

                                    </tr>

                                @empty

                                    <tr class="resep-row">

                                        <td>
                                            {{ $resepObats->firstItem() + $index }}
                                        </td>

                                        <td>
                                            <div class="patient-name">
                                                {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="doctor-name">
                                                {{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}
                                            </span>
                                        </td>

                                        <td colspan="6" class="text-muted">
                                            Belum ada obat pada resep ini.
                                        </td>

                                    </tr>

                                @endforelse

                            @empty

                                <tr id="emptyDataRow">

                                    <td colspan="9">

                                        <div class="empty-state">

                                            <i class="fa-solid fa-prescription-bottle-medical"></i>

                                            <h6>
                                                Belum ada resep dokter
                                            </h6>

                                            <p>
                                                Resep yang tersedia akan ditampilkan di sini.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>


                    <!-- PESAN PENCARIAN KOSONG -->

                    <div class="no-search-result" id="noSearchResult">

                        <i class="fa-solid fa-magnifying-glass mb-2"></i>

                        <div>
                            Data resep yang kamu cari tidak ditemukan.
                        </div>

                    </div>

                </div>


                <!-- FOOTER DAN PAGINATION -->

                <div class="pagination-wrapper">

                    <p class="table-info-text" id="tableInfo">
                        Menampilkan {{ $resepObats->count() }} resep pada halaman ini
                    </p>

                    @if($resepObats->hasPages())

                        <div>
                            {{ $resepObats->links() }}
                        </div>

                    @endif

                </div>

            </section>

        </div>

    </div>


    <!-- =========================
         JAVASCRIPT PENCARIAN
    ========================= -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('searchResep');
            const tableBody = document.getElementById('resepTableBody');
            const noSearchResult = document.getElementById('noSearchResult');
            const tableInfo = document.getElementById('tableInfo');

            if (!searchInput || !tableBody) {
                return;
            }

            searchInput.addEventListener('input', function () {

                const keyword = this.value.toLowerCase().trim();
                const rows = tableBody.querySelectorAll('.resep-row');

                let visibleCount = 0;

                rows.forEach(function (row) {

                    const rowText = row.textContent.toLowerCase();
                    const cocok = rowText.includes(keyword);

                    row.style.display = cocok ? '' : 'none';

                    if (cocok) {
                        visibleCount++;
                    }

                });

                if (noSearchResult) {

                    noSearchResult.style.display =
                        visibleCount === 0 && keyword !== ''
                            ? 'block'
                            : 'none';

                }

                if (tableInfo) {

                    if (keyword !== '') {

                        tableInfo.textContent =
                            'Menampilkan ' + visibleCount +
                            ' hasil pencarian pada halaman ini';

                    } else {

                        tableInfo.textContent =
                            'Menampilkan {{ $resepObats->count() }} resep pada halaman ini';

                    }

                }

            });

        });
    </script>

</body>
</html>
