<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Dokter - Admin Rumah Sakit</title>

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
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            color: white;
            padding: 18px 28px;
            box-shadow: 0 4px 15px rgba(24,119,242,.18);
        }

        .topbar-inner {
            max-width: 1400px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,.18);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .brand h4 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
        }

        .main-container {
            max-width: 1400px;
            margin: 30px auto;
            padding: 0 22px;
        }

        .page-heading {
            margin-bottom: 22px;
        }

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
            background: white;
            border: 1px solid #e9eef5;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(25,50,90,.035);
        }

        .content-title {
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .content-subtitle {
            color: #7a879a;
            font-size: 13px;
            margin-bottom: 22px;
        }

        .btn-tambah {
            background: #1877f2;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 16px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-tambah:hover {
            background: #0f58c6;
            color: white;
        }

        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background: #1877f2 !important;
            color: white !important;
            border-bottom: none !important;
            padding: 14px 12px !important;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 13px 12px;
            vertical-align: middle;
        }

        table.dataTable tbody tr:hover {
            background: #f3f8ff;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-action {
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 7px;
            color: white;
            cursor: pointer;
        }

        .btn-view { background: #0dcaf0; }
        .btn-view:hover { background: #0aa8c7; }

        .btn-edit { background: #ffc107; color: #263238; }
        .btn-edit:hover { background: #e0a800; color: #263238; }

        .btn-delete { background: #dc3545; }
        .btn-delete:hover { background: #bb2d3b; }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            font-size: 13px;
            color: #59677b;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 7px;
            padding: 7px 10px;
            outline: none;
            background: white;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 2px rgba(24,119,242,.1);
        }

        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: #1877f2;
            color: white;
            padding: 18px 22px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body { padding: 24px; }

        .modal-footer {
            padding: 15px 24px;
            border-top: 1px solid #edf0f5;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #39475b;
        }

        .form-control,
        .form-select {
            border: 1px solid #dce3ed;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 3px rgba(24,119,242,.1);
        }

        .detail-value {
            min-height: 42px;
            padding: 11px 12px;
            border: 1px solid #dce3ed;
            border-radius: 8px;
            background: #f8fafc;
            overflow-wrap: anywhere;
        }

        .btn-simpan {
            background: #1877f2;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
        }

        .btn-simpan:hover {
            background: #0f58c6;
            color: white;
        }

        .btn-batal {
            background: #e9eef5;
            color: #39475b;
            border: none;
            border-radius: 8px;
            padding: 10px 18px;
        }

        .btn-batal:hover {
            background: #dce3ed;
        }

        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 12px;
            padding: 25px 0;
        }

        @media (max-width: 768px) {
            .topbar { padding: 15px; }
            .main-container { margin-top: 20px; padding: 0 12px; }
            .content-card { padding: 15px; }
            .page-heading h2 { font-size: 21px; }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="topbar-inner">
        <div class="brand">
           

        </div>
    </div>
</header>

<main class="main-container">

    <div class="page-heading">
        <h2>Data Dokter</h2>
        <p>Informasi dokter yang terdaftar di rumah sakit.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data belum berhasil disimpan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-2">
            <div class="content-title mb-0">
                <i class="fa-solid fa-user-doctor me-2" style="color:#1877f2"></i>
                Daftar Dokter
            </div>

            <button type="button" class="btn-tambah" data-bs-toggle="modal"
                    data-bs-target="#modalTambahDokter">
                <i class="fa-solid fa-plus me-1"></i> Tambah Dokter
            </button>
        </div>

        <div class="content-subtitle mt-2">
            Daftar informasi dokter yang sudah terdaftar dalam sistem rumah sakit.
        </div>

        <div class="table-responsive">
            <table id="tabelDokter" class="table table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th width="55">No.</th>
                        <th>Nama Dokter</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Spesialis</th>
                        <th>Poli</th>
                        <th width="135" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

    </div>

    <div class="footer-text">
        SIM RS &copy; {{ date('Y') }} — Admin Rumah Sakit
    </div>

</main>

{{-- MODAL TAMBAH DOKTER --}}
<div class="modal fade" id="modalTambahDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.dokter.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-user-plus me-2"></i> Tambah Dokter
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control"
                                   maxlength="255" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Spesialis</label>
                            <input type="text" name="spesialis" class="form-control"
                                   maxlength="255" placeholder="Contoh: Spesialis Anak">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Poli <span class="text-danger">*</span></label>
                            <select name="poli_id" class="form-select" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">
                                        {{ $poli->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"
                                      placeholder="Masukkan alamat dokter"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL EDIT DOKTER --}}
<div class="modal fade" id="modalEditDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <form id="formEditDokter" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-user-pen me-2"></i> Edit Dokter
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                            <input type="text" id="editNama" name="nama" class="form-control"
                                   maxlength="255" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select id="editJenisKelamin" name="jenis_kelamin"
                                    class="form-select" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" id="editTanggalLahir" name="tanggal_lahir"
                                   class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Spesialis</label>
                            <input type="text" id="editSpesialis" name="spesialis"
                                   class="form-control" maxlength="255">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Poli <span class="text-danger">*</span></label>
                            <select id="editPoli" name="poli_id" class="form-select" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach($polis as $poli)
                                    <option value="{{ $poli->id }}">
                                        {{ $poli->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea id="editAlamat" name="alamat" class="form-control"
                                      rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-batal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-simpan">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL DETAIL DOKTER --}}
<div class="modal fade" id="modalLihatDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa-solid fa-user-doctor me-2"></i> Detail Dokter
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Dokter</label>
                        <div id="lihatNamaDokter" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div id="lihatJenisKelaminDokter" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div id="lihatTanggalLahirDokter" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Spesialis</label>
                        <div id="lihatSpesialisDokter" class="detail-value">-</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Poli</label>
                        <div id="lihatPoliDokter" class="detail-value">-</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <div id="lihatAlamatDokter" class="detail-value"
                             style="min-height:70px; white-space:pre-wrap;">-</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-batal" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

{{-- FORM HAPUS DOKTER --}}
<form id="formHapusDokter" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    const tabel = $('#tabelDokter').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,

        ajax: {
            url: "{{ route('admin.dokter.data') }}",
            type: 'GET',
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Data dokter gagal dimuat. Periksa method dataAdmin() pada controller.');
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
                data: 'spesialis',
                name: 'spesialis',
                defaultContent: '-'
            },
            {
                data: 'poli_nama',
                name: 'poli_nama',
                defaultContent: '-'
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
                            <button type="button" class="btn-action btn-view"
                                title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>

                            <button type="button" class="btn-action btn-edit"
                                title="Edit Dokter">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button type="button" class="btn-action btn-delete"
                                title="Hapus Dokter">
                                <i class="fa-solid fa-trash"></i>
                            </button>
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
            emptyTable: 'Belum ada data dokter',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Berikutnya',
                previous: 'Sebelumnya'
            }
        }
    });

    function formatJenisKelamin(value) {
        if (value === 'laki-laki' || value === 'laki_laki') {
            return 'Laki-laki';
        }

        if (value === 'perempuan') {
            return 'Perempuan';
        }

        return value || '-';
    }

    // LIHAT DETAIL
    $('#tabelDokter').on('click', '.btn-view', function () {
        const row = tabel.row($(this).closest('tr')).data();

        if (!row) return;

        $('#lihatNamaDokter').text(row.nama || '-');
        $('#lihatJenisKelaminDokter').text(
            formatJenisKelamin(row.jenis_kelamin_raw || row.jenis_kelamin)
        );
        $('#lihatTanggalLahirDokter').text(
            row.tanggal_lahir_raw || row.tanggal_lahir || '-'
        );
        $('#lihatSpesialisDokter').text(row.spesialis_raw || row.spesialis || '-');
        $('#lihatPoliDokter').text(row.poli_nama || '-');
        $('#lihatAlamatDokter').text(row.alamat_raw || row.alamat || '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihatDokter')
        ).show();
    });

    // EDIT DOKTER
    $('#tabelDokter').on('click', '.btn-edit', function () {
        const row = tabel.row($(this).closest('tr')).data();

        if (!row || !row.id) {
            alert('ID dokter tidak ditemukan.');
            return;
        }

        $('#editNama').val(row.nama || '');
        $('#editJenisKelamin').val(
            row.jenis_kelamin_raw || row.jenis_kelamin || ''
        );
        $('#editTanggalLahir').val(
            row.tanggal_lahir_raw || ''
        );
        $('#editSpesialis').val(
            row.spesialis_raw || row.spesialis || ''
        );
        $('#editPoli').val(row.poli_id_raw || row.poli_id || '');
        $('#editAlamat').val(row.alamat_raw || row.alamat || '');

        const urlUpdate = "{{ url('/admin/data-dokter') }}/" + encodeURIComponent(row.id);
        $('#formEditDokter').attr('action', urlUpdate);

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEditDokter')
        ).show();
    });

    // HAPUS DOKTER
    $('#tabelDokter').on('click', '.btn-delete', function () {
        const row = tabel.row($(this).closest('tr')).data();

        if (!row || !row.id) {
            alert('ID dokter tidak ditemukan.');
            return;
        }

        const namaDokter = row.nama || 'dokter ini';

        if (confirm('Apakah kamu yakin ingin menghapus data ' + namaDokter + '?')) {
            const urlHapus = "{{ url('/admin/data-dokter') }}/" + encodeURIComponent(row.id);
            $('#formHapusDokter').attr('action', urlHapus);
            $('#formHapusDokter').trigger('submit');
        }
    });

});
</script>

</body>
</html>
