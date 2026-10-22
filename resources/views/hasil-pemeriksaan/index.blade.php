@extends('layouts.superadmin')

@section('navbar-title', 'Dashboard hasil pemeriksaan')

@section('content')
<style>
    .hasil-page {
        padding: 20px 22px;
        min-height: calc(100vh - 60px);
        background: #f4f6fa;
    }

    .hasil-header {
        background: linear-gradient(110deg, #1877f2, #0f58c6);
        color: #fff;
        padding: 22px 24px;
        border-radius: 17px;
        margin-bottom: 22px;
        box-shadow: 0 8px 20px rgba(24, 119, 242, 0.15);
    }

    .hasil-header h3 {
        font-size: 25px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .hasil-header p {
        margin: 0;
        color: rgba(255, 255, 255, 0.9);
        font-size: 14px;
    }

    .hasil-card {
        background: #fff;
        border: none;
        border-radius: 17px;
        overflow: hidden;
        box-shadow: 0 7px 22px rgba(31, 45, 61, 0.07);
    }

    .hasil-card-header {
        padding: 18px 20px;
        background: #fff;
        border: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
    }

    .hasil-card-title {
        display: flex;
        align-items: center;
        gap: 11px;
        margin: 0;
        color: #253449;
        font-size: 18px;
        font-weight: 700;
    }

    .hasil-card-title i {
        color: #1877f2;
        font-size: 19px;
    }

    .btn-tambah-hasil {
        background: #1877f2;
        color: #fff;
        border: none;
        border-radius: 9px;
        padding: 10px 15px;
        font-weight: 600;
        white-space: nowrap;
        transition: 0.2s;
    }

    .btn-tambah-hasil:hover {
        background: #0f58c6;
        color: #fff;
        transform: translateY(-1px);
    }

    .hasil-table {
        margin-bottom: 0;
        color: #35445b;
    }

    .hasil-table thead th {
        background: #1877f2;
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.22);
        padding: 13px 10px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
        vertical-align: middle;
    }

    .hasil-table tbody td {
        padding: 13px 10px;
        border: 1px solid #e9edf3;
        font-size: 13px;
        vertical-align: middle;
    }

    .hasil-table tbody tr:hover {
        background: #f5f9ff;
    }

    .hasil-tanggal {
        display: inline-block;
        background: #e7f3ff;
        color: #1266d6;
        border-radius: 7px;
        padding: 7px 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .hasil-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
    }

    .hasil-actions .btn {
        width: 29px;
        height: 29px;
        padding: 0;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        border: none;
        border-radius: 7px;
        font-size: 12px;
    }

    .btn-hasil-lihat {
        background: #dff2ff;
        color: #0878bd;
    }

    .btn-hasil-lihat:hover {
        background: #c7e8ff;
        color: #075f96;
    }

    .btn-hasil-edit {
        background: #1877f2;
        color: #fff;
    }

    .btn-hasil-edit:hover {
        background: #0f58c6;
        color: #fff;
    }

    .btn-hasil-hapus {
        background: #ffe2e4;
        color: #dc3545;
    }

    .btn-hasil-hapus:hover {
        background: #ffcbd0;
        color: #b02a37;
    }

    .hasil-empty {
        padding: 35px 15px !important;
        color: #7b8798 !important;
        text-align: center;
    }

    .hasil-pagination {
        padding: 16px 20px;
        border-top: 1px solid #edf0f5;
    }

    .hasil-pagination nav p {
        margin-bottom: 0;
        font-size: 13px;
        color: #718096;
    }

    .hasil-pagination .pagination {
        margin-bottom: 0;
    }

    .hasil-pagination .page-link {
        color: #1877f2;
    }

    .hasil-pagination .page-item.active .page-link {
        background: #1877f2;
        border-color: #1877f2;
        color: #fff;
    }

    @media (max-width: 768px) {
        .hasil-page {
            padding: 15px 10px;
        }

        .hasil-header {
            padding: 20px;
        }

        .hasil-header h3 {
            font-size: 21px;
        }

        .hasil-card-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .btn-tambah-hasil {
            width: 100%;
        }

        .hasil-table {
            min-width: 900px;
        }
    }
</style>

<div class="hasil-page">

    {{-- HEADER HALAMAN --}}
    <div class="hasil-header">
        <h3>
            <i class="fas fa-file-medical me-2"></i>
            Hasil Pemeriksaan
        </h3>
        <p>Kelola data hasil pemeriksaan dan diagnosis pasien.</p>
    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3"
             role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    {{-- NOTIFIKASI VALIDASI --}}
    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <strong>Data belum berhasil diproses.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CARD DATA --}}
    <div class="hasil-card">

        <div class="hasil-card-header">
            <h5 class="hasil-card-title">
                <i class="fas fa-notes-medical"></i>
                Data Hasil Pemeriksaan
            </h5>

            <a href="{{ route('hasil-pemeriksaan.create') }}"
               class="btn btn-tambah-hasil">
                <i class="fas fa-plus me-1"></i>
                Tambah Hasil
            </a>
        </div>

        {{-- TABEL --}}
        <div class="table-responsive">
            <table class="table hasil-table align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Tanggal</th>
                        <th>Pasien</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Diagnosis</th>
                        <th>Tindakan</th>
                        <th class="text-center" style="width: 105px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($hasilPemeriksaans as $hasil)
                        <tr>
                            <td class="text-center">
                                {{ $hasilPemeriksaans->firstItem() + $loop->index }}
                            </td>

                            <td>
                                <span class="hasil-tanggal">
                                    {{ $hasil->tanggal_pemeriksaan->format('d/m/Y') }}
                                </span>
                            </td>

                            <td class="fw-semibold">
                                {{ $hasil->pemeriksaan?->pendaftaran?->pasien?->nama ?? '-' }}
                            </td>

                            <td>
                                {{ $hasil->pemeriksaan?->dokter?->nama ?? '-' }}
                            </td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($hasil->keluhan, 35) }}
                            </td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($hasil->diagnosa, 35) }}
                            </td>

                            <td>
                                {{ $hasil->tindakan?->nama ?? '-' }}
                            </td>

                            <td>
                                <div class="hasil-actions">
                                    <a href="{{ route('hasil-pemeriksaan.show', $hasil->id) }}"
                                       class="btn btn-hasil-lihat"
                                       title="Lihat detail"
                                       aria-label="Lihat detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('hasil-pemeriksaan.edit', $hasil->id) }}"
                                       class="btn btn-hasil-edit"
                                       title="Edit"
                                       aria-label="Edit">
                                        <i class="fas fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('hasil-pemeriksaan.destroy', $hasil->id) }}"
                                          method="POST"
                                          class="m-0"
                                          onsubmit="return confirm('Yakin ingin menghapus hasil pemeriksaan ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-hasil-hapus"
                                                title="Hapus"
                                                aria-label="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="hasil-empty">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                Belum ada data hasil pemeriksaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($hasilPemeriksaans->hasPages())
            <div class="hasil-pagination">
                {{ $hasilPemeriksaans->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
