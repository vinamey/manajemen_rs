
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Pasien - Dokter | SIM RS</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <!-- DATATABLES -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
          rel="stylesheet">

    <style>
        :root {
            --primary: #1877f2;
            --primary-dark: #1048a7;
            --background: #f4f7fc;
            --text: #24334b;
            --muted: #7d8ba1;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--background);
            color: var(--text);
            font-size: 13px;
        }

        /* SIDEBAR - SAMA DENGAN DASHBOARD DOKTER */
        .sidebar {
            width: 255px;
            height: 100vh;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            padding: 27px 18px;
            color: white;
            background: linear-gradient(165deg, #176de0, #1048a7);
            box-shadow: 5px 0 25px rgba(18, 75, 160, .12);
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255,255,255,.18);
        }

        .brand-icon {
            width: 45px;
            height: 45px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: rgba(255,255,255,.18);
            border-radius: 14px;
            font-size: 22px;
        }

        .brand h5 {
            margin: 0;
            font-weight: 750;
            letter-spacing: .3px;
        }

        .brand small {
            color: #d9e9ff;
            font-size: 10px;
        }

        .menu-label {
            margin: 28px 12px 12px;
            color: #b9d7ff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
        }

        .menu-link {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 15px;
            margin-bottom: 8px;
            color: #e4efff;
            text-decoration: none;
            border-radius: 12px;
            transition: .2s ease;
            font-size: 13px;
            font-weight: 500;
        }

        .menu-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .menu-link:hover,
        .menu-link.active {
            color: white;
            background: rgba(255,255,255,.17);
        }

        .menu-link.active {
            box-shadow: inset 3px 0 white;
        }

        /* INFORMASI SIDEBAR */
        .sidebar-note {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 85px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.16);
            border-radius: 14px;
            background: rgba(255,255,255,.09);
            font-size: 11px;
            color: #e4efff;
            line-height: 1.7;
        }

        /* LOGOUT */
        .logout-area {
            position: absolute;
            bottom: 22px;
            left: 18px;
            right: 18px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 12px 15px;
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 12px;
            background: white;
            color: #dc3545;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .logout-btn:hover {
            background: #ffe8eb;
            color: #b02a37;
        }

        /* KONTEN UTAMA */
        .main-content {
            margin-left: 255px;
            min-height: 100vh;
        }

        /* NAVBAR */
        .top-navbar {
            height: 65px;
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            border-bottom: 1px solid #e9eef6;
        }

        .navbar-title {
            font-size: 16px;
            font-weight: 750;
            color: #24334b;
        }

        .navbar-user {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            font-size: 12px;
        }

        /* KONTEN HALAMAN */
        .page-content {
            padding: 30px 34px;
        }

        .page-header {
            background: linear-gradient(110deg, #1877f2, #1058c7);
            color: white;
            padding: 22px;
            border-radius: 15px;
            margin-bottom: 22px;
            box-shadow: 0 4px 12px rgba(24,119,242,.15);
        }

        .page-header h4 {
            font-size: 20px;
            font-weight: 750;
            margin-bottom: 7px;
        }

        .page-header p {
            font-size: 12px;
            margin-bottom: 0;
            color: #e4efff;
        }

        /* TABEL */
        .card-table {
            background: white;
            border: 1px solid #e8edf4;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 6px 24px rgba(34,60,100,.035);
        }

        .card-heading {
            padding: 17px 20px;
            font-weight: 750;
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
            padding: 14px 15px;
            font-size: 11px;
            font-weight: 600;
            border-bottom: none;
        }

        .table tbody td {
            padding: 14px 15px;
            vertical-align: middle;
            color: #344054;
        }

        .table tbody tr:hover {
            background: #f5f9ff;
        }

        .patient-name {
            color: #135fc7;
            font-weight: 600;
        }

        .patient-icon {
            width: 32px;
            height: 32px;
            background: #e7f3ff;
            color: #1877f2;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            margin-right: 8px;
        }

        /* DATATABLES */
        .dataTables_wrapper {
            padding: 18px;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 12px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 3px rgba(24,119,242,.10);
        }

        .dataTables_wrapper .dataTables_info {
            font-size: 12px;
            color: #667085;
            padding-top: 15px;
        }

        .dataTables_wrapper .pagination .page-link {
            color: #1877f2;
            font-size: 12px;
        }

        .dataTables_wrapper .pagination .active .page-link {
            background: #1877f2;
            border-color: #1877f2;
            color: white;
        }

        .dataTables_processing {
            background: white !important;
            border: 1px solid #1877f2 !important;
            border-radius: 6px;
            color: #1877f2 !important;
        }

        /* RESPONSIVE - MENGIKUTI DASHBOARD DOKTER */
        @media (max-width: 900px) {
            .sidebar {
                width: 215px;
            }

            .main-content {
                margin-left: 215px;
            }

            .page-content {
                padding: 24px 20px;
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                min-height: 0;
                padding: 18px;
                overflow: visible;
            }

            .brand {
                padding-bottom: 17px;
            }

            .menu-label {
                margin-top: 17px;
            }

            .sidebar-note {
                display: none;
            }

            .logout-area {
                position: static;
                margin-top: 18px;
            }

            .main-content {
                margin-left: 0;
            }

            .top-navbar {
                padding: 0 16px;
            }

            .page-content {
                padding: 22px 16px;
            }

            .dataTables_wrapper {
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
                <i class="fa-solid fa-hospital"></i>
            </div>

            <div>
                <h5>SIM RS</h5>
                <small>Sistem Informasi Rumah Sakit</small>
            </div>
        </div>

        <div class="menu-label">MENU DOKTER</div>

        <a href="{{ route('dokter.dashboard') }}"
           class="menu-link">
            <i class="fa-solid fa-house"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('dokter.pasien.index') }}"
           class="menu-link active">
            <i class="fa-solid fa-hospital-user"></i>
            <span>Data Pasien</span>
        </a>

        <a href="{{ route('dokter.resep.index') }}"
           class="menu-link">
            <i class="fa-solid fa-prescription"></i>
            <span>Resep Obat</span>
        </a>

        <!-- INFORMASI SIDEBAR -->
        <div class="sidebar-note">
            <i class="fa-solid fa-shield-heart me-1"></i>
            <strong>Pelayanan Kesehatan</strong>
            <br>
            Gunakan data pasien dengan teliti dan jaga kerahasiaan informasi medis.
        </div>

        <!-- LOGOUT -->
        <div class="logout-area">
            <form action="{{ route('dokter.logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-btn">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
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
                <i class="fa-solid fa-user-doctor"></i>
                Dokter
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
                    Daftar nama pasien yang pernah mendaftar di rumah sakit.
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

                        <tbody>
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <!-- DATATABLES CONFIGURATION -->
    <script>
        $(document).ready(function () {

            $('#tabelPasien').DataTable({

                processing: true,
                serverSide: true,

                ajax: "{{ route('dokter.pasien.data') }}",

                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        render: function (data, type, row) {

                            return `
                                <span class="patient-icon">
                                    <i class="fa-solid fa-user"></i>
                                </span>
                                <span class="patient-name">
                                    ${$('<div>').text(data ?? '-').html()}
                                </span>
                            `;
                        }
                    }
                ],

                order: [[1, 'asc']],

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                language: {
                    processing: "Memuat data...",
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pasien",
                    infoEmpty: "Tidak ada data pasien",
                    infoFiltered: "(difilter dari _MAX_ total pasien)",
                    zeroRecords: "Nama pasien tidak ditemukan",
                    emptyTable: "Belum ada pasien yang pernah mendaftar",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }

            });

        });
    </script>

</body>
</html>
