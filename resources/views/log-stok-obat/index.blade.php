
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Log Stok Obat - Apoteker</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- DATATABLES -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --text-dark: #1f2937;
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

        /* CONTENT */
        .content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }

        /* WELCOME */
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

        /* CONTENT CARD */
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

        /* BUTTON */
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

        /* TABLE */
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

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 3px rgba(24,119,242,.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px 11px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--blue-main) !important;
            border: 1px solid var(--blue-main) !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #eaf2ff !important;
            border: 1px solid #dce3ed !important;
            color: var(--blue-main) !important;
        }

        .dataTables_empty {
            padding: 25px !important;
            text-align: center !important;
            color: #7a879a !important;
        }

        /* STATUS */
        .status-masuk {
            display: inline-block;
            background: #e6f4ee;
            color: #198754;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            min-width: 75px;
            text-align: center;
        }

        .status-keluar {
            display: inline-block;
            background: #fce9eb;
            color: #dc3545;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            min-width: 75px;
            text-align: center;
        }

        .stok-badge {
            display: inline-block;
            background: var(--blue-main);
            color: white;
            padding: 6px 13px;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 700;
        }

        /* FOOTER */
        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 11px;
            padding: 25px 0 10px;
        }

        /* MODAL */
        .modal-dialog {
            max-width: 460px;
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
            padding: 9px 10px;
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

        /* FOOTER RESPONSIVE */
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

        <a href="{{ route('apoteker.obat.index') }}">
            <span class="menu-icon">💊</span>
            Data Obat
        </a>

        <a href="{{ route('log-stok-obat.index') }}" class="active">
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

        <!-- WELCOME -->
        <div class="welcome-card">

            <div class="d-flex align-items-center gap-3">

                <div class="welcome-icon">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>

                <div>
                    <h3>Log Stok Obat Apoteker</h3>
                    <p>Riwayat perubahan stok obat dan informasi stok tersedia.</p>
                </div>

            </div>

        </div>

        <!-- AJAX MESSAGE -->
        <div id="ajaxMessage"></div>

        <!-- SESSION MESSAGE -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fa-solid fa-circle-check me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- CONTENT CARD -->
        <div class="content-card">

            <!-- CARD HEADER -->
            <div class="card-header-custom">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                    <div>

                        <h5 class="content-title">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            Stok Obat
                        </h5>

                        <p class="content-subtitle">
                            Riwayat perubahan jumlah dan satuan obat.
                        </p>

                    </div>

                    <button
                        type="button"
                        class="btn-add"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambahStok">

                        <i class="fa-solid fa-plus"></i>
                        Tambah Stok Obat

                    </button>

                </div>

            </div>

            <!-- TABLE -->
            <div class="card-body-custom">

                <div class="table-responsive">

                    <table id="logStokTable" class="table table-bordered table-hover w-100">

                        <thead>
                            <tr>
                                <th width="55">No</th>
                                <th>Tanggal Update</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Status</th>
                                <th>Nilai</th>
                                <th>Stok Tersedia</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer-text">
            SIM RS © {{ date('Y') }} — Apoteker
        </div>

    </main>


    <!-- ==================================
         MODAL TAMBAH STOK
    =================================== -->

    <div class="modal fade"
        id="modalTambahStok"
        tabindex="-1"
        aria-labelledby="judulModalStok"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <form id="formTambahStok"
                    action="{{ route('log-stok-obat.store') }}"
                    method="POST">

                    @csrf

                    <!-- HEADER MODAL -->
                    <div class="modal-header">

                        <h5 class="modal-title" id="judulModalStok">
                            <i class="fa-solid fa-circle-plus me-2"></i>
                            Tambah Stok Obat
                        </h5>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>

                    </div>

                    <!-- BODY MODAL -->
                    <div class="modal-body">

                        <!-- NAMA OBAT -->
                        <div class="mb-3">

                            <label for="obat_id" class="form-label">
                                Nama Obat <span class="text-danger">*</span>
                            </label>

                            <select name="obat_id"
                                id="obat_id"
                                class="form-select"
                                required>

                                <option value="">-- Pilih Obat --</option>

                                @foreach($obats as $obat)
                                    <option value="{{ $obat->id }}">
                                        {{ $obat->nama ?? $obat->nama_obat }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- SATUAN OBAT -->
                        <div class="mb-3">

                            <label for="satuan_obat_id" class="form-label">
                                Satuan Obat <span class="text-danger">*</span>
                            </label>

                            <select name="satuan_obat_id"
                                id="satuan_obat_id"
                                class="form-select"
                                required>

                                <option value="">-- Pilih Satuan Obat --</option>

                                @foreach($satuans as $satuan)
                                    <option value="{{ $satuan->id }}">
                                        {{ $satuan->nama_satuan ?? $satuan->nama ?? $satuan->satuan ?? '-' }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <!-- JUMLAH STOK -->
                        <div class="mb-3">

                            <label for="nilai" class="form-label">
                                Jumlah Stok <span class="text-danger">*</span>
                            </label>

                            <input type="number"
                                name="nilai"
                                id="nilai"
                                class="form-control"
                                min="1"
                                placeholder="Masukkan jumlah stok..."
                                required>

                        </div>

                        <!-- TANGGAL KEDALUWARSA -->
                        <div class="mb-3">

                            <label for="expired_date" class="form-label">
                                Tanggal Kedaluwarsa
                            </label>

                            <input type="date"
                                name="expired_date"
                                id="expired_date"
                                class="form-control">

                        </div>

                    </div>

                    <!-- FOOTER MODAL -->
                    <div class="modal-footer">

                        <button type="button"
                            class="btn-modal-cancel"
                            data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit"
                            class="btn-modal-save"
                            id="btnSimpan">

                            <i class="fa-solid fa-floppy-disk me-1"></i>
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DATATABLES 1.13.8 -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function () {

            // ==============================
            // ESCAPE HTML
            // ==============================

            function escapeHtml(value) {
                return $('<div>').text(value ?? '-').html();
            }


            // ==============================
            // FORMAT TANGGAL
            // ==============================

            function formatTanggal(data) {

                if (!data) return '-';

                return `
                    <i class="far fa-clock me-2 text-primary"></i>
                    ${escapeHtml(data)}
                `;

            }


            // ==============================
            // DATATABLES AJAX
            // ==============================

            let table = $('#logStokTable').DataTable({

                processing: true,
                serverSide: false,
                autoWidth: false,

                pageLength: 10,

                lengthMenu: [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],

                order: [],

                ajax: {

                    url: "{{ route('log-stok-obat.data') }}",

                    type: "GET",

                    dataSrc: "data",

                    error: function (xhr) {

                        console.error(
                            'Gagal mengambil data:',
                            xhr.responseText
                        );

                        $('#ajaxMessage').html(`
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                Gagal memuat data log stok obat.
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"></button>
                            </div>
                        `);

                    }

                },

                columns: [

                    // NOMOR
                    {
                        data: null,
                        orderable: false,
                        searchable: false,

                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },

                    // TANGGAL UPDATE
                    {
                        data: 'tanggal',
                        defaultContent: '-',

                        render: function (data) {
                            return formatTanggal(data);
                        }
                    },

                    // NAMA OBAT
                    {
                        data: 'nama_obat',
                        defaultContent: '-',

                        render: function (data) {
                            return `
                                <span class="fw-semibold text-dark">
                                    ${escapeHtml(data)}
                                </span>
                            `;
                        }
                    },

                    // SATUAN
                    {
                        data: 'satuan',
                        defaultContent: '-',

                        render: function (data) {
                            return `
                                <span class="text-secondary">
                                    ${escapeHtml(data)}
                                </span>
                            `;
                        }
                    },

                    // STATUS
                    {
                        data: 'status',
                        defaultContent: '-',

                        render: function (data) {

                            let status = String(data || '').toLowerCase();

                            if (['masuk', 'bertambah'].includes(status)) {

                                return `
                                    <span class="status-masuk">
                                        <i class="fas fa-arrow-up me-1"></i>
                                        ${escapeHtml(data)}
                                    </span>
                                `;

                            }

                            if (['keluar', 'berkurang'].includes(status)) {

                                return `
                                    <span class="status-keluar">
                                        <i class="fas fa-arrow-down me-1"></i>
                                        ${escapeHtml(data)}
                                    </span>
                                `;

                            }

                            return escapeHtml(data);

                        }
                    },

                    // NILAI
                    {
                        data: 'nilai',
                        defaultContent: 0,

                        render: function (data) {

                            let nilai = Number(data) || 0;

                            if (nilai > 0) {
                                return `
                                    <span class="fw-bold text-success">
                                        +${nilai}
                                    </span>
                                `;
                            }

                            if (nilai < 0) {
                                return `
                                    <span class="fw-bold text-danger">
                                        ${nilai}
                                    </span>
                                `;
                            }

                            return '0';

                        }
                    },

                    // STOK TERSEDIA
                    {
                        data: 'stok_tersedia',
                        defaultContent: 0,

                        render: function (data) {

                            return `
                                <span class="stok-badge">
                                    ${Number(data) || 0}
                                </span>
                            `;

                        }
                    }

                ],

                language: {

                    processing: "Memuat data...",

                    search: "Cari:",

                    lengthMenu: "Tampilkan _MENU_ data",

                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

                    infoEmpty: "Tidak ada data",

                    infoFiltered: "(disaring dari _MAX_ total data)",

                    zeroRecords: "Data tidak ditemukan",

                    emptyTable: "Belum ada data log stok obat",

                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }

                }

            });


            // ==============================
            // AJAX SIMPAN STOK
            // ==============================

            $('#formTambahStok').on('submit', function (e) {

                e.preventDefault();

                let form = this;
                let button = $('#btnSimpan');
                let buttonAwal = button.html();

                button.prop('disabled', true);

                button.html(`
                    <span class="spinner-border spinner-border-sm me-2"></span>
                    Menyimpan...
                `);

                $.ajax({

                    url: $(form).attr('action'),

                    type: 'POST',

                    data: new FormData(form),

                    processData: false,

                    contentType: false,

                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function (response) {

                        // TUTUP MODAL
                        bootstrap.Modal.getOrCreateInstance(
                            document.getElementById('modalTambahStok')
                        ).hide();

                        // RESET FORM
                        form.reset();

                        // UPDATE TABEL
                        table.ajax.reload(null, false);

                        // PESAN BERHASIL
                        $('#ajaxMessage').html(`
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle me-2"></i>
                                ${escapeHtml(response.message || 'Stok obat berhasil disimpan.')}
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"></button>
                            </div>
                        `);

                        // SCROLL KE ATAS PESAN
                        $('html, body').animate({
                            scrollTop: $('#ajaxMessage').offset().top - 20
                        }, 300);

                    },

                    error: function (xhr) {

                        let message = 'Terjadi kesalahan saat menyimpan data.';

                        if (xhr.responseJSON) {

                            if (xhr.responseJSON.errors) {

                                message = Object.values(xhr.responseJSON.errors)
                                    .flat()
                                    .map(escapeHtml)
                                    .join('<br>');

                            } else if (xhr.responseJSON.message) {

                                message = escapeHtml(xhr.responseJSON.message);

                            }

                        }

                        // PESAN GAGAL
                        $('#ajaxMessage').html(`
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                ${message}
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"></button>
                            </div>
                        `);

                    },

                    complete: function () {

                        button.prop('disabled', false);

                        button.html(buttonAwal);

                    }

                });

            });


            // ==============================
            // RESET MODAL
            // ==============================

            $('#modalTambahStok').on('hidden.bs.modal', function () {

                $('#formTambahStok')[0].reset();

            });

        });
    </script>

</body>
</html>
