
@extends('layouts.superadmin')

@section('page-title', 'Data Perawat - Admin Rumah Sakit')
@section('navbar-title', 'Data Perawat')

@push('styles')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    .perawat-page {
        color: #243247;
        font-family: Arial, sans-serif;
    }

    .perawat-page .main-container {
        max-width: 1400px;
        margin: 22px auto 0;
        padding: 0 22px;
    }

    .perawat-page .page-heading {
        margin-bottom: 18px;
    }

    .perawat-page .page-heading h2 {
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 7px;
    }

    .perawat-page .page-heading p {
        margin: 0;
        color: #7a879a;
        font-size: 14px;
    }

    .perawat-page .content-card {
        background: #fff;
        border: 1px solid #e9eef5;
        border-radius: 14px;
        padding: 18px;
        box-shadow: 0 4px 15px rgba(25, 50, 90, .035);
    }

    .perawat-page .content-title {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    .perawat-page .content-subtitle {
        color: #7a879a;
        font-size: 12px;
        margin: 6px 0 18px;
    }

    .perawat-page table.dataTable {
        width: 100% !important;
        border-collapse: collapse !important;
    }

    .perawat-page table.dataTable thead th {
        background: #1877f2 !important;
        color: #fff !important;
        border-bottom: none !important;
        padding: 12px 10px !important;
        font-size: 12px;
        white-space: nowrap;
        vertical-align: middle;
    }

    .perawat-page table.dataTable tbody td {
        padding: 12px 10px;
        vertical-align: middle;
        font-size: 12px;
    }

    .perawat-page table.dataTable tbody tr:hover {
        background: #f3f8ff;
    }

    .perawat-page #tabelPerawat th:last-child,
    .perawat-page #tabelPerawat td:last-child {
        width: 125px !important;
        min-width: 125px !important;
        max-width: 125px !important;
        text-align: center !important;
        white-space: nowrap !important;
    }

    .perawat-page .aksi-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        flex-wrap: nowrap;
        white-space: nowrap;
        width: 100%;
    }

    .perawat-page .aksi-wrapper .btn-view,
    .perawat-page .aksi-wrapper .btn-edit,
    .perawat-page .aksi-wrapper .btn-delete {
        width: 30px;
        height: 30px;
        min-width: 30px;
        padding: 0;
        margin: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        cursor: pointer;
        transition: .2s;
    }

    .perawat-page .aksi-wrapper .btn-view {
        background: #0dcaf0;
        color: #fff;
    }

    .perawat-page .aksi-wrapper .btn-view:hover {
        background: #0aa8c7;
        color: #fff;
    }

    .perawat-page .aksi-wrapper .btn-edit {
        background: #ffc107;
        color: #212529;
    }

    .perawat-page .aksi-wrapper .btn-edit:hover {
        background: #e0a800;
        color: #212529;
    }

    .perawat-page .aksi-wrapper .btn-delete {
        background: #dc3545;
        color: #fff;
    }

    .perawat-page .aksi-wrapper .btn-delete:hover {
        background: #bb2d3b;
        color: #fff;
    }

    .perawat-page .aksi-wrapper form {
        display: inline-flex;
        margin: 0;
        padding: 0;
    }

    .perawat-page .dataTables_wrapper {
        font-size: 12px;
        color: #59677b;
    }

    .perawat-page .dataTables_wrapper .dataTables_filter input,
    .perawat-page .dataTables_wrapper .dataTables_length select {
        border: 1px solid #dce3ed;
        border-radius: 7px;
        padding: 6px 9px;
        outline: none;
        background: #fff;
        font-size: 12px;
    }

    .perawat-page .dataTables_wrapper .dataTables_filter input:focus,
    .perawat-page .dataTables_wrapper .dataTables_length select:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 2px rgba(24, 119, 242, .1);
    }

    .perawat-page .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px !important;
        margin: 0 2px;
    }

    .perawat-page .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #1877f2 !important;
        color: #fff !important;
        border: 1px solid #1877f2 !important;
    }

    .perawat-page .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }

    .perawat-page .modal-header {
        background: #1877f2;
        color: #fff;
        padding: 17px 22px;
    }

    .perawat-page .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .perawat-page .modal-body {
        padding: 22px;
    }

    .perawat-page .modal-footer {
        padding: 14px 22px;
        border-top: 1px solid #edf0f5;
    }

    .perawat-page .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #39475b;
    }

    .perawat-page .detail-value {
        min-height: 40px;
        padding: 10px 12px;
        border: 1px solid #dce3ed;
        border-radius: 8px;
        background: #f8fafc;
        overflow-wrap: anywhere;
        font-size: 13px;
    }

    .perawat-page .btn-close-modal {
        background: #1877f2;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 9px 18px;
    }

    .perawat-page .btn-close-modal:hover {
        background: #0f58c6;
        color: #fff;
    }

    .perawat-page .btn-dashboard {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #1877f2;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s ease;
    }

    .perawat-page .btn-dashboard:hover {
        background: #0f58c6;
        color: white;
        transform: translateY(-1px);
    }

    .perawat-page .footer-text {
        text-align: center;
        color: #8a95a7;
        font-size: 10px;
        padding: 20px 0;
    }

    @media (max-width: 768px) {
        .perawat-page .main-container {
            margin-top: 20px;
            padding: 0 12px;
        }

        .perawat-page .content-card {
            padding: 14px;
        }

        .perawat-page .page-heading h2 {
            font-size: 21px;
        }
    }
</style>
@endpush

@section('content')

<div class="perawat-page">

    <main class="main-container">

        <!-- HEADER HALAMAN -->
        <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Data Perawat</h2>
                <p>Informasi perawat yang terdaftar di rumah sakit.</p>
            </div>
        </div>

        <!-- NOTIFIKASI -->
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

        <!-- CARD DATA PERAWAT -->
        <div class="content-card">

            <div class="d-flex justify-content-between align-items-center gap-2 mb-2">

                <div class="content-title">
                    <i class="fa-solid fa-user-nurse me-2" style="color:#1877f2"></i>
                    Daftar Perawat
                </div>

                <button type="button"
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                    <i class="fa-solid fa-plus me-1"></i>
                    Tambah Perawat
                </button>

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
                            <th width="125" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

        <!-- FOOTER -->
        <div class="footer-text">
            SIM RS &copy; {{ date('Y') }} — Admin Rumah Sakit
        </div>

    </main>

    <!-- MODAL DETAIL PERAWAT -->
    <div class="modal fade" id="modalLihat" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-user-nurse me-2"></i>
                        Detail Perawat
                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Tutup">
                    </button>
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
                        <div id="lihatAlamat"
                             class="detail-value"
                             style="min-height:70px; white-space:pre-wrap;">-</div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn-close-modal"
                            data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH PERAWAT -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form action="{{ route('admin.perawat.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa-solid fa-user-plus me-2"></i>
                            Tambah Perawat
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Tutup">
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Perawat</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ old('nama') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                   name="tanggal_lahir"
                                   class="form-control"
                                   value="{{ old('tanggal_lahir') }}"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"
                                      required>{{ old('alamat') }}</textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-1"></i>
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- MODAL EDIT PERAWAT -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form id="formEditPerawat" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa-solid fa-pen-to-square me-2"></i>
                            Edit Data Perawat
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Tutup">
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama Perawat</label>
                            <input type="text"
                                   name="nama"
                                   id="editNama"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                    id="editJenisKelamin"
                                    class="form-select"
                                    required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date"
                                   name="tanggal_lahir"
                                   id="editTanggalLahir"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat"
                                      id="editAlamat"
                                      class="form-control"
                                      rows="3"
                                      required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-light"
                                data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    // DATATABLE PERAWAT
    const tabel = $('#tabelPerawat').DataTable({

        processing: true,
        serverSide: true,
        autoWidth: false,

        ajax: {
            url: "{{ route('admin.perawat.data') }}",
            type: 'GET',

            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Data perawat gagal dimuat. Periksa route dan controller.');
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
                defaultContent: '-',

                render: function (data) {

                    if (!data) return '-';

                    const value = String(data).toLowerCase();

                    if (value === 'laki-laki' || value === 'laki_laki') {
                        return 'Laki-laki';
                    }

                    if (value === 'perempuan') {
                        return 'Perempuan';
                    }

                    return data;
                }
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
                width: '125px',

                render: function (data, type, row) {

                    return `
                        <div class="aksi-wrapper">

                            <button type="button"
                                    class="btn-view"
                                    title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button type="button"
                                    class="btn-edit"
                                    title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <form action="{{ url('/admin/data-perawat') }}/${row.id}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data perawat ini?')">

                                <input type="hidden"
                                       name="_token"
                                       value="{{ csrf_token() }}">

                                <input type="hidden"
                                       name="_method"
                                       value="DELETE">

                                <button type="submit"
                                        class="btn-delete"
                                        title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                            </form>

                        </div>
                    `;
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

    // TOMBOL LIHAT DETAIL
    $('#tabelPerawat').on('click', '.btn-view', function () {

        const row = tabel.row($(this).closest('tr')).data();

        if (!row) {
            return;
        }

        $('#lihatNama').text(row.nama || '-');

        const gender = row.jenis_kelamin_raw || row.jenis_kelamin || '';
        const genderLower = String(gender).toLowerCase();

        $('#lihatJenisKelamin').text(
            genderLower === 'laki-laki' || genderLower === 'laki_laki'
                ? 'Laki-laki'
                : genderLower === 'perempuan'
                    ? 'Perempuan'
                    : gender || '-'
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

    // TOMBOL EDIT PERAWAT
    $('#tabelPerawat').on('click', '.btn-edit', function () {

        const row = tabel.row($(this).closest('tr')).data();

        if (!row) {
            alert('Data perawat tidak ditemukan.');
            return;
        }

        if (!row.id) {
            alert('ID perawat tidak ditemukan. Periksa data dari controller.');
            console.error(row);
            return;
        }

        // Mengisi form edit dengan data perawat
        $('#editNama').val(row.nama || '');

        const gender = String(
            row.jenis_kelamin_raw || row.jenis_kelamin || ''
        ).toLowerCase();

        $('#editJenisKelamin').val(
            gender === 'laki_laki' ? 'laki-laki' : gender
        );

        $('#editTanggalLahir').val(
            row.tanggal_lahir_raw || ''
        );

        $('#editAlamat').val(
            row.alamat_raw || row.alamat || ''
        );

        // Mengatur URL update berdasarkan ID perawat
        const urlUpdate = "{{ url('/admin/data-perawat') }}/" + row.id;

        $('#formEditPerawat').attr('action', urlUpdate);

        // Menampilkan modal edit
        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEdit')
        ).show();

    });

});
</script>

@endpush
