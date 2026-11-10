
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resep Dokter - Apoteker | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            color: var(--text-dark);
        }

        /* SIDEBAR */

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, var(--blue-main), var(--blue-dark));
            color: white;
            padding-top: 20px;
            box-shadow: 3px 0 15px rgba(0, 0, 0, 0.08);
            z-index: 1000;
        }

        .logo {
            text-align: center;
            font-weight: 700;
            font-size: 21px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            background: white;
            color: var(--blue-main);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 22px;
        }

        .sidebar-line {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.25);
            margin: 0 18px 15px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
            padding: 0 20px;
            margin-bottom: 7px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            margin: 4px 12px;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: white;
            color: var(--blue-main);
            font-weight: 600;
        }

        .menu-icon {
            width: 22px;
            text-align: center;
            font-size: 17px;
        }

        /* LOGOUT */

        .logout-box {
            position: absolute;
            bottom: 20px;
            left: 12px;
            right: 12px;
        }

        .logout-btn {
            border: none;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            width: 100%;
            padding: 11px;
            border-radius: 10px;
            font-weight: 600;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: white;
            color: var(--blue-main);
        }

        /* CONTENT */

        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        /* HEADER */

        .page-header {
            background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
            color: white;
            border: none;
            border-radius: 18px;
            padding: 25px;
            margin-bottom: 27px;
            box-shadow: 0 8px 20px rgba(24, 119, 242, 0.18);
        }

        .page-header h3 {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 15px;
        }

        /* CARD */

        .content-card {
            width: 100%;
            background: white;
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .card-heading {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #edf0f5;
            flex-wrap: wrap;
        }

        .card-heading h5 {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 7px;
        }

        .card-heading p {
            margin: 0;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* SEARCH */

        .search-box {
            position: relative;
            width: 305px;
            max-width: 100%;
        }

        .search-box i {
            position: absolute;
            left: 14px;
            top: 14px;
            color: #8b96a8;
        }

        .search-box input {
            width: 100%;
            border: 1px solid #e5eaf2;
            border-radius: 10px;
            padding: 12px 12px 12px 40px;
            outline: none;
            font-size: 13px;
        }

        .search-box input:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.1);
        }

        /* TABLE */

        .table-responsive {
            padding: 0 23px;
        }

        .table {
            margin: 0;
            vertical-align: middle;
            font-size: 13px;
            min-width: 1350px;
        }

        .table thead th {
            background: var(--blue-main);
            color: white;
            padding: 16px 13px;
            white-space: nowrap;
            border: none;
            font-weight: 600;
        }

        .table tbody td {
            padding: 15px 13px;
            border-bottom: 1px solid #edf0f5;
        }

        .table tbody tr:hover:not(.empty-row) {
            background: #f7faff;
        }

        .number-badge {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-width: 29px;
            height: 29px;
            padding: 0 7px;
            border-radius: 8px;
            color: var(--blue-dark);
            background: var(--blue-light);
            font-weight: 700;
        }

        .patient-name {
            font-weight: 700;
            color: #27364b;
        }

        .medicine-name {
            font-weight: 700;
            color: var(--blue-dark);
        }

        .instruction {
            display: inline-block;
            background: #f1f5fb;
            color: #52627a;
            padding: 6px 9px;
            border-radius: 6px;
            margin: 2px 0;
        }

        /* STATUS */

        .status-badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-menunggu {
            background: #fff3cd;
            color: #856404;
        }

        /* PROCESS BUTTON */

        .btn-proses {
            background: var(--blue-main);
            color: white;
            border: none;
            padding: 9px 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            transition: 0.2s;
        }

        .btn-proses:hover {
            background: var(--blue-dark);
            color: white;
        }

        /* EMPTY */

        .empty-state {
            padding: 60px 20px !important;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state i {
            display: block;
            font-size: 37px;
            color: #b8c9df;
            margin-bottom: 15px;
        }

        .empty-state strong {
            display: block;
            color: #253247;
            font-size: 14px;
        }

        .empty-state div {
            margin-top: 12px;
            font-size: 13px;
        }

        .card-footer-custom {
            padding: 18px 25px;
            border-top: 1px solid #edf0f5;
            font-size: 13px;
            color: var(--text-muted);
        }

        .pagination {
            margin: 0;
            justify-content: flex-end;
        }

        .pagination .page-link {
            font-size: 12px;
            color: var(--blue-main);
        }

        .pagination .active .page-link {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: white;
        }

        /* RESPONSIVE */

        @media(max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
            }
        }

        @media(max-width: 600px) {
            .sidebar {
                width: 75px;
            }

            .logo {
                font-size: 12px;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
            }

            .menu-title {
                font-size: 0;
            }

            .sidebar a {
                justify-content: center;
                padding: 12px 5px;
            }

            .sidebar a span:not(.menu-icon) {
                display: none;
            }

            .sidebar a .menu-icon {
                font-size: 18px;
            }

            .logout-btn {
                font-size: 0;
            }

            .content {
                margin-left: 75px;
                padding: 20px 12px;
            }

            .page-header {
                padding: 20px;
            }

            .page-header h3 {
                font-size: 21px;
            }

            .card-heading {
                align-items: stretch;
            }

            .search-box {
                width: 100%;
            }

            .card-footer-custom {
                align-items: flex-start !important;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <div class="logo-icon">💊</div>
            SIM RS
        </div>

        <hr class="sidebar-line">

        <div class="menu-title">Menu Apoteker</div>

        <a href="{{ route('apoteker.dashboard') }}">
            <span class="menu-icon">🏠</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('apoteker.obat.index') }}">
            <span class="menu-icon">💊</span>
            <span>Data Obat</span>
        </a>

        <a href="{{ route('log-stok-obat.index') }}">
            <span class="menu-icon">🛒</span>
            <span>Log Stok Obat</span>
        </a>

        <a href="{{ route('apoteker.supplier.index') }}">
            <span class="menu-icon">🏢</span>
            <span>Supplier Obat</span>
        </a>

        <a href="{{ route('apoteker.resep.index') }}" class="active">
            <span class="menu-icon">
                <i class="fa-solid fa-file-prescription"></i>
            </span>
            <span>Resep Dokter</span>
        </a>

        <div class="logout-box">
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    🚪 &nbsp; Logout
                </button>
            </form>
        </div>

    </div>

    <!-- MAIN CONTENT -->

    <div class="content">

        <section class="page-header">
            <h3>
                <i class="fa-solid fa-file-prescription me-2"></i>
                Resep Dokter
            </h3>

            <p>
                Daftar resep obat dari hasil pemeriksaan dokter.
            </p>
        </section>

        <!-- ALERT SUCCESS -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ALERT ERROR -->

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-exclamation me-2"></i>
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- DAFTAR RESEP -->

        <section class="content-card">

            <div class="card-heading">

                <div>
                    <h5>Daftar Resep Obat</h5>
                    <p>Informasi pasien, dokter, dan obat yang diresepkan.</p>
                </div>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text"
                        id="searchResep"
                        placeholder="Cari pasien, dokter, atau obat..."
                        autocomplete="off">
                </div>

            </div>

            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table" id="tabelResep">

                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pasien</th>
                            <th>Dokter</th>
                            <th>Nama Obat</th>
                            <th>Satuan</th>
                            <th>Jumlah</th>
                            <th>Dosis</th>
                            <th>Frekuensi</th>
                            <th>Aturan Pakai</th>
                            <th>Lama</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($resepObats as $resep)

                            @php
                                $detailReseps = $resep->detailResep;
                            @endphp

                            @forelse ($detailReseps as $detail)

                                @php
                                    $obat = $detail->obat;
                                    $satuan = $detail->satuan;

                                    $teks = $detail->aturan_pakai ?? '';

                                    preg_match(
                                        '/Dosis:\s*(.*?)(?=\s*\|\s*Frekuensi:|$)/i',
                                        $teks,
                                        $dosis
                                    );

                                    preg_match(
                                        '/Frekuensi:\s*(.*?)(?=\s*\|\s*Aturan:|$)/i',
                                        $teks,
                                        $frekuensi
                                    );

                                    preg_match(
                                        '/Aturan:\s*(.*?)(?=\s*\|\s*Lama:|$)/i',
                                        $teks,
                                        $aturan
                                    );

                                    preg_match(
                                        '/Lama:\s*(.*)/i',
                                        $teks,
                                        $lama
                                    );
                                @endphp

                                <tr class="resep-row">

                                    <td>
                                        <span class="number-badge">
                                            {{ ($resepObats->firstItem() ?? 1) + $loop->parent->index }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="patient-name">
                                            {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? 'Belum ada data' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $resep->pemeriksaan?->dokter?->nama ?? 'Belum ada data' }}
                                    </td>

                                    <td>
                                        <span class="medicine-name">
                                            {{ $obat?->nama ?? 'Nama obat tidak tersedia' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $satuan?->nama ?? 'Satuan tidak tersedia' }}
                                    </td>

                                    <td>
                                        <span class="number-badge">
                                            {{ $detail->nilai ?? 0 }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ trim($dosis[1] ?? '-') ?: '-' }}
                                    </td>

                                    <td>
                                        {{ trim($frekuensi[1] ?? '-') ?: '-' }}
                                    </td>

                                    <td>
                                        <span class="instruction">
                                            {{ trim($aturan[1] ?? '-') ?: '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ trim($lama[1] ?? '-') ?: '-' }}
                                    </td>

                                    <td>
                                        <span class="status-badge status-menunggu">
                                            <i class="fa-solid fa-clock me-1"></i>
                                            Menunggu
                                        </span>
                                    </td>

                                    <td>
                                        @if ($loop->first)

                                            <form
                                                action="{{ route('apoteker.resep.proses', $resep->id) }}"
                                                method="POST"
                                                onsubmit="return konfirmasiProses(this);">

                                                @csrf

                                                <button type="submit" class="btn-proses">
                                                    <i class="fa-solid fa-check me-1"></i>
                                                    Proses Resep
                                                </button>

                                            </form>

                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                </tr>

                            @empty

                                <tr class="resep-row">

                                    <td>
                                        <span class="number-badge">
                                            {{ ($resepObats->firstItem() ?? 1) + $loop->index }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? 'Belum ada data' }}
                                    </td>

                                    <td>
                                        {{ $resep->pemeriksaan?->dokter?->nama ?? 'Belum ada data' }}
                                    </td>

                                    <td colspan="6" class="text-muted">
                                        Resep belum memiliki detail obat.
                                    </td>

                                    <td>
                                        -
                                    </td>

                                    <td>
                                        <span class="status-badge status-menunggu">
                                            Menunggu
                                        </span>
                                    </td>

                                    <td>
                                        <span class="text-muted">Tidak tersedia</span>
                                    </td>

                                </tr>

                            @endforelse

                        @empty

                            <tr class="empty-row">
                                <td colspan="12" class="empty-state">

                                    <i class="fa-solid fa-prescription-bottle-medical"></i>

                                    <strong>Belum ada resep dokter</strong>

                                    <div>
                                        Resep yang masih menunggu akan ditampilkan di sini.
                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

                <!-- HASIL PENCARIAN KOSONG -->

                <div id="hasilKosong"
                    class="text-center py-4 text-secondary d-none">

                    Tidak ada resep yang sesuai dengan pencarian.

                </div>

            </div>

            <!-- FOOTER -->

            <div class="card-footer-custom d-flex justify-content-between align-items-center flex-wrap gap-3">

                <span>
                    Menampilkan {{ $resepObats->count() }} resep pada halaman ini
                </span>

                <div>
                    {{ $resepObats->links('pagination::bootstrap-5') }}
                </div>

            </div>

        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SEARCH -->

    <script>
        const searchInput = document.getElementById('searchResep');
        const rows = document.querySelectorAll('#tabelResep tbody .resep-row');
        const hasilKosong = document.getElementById('hasilKosong');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let jumlahTampil = 0;

            rows.forEach(function (row) {
                const cocok = row.innerText.toLowerCase().includes(keyword);

                row.style.display = cocok ? '' : 'none';

                if (cocok) {
                    jumlahTampil++;
                }
            });

            hasilKosong.classList.toggle('d-none', jumlahTampil > 0);
        });

        function konfirmasiProses(form) {
            return confirm(
                'Apakah kamu yakin ingin memproses resep ini?\n\n' +
                'Stok obat akan otomatis berkurang sesuai jumlah resep.'
            );
        }
    </script>

</body>

</html>
