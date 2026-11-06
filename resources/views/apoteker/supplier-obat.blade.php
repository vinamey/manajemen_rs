
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Supplier Obat | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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

        /* SIDEBAR - SAMA DENGAN DASHBOARD */
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
            border-top: 1px solid rgba(255,255,255,.25);
            margin: 0 18px 15px;
        }

        .menu-title {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: .7;
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
            transition: .2s;
        }

        .sidebar a:hover {
            background: rgba(255,255,255,.18);
            transform: translateX(3px);
            color: white;
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
            transition: .2s;
        }

        .logout-btn:hover {
            background: white;
            color: var(--blue-main);
        }

        /* KONTEN UTAMA */
        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .page-title {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-subtitle {
            color: var(--text-muted);
            margin-bottom: 25px;
            font-size: 14px;
        }

        /* BANNER */
        .welcome-card {
            background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
            color: white;
            border: none;
            border-radius: 18px;
            padding: 25px 28px;
            box-shadow: 0 8px 20px rgba(24,119,242,.18);
            margin-bottom: 26px;
        }

        .welcome-card h3 {
            font-size: 27px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .welcome-card p {
            margin: 0;
            opacity: .92;
            font-size: 15px;
        }

        /* CARD TABEL */
        .content-card {
            background: white;
            border: none;
            border-radius: 18px;
            box-shadow: 0 4px 15px rgba(0,0,0,.05);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 20px 25px;
            border-bottom: 1px solid #edf0f5;
        }

        .content-title {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .content-subtitle {
            color: #7a879a;
            font-size: 13px;
            margin-top: 7px;
            margin-bottom: 0;
        }

        .card-body-custom {
            padding: 22px 25px;
        }

        .btn-add {
            background: var(--blue-main);
            color: white;
            border: none;
            border-radius: 9px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-add:hover {
            background: var(--blue-dark);
            color: white;
            transform: translateY(-2px);
        }

        /* TABEL */
        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background: var(--blue-main) !important;
            color: white !important;
            border-bottom: none !important;
            padding: 14px 12px !important;
            font-size: 13px;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 13px 12px;
            vertical-align: middle;
            font-size: 13px;
        }

        table.dataTable tbody tr:hover {
            background: var(--blue-soft);
        }

        .number-badge {
            display: inline-flex;
            width: 35px;
            height: 35px;
            justify-content: center;
            align-items: center;
            background: var(--blue-light);
            color: var(--blue-main);
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
        }

        .supplier-name {
            font-weight: 600;
            color: #26364b;
        }

        /* DATATABLE */
        .dataTables_wrapper {
            font-size: 13px;
            color: #59677b;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 8px;
            padding: 8px 10px;
            outline: none;
            background: white;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 2px rgba(24,119,242,.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--blue-main) !important;
            color: white !important;
            border: 1px solid var(--blue-main) !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--blue-dark) !important;
            color: white !important;
            border: 1px solid var(--blue-dark) !important;
        }

        /* MODAL */
        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: var(--blue-main);
            color: white;
            padding: 17px 22px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 22px;
        }

        .modal-footer {
            padding: 14px 22px;
            border-top: 1px solid #edf0f5;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #39475b;
        }

        .form-control:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24,119,242,.1);
        }

        /* FOOTER */
        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 12px;
            padding: 25px 0 10px;
        }

        /* RESPONSIVE */
        @media(max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
                padding: 22px;
            }
        }

        @media(max-width: 576px) {
            .sidebar {
                width: 190px;
            }

            .content {
                margin-left: 190px;
                padding: 15px;
            }

            .welcome-card {
                padding: 20px;
            }

            .welcome-card h3 {
                font-size: 21px;
            }

            .card-header-custom,
            .card-body-custom {
                padding: 16px;
            }
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
            <span class="menu-icon">🏠</span>
            Dashboard
        </a>

        <a href="{{ route('apoteker.obat.index') }}">
            <span class="menu-icon">💊</span>
            Data Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}">
            <span class="menu-icon">🛒</span>
            Log Stok Obat
        </a>

        <a href="{{ route('apoteker.supplier.index') }}" class="active">
            <span class="menu-icon">🏢</span>
            Supplier Obat
        </a>

        <a href="{{ route('apoteker.resep.index') }}">
            <i class="fa-solid fa-file-prescription menu-icon"></i>
            Resep Dokter
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


        {{-- BANNER --}}
        <div class="welcome-card">
            <h3>
                Data Supplier Obat 🏢
            </h3>
            <p>
                Informasi daftar pemasok obat yang bekerja sama dengan rumah sakit.
            </p>
        </div>

        {{-- PESAN SUKSES --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- PESAN ERROR --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- CARD SUPPLIER --}}
        <div class="content-card">

            <div class="card-header-custom">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <h5 class="content-title">
                            <i class="fa-solid fa-truck-field me-2"
                               style="color:#1877f2"></i>
                            Daftar Supplier
                        </h5>

                        <p class="content-subtitle">
                            Daftar informasi supplier obat yang terdaftar di rumah sakit.
                        </p>
                    </div>

                  

                </div>

            </div>

            <div class="card-body-custom">

                <div class="table-responsive">

                    <table id="tabelSupplier"
                           class="table table-hover table-bordered w-100">

                        <thead>
                            <tr>
                                <th width="80">No.</th>
                                <th>Nama Supplier</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($suppliers as $supplier)

                                <tr>
                                    <td>
                                        <span class="number-badge">
                                            {{ $loop->iteration }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="supplier-name">
                                            {{ $supplier->nama }}
                                        </span>
                                    </td>
                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <div class="footer-text">
            SIM RS &copy; {{ date('Y') }} — Apoteker
        </div>

    </main>


    {{-- MODAL TAMBAH SUPPLIER --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form action="{{ url('/apoteker/supplier-obat') }}" method="POST">

                    @csrf

                    <div class="modal-header">

                        <h5 class="modal-title">
                            <i class="fa-solid fa-truck-field me-2"></i>
                            Tambah Supplier
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label for="nama" class="form-label">
                                Nama Supplier
                            </label>

                            <input type="text"
                                   id="nama"
                                   name="nama"
                                   class="form-control"
                                   value="{{ old('nama') }}"
                                   placeholder="Masukkan nama supplier"
                                   maxlength="255"
                                   required>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-1"></i>
                            Simpan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    {{-- JAVASCRIPT --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#tabelSupplier').DataTable({

                processing: true,
                serverSide: false,
                autoWidth: false,
                pageLength: 10,
                order: [],

                columnDefs: [
                    {
                        targets: 0,
                        searchable: false,
                        orderable: false
                    }
                ],

                language: {
                    processing: 'Memuat data...',
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                    infoEmpty: 'Belum ada data',
                    infoFiltered: '(disaring dari _MAX_ data)',
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable: 'Belum ada data supplier',

                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Berikutnya',
                        previous: 'Sebelumnya'
                    }
                }

            });

        });
    </script>

</body>
</html>
