
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Perawat - Admin Rumah Sakit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

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
            margin: 0;
        }

        .brand small {
            opacity: .85;
        }

        .btn-dashboard {
            color: white;
            text-decoration: none;
            border: 1px solid rgba(255,255,255,.45);
            border-radius: 8px;
            padding: 9px 13px;
            font-size: 13px;
        }

        .btn-dashboard:hover {
            background: rgba(255,255,255,.15);
            color: white;
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

        .btn-view {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #0dcaf0;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: .2s;
        }

        .btn-view:hover {
            background: #0aa8c7;
            color: white;
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
            box-shadow: 0 0 0 2px rgba(24,119,242,.1);
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

        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: #1877f2;
            color: white;
            padding: 18px 22px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            padding: 15px 24px;
            border-top: 1px solid #edf0f5;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #39475b;
        }

        .detail-value {
            min-height: 42px;
            padding: 11px 12px;
            border: 1px solid #dce3ed;
            border-radius: 8px;
            background: #f8fafc;
            overflow-wrap: anywhere;
        }

        .btn-close-modal {
            background: #1877f2;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
        }

        .btn-close-modal:hover {
            background: #0f58c6;
            color: white;
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

            .topbar-inner {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="topbar-inner">
        <div class="brand">



    </div>
</header>

<main class="main-container">

    
    <div class="page-heading">
        <h2>Data Perawat</h2>
        <p>Informasi data perawat rumah sakit.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">
        <div class="content-title">
            <i class="fa-solid fa-table-list me-2" style="color:#1877f2"></i>
            Daftar Perawat
        </div>

        <div class="content-subtitle">
            Daftar informasi perawat yang terdaftar di rumah sakit.
        </div>

        <div class="table-responsive">
            <table id="tabelPerawat" class="table table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th width="55">No.</th>
                        <th>Nama Perawat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th width="90" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <div class="footer-text">
        SIM RS &copy; {{ date('Y') }} — Admin Rumah Sakit
    </div>

</main>

{{-- MODAL DETAIL PERAWAT --}}
<div class="modal fade" id="modalLihat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa-solid fa-eye me-2"></i>
                    Detail Perawat
                </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label class="form-label">Nama Perawat</label>
                    <div id="lihatNama" class="detail-value">-</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <div id="lihatJenisKelamin" class="detail-value">-</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <div id="lihatTanggalLahir" class="detail-value">-</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <div id="lihatAlamat" class="detail-value"
                         style="min-height:70px; white-space:pre-wrap;">-</div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn-close-modal"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    const tabel = $('#tabelPerawat').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,

        ajax: {
            url: "{{ route('admin.perawat.data') }}",
            type: 'GET',
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Data perawat gagal dimuat. Periksa controller Admin RS.');
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
                data: 'jenis_kelamin',
                name: 'jenis_kelamin',
                defaultContent: '-'
            },
            {
                data: 'tanggal_lahir',
                name: 'tanggal_lahir',
                defaultContent: '-'
            },
            {
                data: 'alamat',
                name: 'alamat',
                defaultContent: '-'
            },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return '<button type="button" class="btn-view" title="Lihat Detail" aria-label="Lihat Detail">' +
                           '<i class="fa-solid fa-eye"></i>' +
                           '</button>';
                }
            }
        ],

        order: [],
        pageLength: 10,

        language: {
            processing: 'Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Belum ada data',
            infoFiltered: '(disaring dari _MAX_ data)',
            zeroRecords: 'Data tidak ditemukan',
            emptyTable: 'Belum ada data perawat',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Berikutnya',
                previous: 'Sebelumnya'
            }
        }
    });

    // HANYA LIHAT DETAIL
    $('#tabelPerawat').on('click', '.btn-view', function () {
        const row = tabel.row($(this).closest('tr')).data();

        if (!row) {
            return;
        }

        $('#lihatNama').text(row.nama || '-');

        $('#lihatJenisKelamin').text(
            row.jenis_kelamin_raw || row.jenis_kelamin || '-'
        );

        $('#lihatTanggalLahir').text(
            row.tanggal_lahir_raw || row.tanggal_lahir || '-'
        );

        $('#lihatAlamat').text(
            row.alamat_raw || row.alamat || '-'
        );

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihat')
        ).show();
    });

});
</script>

</body>
</html>
