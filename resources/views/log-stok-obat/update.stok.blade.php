<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stok Obat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            color: #1f2937;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #1877f2, #0f58c6);
            color: white;
            padding-top: 20px;
            box-shadow: 3px 0 15px rgba(0,0,0,.08);
            z-index: 1000;
        }

        .logo {
            text-align: center;
            font-weight: 700;
            font-size: 25px;
            margin-bottom: 25px;
        }

        .logo-icon {
            width: 55px;
            height: 55px;
            background: white;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-size: 26px;
        }

        .sidebar-line {
            border: 0;
            border-top: 1px solid rgba(255,255,255,.25);
            margin: 0 20px 18px;
        }

        .menu-title {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: .75;
            padding: 0 24px;
            margin-bottom: 10px;
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
        }

        .sidebar a:hover {
            background: rgba(255,255,255,.18);
        }

        .sidebar a.active {
            background: white;
            color: #1877f2;
            font-weight: 700;
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
            background: rgba(255,255,255,.15);
            color: white;
            width: 100%;
            padding: 11px;
            border-radius: 10px;
            font-weight: 600;
        }

        .logout-btn:hover {
            background: white;
            color: #1877f2;
        }

        .content {
            margin-left: 250px;
            padding: 35px;
        }

        .page-title {
            font-size: 30px;
            font-weight: 700;
            color: #172b4d;
            margin-bottom: 8px;
        }

        .page-subtitle {
            color: #6b7280;
            margin-bottom: 25px;
        }

        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            padding: 22px 20px;
        }

        .section-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 18px;
        }

        .table thead th {
            background: #0d6efd !important;
            color: white !important;
            padding: 19px 15px;
            white-space: nowrap;
            border: none;
        }

        .table tbody td {
            padding: 16px 15px;
            vertical-align: middle;
        }

        .btn-primary {
            background: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background: #0b5ed7;
        }

        @media (max-width: 900px) {
            .sidebar { width: 210px; }
            .content { margin-left: 210px; padding: 20px; }
        }

        @media (max-width: 600px) {
            .sidebar { width: 75px; overflow-y: auto; }
            .logo { font-size: 11px; }
            .logo-icon { width: 42px; height: 42px; }
            .menu-title { display: none; }

            .sidebar a {
                justify-content: center;
                padding: 14px 5px;
                margin: 5px;
                font-size: 0;
            }

            .menu-icon { font-size: 19px; }

            .logout-box {
                position: static;
                margin: 20px 5px;
            }

            .logout-btn { font-size: 0; }

            .content {
                margin-left: 75px;
                padding: 15px;
            }

            .page-title { font-size: 24px; }
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

        <a href="{{ route('log-stok-obat.index') }}">
            <span class="menu-icon">🛒</span> Log Stok Obat
        </a>

       <a href="{{ route('apoteker.update-stok-obat.index') }}"
   class="{{ request()->routeIs('apoteker.update-stok-obat.index') ? 'active' : '' }}">
    <span class="menu-icon">📦</span>
    Update Stok Obat
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

    {{-- KONTEN UTAMA --}}
    <main class="content">

        <h1 class="page-title">Update Stok Obat</h1>
        <p class="page-subtitle">
            Kelola penerimaan dan penambahan stok obat ke dalam sistem.
        </p>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Data belum berhasil disimpan.</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">

            {{-- HEADER --}}
            <div class="card-header bg-white border-0">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                    <div class="d-flex align-items-center">
                        <div class="section-icon bg-success bg-opacity-10 text-success">
                            <i class="fas fa-boxes-stacked"></i>
                        </div>

                        <div>
                            <h5 class="mb-1 fw-bold">Stok Obat Baru Masuk</h5>
                            <small class="text-muted">
                                Riwayat penerimaan pasokan obat terbaru.
                            </small>
                        </div>
                    </div>

                    <button type="button"
                        class="btn btn-primary px-3 py-2 fw-bold shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahStok">
                        <i class="fas fa-plus-circle me-1"></i>
                        Tambah Stok Obat Baru
                    </button>

                </div>
            </div>

            {{-- TABEL STOK BARU MASUK --}}
            <div class="card-body p-0">
                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 7%;">No</th>
                                <th>Tanggal Masuk</th>
                                <th>Nama Obat</th>
                                <th>Jumlah &amp; Satuan</th>
                                <th>Stok Tersedia</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse(($logsBaru ?? []) as $index => $log)
                                @php
                                    $stokObat = $log->stokObat;
                                    $jumlah = abs((int) ($log->nilai ?? 0));
                                @endphp

                                <tr>
                                    <td class="fw-semibold">
                                        {{ $index + 1 }}
                                    </td>

                                    <td>
                                        <i class="far fa-clock text-muted me-1"></i>
                                        @if($log->tanggal_update)
                                            {{ \Carbon\Carbon::parse($log->tanggal_update)->format('d/m/Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        <span class="fw-bold">
                                            {{ $log->obat->nama_obat
                                                ?? ($log->obat->nama ?? 'Obat #' . ($log->obat_id ?? '-')) }}
                                        </span>
                                    </td>

                                    <td class="fw-bold text-success">
                                        +{{ $jumlah }}
                                        <span class="badge bg-light text-dark border">
                                            {{ $log->satuan ?? 'Pcs' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-secondary px-3 py-2 fs-6">
                                            {{ $stokObat->stok_tersedia
                                                ?? ($log->stok_tersedia ?? '-') }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-2x d-block mb-3"></i>
                                        <strong>Belum ada data stok obat baru masuk.</strong>
                                        <div class="small mt-1">
                                            Klik tombol Tambah Stok Obat Baru untuk mencatat penerimaan obat.
                                        </div>
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

                <form action="{{ route('apoteker.log-stok-obat.store') }}" method="POST">
                    @csrf

                    <div class="modal-header text-white" style="background:#0d6efd;">
                        <h5 class="modal-title fw-bold" id="modalTambahStokLabel">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Stok Obat
                        </h5>

                        <button type="button" class="btn-close btn-close-white"
                            data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body p-4">

                        <div class="mb-3">
                            <label for="obat_id" class="form-label fw-bold">
                                Pilih Obat
                            </label>

                            <select class="form-select" id="obat_id" name="obat_id" required>
                                <option value="">-- Pilih Obat --</option>

                                @forelse(($obats ?? []) as $obat)
                                    <option value="{{ $obat->id }}"
                                        {{ old('obat_id') == $obat->id ? 'selected' : '' }}>
                                        {{ $obat->nama_obat ?? ($obat->nama ?? 'Obat #' . $obat->id) }}
                                        (Stok: {{ $obat->stok ?? 0 }})
                                    </option>
                                @empty
                                    <option value="" disabled>
                                        Data obat belum tersedia
                                    </option>
                                @endforelse
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-7">
                                <label for="nilai" class="form-label fw-bold">
                                    Jumlah Stok
                                </label>
                                <input type="number"
                                    class="form-control"
                                    id="nilai"
                                    name="nilai"
                                    min="1"
                                    value="{{ old('nilai') }}"
                                    placeholder="Masukkan jumlah"
                                    required>
                            </div>

                            <div class="col-5">
                                <label for="satuan" class="form-label fw-bold">
                                    Satuan
                                </label>
                                <select class="form-select" id="satuan" name="satuan" required>
                                    @foreach(['Pcs', 'Tablet', 'Kapsul', 'Strip', 'Box', 'Dus', 'Botol', 'Tube', 'Ampul', 'Vial', 'Sachet'] as $satuan)
                                        <option value="{{ $satuan }}"
                                            {{ old('satuan', 'Pcs') == $satuan ? 'selected' : '' }}>
                                            {{ $satuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="expired_date" class="form-label fw-bold">
                                Tanggal Kedaluwarsa
                            </label>
                            <input type="date"
                                class="form-control"
                                id="expired_date"
                                name="expired_date"
                                value="{{ old('expired_date') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">
                                Keterangan / Supplier (Opsional)
                            </label>
                            <textarea class="form-control"
                                id="keterangan"
                                name="keterangan"
                                rows="3"
                                placeholder="Masukkan keterangan penerimaan obat">{{ old('keterangan') }}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="fas fa-save me-1"></i>
                            Simpan Stok Baru
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('modalTambahStok');
                bootstrap.Modal.getOrCreateInstance(modal).show();
            });
        </script>
    @endif

</body>
</html>