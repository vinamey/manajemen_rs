@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Frekuensi')

@section('content')

{{-- DATATABLE CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    .master-frekuensi-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 22px 18px;
    }

    .frekuensi-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 18px;
    }

    .frekuensi-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .frekuensi-icon {
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

    .frekuensi-title {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .frekuensi-subtitle {
        margin: 3px 0 0;
        font-size: 10px;
        color: var(--text-muted);
    }

    .btn-tambah-frekuensi {
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

    .btn-tambah-frekuensi:hover,
    .btn-edit:hover,
    .btn-simpan-frekuensi:hover {
        background: var(--blue-dark);
        color: white;
    }

    .alert-frekuensi {
        border-radius: 7px;
        padding: 10px 12px;
        margin-bottom: 14px;
        font-size: 11px;
    }

    .frekuensi-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        padding-bottom: 10px;
        overflow: hidden;
    }

    .frekuensi-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .frekuensi-table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin: 0 !important;
    }

    .frekuensi-table thead th {
        background: var(--blue-main) !important;
        color: white !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        padding: 11px 12px !important;
        border: none !important;
        white-space: nowrap;
    }

    .frekuensi-table tbody td {
        padding: 10px 12px !important;
        font-size: 10px !important;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4 !important;
        vertical-align: middle !important;
        background: white;
    }

    .frekuensi-table tbody tr:hover td {
        background: #fafcff;
    }

    .nama-frekuensi {
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
    }

    .kode-frekuensi {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #e7f3ff;
        color: #1877f2;
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
        color: #087db9;
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
    .modal-frekuensi .modal-dialog {
        max-width: 460px;
    }

    .modal-frekuensi .modal-content {
        border: none;
        border-radius: 12px;
        overflow: visible;
        box-shadow: 0 15px 40px rgba(0,0,0,.25);
    }

    .modal-frekuensi .modal-header {
        background: var(--blue-main);
        border: none;
        padding: 14px 16px;
        color: white;
        border-radius: 12px 12px 0 0;
    }

    .modal-frekuensi .modal-title {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .modal-frekuensi .modal-body {
        padding: 18px 16px;
        background: white;
    }

    .modal-frekuensi .modal-footer {
        border: none;
        background: #f8fafc;
        padding: 11px 16px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
        border-radius: 0 0 12px 12px;
    }

    .form-frekuensi-group {
        margin-bottom: 14px;
    }

    .form-frekuensi-group:last-child {
        margin-bottom: 0;
    }

    .form-frekuensi-label {
        display: block;
        font-size: 10px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 5px;
    }

    .form-frekuensi-control {
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

    .form-frekuensi-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24,119,242,.10);
    }

    .error-frekuensi {
        color: #dc3545;
        font-size: 9px;
        margin-top: 3px;
        display: block;
    }

    .view-frekuensi-value {
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

    .btn-batal-frekuensi {
        background: #eef2f7;
        border: none;
        color: #64748b;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-simpan-frekuensi {
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

    @media (max-width: 768px) {
        .master-frekuensi-page {
            padding: 15px 10px;
        }

        .modal-frekuensi .modal-dialog {
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

{{-- HALAMAN MASTER FREKUENSI --}}
<div class="master-frekuensi-page">

    <div class="frekuensi-header">
        <div class="frekuensi-title-wrapper">
            <div class="frekuensi-icon">
                <i class="fas fa-clock"></i>
            </div>

            <div>
                <h2 class="frekuensi-title">Master Frekuensi</h2>
                <p class="frekuensi-subtitle">Data frekuensi penggunaan obat</p>
            </div>
        </div>

        <button type="button"
                class="btn-tambah-frekuensi"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahFrekuensi">
            <i class="fas fa-plus"></i>
            Tambah Frekuensi
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-frekuensi">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-frekuensi">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- TABEL --}}
    <div class="frekuensi-card">
        <div class="frekuensi-table-wrapper">
            <table id="frekuensi-table" class="frekuensi-table table align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">No</th>
                        <th>Kode Frekuensi</th>
                        <th>Nama Frekuensi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade modal-frekuensi"
     id="modalTambahFrekuensi"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-clock"></i>
                    Tambah Frekuensi
                </h5>
            </div>

         <form id="formTambahFrekuensi"
      action="{{ route('master-frekuensi.store') }}"
      method="POST">
    @csrf

                <div class="modal-body">

                    <div class="form-frekuensi-group">
                        <label class="form-frekuensi-label" for="kodeFrekuensi">
                            Kode Frekuensi
                        </label>

                        <input
                            type="text"
                            name="kode"
                            id="kodeFrekuensi"
                            class="form-frekuensi-control"
                            placeholder="Masukkan kode frekuensi"
                            value="{{ old('kode') }}"
                        >

                        @error('kode')
                            <span class="error-frekuensi">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-frekuensi-group">
                        <label class="form-frekuensi-label" for="namaFrekuensi">
                            Nama Frekuensi
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="namaFrekuensi"
                            class="form-frekuensi-control"
                            placeholder="Masukkan nama frekuensi"
                            value="{{ old('nama') }}"
                            required
                        >

                        @error('nama')
                            <span class="error-frekuensi">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-batal-frekuensi"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan-frekuensi">
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL LIHAT --}}
<div class="modal fade modal-frekuensi"
     id="modalLihatFrekuensi"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye"></i>
                    Detail Frekuensi
                </h5>
            </div>

            <div class="modal-body">
                <div class="form-frekuensi-group">
                    <label class="form-frekuensi-label">Kode Frekuensi</label>
                    <div class="view-frekuensi-value" id="lihatKode">-</div>
                </div>

                <div class="form-frekuensi-group">
                    <label class="form-frekuensi-label">Nama Frekuensi</label>
                    <div class="view-frekuensi-value" id="lihatNama">-</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn-batal-frekuensi"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade modal-frekuensi"
     id="modalEditFrekuensi"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Frekuensi
                </h5>
            </div>

            <form id="formEditFrekuensi" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-frekuensi-group">
                        <label class="form-frekuensi-label" for="editKode">
                            Kode Frekuensi
                        </label>

                        <input type="text"
                               name="kode"
                               id="editKode"
                               class="form-frekuensi-control">
                    </div>

                    <div class="form-frekuensi-group">
                        <label class="form-frekuensi-label" for="editNama">
                            Nama Frekuensi
                        </label>

                        <input type="text"
                               name="nama"
                               id="editNama"
                               class="form-frekuensi-control"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-batal-frekuensi"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan-frekuensi">
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

{{-- DATATABLE JS --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    /* DATATABLE */
    const table = $('#frekuensi-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master-frekuensi.data') }}",
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
                data: 'kode',
                name: 'kode',
                render: function (data) {
                    return '<span class="kode-frekuensi">' +
                        escapeHtml(data ?? '-') +
                        '</span>';
                }
            },
            {
                data: 'nama',
                name: 'nama',
                render: function (data) {
                    return '<span class="nama-frekuensi">' +
                        escapeHtml(data ?? '-') +
                        '</span>';
                }
            },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function (data, type, row) {
                    return `
                        <div class="action-buttons">
                            <button type="button"
                                    class="btn-aksi btn-lihat"
                                    data-id="${row.id}">
                                <i class="fas fa-eye"></i> Lihat
                            </button>

                            <button type="button"
                                    class="btn-aksi btn-edit"
                                    data-id="${row.id}">
                                <i class="fas fa-edit"></i> Edit
                            </button>

                            <button type="button"
                                class="btn-aksi btn-hapus"
                                data-id="${row.id}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    `;
                }
            }
        ],

        order: [],

        language: {
            search: '',
            searchPlaceholder: 'Cari frekuensi...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Menampilkan 0 sampai 0 dari 0 data',
            emptyTable: 'Belum ada data frekuensi',
            zeroRecords: 'Data frekuensi tidak ditemukan',
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

    /* LIHAT FREKUENSI */
    $('#frekuensi-table').on('click', '.btn-lihat', function () {
        const id = $(this).data('id');
        const row = table.row($(this).closest('tr')).data();

        if (!row) return;

        $('#lihatKode').text(row.kode ?? '-');
        $('#lihatNama').text(row.nama ?? '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihatFrekuensi')
        ).show();
    });

    /* EDIT FREKUENSI */
    $('#frekuensi-table').on('click', '.btn-edit', function () {
        const row = table.row($(this).closest('tr')).data();

        if (!row) return;

        $('#editKode').val(row.kode ?? '');
        $('#editNama').val(row.nama ?? '');

        const baseUrl = @json(url('/master-frekuensi'));

        $('#formEditFrekuensi').attr(
            'action',
            baseUrl + '/' + row.id
        );

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEditFrekuensi')
        ).show();
    });



// =====================================
// HAPUS FREKUENSI - AJAX
// =====================================

$('#frekuensi-table').on('click', '.btn-hapus', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const id = $(this).attr('data-id');

    if (!id) {
        console.error('ID frekuensi tidak ditemukan.');
        return;
    }

    const baseUrl = @json(url('/master-frekuensi'));

    Swal.fire({
        title: 'Hapus data?',
        text: 'Data frekuensi yang dihapus tidak dapat dikembalikan.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal'
    }).then(function (result) {

        if (!result.isConfirmed) return;

        $.ajax({
            url: baseUrl + '/' + encodeURIComponent(id),
            method: 'DELETE',
            data: {
                _token: @json(csrf_token())
            },
            dataType: 'json',

            success: function (response) {
                table.ajax.reload(null, false);

                Swal.fire(
                    'Berhasil!',
                    response.message || 'Data berhasil dihapus.',
                    'success'
                );
            },

            error: function (xhr) {
                console.error('Hapus frekuensi gagal:', xhr.status, xhr.responseText);

                Swal.fire(
                    'Gagal!',
                    xhr.responseJSON?.message || 'Data gagal dihapus. Periksa Console dan Network.',
                    'error'
                );
            }
        });
    });
});


// =====================================
// TAMBAH DATA FREKUENSI
// =====================================
$('#formTambahFrekuensi').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const tombol = form.find('button[type="submit"]');

    tombol.prop('disabled', true);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),

        success: function (response) {
            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('modalTambahFrekuensi')
            ).hide();

            form[0].reset();
            table.ajax.reload(null, false);

            Swal.fire('Berhasil!', response.message, 'success');
        },

        error: function (xhr) {
            let pesan = 'Gagal menyimpan data frekuensi.';

            if (xhr.responseJSON?.message) {
                pesan = xhr.responseJSON.message;
            }

            Swal.fire('Gagal!', pesan, 'error');
        },

        complete: function () {
            tombol.prop('disabled', false);
        }
    });
});


// =====================================
// EDIT DATA FREKUENSI
// =====================================
$('#formEditFrekuensi').on('submit', function (e) {
    e.preventDefault();

    const form = $(this);
    const tombol = form.find('button[type="submit"]');

    tombol.prop('disabled', true);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),

        success: function (response) {
            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('modalEditFrekuensi')
            ).hide();

            table.ajax.reload(null, false);

            Swal.fire('Berhasil!', response.message, 'success');
        },

        error: function (xhr) {
            let pesan = 'Gagal memperbarui data frekuensi.';

            if (xhr.responseJSON?.message) {
                pesan = xhr.responseJSON.message;
            }

            Swal.fire('Gagal!', pesan, 'error');
        },

        complete: function () {
            tombol.prop('disabled', false);
        }
    });
});


    /* BUKA MODAL TAMBAH JIKA VALIDASI GAGAL */
    @if($errors->any())
        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalTambahFrekuensi')
        ).show();
    @endif

});
</script>

@endsection