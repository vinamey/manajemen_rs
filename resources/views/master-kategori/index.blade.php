@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard Master Kategori')

@section('content')

{{-- DATATABLE CSS --}}
<link
    rel="stylesheet"
    href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css"
>

{{-- SELECT2 CSS --}}
<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    .master-kategori-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 20px 18px;
    }

    /* HEADER */
    .kategori-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 17px;
        gap: 12px;
    }

    .kategori-title-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .kategori-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: var(--blue-light);
        color: var(--blue-main);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .kategori-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .kategori-subtitle {
        margin: 3px 0 0;
        font-size: 9px;
        color: var(--text-muted);
    }

    /* TAMBAH */
    .btn-tambah-kategori {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 7px;
        font-size: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .btn-tambah-kategori:hover {
        background: var(--blue-dark);
        color: white;
    }

    /* CARD */
    .kategori-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        padding-bottom: 10px;
    }

    .kategori-table-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    /* TABLE */
    .kategori-table {
        width: 100% !important;
        border-collapse: collapse !important;
        margin: 0 !important;
    }

    .kategori-table thead th {
        background: var(--blue-main) !important;
        color: white !important;
        font-size: 9px !important;
        font-weight: 600 !important;
        padding: 11px 10px !important;
        border: none !important;
        white-space: nowrap;
    }

    .kategori-table tbody td {
        padding: 10px !important;
        font-size: 9px !important;
        color: #6b7280;
        border-bottom: 1px solid #edf0f4 !important;
        vertical-align: middle !important;
        background: white;
    }

    .kategori-table tbody tr:hover td {
        background: #fafcff;
    }

    /* HILANGKAN SORTING ARROW */
    #kategori-table.dataTable thead th::before,
    #kategori-table.dataTable thead th::after {
        display: none !important;
        content: none !important;
    }

    #kategori-table.dataTable thead th {
        background-image: none !important;
        cursor: default !important;
    }

    /* BADGE KODE */
    .kode-kategori-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #e7f3ff;
        color: #1877f2;
        font-size: 8px;
        font-weight: 600;
    }

    /* BADGE NAMA */
    .nama-kategori-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 5px;
        background: #fff1e6;
        color: #e67e22;
        font-size: 8px;
        font-weight: 600;
    }

    /* AKSI */
    .aksi-wrapper {
        display: flex;
        gap: 5px;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .btn-aksi-kategori {
        border: none;
        border-radius: 5px;
        padding: 6px 9px;
        font-size: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        cursor: pointer;
        transition: .2s;
    }

    .btn-lihat-kategori {
        background: #e7f3ff;
        color: #1877f2;
    }

    .btn-edit-kategori {
        background: #1877f2;
        color: white;
    }

    .btn-hapus-kategori {
        background: #ff4b4b;
        color: white;
    }

    /* DATATABLE */
    .dataTables_wrapper {
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

    .dataTables_wrapper .dataTables_filter input {
        width: 190px;
        height: 31px;
        border: 1px solid #d4dce6;
        border-radius: 6px;
        padding: 5px 9px;
        font-size: 10px;
        outline: none;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: var(--blue-main);
    }

    .dataTables_wrapper .page-link {
        font-size: 9px;
        border-radius: 5px !important;
        padding: 5px 8px;
        box-shadow: none !important;
    }

    .dataTables_wrapper .page-item.active .page-link {
        background: var(--blue-main);
        border-color: var(--blue-main);
    }

    /* MODAL */
    .modal-kategori-besar {
        max-width: 560px !important;
    }

    .modal-kategori-besar .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,.18);
    }

    .modal-kategori-besar .modal-header {
        background: var(--blue-main);
        color: white;
        border: none;
        padding: 15px 20px;
    }

    .modal-kategori-besar .modal-title {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
    }

    .modal-kategori-besar .modal-body {
        padding: 22px 25px;
    }

    .modal-kategori-besar .modal-footer {
        background: #f8fafc;
        border: none;
        padding: 12px 20px;
        display: flex;
        justify-content: flex-end;
        gap: 7px;
    }

    /* FORM */
    .form-kategori-group {
        margin-bottom: 16px;
    }

    .form-kategori-label {
        display: block;
        font-size: 10px;
        font-weight: 500;
        color: #526071;
        margin-bottom: 6px;
    }

    .form-kategori-control {
        width: 100%;
        height: 40px;
        border: 1px solid #d4dce6;
        border-radius: 7px;
        padding: 8px 11px;
        font-size: 10px;
        outline: none;
    }

    .form-kategori-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.10);
    }

    /* DETAIL */
    .detail-kategori-value {
        width: 100%;
        min-height: 40px;
        border: 1px solid #e1e7ef;
        border-radius: 7px;
        padding: 9px 11px;
        font-size: 10px;
        background: #f8fafc;
        color: #374151;
    }

    /* BUTTON MODAL */
    .btn-batal-kategori {
        background: #f1f5f9;
        border: none;
        color: #526071;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
    }

    .btn-simpan-kategori {
        background: var(--blue-main);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
    }

    /* SELECT2 */
    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single {
        height: 40px !important;
        border: 1px solid #d4dce6 !important;
        border-radius: 7px !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__rendered {
        font-size: 10px !important;
        line-height: 38px !important;
        padding-left: 11px !important;
    }

    .select2-container--default
    .select2-selection--single
    .select2-selection__arrow {
        height: 38px !important;
    }

    .select2-results__option {
        font-size: 10px !important;
    }

    .select2-container--default
    .select2-results__option--highlighted[aria-selected] {
        background: #1877f2 !important;
    }

    /* DELETE MODAL */
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
        font-size: 22px;
    }

    .delete-text {
        text-align: center;
        font-size: 11px;
        color: #374151;
    }

    .btn-konfirmasi-hapus {
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 8px 13px;
        font-size: 9px;
        font-weight: 600;
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
        'Obat Tetes',
        'Obat Injeksi',
        'Obat Jantung',
        'Obat Hipertensi',
        'Obat Diabetes',
        'Obat Kolesterol',
        'Obat Asma',
        'Obat Alergi',
        'Obat Diare',
        'Obat Sakit Kepala'
    ];
@endphp


<div class="master-kategori-page">

    <div class="kategori-header">

        <div class="kategori-title-wrapper">

            <div class="kategori-icon">
                <i class="fas fa-tags"></i>
            </div>

            <div>
                <h2 class="kategori-title">
                    Master Kategori
                </h2>

                <p class="kategori-subtitle">
                    Data kategori yang terdaftar
                </p>
            </div>

        </div>

        <button
            type="button"
            class="btn-tambah-kategori"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahKategori"
        >
            <i class="fas fa-plus"></i>
            Tambah Kategori
        </button>

    </div>


    <div class="kategori-card">

        <div class="kategori-table-wrapper">

            <table
                id="kategori-table"
                class="kategori-table table align-middle"
            >

                <thead>
                    <tr>

                        <th
                            class="text-center"
                            style="width:70px;"
                        >
                            No
                        </th>

                        <th style="width:180px;">
                            Kode Kategori
                        </th>

                        <th>
                            Nama Kategori
                        </th>

                        <th
                            class="text-center"
                            style="width:220px;"
                        >
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH
========================================================= --}}
<div
    class="modal fade"
    id="modalTambahKategori"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-kategori-besar">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-tags"></i>
                    Tambah Kategori
                </h5>

            </div>


            <form
                id="formTambahKategori"
                action="{{ route('master-kategori.store') }}"
                method="POST"
            >

                @csrf

                <div class="modal-body">

                    <div class="form-kategori-group">

                        <label class="form-kategori-label">
                            Kode Kategori
                        </label>

                        <input
                            type="text"
                            name="kode"
                            id="tambahKode"
                            class="form-kategori-control"
                            placeholder="Masukkan kode kategori"
                            required
                        >

                    </div>


                    <div class="form-kategori-group">

                        <label class="form-kategori-label">
                            Nama Kategori
                        </label>

                        <select
                            name="nama"
                            id="namaKategori"
                            class="form-kategori-select2"
                            required
                        >

                            <option value="">
                                -- Cari / Pilih Kategori --
                            </option>

                            @foreach($daftarKategori as $namaKategori)

                                <option value="{{ $namaKategori }}">
                                    {{ $namaKategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-kategori"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        id="btnSimpanKategori"
                        class="btn-simpan-kategori"
                    >
                        <i class="fas fa-save"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- =========================================================
     MODAL LIHAT
========================================================= --}}
<div
    class="modal fade"
    id="modalLihatKategori"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-kategori-besar">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-eye"></i>
                    Detail Kategori
                </h5>

            </div>


            <div class="modal-body">

                <div class="form-kategori-group">

                    <label class="form-kategori-label">
                        Kode Kategori
                    </label>

                    <div
                        id="lihatKode"
                        class="detail-kategori-value"
                    >
                        -
                    </div>

                </div>


                <div class="form-kategori-group">

                    <label class="form-kategori-label">
                        Nama Kategori
                    </label>

                    <div
                        id="lihatNama"
                        class="detail-kategori-value"
                    >
                        -
                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-batal-kategori"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>
</div>


{{-- =========================================================
     MODAL EDIT
========================================================= --}}
<div
    class="modal fade"
    id="modalEditKategori"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-kategori-besar">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <i class="fas fa-edit"></i>
                    Edit Kategori
                </h5>

            </div>


            <form
                id="formEditKategori"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="modal-body">

                    <div class="form-kategori-group">

                        <label class="form-kategori-label">
                            Kode Kategori
                        </label>

                        <input
                            type="text"
                            name="kode"
                            id="editKode"
                            class="form-kategori-control"
                            required
                        >

                    </div>


                    <div class="form-kategori-group">

                        <label class="form-kategori-label">
                            Nama Kategori
                        </label>

                        <select
                            name="nama"
                            id="editNama"
                            class="form-kategori-select2"
                            required
                        >

                            <option value="">
                                -- Cari / Pilih Kategori --
                            </option>

                            @foreach($daftarKategori as $namaKategori)

                                <option value="{{ $namaKategori }}">
                                    {{ $namaKategori }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-batal-kategori"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        id="btnUpdateKategori"
                        class="btn-simpan-kategori"
                    >
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- =========================================================
     MODAL HAPUS
========================================================= --}}
<div
    class="modal fade"
    id="modalHapusKategori"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4">

            <div
                class="modal-header"
                style="
                    background:#ef4444;
                    color:white;
                    border:none;
                "
            >

                <h5
                    class="modal-title"
                    style="font-size:14px;"
                >
                    <i class="fas fa-trash"></i>
                    Konfirmasi Hapus
                </h5>

            </div>


            <div class="modal-body">

                <div class="delete-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

                <p class="delete-text">

                    Apakah kamu yakin ingin menghapus kategori

                    <strong id="hapusNamaKategori">
                        -
                    </strong>

                    ?

                </p>

            </div>


            <div class="modal-footer border-0">

                <button
                    type="button"
                    class="btn-batal-kategori"
                    data-bs-dismiss="modal"
                >
                    Batal
                </button>


                <button
                    type="button"
                    id="btnProsesHapus"
                    class="btn-konfirmasi-hapus"
                >
                    <i class="fas fa-trash"></i>
                    Ya, Hapus
                </button>

            </div>

        </div>

    </div>
</div>

@endsection


@push('scripts')

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- DATATABLE --}}
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

{{-- SELECT2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
$(document).ready(function () {

    const csrfToken = @json(csrf_token());


    /* =========================================================
       SELECT2 TAMBAH
    ========================================================= */
    $('#namaKategori').select2({

        placeholder:
            'Cari / Pilih Kategori',

        allowClear: true,

        width: '100%',

        dropdownParent:
            $('#modalTambahKategori')

    });


    /* =========================================================
       SELECT2 EDIT
    ========================================================= */
    $('#editNama').select2({

        placeholder:
            'Cari / Pilih Kategori',

        allowClear: true,

        width: '100%',

        dropdownParent:
            $('#modalEditKategori')

    });


    /* =========================================================
       DATATABLE
    ========================================================= */
    const table = $('#kategori-table').DataTable({

        processing: true,

        serverSide: true,

        /*
        |--------------------------------------------------------------------------
        | MATIKAN SORTING
        |--------------------------------------------------------------------------
        */
        ordering: false,

        ajax:
            "{{ route('master-kategori.data') }}",

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],


        columns: [

            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false,
                orderable: false,
                className: 'text-center'
            },


            {
                data: 'kode',
                name: 'kode',
                searchable: true,
                orderable: false,

                render: function (data) {

                    return `
                        <span class="kode-kategori-badge">
                            ${escapeHtml(data ?? '-')}
                        </span>
                    `;
                }
            },


            {
                data: 'nama',
                name: 'nama',
                searchable: true,
                orderable: false,

                render: function (data) {

                    return `
                        <span class="nama-kategori-badge">
                            ${escapeHtml(data ?? '-')}
                        </span>
                    `;
                }
            },


            {
                data: 'aksi',
                name: 'aksi',
                searchable: false,
                orderable: false,
                className: 'text-center'
            }

        ],


        language: {

            search: "",

            searchPlaceholder:
                "Cari kategori...",

            lengthMenu:
                "Tampilkan _MENU_ data",

            info:
                "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",

            infoEmpty:
                "Menampilkan 0 sampai 0 dari 0 data",

            emptyTable:
                "Belum ada data kategori",

            zeroRecords:
                "Data kategori tidak ditemukan",

            processing:
                "Memuat data...",

            paginate: {

                first: "Awal",

                last: "Akhir",

                next: "Lanjut",

                previous: "Kembali"

            }
        }

    });


    /* =========================================================
       ESCAPE HTML
    ========================================================= */
    function escapeHtml(value) {

        if (
            value === null ||
            value === undefined
        ) {
            return '';
        }

        return $('<div>')
            .text(value)
            .html();
    }


    /* =========================================================
       LIHAT
    ========================================================= */
    $('#kategori-table').on(
        'click',
        '.btn-lihat-kategori',
        function () {

            const data =
                table.row(
                    $(this).closest('tr')
                ).data();


            if (!data) {
                return;
            }


            $('#lihatKode').text(
                data.kode ?? '-'
            );


            $('#lihatNama').text(
                data.nama ?? '-'
            );


            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById(
                        'modalLihatKategori'
                    )
                );


            modal.show();

        }
    );


    /* =========================================================
       EDIT
    ========================================================= */
    $('#kategori-table').on(
        'click',
        '.btn-edit-kategori',
        function () {

            const data =
                table.row(
                    $(this).closest('tr')
                ).data();


            if (!data) {
                return;
            }


            $('#editKode').val(
                data.kode ?? ''
            );


            $('#editNama')
                .val(data.nama ?? '')
                .trigger('change');


            const baseUrl =
                @json(url('/master-kategori'));


            $('#formEditKategori').attr(
                'action',
                baseUrl + '/' + data.id
            );


            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById(
                        'modalEditKategori'
                    )
                );


            modal.show();

        }
    );


    /* =========================================================
       TAMBAH
    ========================================================= */
    $('#formTambahKategori').on(
        'submit',
        function (e) {

            e.preventDefault();


            const form = this;

            const btn =
                $('#btnSimpanKategori');


            btn.prop(
                'disabled',
                true
            );


            btn.html(`
                <i class="fas fa-spinner fa-spin"></i>
                Menyimpan...
            `);


            $.ajax({

                url: form.action,

                type: 'POST',

                data: $(form).serialize(),


                success: function (response) {

                    const modal =
                        bootstrap.Modal.getInstance(
                            document.getElementById(
                                'modalTambahKategori'
                            )
                        );


                    if (modal) {
                        modal.hide();
                    }


                    form.reset();


                    $('#namaKategori')
                        .val(null)
                        .trigger('change');


                    table.ajax.reload(
                        null,
                        false
                    );


                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil!',

                        text:
                            response.message ??
                            'Data kategori berhasil ditambahkan.',

                        confirmButtonColor:
                            '#1877f2'

                    });

                },


                error: function (xhr) {

                    let message =
                        'Terjadi kesalahan saat menyimpan data.';


                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        message =
                            Object.values(
                                xhr.responseJSON.errors
                            )
                            .flat()
                            .join('<br>');

                    } else if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;

                    }


                    Swal.fire({

                        icon: 'error',

                        title: 'Gagal',

                        html: message,

                        confirmButtonColor:
                            '#1877f2'

                    });

                },


                complete: function () {

                    btn.prop(
                        'disabled',
                        false
                    );


                    btn.html(`
                        <i class="fas fa-save"></i>
                        Simpan Data
                    `);

                }

            });

        }
    );


    /* =========================================================
       UPDATE
    ========================================================= */
    $('#formEditKategori').on(
        'submit',
        function (e) {

            e.preventDefault();


            const form = this;

            const btn =
                $('#btnUpdateKategori');


            btn.prop(
                'disabled',
                true
            );


            btn.html(`
                <i class="fas fa-spinner fa-spin"></i>
                Menyimpan...
            `);


            $.ajax({

                url: form.action,

                type: 'POST',

                data: $(form).serialize(),


                success: function (response) {

                    const modal =
                        bootstrap.Modal.getInstance(
                            document.getElementById(
                                'modalEditKategori'
                            )
                        );


                    if (modal) {
                        modal.hide();
                    }


                    table.ajax.reload(
                        null,
                        false
                    );


                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil!',

                        text:
                            response.message ??
                            'Data kategori berhasil diperbarui.',

                        confirmButtonColor:
                            '#1877f2'

                    });

                },


                error: function (xhr) {

                    let message =
                        'Terjadi kesalahan saat memperbarui data.';


                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.errors
                    ) {

                        message =
                            Object.values(
                                xhr.responseJSON.errors
                            )
                            .flat()
                            .join('<br>');

                    } else if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;

                    }


                    Swal.fire({

                        icon: 'error',

                        title: 'Gagal',

                        html: message,

                        confirmButtonColor:
                            '#1877f2'

                    });

                },


                complete: function () {

                    btn.prop(
                        'disabled',
                        false
                    );


                    btn.html(`
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    `);

                }

            });

        }
    );


    /* =========================================================
       PILIH DATA HAPUS
    ========================================================= */
    let deleteTargetUrl = '';


    $('#kategori-table').on(
        'click',
        '.btn-hapus-kategori',
        function () {

            const data =
                table.row(
                    $(this).closest('tr')
                ).data();


            if (!data) {
                return;
            }


            deleteTargetUrl =
                $(this).data('url');


            $('#hapusNamaKategori').text(
                data.nama ?? '-'
            );


            const modal =
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById(
                        'modalHapusKategori'
                    )
                );


            modal.show();

        }
    );


    /* =========================================================
       PROSES HAPUS
    ========================================================= */
    $('#btnProsesHapus').on(
        'click',
        function () {

            if (!deleteTargetUrl) {
                return;
            }


            const btn =
                $(this);


            btn.prop(
                'disabled',
                true
            );


            btn.html(`
                <i class="fas fa-spinner fa-spin"></i>
                Menghapus...
            `);


            $.ajax({

                url: deleteTargetUrl,

                type: 'POST',

                data: {

                    _token:
                        csrfToken,

                    _method:
                        'DELETE'

                },


                success: function (response) {

                    const modal =
                        bootstrap.Modal.getInstance(
                            document.getElementById(
                                'modalHapusKategori'
                            )
                        );


                    if (modal) {
                        modal.hide();
                    }


                    deleteTargetUrl = '';


                    table.ajax.reload(
                        null,
                        false
                    );


                    Swal.fire({

                        icon: 'success',

                        title: 'Terhapus!',

                        text:
                            response.message ??
                            'Data kategori berhasil dihapus.',

                        confirmButtonColor:
                            '#1877f2'

                    });

                },


                error: function (xhr) {

                    let message =
                        'Terjadi kesalahan saat menghapus data.';


                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;

                    }


                    Swal.fire({

                        icon: 'error',

                        title: 'Gagal Hapus',

                        text: message,

                        confirmButtonColor:
                            '#1877f2'

                    });

                },


                complete: function () {

                    btn.prop(
                        'disabled',
                        false
                    );


                    btn.html(`
                        <i class="fas fa-trash"></i>
                        Ya, Hapus
                    `);

                }

            });

        }
    );


    /* =========================================================
       RESET MODAL TAMBAH
    ========================================================= */
    $('#modalTambahKategori').on(
        'hidden.bs.modal',
        function () {

            document
                .getElementById(
                    'formTambahKategori'
                )
                .reset();


            $('#namaKategori')
                .val(null)
                .trigger('change');

        }
    );

});
</script>

@endpush
