
@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Obat')

@section('content')

{{-- DATATABLE CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

{{-- SELECT2 CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    .master-obat-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 22px 18px;
    }

    .obat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px;
    }

    .obat-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .obat-icon {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: var(--blue-light);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .obat-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .obat-subtitle {
        margin: 3px 0 0;
        font-size: 10px;
        color: var(--text-muted);
    }

    .btn-tambah-obat {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 9px 14px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }

    .btn-tambah-obat:hover,
    .btn-edit:hover,
    .btn-simpan-obat:hover {
        background: var(--blue-dark);
        color: white;
    }

    .alert-obat {
        border-radius: 7px;
        padding: 10px 12px;
        margin-bottom: 14px;
        font-size: 11px;
    }

    .obat-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        padding-bottom: 10px;
        overflow: hidden;
    }

    .obat-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .obat-table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin: 0 !important;
    }

    .obat-table thead th {
        background: var(--blue-main) !important;
        color: white !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        padding: 11px 12px !important;
        border: none !important;
        white-space: nowrap;
    }

    .obat-table tbody td {
        padding: 10px 12px !important;
        font-size: 10px !important;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4 !important;
        vertical-align: middle !important;
        background: white;
    }

    .obat-table tbody tr:hover td {
        background: #fafcff;
    }

    #obat-table thead th:nth-child(1),
    #obat-table thead th:nth-child(3),
    #obat-table thead th:nth-child(4) {
        background-image: none !important;
    }

    #obat-table thead th:nth-child(1)::before,
    #obat-table thead th:nth-child(1)::after,
    #obat-table thead th:nth-child(3)::before,
    #obat-table thead th:nth-child(3)::after,
    #obat-table thead th:nth-child(4)::before,
    #obat-table thead th:nth-child(4)::after {
        display: none !important;
    }

    .nama-obat {
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
    }

    .kategori-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #fff0d5;
        color: #e8791b;
        font-size: 9px;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        white-space: nowrap;
    }

    .action-buttons form {
        margin: 0;
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
        text-decoration: none !important;
    }

    .btn-lihat {
        background: #dff2ff;
        color: #087db9;
    }

    .btn-lihat:hover {
        background: #c8eaff;
    }

    .btn-edit {
        background: var(--blue-main);
        color: white;
    }

    .btn-hapus {
        background: #ef4444;
        color: white;
    }

    .btn-hapus:hover {
        background: #dc2626;
        color: white;
    }

    .dataTables_wrapper {
        width: 100%;
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
    }

    .dataTables_wrapper .page-item.active .page-link {
        background: var(--blue-main);
        border-color: var(--blue-main);
        color: white;
    }

    table.dataTable.no-footer {
        border-bottom: none !important;
    }

    /* MODAL */
    .modal-obat .modal-dialog {
        max-width: 460px;
    }

    .modal-obat .modal-content {
        border: none;
        border-radius: 12px;
        overflow: visible;
        box-shadow: 0 15px 40px rgba(0,0,0,.25);
    }

    .modal-obat .modal-header {
        background: var(--blue-main);
        border: none;
        padding: 14px 16px;
        color: white;
        border-radius: 12px 12px 0 0;
    }

    .modal-obat .modal-title {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .modal-obat .modal-body {
        padding: 18px 16px;
        background: white;
    }

    .modal-obat .modal-footer {
        border: none;
        background: #f8fafc;
        padding: 11px 16px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
        border-radius: 0 0 12px 12px;
    }

    .form-obat-group {
        margin-bottom: 14px;
    }

    .form-obat-group:last-child {
        margin-bottom: 0;
    }

    .form-obat-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 5px;
    }

    .form-obat-control {
        width: 100%;
        min-height: 36px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 8px 9px;
        font-size: 10px;
        color: #374151;
        outline: none;
        background: white;
        box-sizing: border-box;
    }

    .form-obat-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24,119,242,.10);
    }

    .error-obat {
        color: #dc3545;
        font-size: 9px;
        margin-top: 3px;
        display: block;
    }

    .view-obat-value {
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

    .btn-batal-obat {
        background: #eef2f7;
        border: none;
        color: #64748b;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-simpan-obat {
        background: var(--blue-main);
        color: white;
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

    /* SELECT2 NAMA OBAT */
    .select2-container {
        width: 100% !important;
        font-size: 10px;
    }

    .select2-container--default .select2-selection--single {
        height: 36px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        display: flex;
        align-items: center;
    }

    .select2-container--default .select2-selection--single
    .select2-selection__rendered {
        padding-left: 9px;
        padding-right: 28px;
        color: #374151;
        line-height: 34px;
        font-size: 10px;
    }

    .select2-container--default .select2-selection--single
    .select2-selection__arrow {
        height: 34px;
        right: 5px;
    }

    .select2-dropdown {
        border: 1px solid #d4dce6;
        border-radius: 6px;
        overflow: hidden;
        z-index: 2000;
    }

    .select2-container--default .select2-search--dropdown {
        padding: 7px;
    }

    .select2-container--default .select2-search--dropdown
    .select2-search__field {
        height: 30px;
        border: 1px solid #d4dce6;
        border-radius: 5px;
        padding: 5px 8px;
        outline: none;
        font-size: 10px;
    }

    .select2-results__option {
        padding: 8px 10px;
        font-size: 10px;
    }

    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background: var(--blue-main);
        color: white;
    }

    .select2-results__options {
        max-height: 180px !important;
        overflow-y: auto !important;
    }

    @media (max-width: 768px) {
        .master-obat-page {
            padding: 15px 10px;
        }

        .modal-obat .modal-dialog {
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

{{-- HALAMAN MASTER OBAT --}}
<div class="master-obat-page">

    <div class="obat-header">
        <div class="obat-title-wrapper">
            <div class="obat-icon">
                <i class="fas fa-pills"></i>
            </div>

            <div>
                <h2 class="obat-title">Master Obat</h2>
                <p class="obat-subtitle">Data obat yang terdaftar</p>
            </div>
        </div>

        <button type="button"
                class="btn-tambah-obat"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahObat">
            <i class="fas fa-plus"></i>
            Tambah Obat
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-obat">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-obat">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABEL --}}
    <div class="obat-card">
        <div class="obat-table-wrapper">
            <table id="obat-table" class="obat-table table align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">No</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade modal-obat"
     id="modalTambahObat"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-pills"></i>
                    Tambah Obat
                </h5>
            </div>

            <form action="{{ route('master-obat.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    {{-- NAMA OBAT --}}
                    <div class="form-obat-group">
                        <label class="form-obat-label" for="namaObat">
                            Nama Obat
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="namaObat"
                            class="form-obat-control"
                            placeholder="Masukkan nama obat"
                            value="{{ old('nama') }}"
                            required
                        >

                        @error('nama')
                            <span class="error-obat">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="form-obat-group">
                        <label class="form-obat-label" for="kategoriTambah">
                            Kategori
                        </label>

                        <select name="kategori_id"
                                id="kategoriTambah"
                                class="form-obat-control"
                                required>

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('kategori_id')
                            <span class="error-obat">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-batal-obat"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan-obat">
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL LIHAT --}}
<div class="modal fade modal-obat"
     id="modalLihatObat"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye"></i>
                    Detail Obat
                </h5>
            </div>

            <div class="modal-body">
                <div class="form-obat-group">
                    <label class="form-obat-label">Nama Obat</label>
                    <div class="view-obat-value" id="lihatNama">-</div>
                </div>

                <div class="form-obat-group">
                    <label class="form-obat-label">Kategori</label>
                    <div class="view-obat-value" id="lihatKategori">-</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn-batal-obat"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade modal-obat"
     id="modalEditObat"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Obat
                </h5>
            </div>

            <form id="formEditObat" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-obat-group">
                        <label class="form-obat-label" for="editNama">
                            Nama Obat
                        </label>

                        <input type="text"
                               name="nama"
                               id="editNama"
                               class="form-obat-control"
                               required>
                    </div>

                    <div class="form-obat-group">
                        <label class="form-obat-label" for="editKategori">
                            Kategori
                        </label>

                        <select name="kategori_id"
                                id="editKategori"
                                class="form-obat-control"
                                required>

                            <option value="">-- Pilih Kategori --</option>

                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-batal-obat"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan-obat">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- SELECT2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- DATATABLE JS --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    
    /* DATATABLE */
    const table = $('#obat-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master-obat.data') }}",
        pageLength: 10,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center'
            },
            {
                data: 'nama',
                name: 'nama',
                render: function (data) {
                    return '<span class="nama-obat">' +
                        escapeHtml(data ?? '-') +
                        '</span>';
                }
            },
            {
                data: 'kategori_nama',
                name: 'kategori_nama',
                orderable: false,
                searchable: true,
                render: function (data) {
                    return '<span class="kategori-badge">' +
                        escapeHtml(data ?? '-') +
                        '</span>';
                }
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ],
        order: [],
        language: {
            search: '',
            searchPlaceholder: 'Cari obat...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
            emptyTable: 'Belum ada data obat',
            zeroRecords: 'Data obat tidak ditemukan',
            processing: 'Memuat data...',
            paginate: {
                first: 'Awal',
                last: 'Akhir',
                next: 'Lanjut',
                previous: 'Kembali'
            }
        }
    });

    /* AMANKAN TEKS */
    function escapeHtml(value) {
        return $('<div>').text(value ?? '').html();
    }

    /* LIHAT OBAT */
    $('#obat-table').on('click', '.btn-lihat', function (e) {
        e.preventDefault();

        const row = $(this).closest('tr');
        const data = table.row(row).data();

        if (!data) return;

        $('#lihatNama').text(data.nama ?? '-');
        $('#lihatKategori').text(data.kategori_nama ?? '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihatObat')
        ).show();
    });

    /* EDIT OBAT */
    $('#obat-table').on('click', '.btn-edit', function (e) {
        e.preventDefault();

        const row = $(this).closest('tr');
        const data = table.row(row).data();

        if (!data) return;

        $('#editNama').val(data.nama ?? '');
        $('#editKategori').val(String(data.kategori_id ?? ''));

        const baseUrl = @json(url('/master-obat'));

        $('#formEditObat').attr(
            'action',
            baseUrl + '/' + data.id
        );

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEditObat')
        ).show();
    });

    /* BUKA MODAL LAGI JIKA VALIDASI GAGAL */
    @if($errors->any())
        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalTambahObat')
        ).show();
    @endif

});
</script>

@endsection
