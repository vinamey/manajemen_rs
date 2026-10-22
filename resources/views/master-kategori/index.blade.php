@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Kategori')

@section('content')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

    <style>
        .master-kategori-page {
            background: #f4f6fa;
            min-height: calc(100vh - 70px);
            padding: 20px 18px;
            --blue: #1877f2;
            --dark: #0f58c6;
        }

        .kategori-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 17px
        }

        .kategori-title-wrapper {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .kategori-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: #e7f3ff;
            color: #1877f2;
            display: flex;
            align-items: center;
            justify-content: center
        }

        .kategori-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #1f2937
        }

        .kategori-subtitle {
            margin: 4px 0 0;
            font-size: 12px;
            color: #6b7280
        }

        .btn-tambah-kategori {
            background: #1877f2;
            color: white;
            border: 0;
            padding: 10px 14px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: 600
        }

        .btn-tambah-kategori:hover,
        .btn-simpan-kategori:hover {
            background: #0f58c6;
            color: white
        }

        .kategori-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px #0000000d
        }

        .kategori-table-wrapper {
            width: 100%;
            overflow-x: auto
        }

        .kategori-table {
            width: 100% !important;
            margin: 0 !important
        }

        .kategori-table thead th {
            background: #1877f2 !important;
            color: white !important;
            font-size: 12px;
            padding: 13px 12px !important;
            border: 0 !important;
            white-space: nowrap
        }

        .kategori-table tbody td {
            padding: 12px !important;
            font-size: 12px;
            color: #64748b;
            border-bottom: 1px solid #edf0f4 !important;
            vertical-align: middle;
            background: white
        }

        #kategori-table.dataTable thead th:before,
        #kategori-table.dataTable thead th:after {
            display: none !important
        }

        #kategori-table.dataTable thead th {
            background-image: none !important
        }

        .kode-kategori-badge,
        .nama-kategori-badge {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 600
        }

        .kode-kategori-badge {
            background: #e7f3ff;
            color: #1877f2
        }

        .nama-kategori-badge {
            background: #fff1e6;
            color: #e67e22
        }

        .aksi-wrapper {
            display: flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
            white-space: nowrap
        }

        .btn-aksi-kategori {
            border: 0;
            border-radius: 5px;
            padding: 7px 10px;
            font-size: 11px;
            cursor: pointer
        }

        .btn-lihat-kategori {
            background: #e7f3ff;
            color: #1877f2
        }

        .btn-edit-kategori {
            background: #1877f2;
            color: white
        }

        .btn-hapus-kategori {
            background: #ffeded;
            color: #ef4444
        }

        .dataTables_wrapper {
            font-size: 12px
        }

        .dataTables_wrapper .row:first-child,
        .dataTables_wrapper .row:last-child {
            padding: 12px;
            align-items: center
        }

        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label,
        .dataTables_wrapper .dataTables_info {
            font-size: 12px;
            color: #64748b
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            height: 34px;
            border: 1px solid #d4dce6;
            border-radius: 6px;
            padding: 5px 9px;
            font-size: 12px
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 190px
        }

        .dataTables_wrapper .page-link {
            font-size: 11px;
            box-shadow: none !important
        }

        .dataTables_wrapper .page-item.active .page-link {
            background: #1877f2;
            border-color: #1877f2
        }

        .modal-kategori-besar {
            max-width: 560px
        }

        .modal-kategori-besar .modal-content {
            border: 0;
            border-radius: 12px;
            overflow: visible;
            box-shadow: 0 15px 35px #00000024
        }

        .modal-kategori-besar .modal-header {
            background: #1877f2;
            color: white;
            border: 0;
            padding: 16px 20px;
            border-radius: 12px 12px 0 0
        }

        .modal-kategori-besar .modal-title {
            font-size: 15px;
            font-weight: 600
        }

        .modal-kategori-besar .modal-body {
            padding: 24px
        }

        .modal-kategori-besar .modal-footer {
            background: #f8fafc;
            border: 0;
            padding: 14px 20px;
            border-radius: 0 0 12px 12px
        }

        .form-kategori-group {
            margin-bottom: 18px
        }

        .form-kategori-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #526071;
            margin-bottom: 8px
        }

        .form-kategori-control {
            display: block;
            width: 100%;
            height: 40px;
            border: 1px solid #d4dce6;
            border-radius: 7px;
            padding: 8px 11px;
            font-size: 13px;
            color: #374151;
            background: white;
            outline: none
        }

        .form-kategori-control:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 3px #1877f21a
        }

        .detail-kategori-value {
            width: 100%;
            min-height: 40px;
            border: 1px solid #e1e7ef;
            border-radius: 7px;
            padding: 10px 11px;
            font-size: 13px;
            background: #f8fafc;
            color: #374151
        }

        .btn-batal-kategori,
        .btn-simpan-kategori,
        .btn-konfirmasi-hapus {
            border: 0;
            border-radius: 6px;
            padding: 9px 14px;
            font-size: 12px
        }

        .btn-batal-kategori {
            background: #f1f5f9;
            color: #526071
        }

        .btn-simpan-kategori {
            background: #1877f2;
            color: white;
            font-weight: 600
        }

        .btn-konfirmasi-hapus {
            background: #ef4444;
            color: white;
            font-weight: 600
        }

        .form-kategori-select2 {
            width: 100%
        }

        .select2-container {
            width: 100% !important
        }

        .select2-container--default .select2-selection--single {
            width: 100% !important;
            height: 40px !important;
            border: 1px solid #d4dce6 !important;
            border-radius: 7px !important;
            background: #fff !important;
            display: flex !important;
            align-items: center !important;
            box-sizing: border-box !important
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            width: 100%;
            line-height: 38px !important;
            padding-left: 11px !important;
            padding-right: 32px !important;
            font-size: 13px !important;
            color: #374151 !important
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6b7280 !important
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
            right: 7px !important
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            margin-right: 8px
        }

        .select2-dropdown {
            border: 1px solid #d4dce6 !important;
            border-radius: 7px !important;
            overflow: hidden
        }

        .select2-search--dropdown {
            padding: 8px !important
        }

        .select2-search--dropdown .select2-search__field {
            height: 35px !important;
            border: 1px solid #d4dce6 !important;
            border-radius: 5px !important;
            padding: 6px 9px !important;
            outline: none
        }

        .select2-results__option {
            font-size: 13px !important;
            padding: 9px 11px !important
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: #1877f2 !important;
            color: white !important
        }

        .select2-container--default .select2-results__option--selected {
            background: #e7f3ff;
            color: #1877f2
        }

        .delete-icon {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #fee2e2;
            color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 22px
        }

        .delete-text {
            text-align: center;
            font-size: 13px;
            color: #374151
        }

        @media(max-width:576px) {
            .master-kategori-page {
                padding: 12px 8px
            }

            .kategori-title {
                font-size: 15px
            }

            .kategori-subtitle {
                font-size: 10px
            }

            .btn-tambah-kategori {
                font-size: 10px;
                padding: 8px
            }
        }
    </style>

    @php
        $daftarKategori = [
            'Antibiotik',
            'Analgesik',
            'Antipiretik',
            'Antihistamin',
            'Antiseptik',
            'Vitamin dan Suplemen',
            'Obat Batuk dan Pilek',
            'Obat Lambung',
            'Obat Kulit',
            'Obat Mata',
        ];
    @endphp

    <div class="master-kategori-page">
        <div class="kategori-header">
            <div class="kategori-title-wrapper">
                <div class="kategori-icon"><i class="fas fa-tags"></i></div>
                <div>
                    <h2 class="kategori-title">Master Kategori</h2>
                    <p class="kategori-subtitle">Data kategori yang terdaftar</p>
                </div>
            </div>

            <button type="button" class="btn-tambah-kategori" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                <i class="fas fa-plus"></i> Tambah Kategori
            </button>
        </div>

        <div class="kategori-card">
            <div class="kategori-table-wrapper">
                <table id="kategori-table" class="kategori-table table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:70px">No</th>
                            <th style="width:180px">Kode Kategori</th>
                            <th>Nama Kategori</th>
                            <th class="text-center" style="width:220px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-kategori-besar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-tags"></i> Tambah Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form id="formTambahKategori" action="{{ route('master-kategori.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-kategori-group">
                            <label for="tambahKode" class="form-kategori-label">Kode Kategori</label>
                            <input type="text" name="kode" id="tambahKode" class="form-kategori-control"
                                placeholder="Masukkan kode kategori" required>
                        </div>

                        <div class="form-kategori-group">
                            <label for="namaKategori" class="form-kategori-label">Nama Kategori</label>
                            <select name="nama" id="namaKategori" class="form-kategori-control form-kategori-select2"
                                required>
                                <option value=""></option>
                                @foreach ($daftarKategori as $namaKategori)
                                    <option value="{{ $namaKategori }}">{{ $namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-batal-kategori" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnSimpanKategori" class="btn-simpan-kategori">
                            <i class="fas fa-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL LIHAT --}}
    <div class="modal fade" id="modalLihatKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-kategori-besar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-eye"></i> Detail Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-kategori-group">
                        <label class="form-kategori-label">Kode Kategori</label>
                        <div id="lihatKode" class="detail-kategori-value">-</div>
                    </div>
                    <div class="form-kategori-group">
                        <label class="form-kategori-label">Nama Kategori</label>
                        <div id="lihatNama" class="detail-kategori-value">-</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-batal-kategori" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-kategori-besar">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEditKategori" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-kategori-group">
                            <label for="editKode" class="form-kategori-label">Kode Kategori</label>
                            <input type="text" name="kode" id="editKode" class="form-kategori-control" required>
                        </div>
                        <div class="form-kategori-group">
                            <label for="editNama" class="form-kategori-label">Nama Kategori</label>
                            <select name="nama" id="editNama" class="form-kategori-control form-kategori-select2"
                                required>
                                <option value=""></option>
                                @foreach ($daftarKategori as $namaKategori)
                                    <option value="{{ $namaKategori }}">{{ $namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-batal-kategori" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnUpdateKategori" class="btn-simpan-kategori">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal fade" id="modalHapusKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header" style="background:#ef4444;color:white;border:0">
                    <h5 class="modal-title" style="font-size:14px">
                        <i class="fas fa-trash"></i> Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="delete-icon"><i class="fas fa-exclamation-triangle"></i></div>
                    <p class="delete-text">
                        Apakah kamu yakin ingin menghapus kategori
                        <strong id="hapusNamaKategori">-</strong>?
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn-batal-kategori" data-bs-dismiss="modal">Batal</button>
                    <button type="button" id="btnProsesHapus" class="btn-konfirmasi-hapus">
                        <i class="fas fa-trash"></i> Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(function () {
    const csrfToken = @json(csrf_token());
    const baseUrl = @json(url('/master-kategori'));

    // Select2
    $('#namaKategori, #editNama').select2({
        placeholder: 'Cari / Pilih Kategori',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#namaKategori').closest('.modal')
    });

    // DataTable
    const table = $('#kategori-table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: @json(route('master-kategori.data')),
        pageLength: 10,
        columns: [
            {
                data: 'DT_RowIndex',
                searchable: false,
                orderable: false,
                className: 'text-center'
            },
            {
                data: 'kode',
                orderable: false,
                render: function (data) {
                    return $('<span>')
                        .addClass('kode-kategori-badge')
                        .text(data || '-')
                        .prop('outerHTML');
                }
            },
            {
                data: 'nama',
                orderable: false,
                render: function (data) {
                    return $('<span>')
                        .addClass('nama-kategori-badge')
                        .text(data || '-')
                        .prop('outerHTML');
                }
            },
            {
                data: 'aksi',
                searchable: false,
                orderable: false,
                className: 'text-center'
            }
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari kategori...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Belum ada data',
            emptyTable: 'Belum ada data kategori',
            zeroRecords: 'Data tidak ditemukan',
            processing: 'Memuat data...',
            paginate: {
                first: 'Awal',
                last: 'Akhir',
                next: 'Lanjut',
                previous: 'Kembali'
            }
        }
    });

    function tampilkanError(xhr, defaultMessage) {
        let pesan = xhr.responseJSON?.message || defaultMessage;

        if (xhr.responseJSON?.errors) {
            pesan = Object.values(xhr.responseJSON.errors).flat().join('\n');
        }

        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: pesan,
            confirmButtonColor: '#1877f2'
        });
    }

    // TAMBAH KATEGORI
    $('#formTambahKategori').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const tombol = $('#btnSimpanKategori');

        if (tombol.prop('disabled')) return;

        tombol.prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: form.action,
            type: 'POST',
            data: $(form).serialize(),
            dataType: 'json',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                if (response.success !== true) {
                    Swal.fire('Gagal', response.message || 'Data gagal disimpan.', 'error');
                    return;
                }

                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById('modalTambahKategori')
                ).hide();

                form.reset();
                $('#namaKategori').val(null).trigger('change');

                table.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Kategori berhasil ditambahkan.',
                    confirmButtonColor: '#1877f2'
                });
            },
            error: function (xhr) {
                tampilkanError(xhr, 'Gagal menyimpan kategori.');
            },
            complete: function () {
                tombol.prop('disabled', false)
                    .html('<i class="fas fa-save"></i> Simpan Data');
            }
        });
    });

    // LIHAT KATEGORI
    $('#kategori-table').on('click', '.btn-lihat-kategori', function () {
        const data = table.row($(this).closest('tr')).data();
        if (!data) return;

        $('#lihatKode').text(data.kode || '-');
        $('#lihatNama').text(data.nama || '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihatKategori')
        ).show();
    });

    // EDIT KATEGORI
    $('#kategori-table').on('click', '.btn-edit-kategori', function () {
        const data = table.row($(this).closest('tr')).data();
        if (!data) return;

        $('#editKode').val(data.kode || '');
        $('#editNama').val(data.nama || '').trigger('change');
        $('#formEditKategori').attr('action', baseUrl + '/' + data.id);

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEditKategori')
        ).show();
    });

    // UPDATE KATEGORI
    $('#formEditKategori').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const tombol = $('#btnUpdateKategori');

        if (tombol.prop('disabled')) return;

        tombol.prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: form.action,
            type: 'POST',
            data: $(form).serialize(),
            dataType: 'json',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                if (response.success !== true) {
                    Swal.fire('Gagal', response.message || 'Data gagal diperbarui.', 'error');
                    return;
                }

                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById('modalEditKategori')
                ).hide();

                table.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Kategori berhasil diperbarui.',
                    confirmButtonColor: '#1877f2'
                });
            },
            error: function (xhr) {
                tampilkanError(xhr, 'Gagal memperbarui kategori.');
            },
            complete: function () {
                tombol.prop('disabled', false)
                    .html('<i class="fas fa-save"></i> Simpan Perubahan');
            }
        });
    });

    // PILIH KATEGORI UNTUK DIHAPUS
    let deleteTargetUrl = '';

    $('#kategori-table').on('click', '.btn-hapus-kategori', function () {
        const data = table.row($(this).closest('tr')).data();
        if (!data) return;

        deleteTargetUrl = $(this).data('url') || (baseUrl + '/' + data.id);
        $('#hapusNamaKategori').text(data.nama || '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalHapusKategori')
        ).show();
    });

    // HAPUS KATEGORI
    $('#btnProsesHapus').on('click', function () {
        if (!deleteTargetUrl) return;

        const tombol = $(this);
        if (tombol.prop('disabled')) return;

        tombol.prop('disabled', true)
            .html('<i class="fas fa-spinner fa-spin"></i> Menghapus...');

        $.ajax({
            url: deleteTargetUrl,
            type: 'POST',
            data: {
                _token: csrfToken,
                _method: 'DELETE'
            },
            dataType: 'json',
            headers: {
                'Accept': 'application/json'
            },
            success: function (response) {
                if (response.success !== true) {
                    Swal.fire('Gagal', response.message || 'Data gagal dihapus.', 'error');
                    return;
                }

                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById('modalHapusKategori')
                ).hide();

                deleteTargetUrl = '';
                table.ajax.reload(null, false);

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message || 'Kategori berhasil dihapus.',
                    confirmButtonColor: '#1877f2'
                });
            },
            error: function (xhr) {
                tampilkanError(xhr, 'Gagal menghapus kategori.');
            },
            complete: function () {
                tombol.prop('disabled', false)
                    .html('<i class="fas fa-trash"></i> Ya, Hapus');
            }
        });
    });

    // RESET FORM TAMBAH
    $('#modalTambahKategori').on('hidden.bs.modal', function () {
        $('#formTambahKategori')[0].reset();
        $('#namaKategori').val(null).trigger('change');
    });
});
</script>

@endpush