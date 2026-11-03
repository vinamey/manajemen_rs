<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Data Pasien - Admin Rumah Sakit</title>

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
            height: 8px;
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            box-shadow: 0 4px 15px rgba(24,119,242,.18);
        }

        .main-container {
            max-width: 1400px;
            margin: 22px auto 0;
            padding: 0 22px;
        }

        .page-heading {
            margin-bottom: 18px;
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
            background: #fff;
            border: 1px solid #e9eef5;
            border-radius: 14px;
            padding: 18px;
            box-shadow: 0 4px 15px rgba(25,50,90,.035);
        }

        .content-title {
            font-size: 15px;
            font-weight: 700;
            margin: 0;
        }

        .content-subtitle {
            color: #7a879a;
            font-size: 12px;
            margin: 6px 0 18px;
        }

        .btn-tambah {
            background: #1877f2;
            color: #fff;
            border: none;
            border-radius: 7px;
            padding: 9px 13px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-dashboard {
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
            transition: 0.2s ease;
        }

        .btn-dashboard:hover {
            background: #0f58c6;
            color: white;
            transform: translateY(-1px);
        }

        .btn-tambah:hover {
            background: #0f58c6;
            color: #fff;
        }

        table.dataTable {
            width: 100% !important;
            border-collapse: collapse !important;
        }

        table.dataTable thead th {
            background: #1877f2 !important;
            color: #fff !important;
            border-bottom: none !important;
            padding: 12px 10px !important;
            font-size: 12px;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 12px 10px;
            vertical-align: middle;
            font-size: 12px;
        }

        table.dataTable tbody tr:hover {
            background: #f3f8ff;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-action {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
        }

        .btn-view { background: #0dcaf0; }
        .btn-edit { background: #ffc107; color: #263238; }
        .btn-delete { background: #dc3545; }

        .btn-view:hover { background: #0aa8c7; color: #fff; }
        .btn-edit:hover { background: #e0a800; color: #263238; }
        .btn-delete:hover { background: #bb2d3b; color: #fff; }

        .dataTables_wrapper {
            font-size: 12px;
            color: #59677b;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #dce3ed;
            border-radius: 7px;
            padding: 6px 9px;
            outline: none;
            background: #fff;
            font-size: 12px;
        }

        .dataTables_wrapper .dataTables_filter input:focus,
        .dataTables_wrapper .dataTables_length select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 2px rgba(24,119,242,.1);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 6px !important;
            margin: 0 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #1877f2 !important;
            color: #fff !important;
            border: 1px solid #1877f2 !important;
        }

        .modal-content {
            border: none;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: #1877f2;
            color: #fff;
            padding: 17px 22px;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .modal-body { padding: 22px; }

        .modal-footer {
            padding: 14px 22px;
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
            font-size: 13px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #1877f2;
            box-shadow: 0 0 0 3px rgba(24,119,242,.1);
        }

        .detail-value {
            min-height: 40px;
            padding: 10px 12px;
            border: 1px solid #dce3ed;
            border-radius: 8px;
            background: #f8fafc;
            overflow-wrap: anywhere;
            font-size: 13px;
        }

        .btn-simpan {
            background: #1877f2;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 16px;
        }

        .btn-simpan:hover {
            background: #0f58c6;
            color: #fff;
        }

        .btn-batal {
            background: #e9eef5;
            color: #39475b;
            border: none;
            border-radius: 8px;
            padding: 9px 16px;
        }

        .footer-text {
            text-align: center;
            color: #8a95a7;
            font-size: 10px;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .main-container {
                margin-top: 20px;
                padding: 0 12px;
            }

            .content-card { padding: 14px; }
            .page-heading h2 { font-size: 21px; }
        }
    </style>
</head>

<body>

<div class="topbar"></div>

<main class="main-container">

    <div class="page-heading d-flex justify-content-between align-items-center flex-wrap gap-3">

    <div>
        <h2>Data Pasien</h2>
        <p>Informasi pasien yang terdaftar di rumah sakit.</p>
    </div>

    <a href="{{ url('/admin/dashboard') }}" class="btn-dashboard">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Dashboard
    </a>

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

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="content-title">
                <i class="fa-solid fa-hospital-user me-2" style="color:#1877f2"></i>
                Daftar Pasien
            </div>

            <button type="button" class="btn-tambah"
                    data-bs-toggle="modal" data-bs-target="#modalTambahPasien">
                <i class="fa-solid fa-plus me-1"></i>
                Tambah Pasien
            </button>
        </div>

        <div class="content-subtitle">
            Daftar informasi pasien yang sudah terdaftar dalam sistem rumah sakit.
        </div>

        <div class="table-responsive">
            <table id="tabelPasien" class="table table-hover table-bordered w-100">
                <thead>
                    <tr>
                        <th width="55">No.</th>
                        <th>Nama Pasien</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Golongan Darah</th>
                        <th>Status Asuransi</th>
                        <th width="125" class="text-center">Aksi</th>
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

{{-- MODAL TAMBAH PASIEN --}}
<div class="modal fade" id="modalTambahPasien" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <form action="{{ route('master-pasien.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-user-plus me-2"></i> Tambah Pasien
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pasien <span class="text-danger">*</span></label>
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
                            <label class="form-label">Golongan Darah</label>
                            <select name="golongan_darah" class="form-select">
                                <option value="">-- Pilih Golongan Darah --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Asuransi</label>
                            <select name="status_asuransi" class="form-select">
                                <option value="">-- Pilih Status Asuransi --</option>
                                <option value="BPJS">BPJS</option>
                                <option value="Umum">Umum</option>
                                <option value="Asuransi Swasta">Asuransi Swasta</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3"
                                      placeholder="Masukkan alamat pasien"></textarea>
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

{{-- MODAL EDIT PASIEN --}}
<div class="modal fade" id="modalEditPasien" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <form id="formEditPasien" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-user-pen me-2"></i> Edit Pasien
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Pasien <span class="text-danger">*</span></label>
                            <input type="text" id="editNamaPasien" name="nama"
                                   class="form-control" maxlength="255" required>
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
                            <label class="form-label">Golongan Darah</label>
                            <select id="editGolonganDarah" name="golongan_darah" class="form-select">
                                <option value="">-- Pilih Golongan Darah --</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status Asuransi</label>
                            <select id="editStatusAsuransi" name="status_asuransi" class="form-select">
                                <option value="">-- Pilih Status Asuransi --</option>
                                <option value="BPJS">BPJS</option>
                                <option value="Umum">Umum</option>
                                <option value="Asuransi Swasta">Asuransi Swasta</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea id="editAlamatPasien" name="alamat"
                                      class="form-control" rows="3"></textarea>
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

{{-- MODAL DETAIL PASIEN --}}
<div class="modal fade" id="modalLihatPasien" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fa-solid fa-hospital-user me-2"></i> Detail Pasien
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Tutup"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Pasien</label>
                        <div id="lihatNamaPasien" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div id="lihatJenisKelamin" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <div id="lihatTanggalLahir" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Golongan Darah</label>
                        <div id="lihatGolonganDarah" class="detail-value">-</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status Asuransi</label>
                        <div id="lihatStatusAsuransi" class="detail-value">-</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alamat</label>
                        <div id="lihatAlamatPasien" class="detail-value"
                             style="min-height:70px;white-space:pre-wrap;">-</div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-batal" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

<form id="formHapusPasien" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    const tabel = $('#tabelPasien').DataTable({
        processing: true,
        serverSide: true,
        autoWidth: false,

        ajax: {
            url: "{{ route('admin.pasien.data') }}",
            type: 'GET',
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Data pasien gagal dimuat. Periksa route admin.pasien.data dan method dataAdmin().');
            }
        },

        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            { data: 'nama', name: 'nama', defaultContent: '-' },
            {
                data: 'jenis_kelamin',
                name: 'jenis_kelamin',
                defaultContent: '-',
                render: function (data) {
                    if (!data) return '-';

                    const value = String(data).toLowerCase();

                    if (value === 'laki-laki' || value === 'laki_laki') return 'Laki-laki';
                    if (value === 'perempuan') return 'Perempuan';

                    return data;
                }
            },
            { data: 'tanggal_lahir', name: 'tanggal_lahir', defaultContent: '-' },
            { data: 'golongan_darah', name: 'golongan_darah', defaultContent: '-' },
            { data: 'status_asuransi', name: 'status_asuransi', defaultContent: '-' },
            {
                data: null,
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function () {
                    return `
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" title="Lihat Detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-edit" title="Edit Pasien">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" title="Hapus Pasien">
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
            emptyTable: 'Belum ada data pasien',
            paginate: {
                first: 'Pertama',
                last: 'Terakhir',
                next: 'Berikutnya',
                previous: 'Sebelumnya'
            }
        }
    });

    function jenisKelaminLabel(value) {
        if (value === 'laki-laki' || value === 'laki_laki') return 'Laki-laki';
        if (value === 'perempuan') return 'Perempuan';
        return value || '-';
    }

    // LIHAT DETAIL
    $('#tabelPasien').on('click', '.btn-view', function () {
        const row = tabel.row($(this).closest('tr')).data();
        if (!row) return;

        $('#lihatNamaPasien').text(row.nama || '-');
        $('#lihatJenisKelamin').text(
            jenisKelaminLabel(row.jenis_kelamin_raw || row.jenis_kelamin)
        );
        $('#lihatTanggalLahir').text(
            row.tanggal_lahir_raw || row.tanggal_lahir || '-'
        );
        $('#lihatGolonganDarah').text(
            row.golongan_darah_raw || row.golongan_darah || '-'
        );
        $('#lihatStatusAsuransi').text(
            row.status_asuransi_raw || row.status_asuransi || '-'
        );
        $('#lihatAlamatPasien').text(row.alamat_raw || row.alamat || '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihatPasien')
        ).show();
    });

    // EDIT PASIEN
    $('#tabelPasien').on('click', '.btn-edit', function () {
        const row = tabel.row($(this).closest('tr')).data();

        if (!row || !row.id) {
            alert('ID pasien tidak ditemukan.');
            return;
        }

        $('#editNamaPasien').val(row.nama || '');
        $('#editJenisKelamin').val(row.jenis_kelamin_raw || row.jenis_kelamin || '');
        $('#editTanggalLahir').val(row.tanggal_lahir_raw || '');
        $('#editGolonganDarah').val(row.golongan_darah_raw || row.golongan_darah || '');
        $('#editStatusAsuransi').val(row.status_asuransi_raw || row.status_asuransi || '');
        $('#editAlamatPasien').val(row.alamat_raw || row.alamat || '');

        $('#formEditPasien').attr(
            'action',
            "{{ url('/master-pasien') }}/" + encodeURIComponent(row.id)
        );

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEditPasien')
        ).show();
    });

    // HAPUS PASIEN
    $('#tabelPasien').on('click', '.btn-delete', function () {
        const row = tabel.row($(this).closest('tr')).data();

        if (!row || !row.id) {
            alert('ID pasien tidak ditemukan.');
            return;
        }

        if (confirm('Apakah kamu yakin ingin menghapus data pasien ' + (row.nama || 'ini') + '?')) {
            $('#formHapusPasien').attr(
                'action',
                "{{ url('/master-pasien') }}/" + encodeURIComponent(row.id)
            );

            $('#formHapusPasien').trigger('submit');
        }
    });

});
</script>

</body>
</html>

