    @extends('layouts.superadmin')

    @section('page-title', 'Dashboard Master Supplier')

    @section('content')

    {{-- DATATABLE CSS --}}
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
    >

    <style>
        :root {
            --blue-main: #1877f2;
            --blue-dark: #0f58c6;
            --blue-light: #e7f3ff;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
        }

        /* =====================================================
        HALAMAN
        ===================================================== */
        .master-supplier-page {
            background: #f4f6fa;
            min-height: calc(100vh - 70px);
            padding: 22px 18px;
        }

        /* =====================================================
        HEADER
        ===================================================== */
        .supplier-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 15px;
        }

        .supplier-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .supplier-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            background: var(--blue-light);
            color: var(--blue-main);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .supplier-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--text-dark);
        }

        .supplier-subtitle {
            margin: 3px 0 0;
            font-size: 10px;
            color: var(--text-muted);
        }

        /* =====================================================
        TOMBOL TAMBAH
        ===================================================== */
        .btn-tambah-supplier {
            background: var(--blue-main);
            border: none;
            color: #fff;
            padding: 9px 14px;
            border-radius: 7px;
            font-size: 10px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: .2s;
        }

        .btn-tambah-supplier:hover {
            background: var(--blue-dark);
            color: #fff;
        }

        /* =====================================================
        CARD
        ===================================================== */
        .supplier-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
            padding-bottom: 10px;
            overflow: hidden;
        }

        .supplier-table-wrapper {
            width: 100%;
            overflow-x: hidden;
        }

        .dataTables_wrapper {
        width: 100%;
        overflow-x: hidden !important;
    }

    #supplier-table {
        width: 100% !important;
        table-layout: auto !important;
    }

        /* =====================================================
        TABLE
        ===================================================== */
        .supplier-table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 0 !important;
        }

        .supplier-table thead th {
            background: var(--blue-main) !important;
            color: #fff !important;
            font-size: 10px !important;
            font-weight: 600 !important;
            padding: 11px 12px !important;
            border: none !important;
            white-space: nowrap;
            text-align: left;
        }

        .supplier-table tbody td {
            padding: 10px 12px !important;
            font-size: 10px !important;
            color: #6b7280;
            border-bottom: 1px solid #edf0f4 !important;
            vertical-align: middle !important;
            background: #fff;
        }

        .supplier-table tbody tr:hover td {
            background: #fafcff;
        }

        /* =====================================================
        HILANGKAN ICON SORTING
        Kita matikan ordering supaya tidak ada panah
        ===================================================== */
        #supplier-table.dataTable thead th::before,
        #supplier-table.dataTable thead th::after {
            display: none !important;
            content: none !important;
            opacity: 0 !important;
        }

        #supplier-table.dataTable thead th {
            background-image: none !important;
            padding-right: 12px !important;
            cursor: default !important;
        }

        /* =====================================================
        BADGE KODE
        ===================================================== */
        .kode-supplier-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: #e7f3ff;
            color: #1877f2;
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        /* =====================================================
        BADGE NAMA
        ===================================================== */
        .nama-supplier-badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 5px;
            background: #fff0d5;
            color: #e8791b;
            font-size: 9px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* =====================================================
        AKSI
        ===================================================== */
        .aksi-header {
            text-align: center !important;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            white-space: nowrap;
        }

        .btn-aksi {
            border: none;
            border-radius: 6px;
            padding: 7px 9px;
            font-size: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            min-width: 50px;
            cursor: pointer;
            transition: .2s;
            text-decoration: none !important;
        }

        .btn-lihat {
            background: #dff2ff;
            color: #087db9;
        }

        .btn-lihat:hover {
            background: #c8eaff;
            color: #087db9;
        }

        .btn-edit {
            background: var(--blue-main);
            color: #fff;
        }

        .btn-edit:hover {
            background: var(--blue-dark);
            color: #fff;
        }

        .btn-hapus {
            background: #ef4444;
            color: #fff;
        }

        .btn-hapus:hover {
            background: #dc2626;
            color: #fff;
        }

        /* =====================================================
        DATATABLE
        ===================================================== */
        .dataTables_wrapper {
            font-size: 10px;
        }

        .dataTables_wrapper .row:first-child {
            padding: 13px 14px 10px;
            align-items: center;
        }

        .dataTables_wrapper .row:last-child {
            padding: 10px 14px 2px;
            align-items: center;
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info {
            font-size: 10px;
            color: #64748b;
        }

        .dataTables_wrapper .dataTables_length select {
            min-width: 60px;
            height: 31px;
            border: 1px solid #d4dce6;
            border-radius: 6px;
            font-size: 10px;
            padding: 4px 24px 4px 7px;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 190px;
            height: 31px;
            border: 1px solid #d4dce6;
            border-radius: 6px;
            padding: 5px 9px;
            margin-left: 5px;
            font-size: 10px;
            outline: none;
            box-shadow: none !important;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 2px rgba(24, 119, 242, .10) !important;
        }

        .dataTables_wrapper .pagination {
            margin: 0;
            gap: 3px;
        }

        .dataTables_wrapper .page-link {
            font-size: 9px;
            border-radius: 5px !important;
            color: #64748b;
            border: 1px solid #e2e8f0;
            padding: 5px 8px;
            box-shadow: none !important;
        }

        .dataTables_wrapper .page-item.active .page-link {
            background: var(--blue-main);
            border-color: var(--blue-main);
            color: #fff;
        }

        .dataTables_wrapper .page-item.disabled .page-link {
            color: #b0bac8;
            background: #f8fafc;
        }

        table.dataTable {
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }

        table.dataTable.no-footer {
            border-bottom: none !important;
        }

        div.dataTables_processing {
            font-size: 10px;
            color: #64748b;
        }

        /* =====================================================
        MODAL
        ===================================================== */
        .modal-supplier .modal-dialog {
            max-width: 500px;
        }

        .modal-supplier .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
        }

        .modal-supplier .modal-header {
            background: var(--blue-main);
            border: none;
            padding: 14px 16px;
            color: #fff;
        }

        .modal-supplier .modal-title {
            margin: 0;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .modal-supplier .modal-body {
            padding: 18px 16px;
            background: #fff;
        }

        .modal-supplier .modal-footer {
            border: none;
            background: #f8fafc;
            padding: 11px 16px;
            display: flex;
            justify-content: flex-end;
            gap: 7px;
        }

        /* =====================================================
        FORM
        ===================================================== */
        .form-supplier-group {
            margin-bottom: 14px;
        }

        .form-supplier-group:last-child {
            margin-bottom: 0;
        }

        .form-supplier-label {
            display: block;
            font-size: 10px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 5px;
        }

        .form-supplier-control {
            width: 100%;
            min-height: 36px;
            border: 1px solid #d4dce6;
            border-radius: 6px;
            padding: 8px 9px;
            font-size: 10px;
            color: #374151;
            outline: none;
            background: #fff;
            transition: .2s;
            box-sizing: border-box;
        }

        .form-supplier-control:focus {
            border-color: var(--blue-main);
            box-shadow: 0 0 0 2px rgba(24, 119, 242, .10);
        }

        .form-supplier-control::placeholder {
            color: #9ca3af;
        }

        /* =====================================================
        DETAIL
        ===================================================== */
        .view-supplier-value {
            width: 100%;
            min-height: 36px;
            border: 1px solid #e1e7ef;
            border-radius: 6px;
            background: #f8fafc;
            padding: 8px 9px;
            font-size: 10px;
            color: #374151;
            box-sizing: border-box;
        }

        /* =====================================================
        BUTTON MODAL
        ===================================================== */
        .btn-batal-supplier {
            background: #eef2f7;
            border: none;
            color: #64748b;
            border-radius: 6px;
            padding: 8px 13px;
            font-size: 9px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-batal-supplier:hover {
            background: #e2e8f0;
        }

        .btn-simpan-supplier {
            background: var(--blue-main);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 13px;
            font-size: 9px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }

        .btn-simpan-supplier:hover {
            background: var(--blue-dark);
        }

        /* =====================================================
        MODAL HAPUS
        ===================================================== */
        .modal-hapus .modal-dialog {
            max-width: 420px;
        }

        .modal-hapus .modal-content {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .25);
        }

        .modal-hapus .modal-header {
            background: #ef4444;
            color: #fff;
            border: none;
            padding: 14px 16px;
        }

        .modal-hapus .modal-title {
            font-size: 13px;
            font-weight: 700;
            margin: 0;
        }

        .modal-hapus .modal-body {
            text-align: center;
            padding: 25px 20px;
        }

        .icon-hapus-besar {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fee2e2;
            color: #ef4444;
            font-size: 22px;
        }

        .hapus-text {
            font-size: 11px;
            color: #374151;
            margin: 0;
        }

        .hapus-nama {
            font-weight: 700;
            color: #111827;
        }

        .btn-konfirmasi-hapus {
            background: #ef4444;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 13px;
            font-size: 9px;
            font-weight: 600;
        }

        .btn-konfirmasi-hapus:hover {
            background: #dc2626;
            color: #fff;
        }

        /* =====================================================
        RESPONSIVE
        ===================================================== */
        @media (max-width: 768px) {
            .master-supplier-page {
                padding: 15px 10px;
            }

            .supplier-header {
                align-items: flex-start;
            }

            .modal-supplier .modal-dialog,
            .modal-hapus .modal-dialog {
                max-width: calc(100% - 30px);
                margin: 15px auto;
            }

            .dataTables_wrapper .dataTables_filter {
                margin-top: 8px;
                text-align: left;
            }

            .dataTables_wrapper .dataTables_filter input {
                width: 160px;
            }
        }
    </style>


    {{-- =========================================================
        HALAMAN MASTER SUPPLIER
    ========================================================= --}}
    <div class="master-supplier-page">

        {{-- HEADER --}}
        <div class="supplier-header">

            <div class="supplier-title-wrapper">

                <div class="supplier-icon">
                    <i class="fas fa-truck"></i>
                </div>

                <div>
                    <h2 class="supplier-title">
                        Master Supplier
                    </h2>

                    <p class="supplier-subtitle">
                        Data supplier yang terdaftar
                    </p>
                </div>

            </div>


            <button
                type="button"
                class="btn-tambah-supplier"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahSupplier"
            >
                <i class="fas fa-plus"></i>
                Tambah Supplier
            </button>

        </div>


        {{-- TABLE --}}
        <div class="supplier-card">

            <div class="supplier-table-wrapper">

                <table
                    id="supplier-table"
                    class="supplier-table table align-middle"
                >

                    <thead>
                        <tr>

                            <th
                                class="text-center"
                                style="width: 70px;"
                            >
                                No
                            </th>

                            <th>
                                Kode Supplier
                            </th>

                            <th>
                                Nama Supplier
                            </th>

                            <th
                                class="aksi-header"
                                
                            >
                                Aksi
                            </th>

                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MODAL TAMBAH SUPPLIER
    ========================================================= --}}
    <div
        class="modal fade modal-supplier"
        id="modalTambahSupplier"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fas fa-truck"></i>
                        Tambah Supplier
                    </h5>

                </div>


                <form
                    id="formTambahSupplier"
                    action="{{ route('master-supplier.store') }}"
                    method="POST"
                >

                    @csrf


                    <div class="modal-body">

                        {{-- KODE --}}
                        <div class="form-supplier-group">

                            <label class="form-supplier-label">
                                Kode Supplier
                            </label>

                            <input
                                type="text"
                                name="kode"
                                id="tambahKode"
                                class="form-supplier-control"
                                placeholder="Contoh: SUP001"
                                required
                            >

                        </div>


                        {{-- NAMA --}}
                        <div class="form-supplier-group">

                            <label class="form-supplier-label">
                                Nama Supplier
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="tambahNama"
                                class="form-supplier-control"
                                placeholder="Masukkan nama supplier"
                                required
                            >

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn-batal-supplier"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>


                        <button
                            type="submit"
                            id="btnSimpanSupplier"
                            class="btn-simpan-supplier"
                        >
                            <i class="fas fa-save"></i>
                            Simpan Data
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


    {{-- =========================================================
        MODAL DETAIL SUPPLIER
    ========================================================= --}}
    <div
        class="modal fade modal-supplier"
        id="modalDetailSupplier"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fas fa-eye"></i>
                        Detail Supplier
                    </h5>

                </div>


                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="form-supplier-group">

                        <label class="form-supplier-label">
                            Kode Supplier
                        </label>

                        <div
                            class="view-supplier-value"
                            id="detailKode"
                        >
                            -
                        </div>

                    </div>


                    {{-- NAMA --}}
                    <div class="form-supplier-group">

                        <label class="form-supplier-label">
                            Nama Supplier
                        </label>

                        <div
                            class="view-supplier-value"
                            id="detailNama"
                        >
                            -
                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-supplier"
                        data-bs-dismiss="modal"
                    >
                        Tutup
                    </button>

                </div>

            </div>

        </div>
    </div>


    {{-- =========================================================
        MODAL EDIT SUPPLIER
    ========================================================= --}}
    <div
        class="modal fade modal-supplier"
        id="modalEditSupplier"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fas fa-edit"></i>
                        Edit Supplier
                    </h5>

                </div>


                <form
                    id="formEditSupplier"
                    method="POST"
                >

                    @csrf
                    @method('PUT')


                    <div class="modal-body">

                        {{-- KODE --}}
                        <div class="form-supplier-group">

                            <label class="form-supplier-label">
                                Kode Supplier
                            </label>

                            <input
                                type="text"
                                name="kode"
                                id="editKode"
                                class="form-supplier-control"
                                required
                            >

                        </div>


                        {{-- NAMA --}}
                        <div class="form-supplier-group">

                            <label class="form-supplier-label">
                                Nama Supplier
                            </label>

                            <input
                                type="text"
                                name="nama"
                                id="editNama"
                                class="form-supplier-control"
                                required
                            >

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn-batal-supplier"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>


                        <button
                            type="submit"
                            id="btnUpdateSupplier"
                            class="btn-simpan-supplier"
                        >
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


    {{-- =========================================================
        MODAL HAPUS SUPPLIER
    ========================================================= --}}
    <div
        class="modal fade modal-hapus"
        id="modalHapusSupplier"
        tabindex="-1"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">
                        <i class="fas fa-trash me-1"></i>
                        Konfirmasi Hapus
                    </h5>

                </div>


                <div class="modal-body">

                    <div class="icon-hapus-besar">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>

                    <p class="hapus-text">
                        Apakah kamu yakin ingin menghapus supplier
                        <span
                            class="hapus-nama"
                            id="hapusNamaSupplier"
                        >
                            -
                        </span>
                        ?
                    </p>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-supplier"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="button"
                        id="btnProsesHapus"
                        class="btn-konfirmasi-hapus"
                    >
                        <i class="fas fa-trash me-1"></i>
                        Ya, Hapus
                    </button>

                </div>

            </div>

        </div>
    </div>

    @endsection


    @push('scripts')

    {{-- SWEETALERT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- DATATABLE --}}
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


    <script>
    $(document).ready(function () {

        /* =========================================================
        CSRF TOKEN
        ========================================================= */
        const csrfToken = @json(csrf_token());


        /* =========================================================
        DATATABLE MASTER SUPPLIER
        ========================================================= */
        const table = $('#supplier-table').DataTable({

            processing: true,
            serverSide: true,

            /*
            |--------------------------------------------------------------------------
            | MATIKAN SORTING
            |--------------------------------------------------------------------------
            | Supaya tidak ada panah sorting seperti masalah
            | sebelumnya pada Master Obat.
            */
            ordering: false,

            ajax: "{{ route('master-supplier.data') }}",

            pageLength: 10,

            lengthMenu: [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],


            columns: [

                /* NO */
                {
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                },


                /* KODE */
                {
                    data: 'kode',
                    name: 'kode',
                    searchable: true,
                    orderable: false,

                    render: function (data) {

                        return `
                            <span class="kode-supplier-badge">
                                ${escapeHtml(data ?? '-')}
                            </span>
                        `;
                    }
                },


                /* NAMA */
                {
                    data: 'nama',
                    name: 'nama',
                    searchable: true,
                    orderable: false,

                    render: function (data) {

                        return `
                            <span class="nama-supplier-badge">
                                ${escapeHtml(data ?? '-')}
                            </span>
                        `;
                    }
                },


                /* AKSI */
                {
                    data: 'aksi',
                    name: 'aksi',
                    searchable: false,
                    orderable: false,
                    className: 'text-center'
                }

            ],


            language: {

                search: "",

                searchPlaceholder:
                    "Cari supplier...",

                lengthMenu:
                    "Tampilkan _MENU_ data",

                info:
                    "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

                infoEmpty:
                    "Menampilkan 0 sampai 0 dari 0 data",

                emptyTable:
                    "Belum ada data supplier",

                zeroRecords:
                    "Data supplier tidak ditemukan",

                processing:
                    "Memuat data...",

                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Lanjut",
                    previous: "Kembali"
                }
            }
        });


        /* =========================================================
        ESCAPE HTML
        ========================================================= */
        function escapeHtml(value) {

            if (
                value === null ||
                value === undefined
            ) {
                return '';
            }

            return $('<div>')
                .text(value)
                .html();
        }


        /* =========================================================
        TOMBOL LIHAT
        ========================================================= */
        $('#supplier-table').on(
            'click',
            '.btn-lihat',
            function (e) {

                e.preventDefault();

                const rowElement =
                    $(this).closest('tr');

                const data =
                    table.row(rowElement).data();

                if (!data) {
                    return;
                }


                $('#detailKode').text(
                    data.kode ?? '-'
                );

                $('#detailNama').text(
                    data.nama ?? '-'
                );


                const modalElement =
                    document.getElementById(
                        'modalDetailSupplier'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();
            }
        );


        /* =========================================================
        TOMBOL EDIT
        ========================================================= */
        $('#supplier-table').on(
            'click',
            '.btn-edit',
            function (e) {

                e.preventDefault();

                const rowElement =
                    $(this).closest('tr');

                const data =
                    table.row(rowElement).data();


                if (!data) {
                    return;
                }


                $('#editKode').val(
                    data.kode ?? ''
                );


                $('#editNama').val(
                    data.nama ?? ''
                );


                const baseUrl =
                    @json(url('/master-supplier'));


                $('#formEditSupplier').attr(
                    'action',
                    baseUrl + '/' + data.id
                );


                const modalElement =
                    document.getElementById(
                        'modalEditSupplier'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();
            }
        );


        /* =========================================================
        TAMBAH SUPPLIER
        ========================================================= */
        $('#formTambahSupplier').on(
            'submit',
            function (e) {

                e.preventDefault();


                const form = this;

                const btn =
                    $('#btnSimpanSupplier');


                btn.prop('disabled', true);

                btn.html(`
                    <i class="fas fa-spinner fa-spin"></i>
                    Menyimpan...
                `);


                $.ajax({

                    url: form.action,

                    type: 'POST',

                    data: $(form).serialize(),

                    success: function (response) {

                        /*
                        |------------------------------------------
                        | TUTUP MODAL
                        |------------------------------------------
                        */
                        const modalElement =
                            document.getElementById(
                                'modalTambahSupplier'
                            );


                        const modal =
                            bootstrap.Modal.getInstance(
                                modalElement
                            );


                        if (modal) {
                            modal.hide();
                        }


                        /*
                        |------------------------------------------
                        | RESET FORM
                        |------------------------------------------
                        */
                        form.reset();


                        /*
                        |------------------------------------------
                        | REFRESH DATATABLE TANPA RELOAD HALAMAN
                        |------------------------------------------
                        */
                        table.ajax.reload(
                            null,
                            false
                        );


                        /*
                        |------------------------------------------
                        | SWEETALERT
                        |------------------------------------------
                        */
                        Swal.fire({

                            icon: 'success',

                            title: 'Berhasil!',

                            text:
                                response.message ??
                                'Data supplier berhasil ditambahkan.',

                            confirmButtonColor:
                                '#1877f2'

                        });
                    },


                    error: function (xhr) {

                        let message =
                            'Terjadi kesalahan saat menyimpan data.';


                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.errors
                        ) {

                            const errors =
                                xhr.responseJSON.errors;


                            message =
                                Object.values(errors)
                                    .flat()
                                    .join('<br>');

                        } else if (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        ) {

                            message =
                                xhr.responseJSON.message;
                        }


                        Swal.fire({

                            icon: 'error',

                            title: 'Gagal',

                            html: message,

                            confirmButtonColor:
                                '#1877f2'

                        });
                    },


                    complete: function () {

                        btn.prop(
                            'disabled',
                            false
                        );


                        btn.html(`
                            <i class="fas fa-save"></i>
                            Simpan Data
                        `);
                    }

                });

            }
        );


        /* =========================================================
        UPDATE SUPPLIER
        ========================================================= */
        $('#formEditSupplier').on(
            'submit',
            function (e) {

                e.preventDefault();


                const form = this;

                const btn =
                    $('#btnUpdateSupplier');


                btn.prop(
                    'disabled',
                    true
                );


                btn.html(`
                    <i class="fas fa-spinner fa-spin"></i>
                    Menyimpan...
                `);


                $.ajax({

                    url: form.action,

                    type: 'POST',

                    data: $(form).serialize(),

                    success: function (response) {

                        /*
                        |------------------------------------------
                        | TUTUP MODAL
                        |------------------------------------------
                        */
                        const modalElement =
                            document.getElementById(
                                'modalEditSupplier'
                            );


                        const modal =
                            bootstrap.Modal.getInstance(
                                modalElement
                            );


                        if (modal) {
                            modal.hide();
                        }


                        /*
                        |------------------------------------------
                        | REFRESH TABLE
                        |------------------------------------------
                        */
                        table.ajax.reload(
                            null,
                            false
                        );


                        /*
                        |------------------------------------------
                        | SWEETALERT
                        |------------------------------------------
                        */
                        Swal.fire({

                            icon: 'success',

                            title: 'Berhasil!',

                            text:
                                response.message ??
                                'Data supplier berhasil diperbarui.',

                            confirmButtonColor:
                                '#1877f2'

                        });
                    },


                    error: function (xhr) {

                        let message =
                            'Terjadi kesalahan saat memperbarui data.';


                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.errors
                        ) {

                            message =
                                Object.values(
                                    xhr.responseJSON.errors
                                )
                                .flat()
                                .join('<br>');

                        } else if (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        ) {

                            message =
                                xhr.responseJSON.message;
                        }


                        Swal.fire({

                            icon: 'error',

                            title: 'Gagal',

                            html: message,

                            confirmButtonColor:
                                '#1877f2'

                        });
                    },


                    complete: function () {

                        btn.prop(
                            'disabled',
                            false
                        );


                        btn.html(`
                            <i class="fas fa-save"></i>
                            Simpan Perubahan
                        `);
                    }

                });

            }
        );


        /* =========================================================
        PILIH DATA YANG AKAN DIHAPUS
        ========================================================= */
        let deleteTargetUrl = '';


        $('#supplier-table').on(
            'click',
            '.btn-hapus-supplier',
            function (e) {

                e.preventDefault();


                const rowElement =
                    $(this).closest('tr');


                const data =
                    table.row(rowElement).data();


                if (!data) {
                    return;
                }


                deleteTargetUrl =
                    $(this).data('url');


                $('#hapusNamaSupplier').text(
                    data.nama ?? '-'
                );


                const modalElement =
                    document.getElementById(
                        'modalHapusSupplier'
                    );


                const modal =
                    bootstrap.Modal.getOrCreateInstance(
                        modalElement
                    );


                modal.show();
            }
        );


        /* =========================================================
        PROSES HAPUS
        ========================================================= */
        $('#btnProsesHapus').on(
            'click',
            function () {

                if (!deleteTargetUrl) {
                    return;
                }


                const btn =
                    $(this);


                btn.prop(
                    'disabled',
                    true
                );


                btn.html(`
                    <i class="fas fa-spinner fa-spin me-1"></i>
                    Menghapus...
                `);


                $.ajax({

                    url: deleteTargetUrl,

                    type: 'POST',

                    data: {
                        _token: csrfToken,
                        _method: 'DELETE'
                    },


                    success: function (response) {

                        /*
                        |------------------------------------------
                        | TUTUP MODAL
                        |------------------------------------------
                        */
                        const modalElement =
                            document.getElementById(
                                'modalHapusSupplier'
                            );


                        const modal =
                            bootstrap.Modal.getInstance(
                                modalElement
                            );


                        if (modal) {
                            modal.hide();
                        }


                        /*
                        |------------------------------------------
                        | REFRESH DATATABLE
                        |------------------------------------------
                        */
                        table.ajax.reload(
                            null,
                            false
                        );


                        /*
                        |------------------------------------------
                        | RESET URL
                        |------------------------------------------
                        */
                        deleteTargetUrl = '';


                        /*
                        |------------------------------------------
                        | SWEETALERT
                        |------------------------------------------
                        */
                        Swal.fire({

                            icon: 'success',

                            title: 'Terhapus!',

                            text:
                                response.message ??
                                'Data supplier berhasil dihapus.',

                            confirmButtonColor:
                                '#1877f2'

                        });
                    },


                    error: function (xhr) {

                        let message =
                            'Terjadi kesalahan saat menghapus data.';


                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        ) {

                            message =
                                xhr.responseJSON.message;
                        }


                        Swal.fire({

                            icon: 'error',

                            title: 'Gagal Hapus',

                            text: message,

                            confirmButtonColor:
                                '#1877f2'

                        });
                    },


                    complete: function () {

                        btn.prop(
                            'disabled',
                            false
                        );


                        btn.html(`
                            <i class="fas fa-trash me-1"></i>
                            Ya, Hapus
                        `);
                    }

                });

            }
        );


        /* =========================================================
        RESET FORM TAMBAH KETIKA MODAL DITUTUP
        ========================================================= */
        $('#modalTambahSupplier').on(
            'hidden.bs.modal',
            function () {

                document
                    .getElementById(
                        'formTambahSupplier'
                    )
                    .reset();

            }
        );

    });
    </script>

    @endpush
