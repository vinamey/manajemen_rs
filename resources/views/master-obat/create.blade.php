@extends('layouts.superadmin')

@section('content')

<style>
    .obat-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
    }

    .obat-header {
        background: linear-gradient(135deg, #0d6efd, #6f42c1);
        color: white;
        padding: 22px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 11px 14px;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .15);
    }

    .section-title {
        font-weight: 600;
        color: #495057;
        margin-bottom: 15px;
    }

    .price-box {
        position: relative;
    }

    .price-prefix {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        font-weight: 600;
        color: #6c757d;
        z-index: 2;
    }

    .price-input {
        padding-left: 45px;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 15px;
    }
</style>

<div class="container-fluid">

    <div class="card shadow obat-card">

        <div class="obat-header">

            <h4 class="mb-1">
                <i class="fa-solid fa-pills"></i>
                Tambah Obat
            </h4>

            <small>
                Masukkan informasi obat dengan lengkap
            </small>

        </div>

        <div class="card-body p-4">

            @if($errors->any())

                <div class="alert alert-danger">

                    <strong>Data belum dapat disimpan.</strong>

                    <ul class="mb-0 mt-2">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('master-obat.store') }}"
                  method="POST">

                @csrf

                {{-- INFORMASI OBAT --}}

                <h5 class="section-title">
                    <i class="fa-solid fa-capsules"></i>
                    Informasi Obat
                </h5>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Kode Obat
                        </label>

                        <input
                        type="text"
                        name="kode"
                        class="form-obat-control"
                        placeholder="Masukkan kode obat"
                        value="{{ old('kode') }}"
                        required>

                    </div>

                    {{-- NAMA OBAT --}}
<div class="form-obat-group">

    <label class="form-obat-label">
        Nama Obat
    </label>

    <select
        name="nama"
        class="form-obat-control select2-obat"
        data-placeholder="Cari / pilih nama obat..."
        required
    >

        <option value=""></option>

        @foreach($obats as $obat)

            <option
                value="{{ $obat->nama }}"
                {{ old('nama') == $obat->nama ? 'selected' : '' }}
            >
                {{ $obat->nama }}
            </option>

        @endforeach

    </select>

    @error('nama')
        <span class="error-obat">
            {{ $message }}
        </span>
    @enderror

</div>
                    {{-- KATEGORI --}}
<div class="form-obat-group">

    <label class="form-obat-label">
        Kategori
    </label>

    <select
        name="kategori_id"
        class="form-obat-control select2-kategori"
        required
    >

        <option value="">
            -- Cari / pilih kategori --
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

    </select>

</div>

<div class="mb-3">

    <label>Satuan</label>

    <select name="satuan" class="form-control" required>

        <option value="">-- Pilih Satuan --</option>

        @foreach($satuans as $satuan)

            <option value="{{ $satuan->nama }}"
                {{ old('satuan') == $satuan->nama ? 'selected' : '' }}>

                {{ $satuan->nama }}

            </option>

        @endforeach

    </select>

</div>

                </div>

                <hr class="my-4">

                {{-- HARGA --}}

                <h5 class="section-title">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    Informasi Harga
                </h5>

                <div class="row">

                    <!-- <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Harga Beli
                        </label>

                        <div class="price-box">

                            <span class="price-prefix">Rp</span>

                            <input type="number"
                                   name="harga_beli"
                                   class="form-control price-input"
                                   value="{{ old('harga_beli') }}"
                                   min="0"
                                   placeholder="0"
                                   required>

                        </div> -->

                    </div>

                    <div class="mb-3">
    <label>Harga</label>

    <div class="input-group">
        <span class="input-group-text">Rp</span>

        <input type="text"
               id="harga_display"
               class="form-control"
               placeholder="Contoh: 5.000"
               autocomplete="off"
               value="{{ old('harga') ? number_format(old('harga'), 0, ',', '.') : '' }}"
               required>
    </div>

    {{-- INI yang dikirim ke database --}}
    <input type="hidden"
           name="harga"
           id="harga"
           value="{{ old('harga') }}">
</div>

                    </div>

                </div>

                <hr class="my-4">

                {{-- STOK --}}

                <h5 class="section-title">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Informasi Stok
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Stok Awal
                        </label>

                        <input
                            type="number"
                            name="stok"
                            class="form-obat-control"
                            value="{{ old('stok', 0) }}"
                            min="0"
                            required>

                        <small class="text-muted">
                            Jumlah obat yang tersedia saat ini.
                        </small>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Stok Minimum
                        </label>

                        <input type="number"
                               name="stok_minimum"
                               class="form-control"
                               value="{{ old('stok_minimum', 10) }}"
                               min="0"
                               required>

                        <small class="text-muted">
                            Batas untuk memberikan peringatan stok.
                        </small>

                    </div>

                </div>

                <div class="info-box mt-2 mb-4">

                    <i class="fa-solid fa-circle-info text-primary"></i>

                    <strong>Informasi:</strong>

                    Jika stok berada di bawah batas minimum,
                    obat akan ditandai sebagai stok menipis.

                </div>

                <div class="d-flex gap-2">

                    <button type="submit"
                            class="btn btn-primary px-4">

                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Obat

                    </button>

                    <a href="{{ route('master-obat.index') }}"
                       class="btn btn-secondary px-4">

                        <i class="fa-solid fa-arrow-left"></i>
                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {

    const hargaDisplay = document.getElementById('harga_display');
    const harga = document.getElementById('harga');

    hargaDisplay.addEventListener('input', function () {

        // Ambil angka saja
        let angka = this.value.replace(/\D/g, '');

        // Masukkan angka asli ke input hidden
        harga.value = angka;

        // Tampilkan format Rupiah
        if (angka !== '') {
            this.value = new Intl.NumberFormat('id-ID').format(angka);
        } else {
            this.value = '';
        }
    });

    // Pastikan nilai harga masuk sebelum form dikirim
    hargaDisplay.closest('form').addEventListener('submit', function () {

        let angka = hargaDisplay.value.replace(/\D/g, '');

        harga.value = angka;
    });

});
</script>