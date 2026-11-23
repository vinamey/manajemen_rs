
@extends('layouts.superadmin')

@section('page-title', 'Log Stok Obat')
@section('navbar-title', 'Log Stok Obat')

@push('styles')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    .log-stok-admin-page {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --text-dark: #1f2937;
        color: var(--text-dark);
        font-family: Arial, sans-serif;
    }

    .log-stok-admin-page *,
    .log-stok-admin-page *::before,
    .log-stok-admin-page *::after {
        box-sizing: border-box;
    }

    /* WELCOME */
    .log-stok-admin-page .welcome-card {
        background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
        color: white;
        border: none;
        border-radius: 18px;
        padding: 23px 27px;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(24,119,242,.16);
    }

    .log-stok-admin-page .welcome-card h3 {
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .log-stok-admin-page .welcome-card p {
        font-size: 14px;
        margin: 0;
        opacity: .9;
    }

    .log-stok-admin-page .welcome-icon {
        width: 55px;
        height: 55px;
        background: rgba(255,255,255,.17);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        flex-shrink: 0;
    }

    /* CONTENT CARD */
    .log-stok-admin-page .content-card {
        background: white;
        border: 1px solid #e9eef5;
        border-radius: 17px;
        box-shadow: 0 4px 15px rgba(25,50,90,.045);
        overflow: hidden;
    }

    .log-stok-admin-page .card-header-custom {
        padding: 20px 23px;
        border-bottom: 1px solid #edf0f5;
    }

    .log-stok-admin-page .content-title {
        font-size: 17px;
        font-weight: 700;
        margin: 0;
        color: #243247;
    }

    .log-stok-admin-page .content-title i {
        color: var(--blue-main);
        margin-right: 9px;
    }

    .log-stok-admin-page .content-subtitle {
        color: #7a879a;
        font-size: 13px;
        margin-top: 6px;
        margin-bottom: 0;
    }

    .log-stok-admin-page .card-body-custom {
        padding: 22px;
    }

    /* BUTTON */
    .log-stok-admin-page .btn-add {
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

    .log-stok-admin-page .btn-add:hover {
        background: var(--blue-dark);
        color: white;
        transform: translateY(-2px);
    }

    /* TABLE */
    .log-stok-admin-page table.dataTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 12px !important;
    }

    .log-stok-admin-page table.dataTable thead th {
        background: var(--blue-main) !important;
        color: white !important;
        border-bottom: none !important;
        padding: 14px 13px !important;
        font-size: 13px;
        white-space: nowrap;
    }

    .log-stok-admin-page table.dataTable tbody td {
        padding: 13px !important;
        vertical-align: middle;
        font-size: 13px;
        color: #344054;
    }

    .log-stok-admin-page table.dataTable tbody tr:hover {
        background: #f3f8ff !important;
    }

    .log-stok-admin-page .dataTables_wrapper {
        font-size: 13px;
        color: #59677b;
    }

    .log-stok-admin-page .dataTables_wrapper .dataTables_filter input,
    .log-stok-admin-page .dataTables_wrapper .dataTables_length select {
        border: 1px solid #dce3ed;
        border-radius: 8px;
        padding: 7px 10px;
        outline: none;
        background: white;
        font-size: 13px;
        margin-left: 7px;
    }

    .log-stok-admin-page .dataTables_wrapper .dataTables_filter input:focus,
    .log-stok-admin-page .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.1);
    }

    .log-stok-admin-page .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 5px 11px;
    }

    .log-stok-admin-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--blue-main) !important;
        border: 1px solid var(--blue-main) !important;
        color: white !important;
    }

    .log-stok-admin-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #eaf2ff !important;
        border: 1px solid #dce3ed !important;
        color: var(--blue-main) !important;
    }

    .log-stok-admin-page .dataTables_empty {
        padding: 25px !important;
        text-align: center !important;
        color: #7a879a !important;
    }

    /* STATUS */
    .log-stok-admin-page .status-masuk {
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

    .log-stok-admin-page .status-keluar {
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

    .log-stok-admin-page .stok-badge {
        display: inline-block;
        background: var(--blue-main);
        color: white;
        padding: 6px 13px;
        border-radius: 7px;
        font-size: 13px;
        font-weight: 700;
    }

    /* FOOTER */
    .log-stok-admin-page .footer-text {
        text-align: center;
        color: #8a95a7;
        font-size: 11px;
        padding: 25px 0 10px;
    }

    /* MODAL */
    .log-stok-admin-page .modal-dialog {
        max-width: 460px;
    }

    .log-stok-admin-page .modal-content {
        border: none;
        border-radius: 9px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.18);
    }

    .log-stok-admin-page .modal-header {
        background: var(--blue-main);
        color: white;
        padding: 12px 15px;
        border: none;
    }

    .log-stok-admin-page .modal-title {
        font-size: 15px;
        font-weight: 700;
    }

    .log-stok-admin-page .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: .8;
        box-shadow: none;
    }

    .log-stok-admin-page .modal-body {
        padding: 20px 18px;
    }

    .log-stok-admin-page .modal-body .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #344054;
        margin-bottom: 7px;
    }

    .log-stok-admin-page .modal-body .form-control,
    .log-stok-admin-page .modal-body .form-select {
        border: 1px solid #dce3ed;
        border-radius: 7px;
        padding: 9px 10px;
        font-size: 12px;
    }

    .log-stok-admin-page .modal-body .form-control:focus,
    .log-stok-admin-page .modal-body .form-select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.1);
    }

    .log-stok-admin-page .modal-footer {
        padding: 12px 18px;
        background: #f8f9fa;
        border-top: 1px solid #e9eef5;
    }

    .log-stok-admin-page .btn-modal-cancel {
        background: white;
        border: 1px solid #adb5bd;
        color: #59677b;
        padding: 7px 16px;
        border-radius: 6px;
        font-size: 12px;
    }

    .log-stok-admin-page .btn-modal-save {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 8px 17px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }

    .log-stok-admin-page .btn-modal-save:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* RESPONSIVE */
    @media(max-width: 900px) {
        .log-stok-admin-page .welcome-card {
            padding: 22px;
        }
    }

    @media(max-width: 600px) {
        .log-stok-admin-page .welcome-card {
            padding: 18px;
        }

        .log-stok-admin-page .welcome-card h3 {
            font-size: 19px;
        }

        .log-stok-admin-page .card-body-custom {
            padding: 14px;
        }

        .log-stok-admin-page .modal-dialog {
            margin: 15px;
        }
    }
</style>
@endpush


@section('content')
<div class="log-stok-admin-page">

    {{-- WELCOME --}}
    <div class="welcome-card">
        <div class="d-flex align-items-center gap-3">
            <div class="welcome-icon">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>

            <div>
                <h3>Log Stok Obat Admin</h3>
                <p>Riwayat perubahan stok obat dan informasi stok tersedia.</p>
            </div>
        </div>
    </div>

    {{-- AJAX MESSAGE --}}
    <div id="ajaxMessage"></div>

    {{-- SESSION MESSAGE --}}
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

    {{-- CONTENT CARD --}}
    <div class="content-card">

        {{-- CARD HEADER --}}
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

        {{-- TABLE --}}
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

    {{-- FOOTER --}}
    <div class="footer-text">
        SIM RS © {{ date('Y') }} — Admin Rumah Sakit
    </div>


    {{-- MODAL TAMBAH STOK --}}
    <div class="modal fade"
        id="modalTambahStok"
        tabindex="-1"
        aria-labelledby="judulModalStok"
        aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="formTambahStok"
                    action="{{ route('admin.apoteker.log-stok.store') }}"
                    method="POST">

                    @csrf

                    {{-- HEADER MODAL --}}
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

                    {{-- BODY MODAL --}}
                    <div class="modal-body">

                        {{-- NAMA OBAT --}}
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

                        {{-- SATUAN OBAT --}}
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

                        {{-- JUMLAH STOK --}}
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

                        {{-- TANGGAL KEDALUWARSA --}}
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

                    {{-- FOOTER MODAL --}}
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

</div>
@endsection


@push('scripts')
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
            url: "{{ route('admin.apoteker.log-stok.data') }}",
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

                // SCROLL KE PESAN
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
@endpush

@push('scripts')

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DATATABLES --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    function escapeHtml(value) {
        return $('<div>').text(value ?? '-').html();
    }

    function formatTanggal(data) {
        if (!data) return '-';

        return `
            <i class="far fa-clock me-2 text-primary"></i>
            ${escapeHtml(data)}
        `;
    }

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
            url: "{{ route('admin.apoteker.log-stok.data') }}",
            type: "GET",
            dataSrc: "data",

            error: function (xhr) {
                console.error('Gagal mengambil data:', xhr.responseText);

                $('#ajaxMessage').html(`
                    <div class="alert alert-danger">
                        Gagal memuat data log stok obat.
                        Periksa respons AJAX di Console browser.
                    </div>
                `);
            }
        },

        columns: [
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'tanggal',
                defaultContent: '-',
                render: function (data) {
                    return formatTanggal(data);
                }
            },
            {
                data: 'nama_obat',
                defaultContent: '-',
                render: function (data) {
                    return `<span class="fw-semibold text-dark">${escapeHtml(data)}</span>`;
                }
            },
            {
                data: 'satuan',
                defaultContent: '-',
                render: function (data) {
                    return `<span class="text-secondary">${escapeHtml(data)}</span>`;
                }
            },
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
            {
                data: 'nilai',
                defaultContent: 0,
                render: function (data) {
                    let nilai = Number(data) || 0;

                    if (nilai > 0) {
                        return `<span class="fw-bold text-success">+${nilai}</span>`;
                    }

                    if (nilai < 0) {
                        return `<span class="fw-bold text-danger">${nilai}</span>`;
                    }

                    return '0';
                }
            },
            {
                data: 'stok_tersedia',
                defaultContent: 0,
                render: function (data) {
                    return `<span class="stok-badge">${Number(data) || 0}</span>`;
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
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById('modalTambahStok')
                ).hide();

                form.reset();
                table.ajax.reload(null, false);

                $('#ajaxMessage').html(`
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle me-2"></i>
                        ${escapeHtml(response.message || 'Stok obat berhasil disimpan.')}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            },

            error: function (xhr) {
                let message = 'Terjadi kesalahan saat menyimpan data.';

                if (xhr.responseJSON?.errors) {
                    message = Object.values(xhr.responseJSON.errors)
                        .flat()
                        .map(escapeHtml)
                        .join('<br>');
                } else if (xhr.responseJSON?.message) {
                    message = escapeHtml(xhr.responseJSON.message);
                }

                $('#ajaxMessage').html(`
                    <div class="alert alert-danger alert-dismissible fade show">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
            },

            complete: function () {
                button.prop('disabled', false);
                button.html(buttonAwal);
            }
        });
    });

    $('#modalTambahStok').on('hidden.bs.modal', function () {
        $('#formTambahStok')[0].reset();
    });

});
</script>
@endpush
