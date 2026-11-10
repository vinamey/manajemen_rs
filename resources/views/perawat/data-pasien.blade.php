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

        body {
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        /* SIDEBAR */
        .sidebar {
            width: 187px;
            height: 100vh;
            background: #1877f2;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar-brand {
            height: 55px;
            display: flex;
            align-items: center;
            padding: 0 16px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .sidebar-menu {
            padding: 15px 9px;
        }

        .sidebar-label {
            color: #dceaff;
            font-size: 10px;
            margin: 0 10px 12px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            margin-bottom: 5px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 12px;
            transition: .2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,.22);
        }

        .sidebar-menu a i {
            width: 13px;
            text-align: center;
        }

        /* LOGOUT */
        .logout {
            margin: auto 11px 7px;
        }

        .logout button {
            width: 100%;
            background: white;
            color: #dc3545;
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-weight: bold;
            font-size: 12px;
        }

        .logout button:hover {
            background: #f1f5f9;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 187px;
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

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                width: 65px;
            }

            .sidebar-brand {
                font-size: 0;
                justify-content: center;
                padding: 0;
            }

            .sidebar-brand i {
                font-size: 19px;
            }

            .sidebar-label {
                display: none;
            }

            .sidebar-menu {
                padding: 15px 7px;
            }

            .sidebar-menu a {
                justify-content: center;
                font-size: 0;
                padding: 12px 5px;
            }

            .sidebar-menu a i {
                font-size: 15px;
            }

            .logout {
                margin: auto 5px 7px;
            }

            .logout button {
                font-size: 0;
            }

            .logout button i {
                font-size: 15px;
                margin: 0 !important;
            }

            .main-content {
                margin-left: 65px;
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

        <div class="sidebar-brand">
            <i class="fa-solid fa-hospital me-2"></i>
            SIM RS
        </div>

        <div class="sidebar-menu">

            <div class="sidebar-label">
                MENU PERAWAT
            </div>

            <a href="{{ route('perawat.dashboard') }}">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>

            <a href="{{ route('perawat.pasien.index') }}" class="active">
                <i class="fa-solid fa-hospital-user"></i>
                Data Pasien
            </a>

        </div>

        <!-- LOGOUT -->
        <div class="logout">

            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Logout
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
                                <th width="70">No.</th>
                                <th>Nama Pasien</th>
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

