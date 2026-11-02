@php
    $user = auth()->user();

    $isApoteker = $user->hasRole('apoteker');
    $isDokter = $user->hasRole('dokter');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resep Dokter | SIM RS</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
            --border: #e5eaf2;
            --text-dark: #1f2937;
            --text-muted: #718096;
        }

        /* RESET MENGHILANGKAN SIDEBAR & MEMBUAT FULL WIDTH */
        body, html {
            width: 100% !important;
            min-height: 100vh;
            margin: 0 !important;
            padding: 0 !important;
            background: var(--background);
            font-family: Arial, Helvetica, sans-serif;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* Menyembunyikan elemen sidebar bawaan layout lain jika ada */
        .sidebar,
        aside.sidebar,
        #sidebar,
        .main-sidebar,
        .app-sidebar,
        nav.sidebar {
            display: none !important;
            width: 0 !important;
            visibility: hidden !important;
        }

        /* Memaksa wrapper utama dan konten agar tidak menyisakan ruang untuk sidebar */
        .wrapper,
        .main-wrapper,
        .content-wrapper,
        .main-content,
        #app {
            margin-left: 0 !important;
            padding-left: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            min-height: 100vh;
        }

        * {
            box-sizing: border-box;
        }

        /* =========================
            KONTEN UTAMA
        ========================= */
        .content {
            width: 100% !important;
            max-width: 100% !important;
            min-height: 100vh;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* =========================
            HEADER ATAS
        ========================= */
        .topbar {
            width: 100%;
            min-height: 82px;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: var(--background);
            border-bottom: none;
        }

        .topbar-title {
            font-size: 14px;
            font-weight: 700;
            color: #172b4d;
            margin-bottom: 4px;
        }

        .topbar-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            margin: 0;
        }

        /* =========================
            INFORMASI PENGGUNA
        ========================= */
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 12px;
            flex-shrink: 0;
        }

        .user-icon {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 10px;
            font-size: 16px;
        }

        .user-name {
            font-size: 12px;
            font-weight: 700;
            color: #172b4d;
            margin-bottom: 4px;
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted);
            margin: 0;
        }

        /* =========================
            AREA HALAMAN
        ========================= */
        .page {
            width: 100%;
            padding: 20px 24px 30px;
        }

        /* =========================
            BANNER JUDUL
        ========================= */
        .page-header {
            position: relative;
            overflow: hidden;
            background: linear-gradient(
                120deg,
                #1877f2 0%,
                #1263d9 55%,
                #0f58c6 100%
            );
            color: #ffffff;
            border-radius: 14px;
            padding: 20px 22px;
            margin-bottom: 20px;
            box-shadow: 0 7px 20px rgba(24, 119, 242, 0.13);
        }

        .page-header h4 {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .page-header h4 i {
            font-size: 18px;
        }

        .page-header p {
            margin: 7px 0 0;
            font-size: 12px;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.95);
        }

        /* =========================
            KARTU DAFTAR RESEP
        ========================= */
        .recipe-card {
            width: 100%;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(31, 41, 55, 0.035);
            overflow: hidden;
        }

        .recipe-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 16px 18px;
            border-bottom: 1px solid #edf0f4;
        }

        .recipe-card-title {
            min-width: 0;
        }

        .recipe-card-header h5 {
            margin: 0;
            color: #243247;
            font-size: 15px;
            font-weight: 700;
        }

        .recipe-card-header p {
            margin: 5px 0 0;
            color: var(--text-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================
            PENCARIAN
        ========================= */
        .search-box {
            position: relative;
            width: 280px;
            max-width: 100%;
            flex-shrink: 0;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #8a9bb3;
            font-size: 13px;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            height: 38px;
            padding: 8px 12px 8px 34px;
            border: 1px solid var(--border);
            border-radius: 9px;
            outline: none;
            background: #ffffff;
            color: var(--text-dark);
            font-size: 11px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.09);
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
            padding: 12px 10px;
            background: var(--blue-main);
            color: #ffffff;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
            border: none;
            vertical-align: middle;
        }

        .recipe-table thead th:first-child {
            padding-left: 15px;
        }

        .recipe-table tbody td {
            padding: 13px 10px;
            background: #ffffff;
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
            TIDAK ADA DATA
        ========================= */
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
        }

        .empty-state i {
            display: block;
            margin-bottom: 12px;
            color: #b8c8dc;
            font-size: 36px;
        }

        .empty-state h6 {
            margin-bottom: 7px;
            color: #374151;
            font-size: 12px;
            font-weight: 700;
        }

        .empty-state p {
            margin: 0;
            color: #718096;
            font-size: 11px;
            line-height: 1.6;
        }

        .no-search-result {
            display: none;
            padding: 30px 15px;
            color: var(--text-muted);
            font-size: 12px;
            text-align: center;
        }

        /* =========================
            FOOTER TABEL
        ========================= */
        .pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            padding: 14px 18px;
            border-top: 1px solid #edf0f4;
        }

        .table-info-text {
            margin: 0;
            color: var(--text-muted);
            font-size: 11px;
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
            color: #ffffff;
        }

        /* =========================
            RESPONSIVE TABLET
        ========================= */
        @media (max-width: 768px) {
            .topbar {
                min-height: auto;
                padding: 15px;
            }

            .page {
                padding: 15px;
            }

            .page-header {
                padding: 18px;
                margin-bottom: 16px;
            }

            .page-header h4 {
                font-size: 18px;
            }

            .recipe-card-header {
                align-items: stretch;
                flex-direction: column;
                padding: 15px;
            }

            .search-box {
                width: 100%;
            }

            .user-profile {
                padding: 8px;
            }

            .user-icon {
                width: 34px;
                height: 34px;
            }

            .pagination-wrapper {
                padding: 13px 15px;
            }
        }

        /* =========================
            RESPONSIVE HP
        ========================= */
        @media (max-width: 480px) {
            .topbar {
                align-items: flex-start;
                gap: 10px;
            }

            .topbar-title {
                font-size: 12px;
            }

            .topbar-subtitle {
                font-size: 10px;
            }

            .user-profile {
                gap: 7px;
                max-width: 155px;
            }

            .user-name {
                font-size: 10px;
            }

            .user-role {
                font-size: 10px;
            }

            .page {
                padding: 12px;
            }

            .page-header {
                padding: 16px;
                border-radius: 11px;
            }

            .page-header h4 {
                font-size: 16px;
            }

            .page-header p {
                font-size: 11px;
            }

            .recipe-card {
                border-radius: 11px;
            }

            .recipe-card-header h5 {
                font-size: 14px;
            }

            .pagination-wrapper {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    {{-- KONTEN UTAMA FULL WIDTH TANPA SIDEBAR --}}
    <main class="content">

        {{-- HEADER ATAS --}}
        <header class="topbar">
            <div>
                <div class="topbar-title">
                    Resep Dokter
                </div>


            </div>

            {{-- INFORMASI PENGGUNA --}}
            <div class="user-profile">
                <div class="user-icon">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <div>
                    <div class="user-name">
                        {{ $user->name }}
                    </div>

                    <p class="user-role">
                        {{ $isApoteker ? 'Apoteker' : ($isDokter ? 'Dokter' : 'Kasir') }}
                    </p>
                </div>
            </div>
        </header>

        {{-- ISI HALAMAN --}}
        <div class="page">

            {{-- BANNER JUDUL --}}
            <section class="page-header">
                <h4>
                    <i class="fa-solid fa-file-prescription"></i>
                    Resep Dokter
                </h4>
                <p>
                    Daftar resep obat dari hasil pemeriksaan dokter.
                </p>
            </section>

            {{-- KARTU DAFTAR RESEP --}}
            <section class="recipe-card">

                {{-- JUDUL DAN PENCARIAN --}}
                <div class="recipe-card-header">
                    <div class="recipe-card-title">
                        <h5>
                            Daftar Resep Obat
                        </h5>
                        <p>
                            Informasi pasien, dokter, dan obat yang diresepkan.
                        </p>
                    </div>

                    {{-- PENCARIAN --}}
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

                {{-- TABEL --}}
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
                                            <h6>Belum ada resep dokter</h6>
                                            <p>
                                                Resep yang tersedia akan ditampilkan di sini.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- PESAN JIKA HASIL PENCARIAN TIDAK ADA --}}
                    <div class="no-search-result" id="noSearchResult">
                        <i class="fa-solid fa-magnifying-glass mb-2"></i>
                        <div>
                            Data resep yang kamu cari tidak ditemukan.
                        </div>
                    </div>
                </div>

                {{-- FOOTER DAN PAGINATION --}}
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

    </main>

    {{-- JAVASCRIPT PENCARIAN --}}
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
                            'Menampilkan ' + rows.length +
                            ' resep pada halaman ini';
                    }
                }
            });
        });
    </script>

</body>
</html>

