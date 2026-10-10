
@extends('layouts.superadmin')

@section('page-title', 'Edit Pemeriksaan Dokter')

@section('content')

<style>
    .edit-page {
        padding: 22px;
        color: #263449;
    }

    .edit-header {
        background: linear-gradient(120deg, #1877f2, #0f58c6);
        color: #fff;
        border-radius: 13px;
        padding: 22px 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 16px rgba(24, 119, 242, .15);
    }

    .edit-header h3 {
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .edit-header p {
        margin: 0;
        font-size: 13px;
        opacity: .92;
    }

    .edit-card {
        background: #fff;
        border: 1px solid #e8edf5;
        border-radius: 13px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(15, 35, 70, .045);
        margin-bottom: 20px;
    }

    .edit-card-header {
        background: #e7f3ff;
        color: #0f58c6;
        border-bottom: 1px solid #d8e9ff;
        padding: 14px 20px;
        font-size: 14px;
        font-weight: 700;
    }

    .edit-card-body {
        padding: 22px;
    }

    .form-label {
        display: block;
        color: #334155;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        min-height: 42px;
        border: 1px solid #dbe3ef;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
        color: #263449;
    }

    textarea.form-control {
        min-height: 105px;
        resize: vertical;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 3px rgba(24, 119, 242, .10);
    }

    .form-control[readonly] {
        background: #f8fafc;
        color: #475569;
    }

    .required-mark {
        color: #dc3545;
    }

    .table-resep {
        width: 100%;
        min-width: 850px;
        margin-bottom: 0;
        font-size: 12px;
    }

    .table-resep thead th {
        background: #1877f2;
        color: #fff;
        border-color: #d7e5f8;
        padding: 11px 12px;
        white-space: nowrap;
        font-weight: 600;
    }

    .table-resep tbody td {
        padding: 11px 12px;
        vertical-align: middle;
        border-color: #e5eaf2;
        color: #334155;
    }

    .table-resep tbody tr:hover {
        background: #f4f8ff;
    }

    .medicine-name {
        font-weight: 700;
        color: #1e3a5f;
    }

    .no-resep {
        border: 1px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 9px;
        padding: 22px;
        color: #64748b;
        text-align: center;
        font-size: 13px;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 10px;
        padding-top: 18px;
        margin-top: 20px;
        border-top: 1px solid #edf0f5;
    }

    .btn-kembali,
    .btn-simpan {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 40px;
        padding: 9px 17px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-kembali {
        background: #fff;
        color: #475569;
        border: 1px solid #dbe3ef;
    }

    .btn-kembali:hover {
        background: #f1f5f9;
        color: #1e293b;
    }

    .btn-simpan {
        background: #1877f2;
        border: 1px solid #1877f2;
        color: #fff;
        cursor: pointer;
    }

    .btn-simpan:hover {
        background: #0f58c6;
        border-color: #0f58c6;
        color: #fff;
    }

    @media (max-width: 768px) {
        .edit-page {
            padding: 12px;
        }

        .edit-header {
            padding: 18px;
        }

        .edit-header h3 {
            font-size: 19px;
        }

        .edit-card-body {
            padding: 16px;
        }

        .form-footer a,
        .form-footer button {
            flex: 1;
        }
    }
</style>

<div class="container-fluid edit-page">

    {{-- HEADER --}}
    <div class="edit-header">
        <h3>
            <i class="bi bi-clipboard2-pulse me-2"></i>
            Edit Pemeriksaan Dokter
        </h3>
        <p>Perbarui data pemeriksaan pasien dan lihat detail resep obat.</p>
    </div>

    {{-- NOTIFIKASI VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded-3">
            <div class="fw-bold mb-1">Data belum dapat disimpan.</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PEMERIKSAAN --}}
    <div class="edit-card">
        <div class="edit-card-header">
            <i class="bi bi-pencil-square me-2"></i>
            Form Pemeriksaan Pasien
        </div>

        <div class="edit-card-body">

            <form action="{{ route('pemeriksaan-dokter.update', $pemeriksaan->id) }}"
                  method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- PASIEN / NO. ANTRIAN --}}
                    <div class="col-md-6">
                        <label for="pendaftaran_id" class="form-label">
                            Pasien / No. Antrian
                            <span class="required-mark">*</span>
                        </label>

                        <select name="pendaftaran_id"
                                id="pendaftaran_id"
                                class="form-select @error('pendaftaran_id') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Pasien --</option>

                            @foreach ($pendaftarans as $pendaftaran)
                                <option value="{{ $pendaftaran->id }}"
                                    @selected(
                                        (string) old('pendaftaran_id', $pemeriksaan->pendaftaran_id)
                                        === (string) $pendaftaran->id
                                    )>
                                    {{ $pendaftaran->nomor_antrian ?? '-' }}
                                    — {{ $pendaftaran->pasien->nama ?? '-' }}
                                </option>
                            @endforeach
                        </select>

                        @error('pendaftaran_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- POLI --}}
                    <div class="col-md-6">
                        <label for="poli_display" class="form-label">Poli</label>

                        <input type="text"
                               id="poli_display"
                               class="form-control"
                               value="{{ $pemeriksaan->pendaftaran->poli->nama ?? '-' }}"
                               readonly>

                        <small class="text-muted">
                            Poli mengikuti pendaftaran pasien.
                        </small>
                    </div>

                    {{-- DOKTER PEMERIKSA --}}
                    <div class="col-md-6">
                        <label for="dokter_id" class="form-label">
                            Dokter Pemeriksa
                            <span class="required-mark">*</span>
                        </label>

                        <select name="dokter_id"
                                id="dokter_id"
                                class="form-select @error('dokter_id') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Dokter --</option>

                            @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->id }}"
                                    @selected(
                                        (string) old('dokter_id', $pemeriksaan->dokter_id)
                                        === (string) $dokter->id
                                    )>
                                    {{ $dokter->nama }}
                                </option>
                            @endforeach
                        </select>

                        @error('dokter_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KELUHAN PASIEN --}}
                    <div class="col-12">
                        <label for="keluhan" class="form-label">
                            Keluhan Pasien
                            <span class="required-mark">*</span>
                        </label>

                        <textarea name="keluhan"
                                  id="keluhan"
                                  rows="4"
                                  class="form-control @error('keluhan') is-invalid @enderror"
                                  placeholder="Masukkan keluhan pasien..."
                                  required>{{ old('keluhan', $pemeriksaan->keluhan) }}</textarea>

                        @error('keluhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- RESEP OBAT --}}
                <div class="mt-4">
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">
                            <i class="bi bi-capsule me-2 text-primary"></i>
                            Resep Obat
                        </h6>
                        <small class="text-muted">
                            Detail obat yang tercatat pada pemeriksaan ini.
                        </small>
                    </div>

                    @php
                        $daftarObat = $pemeriksaan->resep
                            ? $pemeriksaan->resep->obat
                            : collect();
                    @endphp

                    @if ($daftarObat->isNotEmpty())
                        <div class="table-responsive border rounded-3">
                            <table class="table table-bordered table-hover table-resep">
                                <thead>
                                    <tr>
                                        <th style="width: 55px;">No.</th>
                                        <th>Nama Obat</th>
                                        <th style="width: 85px;">Jumlah</th>
                                        <th>Dosis</th>
                                        <th>Frekuensi</th>
                                        <th>Aturan Pakai</th>
                                        <th>Lama Pemakaian</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($daftarObat as $index => $obat)
                                        @php
                                            $aturan = $obat->pivot->aturan_pakai ?? '';
                                            $dosis = '-';
                                            $frekuensi = '-';
                                            $aturanPakai = '-';
                                            $lama = '-';

                                            foreach (explode('|', $aturan) as $item) {
                                                $item = trim($item);

                                                if (str_starts_with($item, 'Dosis:')) {
                                                    $dosis = trim(substr($item, strlen('Dosis:')));
                                                } elseif (str_starts_with($item, 'Frekuensi:')) {
                                                    $frekuensi = trim(substr($item, strlen('Frekuensi:')));
                                                } elseif (str_starts_with($item, 'Aturan:')) {
                                                    $aturanPakai = trim(substr($item, strlen('Aturan:')));
                                                } elseif (str_starts_with($item, 'Lama:')) {
                                                    $lama = trim(substr($item, strlen('Lama:')));
                                                } elseif ($item !== '') {
                                                    $aturanPakai = $item;
                                                }
                                            }
                                        @endphp

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="medicine-name">
                                                {{ $obat->nama ?? '-' }}
                                            </td>
                                            <td>{{ $obat->pivot->nilai ?? '-' }}</td>
                                            <td>{{ $dosis }}</td>
                                            <td>
                                                {{ $frekuensi !== '-' && is_numeric($frekuensi)
                                                    ? $frekuensi . ' kali sehari'
                                                    : $frekuensi }}
                                            </td>
                                            <td>{{ $aturanPakai }}</td>
                                            <td>
                                                {{ $lama !== '-' && is_numeric($lama)
                                                    ? $lama . ' hari'
                                                    : $lama }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="small text-muted mt-2">
                            <i class="bi bi-info-circle me-1"></i>
                            Detail resep ditampilkan sebagai informasi dan tidak diubah melalui formulir ini.
                        </div>
                    @else
                        <div class="no-resep">
                            <i class="bi bi-capsule fs-4 d-block mb-2"></i>
                            Belum ada resep obat untuk pemeriksaan ini.
                        </div>
                    @endif
                </div>

                {{-- TOMBOL --}}
                <div class="form-footer">
                    <a href="{{ route('pemeriksaan-dokter.index') }}"
                       class="btn-kembali">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-simpan">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
