@extends('layouts.direktur')

@section('page-title', 'Data Pengeluaran - SIM RS')
@section('navbar-title', 'Data Pengeluaran')

@push('styles')
<style>
    .pengeluaran-page {
        color: #243b5a;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
    }

    .page-header h4 {
        font-size: 21px;
        font-weight: 750;
        margin: 0;
        color: #17365d;
    }

    .page-header p {
        color: #8493a8;
        font-size: 13px;
        margin: 5px 0 0;
    }

    .summary-card {
        background: linear-gradient(120deg, #1877f2, #0758c7);
        color: #fff;
        border-radius: 15px;
        padding: 21px 24px;
        margin-bottom: 20px;
        box-shadow: 0 6px 18px rgba(24,119,242,.13);
        position: relative;
        overflow: hidden;
    }

    .summary-card::after {
        content: "";
        position: absolute;
        width: 150px;
        height: 150px;
        border: 25px solid rgba(255,255,255,.08);
        border-radius: 50%;
        right: -35px;
        top: -65px;
        pointer-events: none;
    }

    .summary-label {
        font-size: 13px;
        opacity: .9;
        margin-bottom: 7px;
    }

    .summary-total {
        font-size: 27px;
        font-weight: 750;
        margin: 0;
    }

    .summary-icon {
        width: 51px;
        height: 51px;
        background: rgba(255,255,255,.17);
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 23px;
    }

    .summary-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 13px;
        font-size: 12px;
        flex-wrap: wrap;
    }

    .summary-bottom span {
        background: rgba(255,255,255,.15);
        padding: 6px 10px;
        border-radius: 20px;
    }

    .table-card {
        background: #fff;
        border: 1px solid #e8eef8;
        border-radius: 15px;
        padding: 21px;
        box-shadow: 0 5px 18px rgba(30,65,110,.045);
    }

    .table-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 18px;
    }

    .table-heading h5 {
        color: #17365d;
        font-size: 17px;
        font-weight: 750;
        margin: 0;
    }

    .table-heading p {
        color: #91a0b3;
        font-size: 12px;
        margin: 5px 0 0;
    }

    .period-filter {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .period-filter label {
        font-size: 12px;
        color: #718096;
        font-weight: 600;
    }

    .period-filter select {
        border: 1px solid #dce6f3;
        border-radius: 8px;
        padding: 8px 11px;
        color: #40536c;
        font-size: 12px;
        outline: none;
        background: #f8fbff;
    }

    .table {
        min-width: 750px;
        margin: 0;
    }

    .table thead th {
        background: #f0f5fc;
        color: #60748e;
        font-size: 11px;
        font-weight: 750;
        padding: 14px 12px;
        border-bottom: 1px solid #e1eaf5;
        white-space: nowrap;
    }

    .table tbody td {
        color: #50627a;
        font-size: 12px;
        padding: 15px 12px;
        vertical-align: middle;
        border-color: #edf1f7;
    }

    .table tbody tr:hover {
        background: #f8fbff;
    }

    .badge-kategori {
        display: inline-block;
        padding: 5px 10px;
        background: #eaf3ff;
        color: #1877f2;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
    }

    .nominal-text {
        color: #0b9b70;
        font-weight: 750;
        white-space: nowrap;
    }

    .btn-detail {
        font-size: 11px;
        padding: 6px 10px;
        border-radius: 7px;
        white-space: nowrap;
    }

    @media(max-width:768px) {
        .table-card {
            padding: 14px;
        }

        .summary-total {
            font-size: 23px;
        }

        .page-header h4 {
            font-size: 19px;
        }
    }
</style>
@endpush

@section('content')
<div class="pengeluaran-page">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h4>Data Pengeluaran</h4>
            <p>Melihat data pengeluaran rumah sakit yang telah tersimpan.</p>
        </div>
    </div>

    {{-- RINGKASAN PENGELUARAN --}}
    <div class="summary-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="summary-label">Total Pengeluaran</div>

                <h3 class="summary-total" id="totalPengeluaran">
                    Rp {{ number_format($totalPengeluaran ?? $pengeluarans->sum('nominal'), 0, ',', '.') }}
                </h3>
            </div>

            <div class="summary-icon">
                <i class="fas fa-wallet"></i>
            </div>
        </div>

        <div class="summary-bottom">
            <span>
                <i class="fas fa-calendar-alt me-1"></i>
                Periode:
                <strong id="periodePengeluaran">
                    {{ now()->locale('id')->translatedFormat('F Y') }}
                </strong>
            </span>

            <span>
                <i class="fas fa-receipt me-1"></i>
                <strong id="jumlahPengeluaran">
                    {{ $pengeluarans->count() }}
                </strong>
                Transaksi
            </span>
        </div>
    </div>

    {{-- TABEL PENGELUARAN --}}
    <div class="table-card">

        <div class="table-heading">
            <div>
                <h5>
                    <i class="fas fa-list-ul text-primary me-2"></i>
                    Daftar Pengeluaran
                </h5>

                <p>Data pengeluaran berdasarkan periode yang dipilih.</p>
            </div>

            {{-- FILTER BULAN DAN TAHUN --}}
            <div class="period-filter">

                <label for="filterBulan">Bulan</label>

                <select id="filterBulan">
                    <option value="all">Semua Bulan</option>

                    @foreach(range(1, 12) as $angkaBulan)
                        <option value="{{ $angkaBulan }}"
                            {{ $angkaBulan == now()->month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($angkaBulan)->locale('id')->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>

                <label for="filterTahun">Tahun</label>

                <select id="filterTahun">
                    @for($angkaTahun = now()->year; $angkaTahun >= now()->year - 5; $angkaTahun--)
                        <option value="{{ $angkaTahun }}"
                            {{ $angkaTahun == now()->year ? 'selected' : '' }}>
                            {{ $angkaTahun }}
                        </option>
                    @endfor
                </select>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th width="55">NO</th>
                        <th>NAMA PENGELUARAN</th>
                        <th>KATEGORI</th>
                        <th>TANGGAL</th>
                        <th>NOMINAL</th>
                        <th>KETERANGAN</th>
                        <th width="100">AKSI</th>
                    </tr>
                </thead>

                <tbody id="tabelPengeluaran">

                    @forelse($pengeluarans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-semibold">
                                {{ $item->nama }}
                            </td>

                            <td>
                                <span class="badge-kategori">
                                    {{ $item->kategori }}
                                </span>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d-m-Y') }}
                            </td>

                            <td>
                                <span class="nominal-text">
                                    Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                </span>
                            </td>

                            <td>
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td>
                                <button type="button"
                                    class="btn btn-primary btn-detail"
                                    data-nama="{{ $item->nama }}"
                                    data-kategori="{{ $item->kategori }}"
                                    data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d-m-Y') }}"
                                    data-nominal="{{ number_format($item->nominal, 0, ',', '.') }}"
                                    data-keterangan="{{ $item->keterangan ?? '-' }}">
                                    <i class="fas fa-eye me-1"></i> Detail
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada data pengeluaran pada periode ini.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL PENGELUARAN --}}
<div class="modal fade" id="modalDetailPengeluaran" tabindex="-1"
    aria-labelledby="judulDetailPengeluaran" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="judulDetailPengeluaran">
                    <i class="fas fa-receipt me-2"></i>
                    Detail Pengeluaran
                </h5>

                <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal"
                    aria-label="Tutup">
                </button>
            </div>

            <div class="modal-body p-4">

                <div class="mb-3">
                    <label class="text-muted small">Nama Pengeluaran</label>
                    <div class="fw-semibold" id="detailNama">-</div>
                </div>

                <div class="mb-3">
                    <label class="text-muted small">Kategori</label>
                    <div class="fw-semibold" id="detailKategori">-</div>
                </div>

                <div class="mb-3">
                    <label class="text-muted small">Tanggal Pengeluaran</label>
                    <div class="fw-semibold" id="detailTanggal">-</div>
                </div>

                <div class="mb-3">
                    <label class="text-muted small">Nominal</label>
                    <div class="fw-bold text-success" id="detailNominal">-</div>
                </div>

                <div>
                    <label class="text-muted small">Keterangan</label>
                    <div class="fw-semibold" id="detailKeterangan">-</div>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button"
                    class="btn btn-secondary btn-sm"
                    data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    const urlDataPengeluaran = "{{ url('/direktur/pengeluaran/data') }}";

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka || 0).toLocaleString('id-ID');
    }

    // MEMUAT DATA PENGELUARAN
    function loadPengeluaran() {
        $.ajax({
            url: urlDataPengeluaran,
            type: 'GET',
            dataType: 'json',

            data: {
                bulan: $('#filterBulan').val(),
                tahun: $('#filterTahun').val()
            },

            success: function(response) {
                $('#tabelPengeluaran').html(response.html);

                $('#totalPengeluaran').text(
                    formatRupiah(response.total)
                );

                $('#jumlahPengeluaran').text(response.jumlah);

                $('#periodePengeluaran').text(response.periode);
            },

            error: function(xhr) {
                console.error(
                    'Gagal memuat data pengeluaran:',
                    xhr.responseText
                );
            }
        });
    }

    // MENAMPILKAN DETAIL PENGELUARAN
    $(document).on('click', '.btn-detail', function() {

        $('#detailNama').text($(this).attr('data-nama') || '-');

        $('#detailKategori').text($(this).attr('data-kategori') || '-');

        $('#detailTanggal').text($(this).attr('data-tanggal') || '-');

        $('#detailNominal').text(
            'Rp ' + ($(this).attr('data-nominal') || '0')
        );

        $('#detailKeterangan').text(
            $(this).attr('data-keterangan') || '-'
        );

        const modalElement = document.getElementById('modalDetailPengeluaran');
        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);

        modal.show();
    });

    // FILTER BULAN DAN TAHUN
    $(document).ready(function() {
        $('#filterBulan, #filterTahun').on('change', function() {
            loadPengeluaran();
        });

        loadPengeluaran();
    });
</script>
@endpush