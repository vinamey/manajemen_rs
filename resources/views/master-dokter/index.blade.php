
@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Dokter')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">

<style>
:root {
    --blue-main: #1877f2;
    --blue-dark: #0f58c6;
    --blue-light-bg: #e7f3ff;
    --blue-soft: #f0f7ff;
}

.master-dokter { padding: 5px 0 30px; }
.page-header-dokter { margin-bottom: 22px; }

.header-icon-box {
    width: 44px;
    height: 44px;
    background: var(--blue-light-bg);
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--blue-main);
    font-size: 18px;
    flex-shrink: 0;
}

.page-title-dokter {
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    margin: 0;
}

.page-subtitle-dokter {
    font-size: 12px;
    color: #64748b;
    margin: 3px 0 0;
}

.btn-blue-primary {
    background: var(--blue-main) !important;
    border: none !important;
    color: #fff !important;
    border-radius: 8px;
    padding: 9px 15px;
    font-size: 13px;
    font-weight: 600;
}

.btn-blue-primary:hover { background: var(--blue-dark) !important; }

.card-table-dokter {
    background: #fff;
    border: none !important;
    border-radius: 13px !important;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(15,23,42,.06);
    padding: 18px;
}

.table-responsive { overflow-x: auto; }
#dokter-table { width: 100% !important; margin-bottom: 0 !important; }

#dokter-table thead th {
    background: var(--blue-main) !important;
    color: #fff !important;
    border: none !important;
    padding: 13px 12px !important;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

#dokter-table tbody td {
    background: #fff;
    color: #475569;
    border-bottom: 1px solid #edf2f7;
    padding: 12px !important;
    font-size: 12px;
    vertical-align: middle;
}

#dokter-table tbody tr:hover td { background: var(--blue-soft); }

.action-buttons {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
}

.btn-action {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 7px;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    font-size: 12px;
}

.btn-view { background: #e0f2fe; color: #0284c7; }
.btn-edit { background: var(--blue-main); color: #fff; }
.btn-delete { background: #fee2e2; color: #dc2626; }
.btn-view:hover { background: #bae6fd; }
.btn-edit:hover { background: var(--blue-dark); color: #fff; }
.btn-delete:hover { background: #dc2626; color: #fff; }

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 15px;
    font-size: 12px;
    color: #64748b;
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #dbe3ec !important;
    border-radius: 7px !important;
    padding: 6px 10px !important;
    font-size: 12px;
    box-shadow: none !important;
}

.dataTables_wrapper .dataTables_info {
    font-size: 11px;
    color: #64748b;
    padding-top: 15px !important;
}

.dataTables_wrapper .dataTables_paginate { padding-top: 12px !important; }

.dataTables_wrapper .page-link {
    font-size: 11px;
    color: var(--blue-main);
    border-radius: 6px !important;
    margin: 0 2px;
    border: 1px solid #e2e8f0;
    box-shadow: none !important;
}

.dataTables_wrapper .page-item.active .page-link {
    background: var(--blue-main);
    border-color: var(--blue-main);
    color: #fff;
}

/* MODAL */
.modal-dokter .modal-dialog {
    width: calc(100% - 30px) !important;
    max-width: 450px !important;
    margin: 1.75rem auto !important;
}

.modal-dokter .modal-dialog-centered {
    min-height: calc(100% - 3.5rem) !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.modal-dokter .modal-content {
    width: 100% !important;
    border: none !important;
    border-radius: 14px !important;
    overflow: visible !important;
    box-shadow: 0 15px 40px rgba(15,23,42,.18) !important;
}

.modal-dokter .modal-header {
    background: var(--blue-main) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 14px 14px 0 0;
    padding: 15px 18px !important;
}

.modal-dokter .modal-title {
    font-size: 15px !important;
    font-weight: 700 !important;
    margin: 0 !important;
}

.modal-dokter .modal-body {
    padding: 20px 18px !important;
    background: #fff !important;
    overflow: visible !important;
}

.modal-dokter .modal-footer {
    background: #f8fafc !important;
    border: none !important;
    border-radius: 0 0 14px 14px;
    padding: 12px 18px !important;
}

.form-group-dokter {
    width: 100% !important;
    margin-bottom: 13px !important;
}

.form-label-dokter {
    display: block !important;
    width: 100% !important;
    font-size: 11px !important;
    font-weight: 600 !important;
    color: #64748b !important;
    margin-bottom: 6px !important;
}

.form-control-dokter,
.form-select-dokter {
    width: 100% !important;
    height: 38px !important;
    box-sizing: border-box !important;
    border: 1px solid #d7e0ea !important;
    border-radius: 8px !important;
    padding: 9px 11px !important;
    font-size: 12px !important;
    color: #334155 !important;
    background: #fff !important;
}

.form-control-dokter:focus,
.form-select-dokter:focus {
    border-color: var(--blue-main) !important;
    box-shadow: 0 0 0 3px rgba(24,119,242,.12) !important;
    outline: none !important;
}

textarea.form-control-dokter {
    height: auto !important;
    min-height: 75px !important;
    resize: vertical !important;
}

.btn-modal-cancel {
    background: #f1f5f9 !important;
    color: #64748b !important;
    border: none !important;
    border-radius: 7px;
    padding: 8px 15px;
    font-size: 12px;
    font-weight: 600;
}

.btn-modal-save {
    background: var(--blue-main) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 7px;
    padding: 8px 16px;
    font-size: 12px;
    font-weight: 600;
}

.btn-modal-save:hover { background: var(--blue-dark) !important; }

/* DETAIL */
.detail-body-dokter { padding: 0 18px 20px !important; }
.detail-full-dokter { padding: 14px 0; border-bottom: 1px solid #e5e7eb; }
.detail-row-dokter { margin: 0 !important; border-bottom: 1px solid #e5e7eb; }
.detail-row-dokter > div { padding: 14px 5px; }
.detail-row-dokter > div:first-child { border-right: 1px solid #e5e7eb; }

.detail-label-dokter {
    font-size: 10px;
    color: #64748b;
    font-weight: 500;
    margin-bottom: 5px;
}

.detail-value-dokter {
    font-size: 12px;
    color: #475569;
    line-height: 1.5;
    word-break: break-word;
}

.detail-name { color: #334155; font-weight: 700; }

/* SELECT2 */
.modal-dokter .select2-container { width: 100% !important; }

.modal-dokter .select2-container--default .select2-selection--single {
    height: 38px !important;
    border: 1px solid #d7e0ea !important;
    border-radius: 8px !important;
    display: flex !important;
    align-items: center !important;
    background: #fff !important;
}

.modal-dokter .select2-selection--single .select2-selection__rendered {
    width: 100%;
    padding-left: 11px !important;
    padding-right: 30px !important;
    font-size: 12px !important;
    color: #334155 !important;
    line-height: 36px !important;
}

.modal-dokter .select2-selection--single .select2-selection__arrow {
    height: 36px !important;
    right: 7px !important;
}

.select2-container--open { z-index: 99999 !important; }

.select2-dropdown {
    z-index: 99999 !important;
    background: #fff !important;
    border: 1px solid #d7e0ea !important;
    border-radius: 6px !important;
    overflow: hidden !important;
}

.select2-results__options {
    max-height: 150px !important;
    overflow-y: auto !important;
}

.select2-results__option {
    font-size: 12px !important;
    padding: 9px 11px !important;
}

.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: var(--blue-main) !important;
}

.select2-search--dropdown { padding: 8px !important; }

.select2-search__field {
    width: 100% !important;
    box-sizing: border-box !important;
    padding: 8px !important;
    border: 1px solid #d7e0ea !important;
    border-radius: 6px !important;
    outline: none !important;
}

@media (max-width: 768px) {
    .page-header-dokter {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 12px;
    }

    .btn-blue-primary { width: 100%; }
}
</style>

<div class="container-fluid master-dokter">
    <div class="d-flex justify-content-between align-items-center page-header-dokter">
        <div class="d-flex align-items-center gap-3">
            <div class="header-icon-box"><i class="fas fa-user-doctor"></i></div>
            <div>
                <h3 class="page-title-dokter">Master Dokter</h3>
                <p class="page-subtitle-dokter">Data dokter yang terdaftar</p>
            </div>
        </div>

        <button type="button" class="btn btn-blue-primary"
            data-bs-toggle="modal" data-bs-target="#modalTambahDokter">
            <i class="fas fa-plus me-1"></i> Tambah Dokter
        </button>
    </div>

    <div class="card-table-dokter">
        <div class="table-responsive">
            <table id="dokter-table" class="table align-middle">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Dokter</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Spesialis</th>
                        <th>Alamat</th>
                        <th>Poli</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade modal-dokter" id="modalTambahDokter"
    tabindex="-1" aria-labelledby="modalTambahDokterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    <h5 class="modal-title" id="modalTambahDokterLabel">Tambah Dokter</h5>
                </div>
            </div>

            <form id="formTambahDokter">
                @csrf
                <div class="modal-body">
                    <div class="form-group-dokter">
                        <label for="tambah_nama" class="form-label-dokter">Nama Dokter</label>
                        <input type="text" name="nama" id="tambah_nama"
                            class="form-control-dokter" placeholder="Masukkan nama dokter" required>
                    </div>

                    <div class="form-group-dokter">
                        <label for="tambah_jenis_kelamin" class="form-label-dokter">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="tambah_jenis_kelamin"
                            class="form-select-dokter" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label for="tambah_tanggal_lahir" class="form-label-dokter">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tambah_tanggal_lahir"
                            class="form-control-dokter" required>
                    </div>

                    <div class="form-group-dokter">
                        <label for="tambah_spesialis" class="form-label-dokter">Spesialis</label>
                        <select name="spesialis" id="tambah_spesialis"
                            class="form-select-dokter" required>
                            <option value=""></option>
                            <option value="Umum">Umum</option>
                            <option value="Penyakit Dalam">Penyakit Dalam</option>
                            <option value="Kandungan">Kandungan</option>
                            <option value="Anak">Anak</option>
                            <option value="Bedah">Bedah</option>
                            <option value="Jantung dan Pembuluh Darah">Jantung dan Pembuluh Darah</option>
                            <option value="Saraf">Saraf</option>
                            <option value="Mata">Mata</option>
                            <option value="THT">THT</option>
                            <option value="Kulit dan Kelamin">Kulit dan Kelamin</option>
                            <option value="Paru">Paru</option>
                            <option value="Ortopedi">Ortopedi</option>
                            <option value="Urologi">Urologi</option>
                            <option value="Gigi">Gigi</option>
                            <option value="Psikiatri">Psikiatri</option>
                            <option value="Radiologi">Radiologi</option>
                            <option value="Anestesiologi">Anestesiologi</option>
                            <option value="Patologi Klinik">Patologi Klinik</option>
                            <option value="Rehabilitasi Medik">Rehabilitasi Medik</option>
                            <option value="Gizi Klinik">Gizi Klinik</option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label for="tambah_alamat" class="form-label-dokter">Alamat</label>
                        <textarea name="alamat" id="tambah_alamat"
                            class="form-control-dokter" rows="3"
                            placeholder="Masukkan alamat lengkap dokter..."></textarea>
                    </div>

                    <div class="form-group-dokter mb-0">
                        <label for="tambah_poli_id" class="form-label-dokter">Poli</label>
                        <select name="poli_id" id="tambah_poli_id"
                            class="form-select-dokter" required>
                            <option value=""></option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-save" id="btnSimpanTambah">
                        <i class="fas fa-floppy-disk me-1"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- MODAL LIHAT --}}
<div class="modal fade modal-dokter" id="modalLihatDokter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-doctor"></i>
                    <h5 class="modal-title">Detail Dokter</h5>
                </div>
            </div>

            <div class="modal-body detail-body-dokter">
                <div class="detail-full-dokter">
                    <div class="detail-label-dokter">Nama Dokter</div>
                    <div class="detail-value-dokter detail-name" id="lihat_nama">-</div>
                </div>

                <div class="row detail-row-dokter">
                    <div class="col-6">
                        <div class="detail-label-dokter">Jenis Kelamin</div>
                        <div class="detail-value-dokter" id="lihat_jenis_kelamin">-</div>
                    </div>
                    <div class="col-6">
                        <div class="detail-label-dokter">Tanggal Lahir</div>
                        <div class="detail-value-dokter" id="lihat_tanggal_lahir">-</div>
                    </div>
                </div>

                <div class="row detail-row-dokter">
                    <div class="col-6">
                        <div class="detail-label-dokter">Spesialis</div>
                        <div class="detail-value-dokter" id="lihat_spesialis">-</div>
                    </div>
                    <div class="col-6">
                        <div class="detail-label-dokter">Poli</div>
                        <div class="detail-value-dokter" id="lihat_poli">-</div>
                    </div>
                </div>

                <div class="detail-full-dokter border-bottom-0">
                    <div class="detail-label-dokter">Alamat</div>
                    <div class="detail-value-dokter" id="lihat_alamat">-</div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade modal-dokter" id="modalEditDokter"
    tabindex="-1" aria-labelledby="modalEditDokterLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-user-pen"></i>
                    <h5 class="modal-title" id="modalEditDokterLabel">Edit Data Dokter</h5>
                </div>
            </div>

            <form id="formEditDokter">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_id" name="id">

                <div class="modal-body">
                    <div class="form-group-dokter">
                        <label for="edit_nama" class="form-label-dokter">Nama Dokter</label>
                        <input type="text" name="nama" id="edit_nama"
                            class="form-control-dokter" required>
                    </div>

                    <div class="form-group-dokter">
                        <label for="edit_jenis_kelamin" class="form-label-dokter">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="edit_jenis_kelamin"
                            class="form-select-dokter" required>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label for="edit_tanggal_lahir" class="form-label-dokter">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="edit_tanggal_lahir"
                            class="form-control-dokter" required>
                    </div>

                    <div class="form-group-dokter">
                        <label for="edit_spesialis" class="form-label-dokter">Spesialis</label>
                        <select name="spesialis" id="edit_spesialis"
                            class="form-select-dokter" required>
                            <option value=""></option>
                            <option value="Umum">Umum</option>
                            <option value="Penyakit Dalam">Penyakit Dalam</option>
                            <option value="Kandungan">Kandungan</option>
                            <option value="Anak">Anak</option>
                            <option value="Bedah">Bedah</option>
                            <option value="Jantung dan Pembuluh Darah">Jantung dan Pembuluh Darah</option>
                            <option value="Saraf">Saraf</option>
                            <option value="Mata">Mata</option>
                            <option value="THT">THT</option>
                            <option value="Kulit dan Kelamin">Kulit dan Kelamin</option>
                            <option value="Paru">Paru</option>
                            <option value="Ortopedi">Ortopedi</option>
                            <option value="Urologi">Urologi</option>
                            <option value="Gigi">Gigi</option>
                            <option value="Psikiatri">Psikiatri</option>
                            <option value="Radiologi">Radiologi</option>
                            <option value="Anestesiologi">Anestesiologi</option>
                            <option value="Patologi Klinik">Patologi Klinik</option>
                            <option value="Rehabilitasi Medik">Rehabilitasi Medik</option>
                            <option value="Gizi Klinik">Gizi Klinik</option>
                        </select>
                    </div>

                    <div class="form-group-dokter">
                        <label for="edit_alamat" class="form-label-dokter">Alamat</label>
                        <textarea name="alamat" id="edit_alamat"
                            class="form-control-dokter" rows="3"></textarea>
                    </div>

                    <div class="form-group-dokter mb-0">
                        <label for="edit_poli_id" class="form-label-dokter">Poli</label>
                        <select name="poli_id" id="edit_poli_id"
                            class="form-select-dokter" required>
                            <option value=""></option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}">{{ $poli->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modal-save" id="btnSimpanEdit">
                        <i class="fas fa-floppy-disk me-1"></i> Perbarui Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let table;

$(document).ready(function () {

    // SELECT2: SPESIALIS DAN POLI
    function aktifkanSelect2(selector, modalSelector, placeholder) {
        $(selector).select2({
            dropdownParent: $(modalSelector),
            width: '100%',
            placeholder: placeholder,
            allowClear: true,
            minimumResultsForSearch: 0,
            selectOnClose: false,
            dropdownAutoWidth: false
        });

        // Paksa dropdown berada di bawah kotak pilihan.
        $(selector).on('select2:open.posisiBawah', function () {
            const $select = $(this);

            requestAnimationFrame(function () {
                const selectContainer = $select.next('.select2-container')[0];
                const modal = document.querySelector(modalSelector);

                if (!selectContainer || !modal) return;

                const openContainers = modal.querySelectorAll(
                    '.select2-container--open'
                );

                if (!openContainers.length) return;

                const dropdownContainer =
                    openContainers[openContainers.length - 1];

                const dropdown = dropdownContainer.querySelector(
                    '.select2-dropdown'
                );

                const parent = dropdownContainer.offsetParent;

                if (!dropdown || !parent) return;

                const selectRect = selectContainer.getBoundingClientRect();
                const parentRect = parent.getBoundingClientRect();

                dropdownContainer.style.position = 'absolute';
                dropdownContainer.style.top =
                    (selectRect.bottom - parentRect.top + parent.scrollTop) + 'px';
                dropdownContainer.style.left =
                    (selectRect.left - parentRect.left + parent.scrollLeft) + 'px';
                dropdownContainer.style.width = selectRect.width + 'px';
                dropdownContainer.style.bottom = 'auto';
                dropdownContainer.style.right = 'auto';

                dropdownContainer.classList.remove('select2-dropdown--above');
                dropdownContainer.classList.add('select2-dropdown--below');
                dropdown.classList.remove('select2-dropdown--above');
                dropdown.classList.add('select2-dropdown--below');
            });
        });
    }

    aktifkanSelect2('#tambah_spesialis', '#modalTambahDokter', '-- Pilih Spesialis --');
    aktifkanSelect2('#tambah_poli_id', '#modalTambahDokter', '-- Pilih Poli --');
    aktifkanSelect2('#edit_spesialis', '#modalEditDokter', '-- Pilih Spesialis --');
    aktifkanSelect2('#edit_poli_id', '#modalEditDokter', '-- Pilih Poli --');

    // DATATABLES
    table = $('#dokter-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('master-dokter.data') }}",
        ordering: false,
        pageLength: 10,
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                className: 'text-center'
            },
            { data: 'nama', name: 'nama' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'spesialis', name: 'spesialis', defaultContent: '-' },
            { data: 'alamat', name: 'alamat', defaultContent: '-' },
            { data: 'poli_nama', name: 'poli_nama', defaultContent: '-' },
            {
                data: 'aksi',
                name: 'aksi',
                orderable: false,
                searchable: false,
                className: 'text-center'
            }
        ],
        language: {
            search: '',
            searchPlaceholder: 'Cari dokter...',
            lengthMenu: 'Tampilkan _MENU_ data',
            info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
            infoEmpty: 'Tidak ada data dokter',
            emptyTable: 'Belum ada data dokter',
            zeroRecords: 'Data dokter tidak ditemukan',
            processing: 'Memuat data...',
            paginate: {
                first: 'Awal',
                last: 'Akhir',
                next: 'Lanjut',
                previous: 'Kembali'
            }
        }
    });

    // TAMBAH DATA
    $('#formTambahDokter').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const btn = $('#btnSimpanTambah');

        btn.prop('disabled', true).html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...'
        );

        $.ajax({
            url: "{{ route('master-dokter.store') }}",
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            headers: { 'Accept': 'application/json' },

            success: function (response) {
                if (response.success === true) {
                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('modalTambahDokter')
                    ).hide();

                    form[0].reset();
                    $('#tambah_spesialis, #tambah_poli_id')
                        .val(null).trigger('change');

                    table.ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message || 'Data dokter berhasil ditambahkan.',
                        timer: 1800,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire(
                        'Gagal!',
                        response.message || 'Data dokter gagal disimpan.',
                        'error'
                    );
                }
            },

            error: function (xhr) {
                alertError(xhr);
            },

            complete: function () {
                btn.prop('disabled', false).html(
                    '<i class="fas fa-floppy-disk me-1"></i> Simpan Data'
                );
            }
        });
    });

    $('#modalTambahDokter').on('hidden.bs.modal', function () {
        $('#formTambahDokter')[0].reset();
        $('#tambah_spesialis, #tambah_poli_id')
            .val(null).trigger('change');
    });

    // LIHAT DATA
    $(document).on('click', '.btn-view', function () {
        const rowData = table.row($(this).closest('tr')).data();
        if (!rowData) return;

        $('#lihat_nama').text(rowData.nama || '-');

        $('#lihat_jenis_kelamin').text(
            rowData.jenis_kelamin_raw === 'laki-laki'
                ? 'Laki-laki'
                : rowData.jenis_kelamin_raw === 'perempuan'
                    ? 'Perempuan'
                    : '-'
        );

        $('#lihat_tanggal_lahir').text(rowData.tanggal_lahir || '-');
        $('#lihat_spesialis').text(rowData.spesialis_raw || '-');
        $('#lihat_poli').text(rowData.poli_nama || '-');
        $('#lihat_alamat').text(rowData.alamat_raw || '-');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalLihatDokter')
        ).show();
    });

    // EDIT DATA
    $(document).on('click', '.btn-edit', function () {
        const rowData = table.row($(this).closest('tr')).data();
        if (!rowData) return;

        $('#edit_id').val(rowData.id);
        $('#edit_nama').val(rowData.nama || '');
        $('#edit_jenis_kelamin').val(rowData.jenis_kelamin_raw || '');
        $('#edit_tanggal_lahir').val(rowData.tanggal_lahir_raw || '');
        $('#edit_alamat').val(rowData.alamat_raw || '');

        // Jika ada spesialis lama di database yang belum ada di daftar,
        // tambahkan sementara agar tetap bisa dipilih saat edit.
        const spesialisLama = rowData.spesialis_raw || '';
        const $spesialis = $('#edit_spesialis');

        if (spesialisLama && !$spesialis.find('option').filter(function () {
            return this.value === spesialisLama;
        }).length) {
            $spesialis.append(new Option(
                spesialisLama,
                spesialisLama,
                false,
                false
            ));
        }

        $spesialis.val(spesialisLama).trigger('change');

        $('#edit_poli_id')
            .val(rowData.poli_id_raw || '')
            .trigger('change');

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById('modalEditDokter')
        ).show();
    });

    // UPDATE DATA
    $('#formEditDokter').on('submit', function (e) {
        e.preventDefault();

        const form = $(this);
        const id = $('#edit_id').val();
        const btn = $('#btnSimpanEdit');

        if (!id) {
            Swal.fire('Gagal!', 'ID dokter tidak ditemukan.', 'error');
            return;
        }

        btn.prop('disabled', true).html(
            '<i class="fas fa-spinner fa-spin me-1"></i> Memperbarui...'
        );

        $.ajax({
            url: "{{ url('master-dokter') }}/" + id,
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            headers: { 'Accept': 'application/json' },

            success: function (response) {
                if (response.success === true) {
                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('modalEditDokter')
                    ).hide();

                    table.ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message || 'Data dokter berhasil diperbarui.',
                        timer: 1800,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire(
                        'Gagal!',
                        response.message || 'Data dokter gagal diperbarui.',
                        'error'
                    );
                }
            },

            error: function (xhr) {
                alertError(xhr);
            },

            complete: function () {
                btn.prop('disabled', false).html(
                    '<i class="fas fa-floppy-disk me-1"></i> Perbarui Data'
                );
            }
        });
    });

    // HAPUS DATA
    $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');

        if (!id) {
            Swal.fire('Gagal!', 'ID dokter tidak ditemukan.', 'error');
            return;
        }

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: 'Data dokter ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(function (result) {
            if (!result.isConfirmed) return;

            $.ajax({
                url: "{{ url('master-dokter') }}/" + id,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                dataType: 'json',
                headers: { 'Accept': 'application/json' },

                success: function (response) {
                    if (response.success === true) {
                        table.ajax.reload(null, false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: response.message || 'Data dokter berhasil dihapus.',
                            timer: 1800,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message || 'Data dokter gagal dihapus.',
                            'error'
                        );
                    }
                },

                error: function (xhr) {
                    alertError(xhr);
                }
            });
        });
    });

    // ERROR HANDLER
    function alertError(xhr) {
        let msg = 'Terjadi kesalahan pada server.';

        if (xhr.responseJSON) {
            if (xhr.responseJSON.errors) {
                msg = Object.values(xhr.responseJSON.errors).flat().join('\n');
            } else if (xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
        }

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: msg
        });
    }
});
</script>

@endsection
