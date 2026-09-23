@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Satuan Obat')

@section('content')

<style>
    /* ================= GLOBAL ================= */
    .satuan-page {
        padding: 0;
    }

    /* ================= HEADER ================= */
    .satuan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .satuan-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .satuan-icon {
        width: 42px;
        height: 42px;
        background: #e7f3ff;
        color: #1877f2;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .satuan-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
    }

    .satuan-subtitle {
        margin: 3px 0 0;
        font-size: 11px;
        color: #8b95a5;
    }

    /* ================= TOMBOL TAMBAH ================= */
    .btn-tambah-satuan {
        background: #1877f2;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-tambah-satuan:hover {
        background: #0f58c6;
        color: white;
    }

    /* ================= TABLE ================= */
    .satuan-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .satuan-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .satuan-table thead {
        background: #1877f2;
        color: white;
    }

    .satuan-table thead th {
        padding: 14px 13px;
        font-size: 11px;
        font-weight: 700;
        border: none;
        white-space: nowrap;
    }

    .satuan-table tbody td {
        padding: 13px;
        font-size: 11px;
        color: #657184;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f5;
        white-space: nowrap;
    }

    .satuan-table tbody tr:last-child td {
        border-bottom: none;
    }

    .satuan-table tbody tr:hover {
        background: #f8fbff;
    }

    .satuan-table strong {
        color: #374151;
        font-weight: 600;
    }

    .satuan-table small {
        color: #9ca3af;
        font-size: 10px;
    }

    /* ================= BADGE KODE ================= */
    .badge-kode {
        display: inline-block;
        background: #e7f3ff;
        color: #1877f2;
        border-radius: 6px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 600;
    }

    /* ================= TOMBOL AKSI ================= */
    .btn-satuan-aksi {
        border: none;
        border-radius: 6px;
        padding: 8px 10px;
        font-size: 10px;
        font-weight: 600;
        margin-right: 3px;
        min-width: 48px;
    }

    .btn-satuan-lihat {
        background: #dff1ff;
        color: #087db5;
    }

    .btn-satuan-lihat:hover {
        background: #c7e8fc;
        color: #087db5;
    }

    .btn-satuan-edit {
        background: #1877f2;
        color: white;
    }

    .btn-satuan-edit:hover {
        background: #0f58c6;
        color: white;
    }

    .btn-satuan-hapus {
        background: #ef4444;
        color: white;
    }

    .btn-satuan-hapus:hover {
        background: #dc2626;
        color: white;
    }

    /* ================= MODAL ================= */
    .satuan-modal .modal-dialog {
        max-width: 520px;
    }

    .satuan-modal .modal-content {
        border: none;
        border-radius: 12px;
        overflow: visible !important;
    }

    .satuan-modal .modal-header {
        background: #1877f2;
        color: white;
        padding: 15px 20px;
        border-radius: 12px 12px 0 0;
    }

    .satuan-modal .modal-title {
        font-size: 15px;
        font-weight: 600;
    }

    .satuan-modal .modal-body {
        padding: 20px;
        overflow: visible !important;
    }

    .satuan-modal .modal-footer {
        padding: 14px 20px;
        border-radius: 0 0 12px 12px;
    }

    .satuan-modal .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
    }

    .satuan-modal .form-control {
        font-size: 12px;
        border-radius: 7px;
        padding: 9px 11px;
    }

    .satuan-modal .form-control:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.15);
    }

    /* ================= CUSTOM DROPDOWN ================= */

    .custom-select-wrapper {
        position: relative;
        width: 100%;
        z-index: 100;
    }

    .custom-select-button {
        width: 100%;
        min-height: 40px;
        padding: 9px 38px 9px 11px;
        background: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 7px;
        font-size: 12px;
        color: #495057;
        text-align: left;
        cursor: pointer;
        position: relative;
    }

    .custom-select-button:hover {
        border-color: #1877f2;
    }

    .custom-select-button.active {
        border-color: #1877f2;
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.15);
    }

    .custom-select-arrow {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        color: #6c757d;
        pointer-events: none;
    }

    /* INI YANG MEMBUAT LIST SELALU TURUN */
    .custom-select-list {
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        width: 100%;
        background: white;
        border: 1px solid #ced4da;
        border-radius: 7px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.15);
        z-index: 99999;
        display: none;
        max-height: 230px;
        overflow-y: auto;
    }

    .custom-select-list.show {
        display: block;
    }

    .custom-option {
        padding: 10px 12px;
        font-size: 12px;
        color: #374151;
        background: white;
        cursor: pointer;
        transition: 0.15s;
    }

    .custom-option:hover {
        background: #e7f3ff;
        color: #1877f2;
    }

    .custom-option.selected {
        background: #1877f2;
        color: white;
    }

    .custom-option.placeholder {
        color: #8b95a5;
    }

    /* ================= DETAIL ================= */
    .detail-item {
        margin-bottom: 16px;
    }

    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 13px;
        color: #657184;
    }

    /* HILANGKAN X */
    .satuan-modal .btn-close {
        display: none !important;
    }
</style>


<div class="satuan-page">

    {{-- ================= HEADER ================= --}}
    <div class="satuan-header">

        <div class="satuan-title-wrapper">

            <div class="satuan-icon">
                <i class="fas fa-box"></i>
            </div>

            <div>
                <h2 class="satuan-title">
                    Master Satuan Obat
                </h2>

                <p class="satuan-subtitle">
                    Data satuan obat yang terdaftar
                </p>
            </div>

        </div>

        <button type="button"
                class="btn btn-tambah-satuan"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

            <i class="fas fa-plus me-1"></i>
            Tambah Satuan

        </button>

    </div>


    {{-- ================= TABLE ================= --}}
    <div class="satuan-card">

        <div class="table-responsive">

            <table class="satuan-table">

                <thead>

                    <tr>

                        <th width="8%">No</th>

                        <th width="25%">
                            Kode Satuan
                        </th>

                        <th width="35%">
                            Nama Satuan
                        </th>

                        <th width="32%">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($satuans as $satuan)

                        <tr id="row{{ $satuan->id }}">

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <span class="badge-kode">
                                    {{ $satuan->kode ?? '-' }}
                                </span>

                            </td>

                            <td>

                                <strong>
                                    {{ $satuan->nama }}
                                </strong>

                                <br>

                               

                            </td>

                            <td>

                                {{-- LIHAT --}}
                                <button type="button"
                                        class="btn btn-satuan-aksi btn-satuan-lihat"
                                        onclick="lihatData({{ $satuan->id }})">

                                    <i class="fas fa-eye me-1"></i>
                                    Lihat

                                </button>


                                {{-- EDIT --}}
                                <button type="button"
                                        class="btn btn-satuan-aksi btn-satuan-edit"
                                        onclick="editData(
                                            {{ $satuan->id }},
                                            @js($satuan->kode),
                                            @js($satuan->nama)
                                        )">

                                    <i class="fas fa-edit me-1"></i>
                                    Edit

                                </button>


                                {{-- HAPUS --}}
                                <button type="button"
                                        class="btn btn-satuan-aksi btn-satuan-hapus"
                                        onclick="hapusData({{ $satuan->id }})">

                                    <i class="fas fa-trash me-1"></i>
                                    Hapus

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
                                class="text-center py-5 text-muted">

                                Belum ada data satuan obat.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL TAMBAH --}}
{{-- ========================================================= --}}

<div class="modal fade satuan-modal"
     id="modalTambah"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-plus-circle me-2"></i>
                    Tambah Satuan Obat
                </h5>

            </div>


            <form id="formTambah">

                @csrf

                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Kode Satuan
                        </label>

                        <input type="text"
                               name="kode"
                               id="kode"
                               class="form-control"
                               placeholder="Contoh: TAB"
                               required>

                    </div>


                    {{-- NAMA SATUAN --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Satuan
                        </label>

                        <div class="custom-select-wrapper">

                            <input type="hidden"
                                   name="nama"
                                   id="nama"
                                   required>

                            <button type="button"
                                    class="custom-select-button"
                                    id="namaButton">

                                <span id="namaText">
                                    -- Pilih Satuan --
                                </span>

                                <i class="fas fa-chevron-down custom-select-arrow"></i>

                            </button>


                            <div class="custom-select-list"
                                 id="namaList">

                                <div class="custom-option placeholder"
                                     data-value="">
                                    -- Pilih Satuan --
                                </div>

                                <div class="custom-option"
                                     data-value="Tablet">
                                    Tablet
                                </div>

                                <div class="custom-option"
                                     data-value="Kapsul">
                                    Kapsul
                                </div>

                                <div class="custom-option"
                                     data-value="Keping">
                                    Keping
                                </div>

                                <div class="custom-option"
                                     data-value="Strip">
                                    Strip
                                </div>

                                <div class="custom-option"
                                     data-value="Botol">
                                    Botol
                                </div>

                                <div class="custom-option"
                                     data-value="Tube">
                                    Tube
                                </div>

                                <div class="custom-option"
                                     data-value="Ampul">
                                    Ampul
                                </div>

                                <div class="custom-option"
                                     data-value="Vial">
                                    Vial
                                </div>

                                <div class="custom-option"
                                     data-value="Sachet">
                                    Sachet
                                </div>

                                <div class="custom-option"
                                     data-value="Pcs">
                                    Pcs
                                </div>

                                <div class="custom-option"
                                     data-value="Box">
                                    Box
                                </div>

                                <div class="custom-option"
                                     data-value="Dus">
                                    Dus
                                </div>

                                <div class="custom-option"
                                     data-value="Pot">
                                    Pot
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL LIHAT --}}
{{-- ========================================================= --}}

<div class="modal fade satuan-modal"
     id="modalLihat"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-eye me-2"></i>
                    Detail Satuan Obat

                </h5>

            </div>


            <div class="modal-body">

                <div class="detail-item">

                    <div class="detail-label">
                        Kode Satuan
                    </div>

                    <div class="detail-value"
                         id="lihatKode">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        Nama Satuan
                    </div>

                    <div class="detail-value"
                         id="lihatNama">
                        -
                    </div>

                </div>


                <div class="detail-item">

                    <div class="detail-label">
                        ID
                    </div>

                    <div class="detail-value"
                         id="lihatId">
                        -
                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL EDIT --}}
{{-- ========================================================= --}}

<div class="modal fade satuan-modal"
     id="modalEdit"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fas fa-edit me-2"></i>
                    Edit Satuan Obat

                </h5>

            </div>


            <form id="formEdit">

                @csrf
                @method('PUT')

                <input type="hidden"
                       id="editId">


                <div class="modal-body">

                    {{-- KODE --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Kode Satuan
                        </label>

                        <input type="text"
                               name="kode"
                               id="editKode"
                               class="form-control"
                               required>

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Nama Satuan
                        </label>


                        <div class="custom-select-wrapper">

                            <input type="hidden"
                                   name="nama"
                                   id="editNama"
                                   required>


                            <button type="button"
                                    class="custom-select-button"
                                    id="editNamaButton">

                                <span id="editNamaText">
                                    -- Pilih Satuan --
                                </span>

                                <i class="fas fa-chevron-down custom-select-arrow"></i>

                            </button>


                            <div class="custom-select-list"
                                 id="editNamaList">

                                <div class="custom-option placeholder"
                                     data-value="">
                                    -- Pilih Satuan --
                                </div>

                                <div class="custom-option"
                                     data-value="Tablet">
                                    Tablet
                                </div>

                                <div class="custom-option"
                                     data-value="Kapsul">
                                    Kapsul
                                </div>

                                <div class="custom-option"
                                     data-value="Keping">
                                    Keping
                                </div>

                                <div class="custom-option"
                                     data-value="Strip">
                                    Strip
                                </div>

                                <div class="custom-option"
                                     data-value="Botol">
                                    Botol
                                </div>

                                <div class="custom-option"
                                     data-value="Tube">
                                    Tube
                                </div>

                                <div class="custom-option"
                                     data-value="Ampul">
                                    Ampul
                                </div>

                                <div class="custom-option"
                                     data-value="Vial">
                                    Vial
                                </div>

                                <div class="custom-option"
                                     data-value="Sachet">
                                    Sachet
                                </div>

                                <div class="custom-option"
                                     data-value="Pcs">
                                    Pcs
                                </div>

                                <div class="custom-option"
                                     data-value="Box">
                                    Box
                                </div>

                                <div class="custom-option"
                                     data-value="Dus">
                                    Dus
                                </div>

                                <div class="custom-option"
                                     data-value="Pot">
                                    Pot
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       CUSTOM DROPDOWN TAMBAH
    ===================================================== */

    const namaButton = document.getElementById('namaButton');
    const namaList = document.getElementById('namaList');
    const namaInput = document.getElementById('nama');
    const namaText = document.getElementById('namaText');


    namaButton.addEventListener('click', function (e) {

        e.stopPropagation();

        namaList.classList.toggle('show');

        namaButton.classList.toggle(
            'active',
            namaList.classList.contains('show')
        );

    });


    namaList.querySelectorAll('.custom-option').forEach(function (option) {

        option.addEventListener('click', function () {

            const value = this.dataset.value;
            const text = this.textContent.trim();

            namaInput.value = value;

            namaText.textContent = text;

            namaList.querySelectorAll('.custom-option')
                .forEach(function (item) {
                    item.classList.remove('selected');
                });

            this.classList.add('selected');

            namaList.classList.remove('show');

            namaButton.classList.remove('active');

        });

    });


    /* =====================================================
       CUSTOM DROPDOWN EDIT
    ===================================================== */

    const editNamaButton =
        document.getElementById('editNamaButton');

    const editNamaList =
        document.getElementById('editNamaList');

    const editNamaInput =
        document.getElementById('editNama');

    const editNamaText =
        document.getElementById('editNamaText');


    editNamaButton.addEventListener('click', function (e) {

        e.stopPropagation();

        editNamaList.classList.toggle('show');

        editNamaButton.classList.toggle(
            'active',
            editNamaList.classList.contains('show')
        );

    });


    editNamaList.querySelectorAll('.custom-option').forEach(function (option) {

        option.addEventListener('click', function () {

            const value = this.dataset.value;
            const text = this.textContent.trim();

            editNamaInput.value = value;

            editNamaText.textContent = text;

            editNamaList.querySelectorAll('.custom-option')
                .forEach(function (item) {
                    item.classList.remove('selected');
                });

            this.classList.add('selected');

            editNamaList.classList.remove('show');

            editNamaButton.classList.remove('active');

        });

    });


    /* =====================================================
       TUTUP DROPDOWN JIKA KLIK DI LUAR
    ===================================================== */

    document.addEventListener('click', function () {

        namaList.classList.remove('show');
        namaButton.classList.remove('active');

        editNamaList.classList.remove('show');
        editNamaButton.classList.remove('active');

    });


    /* =====================================================
       TAMBAH DATA
    ===================================================== */

    document.getElementById('formTambah')
        .addEventListener('submit', function (e) {

        e.preventDefault();

        if (!namaInput.value) {

            alert('Silakan pilih nama satuan terlebih dahulu.');

            return;
        }


        fetch("{{ route('master-satuan.store') }}", {

            method: "POST",

            headers: {

                "X-CSRF-TOKEN":
                    "{{ csrf_token() }}",

                "Accept":
                    "application/json",

                "Content-Type":
                    "application/x-www-form-urlencoded"

            },

            body:
                new URLSearchParams(
                    new FormData(this)
                )

        })

        .then(response => response.json())

        .then(response => {

            alert(
                response.message ||
                'Data berhasil disimpan.'
            );

            this.reset();

            namaInput.value = '';

            namaText.textContent =
                '-- Pilih Satuan --';

            bootstrap.Modal
                .getInstance(
                    document.getElementById('modalTambah')
                )
                .hide();

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal disimpan.');

        });

    });


    /* =====================================================
       LIHAT DATA
    ===================================================== */

    window.lihatData = function (id) {

        fetch(
            "{{ url('/master-satuan') }}/" + id,
            {
                headers: {
                    "Accept": "application/json"
                }
            }
        )

        .then(response => response.json())

        .then(response => {

            document.getElementById('lihatKode')
                .textContent =
                response.data.kode || '-';

            document.getElementById('lihatNama')
                .textContent =
                response.data.nama || '-';

            document.getElementById('lihatId')
                .textContent =
                response.data.id || '-';


            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById('modalLihat')
                );

            modal.show();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal ditampilkan.');

        });

    };


    /* =====================================================
       EDIT DATA
    ===================================================== */

    window.editData = function (id, kode, nama) {

        document.getElementById('editId').value =
            id;

        document.getElementById('editKode').value =
            kode || '';

        document.getElementById('editNama').value =
            nama || '';

        editNamaText.textContent =
            nama || '-- Pilih Satuan --';


        editNamaList
            .querySelectorAll('.custom-option')
            .forEach(function (option) {

                option.classList.remove('selected');

                if (option.dataset.value === nama) {
                    option.classList.add('selected');
                }

            });


        const modal =
            bootstrap.Modal.getOrCreateInstance(
                document.getElementById('modalEdit')
            );

        modal.show();

    };


    /* =====================================================
       SIMPAN EDIT
    ===================================================== */

    document.getElementById('formEdit')
        .addEventListener('submit', function (e) {

        e.preventDefault();

        if (!editNamaInput.value) {

            alert('Silakan pilih nama satuan terlebih dahulu.');

            return;
        }


        const id =
            document.getElementById('editId').value;


        fetch(
            "{{ url('/master-satuan') }}/" + id,
            {

                method: "POST",

                headers: {

                    "X-CSRF-TOKEN":
                        "{{ csrf_token() }}",

                    "Accept":
                        "application/json",

                    "Content-Type":
                        "application/x-www-form-urlencoded"

                },

                body:
                    new URLSearchParams(
                        new FormData(this)
                    )

            }
        )

        .then(response => response.json())

        .then(response => {

            alert(
                response.message ||
                'Data berhasil diperbarui.'
            );

            bootstrap.Modal
                .getInstance(
                    document.getElementById('modalEdit')
                )
                .hide();

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal diperbarui.');

        });

    });


    /* =====================================================
       HAPUS DATA
    ===================================================== */

    window.hapusData = function (id) {

        if (!confirm(
            'Yakin ingin menghapus data ini?'
        )) {
            return;
        }


        fetch(
            "{{ url('/master-satuan') }}/" + id,
            {

                method: "DELETE",

                headers: {

                    "X-CSRF-TOKEN":
                        "{{ csrf_token() }}",

                    "Accept":
                        "application/json"

                }

            }
        )

        .then(response => response.json())

        .then(response => {

            alert(
                response.message ||
                'Data berhasil dihapus.'
            );

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal dihapus.');

        });

    };

});
</script>

@endsection
