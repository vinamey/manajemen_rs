
@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Perawat')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

<style>
    .master-perawat {
        padding: 5px 0 30px;
    }

    /* HEADER */
    .page-header-perawat {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
    }

    .header-title-perawat {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .header-icon-perawat {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #e7f3ff;
        color: #1877f2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .page-title-perawat {
        font-size: 20px;
        font-weight: 700;
        color: #17233c;
        margin: 0;
    }

    .page-subtitle-perawat {
        font-size: 12px;
        color: #8a94a6;
        margin: 4px 0 0;
    }

    .btn-tambah-perawat {
        background: #1877f2;
        color: white !important;
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .btn-tambah-perawat:hover {
        background: #0f67d8;
    }

    /* ALERT */
    .alert-perawat {
        border: none;
        border-radius: 9px;
        font-size: 13px;
        padding: 12px 15px;
        margin-bottom: 18px;
    }

    /* TABLE CARD */
    .perawat-table-card {
        width: 100%;
        background: white;
        border-radius: 11px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0,0,0,.07);
    }

    /* DATATABLE */
    .dataTables_wrapper {
        background: white !important;
    }

    .dataTables_wrapper > .row:first-child {
        padding: 15px 15px 10px;
        margin: 0 !important;
        background: white;
    }

    .dataTables_wrapper > .row:last-child {
        padding: 10px 15px 14px;
        margin: 0 !important;
        background: white;
    }

    .dataTables_wrapper .dataTables_length label,
    .dataTables_wrapper .dataTables_filter label {
        color: #687386;
        font-size: 12px;
        font-weight: 500;
    }

    .dataTables_wrapper .dataTables_length select {
        min-width: 65px;
        margin: 0 5px;
        padding: 6px 28px 6px 9px;
        border: 1px solid #dfe5ec;
        border-radius: 7px;
        background-color: white;
        color: #495057;
        font-size: 12px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        width: 170px;
        margin-left: 7px;
        padding: 8px 10px;
        border: 1px solid #dfe5ec;
        border-radius: 7px;
        background: white;
        color: #495057;
        font-size: 12px;
        outline: none;
        box-shadow: none !important;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 2px rgba(24,119,242,.10) !important;
    }

    .dataTables_wrapper .dataTables_info {
        color: #7b8494;
        font-size: 12px;
        padding-top: 8px !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 4px !important;
    }

    .dataTables_wrapper .page-link {
        color: #657080;
        background: white;
        border: 1px solid #e0e5eb;
        font-size: 12px;
        border-radius: 6px !important;
        margin: 0 2px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .page-item.active .page-link {
        background: #1877f2 !important;
        border-color: #1877f2 !important;
        color: white !important;
    }

    div.dataTables_processing {
        display: none !important;
    }

    /* TABEL */
    #perawat-table {
        width: 100% !important;
        margin: 0 !important;
        border-collapse: collapse !important;
    }

    #perawat-table thead th {
        background: #1877f2 !important;
        color: white !important;
        font-size: 12px;
        font-weight: 700;
        padding: 13px 14px !important;
        border: none !important;
        vertical-align: middle;
        white-space: nowrap;
    }

    #perawat-table tbody tr {
        background: white !important;
    }

    #perawat-table tbody td {
        background: white !important;
        color: #4f5969;
        font-size: 12px;
        padding: 14px !important;
        border-bottom: 1px solid #eef1f5 !important;
        vertical-align: middle;
    }

    #perawat-table tbody tr:hover td {
        background: #f8fbff !important;
    }

    #perawat-table tbody td:nth-child(2) {
        color: #17233c;
        font-weight: 700;
    }

    table.dataTable thead > tr > th.sorting:before,
    table.dataTable thead > tr > th.sorting:after,
    table.dataTable thead > tr > th.sorting_asc:before,
    table.dataTable thead > tr > th.sorting_asc:after,
    table.dataTable thead > tr > th.sorting_desc:before,
    table.dataTable thead > tr > th.sorting_desc:after {
        color: white !important;
        opacity: .75 !important;
    }

    /* BADGE JENIS KELAMIN */
    .badge-gender {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 6px;
        background: #dff2ff;
        color: #0784c9;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* TOMBOL AKSI */
    .action-buttons {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-action {
        width: 42px !important;
        min-width: 42px;
        height: 42px !important;
        padding: 0 !important;
        border: none !important;
        border-radius: 7px !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
        cursor: pointer;
        font-size: 0 !important;
        line-height: 1 !important;
        flex-shrink: 0;
        transition: .2s;
    }

    .btn-action i {
        font-size: 14px !important;
        margin: 0 !important;
    }

    .btn-view {
        background: #dff5ff !important;
        color: #0797d5 !important;
    }

    .btn-view:hover {
        background: #0797d5 !important;
        color: white !important;
    }

    .btn-edit {
        background: #1877f2 !important;
        color: white !important;
    }

    .btn-edit:hover {
        background: #0f67d8 !important;
        color: white !important;
    }

    .btn-delete {
        background: #ef3f45 !important;
        color: white !important;
    }

    .btn-delete:hover {
        background: #d92f35 !important;
        color: white !important;
    }

    /* MODAL */
    .modal-content {
        border: none;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0,0,0,.18);
    }

    .modal-header-perawat {
        background: #1877f2;
        color: white;
        border: none;
        padding: 15px 18px;
    }

    .modal-header-perawat .modal-title {
        color: white;
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .modal-body {
        padding: 20px;
    }

    .form-group-perawat {
        margin-bottom: 15px;
    }

    .form-label-perawat {
        display: block;
        color: #697386;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .form-control-perawat,
    .form-select-perawat {
        width: 100%;
        min-height: 42px;
        border: 1px solid #d9e0e8;
        border-radius: 8px;
        padding: 9px 11px;
        background: white;
        color: #495057;
        font-size: 12px;
        outline: none;
    }

    textarea.form-control-perawat {
        min-height: 85px;
        resize: vertical;
    }

    .form-control-perawat:focus,
    .form-select-perawat:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 3px rgba(24,119,242,.10);
    }

    .account-heading-perawat {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 20px 0 15px;
        padding: 12px;
        background: #f0f7ff;
        border-radius: 9px;
    }

    .account-heading-perawat i {
        color: #1877f2;
        font-size: 17px;
    }

    .account-heading-perawat h6 {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .account-heading-perawat small {
        display: block;
        color: #64748b;
        font-size: 10px;
        margin-top: 3px;
    }

    .modal-footer-perawat {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
        padding: 13px 18px;
        background: #f8fafc;
        border: none;
    }

    .btn-modal-batal {
        border: none;
        background: #f0f3f7;
        color: #667085;
        border-radius: 7px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-simpan {
        border: none;
        background: #1877f2;
        color: white;
        border-radius: 7px;
        padding: 9px 15px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-simpan:hover {
        background: #0f67d8;
    }

    /* DETAIL */
    .detail-item {
        margin-bottom: 14px;
    }

    .detail-label {
        color: #8a94a6;
        font-size: 11px;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .detail-value {
        background: #f8fafc;
        border: 1px solid #edf0f4;
        border-radius: 7px;
        padding: 10px 12px;
        color: #344054;
        font-size: 13px;
        min-height: 40px;
    }

    @media(max-width: 768px) {
        .page-header-perawat {
            gap: 15px;
            align-items: flex-start;
        }

        .btn-tambah-perawat {
            padding: 8px 11px;
            font-size: 11px;
        }

        #perawat-table {
            min-width: 850px;
        }
    }
</style>


<div class="master-perawat">

    {{-- HEADER --}}
    <div class="page-header-perawat">

        <div class="header-title-perawat">

            <div class="header-icon-perawat">
                <i class="fas fa-user-nurse"></i>
            </div>

            <div>
                <h4 class="page-title-perawat">Master Perawat</h4>
                <p class="page-subtitle-perawat">
                    Data perawat yang terdaftar
                </p>
            </div>

        </div>

        <button type="button"
                class="btn-tambah-perawat"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPerawat">

            <i class="fas fa-plus"></i>
            Tambah Perawat

        </button>

    </div>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-perawat">
            <i class="fas fa-circle-check me-1"></i>
            {{ session('success') }}
        </div>
    @endif


    {{-- ALERT ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-perawat">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- TABEL PERAWAT --}}
    <div class="perawat-table-card">

        <div class="table-responsive">

            <table id="perawat-table" class="table align-middle">

                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Perawat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>

</div>


{{-- =====================================================
     MODAL TAMBAH PERAWAT
===================================================== --}}

<div class="modal fade"
     id="modalTambahPerawat"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form action="{{ route('master-perawat.store') }}"
                  method="POST">

                @csrf

                <div class="modal-header modal-header-perawat">

                    <h5 class="modal-title">
                        <i class="fas fa-user-plus me-2"></i>
                        Tambah Perawat
                    </h5>

                </div>

                <div class="modal-body">

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Nama Perawat</label>

                        <input type="text"
                               name="nama"
                               class="form-control-perawat"
                               placeholder="Masukkan nama perawat"
                               value="{{ old('nama') }}"
                               required>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Jenis Kelamin</label>

                        <select name="jenis_kelamin"
                                class="form-select-perawat"
                                required>

                            <option value="">-- Pilih Jenis Kelamin --</option>

                            <option value="laki-laki"
                                {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                Laki-laki
                            </option>

                            <option value="perempuan"
                                {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                Perempuan
                            </option>

                        </select>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Tanggal Lahir</label>

                        <input type="date"
                               name="tanggal_lahir"
                               class="form-control-perawat"
                               value="{{ old('tanggal_lahir') }}"
                               required>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Alamat</label>

                        <textarea name="alamat"
                                  class="form-control-perawat"
                                  placeholder="Masukkan alamat lengkap"
                                  required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="account-heading-perawat">

                        <i class="fas fa-user-lock"></i>

                        <div>
                            <h6>Akun Login Perawat</h6>
                            <small>Akun otomatis dibuat dengan role Perawat.</small>
                        </div>

                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Email Login</label>

                        <input type="email"
                               name="email"
                               class="form-control-perawat"
                               placeholder="Masukkan email perawat"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Password</label>

                        <input type="password"
                               name="password"
                               class="form-control-perawat"
                               placeholder="Minimal 8 karakter"
                               minlength="8"
                               required>
                    </div>

                    <div class="form-group-perawat mb-0">
                        <label class="form-label-perawat">Konfirmasi Password</label>

                        <input type="password"
                               name="password_confirmation"
                               class="form-control-perawat"
                               placeholder="Ulangi password"
                               minlength="8"
                               required>
                    </div>

                </div>

                <div class="modal-footer-perawat">

                    <button type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn-modal-simpan">
                        <i class="fas fa-save me-1"></i>
                        Simpan Perawat
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
     MODAL DETAIL PERAWAT
===================================================== --}}

<div class="modal fade"
     id="modalLihatPerawat"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header modal-header-perawat">

                <h5 class="modal-title">
                    <i class="fas fa-user-nurse me-2"></i>
                    Detail Perawat
                </h5>

            </div>

            <div class="modal-body">

                <div class="detail-item">
                    <div class="detail-label">Nama Perawat</div>
                    <div class="detail-value" id="lihat_nama">-</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Jenis Kelamin</div>
                    <div class="detail-value" id="lihat_jenis_kelamin">-</div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Tanggal Lahir</div>
                    <div class="detail-value" id="lihat_tanggal_lahir">-</div>
                </div>

                <div class="detail-item mb-0">
                    <div class="detail-label">Alamat</div>
                    <div class="detail-value" id="lihat_alamat">-</div>
                </div>

            </div>

            <div class="modal-footer-perawat">

                <button type="button"
                        class="btn-modal-batal"
                        data-bs-dismiss="modal">
                    Tutup
                </button>

            </div>

        </div>

    </div>

</div>


{{-- =====================================================
     MODAL EDIT PERAWAT
===================================================== --}}

<div class="modal fade"
     id="modalEditPerawat"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form id="formEditPerawat" method="POST">

                @csrf
                @method('PUT')

                <div class="modal-header modal-header-perawat">

                    <h5 class="modal-title">
                        <i class="fas fa-user-edit me-2"></i>
                        Edit Perawat
                    </h5>

                </div>

                <div class="modal-body">

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Nama Perawat</label>

                        <input type="text"
                               id="edit_nama"
                               name="nama"
                               class="form-control-perawat"
                               required>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Jenis Kelamin</label>

                        <select id="edit_jenis_kelamin"
                                name="jenis_kelamin"
                                class="form-select-perawat"
                                required>

                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>

                        </select>
                    </div>

                    <div class="form-group-perawat">
                        <label class="form-label-perawat">Tanggal Lahir</label>

                        <input type="date"
                               id="edit_tanggal_lahir"
                               name="tanggal_lahir"
                               class="form-control-perawat"
                               required>
                    </div>

                    <div class="form-group-perawat mb-0">
                        <label class="form-label-perawat">Alamat</label>

                        <textarea id="edit_alamat"
                                  name="alamat"
                                  class="form-control-perawat"
                                  required></textarea>
                    </div>

                </div>

                <div class="modal-footer-perawat">

                    <button type="button"
                            class="btn-modal-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn-modal-simpan">
                        <i class="fas fa-save me-1"></i>
                        Update Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =====================================================
     JAVASCRIPT DATATABLE
===================================================== --}}

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    const table = $('#perawat-table').DataTable({

        processing: true,
        serverSide: true,

        ajax: {
            url: @json(route('master-perawat.data')),
            type: 'GET',
            error: function (xhr) {
                console.error('Gagal memuat data perawat:', xhr.responseText);
            }
        },

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
                name: 'nama'
            },
            {
                data: 'jenis_kelamin',
                name: 'jenis_kelamin'
            },
            {
                data: 'tanggal_lahir',
                name: 'tanggal_lahir'
            },
            {
                data: 'alamat',
                name: 'alamat'
            },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ],

        order: [[1, 'asc']],

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],

        language: {
            processing: 'Memuat data...',
            search: 'Cari:',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Menampilkan 0 sampai 0 data',
            infoFiltered: '(disaring dari _MAX_ total data)',
            zeroRecords: 'Data perawat tidak ditemukan',
            emptyTable: 'Belum ada data perawat',

            paginate: {
                first: 'Pertama',
                previous: 'Sebelumnya',
                next: 'Berikutnya',
                last: 'Terakhir'
            }
        }

    });


    // FORMAT TANGGAL
    function formatTanggalIndonesia(tanggal) {

        if (!tanggal) return '-';

        const bagian = String(tanggal).split('-');

        if (bagian.length !== 3) return tanggal;

        return bagian[2] + '-' + bagian[1] + '-' + bagian[0];
    }


    // NORMALISASI JENIS KELAMIN
    function formatGender(gender) {

        gender = String(gender || '').toLowerCase();

        if (gender === 'laki-laki' || gender === 'laki_laki' || gender === 'l') {
            return 'Laki-laki';
        }

        if (gender === 'perempuan' || gender === 'p') {
            return 'Perempuan';
        }

        return '-';
    }


    // BUKA MODAL
    function bukaModal(id) {

        const elemen = document.getElementById(id);

        if (!elemen || !window.bootstrap) {
            alert('Bootstrap modal tidak ditemukan.');
            return;
        }

        bootstrap.Modal.getOrCreateInstance(elemen).show();
    }


    // DETAIL PERAWAT
    $('#perawat-table').on('click', '.btn-view', function () {

        const data = table.row($(this).closest('tr')).data();

        if (!data) return;

        $('#lihat_nama').text(data.nama || '-');

        $('#lihat_jenis_kelamin').text(
            formatGender(data.jenis_kelamin_raw ?? data.jenis_kelamin)
        );

        $('#lihat_tanggal_lahir').text(
            formatTanggalIndonesia(data.tanggal_lahir_raw ?? data.tanggal_lahir)
        );

        $('#lihat_alamat').text(data.alamat_raw ?? data.alamat ?? '-');

        bukaModal('modalLihatPerawat');

    });


    // EDIT PERAWAT
    $('#perawat-table').on('click', '.btn-edit', function () {

        const data = table.row($(this).closest('tr')).data();

        if (!data || !data.id) return;

        $('#edit_nama').val(data.nama || '');

        let gender = String(
            data.jenis_kelamin_raw ?? data.jenis_kelamin ?? ''
        ).toLowerCase();

        if (gender === 'l' || gender === 'laki_laki') {
            gender = 'laki-laki';
        }

        if (gender === 'p') {
            gender = 'perempuan';
        }

        $('#edit_jenis_kelamin').val(gender);

        $('#edit_tanggal_lahir').val(
            data.tanggal_lahir_raw ?? ''
        );

        $('#edit_alamat').val(
            data.alamat_raw ?? data.alamat ?? ''
        );

        let updateUrl = @json(route('master-perawat.update', ':id'));

        updateUrl = updateUrl.replace(':id', data.id);

        $('#formEditPerawat').attr('action', updateUrl);

        bukaModal('modalEditPerawat');

    });


    // HAPUS PERAWAT
    $('#perawat-table').on('click', '.btn-delete', function (e) {

        const form = $(this).closest('form');

        if (!form.length) {
            e.preventDefault();
            alert('Form hapus tidak ditemukan.');
            return;
        }

        if (!confirm('Yakin ingin menghapus data perawat ini?')) {
            e.preventDefault();
        }

    });


    // MODAL TAMBAH JIKA VALIDASI GAGAL
    @if($errors->any())

        bukaModal('modalTambahPerawat');

    @endif

});
</script>

@endsection
