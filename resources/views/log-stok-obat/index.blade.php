<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Stok Obat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --blue-soft: #f4f8ff;
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
        }

        .page-title {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--text-muted);
            margin-bottom: 25px;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
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
            <span class="menu-icon">🏠</span> Dashboard
        </a>

        <a href="{{ route('master-obat.index') }}">
            <span class="menu-icon">💊</span> Data Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}" class="active">
            <span class="menu-icon">🛒</span> Log Stok Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}">
            <span class="menu-icon">📦</span> Update Stok Obat
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
                <button type="submit" class="logout-btn">🚪 &nbsp; Logout</button>
            </form>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        <div class="page-title">Log Stok Obat</div>


        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">

                    <!-- BAGIAN 1: STOK OBAT LAMA -->
                    <div class="card border-0 shadow-sm rounded-3 mb-4">
                        <div
                            class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-2 rounded-2 me-2">
                                    <i class="fas fa-exclamation-triangle text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="m-0 fw-bold text-dark">Stok Obat Lama</h5>
                                    <small class="text-muted">Prioritas stok yang harus dihabiskan lebih dulu agar tidak
                                        kedaluwarsa</small>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr style="background-color: #0d6efd;">
                                            <th class="py-3 px-4 text-white"
                                                style="width: 5%; background-color: #0d6efd !important;">No</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Tanggal Update</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Nama / ID Obat</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Status</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Jumlah (Nilai)</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Stok Tersedia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($logsLama ?? $logs ?? [] as $index => $log)
                                            @php
                                                $isBertambah = $log->nilai > 0 || !empty($log->pembelian_obat_id);
                                            @endphp
                                            <tr>
                                                <td class="px-4 fw-semibold">{{ $index + 1 }}</td>
                                                <td>
                                                    <i class="far fa-clock text-muted me-1"></i>
                                                    {{ $log->tanggal_update ? \Carbon\Carbon::parse($log->tanggal_update)->format('d/m/Y H:i') : '-' }}
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-dark">
                                                        {{ $log->obat->nama_obat ?? ($log->obat->nama ?? 'ID Obat: ' . $log->obat_id) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($isBertambah)
                                                        <span
                                                            class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">
                                                            <i class="fas fa-arrow-down me-1"></i> Bertambah
                                                        </span>
                                                    @else
                                                        <span
                                                            class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold">
                                                            <i class="fas fa-arrow-up me-1"></i> Berkurang
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="fw-bold">
                                                    @if ($isBertambah)
                                                        <span class="text-success">+{{ abs($log->nilai) }}</span>
                                                    @else
                                                        <span class="text-danger">-{{ abs($log->nilai) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary px-3 py-2 fs-6">
                                                        {{ $log->stokObat->stok ?? ($log->stok_tersedia ?? '-') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-muted">
                                                    <i class="fas fa-box-open fa-2x mb-3 d-block text-secondary"></i>
                                                    Belum ada data riwayat log stok obat lama.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: STOK OBAT BARU MASUK -->
                    <div class="card border-0 shadow-sm rounded-3">
                        <div
                            class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-0">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-2 rounded-2 me-2">
                                    <i class="fas fa-boxes text-success"></i>
                                </div>
                                <div>
                                    <h5 class="m-0 fw-bold text-dark">Stok Obat Baru Masuk</h5>
                                    <small class="text-muted">Penerimaan pasokan obat terbaru ke dalam sistem</small>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary px-3 py-2 shadow-sm fw-bold"
                                data-bs-toggle="modal" data-bs-target="#modalTambahStok"
                                style="background-color: #0d6efd; border-color: #0d6efd;">
                                <i class="fas fa-plus-circle me-1"></i> Tambah Stok Obat Baru
                            </button>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr style="background-color: #0d6efd;">
                                            <th class="py-3 px-4 text-white"
                                                style="width: 5%; background-color: #0d6efd !important;">No</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Tanggal Masuk</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Nama Obat</th>
                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Jumlah & Satuan</th>

                                            <th class="py-3 px-3 text-white"
                                                style="background-color: #0d6efd !important;">Stok Tersedia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($logsBaru ?? [] as $index => $log)
                                            <tr>
                                                <td class="px-4 fw-semibold">{{ $index + 1 }}</td>
                                                <td>
                                                    <i class="far fa-clock text-muted me-1"></i>
                                                    {{ \Carbon\Carbon::parse($log->tanggal_update)->format('d/m/Y H:i') }}
                                                </td>
                                                <td>
                                                    <span class="fw-bold text-dark">
                                                        {{ $log->obat->nama_obat ?? ($log->obat->nama ?? '-') }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold text-success">
                                                    +{{ $log->nilai }} <span
                                                        class="badge bg-light text-dark border">{{ $log->satuan ?? 'Pcs' }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary px-3 py-2 fs-6">
                                                        {{ $log->stokObat->stok_tersedia ?? ($log->stok_tersedia ?? '-') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-5 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-3 d-block text-secondary"></i>
                                                    Belum ada data obat baru yang dimasukkan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- MODAL FORM TAMBAH STOK -->
    <div class="modal fade" id="modalTambahStok" tabindex="-1" aria-labelledby="modalTambahStokLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <form action="{{ route('apoteker.log-stok-obat.store') }}" method="POST">
                    @csrf
                    <div class="modal-header text-white" style="background-color: #0d6efd;">
                        <h5 class="modal-title fw-bold" id="modalTambahStokLabel">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Stok Obat
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <!-- Pilih Obat dari List -->
                        <div class="mb-3">
                            <label for="obat_id" class="form-label fw-bold text-dark">Pilih Obat</label>
                            <select class="form-select py-2" id="obat_id" name="obat_id" required>
                                <option value="">-- Klik untuk Pilih Obat --</option>

                                {{-- Mengambil data obat dari Controller --}}
                                @forelse($obats ?? [] as $obat)
                                    <option value="{{ $obat->id }}">
                                        {{ $obat->nama_obat ?? ($obat->nama ?? 'Obat #' . $obat->id) }}
                                        (Stok Saat Ini: {{ $obat->stok ?? 0 }})
                                    </option>
                                @empty
                                    {{-- Pilihan default/dummy jika data obat di database belum ada/kosong --}}
                                    <option value="1">Paracetamol 500mg </option>
                                    <option value="2">Amoxicillin 500mg </option>
                                    <option value="3">Ibuprofen 400mg </option>
                                    <option value="4">Cefadroxil 500mg </option>
                                    <option value="5">CTM 4mg </option>
                                    <option value="6">Omeprazole 20mg </option>
                                    <option value="7">Vitamin C 500mg </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-7">
                                <label for="nilai" class="form-label fw-bold text-dark">Jumlah Stok</label>
                                <input type="number" class="form-control py-2" id="nilai" name="nilai"
                                    min="1" placeholder="Masukkan angka" required>
                            </div>
                            <div class="col-md-5">
                                <label for="satuan" class="form-label fw-bold text-dark">Satuan</label>
                                <select class="form-select py-2" id="satuan" name="satuan" required>
                                    <option value="Pcs">Pcs / Tablet</option>
                                    <option value="Dus">Dus</option>
                                    <option value="Box">Box</option>
                                    <option value="Botol">Botol</option>
                                    <option value="Strip">Strip</option>
                                    <option value="Ampul">Ampul</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="expired_date" class="form-label fw-bold text-dark">Tanggal Kedaluwarsa
                                (Expired Date)</label>
                            <input type="date" class="form-control py-2" id="expired_date" name="expired_date"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold text-dark">Keterangan / Supplier
                                (Opsional)</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                placeholder="Contoh: Penerimaan Pasokan Faktur #12345"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary px-4 fw-bold"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 fw-bold"
                            style="background-color: #0d6efd; border-color: #0d6efd;">
                            <i class="fas fa-save me-1"></i> Simpan Stok Baru
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
