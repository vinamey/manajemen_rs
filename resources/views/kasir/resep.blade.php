
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

    <title>Resep dari Dokter | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
            --border: #e5eaf2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
            color: #1f2937;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--blue-main);
            color: white;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .logo {
            min-height: 65px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .menu {
            padding: 20px 12px;
            flex: 1;
            overflow-y: auto;
        }

        .menu-title {
            font-size: 12px;
            opacity: .75;
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
            transition: .2s;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,.18);
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        .logout-area {
            padding: 15px;
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

        /* KONTEN */
        .content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            min-height: 65px;
            background: white;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 28px;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 700;
        }

        .user-info {
            font-size: 14px;
            color: #555;
        }

        .page {
            padding: 28px;
        }

        .page-header {
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            color: white;
            border-radius: 14px;
            padding: 22px 25px;
            margin-bottom: 24px;
            box-shadow: 0 5px 15px rgba(24,119,242,.15);
        }

        .page-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .page-header p {
            margin: 6px 0 0;
            opacity: .9;
            font-size: 13px;
        }

        /* KARTU TABEL */
        .recipe-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 15px rgba(0,0,0,.04);
            overflow: hidden;
        }

        .recipe-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
        }

        .recipe-card-header h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #1f2937;
        }

        .table-responsive {
            width: 100%;
        }

        /* TABEL RESEP */
        .recipe-table {
            width: 100%;
            min-width: 1150px;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .recipe-table thead th {
            background: var(--blue-main);
            color: white;
            font-size: 12px;
            font-weight: 700;
            padding: 14px 12px;
            white-space: nowrap;
            border-right: 1px solid rgba(255,255,255,.2);
            border-bottom: 1px solid var(--blue-dark);
        }

        .recipe-table thead th:last-child {
            border-right: none;
        }

        .recipe-table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            font-size: 13px;
            color: #374151;
            background: white;
            border-bottom: 1px solid #e9edf4;
        }

        .recipe-table tbody tr:hover td {
            background: #f4f8ff;
        }

        .patient-name {
            font-weight: 700;
            color: var(--blue-dark);
            min-width: 120px;
        }

        .doctor-name {
            font-weight: 600;
            white-space: nowrap;
        }

        .medicine-badge {
            display: inline-block;
            background: var(--blue-light);
            color: var(--blue-dark);
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .quantity-badge {
            display: inline-block;
            background: #eaf9f0;
            color: #16834b;
            padding: 6px 10px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
        }

        /* SETIAP ATURAN DITAMPILKAN TERPISAH */
        .instruction-cell {
            min-width: 130px;
        }

        .instruction-value {
            display: inline-block;
            background: #edf5ff;
            color: #1859a9;
            padding: 7px 10px;
            border-radius: 7px;
            font-size: 12px;
            line-height: 1.5;
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .aturan-pakai {
            min-width: 150px;
            max-width: 220px;
            line-height: 1.6;
            white-space: normal;
            overflow-wrap: anywhere;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 40px;
            color: #b8c8dc;
            margin-bottom: 14px;
        }

        .empty-state h6 {
            font-weight: 700;
            color: #4b5563;
        }

        .empty-state p {
            font-size: 13px;
            margin: 0;
        }

        .pagination-wrapper {
            padding: 16px 20px;
            border-top: 1px solid #edf0f4;
        }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            color: var(--blue-main);
        }

        .pagination .active .page-link {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }

            .page {
                padding: 15px;
            }

            .topbar {
                padding: 15px;
                flex-wrap: wrap;
            }

            .page-header {
                padding: 18px;
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 65px;
            }

            .logo {
                justify-content: center;
                padding: 0;
                font-size: 0;
            }

            .logo i {
                font-size: 22px;
                margin: 0 !important;
            }

            .menu {
                padding: 15px 7px;
            }

            .menu-title,
            .menu a span {
                display: none;
            }

            .menu a {
                justify-content: center;
                padding: 13px 5px;
            }

            .menu a i {
                font-size: 17px;
            }

            .content {
                margin-left: 65px;
            }

            .logout-area {
                padding: 8px;
            }

            .logout-btn {
                font-size: 0;
            }

            .logout-btn i {
                font-size: 16px;
                margin: 0 !important;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-hospital me-2"></i>
            SIM RS
        </div>

        <nav class="menu">
            <div class="menu-title">
                Menu {{ $isDokter ? 'Dokter' : ($isApoteker ? 'Apoteker' : 'Kasir') }}
            </div>

            @if($isDokter)
                <a href="{{ route('dokter.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('dokter.pasien.index') }}">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span>Data Pasien</span>
                </a>

                <a href="{{ route('dokter.resep.index') }}" class="active">
                    <i class="fa-solid fa-file-prescription"></i>
                    <span>Resep Obat</span>
                </a>
            @elseif($isApoteker)
                <a href="{{ route('apoteker.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('kasir.resep') }}" class="active">
                    <i class="fa-solid fa-file-prescription"></i>
                    <span>Resep Dokter</span>
                </a>
            @else
                <a href="{{ route('kasir.dashboard') }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('kasir.resep') }}" class="active">
                    <i class="fa-solid fa-file-prescription"></i>
                    <span>Resep dari Dokter</span>
                </a>

                <a href="{{ route('kasir.pembayaran') }}">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span>Pembayaran Obat</span>
                </a>
            @endif
        </nav>

        <div class="logout-area">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- KONTEN UTAMA --}}
    <main class="content">
        <header class="topbar">
            <div class="topbar-title">Resep dari Dokter</div>

            <div class="user-info">
                <i class="fa-solid fa-user me-2"></i>
                {{ $user->name }}
            </div>
        </header>

        <div class="page">

            <section class="page-header">
                <h4>
                    <i class="fa-solid fa-file-prescription me-2"></i>
                    Resep dari Dokter
                </h4>
                <p>
                    Daftar resep obat yang diberikan dokter kepada pasien.
                </p>
            </section>

            <section class="recipe-card">
                <div class="recipe-card-header">
                    <h5>
                        <i class="fa-solid fa-prescription-bottle-medical text-primary me-2"></i>
                        Daftar Resep Obat
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table recipe-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Dosis</th>
                                <th>Frekuensi</th>
                                <th>Aturan Pakai</th>
                                <th>Lama</th>
                            </tr>
                        </thead>

                        <tbody>
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
@endphp

                                    <tr>
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
                                                <i class="fa-solid fa-user-doctor text-primary me-1"></i>
                                                {{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="medicine-badge">
                                                {{ $obat->nama ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="quantity-badge">
                                                {{ $obat->pivot->nilai ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="instruction-cell">
                                            <span class="instruction-value">
                                                {{ trim($dosis[1] ?? '-') }}
                                            </span>
                                        </td>

                                        <td class="instruction-cell">
                                            <span class="instruction-value">
                                                {{ trim($frekuensi[1] ?? '-') }}
                                            </span>
                                        </td>

                                        <td class="instruction-cell">
                                            <div class="aturan-pakai">
                                                <span class="instruction-value">
                                                    {{ trim($aturan[1] ?? '-') }}
                                                </span>
                                            </div>
                                        </td>

                                        <td class="instruction-cell">
                                            <span class="instruction-value">
                                                {{ trim($lama[1] ?? '-') }}
                                            </span>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td>
                                            {{ $resepObats->firstItem() + $index }}
                                        </td>
                                        <td>
                                            {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                                        </td>
                                        <td>
                                            {{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}
                                        </td>
                                        <td colspan="6" class="text-muted">
                                            Belum ada obat pada resep ini.
                                        </td>
                                    </tr>
                                @endforelse

                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-file-prescription d-block"></i>
                                            <h6>Belum Ada Resep</h6>
                                            <p>
                                                Belum ada resep obat dari dokter yang tersedia.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($resepObats->hasPages())
                    <div class="pagination-wrapper">
                        {{ $resepObats->links() }}
                    </div>
                @endif
            </section>

        </div>
    </main>

</body>
</html>
