<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Supplier Obat - Apoteker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #f4f6fa;
            color: #243247;
            font-family: Arial, sans-serif;
        }

        .topbar {
            height: 8px;
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            box-shadow: 0 4px 15px rgba(24,119,242,.18);
        }

        .main-container {
            max-width: 1400px;
            margin: 22px auto 0;
            padding: 0 22px;
        }

        .page-heading { margin-bottom: 18px; }

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
            background: #fff;
            border: 1px solid #e9eef5;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 4px 15px rgba(25,50,90,.035);
        }

        .content-title {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .content-subtitle {
            color: #7a879a;
            font-size: 12px;
            margin: 6px 0 18px;
        }

        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background: #1877f2 !important;
            color: #fff !important;
            border-bottom: none !important;
            padding: 12px 10px !important;
            font-size: 12px;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 12px 10px;
            vertical-align: middle;
            font-size: 12px;
        }

        table.dataTable tbody tr:hover { background: #f3f8ff; }

        .number-badge {
            display: inline-flex;
            width: 29px;
            height: 29px;
            justify-content: center;
            align-items: center;
            background: #e7f3ff;
            color: #1877f2;
            border-radius: 8px;
            font-weight: 700;
            font-size: 12px;
        }

        .supplier-name {
            font-weight: 600;
            color: #26364b;
        }

        .dataTables_wrapper {
            font-size: 12px;
            color: #59677b;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 7px;
            padding: 6px 9px;
            outline: none;
            background: #fff;
            font-size: 12px;
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
            color: #fff !important;
            border: 1px solid #1877f2 !important;
        }

        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: #1877f2;
            color: #fff;
            padding: 17px 22px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body { padding: 22px; }

        .modal-footer {
            padding: 14px 22px;
            border-top: 1px solid #edf0f5;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #39475b;
        }

        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 10px;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .main-container {
                margin-top: 20px;
                padding: 0 12px;
            }

            .content-card { padding: 14px; }
            .page-heading h2 { font-size: 21px; }
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

<div class="topbar"></div>

<main class="main-container">

<div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">

    <div>
        <h2>Supplier Obat</h2>
        <p>Informasi daftar pemasok obat yang bekerja sama dengan rumah sakit.</p>
    </div>

    <a href="{{ url('/apoteker/dashboard') }}" class="btn-dashboard">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

</div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center gap-2 mb-2">
            <div class="content-title">
                <i class="fa-solid fa-truck-field me-2" style="color:#1877f2"></i>
                Daftar Supplier
            </div>

            <button type="button" class="btn btn-primary btn-sm"
                    data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fa-solid fa-plus me-1"></i> Tambah Supplier
            </button>
        </div>

        <div class="content-subtitle">
            Daftar informasi supplier obat yang terdaftar di rumah sakit.
        </div>

        <div class="table-responsive">
            <table id="tabelSupplier" class="table table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th width="65">No.</th>
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

    <div class="footer-text">
        SIM RS &copy; {{ date('Y') }} — Apoteker
    </div>

</main>

{{-- MODAL TAMBAH SUPPLIER --}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {{-- GANTI ACTION DENGAN ROUTE SIMPAN SUPPLIER APOTEKER YANG SUDAH ADA --}}
            <form action="{{ url('/apoteker/supplier-obat') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-truck-field me-2"></i>
                        Tambah Supplier
                    </h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Supplier</label>
                        <input type="text" id="nama" name="nama"
                               class="form-control"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama supplier"
                               maxlength="255" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                            data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

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

