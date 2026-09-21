@extends('layouts.superadmin')

@section('page-title', 'Dashboard Pemeriksaan Dokter')

@section('content')

<style>
    /* =========================
       JUDUL
    ========================= */
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #212529;
        margin-bottom: 4px;
    }

    .page-subtitle {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 22px;
    }

    /* =========================
       CARD UTAMA
    ========================= */
    .main-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        overflow: hidden;
    }

    /* =========================
       HEADER CARD
    ========================= */
    .card-header-custom {
        background: #0d6efd;
        color: white;
        padding: 14px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title-custom {
        margin: 0;
        font-size: 20px;
        font-weight: 600;
    }

    .btn-tambah {
        background: #198754;
        color: white;
        border: none;
        border-radius: 6px;
        padding: 9px 15px;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-tambah:hover {
        background: #157347;
        color: white;
    }

    /* =========================
       FILTER
    ========================= */
    .filter-area {
        padding: 18px 15px;
        border-bottom: 1px solid #e9ecef;
    }

    .filter-label {
        font-size: 13px;
        color: #495057;
        margin-bottom: 5px;
    }

    .form-control,
    .form-select {
        border-radius: 6px;
        font-size: 14px;
        min-height: 38px;
    }

    /* =========================
       TABLE
    ========================= */
    .table-wrapper {
        overflow-x: auto;
    }

    .table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #0d6efd !important;
        color: white !important;
        font-size: 13px;
        font-weight: 600;
        padding: 13px 10px;
        white-space: nowrap;
        border: none;
    }

    .table tbody td {
        font-size: 13px;
        padding: 12px 10px;
        border-color: #e9ecef;
    }

    .table tbody tr:hover {
        background-color: #f8fbff;
    }

    /* =========================
       BADGE
    ========================= */
    .badge-antrian {
        background: #e7f1ff;
        color: #0d6efd;
        padding: 5px 8px;
        border-radius: 5px;
        font-weight: 600;
    }

    .badge-dokter {
        background: #eef7ff;
        color: #1769aa;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .badge-poli {
        background: #e9f7ef;
        color: #198754;
        padding: 5px 8px;
        border-radius: 5px;
    }

    .badge-resep {
        background: #fff3cd;
        color: #856404;
        padding: 5px 8px;
        border-radius: 5px;
    }

    /* =========================
       ACTION
    ========================= */
    .action-wrapper {
        display: flex;
        justify-content: center;
        gap: 5px;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-show {
        background: #0dcaf0;
        color: white;
    }

    .btn-edit {
        background: #ffc107;
        color: #212529;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    /* =========================
       MODAL
    ========================= */
    .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,.25);
    }

    .modal-header-custom {
        background: #0d6efd;
        color: white;
        padding: 15px 18px;
    }

    .modal-title {
        font-size: 17px;
        font-weight: 600;
    }

    .modal-body {
        padding: 22px;
    }

    .modal-footer {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        padding: 13px 18px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    /* =========================
       RESEP
    ========================= */
    .resep-box {
        margin-top: 20px;
        border: 1px solid #cfe2ff;
        border-radius: 8px;
        overflow: hidden;
    }

    .resep-header {
        background: #f0f7ff;
        padding: 12px 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .resep-title {
        color: #0d6efd;
        font-weight: 600;
        font-size: 15px;
    }

    .btn-tambah-obat {
        background: #0d6efd;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 7px 11px;
        font-size: 12px;
    }

    .resep-table th {
        background: #f8f9fa !important;
        color: #495057 !important;
        font-size: 12px !important;
        border-bottom: 1px solid #dee2e6 !important;
    }

    .resep-table td {
        font-size: 12px;
    }

    .resep-kosong {
        text-align: center;
        padding: 30px 15px;
        color: #6c757d;
    }

    .resep-kosong i {
        font-size: 32px;
        color: #adb5bd;
        margin-bottom: 8px;
    }

    /* =========================
       MODAL TAMBAH OBAT
    ========================= */
    .obat-modal .modal-header {
        background: #0d6efd;
        color: white;
    }

    .obat-info {
        background: #f8f9fa;
        border-radius: 6px;
        padding: 10px;
        font-size: 12px;
        color: #6c757d;
        margin-top: 7px;
    }
</style>


<div class="container-fluid">

    {{-- JUDUL --}}
    <h1 class="page-title">
        Pemeriksaan Dokter
    </h1>

    <div class="page-subtitle">
        Kelola hasil pemeriksaan pasien
    </div>


    {{-- ALERT --}}
    @if (session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- CARD --}}
    <div class="main-card">

        {{-- HEADER --}}
        <div class="card-header-custom">

            <h5 class="card-title-custom">
                Pemeriksaan Dokter
            </h5>

            <button
                type="button"
                class="btn btn-tambah"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPemeriksaan"
            >
                <i class="fa-solid fa-plus me-1"></i>
                Tambah Pemeriksaan
            </button>

        </div>


        {{-- TABLE --}}
        <div class="table-wrapper">

            <table class="table">

                <thead>

                    <tr>

                        <th class="text-center">No</th>

                        <th>No. Antrian</th>

                        <th>Nama Pasien</th>

                        <th>Dokter</th>

                        <th>Poli</th>

                        <th>Keluhan</th>

                        <th class="text-center">Resep</th>

                        <th class="text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse ($pemeriksaans as $index => $pemeriksaan)

                        <tr>

                            <td class="text-center">
                                {{ $index + 1 }}
                            </td>


                            <td>

                                @if ($pemeriksaan->pendaftaran)

                                    <span class="badge-antrian">
                                        {{ $pemeriksaan->pendaftaran->nomor_antrian }}
                                    </span>

                                @else
                                    -
                                @endif

                            </td>


                            <td>

                                {{ $pemeriksaan->pendaftaran->pasien->nama ?? '-' }}

                            </td>


                            <td>

                                @if ($pemeriksaan->dokter)

                                    <span class="badge-dokter">
                                        <i class="fa-solid fa-user-doctor me-1"></i>
                                        {{ $pemeriksaan->dokter->nama }}
                                    </span>

                                @else
                                    -
                                @endif

                            </td>


                            <td>

                                @if ($pemeriksaan->pendaftaran->poli ?? null)

                                    <span class="badge-poli">
                                        {{ $pemeriksaan->pendaftaran->poli->nama }}
                                    </span>

                                @else
                                    -
                                @endif

                            </td>


                            <td>

                                {{ \Illuminate\Support\Str::limit($pemeriksaan->keluhan, 45) }}

                            </td>


                            <td class="text-center">

                                @if ($pemeriksaan->resep_obat)

                                    <span class="badge-resep">
                                        <i class="fa-solid fa-pills me-1"></i>
                                        {{ $pemeriksaan->resep_obat }}
                                    </span>

                                @else
                                    -
                                @endif

                            </td>


                            <td>

                                <div class="action-wrapper">

                                    <a
                                        href="{{ route('pemeriksaan-dokter.show', $pemeriksaan->id) }}"
                                        class="btn-action btn-show"
                                        title="Lihat"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('pemeriksaan-dokter.edit', $pemeriksaan->id) }}"
                                        class="btn-action btn-edit"
                                        title="Edit"
                                    >
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <form
                                        action="{{ route('pemeriksaan-dokter.destroy', $pemeriksaan->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pemeriksaan ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-action btn-delete"
                                            title="Hapus"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5 text-muted"
                            >

                                <i class="fa-solid fa-stethoscope fs-2 d-block mb-2"></i>

                                Belum ada data pemeriksaan dokter.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

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

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">


            {{-- HEADER MODAL --}}
            <div class="modal-header modal-header-custom">

                <h5 class="modal-title">

                    <i class="fa-solid fa-stethoscope me-2"></i>

                    Tambah Pemeriksaan Dokter

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            {{-- FORM --}}
            <form
                action="{{ route('pemeriksaan-dokter.store') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">

                    {{-- PASIEN + DOKTER --}}
                    <div class="row g-3">


                        {{-- PASIEN --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Pasien / No. Antrian
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="pendaftaran_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    -- Pilih Pasien --
                                </option>

                                @foreach ($pendaftarans ?? [] as $pendaftaran)

                                    <option value="{{ $pendaftaran->id }}">

                                        {{ $pendaftaran->nomor_antrian }}
                                        -
                                        {{ $pendaftaran->pasien->nama ?? 'Pasien' }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- DOKTER --}}
                        <div class="col-md-6">

                            <label class="form-label">
                                Dokter
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                name="dokter_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    -- Pilih Dokter --
                                </option>

                                @foreach ($dokters ?? [] as $dokter)

                                    <option value="{{ $dokter->id }}">

                                        {{ $dokter->nama }}

                                        @if ($dokter->spesialis)
                                            - {{ $dokter->spesialis }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- KELUHAN --}}
                        <div class="col-12">

                            <label class="form-label">
                                Keluhan Pasien
                                <span class="text-danger">*</span>
                            </label>

                            <textarea
                                name="keluhan"
                                class="form-control"
                                placeholder="Masukkan keluhan pasien..."
                                required
                            ></textarea>

                        </div>


                        {{-- RESEP --}}
                        <div class="col-12">

                            <div class="resep-box">

                                {{-- HEADER RESEP --}}
                                <div class="resep-header">

                                    <div class="resep-title">

                                        <i class="fa-solid fa-pills me-2"></i>

                                        Resep Obat

                                    </div>

                                    <button
                                        type="button"
                                        class="btn-tambah-obat"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalTambahObat"
                                    >

                                        <i class="fa-solid fa-plus me-1"></i>

                                        Tambah Obat

                                    </button>

                                </div>


                                {{-- TABLE RESEP --}}
                                <div class="table-responsive">

                                    <table class="table resep-table mb-0">

                                        <thead>

                                            <tr>

                                                <th>No</th>

                                                <th>Nama Obat</th>

                                                <th>Jumlah</th>

                                                <th>Dosis</th>

                                                <th>Frekuensi</th>

                                                <th>Aturan Pakai</th>

                                                <th>Lama</th>

                                                <th>Aksi</th>

                                            </tr>

                                        </thead>

                                        <tbody id="resepTableBody">

                                            <tr id="resepKosong">

                                                <td
                                                    colspan="8"
                                                    class="resep-kosong"
                                                >

                                                    <i class="fa-solid fa-pills d-block"></i>

                                                    Belum ada obat yang ditambahkan.

                                                    <br>

                                                    Klik tombol
                                                    <b>Tambah Obat</b>
                                                    untuk membuat resep.

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- FOOTER --}}
                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        <i class="fa-solid fa-xmark me-1"></i>
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="fa-solid fa-floppy-disk me-1"></i>
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
    class="modal fade obat-modal"
    id="modalTambahObat"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-md modal-dialog-centered">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <i class="fa-solid fa-pills me-2"></i>

                    Tambah Obat

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                {{-- OBAT --}}
                <div class="mb-3">

                    <label class="form-label">
                        Obat <span class="text-danger">*</span>
                    </label>

                    <select
                        id="obat_id"
                        class="form-select"
                    >

                        <option value="">
                            -- Pilih Obat --
                        </option>

                        @foreach ($obats ?? [] as $obat)

                            <option
                                value="{{ $obat->id }}"
                                data-satuan="{{ $obat->satuan }}"
                            >

                                {{ $obat->nama_obat }}

                                @if ($obat->kategori)
                                    - {{ $obat->kategori }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- JUMLAH --}}
                <div class="mb-3">

                    <label class="form-label">
                        Jumlah <span class="text-danger">*</span>
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
                <div class="mb-3">

                    <label class="form-label">
                        Dosis <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        id="dosis_obat"
                        class="form-control"
                        placeholder="Contoh: 500 mg"
                    >

                </div>


                {{-- FREKUENSI --}}
                <div class="mb-3">

                    <label class="form-label">
                        Frekuensi <span class="text-danger">*</span>
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            id="frekuensi_obat"
                            class="form-control"
                            min="1"
                            placeholder="Contoh: 3"
                        >

                        <span class="input-group-text">
                            kali sehari
                        </span>

                    </div>

                </div>


                {{-- ATURAN PAKAI --}}
                <div class="mb-3">

                    <label class="form-label">
                        Aturan Pakai
                    </label>

                    <select
                        id="aturan_pakai"
                        class="form-select"
                    >

                        <option value="">
                            -- Pilih Aturan --
                        </option>

                        <option value="Sebelum makan">
                            Sebelum makan
                        </option>

                        <option value="Sesudah makan">
                            Sesudah makan
                        </option>

                        <option value="Saat makan">
                            Saat makan
                        </option>

                        <option value="Sebelum tidur">
                            Sebelum tidur
                        </option>

                        <option value="Jika diperlukan">
                            Jika diperlukan
                        </option>

                    </select>

                </div>


                {{-- LAMA --}}
                <div class="mb-2">

                    <label class="form-label">
                        Lama Penggunaan
                    </label>

                    <div class="input-group">

                        <input
                            type="number"
                            id="lama_obat"
                            class="form-control"
                            min="1"
                            placeholder="Contoh: 3"
                        >

                        <span class="input-group-text">
                            hari
                        </span>

                    </div>

                </div>


                <div class="obat-info">

                    <i class="fa-solid fa-circle-info me-1"></i>

                    Obat diambil dari data <b>Master Obat</b>.

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
                    Tambah Obat
                </button>

            </div>

        </div>

    </div>

</div>


<script>
    let nomorObat = 0;


    function tambahkanObat()
    {
        const selectObat = document.getElementById('obat_id');

        const jumlah = document.getElementById('jumlah_obat').value;

        const dosis = document.getElementById('dosis_obat').value;

        const frekuensi = document.getElementById('frekuensi_obat').value;

        const aturan = document.getElementById('aturan_pakai').value;

        const lama = document.getElementById('lama_obat').value;


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


        const namaObat =
            selectObat.options[
                selectObat.selectedIndex
            ].text;


        nomorObat++;


        const tbody =
            document.getElementById('resepTableBody');


        const kosong =
            document.getElementById('resepKosong');


        if (kosong) {
            kosong.remove();
        }


        const row =
            document.createElement('tr');


        row.setAttribute(
            'id',
            'obat-row-' + nomorObat
        );


        row.innerHTML = `

            <td>
                ${nomorObat}
            </td>

            <td>
                <strong>
                    ${namaObat}
                </strong>
            </td>

            <td>
                ${jumlah}
            </td>

            <td>
                ${dosis}
            </td>

            <td>
                ${frekuensi} x sehari
            </td>

            <td>
                ${aturan || '-'}
            </td>

            <td>
                ${lama ? lama + ' hari' : '-'}
            </td>

            <td>

                <button
                    type="button"
                    class="btn btn-sm btn-danger"
                    onclick="hapusObat(${nomorObat})"
                >
                    <i class="fa-solid fa-trash"></i>
                </button>

            </td>

        `;


        tbody.appendChild(row);


        // RESET FORM
        selectObat.value = '';

        document.getElementById('jumlah_obat').value = '';

        document.getElementById('dosis_obat').value = '';

        document.getElementById('frekuensi_obat').value = '';

        document.getElementById('aturan_pakai').value = '';

        document.getElementById('lama_obat').value = '';


        // TUTUP MODAL OBAT
        const modalObat =
            bootstrap.Modal.getInstance(
                document.getElementById('modalTambahObat')
            );

        if (modalObat) {
            modalObat.hide();
        }


        // BUKA KEMBALI MODAL PEMERIKSAAN
        setTimeout(function () {

            const modalPemeriksaan =
                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById(
                        'modalTambahPemeriksaan'
                    )
                );

            modalPemeriksaan.show();

        }, 300);
    }


    function hapusObat(nomor)
    {
        const row =
            document.getElementById(
                'obat-row-' + nomor
            );

        if (row) {
            row.remove();
        }


        const tbody =
            document.getElementById(
                'resepTableBody'
            );


        if (tbody.children.length === 0) {

            tbody.innerHTML = `

                <tr id="resepKosong">

                    <td
                        colspan="8"
                        class="resep-kosong"
                    >

                        <i class="fa-solid fa-pills d-block"></i>

                        Belum ada obat yang ditambahkan.

                        <br>

                        Klik tombol
                        <b>Tambah Obat</b>
                        untuk membuat resep.

                    </td>

                </tr>

            `;
        }
    }
</script>

@endsection