
@extends('layouts.direktur')

@section('page-title', 'Laporan - SIM RS')
@section('navbar-title', 'Dashboard Laporan')

@push('styles')
<style>
    .laporan-page {
        padding: 0;
        transform: scale(.94);
        transform-origin: top left;
        width: 106.38%;
    }

    .laporan-header {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        gap: 24px;
        min-height: 145px;
        padding: 25px 32px;
        margin-bottom: 22px;
        border-radius: 17px;
        background: linear-gradient(110deg, #e1edff, #ffffff);
        border: 1px solid #dce9ff;
        box-shadow: 0 5px 18px rgba(24, 80, 150, .05);
    }

    .laporan-header::after {
        content: '\f0f6';
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        right: 45px;
        top: 20px;
        font-size: 100px;
        color: rgba(24, 119, 242, .10);
        transform: rotate(-10deg);
    }

    .header-icon {
        width: 82px;
        height: 82px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        background: linear-gradient(135deg, #4da0ff, #1877f2);
        color: white;
        font-size: 35px;
        box-shadow: 0 8px 20px rgba(24, 119, 242, .18);
        z-index: 1;
    }

    .header-text {
        z-index: 1;
    }

    .header-text h2 {
        color: #17365f;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
    }

    .laporan-card {
        background: #fff;
        border-radius: 17px;
        padding: 27px;
        border: 1px solid #edf1f7;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .daftar-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 22px;
    }

    .daftar-icon {
        width: 49px;
        height: 49px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #e7f1ff;
        color: #1877f2;
        border-radius: 12px;
        font-size: 22px;
    }

    .daftar-header h4 {
        color: #17365f;
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .daftar-header p {
        color: #7b8ba3;
        font-size: 13px;
        margin: 0;
    }

    .table-laporan {
        border: 1px solid #dce6f2;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-laporan table {
        margin: 0;
    }

    .table-laporan thead th {
        background: linear-gradient(100deg, #287df0, #438ff5);
        color: #fff;
        padding: 15px 19px;
        font-size: 14px;
        font-weight: 700;
        border: 1px solid rgba(255, 255, 255, .12);
    }

    .table-laporan tbody td {
        padding: 15px 19px;
        color: #29415f;
        font-size: 14px;
        font-weight: 500;
        vertical-align: middle;
        border-color: #e3eaf3;
    }

    .nomor {
        color: #4777b7 !important;
        font-weight: 700 !important;
    }

    .nama-laporan {
        color: #17365f !important;
        font-weight: 600 !important;
    }

    .btn-excel,
    .btn-pdf {
        min-width: 82px;
        padding: 9px 12px;
        border-radius: 8px;
        border: none;
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        gap: 7px;
        transition: .2s;
        cursor: pointer;
    }

    .btn-excel {
        background: #13a36b;
        margin-right: 7px;
    }

    .btn-excel:hover {
        background: #0d8758;
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-pdf {
        background: #ed4055;
    }

    .btn-pdf:hover {
        background: #d92e43;
        color: #fff;
        transform: translateY(-2px);
    }

    .info-laporan {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 15px 20px;
        margin-top: 21px;
        background: #e1edff;
        border: 1px solid #c7ddff;
        border-radius: 10px;
        color: #1767cb;
        font-size: 13px;
    }

    .info-laporan i {
        font-size: 21px;
    }

    @media (max-width: 768px) {
        .laporan-page {
            transform: none;
            width: 100%;
        }

        .laporan-header {
            min-height: 120px;
            padding: 20px;
            gap: 15px;
        }

        .header-icon {
            width: 65px;
            height: 65px;
            font-size: 28px;
            border-radius: 16px;
        }

        .header-text h2 {
            font-size: 24px;
        }

        .laporan-card {
            padding: 18px;
        }

        .table-laporan {
            overflow-x: auto;
        }

        .table-laporan table {
            min-width: 600px;
        }

        .info-laporan {
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')

<div class="laporan-page">

    {{-- HEADER LAPORAN --}}
    <div class="laporan-header">
        <div class="header-icon">
            <i class="fas fa-file-invoice"></i>
        </div>

        <div class="header-text">
            <h2>Laporan</h2>
        </div>
    </div>

    {{-- DAFTAR LAPORAN --}}
    <div class="laporan-card">

        <div class="daftar-header">
            <div class="daftar-icon">
                <i class="fas fa-chart-simple"></i>
            </div>

            <div>
                <h4>Daftar Laporan</h4>
                <p>Silakan pilih laporan yang ingin Anda lihat atau unduh.</p>
            </div>
        </div>

        <div class="table-responsive table-laporan">
            <table class="table table-bordered align-middle">

                <thead>
                    <tr>
                        <th width="85">No</th>
                        <th>Jenis Laporan</th>
                        <th width="300">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    {{-- PENDAPATAN --}}
                    <tr>
                        <td class="nomor">1</td>
                        <td class="nama-laporan">Pendapatan</td>
                        <td>
                            <button type="button"
                                class="btn-excel"
                                onclick="downloadExcel('{{ route('laporan.export.excel', 'pendapatan') }}')">
                                <i class="fas fa-file-excel"></i>
                                Excel
                            </button>

                            <button type="button"
                                class="btn-pdf"
                                onclick="openPdf('{{ route('laporan.export.pdf', 'pendapatan') }}')">
                                <i class="fas fa-file-pdf"></i>
                                PDF
                            </button>
                        </td>
                    </tr>

                    {{-- PASIEN --}}
                    <tr>
                        <td class="nomor">2</td>
                        <td class="nama-laporan">Pasien</td>
                        <td>
                            <button type="button"
                                class="btn-excel"
                                onclick="downloadExcel('{{ route('laporan.export.excel', 'pasien') }}')">
                                <i class="fas fa-file-excel"></i>
                                Excel
                            </button>

                            <button type="button"
                                class="btn-pdf"
                                onclick="openPdf('{{ route('laporan.export.pdf', 'pasien') }}')">
                                <i class="fas fa-file-pdf"></i>
                                PDF
                            </button>
                        </td>
                    </tr>

                    {{-- DATA OBAT --}}
                    <tr>
                        <td class="nomor">3</td>
                        <td class="nama-laporan">Data Obat</td>
                        <td>
                            <button type="button"
                                class="btn-excel"
                                onclick="downloadExcel('{{ route('laporan.export.excel', 'data-obat') }}')">
                                <i class="fas fa-file-excel"></i>
                                Excel
                            </button>

                            <button type="button"
                                class="btn-pdf"
                                onclick="openPdf('{{ route('laporan.export.pdf', 'data-obat') }}')">
                                <i class="fas fa-file-pdf"></i>
                                PDF
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- INFORMASI --}}
        <div class="info-laporan">
            <i class="fas fa-circle-info"></i>
            <span>
                Anda dapat mengekspor laporan dalam format Excel atau PDF
                sesuai kebutuhan tanpa harus memuat ulang halaman.
            </span>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    // Download Excel baru setiap kali tombol diklik
    function downloadExcel(url) {
        const link = document.createElement('a');

        const separator = url.includes('?') ? '&' : '?';

        link.href = url + separator + '_download=' + Date.now();
        link.style.display = 'none';

        document.body.appendChild(link);

        link.click();

        // Hapus elemen setelah klik diproses browser
        setTimeout(function () {
            link.remove();
        }, 2000);
    }

    // PDF dibuka pada tab baru
    function openPdf(url) {
        window.open(url, '_blank');
    }
</script>
@endpush
