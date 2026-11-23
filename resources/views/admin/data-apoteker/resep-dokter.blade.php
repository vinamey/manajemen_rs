
@extends('layouts.superadmin')

@section('page-title', 'Resep Dokter')
@section('navbar-title', 'Resep Dokter')

@section('content')

@push('styles')
<style>
    .resep-admin-page {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #e7f3ff;
        --text-dark: #1f2937;
        --text-muted: #6b7280;
        color: var(--text-dark);
    }

    .resep-admin-page .page-header {
        background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
        color: white;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 27px;
        box-shadow: 0 8px 20px rgba(24,119,242,.18);
    }

    .resep-admin-page .page-header h3 {
        font-size: 27px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .resep-admin-page .page-header p {
        margin: 0;
        opacity: .9;
        font-size: 14px;
    }

    .resep-admin-page .content-card {
        background: white;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,.05);
    }

    .resep-admin-page .card-heading {
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        border-bottom: 1px solid #edf0f5;
        flex-wrap: wrap;
    }

    .resep-admin-page .card-heading h5 {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 7px;
    }

    .resep-admin-page .card-heading p {
        margin: 0;
        font-size: 13px;
        color: var(--text-muted);
    }

    .resep-admin-page .search-box {
        position: relative;
        width: 305px;
        max-width: 100%;
    }

    .resep-admin-page .search-box i {
        position: absolute;
        left: 14px;
        top: 14px;
        color: #8b96a8;
    }

    .resep-admin-page .search-box input {
        width: 100%;
        border: 1px solid #e5eaf2;
        border-radius: 10px;
        padding: 12px 12px 12px 40px;
        outline: none;
        font-size: 13px;
    }

    .resep-admin-page .search-box input:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.1);
    }

    .resep-admin-page .table-responsive {
        padding: 0 23px;
    }

    .resep-admin-page .table {
        margin: 0;
        vertical-align: middle;
        font-size: 13px;
        min-width: 1350px;
    }

    .resep-admin-page .table thead th {
        background: var(--blue-main);
        color: white;
        padding: 16px 13px;
        white-space: nowrap;
        border: none;
        font-weight: 600;
    }

    .resep-admin-page .table tbody td {
        padding: 15px 13px;
        border-bottom: 1px solid #edf0f5;
    }

    .resep-admin-page .table tbody tr:hover {
        background: #f7faff;
    }

    .resep-admin-page .number-badge {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        min-width: 29px;
        height: 29px;
        padding: 0 7px;
        border-radius: 8px;
        color: var(--blue-dark);
        background: var(--blue-light);
        font-weight: 700;
    }

    .resep-admin-page .patient-name {
        font-weight: 700;
        color: #27364b;
    }

    .resep-admin-page .medicine-name {
        font-weight: 700;
        color: var(--blue-dark);
    }

    .resep-admin-page .instruction {
        display: inline-block;
        background: #f1f5fb;
        color: #52627a;
        padding: 6px 9px;
        border-radius: 6px;
        margin: 2px 0;
    }

    .resep-admin-page .status-badge {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
        background: #fff3cd;
        color: #856404;
    }

    .resep-admin-page .empty-state {
        padding: 60px 20px !important;
        text-align: center;
        color: var(--text-muted);
    }

    .resep-admin-page .empty-state i {
        display: block;
        font-size: 37px;
        color: #b8c9df;
        margin-bottom: 15px;
    }

    .resep-admin-page .empty-state strong {
        display: block;
        color: #253247;
        font-size: 14px;
    }

    .resep-admin-page .empty-state div {
        margin-top: 12px;
        font-size: 13px;
    }

    .resep-admin-page .card-footer-custom {
        padding: 18px 25px;
        border-top: 1px solid #edf0f5;
        font-size: 13px;
        color: var(--text-muted);
    }

    .resep-admin-page .pagination {
        margin: 0;
        justify-content: flex-end;
    }

    .resep-admin-page .pagination .page-link {
        font-size: 12px;
        color: var(--blue-main);
    }

    .resep-admin-page .pagination .active .page-link {
        background: var(--blue-main);
        border-color: var(--blue-main);
        color: white;
    }

    @media(max-width: 600px) {
        .resep-admin-page .page-header {
            padding: 20px;
        }

        .resep-admin-page .page-header h3 {
            font-size: 21px;
        }

        .resep-admin-page .card-heading {
            align-items: stretch;
        }

        .resep-admin-page .search-box {
            width: 100%;
        }

        .resep-admin-page .card-footer-custom {
            align-items: flex-start !important;
            flex-direction: column;
        }
    }
</style>
@endpush

<div class="resep-admin-page">

    <section class="page-header">
        <h3>
            <i class="fa-solid fa-file-prescription me-2"></i>
            Resep Dokter
        </h3>
        <p>Daftar resep obat dari hasil pemeriksaan dokter.</p>
    </section>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <section class="content-card">

        <div class="card-heading">
            <div>
                <h5>Daftar Resep Obat</h5>
                <p>Informasi pasien, dokter, dan obat yang diresepkan.</p>
            </div>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text"
                    id="searchResep"
                    placeholder="Cari pasien, dokter, atau obat..."
                    autocomplete="off">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="tabelResep">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Nama Obat</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                        <th>Frekuensi</th>
                        <th>Aturan Pakai</th>
                        <th>Lama</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($resepObats as $resep)

                        @php
                            $detailReseps = $resep->detailResep;
                        @endphp

                        @forelse ($detailReseps as $detail)

                            @php
                                $obat = $detail->obat;
                                $satuan = $detail->satuan;
                                $teks = $detail->aturan_pakai ?? '';

                                preg_match(
                                    '/Frekuensi:\s*(.*?)(?=\s*\|\s*Aturan:|$)/i',
                                    $teks,
                                    $frekuensi
                                );

                                preg_match(
                                    '/Aturan:\s*(.*?)(?=\s*\|\s*Lama:|$)/i',
                                    $teks,
                                    $aturan
                                );

                                preg_match(
                                    '/Lama:\s*(.*)/i',
                                    $teks,
                                    $lama
                                );
                            @endphp

                            <tr class="resep-row">
                                <td>
                                    <span class="number-badge">
                                        {{ ($resepObats->firstItem() ?? 1) + $loop->parent->index }}
                                    </span>
                                </td>

                                <td>
                                    <span class="patient-name">
                                        {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? 'Belum ada data' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $resep->pemeriksaan?->dokter?->nama ?? 'Belum ada data' }}
                                </td>

                                <td>
                                    <span class="medicine-name">
                                        {{ $obat?->nama ?? 'Nama obat tidak tersedia' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $satuan?->nama ?? 'Satuan tidak tersedia' }}
                                </td>

                                <td>
                                    <span class="number-badge">
                                        {{ $detail->nilai ?? 0 }}
                                    </span>
                                </td>

                                <td>
                                    {{ trim($frekuensi[1] ?? '-') ?: '-' }}
                                </td>

                                <td>
                                    <span class="instruction">
                                        {{ trim($aturan[1] ?? '-') ?: '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ trim($lama[1] ?? '-') ?: '-' }}
                                </td>

                                <td>
                                    <span class="status-badge">
                                        <i class="fa-solid fa-clock me-1"></i>
                                        Menunggu
                                    </span>
                                </td>
                            </tr>

                        @empty
                            <tr class="resep-row">
                                <td>
                                    <span class="number-badge">
                                        {{ ($resepObats->firstItem() ?? 1) + $loop->index }}
                                    </span>
                                </td>

                                <td>
                                    {{ $resep->pemeriksaan?->pendaftaran?->pasien?->nama ?? 'Belum ada data' }}
                                </td>

                                <td>
                                    {{ $resep->pemeriksaan?->dokter?->nama ?? 'Belum ada data' }}
                                </td>

                                <td colspan="6" class="text-muted">
                                    Resep belum memiliki detail obat.
                                </td>

                                <td>-</td>

                                <td>
                                    <span class="status-badge">Menunggu</span>
                                </td>
                            </tr>
                        @endforelse

                    @empty
                        <tr>
                            <td colspan="10" class="empty-state">
                                <i class="fa-solid fa-prescription-bottle-medical"></i>
                                <strong>Belum ada resep dokter</strong>
                                <div>Resep yang masih menunggu akan ditampilkan di sini.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div id="hasilKosong" class="text-center py-4 text-secondary d-none">
                Tidak ada resep yang sesuai dengan pencarian.
            </div>
        </div>

        <div class="card-footer-custom d-flex justify-content-between align-items-center flex-wrap gap-3">
            <span>
                Menampilkan {{ $resepObats->count() }} resep pada halaman ini
            </span>

            <div>
                {{ $resepObats->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchResep');
        const rows = document.querySelectorAll('#tabelResep tbody .resep-row');
        const hasilKosong = document.getElementById('hasilKosong');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let jumlahTampil = 0;

            rows.forEach(function (row) {
                const cocok = row.innerText.toLowerCase().includes(keyword);
                row.style.display = cocok ? '' : 'none';

                if (cocok) {
                    jumlahTampil++;
                }
            });

            hasilKosong.classList.toggle('d-none', jumlahTampil > 0);
        });
    });
</script>
@endpush

@endsection
