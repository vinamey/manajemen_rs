
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Stok Obat | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            color: var(--text-dark);
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, var(--blue-main), var(--blue-dark));
            color: white;
            padding-top: 20px;
            box-shadow: 3px 0 15px rgba(0, 0, 0, .08);
            z-index: 1000;
        }

        .logo {
            text-align: center;
            font-weight: 700;
            font-size: 21px;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 55px;
            height: 55px;
            background: white;
            color: var(--blue-main);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 25px;
        }

        .sidebar-line {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, .25);
            margin: 0 18px 18px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: .75;
            padding: 0 24px;
            margin-bottom: 8px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 20px;
            margin: 4px 15px;
            border-radius: 12px;
            font-size: 15px;
            transition: .2s;
        }

        .sidebar a:hover { background: rgba(255, 255, 255, .18); }

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

        .logout-box {
            position: absolute;
            bottom: 20px;
            left: 12px;
            right: 12px;
        }

        .logout-btn {
            border: none;
            background: rgba(255, 255, 255, .15);
            color: white;
            width: 100%;
            padding: 11px;
            border-radius: 10px;
            font-weight: 600;
            transition: .2s;
        }

        .logout-btn:hover {
            background: white;
            color: var(--blue-main);
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #172b4d;
        }

        .page-subtitle {
            color: var(--text-muted);
            margin-bottom: 0;
        }

        .card {
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header { padding: 22px 20px; }

        .section-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            font-size: 18px;
            margin-right: 12px;
        }

        .table thead th {
            background: #0d6efd !important;
            color: white !important;
            padding: 17px 15px;
            white-space: nowrap;
            font-size: 15px;
            border: none;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .empty-state {
            padding: 55px 20px !important;
            text-align: center;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 38px;
            margin-bottom: 18px;
            color: #7b8794;
            display: block;
        }

        @media (max-width: 900px) {
            .sidebar { width: 210px; }
            .content { margin-left: 210px; padding: 20px; }
            .page-title { font-size: 25px; }
        }

        @media (max-width: 600px) {
            .sidebar { width: 72px; }
            .logo { font-size: 12px; }
            .logo-icon { width: 42px; height: 42px; }
            .menu-title { display: none; }
            .sidebar a {
                justify-content: center;
                padding: 13px 5px;
                margin: 5px;
                font-size: 0;
            }
            .menu-icon { font-size: 19px; }
            .logout-btn { font-size: 0; }
            .content { margin-left: 72px; padding: 15px; }
            .page-title { font-size: 22px; }
            .page-subtitle { font-size: 13px; }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="logo">
            <div class="logo-icon">💊</div>
            SIM RS
        </div>

        <hr class="sidebar-line">

        <div class="menu-title">Menu Apoteker</div>

        <a href="{{ route('apoteker.dashboard') }}">
            <span class="menu-icon">🏠</span> Dashboard
        </a>

        <a href="{{ route('master-obat.index') }}">
            <span class="menu-icon">💊</span> Data Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}" class="active">
            <span class="menu-icon">🛒</span> Log Stok Obat
        </a>

        <a href="{{ route('master-supplier.index') }}">
            <span class="menu-icon">🏢</span> Supplier Obat
        </a>

        <a href="{{ route('kasir.resep') }}">
            <span class="menu-icon">📝</span> Resep Dokter
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

    {{-- KONTEN --}}
    <main class="content">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            <div>
                <h1 class="page-title">Log Stok Obat</h1>
                <p class="page-subtitle">
                    Riwayat perubahan stok obat dan informasi stok tersedia.
                </p>
            </div>

            <button type="button" class="btn btn-primary"
                data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                <i class="fas fa-plus me-1"></i> Tambah Stok Obat
            </button>
        </div>

        {{-- PESAN BERHASIL / ERROR --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Data belum berhasil disimpan.</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0">
                <div class="d-flex align-items-center">
                    <div class="section-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 fw-bold text-dark">Stok Obat</h5>
                        <small class="text-muted">
                            Riwayat perubahan jumlah dan satuan obat.
                        </small>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 7%;">No</th>
                                <th>Tanggal Update</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Status</th>
                                <th>Nilai</th>
                                <th>Stok Tersedia</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse (($logStokObats ?? $logStok ?? $logsLama ?? $logs ?? []) as $index => $log)

                                @php
                                    $nilai = (int) ($log->nilai ?? $log->jumlah ?? 0);

                                    $tanggal = $log->tanggal_update ?? $log->created_at;

                                    $namaObat = $log->obat?->nama
                                        ?? $log->obat?->nama_obat
                                        ?? '-';

                                    $namaSatuan = $log->stokObat?->satuanObat?->nama_satuan
                                        ?? $log->stokObat?->satuanObat?->nama
                                        ?? '-';

                                    $stokTersedia = $log->stokObat?->stok_tersedia
                                        ?? $log->stok_tersedia
                                        ?? $log->nilai
                                        ?? $log->jumlah
                                        ?? 0;

                                    $status = $log->status ?? null;

                                    if (!$status) {
                                        $status = $nilai > 0 ? 'Bertambah' : ($nilai < 0 ? 'Berkurang' : 'Tetap');
                                    }
                                @endphp

                                <tr>
                                    {{-- NOMOR --}}
                                    <td class="fw-semibold">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>
                                        <i class="far fa-clock text-muted me-1"></i>

                                        @if ($tanggal)
                                            {{ \Carbon\Carbon::parse($tanggal)->format('d/m/Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    {{-- NAMA OBAT DARI MASTER OBAT --}}
                                    <td>
                                        <span class="fw-bold text-dark">
                                            {{ $namaObat }}
                                        </span>
                                    </td>

                                    {{-- SATUAN --}}
                                    <td>
                                        <span class="text-secondary fw-semibold">
                                            {{ $namaSatuan }}
                                        </span>
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        @if (strtolower($status) == 'masuk' || strtolower($status) == 'bertambah')
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                                <i class="fas fa-arrow-up me-1"></i>
                                                {{ ucfirst($status) }}
                                            </span>
                                        @elseif (strtolower($status) == 'keluar' || strtolower($status) == 'berkurang')
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                                <i class="fas fa-arrow-down me-1"></i>
                                                {{ ucfirst($status) }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary px-3 py-2">
                                                {{ ucfirst($status) }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- NILAI / JUMLAH PERUBAHAN --}}
                                    <td class="fw-bold">
                                        @if ($nilai > 0)
                                            <span class="text-success">+{{ $nilai }}</span>
                                        @elseif ($nilai < 0)
                                            <span class="text-danger">{{ $nilai }}</span>
                                        @else
                                            <span>0</span>
                                        @endif
                                    </td>

                                    {{-- STOK TERSEDIA --}}
                                    <td>
                                        <span class="badge bg-primary px-3 py-2 fs-6">
                                            {{ $stokTersedia }}
                                        </span>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fas fa-box-open"></i>
                                        <div class="fw-semibold mb-1">
                                            Belum Ada Data Log Stok Obat
                                        </div>
                                        <small>
                                            Riwayat stok obat akan ditampilkan di bagian ini.
                                        </small>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

    {{-- MODAL TAMBAH STOK --}}
    <div class="modal fade" id="modalTambahStok" tabindex="-1"
        aria-labelledby="modalTambahStokLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">

                <form action="{{ route('log-stok-obat.store') }}" method="POST">
                    @csrf

                    <div class="modal-header bg-primary text-white py-3">
                        <h5 class="modal-title fw-bold" id="modalTambahStokLabel">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Stok Obat
                        </h5>

                        <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">

                        {{-- PILIH OBAT --}}
                        <div class="mb-3">
                            <label for="obat_id" class="form-label fw-semibold">
                                Nama Obat
                            </label>

                            <select name="obat_id" id="obat_id"
                                class="form-select" required>
                                <option value="">-- Pilih Obat --</option>

                                @foreach ($obats ?? [] as $obat)
                                    <option value="{{ $obat->id }}"
                                        {{ old('obat_id') == $obat->id ? 'selected' : '' }}>
                                        {{ $obat->nama ?? $obat->nama_obat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- PILIH SATUAN --}}
                        <div class="mb-3">
                            <label for="satuan_obat_id" class="form-label fw-semibold">
                                Satuan Obat
                            </label>

                            <select name="satuan_obat_id" id="satuan_obat_id"
                                class="form-select" required>
                                <option value="">-- Pilih Satuan --</option>

                                @foreach ($satuans ?? [] as $satuan)
                                    <option value="{{ $satuan->id }}"
                                        {{ old('satuan_obat_id') == $satuan->id ? 'selected' : '' }}>
                                        {{ $satuan->nama_satuan ?? $satuan->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- JUMLAH STOK --}}
                        <div class="mb-3">
                            <label for="nilai" class="form-label fw-semibold">
                                Jumlah Stok
                            </label>

                            <input type="number" name="nilai" id="nilai"
                                class="form-control" min="1"
                                value="{{ old('nilai') }}"
                                placeholder="Masukkan jumlah stok..." required>
                        </div>

                        {{-- KEDALUWARSA --}}
                        <div class="mb-3">
                            <label for="expired_date" class="form-label fw-semibold">
                                Tanggal Kedaluwarsa
                            </label>

                            <input type="date" name="expired_date" id="expired_date"
                                class="form-control" value="{{ old('expired_date') }}">
                        </div>

                        {{-- KETERANGAN --}}
                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-semibold">
                                Keterangan
                            </label>

                            <textarea name="keterangan" id="keterangan"
                                class="form-control" rows="3"
                                placeholder="Contoh: Stok masuk dari supplier...">{{ old('keterangan') }}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer bg-light px-4 py-3">
                        <button type="button" class="btn btn-outline-secondary px-4"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary px-4 fw-semibold">
                            <i class="fas fa-save me-1"></i>
                            Simpan Stok
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Buka kembali modal jika validasi gagal --}}
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('modalTambahStok');
                if (modal) {
                    bootstrap.Modal.getOrCreateInstance(modal).show();
                }
            });
        </script>
    @endif

</body>
</html>
