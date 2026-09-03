@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Dokter')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light-bg: #e7f3ff;
        --blue-soft: #f0f7ff;
    }

    /* =========================================================
       GENERAL
    ========================================================= */

    .master-dokter {
        padding: 12px 0;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .page-header-dokter {
        margin-bottom: 22px;
    }

    .header-icon-box {
        width: 42px;
        height: 42px;
        background-color: var(--blue-light-bg);
        border-radius: 10px;

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
        line-height: 1.2;
    }

    .page-subtitle-dokter {
        font-size: 12px;
        color: #64748b;
        margin: 3px 0 0;
    }

    /* =========================================================
       BUTTON PRIMARY
    ========================================================= */

    .btn-blue-primary {
        background-color: var(--blue-main) !important;
        border: none !important;
        color: #ffffff !important;

        border-radius: 8px;
        padding: 9px 15px;

        font-size: 13px;
        font-weight: 600;

        transition: 0.2s ease;
    }

    .btn-blue-primary:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
    }

    /* =========================================================
       ALERT
    ========================================================= */

    .alert-dokter {
        border: none;
        border-left: 3px solid var(--blue-main);
        border-radius: 10px;

        background-color: #ffffff;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);

        padding: 12px 15px;
        margin-bottom: 18px;
    }

    /* =========================================================
       TABLE CARD
    ========================================================= */

    .card-table-dokter {
        border: none !important;
        border-radius: 12px !important;
        overflow: hidden;

        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05) !important;
    }

    .table-dokter {
        margin-bottom: 0;
    }

    .table-dokter thead th {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;

        border: none !important;

        font-size: 13px;
        font-weight: 600;

        padding: 14px 16px;
        white-space: nowrap;
    }

    .table-dokter tbody td {
        padding: 12px 16px;

        font-size: 13px;
        color: #475569;

        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .table-dokter tbody tr {
        transition: 0.15s ease;
    }

    .table-dokter tbody tr:hover {
        background-color: var(--blue-soft) !important;
    }

    /* =========================================================
       DOKTER NAME
    ========================================================= */

    .doctor-name {
        color: #1e293b;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .doctor-id {
        color: #94a3b8;
        font-size: 10px;
    }

    .avatar-dokter {
        width: 32px;
        height: 32px;

        border-radius: 50%;
        background-color: var(--blue-light-bg);
        color: var(--blue-main);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 13px;
        flex-shrink: 0;
    }

    /* =========================================================
       BADGES
    ========================================================= */

    .badge-blue-soft {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;

        font-size: 11px;
        font-weight: 500;

        padding: 6px 12px;
        border-radius: 6px;
    }

    .badge-green-soft {
        background-color: #dcfce7 !important;
        color: #15803d !important;

        font-size: 11px;
        font-weight: 500;

        padding: 6px 12px;
        border-radius: 6px;
    }

    .badge-gray-soft {
        background-color: #f1f5f9 !important;
        color: #64748b !important;

        font-size: 11px;
        font-weight: 500;

        padding: 6px 12px;
        border-radius: 6px;
    }

    /* =========================================================
       ACTION BUTTON
    ========================================================= */

    .btn-action-view {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;

        border: none !important;
        border-radius: 6px;

        font-size: 11px;
        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-view:hover {
        background-color: #bae6fd !important;
        color: #0369a1 !important;
    }

    .btn-action-edit {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 6px;

        font-size: 11px;
        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-edit:hover {
        background-color: var(--blue-dark) !important;
        color: #ffffff !important;
    }

    .btn-action-delete {
        background-color: #ef4444 !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 6px;

        font-size: 11px;
        font-weight: 500;

        padding: 6px 10px;
    }

    .btn-action-delete:hover {
        background-color: #dc2626 !important;
        color: #ffffff !important;
    }

    /* =========================================================
       MODAL
    ========================================================= */

    .modal-dokter .modal-dialog {
        max-width: 460px;
    }

    .modal-dokter .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;

        box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
    }

    .modal-dokter .modal-header {
        background-color: var(--blue-main);
        color: #ffffff;

        border: none;

        padding: 15px 18px;
    }

    .modal-dokter .modal-title {
        font-size: 16px;
        font-weight: 700;
    }

    .modal-dokter .modal-body {
        padding: 20px 18px;
        background-color: #ffffff;
    }

    .modal-dokter .modal-footer {
        background-color: #f8fafc;
        border: none;

        padding: 12px 18px;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .form-label-dokter {
        display: block;

        font-size: 11px;
        font-weight: 600;

        color: #64748b;

        margin-bottom: 6px;
    }

    .form-control-dokter,
    .form-select-dokter {
        width: 100%;

        border: 1px solid #d7e0ea;
        border-radius: 8px;

        padding: 9px 11px;

        font-size: 12px;
        color: #334155;

        background-color: #ffffff;

        transition: 0.2s ease;
    }

    .form-control-dokter:focus,
    .form-select-dokter:focus {
        border-color: var(--blue-main);

        box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.12);

        outline: none;
    }

    textarea.form-control-dokter {
        min-height: 78px;
        resize: vertical;
    }

    .form-group-dokter {
        margin-bottom: 13px;
    }

    .btn-modal-cancel {
        background-color: #f1f5f9 !important;
        color: #64748b !important;

        border: none !important;
        border-radius: 7px;

        padding: 8px 15px;

        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-cancel:hover {
        background-color: #e2e8f0 !important;
    }

    .btn-modal-save {
        background-color: var(--blue-main) !important;
        color: #ffffff !important;

        border: none !important;
        border-radius: 7px;

        padding: 8px 16px;

        font-size: 12px;
        font-weight: 600;
    }

    .btn-modal-save:hover {
        background-color: var(--blue-dark) !important;
    }

    /* =========================================================
       EMPTY TABLE
    ========================================================= */

    .empty-dokter {
        padding: 45px 20px !important;
        color: #94a3b8 !important;
    }
</style>


<div class="container-fluid master-dokter">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center page-header-dokter">

        <div class="d-flex align-items-center gap-3">

            <div class="header-icon-box">
                <i class="fas fa-user-md"></i>
            </div>

            <div>
                <h3 class="page-title-dokter">
                    Master Dokter
                </h3>

                <p class="page-subtitle-dokter">
                    Data dokter yang terdaftar
                </p>
            </div>

        </div>

        <button
            type="button"
            class="btn btn-blue-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahDokter"
        >
            <i class="fas fa-plus me-1"></i>
            Tambah Dokter
        </button>

    </div>


    {{-- =====================================================
         TABLE
    ====================================================== --}}

    <div class="card card-table-dokter">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-dokter align-middle">

                    <thead>

                        <tr>
                            <th class="text-center" width="50">
                                No
                            </th>

                            <th>
                                Nama Dokter
                            </th>

                            <th>
                                Jenis Kelamin
                            </th>

                            <th>
                                Tanggal Lahir
                            </th>

                            <th>
                                Spesialis
                            </th>

                            <th>
                                Alamat
                            </th>

                            <th>
                                Poli
                            </th>

                            <th class="text-center" width="220">
                                Aksi
                            </th>
                        </tr>

                    </thead>


                    <tbody id="tabelDokter">

                        @forelse($dokters as $dokter)

                            @php
                                $poliDokter = $polis->firstWhere(
                                    'id',
                                    $dokter->poli_id
                                );
                            @endphp

                            <tr id="dokter-{{ $dokter->id }}">

                                <td class="text-center nomor text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- NAMA --}}

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="avatar-dokter">
                                            <i class="fas fa-user-md"></i>
                                        </div>

                                        <div>

                                            <div class="doctor-name data-nama">
                                                {{ $dokter->nama }}
                                            </div>

                                            <div class="doctor-id">
                                                ID: {{ $dokter->id }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- JENIS KELAMIN --}}

                                <td>

                                    @if($dokter->jenis_kelamin === 'laki-laki')

                                        <span class="badge badge-blue-soft data-jenis-kelamin">
                                            Laki-laki
                                        </span>

                                    @else

                                        <span class="badge badge-blue-soft data-jenis-kelamin">
                                            Perempuan
                                        </span>

                                    @endif

                                </td>


                                {{-- TANGGAL LAHIR --}}

                                <td>
                                    <span class="data-tanggal-lahir">
                                        {{ $dokter->tanggal_lahir }}
                                    </span>
                                </td>


                                {{-- SPESIALIS --}}

                                <td>

                                    <span class="data-spesialis">
                                        {{ $dokter->spesialis ?? '-' }}
                                    </span>

                                </td>


                                {{-- ALAMAT --}}

                                <td>

                                    <span class="data-alamat">
                                        {{ $dokter->alamat ?? '-' }}
                                    </span>

                                </td>


                                {{-- POLI --}}

                                <td>

                                    <span class="badge badge-green-soft data-poli">
                                        {{ $poliDokter->nama ?? '-' }}
                                    </span>

                                </td>


                                {{-- AKSI --}}

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-1">

                                        {{-- LIHAT --}}

                                        <a
                                            href="{{ route('master-dokter.show', $dokter->id) }}"
                                            class="btn btn-sm btn-action-view"
                                        >
                                            <i class="fas fa-eye me-1"></i>
                                            Lihat
                                        </a>


                                        {{-- EDIT --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-edit btn-edit"

                                            data-id="{{ $dokter->id }}"
                                            data-nama="{{ $dokter->nama }}"
                                            data-jenis_kelamin="{{ $dokter->jenis_kelamin }}"
                                            data-tanggal_lahir="{{ $dokter->tanggal_lahir }}"
                                            data-spesialis="{{ $dokter->spesialis }}"
                                            data-alamat="{{ $dokter->alamat }}"
                                            data-poli_id="{{ $dokter->poli_id }}"
                                        >
                                            <i class="fas fa-edit me-1"></i>
                                            Edit
                                        </button>


                                        {{-- HAPUS --}}

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-action-delete btn-hapus"

                                            data-id="{{ $dokter->id }}"
                                            data-nama="{{ $dokter->nama }}"
                                        >
                                            <i class="fas fa-trash me-1"></i>
                                            Hapus
                                        </button>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr id="barisKosong">

                                <td
                                    colspan="8"
                                    class="text-center empty-dokter"
                                >
                                    <i class="fas fa-user-md fa-2x mb-2 d-block"></i>

                                    Belum ada data dokter
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL TAMBAH DOKTER
========================================================= --}}

<div
    class="modal fade modal-dokter"
    id="modalTambahDokter"
    tabindex="-1"
    aria-labelledby="modalTambahDokterLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER MODAL --}}

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-plus"></i>

                    <h5
                        class="modal-title"
                        id="modalTambahDokterLabel"
                    >
                        Tambah Dokter
                    </h5>

                </div>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- FORM --}}

            <form id="formTambahDokter">

                @csrf

                <div class="modal-body">


                    {{-- NAMA --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_nama"
                            class="form-label-dokter"
                        >
                            Nama Dokter
                        </label>

                        <input
                            type="text"
                            id="tambah_nama"
                            name="nama"
                            class="form-control-dokter"
                            placeholder="Masukkan nama dokter"
                            required
                        >

                    </div>


                    {{-- JENIS KELAMIN --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_jenis_kelamin"
                            class="form-label-dokter"
                        >
                            Jenis Kelamin
                        </label>

                        <select
                            id="tambah_jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select-dokter"
                            required
                        >

                            <option value="">
                                -- Pilih Jenis Kelamin --
                            </option>

                            <option value="laki-laki">
                                Laki-laki
                            </option>

                            <option value="perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>


                    {{-- TANGGAL LAHIR --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_tanggal_lahir"
                            class="form-label-dokter"
                        >
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="tambah_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >

                    </div>


                    {{-- SPESIALIS --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_spesialis"
                            class="form-label-dokter"
                        >
                            Spesialis
                        </label>

                        <input
                            type="text"
                            id="tambah_spesialis"
                            name="spesialis"
                            class="form-control-dokter"
                            placeholder="Masukkan spesialis"
                        >

                    </div>


                    {{-- ALAMAT --}}

                    <div class="form-group-dokter">

                        <label
                            for="tambah_alamat"
                            class="form-label-dokter"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="tambah_alamat"
                            name="alamat"
                            class="form-control-dokter"
                            rows="3"
                            placeholder="Ketikkan alamat lengkap..."
                        ></textarea>

                    </div>


                    {{-- POLI --}}

                    <div class="form-group-dokter mb-0">

                        <label
                            for="tambah_poli_id"
                            class="form-label-dokter"
                        >
                            Poli
                        </label>

                        <select
                            id="tambah_poli_id"
                            name="poli_id"
                            class="form-select-dokter"
                        >

                            <option value="">
                                -- Pilih Poli --
                            </option>

                            @foreach($polis as $poli)

                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save"
                        id="btnSimpanTambah"
                    >
                        <i class="fas fa-save me-1"></i>
                        Simpan Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     MODAL EDIT DOKTER
========================================================= --}}

<div
    class="modal fade modal-dokter"
    id="modalEditDokter"
    tabindex="-1"
    aria-labelledby="modalEditDokterLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER --}}

            <div class="modal-header">

                <div class="d-flex align-items-center gap-2">

                    <i class="fas fa-user-edit"></i>

                    <h5
                        class="modal-title"
                        id="modalEditDokterLabel"
                    >
                        Edit Dokter
                    </h5>

                </div>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            {{-- FORM EDIT --}}

            <form id="formEditDokter">

                @csrf

                <input
                    type="hidden"
                    id="edit_id"
                >


                <div class="modal-body">


                    {{-- NAMA --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_nama"
                            class="form-label-dokter"
                        >
                            Nama Dokter
                        </label>

                        <input
                            type="text"
                            id="edit_nama"
                            name="nama"
                            class="form-control-dokter"
                            required
                        >

                    </div>


                    {{-- JENIS KELAMIN --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_jenis_kelamin"
                            class="form-label-dokter"
                        >
                            Jenis Kelamin
                        </label>

                        <select
                            id="edit_jenis_kelamin"
                            name="jenis_kelamin"
                            class="form-select-dokter"
                            required
                        >

                            <option value="laki-laki">
                                Laki-laki
                            </option>

                            <option value="perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>


                    {{-- TANGGAL LAHIR --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_tanggal_lahir"
                            class="form-label-dokter"
                        >
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="edit_tanggal_lahir"
                            name="tanggal_lahir"
                            class="form-control-dokter"
                            required
                        >

                    </div>


                   {{-- SPESIALIS --}}
<div class="form-group-dokter">
    <label
        for="edit_spesialis"
        class="form-label-dokter"
    >
        Spesialis
    </label>

    <input
        type="text"
        id="edit_spesialis"
        class="form-control-dokter"
        readonly
        style="background-color: #f8fafc; cursor: not-allowed;"
    >
</div>
                    {{-- ALAMAT --}}

                    <div class="form-group-dokter">

                        <label
                            for="edit_alamat"
                            class="form-label-dokter"
                        >
                            Alamat
                        </label>

                        <textarea
                            id="edit_alamat"
                            name="alamat"
                            class="form-control-dokter"
                            rows="3"
                            placeholder="Ketikkan alamat lengkap..."
                        ></textarea>

                    </div>


                    {{-- POLI --}}

                    <div class="form-group-dokter mb-0">

                        <label
                            for="edit_poli_id"
                            class="form-label-dokter"
                        >
                            Poli
                        </label>

                        <select
                            id="edit_poli_id"
                            name="poli_id"
                            class="form-select-dokter"
                        >

                            <option value="">
                                -- Pilih Poli --
                            </option>

                            @foreach($polis as $poli)

                                <option value="{{ $poli->id }}">
                                    {{ $poli->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- FOOTER --}}

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-modal-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-modal-save"
                        id="btnSimpanEdit"
                    >
                        <i class="fas fa-save me-1"></i>
                        Update Data
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- =========================================================
     SWEETALERT
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    /* ========================================================
       CSRF
    ======================================================== */

    const csrfInput = document.querySelector(
        '#formTambahDokter input[name="_token"]'
    );

    const csrfToken = csrfInput
        ? csrfInput.value
        : '';


    /* ========================================================
       URL
    ======================================================== */

    const storeUrl = @json(route('master-dokter.store'));

    const baseUrl = @json(url('master-dokter'));


    /* ========================================================
       FORM TAMBAH
    ======================================================== */

    const formTambah = document.getElementById(
        'formTambahDokter'
    );

    formTambah.addEventListener('submit', function (e) {

        e.preventDefault();

        const button = document.getElementById(
            'btnSimpanTambah'
        );

        button.disabled = true;

        button.innerHTML =
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';


        const formData = new FormData(formTambah);


        fetch(storeUrl, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },

            body: formData

        })

        .then(async response => {

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;

        })

        .then(data => {

            const modalElement = document.getElementById(
                'modalTambahDokter'
            );

            const modal = bootstrap.Modal.getInstance(
                modalElement
            );

            if (modal) {
                modal.hide();
            }


            formTambah.reset();


            const barisKosong = document.getElementById(
                'barisKosong'
            );

            if (barisKosong) {
                barisKosong.remove();
            }


            tambahBarisKeTabel(data.data);

            perbaruiNomor();


            /* SUCCESS POPUP */

            Swal.fire({

                icon: 'success',

                title: 'Berhasil!',

                text: data.message || 'Data dokter berhasil ditambahkan.',

                timer: 1800,

                showConfirmButton: false,

                allowOutsideClick: false

            });


            button.disabled = false;

            button.innerHTML =
                '<i class="fas fa-save me-1"></i> Simpan Data';

        })

        .catch(error => {

            tampilkanError(error);

            button.disabled = false;

            button.innerHTML =
                '<i class="fas fa-save me-1"></i> Simpan Data';

        });

    });


    /* ========================================================
       EVENT EDIT AWAL
    ======================================================== */

    document.querySelectorAll('.btn-edit').forEach(button => {

        pasangEventEdit(button);

    });


    /* ========================================================
       FORM EDIT
    ======================================================== */

    const formEdit = document.getElementById(
        'formEditDokter'
    );

    formEdit.addEventListener('submit', function (e) {

        e.preventDefault();

        const id = document.getElementById(
            'edit_id'
        ).value;


        const button = document.getElementById(
            'btnSimpanEdit'
        );

        button.disabled = true;

        button.innerHTML =
            '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';


        const formData = new FormData(formEdit);

        formData.append('_method', 'PUT');


        fetch(baseUrl + '/' + id, {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },

            body: formData

        })

        .then(async response => {

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;

        })

        .then(data => {

            updateBarisTabel(data.data);


            const modalElement = document.getElementById(
                'modalEditDokter'
            );

            const modal = bootstrap.Modal.getInstance(
                modalElement
            );

            if (modal) {
                modal.hide();
            }


            /* SUCCESS POPUP */

            Swal.fire({

                icon: 'success',

                title: 'Berhasil!',

                text: data.message || 'Data dokter berhasil diperbarui.',

                timer: 1800,

                showConfirmButton: false,

                allowOutsideClick: false

            });


            button.disabled = false;

            button.innerHTML =
                '<i class="fas fa-save me-1"></i> Update Data';

        })

        .catch(error => {

            tampilkanError(error);

            button.disabled = false;

            button.innerHTML =
                '<i class="fas fa-save me-1"></i> Update Data';

        });

    });


    /* ========================================================
       EVENT HAPUS AWAL
    ======================================================== */

    document.querySelectorAll('.btn-hapus').forEach(button => {

        pasangEventHapus(button);

    });


    /* ========================================================
       TAMBAH BARIS
    ======================================================== */

    function tambahBarisKeTabel(dokter) {

        const tabel = document.getElementById(
            'tabelDokter'
        );


        let namaPoli = '-';


        @foreach($polis as $poli)

            if (dokter.poli_id == {{ $poli->id }}) {

                namaPoli = @json($poli->nama);

            }

        @endforeach


        const row = document.createElement('tr');

        row.id = 'dokter-' + dokter.id;


        row.innerHTML = `

            <td class="text-center nomor text-muted">
                1
            </td>

            <td>

                <div class="d-flex align-items-center gap-2">

                    <div class="avatar-dokter">
                        <i class="fas fa-user-md"></i>
                    </div>

                    <div>

                        <div class="doctor-name data-nama">
                            ${escapeHtml(dokter.nama)}
                        </div>

                        <div class="doctor-id">
                            ID: ${escapeHtml(dokter.id)}
                        </div>

                    </div>

                </div>

            </td>

            <td>

                <span class="badge badge-blue-soft data-jenis-kelamin">
                    ${ucfirst(dokter.jenis_kelamin)}
                </span>

            </td>

            <td>

                <span class="data-tanggal-lahir">
                    ${escapeHtml(dokter.tanggal_lahir)}
                </span>

            </td>

            <td>

                <span class="data-spesialis">
                    ${escapeHtml(dokter.spesialis || '-')}
                </span>

            </td>

            <td>

                <span class="data-alamat">
                    ${escapeHtml(dokter.alamat || '-')}
                </span>

            </td>

            <td>

                <span class="badge badge-green-soft data-poli">
                    ${escapeHtml(namaPoli)}
                </span>

            </td>

            <td class="text-center">

                <div class="d-flex justify-content-center gap-1">

                    <a
                        href="${baseUrl}/${dokter.id}"
                        class="btn btn-sm btn-action-view"
                    >
                        <i class="fas fa-eye me-1"></i>
                        Lihat
                    </a>

                    <button
                        type="button"
                        class="btn btn-sm btn-action-edit btn-edit"

                        data-id="${escapeAttr(dokter.id)}"
                        data-nama="${escapeAttr(dokter.nama)}"
                        data-jenis_kelamin="${escapeAttr(dokter.jenis_kelamin)}"
                        data-tanggal_lahir="${escapeAttr(dokter.tanggal_lahir)}"
                        data-spesialis="${escapeAttr(dokter.spesialis || '')}"
                        data-alamat="${escapeAttr(dokter.alamat || '')}"
                        data-poli_id="${escapeAttr(dokter.poli_id || '')}"
                    >
                        <i class="fas fa-edit me-1"></i>
                        Edit
                    </button>

                    <button
                        type="button"
                        class="btn btn-sm btn-action-delete btn-hapus"

                        data-id="${escapeAttr(dokter.id)}"
                        data-nama="${escapeAttr(dokter.nama)}"
                    >
                        <i class="fas fa-trash me-1"></i>
                        Hapus
                    </button>

                </div>

            </td>
        `;


        tabel.prepend(row);


        const editButton = row.querySelector(
            '.btn-edit'
        );

        const hapusButton = row.querySelector(
            '.btn-hapus'
        );


        pasangEventEdit(editButton);

        pasangEventHapus(hapusButton);

    }


    /* ========================================================
       UPDATE BARIS
    ======================================================== */

    function updateBarisTabel(dokter) {

        const row = document.getElementById(
            'dokter-' + dokter.id
        );


        if (!row) {
            return;
        }


        let namaPoli = '-';


        @foreach($polis as $poli)

            if (dokter.poli_id == {{ $poli->id }}) {

                namaPoli = @json($poli->nama);

            }

        @endforeach


        row.querySelector(
            '.data-nama'
        ).innerText = dokter.nama;


        row.querySelector(
            '.data-jenis-kelamin'
        ).innerText = ucfirst(
            dokter.jenis_kelamin
        );


        row.querySelector(
            '.data-tanggal-lahir'
        ).innerText = dokter.tanggal_lahir;


        row.querySelector(
            '.data-spesialis'
        ).innerText = dokter.spesialis || '-';


        row.querySelector(
            '.data-alamat'
        ).innerText = dokter.alamat || '-';


        row.querySelector(
            '.data-poli'
        ).innerText = namaPoli;


        const editButton = row.querySelector(
            '.btn-edit'
        );


        editButton.dataset.nama =
            dokter.nama;

        editButton.dataset.jenis_kelamin =
            dokter.jenis_kelamin;

        editButton.dataset.tanggal_lahir =
            dokter.tanggal_lahir;

        editButton.dataset.spesialis =
            dokter.spesialis || '';

        editButton.dataset.alamat =
            dokter.alamat || '';

        editButton.dataset.poli_id =
            dokter.poli_id || '';

    }


    /* ========================================================
       EVENT EDIT
    ======================================================== */

    function pasangEventEdit(button) {

        if (!button) {
            return;
        }


        button.addEventListener('click', function () {

            document.getElementById(
                'edit_id'
            ).value = this.dataset.id;


            document.getElementById(
                'edit_nama'
            ).value = this.dataset.nama || '';


            document.getElementById(
                'edit_jenis_kelamin'
            ).value =
                this.dataset.jenis_kelamin || '';


            document.getElementById(
                'edit_tanggal_lahir'
            ).value =
                this.dataset.tanggal_lahir || '';


            document.getElementById(
                'edit_spesialis'
            ).value =
                this.dataset.spesialis || '';


            document.getElementById(
                'edit_alamat'
            ).value =
                this.dataset.alamat || '';


            document.getElementById(
                'edit_poli_id'
            ).value =
                this.dataset.poli_id || '';


            const modalElement = document.getElementById(
                'modalEditDokter'
            );


            const modal = new bootstrap.Modal(
                modalElement
            );


            modal.show();

        });

    }


    /* ========================================================
       EVENT HAPUS
    ======================================================== */

    function pasangEventHapus(button) {

        if (!button) {
            return;
        }


        button.addEventListener('click', function () {

            const id = this.dataset.id;

            const nama = this.dataset.nama;


            Swal.fire({

                title: 'Hapus dokter?',

                text:
                    'Data "' +
                    nama +
                    '" akan dihapus.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonText: 'Ya, hapus',

                cancelButtonText: 'Batal',

                reverseButtons: true

            })

            .then(result => {

                if (!result.isConfirmed) {
                    return;
                }


                fetch(baseUrl + '/' + id, {

                    method: 'DELETE',

                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }

                })

                .then(async response => {

                    const data =
                        await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    return data;

                })

                .then(data => {

                    const row =
                        document.getElementById(
                            'dokter-' + id
                        );


                    if (row) {
                        row.remove();
                    }


                    perbaruiNomor();


                    Swal.fire({

                        icon: 'success',

                        title: 'Berhasil!',

                        text:
                            data.message ||
                            'Data dokter berhasil dihapus.',

                        timer: 1800,

                        showConfirmButton: false

                    });

                })

                .catch(error => {

                    tampilkanError(error);

                });

            });

        });

    }


    /* ========================================================
       NOMOR OTOMATIS
    ======================================================== */

    function perbaruiNomor() {

        const rows = document.querySelectorAll(
            '#tabelDokter tr'
        );


        rows.forEach((row, index) => {

            const nomor =
                row.querySelector('.nomor');


            if (nomor) {

                nomor.innerText =
                    index + 1;

            }

        });

    }


    /* ========================================================
       ERROR
    ======================================================== */

    function tampilkanError(error) {

        let pesan = 'Terjadi kesalahan.';


        if (error.errors) {

            pesan =
                Object.values(error.errors)
                    .flat()
                    .join('<br>');

        } else if (error.message) {

            pesan = error.message;

        }


        Swal.fire({

            icon: 'error',

            title: 'Gagal!',

            html: pesan

        });

    }


    /* ========================================================
       UC FIRST
    ======================================================== */

    function ucfirst(text) {

        if (!text) {
            return '';
        }


        return text.charAt(0).toUpperCase() +
            text.slice(1);

    }


    /* ========================================================
       ESCAPE HTML
    ======================================================== */

    function escapeHtml(text) {

        if (
            text === null ||
            text === undefined
        ) {
            return '';
        }


        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }


    /* ========================================================
       ESCAPE ATTRIBUTE
    ======================================================== */

    function escapeAttr(text) {

        return escapeHtml(text);

    }

});

</script>

@endsection
