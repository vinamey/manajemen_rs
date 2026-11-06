
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Obat - Apoteker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
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
            box-shadow: 3px 0 15px rgba(0,0,0,.08);
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

        /* MAIN CONTENT */

        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        .welcome-card {
            background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
            color: white;
            border: none;
            border-radius: 18px;
            padding: 23px 27px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(24,119,242,.16);
        }

        .welcome-card h3 {
            font-size: 23px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .welcome-card p {
            font-size: 14px;
            margin: 0;
            opacity: .9;
        }

        .welcome-icon {
            width: 55px;
            height: 55px;
            background: rgba(255,255,255,.17);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
        }

        /* TABLE CARD */

        .content-card {
            background: white;
            border: 1px solid #e9eef5;
            border-radius: 17px;
            box-shadow: 0 4px 15px rgba(25,50,90,.045);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 20px 23px;
            border-bottom: 1px solid #edf0f5;
        }

        .content-title {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
            color: #243247;
        }

        .content-title i {
            color: var(--blue-main);
            margin-right: 9px;
        }

        .content-subtitle {
            color: #7a879a;
            font-size: 13px;
            margin-top: 6px;
            margin-bottom: 0;
        }

        .card-body-custom {
            padding: 22px;
        }

        /* BUTTON TAMBAH */

        .btn-add {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--blue-main);
            border: none;
            color: white;
            padding: 10px 17px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: .2s;
        }

        .btn-add:hover {
            background: var(--blue-dark);
            color: white;
            transform: translateY(-2px);
        }

        /* DATATABLE */

        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-top: 12px !important;
        }

        table.dataTable thead th {
            background: var(--blue-main) !important;
            color: white !important;
            border-bottom: none !important;
            padding: 14px 13px !important;
            font-size: 13px;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 13px !important;
            vertical-align: middle;
            font-size: 13px;
            color: #344054;
        }

        table.dataTable tbody tr:hover {
            background: #f3f8ff !important;
        }

        .dataTables_wrapper {
            font-size: 13px;
            color: #59677b;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 8px;
            padding: 7px 10px;
            outline: none;
            background: white;
            font-size: 13px;
            margin-left: 7px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 7px !important;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--blue-main) !important;
            color: white !important;
            border: 1px solid var(--blue-main) !important;
        }

        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 11px;
            padding: 25px 0 10px;
        }

        /* =================================
           POPUP TAMBAH OBAT
        ================================= */

        .modal-backdrop.show {
            opacity: .55;
        }

        .modal-dialog {
            max-width: 400px;
        }

        .modal-content {
            border: none;
            border-radius: 9px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,.18);
        }

        .modal-header {
            background: var(--blue-main);
            color: white;
            padding: 12px 15px;
            border: none;
        }

        .modal-title {
            font-size: 15px;
            font-weight: 700;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: .8;
            box-shadow: none;
        }

        .modal-body {
            padding: 20px 18px;
        }

        .modal-body .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #344054;
            margin-bottom: 7px;
        }

        .modal-body .form-control,
        .modal-body .form-select {
            border: 1px solid #dce3ed;
            border-radius: 7px;
            padding: 8px 10px;
            font-size: 12px;
        }

        .modal-body .form-control:focus,
        .modal-body .form-select:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24,119,242,.1);
        }

        .modal-footer {
            padding: 12px 18px;
            background: #f8f9fa;
            border-top: 1px solid #e9eef5;
        }

        .btn-modal-cancel {
            background: white;
            border: 1px solid #adb5bd;
            color: #59677b;
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 12px;
        }

        .btn-modal-save {
            background: var(--blue-main);
            border: none;
            color: white;
            padding: 8px 17px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .btn-modal-save:hover {
            background: var(--blue-dark);
            color: white;
        }

        @media(max-width: 900px) {
            .sidebar {
                width: 210px;
            }

            .content {
                margin-left: 210px;
                padding: 22px;
            }
        }

        @media(max-width: 600px) {
            .sidebar {
                width: 75px;
            }

            .logo {
                font-size: 0;
            }

            .menu-title {
                display: none;
            }

            .sidebar-line {
                margin: 0 10px 15px;
            }

            .sidebar a {
                justify-content: center;
                padding: 13px 5px;
                font-size: 0;
            }

            .menu-icon {
                font-size: 19px;
            }

            .logout-btn {
                font-size: 0;
            }

            .content {
                margin-left: 75px;
                padding: 15px;
            }

            .welcome-card {
                padding: 18px;
            }

            .welcome-card h3 {
                font-size: 19px;
            }

            .card-body-custom {
                padding: 14px;
            }

            .modal-dialog {
                margin: 15px;
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
            <span class="menu-icon">🏠</span>
            Dashboard
        </a>

        <a href="{{ route('apoteker.obat.index') }}" class="active">
            <span class="menu-icon">💊</span>
            Data Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}">
            <span class="menu-icon">🛒</span>
            Log Stok Obat
        </a>

        <a href="{{ route('apoteker.supplier.index') }}">
            <span class="menu-icon">🏢</span>
            Supplier Obat
        </a>

        <a href="{{ route('apoteker.resep.index') }}">
            <span class="menu-icon">
                <i class="fa-solid fa-file-prescription"></i>
            </span>
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

    <!-- MAIN CONTENT -->

    <main class="content">

        <!-- HEADER -->

        <div class="welcome-card">

            <div class="d-flex align-items-center gap-3">

                <div class="welcome-icon">
                    <i class="fa-solid fa-capsules"></i>
                </div>

                <div>
                    <h3>Data Obat Apoteker</h3>
                    <p>
                        Kelola informasi dan daftar obat rumah sakit melalui halaman ini.
                    </p>
                </div>

            </div>

        </div>

        <!-- ALERT SUCCESS -->

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ALERT ERROR -->

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

        <!-- DAFTAR OBAT -->

        <div class="content-card">

            <div class="card-header-custom">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>
                        <h5 class="content-title">
                            <i class="fa-solid fa-list-ul"></i>
                            Daftar Obat
                        </h5>

                        <p class="content-subtitle">
                            Cari dan lihat data obat berdasarkan nama obat dan kategori.
                        </p>
                    </div>

                    <!-- BUTTON BUKA POPUP -->

                    <button
                        type="button"
                        class="btn-add"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahObat">

                        <i class="fa-solid fa-plus"></i>
                        Tambah Data

                    </button>

                </div>

            </div>

            <div class="card-body-custom">

                <div class="table-responsive">

                    <table id="tabelObat" class="table table-bordered table-hover w-100">

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

        </div>

        <!-- FOOTER -->

        <div class="footer-text">
            SIM RS &copy; {{ date('Y') }} — Apoteker
        </div>

    </main>

    <!-- =================================
         MODAL TAMBAH OBAT
    ================================== -->

    <div
        class="modal fade"
        id="modalTambahObat"
        tabindex="-1"
        aria-labelledby="judulModalObat"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <!-- HEADER MODAL -->

                <div class="modal-header">

                    <h5 class="modal-title" id="judulModalObat">
                        <i class="fa-solid fa-circle-plus me-2"></i>
                        Tambah Data Obat
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                <!-- FORM -->

                <form action="{{ route('apoteker.obat.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">

                        <!-- NAMA OBAT -->

                        <div class="mb-3">

                            <label for="nama" class="form-label">
                                Nama Obat
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                class="form-control @error('nama') is-invalid @enderror"
                                id="nama"
                                name="nama"
                                value="{{ old('nama') }}"
                                placeholder="Masukkan nama obat"
                                required>

                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
<!-- KATEGORI OBAT -->

<div class="mb-2">

    <label for="kategori_nama" class="form-label">
        Kategori Obat
        <span class="text-danger">*</span>
    </label>

    <input
        type="text"
        class="form-control"
        id="kategori_nama"
        name="kategori_nama"
        placeholder="Ketik nama kategori obat"
        required
    >

</div>
                    </div>

                    <!-- FOOTER MODAL -->

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn-modal-cancel"
                            data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit" class="btn-modal-save">

                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Simpan Obat

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <!-- JAVASCRIPT -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>

        $(document).ready(function () {

            // DATATABLE OBAT

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
                        alert('Data obat gagal dimuat. Periksa route dan controller.');
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

            // BUKA KEMBALI POPUP JIKA VALIDASI GAGAL

            @if($errors->any())

                var modalTambah = new bootstrap.Modal(
                    document.getElementById('modalTambahObat')
                );

                modalTambah.show();

            @endif

        });

    </script>

</body>
</html>
