@extends('layouts.superadmin')

@section('page-title', 'Dashboard Pemeriksaan Dokter')

@section('content')

<style>

    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --blue-soft: #f4f8ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
    }

    body {
        background: #f4f6fa;
    }

    .page-header {
        background: linear-gradient(
            135deg,
            #1877f2,
            #0f58c6
        );
        color: white;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(24, 119, 242, 0.18);
    }

    .page-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .page-header p {
        margin: 5px 0 0;
        opacity: .85;
    }

    .card-main {
        border: none;
        border-radius: 18px;
        background: white;
        box-shadow: 0 5px 20px rgba(0,0,0,.06);
        overflow: hidden;
    }

    .card-header-custom {
        padding: 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header-custom h5 {
        margin: 0;
        font-weight: 700;
        color: var(--text-dark);
    }

    .btn-blue {
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 10px 17px;
        border-radius: 9px;
        font-weight: 600;
    }

    .btn-blue:hover {
        background: var(--blue-dark);
        color: white;
    }

    .table thead th {
        background: var(--blue-light);
        color: var(--blue-dark);
        font-weight: 700;
        border: none;
        white-space: nowrap;
    }

    .table tbody td {
        vertical-align: middle;
        color: #374151;
    }

    .badge-blue {
        background: var(--blue-light);
        color: var(--blue-dark);
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 600;
    }

    .modal-content {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0,0,0,.18);
    }

    .modal-header-blue {
        background: linear-gradient(
            135deg,
            #1877f2,
            #0f58c6
        );
        color: white;
        padding: 18px 22px;
    }

    .modal-header-blue h5 {
        margin: 0;
        font-weight: 700;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
    }

    .form-control,
    .form-select {
        border-radius: 9px;
        border: 1px solid #dbe2ea;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 .2rem rgba(24,119,242,.12);
    }

    .resep-box {
        background: var(--blue-soft);
        border: 1px solid #dbeafe;
        border-radius: 13px;
        padding: 15px;
    }

    .table-resep {
        background: white;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-resep thead th {
        background: var(--blue-light);
        font-size: 13px;
    }

    .empty-resep {
        text-align: center;
        color: #9ca3af;
        padding: 25px;
    }

    .btn-add-obat {
        background: var(--blue-main);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 15px;
        font-weight: 600;
    }

    .btn-add-obat:hover {
        background: var(--blue-dark);
        color: white;
    }

</style>


{{-- ========================================================= --}}
{{-- HEADER --}}
{{-- ========================================================= --}}

<div class="page-header">

    <h3>
        <i class="fa-solid fa-stethoscope me-2"></i>
        Dashboard Pemeriksaan Dokter
    </h3>

    <p>
        Kelola pemeriksaan pasien dan resep obat dokter.
    </p>

</div>


{{-- ========================================================= --}}
{{-- NOTIFIKASI --}}
{{-- ========================================================= --}}

@if(session('success'))

    <div class="alert alert-success">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
    </div>

@endif


@if($errors->any())

    <div class="alert alert-danger">

        <strong>Terjadi kesalahan:</strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- ========================================================= --}}
{{-- CARD TABLE --}}
{{-- ========================================================= --}}

<div class="card-main">

    <div class="card-header-custom">

        <h5>
            <i class="fa-solid fa-notes-medical me-2 text-primary"></i>
            Data Pemeriksaan Dokter
        </h5>

        <button
            type="button"
            class="btn-blue"
            data-bs-toggle="modal"
            data-bs-target="#modalTambahPemeriksaan"
        >

            <i class="fa-solid fa-plus me-1"></i>

            Tambah Pemeriksaan

        </button>

    </div>


    <div class="table-responsive">

        <table class="table table-hover mb-0">

            <thead>

                <tr>

                    <th width="60">No</th>

                    <th>Pasien</th>

                    <th>Dokter</th>

                    <th>Keluhan</th>

                    <th>Tanggal</th>

                    <th width="100">Aksi</th>

                </tr>

            </thead>


            <tbody>

                @forelse($pemeriksaans as $pemeriksaan)

                    <tr>

                        <td>
                            {{ $pemeriksaans->firstItem() + $loop->index }}
                        </td>


                        <td>

                            <strong>

                                {{ $pemeriksaan->pendaftaran->pasien->nama ?? '-' }}

                            </strong>

                        </td>


                        <td>

                            {{ $pemeriksaan->dokter->nama ?? '-' }}

                        </td>


                        <td>

                            {{ $pemeriksaan->keluhan ?? '-' }}

                        </td>


                        <td>

                            <span class="badge-blue">

                                {{ $pemeriksaan->created_at
                                    ? $pemeriksaan->created_at->format('d/m/Y')
                                    : '-'
                                }}

                            </span>

                        </td>


                        <td>

                            <a
                                href="{{ route('pemeriksaan-dokter.show', $pemeriksaan->id) }}"
                                class="btn btn-sm btn-primary"
                            >

                                <i class="fa-solid fa-eye"></i>

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="text-center py-5 text-muted"
                        >

                            <i
                                class="fa-solid fa-file-medical fa-2x mb-2"
                            ></i>

                            <br>

                            Belum ada data pemeriksaan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- PAGINATION --}}

    @if($pemeriksaans->hasPages())

        <div class="p-3">

            {{ $pemeriksaans->links() }}

        </div>

    @endif

</div>



{{-- ========================================================= --}}
{{-- MODAL TAMBAH PEMERIKSAAN --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalTambahPemeriksaan"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-xl modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header modal-header-blue">

                <h5>

                    <i class="fa-solid fa-file-medical me-2"></i>

                    Tambah Pemeriksaan Dokter

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <form
                action="{{ route('pemeriksaan-dokter.store') }}"
                method="POST"
                id="formPemeriksaan"
            >

                @csrf


                <div class="modal-body">

                    {{-- ================================================= --}}
                    {{-- DATA PEMERIKSAAN --}}
                    {{-- ================================================= --}}

                    <div class="row g-3">


                        {{-- PASIEN --}}

                        <div class="col-md-6">

                            <label class="form-label">

                                Pasien

                            </label>

                            <select
                                name="pendaftaran_id"
                                id="pendaftaran_id"
                                class="form-select"
                                required
                            >

                                <option value="">

                                    -- Pilih Pasien --

                                </option>


                                @foreach($pendaftarans as $pendaftaran)

                                    <option
                                        value="{{ $pendaftaran->id }}"
                                    >

                                        {{ $pendaftaran->pasien->nama ?? 'Pasien tidak ditemukan' }}

                                        @if($pendaftaran->nomor_antrian)

                                            - Antrian {{ $pendaftaran->nomor_antrian }}

                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- DOKTER --}}

                        <div class="col-md-6">

                            <label class="form-label">

                                Dokter

                            </label>

                            <select
                                name="dokter_id"
                                id="dokter_id"
                                class="form-select"
                                required
                            >

                                <option value="">

                                    -- Pilih Dokter --

                                </option>


                                @foreach($dokters as $dokter)

                                    <option
                                        value="{{ $dokter->id }}"
                                    >

                                        {{ $dokter->nama }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- KELUHAN --}}

                        <div class="col-12">

                            <label class="form-label">

                                Keluhan

                            </label>

                            <textarea
                                name="keluhan"
                                id="keluhan"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan keluhan pasien..."
                            ></textarea>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- ================================================= --}}
                    {{-- RESEP OBAT --}}
                    {{-- ================================================= --}}

                    <div class="resep-box">


                        <div class="d-flex justify-content-between align-items-center mb-3">

                            <div>

                                <h5 class="mb-1">

                                    <i class="fa-solid fa-pills text-primary me-2"></i>

                                    Resep Obat

                                </h5>

                                <small class="text-muted">

                                    Tambahkan obat yang diresepkan dokter.

                                </small>

                            </div>


                            <button
                                type="button"
                                class="btn-add-obat"
                                data-bs-toggle="modal"
                                data-bs-target="#modalTambahObat"
                            >

                                <i class="fa-solid fa-plus me-1"></i>

                                Tambah Obat

                            </button>

                        </div>


                        {{-- HIDDEN JSON --}}

                        <input
                            type="hidden"
                            name="resep_obat"
                            id="resep_obat"
                        >


                        <div class="table-responsive table-resep">

                            <table class="table table-bordered mb-0">

                                <thead>

                                    <tr>

                                        <th width="50">No</th>

                                        <th>Obat</th>

                                        <th>Jumlah</th>

                                        <th>Dosis</th>

                                        <th>Frekuensi</th>

                                        <th>Aturan Pakai</th>

                                        <th>Lama</th>

                                        <th width="70">Aksi</th>

                                    </tr>

                                </thead>


                                <tbody id="resepTableBody">

                                    <tr id="resepKosong">

                                        <td
                                            colspan="8"
                                            class="empty-resep"
                                        >

                                            <i class="fa-solid fa-pills fa-2x mb-2"></i>

                                            <br>

                                            Belum ada obat yang ditambahkan.

                                        </td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="fa-solid fa-save me-1"></i>

                        Simpan Pemeriksaan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL TAMBAH OBAT --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalTambahObat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header modal-header-blue">

                <h5>

                    <i class="fa-solid fa-pills me-2"></i>

                    Tambah Obat Resep

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body">

                <div class="row g-3">


                    {{-- OBAT --}}

                    <div class="col-12">

                        <label class="form-label">

                            Obat

                        </label>

                        <select
                            id="obat_id"
                            class="form-select"
                        >

                            <option value="">

                                -- Pilih Obat --

                            </option>


                            @foreach($obats ?? [] as $obat)

                                <option
                                    value="{{ $obat->id }}"
                                >

                                    {{ $obat->nama }}

                                    @if($obat->kategori)

                                        - {{ $obat->kategori->nama }}

                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- JUMLAH --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Jumlah Obat

                        </label>

                        <input
                            type="number"
                            id="jumlah_obat"
                            class="form-control"
                            min="1"
                            placeholder="Contoh: 10"
                        >

                    </div>


                    {{-- DOSIS --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Dosis

                        </label>

                        <input
                            type="text"
                            id="dosis_obat"
                            class="form-control"
                            placeholder="Contoh: 500 mg"
                        >

                    </div>


                    {{-- FREKUENSI --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Frekuensi

                        </label>

                        <input
                            type="text"
                            id="frekuensi_obat"
                            class="form-control"
                            placeholder="Contoh: 3"
                        >

                    </div>


                    {{-- LAMA --}}

                    <div class="col-md-6">

                        <label class="form-label">

                            Lama Pemakaian

                        </label>

                        <input
                            type="number"
                            id="lama_obat"
                            class="form-control"
                            min="1"
                            placeholder="Contoh: 5"
                        >

                    </div>


                    {{-- ATURAN PAKAI --}}

                    <div class="col-12">

                        <label class="form-label">

                            Aturan Pakai

                        </label>

                        <input
                            type="text"
                            id="aturan_pakai"
                            class="form-control"
                            placeholder="Contoh: Sesudah makan"
                        >

                    </div>

                </div>

            </div>


            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                >

                    Batal

                </button>


                <button
                    type="button"
                    class="btn btn-primary"
                    onclick="tambahkanObat()"
                >

                    <i class="fa-solid fa-plus me-1"></i>

                    Tambahkan Obat

                </button>

            </div>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

let daftarObat = [];


/*
|--------------------------------------------------------------------------
| Tambahkan obat ke daftar
|--------------------------------------------------------------------------
*/

function tambahkanObat()
{

    const selectObat =
        document.getElementById('obat_id');

    const jumlah =
        document.getElementById('jumlah_obat').value;

    const dosis =
        document.getElementById('dosis_obat').value;

    const frekuensi =
        document.getElementById('frekuensi_obat').value;

    const aturan =
        document.getElementById('aturan_pakai').value;

    const lama =
        document.getElementById('lama_obat').value;


    /*
    |--------------------------------------------------------------------------
    | Validasi
    |--------------------------------------------------------------------------
    */

    if (!selectObat.value) {

        alert('Silakan pilih obat terlebih dahulu.');

        return;
    }


    if (!jumlah) {

        alert('Silakan isi jumlah obat.');

        return;
    }


    if (!dosis) {

        alert('Silakan isi dosis obat.');

        return;
    }


    if (!frekuensi) {

        alert('Silakan isi frekuensi obat.');

        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Ambil nama obat
    |--------------------------------------------------------------------------
    */

    const namaObat =
        selectObat.options[
            selectObat.selectedIndex
        ].text;


    /*
    |--------------------------------------------------------------------------
    | Masukkan ke array
    |--------------------------------------------------------------------------
    */

    daftarObat.push({

        obat_id: selectObat.value,

        nama_obat: namaObat,

        jumlah: jumlah,

        dosis: dosis,

        frekuensi: frekuensi,

        aturan_pakai: aturan,

        lama: lama

    });


    /*
    |--------------------------------------------------------------------------
    | Tampilkan tabel
    |--------------------------------------------------------------------------
    */

    tampilkanObat();


    /*
    |--------------------------------------------------------------------------
    | Reset form obat
    |--------------------------------------------------------------------------
    */

    document.getElementById('obat_id').value = '';

    document.getElementById('jumlah_obat').value = '';

    document.getElementById('dosis_obat').value = '';

    document.getElementById('frekuensi_obat').value = '';

    document.getElementById('aturan_pakai').value = '';

    document.getElementById('lama_obat').value = '';


    /*
    |--------------------------------------------------------------------------
    | Tutup modal obat
    |--------------------------------------------------------------------------
    */

    const modalObat =
        bootstrap.Modal.getInstance(
            document.getElementById('modalTambahObat')
        );

    if (modalObat) {

        modalObat.hide();

    }

}


/*
|--------------------------------------------------------------------------
| Tampilkan daftar obat
|--------------------------------------------------------------------------
*/

function tampilkanObat()
{

    const tbody =
        document.getElementById('resepTableBody');


    tbody.innerHTML = '';


    if (daftarObat.length === 0) {

        tbody.innerHTML = `

            <tr id="resepKosong">

                <td
                    colspan="8"
                    class="empty-resep"
                >

                    <i class="fa-solid fa-pills fa-2x mb-2"></i>

                    <br>

                    Belum ada obat yang ditambahkan.

                </td>

            </tr>

        `;

        return;
    }


    daftarObat.forEach(function(obat, index)
    {

        const row =
            document.createElement('tr');


        row.innerHTML = `

            <td>
                ${index + 1}
            </td>

            <td>
                <strong>
                    ${obat.nama_obat}
                </strong>
            </td>

            <td>
                ${obat.jumlah}
            </td>

            <td>
                ${obat.dosis}
            </td>

            <td>
                ${obat.frekuensi} x sehari
            </td>

            <td>
                ${obat.aturan_pakai || '-'}
            </td>

            <td>
                ${obat.lama
                    ? obat.lama + ' hari'
                    : '-'
                }
            </td>

            <td>

                <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    onclick="hapusObat(${index})"
                >

                    <i class="fa-solid fa-trash"></i>

                </button>

            </td>

        `;


        tbody.appendChild(row);

    });


    /*
    |--------------------------------------------------------------------------
    | Simpan array ke hidden input
    |--------------------------------------------------------------------------
    */

    document.getElementById('resep_obat').value =
        JSON.stringify(daftarObat);

}


/*
|--------------------------------------------------------------------------
| Hapus obat
|--------------------------------------------------------------------------
*/

function hapusObat(index)
{

    daftarObat.splice(index, 1);

    tampilkanObat();

}


/*
|--------------------------------------------------------------------------
| Sebelum submit
|--------------------------------------------------------------------------
*/

document.getElementById('formPemeriksaan')
    .addEventListener('submit', function()
    {

        document.getElementById('resep_obat').value =
            JSON.stringify(daftarObat);

    });


/*
|--------------------------------------------------------------------------
| Saat modal pemeriksaan dibuka lagi
|--------------------------------------------------------------------------
*/

document
    .getElementById('modalTambahPemeriksaan')
    .addEventListener(
        'shown.bs.modal',
        function()
        {

            tampilkanObat();

        }
    );

</script>

@endsection
