@extends('layouts.superadmin')

@section('page-title', 'Tambah Obat')

@section('content')

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #64748b;
        --border: #dbe3ed;
    }

    .tambah-obat-page {
        background: #f4f6fa;
        min-height: calc(100vh - 70px);
        padding: 22px 18px;
    }

    .obat-form-card {
        max-width: 850px;
        margin: 0 auto;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #edf0f4;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
    }

    /* =====================================================
       HEADER
    ===================================================== */

    .obat-form-header {
        background: var(--blue-main);
        color: #ffffff;
        padding: 16px 20px;
    }

    .obat-form-header h4 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .obat-form-header p {
        margin: 4px 0 0;
        font-size: 10px;
        opacity: 0.9;
    }

    /* =====================================================
       BODY
    ===================================================== */

    .obat-form-body {
        padding: 20px;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 700;
        color: #374151;
        margin: 0 0 14px;
    }

    .section-title i {
        color: var(--blue-main);
    }

    .section-divider {
        border: none;
        border-top: 1px solid #edf0f4;
        margin: 20px 0;
        opacity: 1;
    }

    /* =====================================================
       FORM
    ===================================================== */

    .form-obat-group {
        margin-bottom: 14px;
    }

    .form-obat-label {
        display: block;
        margin-bottom: 5px;
        color: #64748b;
        font-size: 10px;
        font-weight: 600;
    }

    .form-obat-control {
        display: block;
        width: 100%;
        height: 38px;
        padding: 8px 10px;
        border: 1px solid var(--border);
        border-radius: 7px;
        background: #ffffff;
        color: #374151;
        font-size: 10px;
        outline: none;
        box-sizing: border-box;
        transition: 0.2s;
    }

    .form-obat-control:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 2px rgba(24, 119, 242, 0.10);
    }

    .form-obat-control::placeholder {
        color: #9ca3af;
    }

    select.form-obat-control {
        cursor: pointer;
    }

    .form-help {
        display: block;
        margin-top: 4px;
        color: #94a3b8;
        font-size: 9px;
    }

    .error-obat {
        display: block;
        color: #dc3545;
        font-size: 9px;
        margin-top: 4px;
    }

    /* =====================================================
       HARGA
    ===================================================== */

    .harga-wrapper {
        position: relative;
    }

    .harga-prefix {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 10px;
        font-weight: 600;
        pointer-events: none;
        z-index: 2;
    }

    .harga-input {
        padding-left: 32px;
    }

    /* =====================================================
       INFO
    ===================================================== */

    .info-box {
        background: #f0f7ff;
        border: 1px solid #dbeafe;
        border-radius: 7px;
        padding: 10px 12px;
        color: #526071;
        font-size: 9px;
        margin-top: 3px;
    }

    .info-box i {
        color: var(--blue-main);
        margin-right: 4px;
    }

    /* =====================================================
       ALERT
    ===================================================== */

    .alert-validasi {
        background: #fff5f5;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 7px;
        padding: 10px 12px;
        margin-bottom: 18px;
        font-size: 10px;
    }

    .alert-validasi strong {
        display: block;
        margin-bottom: 5px;
    }

    .alert-validasi ul {
        margin: 0;
        padding-left: 17px;
    }

    /* =====================================================
       BUTTON
    ===================================================== */

    .form-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 7px;
        margin-top: 20px;
        padding-top: 15px;
        border-top: 1px solid #edf0f4;
    }

    .btn-kembali-obat {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: #eef2f7;
        color: #64748b;
        border: none;
        border-radius: 6px;
        padding: 9px 14px;
        font-size: 9px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-kembali-obat:hover {
        background: #e2e8f0;
        color: #374151;
    }

    .btn-simpan-obat {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        background: var(--blue-main);
        color: #ffffff;
        border: none;
        border-radius: 6px;
        padding: 9px 14px;
        font-size: 9px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-simpan-obat:hover {
        background: var(--blue-dark);
    }

    @media (max-width: 768px) {
        .tambah-obat-page {
            padding: 15px 10px;
        }

        .obat-form-body {
            padding: 16px;
        }
    }
</style>


<div class="tambah-obat-page">

    <div class="obat-form-card">

        {{-- =====================================================
             HEADER
        ====================================================== --}}
        <div class="obat-form-header">

            <h4>
                <i class="fas fa-pills"></i>
                Tambah Obat
            </h4>

            <p>
                Masukkan informasi obat dengan lengkap
            </p>

        </div>


        <div class="obat-form-body">

            {{-- =====================================================
                 VALIDASI ERROR
            ====================================================== --}}
            @if($errors->any())

                <div class="alert-validasi">

                    <strong>
                        Data belum dapat disimpan.
                    </strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- =====================================================
                 FORM
            ====================================================== --}}
            <form
                action="{{ route('master-obat.store') }}"
                method="POST"
                id="formTambahObat"
            >

                @csrf


                {{-- =====================================================
                     INFORMASI OBAT
                ====================================================== --}}
                <h5 class="section-title">

                    <i class="fas fa-capsules"></i>

                    Informasi Obat

                </h5>


                <div class="row">


                    {{-- KODE OBAT --}}
                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="kode"
                                class="form-obat-label"
                            >
                                Kode Obat
                            </label>

                            <input
                                type="text"
                                id="kode"
                                name="kode"
                                class="form-obat-control"
                                placeholder="Masukkan kode obat"
                                value="{{ old('kode') }}"
                                required
                            >

                            @error('kode')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>


                    {{-- NAMA OBAT --}}
                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="nama"
                                class="form-obat-label"
                            >
                                Nama Obat
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                class="form-obat-control"
                                placeholder="Masukkan nama obat"
                                value="{{ old('nama') }}"
                                required
                            >

                            @error('nama')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>


                    {{-- KATEGORI --}}
                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="kategori_id"
                                class="form-obat-label"
                            >
                                Kategori
                            </label>

                            <select
                                id="kategori_id"
                                name="kategori_id"
                                class="form-obat-control"
                                required
                            >

                                <option value="">
                                    -- Pilih Kategori --
                                </option>

                                @foreach($kategoris as $kategori)

                                    <option
                                        value="{{ $kategori->id }}"
                                        {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}
                                    >
                                        {{ $kategori->nama }}
                                    </option>

                                @endforeach

                            </select>

                            @error('kategori_id')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>


                    {{-- SATUAN --}}
                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="satuan"
                                class="form-obat-label"
                            >
                                Satuan
                            </label>

                            <select
                                id="satuan"
                                name="satuan"
                                class="form-obat-control"
                                required
                            >

                                <option value="">
                                    -- Pilih Satuan --
                                </option>

                                @foreach($satuans as $satuan)

                                    <option
                                        value="{{ $satuan->nama }}"
                                        {{ old('satuan') == $satuan->nama ? 'selected' : '' }}
                                    >
                                        {{ $satuan->nama }}
                                    </option>

                                @endforeach

                            </select>

                            @error('satuan')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>

                </div>


                <hr class="section-divider">


                {{-- =====================================================
                     INFORMASI HARGA
                ====================================================== --}}
                <h5 class="section-title">

                    <i class="fas fa-money-bill-wave"></i>

                    Informasi Harga

                </h5>


                <div class="row">

                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="harga_display"
                                class="form-obat-label"
                            >
                                Harga
                            </label>


                            <div class="harga-wrapper">

                                <span class="harga-prefix">
                                    Rp
                                </span>

                                <input
                                    type="text"
                                    id="harga_display"
                                    class="form-obat-control harga-input"
                                    placeholder="Contoh: 5.000"
                                    autocomplete="off"
                                    value="{{ old('harga') ? number_format((float) old('harga'), 0, ',', '.') : '' }}"
                                    required
                                >

                            </div>


                            {{-- NILAI ASLI UNTUK DATABASE --}}
                            <input
                                type="hidden"
                                id="harga"
                                name="harga"
                                value="{{ old('harga') }}"
                            >


                            @error('harga')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>

                </div>


                <hr class="section-divider">


                {{-- =====================================================
                     INFORMASI STOK
                ====================================================== --}}
                <h5 class="section-title">

                    <i class="fas fa-boxes-stacked"></i>

                    Informasi Stok

                </h5>


                <div class="row">


                    {{-- STOK --}}
                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="stok"
                                class="form-obat-label"
                            >
                                Stok Awal
                            </label>

                            <input
                                type="number"
                                id="stok"
                                name="stok"
                                class="form-obat-control"
                                value="{{ old('stok', 0) }}"
                                min="0"
                                required
                            >

                            <small class="form-help">
                                Jumlah obat yang tersedia saat ini.
                            </small>

                            @error('stok')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>


                    {{-- STOK MINIMUM --}}
                    <div class="col-md-6">

                        <div class="form-obat-group">

                            <label
                                for="stok_minimum"
                                class="form-obat-label"
                            >
                                Stok Minimum
                            </label>

                            <input
                                type="number"
                                id="stok_minimum"
                                name="stok_minimum"
                                class="form-obat-control"
                                value="{{ old('stok_minimum', 10) }}"
                                min="0"
                                required
                            >

                            <small class="form-help">
                                Batas untuk memberikan peringatan stok.
                            </small>

                            @error('stok_minimum')

                                <span class="error-obat">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- INFO --}}
                <div class="info-box">

                    <i class="fas fa-circle-info"></i>

                    <strong>Informasi:</strong>

                    Jika stok berada di bawah batas minimum,
                    obat akan ditandai sebagai stok menipis.

                </div>


                {{-- =====================================================
                     BUTTON
                ====================================================== --}}
                <div class="form-actions">

                    <a
                        href="{{ route('master-obat.index') }}"
                        class="btn-kembali-obat"
                    >

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>


                    <button
                        type="submit"
                        class="btn-simpan-obat"
                    >

                        <i class="fas fa-save"></i>

                        Simpan Data

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | AMBIL ELEMENT
    |--------------------------------------------------------------------------
    */

    const hargaDisplay = document.getElementById('harga_display');
    const hargaInput = document.getElementById('harga');
    const form = document.getElementById('formTambahObat');


    /*
    |--------------------------------------------------------------------------
    | CEK ELEMENT
    |--------------------------------------------------------------------------
    */

    if (!hargaDisplay || !hargaInput || !form) {
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | FUNCTION FORMAT RUPIAH
    |--------------------------------------------------------------------------
    */

    function formatRupiah(value) {

        const angka = value
            .toString()
            .replace(/[^0-9]/g, '');

        if (angka === '') {
            return '';
        }

        return new Intl.NumberFormat('id-ID').format(
            Number(angka)
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SAAT USER MENGETIK HARGA
    |--------------------------------------------------------------------------
    */

    hargaDisplay.addEventListener('input', function () {

        const angka = this.value.replace(/[^0-9]/g, '');

        /*
         * Yang terlihat:
         * 5.000
         *
         * Yang dikirim:
         * 5000
         */

        hargaInput.value = angka;

        this.value = formatRupiah(angka);

    });


    /*
    |--------------------------------------------------------------------------
    | SEBELUM FORM DIKIRIM
    |--------------------------------------------------------------------------
    */

    form.addEventListener('submit', function () {

        const angka = hargaDisplay.value.replace(
            /[^0-9]/g,
            ''
        );

        hargaInput.value = angka;

    });

});
</script>

@endsection
