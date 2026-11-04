<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resep Dokter - Apoteker | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --background: #f4f6fa;
            --border: #e5eaf2;
            --text: #253247;
            --muted: #758197;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        /* Sidebar dihilangkan */
        .sidebar {
            display: none !important;
        }

        /* Konten memenuhi seluruh layar */
        .main-content {
            width: 100%;
            margin: 0 !important;
            padding: 25px 30px;
            min-height: 100vh;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .topbar h6 {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 9px 13px;
        }

        .user-icon {
            width: 36px;
            height: 36px;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info strong {
            display: block;
            font-size: 12px;
        }

        .user-info small {
            color: var(--muted);
            font-size: 11px;
        }

        .page-header {
            padding: 25px;
            border-radius: 16px;
            background: linear-gradient(115deg, #1877f2, #0f58c6);
            color: white;
            margin-bottom: 25px;
            box-shadow: 0 8px 22px rgba(24, 119, 242, .15);
        }

        .page-header h3 {
            font-size: 23px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-header p {
            margin: 0;
            font-size: 13px;
            opacity: .9;
        }

        .content-card {
            width: 100%;
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(30, 50, 80, .04);
        }

        .card-heading {
            padding: 20px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
        }

        .card-heading h5 {
            font-size: 15px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .card-heading p {
            margin: 0;
            font-size: 12px;
            color: var(--muted);
        }

        .search-box {
            position: relative;
            width: 260px;
            max-width: 100%;
        }

        .search-box i {
            position: absolute;
            left: 13px;
            top: 13px;
            color: #8b96a8;
        }

        .search-box input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 10px 12px 10px 36px;
            outline: none;
            font-size: 12px;
        }

        .search-box input:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24, 119, 242, .1);
        }

        .table-responsive {
            padding: 0 20px;
        }

        .table {
            margin: 0;
            vertical-align: middle;
            font-size: 12px;
            min-width: 1100px;
        }

        .table thead th {
            background: var(--blue-main);
            color: white;
            padding: 14px 12px;
            white-space: nowrap;
            border: none;
            font-weight: 600;
        }

        .table tbody td {
            padding: 14px 12px;
            border-bottom: 1px solid #edf0f5;
        }

        .table tbody tr:hover {
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

        .sub-text {
            display: block;
            margin-top: 4px;
            color: var(--muted);
            font-size: 11px;
        }

        .medicine-name {
            font-weight: 700;
            color: var(--blue-dark);
        }

        .instruction {
            display: inline-block;
            background: #f1f5fb;
            color: #52627a;
            padding: 5px 8px;
            border-radius: 6px;
            margin: 2px 0;
        }

        .empty-state {
            padding: 55px 20px !important;
            text-align: center;
            color: var(--muted);
        }

        .empty-state i {
            display: block;
            font-size: 35px;
            color: #b8c9df;
            margin-bottom: 13px;
        }

        .card-footer-custom {
            padding: 17px 22px;
            border-top: 1px solid var(--border);
            font-size: 12px;
            color: var(--muted);
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

        @media (max-width: 900px) {
            .main-content {
                width: 100%;
                margin: 0 !important;
                padding: 20px 15px;
            }
        }

        @media (max-width: 550px) {
            .page-header {
                padding: 20px;
            }

            .page-header h3 {
                font-size: 19px;
            }

            .user-info > div:last-child {
                display: none;
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

        /* TOMBOL KEMBALI KE DASHBOARD */
        .btn-dashboard {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            background: #1877f2;
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-dashboard:hover {
            background: #0f58c6;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(24, 119, 242, 0.2);
        }

        /* RESPONSIVE */
        @media (max-width: 576px) {
            .page-heading {
                align-items: flex-start !important;
            }

            .btn-dashboard {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<main class="main-content">

    {{-- TOPBAR --}}
<div class="topbar">

    <div class="user-info">
        <div class="user-icon">
            <i class="fa-solid fa-user-nurse"></i>
        </div>
        <div>
            <strong>{{ auth()->user()->name ?? 'Apoteker' }}</strong>
            <small>Apoteker</small>
        </div>
    </div>
</div>

{{-- HEADER HALAMAN --}}
<section class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h3>
            <i class="fa-solid fa-file-prescription me-2"></i>
            Resep Dokter
        </h3>
        <p>Daftar resep obat dari hasil pemeriksaan dokter.</p>
    </div>

    <a href="{{ route('apoteker.dashboard') }}" class="btn-dashboard">
    <i class="fa-solid fa-arrow-left"></i>
    Kembali ke Dashboard
</a>
    </a>
</section>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Tutup"></button>
        </div>
    @endif

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

        <div class="table-responsive">
            <table class="table" id="tabelResep">
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

                <tbody>
                    @forelse ($resepObats as $resep)
                        @forelse ($resep->obat as $obat)
                            @php
                                $teks = $obat->pivot->aturan_pakai ?? '';

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

                            <tr>
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
                                        {{ $obat->nama ?? 'Nama obat tidak tersedia' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="number-badge">
                                        {{ $obat->pivot->nilai ?? 0 }}
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
                            </tr>
                        @empty
                            {{-- Resep belum memiliki obat --}}
                        @endforelse
                    @empty
                        <tr>
                            <td colspan="9" class="empty-state">
                                <i class="fa-solid fa-prescription-bottle-medical"></i>
                                <strong>Belum ada resep dokter</strong>
                                <div class="mt-2">
                                    Resep yang tersedia akan ditampilkan di sini.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="hasilKosong"
                 class="text-center py-4 text-secondary d-none">
                Tidak ada resep yang sesuai dengan pencarian.
            </div>
        </div>

        <div class="card-footer-custom d-flex justify-content-between align-items-center flex-wrap gap-3">
            <span>
                Menampilkan {{ $resepObats->count() }} resep pada halaman ini
            </span>

            <div>
                {{ $resepObats->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const searchInput = document.getElementById('searchResep');
    const rows = document.querySelectorAll('#tabelResep tbody tr');
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
</script>

</body>
</html>

