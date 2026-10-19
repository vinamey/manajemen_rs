
@php
    $isApoteker = auth()->user()->hasRole('apoteker');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Resep dari Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
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

        .content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .topbar {
            min-height: 65px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
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
            border-radius: 16px;
            padding: 22px 25px;
            margin-bottom: 25px;
            box-shadow: 0 5px 15px rgba(24,119,242,.18);
        }

        .page-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .page-header p {
            margin: 5px 0 0;
            opacity: .9;
            font-size: 14px;
        }

        .recipe-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
            overflow: hidden;
        }

        .recipe-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
        }

        .recipe-card-header h5 {
            margin: 0;
            font-weight: 700;
            color: #1f2937;
        }

        .recipe-table {
            margin: 0;
            min-width: 1050px;
        }

        .recipe-table thead th {
            background: #f4f8ff;
            color: #31557f;
            font-size: 13px;
            font-weight: 700;
            border-bottom: 1px solid #dce8f8;
            padding: 14px 12px;
            white-space: nowrap;
        }

        .recipe-table tbody td {
            padding: 15px 12px;
            vertical-align: middle;
            font-size: 13px;
            color: #374151;
            border-bottom: 1px solid #edf0f4;
        }

        .recipe-table tbody tr:hover {
            background: #f8fbff;
        }

        .patient-name {
            font-weight: 700;
            color: var(--blue-main);
        }

        .doctor-name {
            font-weight: 600;
            color: #374151;
            white-space: nowrap;
        }

        .medicine-badge {
            display: inline-block;
            background: var(--blue-light);
            color: var(--blue-dark);
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
        }

        .quantity-badge {
            display: inline-block;
            background: #eefbf3;
            color: #16834b;
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 700;
        }

        .aturan-pakai {
            min-width: 120px;
            max-width: 200px;
            white-space: normal;
            overflow-wrap: anywhere;
            line-height: 1.6;
        }

        .empty-state {
            text-align: center;
            padding: 55px 20px;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 42px;
            color: #b8c8dc;
            margin-bottom: 12px;
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
            padding: 15px 20px;
            border-top: 1px solid #edf0f4;
        }

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
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-hospital me-2"></i>
            SIM RS
        </div>

        <div class="menu">
            <div class="menu-title">
                Menu {{ $isApoteker ? 'Apoteker' : 'Kasir' }}
            </div>

            @if($isApoteker)
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
        </div>

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

    {{-- KONTEN UTAMA --}}
    <div class="content">
        <div class="topbar">
            <div class="topbar-title">Resep dari Dokter</div>

            <div class="user-info">
                <i class="fa-solid fa-user me-2"></i>
                {{ auth()->user()->name }}
            </div>
        </div>

        <div class="page">
            <div class="page-header">
                <h4>
                    <i class="fa-solid fa-file-prescription me-2"></i>
                    Resep dari Dokter
                </h4>
                <p>Daftar resep obat yang diberikan oleh dokter kepada pasien.</p>
            </div>

            <div class="recipe-card">
                <div class="recipe-card-header">
                    <h5>
                        <i class="fa-solid fa-prescription-bottle-medical text-primary me-2"></i>
                        Daftar Resep
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table recipe-table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Obat</th>
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

                                        preg_match('/Dosis:\s*(.*?)(?=\s*\|\s*Frekuensi:|$)/i', $teks, $dosis);
                                        preg_match('/Frekuensi:\s*(.*?)(?=\s*\|\s*Aturan:|$)/i', $teks, $frekuensi);
                                        preg_match('/Aturan:\s*(.*?)(?=\s*\|\s*Lama:|$)/i', $teks, $aturan);
                                        preg_match('/Lama:\s*(.*)/i', $teks, $lama);
                                    @endphp

                                    <tr>
                                        <td>{{ $resepObats->firstItem() + $index }}</td>

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
                                                {{ $obat->nama }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="quantity-badge">
                                                {{ $obat->pivot->nilai ?? '-' }}
                                            </span>
                                        </td>

                                        <td>{{ trim($dosis[1] ?? '-') }}</td>
                                        <td>{{ trim($frekuensi[1] ?? '-') }}</td>
                                        <td>
                                            <div class="aturan-pakai">
                                                {{ trim($aturan [1] ?? '-') }}
                                            </div>
                                        </td>
                                        <td>{{ trim($lama[1] ?? '-') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>{{ $resepObats->firstItem() + $index }}</td>
                                        <td>{{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}</td>
                                        <td>{{ $resep->pemeriksaan?->dokter?->nama ?? '-' }}</td>
                                        <td colspan="6" class="text-muted">Belum ada obat</td>
                                    </tr>
                                @endforelse
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-file-prescription d-block"></i>
                                            <h6>Belum Ada Resep</h6>
                                            <p>Belum ada resep obat dari dokter yang tersedia.</p>
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
            </div>
        </div>
    </div>

</body>
</html>
