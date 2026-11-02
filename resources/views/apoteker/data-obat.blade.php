
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Obat - Apoteker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
          rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6fa;
            color: #243247;
            font-family: Arial, sans-serif;
        }

        .topbar {
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            color: white;
            padding: 18px 28px;
            box-shadow: 0 4px 15px rgba(24, 119, 242, .18);
        }

        .topbar-inner {
            max-width: 1400px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, .18);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .brand h4 {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 3px;
        }

        .brand small {
            opacity: .85;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 14px;
            border-radius: 8px;
            background: white;
            color: #0f58c6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-back:hover {
            background: #e7f1ff;
            color: #0f58c6;
        }

        .main-container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 22px;
        }

        .breadcrumb-custom {
            color: #7a879a;
            font-size: 13px;
            margin-bottom: 12px;
        }

        .breadcrumb-custom a {
            color: #1877f2;
            text-decoration: none;
        }

        .page-heading {
            margin-bottom: 22px;
        }

        .page-heading h2 {
            font-size: 25px;
            font-weight: 700;
            margin: 0 0 7px;
            color: #243247;
        }

        .page-heading p {
            margin: 0;
            color: #7a879a;
            font-size: 14px;
        }

        .content-card {
            background: white;
            border: 1px solid #e9eef5;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(25, 50, 90, .035);
        }

        .content-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .content-subtitle {
            color: #7a879a;
            font-size: 13px;
            margin-bottom: 22px;
        }

        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background: #1877f2 !important;
            color: white !important;
            border-bottom: none !important;
            padding: 14px 12px !important;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 13px 12px;
            vertical-align: middle;
        }

        table.dataTable tbody tr:hover {
            background: #f3f8ff;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 13px;
            color: #59677b;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 7px;
            padding: 7px 10px;
            outline: none;
            background: white;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 2px rgba(24, 119, 242, .1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #1877f2 !important;
            color: white !important;
            border: 1px solid #1877f2 !important;
        }

        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 12px;
            padding: 25px 0;
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 15px;
            }

            .topbar-inner {
                flex-wrap: wrap;
            }

            .main-container {
                margin-top: 20px;
                padding: 0 12px;
            }

            .content-card {
                padding: 15px;
            }

            .page-heading h2 {
                font-size: 21px;
            }

            .brand h4 {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="topbar-inner">

        <div class="brand">

        </div>

     
    </div>
</header>

<main class="main-container">

    <div class="breadcrumb-custom">
        <i class="fa-solid fa-house me-1"></i>
        Apoteker / Data Obat
    </div>

    <div class="page-heading">
        <h2>Data Obat</h2>
        <p>Informasi daftar obat yang tersedia di rumah sakit.</p>
    </div>

    <div class="content-card">

        <div class="content-title">
            <i class="fa-solid fa-capsules me-2" style="color:#1877f2"></i>
            Daftar Obat
        </div>

       <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-3">
    <div class="content-subtitle mb-0">
        Cari dan lihat data obat berdasarkan nama obat dan kategori.
    </div>

    <a href="{{ route('apoteker.obat.create') }}" class="btn btn-primary">
    <i class="fa-solid fa-plus me-2"></i>
    Tambah Data
</a>
</div>

        <div class="table-responsive">
            <table id="tabelObat"
                   class="table table-hover table-bordered w-100">

                <thead>
                    <tr>
                        <th width="65">No.</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>
        </div>

    </div>

    <div class="footer-text">
        SIM RS &copy; {{ date('Y') }} — Apoteker
    </div>

</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    $('#tabelObat').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 10,
        order: [],

        ajax: {
            url: '{{ route("apoteker.obat.data") }}',
            type: 'GET',
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Data obat gagal dimuat. Periksa route dan controller Data Obat.');
            }
        },

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
                name: 'nama',
                defaultContent: '-'
            },
            {
                data: 'kategori_nama',
                name: 'kategori_nama',
                defaultContent: '-'
            }
        ],

        language: {
            processing: 'Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Belum ada data',
            infoFiltered: '(disaring dari _MAX_ data)',
            zeroRecords: 'Data obat tidak ditemukan',
            emptyTable: 'Belum ada data obat',
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
