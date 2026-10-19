
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Obat - Kasir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--background);
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--blue-main);
            color: white;
            z-index: 1000;
        }

        .logo {
            height: 68px;
            display: flex;
            align-items: center;
            padding-left: 20px;
            font-size: 20px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .logo i { margin-right: 10px; }
        .menu { padding: 18px 10px; }

        .menu-title {
            font-size: 10px;
            opacity: .7;
            padding: 0 10px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 11px 12px;
            margin-bottom: 4px;
            border-radius: 8px;
            font-size: 13px;
        }

        .menu a:hover,
        .menu a.active {
            background: rgba(255,255,255,.16);
        }

        .menu a i {
            width: 18px;
            text-align: center;
        }

        .logout-area {
            position: absolute;
            bottom: 10px;
            width: 100%;
            padding: 0 12px;
        }

        .logout-btn {
            width: 100%;
            border: none;
            background: white;
            color: #dc3545;
            padding: 9px;
            border-radius: 7px;
            font-weight: 600;
            font-size: 13px;
        }

        .content {
            margin-left: 200px;
            min-height: 100vh;
        }

        .topbar {
            height: 68px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 22px;
        }

        .topbar-title {
            font-size: 13px;
            font-weight: 600;
            color: #222;
        }

        .user-info {
            font-size: 13px;
            color: #555;
        }

        .page { padding: 25px 22px; }

        .page-title {
            color: var(--blue-main);
            font-weight: 700;
            margin-bottom: 4px;
            font-size: 24px;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 25px;
        }

        .page-header {
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            color: white;
            border-radius: 14px;
            padding: 20px 22px;
            margin-bottom: 20px;
        }

        .page-header h4 {
            margin: 0;
            font-weight: 700;
        }

        .page-header p {
            margin: 5px 0 0;
            font-size: 13px;
            opacity: .9;
        }

        .payment-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
        }

        .payment-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #edf0f4;
        }

        .payment-card-header h5 {
            margin: 0;
            font-weight: 700;
            color: #1f2937;
        }

        .payment-table { margin: 0; }

        .payment-table thead th {
            background: #f4f8ff;
            color: #31557f;
            font-size: 13px;
            font-weight: 700;
            padding: 13px 15px;
            white-space: nowrap;
            border-bottom: 1px solid #dce8f8;
        }

        .payment-table tbody td {
            padding: 15px;
            vertical-align: middle;
            font-size: 13px;
            color: #374151;
        }

        .payment-table tbody tr:hover {
            background: #f8fbff;
        }

        .patient-name {
            font-weight: 700;
            color: var(--blue-main);
        }

        .doctor-name { font-weight: 600; }

        .medicine-badge {
            display: inline-block;
            background: var(--blue-light);
            color: var(--blue-dark);
            padding: 5px 9px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            margin: 2px;
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

        .btn-process {
            background: var(--blue-main);
            color: white;
            border: none;
            padding: 9px 12px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600;
            width: 100%;
            white-space: nowrap;
        }

        .btn-process:hover {
            background: var(--blue-dark);
            color: white;
        }

        .payment-input {
            min-width: 130px;
            font-size: 12px;
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
            .sidebar { width: 65px; }
            .logo {
                padding-left: 20px;
                font-size: 18px;
            }
            .logo { font-size: 0; }
            .logo i { font-size: 20px; }
            .menu-title, .menu a span { display: none; }
            .menu a {
                justify-content: center;
                padding: 12px 5px;
            }
            .logout-btn { font-size: 0; }
            .logout-btn i { font-size: 14px; margin: 0 !important; }
            .content { margin-left: 65px; }
            .page { padding: 18px 12px; }
            .topbar { padding: 0 12px; }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="logo">
            <i class="fa-solid fa-hospital"></i>
            SIM RS
        </div>

        <div class="menu">
            <div class="menu-title">Menu Kasir</div>

            <a href="{{ route('kasir.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kasir.resep') }}">
                <i class="fa-solid fa-file-prescription"></i>
                <span>Resep dari Dokter</span>
            </a>

            <a href="{{ route('kasir.pembayaran') }}" class="active">
                <i class="fa-solid fa-money-bill-wave"></i>
                <span>Pembayaran Obat</span>
            </a>
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

    {{-- CONTENT --}}
    <div class="content">

        <div class="topbar">
            <div class="topbar-title">Pembayaran Obat</div>

            <div class="user-info">
                <i class="fa-solid fa-user me-2"></i>
                {{ auth()->user()->name }}
            </div>
        </div>

        <div class="page">

            <h3 class="page-title">Pembayaran Obat</h3>

            <div class="page-subtitle">
                Proses pembayaran obat pasien berdasarkan resep dokter.
            </div>

            {{-- PESAN BERHASIL --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- PESAN GAGAL --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- VALIDASI --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Pembayaran belum berhasil:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- HEADER --}}
            <div class="page-header">
                <h4>
                    <i class="fa-solid fa-money-bill-wave me-2"></i>
                    Pembayaran Obat Pasien
                </h4>
                <p>Pilih resep pasien yang akan diproses untuk pembayaran.</p>
            </div>

            {{-- DATA RESEP --}}
            <div class="payment-card">

                <div class="payment-card-header">
                    <h5>
                        <i class="fa-solid fa-receipt text-primary me-2"></i>
                        Daftar Resep untuk Pembayaran
                    </h5>
                </div>

                <div class="table-responsive">
                    <table class="table payment-table mb-0">

                        <thead>
                            <tr>
                                <th width="60">No</th>
                                <th>Pasien</th>
                                <th>Dokter</th>
                                <th>Obat</th>
                                <th>Jumlah</th>
                                <th>Aturan Pakai</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($resepObats as $index => $resep)
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
                                        @forelse($resep->obat as $obat)
                                            <span class="medicine-badge">
                                                {{ $obat->nama }}
                                            </span>
                                        @empty
                                            <span class="text-muted">Tidak ada obat</span>
                                        @endforelse
                                    </td>

                                    <td>
                                        @forelse($resep->obat as $obat)
                                            <span class="quantity-badge">
                                                {{ $obat->pivot->nilai ?? '-' }}
                                            </span>
                                        @empty
                                            -
                                        @endforelse
                                    </td>

                                    <td>
                                        @forelse($resep->obat as $obat)
                                            <div class="mb-1">
                                                {{ $obat->pivot->aturan_pakai ?? '-' }}
                                            </div>
                                        @empty
                                            -
                                        @endforelse
                                    </td>

                                    <td>
                                        @if($resep->obat->isEmpty())
                                            <button type="button"
                                                    class="btn btn-secondary btn-sm"
                                                    disabled>
                                                Tidak Ada Obat
                                            </button>
                                        @else
                                            <form
                                                action="{{ route('kasir.pembayaran.proses', $resep->id) }}"
                                                method="POST"
                                                class="d-flex flex-column gap-2"
                                            >
                                                @csrf

                                                <input
                                                    type="number"
                                                    name="total_pembayaran"
                                                    class="form-control payment-input"
                                                    placeholder="Total (Rp)"
                                                    min="0.01"
                                                    step="0.01"
                                                    value="{{ old('total_pembayaran') }}"
                                                    required
                                                >

                                                <button type="submit" class="btn-process">
                                                    <i class="fa-solid fa-credit-card me-1"></i>
                                                    Proses Bayar
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fa-solid fa-file-invoice-dollar d-block"></i>
                                            <h6>Belum Ada Resep</h6>
                                            <p>
                                                Belum ada resep obat yang dapat diproses untuk pembayaran.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- PAGINATION --}}
                @if($resepObats->hasPages())
                    <div class="pagination-wrapper">
                        {{ $resepObats->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
