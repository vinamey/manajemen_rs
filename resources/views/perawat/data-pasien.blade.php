
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Pasien - Perawat | SIM RS</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <!-- DataTables Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
          rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f6fc;
            color: #243650;
            font-size: 13px;
        }

        /* SIDEBAR - SAMA DENGAN DASHBOARD PERAWAT */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 230px;
            background: linear-gradient(180deg, #1877ed, #1551ad);
            color: #fff;
            padding: 22px 15px 12px;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 5px 20px;
            border-bottom: 1px solid rgba(255,255,255,.18);
            flex-shrink: 0;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            flex-shrink: 0;
            border-radius: 9px;
            background: rgba(255,255,255,.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: white;
        }

        .brand-subtitle {
            font-size: 9px;
            margin-top: 4px;
            color: #e4efff;
            white-space: nowrap;
        }

        .menu-label {
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1px;
            color: #d2e4ff;
            margin: 25px 8px 12px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            color: #fff;
            padding: 13px;
            border-radius: 9px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            transition: background .2s;
            flex-shrink: 0;
        }

        .menu-link:hover,
        .menu-link.active {
            color: #fff;
            background: rgba(255,255,255,.2);
        }

        .menu-link.active {
            border-left: 3px solid white;
            padding-left: 10px;
        }

        .menu-link i {
            width: 18px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .sidebar-info {
            border: 1px solid rgba(255,255,255,.2);
            background: rgba(255,255,255,.09);
            border-radius: 9px;
            padding: 12px;
            font-size: 10px;
            line-height: 1.7;
            margin-bottom: 12px;
        }

        .logout-btn {
            display: block;
            width: 100%;
            padding: 12px;
            border-radius: 9px;
            text-align: center;
            background: #fff;
            color: #e63946;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #fff0f0;
            color: #c82333;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 230px;
            width: calc(100% - 230px);
            min-height: 100vh;
        }

        /* NAVBAR */
        .top-navbar {
            height: 55px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 21px;
            border-bottom: 1px solid #eee;
        }

        .navbar-title {
            font-weight: bold;
            color: #26344a;
        }

        .navbar-user {
            color: #555;
            font-size: 12px;
        }

        /* CONTENT */
        .page-content {
            padding: 22px;
        }

        .page-header {
            background: linear-gradient(110deg, #1877f2, #1058c7);
            color: white;
            padding: 19px;
            border-radius: 11px;
            margin-bottom: 18px;
            box-shadow: 0 4px 12px rgba(24,119,242,.15);
        }

        .page-header h4 {
            font-size: 19px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .page-header p {
            font-size: 11px;
            margin-bottom: 0;
        }

        /* TABLE CARD */
        .card-table {
            background: white;
            border: 1px solid #e8edf4;
            border-radius: 11px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,.04);
        }

        .card-heading {
            padding: 15px;
            font-weight: bold;
            color: #26344a;
            border-bottom: 1px solid #eee;
        }

        .table {
            margin-bottom: 0 !important;
            font-size: 12px;
        }

        .table thead th {
            background: #1877f2 !important;
            color: white !important;
            padding: 13px 15px;
            font-size: 11px;
            font-weight: 600;
            border-bottom: none;
        }

        .table tbody td {
            padding: 13px 15px;
            vertical-align: middle;
            color: #344054;
        }

        .table tbody tr:hover {
            background: #f5f9ff;
        }

        /* DATATABLES */
        .dataTables_wrapper {
            padding: 15px;
            font-size: 12px;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 5px;
            padding: 5px 8px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 2px rgba(24,119,242,.1);
        }

        .dataTables_wrapper .pagination {
            margin-bottom: 0;
        }

        .dataTables_wrapper .page-link {
            color: #1877f2;
            font-size: 12px;
        }

        .dataTables_wrapper .page-item.active .page-link {
            background: #1877f2;
            border-color: #1877f2;
            color: white;
        }

        /* RESPONSIVE - SAMA DENGAN DASHBOARD PERAWAT */
        @media (max-width: 650px) {
            .sidebar {
                width: 62px;
                padding: 15px 7px 10px;
            }

            .brand {
                justify-content: center;
                padding: 0 0 15px;
            }

            .brand-text,
            .menu-label,
            .menu-link span,
            .sidebar-info,
            .logout-text {
                display: none;
            }

            .menu-link {
                justify-content: center;
                padding: 11px 5px;
            }

            .menu-link.active {
                padding-left: 5px;
            }

            .menu-link i {
                font-size: 14px;
            }

            .main-content {
                margin-left: 62px;
                width: calc(100% - 62px);
            }

            .page-content {
                padding: 12px;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            <div class="brand-icon">
                <i class="fas fa-hospital"></i>
            </div>

            <div class="brand-text">
                <div class="brand-name">SIM RS</div>
                <div class="brand-subtitle">Sistem Informasi Rumah Sakit</div>
            </div>
        </div>

        <div class="menu-label">MENU PERAWAT</div>

        <a href="{{ route('perawat.dashboard') }}"
           class="menu-link">
            <i class="fas fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('perawat.pasien.index') }}"
           class="menu-link active">
            <i class="fas fa-hospital-user"></i>
            <span>Data Pasien</span>
        </a>

        <div class="sidebar-bottom">

            <div class="sidebar-info">
                <strong>
                    <i class="fas fa-shield-heart me-1"></i>
                    Pelayanan Kesehatan
                </strong>
                <br>
                Gunakan data pasien dengan teliti dan jaga kerahasiaan informasi medis.
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fas fa-right-from-bracket me-1"></i>
                    <span class="logout-text">Logout</span>
                </button>
            </form>

        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- NAVBAR -->
        <nav class="top-navbar">

            <div class="navbar-title">
                Data Pasien
            </div>

            <div class="navbar-user">
                <i class="fa-solid fa-user me-1"></i>
                Perawat
            </div>

        </nav>

        <!-- PAGE CONTENT -->
        <div class="page-content">

            <!-- HEADER -->
            <div class="page-header">

                <h4>
                    <i class="fa-solid fa-hospital-user me-1"></i>
                    Data Pasien
                </h4>

                <p>
                    Daftar pasien yang pernah mendaftar di rumah sakit.
                </p>

            </div>

            <!-- TABLE -->
            <div class="card-table">

                <div class="card-heading">
                    <i class="fa-solid fa-users me-2 text-primary"></i>
                    Daftar Pasien
                </div>

                <div class="table-responsive">

                    <table id="tabelPasien"
                           class="table table-hover align-middle w-100">

                     <thead>
                        <tr>
                            <th width="60">No.</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Golongan Darah</th>
                            <th>Status Asuransi</th>
                        </tr>
                    </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#tabelPasien').DataTable({

                processing: true,
                serverSide: true,

                ajax: "{{ route('perawat.pasien.index') }}",

                                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'golongan_darah',
                        name: 'golongan_darah'
                    },
                    {
                        data: 'status_asuransi',
                        name: 'status_asuransi'
                    }
                ],

                pageLength: 10,

                language: {
                    processing: "Memuat data...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data",
                    zeroRecords: "Data pasien tidak ditemukan",
                    emptyTable: "Belum ada data pasien",

                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }

            });

        });
    </script>

</body>
</html>
