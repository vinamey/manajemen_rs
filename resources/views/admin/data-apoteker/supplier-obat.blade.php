
@extends('layouts.superadmin')

@section('page-title', 'Supplier Obat')
@section('navbar-title', 'Supplier Obat')

@section('content')

@push('styles')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    .supplier-admin-page {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --blue-soft: #f4f8ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
        color: var(--text-dark);
    }

    .supplier-admin-page .welcome-card {
        background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
        color: white;
        border: none;
        border-radius: 18px;
        padding: 25px 28px;
        box-shadow: 0 8px 20px rgba(24,119,242,.18);
        margin-bottom: 26px;
    }

    .supplier-admin-page .welcome-card h3 {
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .supplier-admin-page .welcome-card p {
        margin: 0;
        opacity: .92;
        font-size: 15px;
    }

    .supplier-admin-page .content-card {
        background: white;
        border: none;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(0,0,0,.05);
        overflow: hidden;
    }

    .supplier-admin-page .card-header-custom {
        padding: 20px 25px;
        border-bottom: 1px solid #edf0f5;
    }

    .supplier-admin-page .content-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .supplier-admin-page .content-subtitle {
        color: #7a879a;
        font-size: 13px;
        margin-top: 7px;
        margin-bottom: 0;
    }

    .supplier-admin-page .card-body-custom {
        padding: 22px 25px;
    }

    .supplier-admin-page table.dataTable {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .supplier-admin-page table.dataTable thead th {
        background: var(--blue-main) !important;
        color: white !important;
        border-bottom: none !important;
        padding: 14px 12px !important;
        font-size: 13px;
        white-space: nowrap;
    }

    .supplier-admin-page table.dataTable tbody td {
        padding: 13px 12px;
        vertical-align: middle;
        font-size: 13px;
    }

    .supplier-admin-page table.dataTable tbody tr:hover {
        background: var(--blue-soft);
    }

    .supplier-admin-page .number-badge {
        display: inline-flex;
        width: 35px;
        height: 35px;
        justify-content: center;
        align-items: center;
        background: var(--blue-light);
        color: var(--blue-main);
        border-radius: 10px;
        font-weight: 700;
        font-size: 13px;
    }

    .supplier-admin-page .supplier-name {
        font-weight: 600;
        color: #26364b;
    }

    .supplier-admin-page .dataTables_wrapper {
        font-size: 13px;
        color: #59677b;
    }

    .supplier-admin-page .dataTables_wrapper .dataTables_filter input,
    .supplier-admin-page .dataTables_wrapper .dataTables_length select {
        border: 1px solid #dce3ed;
        border-radius: 8px;
        padding: 8px 10px;
        outline: none;
        background: white;
    }

    .supplier-admin-page .dataTables_wrapper .dataTables_filter input:focus,
    .supplier-admin-page .dataTables_wrapper .dataTables_length select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24,119,242,.1);
    }

    .supplier-admin-page .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
        margin: 0 2px;
    }

    .supplier-admin-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--blue-main) !important;
        color: white !important;
        border: 1px solid var(--blue-main) !important;
    }

    .supplier-admin-page .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: var(--blue-dark) !important;
        color: white !important;
        border: 1px solid var(--blue-dark) !important;
    }

    .supplier-admin-page .footer-text {
        text-align: center;
        color: #8a95a7;
        font-size: 12px;
        padding: 25px 0 10px;
    }

    @media(max-width: 576px) {
        .supplier-admin-page .welcome-card {
            padding: 20px;
        }

        .supplier-admin-page .welcome-card h3 {
            font-size: 21px;
        }

        .supplier-admin-page .card-header-custom,
        .supplier-admin-page .card-body-custom {
            padding: 16px;
        }
    }
</style>
@endpush

<div class="supplier-admin-page">

    {{-- BANNER --}}
    <div class="welcome-card">
        <h3>Data Supplier Obat 🏢</h3>
        <p>
            Informasi daftar pemasok obat yang bekerja sama dengan rumah sakit.
        </p>
    </div>

    {{-- PESAN SUKSES --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- PESAN ERROR --}}
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

    {{-- CARD SUPPLIER --}}
    <div class="content-card">

        <div class="card-header-custom">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h5 class="content-title">
                        <i class="fa-solid fa-truck-field me-2"
                           style="color:#1877f2"></i>
                        Daftar Supplier
                    </h5>

                    <p class="content-subtitle">
                        Daftar informasi supplier obat yang terdaftar di rumah sakit.
                    </p>
                </div>
            </div>
        </div>

        <div class="card-body-custom">
            <div class="table-responsive">

                <table id="tabelSupplier"
                       class="table table-hover table-bordered w-100">

                    <thead>
                        <tr>
                            <th width="80">No.</th>
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

    </div>

    <div class="footer-text">
        SIM RS &copy; {{ date('Y') }} — Admin Rumah Sakit
    </div>

</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
@endpush
