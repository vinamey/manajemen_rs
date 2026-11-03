
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

    .btn-tambah {
        background: linear-gradient(120deg, #3992ff, #1265e8);
        color: white;
        border: 0;
        border-radius: 9px;
        padding: 11px 17px;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 5px 12px rgba(24,119,242,.18);
    }

    .btn-tambah:hover {
        background: #105bc9;
        color: white;
    }

    .summary-card {
        background: linear-gradient(120deg, #1877f2, #0758c7);
        color: white;
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
        min-width: 850px;
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

    .btn-aksi {
        width: 31px;
        height: 31px;
        border: none;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
        transition: .2s;
    }

    .btn-edit {
        background: #fff4d9;
        color: #e5a000;
    }

    .btn-hapus {
        background: #ffe9eb;
        color: #dc3545;
    }

    .btn-edit:hover {
        background: #f2ae00;
        color: white;
    }

    .btn-hapus:hover {
        background: #dc3545;
        color: white;
    }

    .modal-content {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(120deg, #1877f2, #0758c7);
        color: white;
        padding: 17px 21px;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
    }

    .modal-title {
        font-size: 16px;
        font-weight: 700;
    }

    .modal-body {
        padding: 22px;
    }

    .form-label {
        color: #44566e;
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        border: 1px solid #dce5f0;
        border-radius: 8px;
        padding: 10px 12px;
        font-size: 13px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 3px rgba(24,119,242,.1);
    }

    .modal-footer {
        padding: 15px 22px;
        border-top: 1px solid #edf1f7;
    }

    .btn-simpan {
        background: #1877f2;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-simpan:hover {
        background: #105bc9;
        color: white;
    }

    .btn-batal {
        background: #edf2f8;
        color: #526174;
        border: none;
        border-radius: 8px;
        padding: 9px 18px;
        font-size: 13px;
    }

    .toast {
        border-radius: 12px;
        overflow: hidden;
        min-width: 290px;
    }

    .toast-header {
        padding: 11px 14px;
    }

    .toast-body {
        font-size: 13px;
        padding: 13px 15px;
        color: #40536c;
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
            <p>Kelola dan pantau pengeluaran rumah sakit.</p>
        </div>

        <button type="button" class="btn btn-tambah"
                onclick="tambahPengeluaran()">
            <i class="fas fa-plus me-2"></i>
            Tambah Pengeluaran
        </button>
    </div>

    {{-- RINGKASAN --}}
    <div class="summary-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="summary-label">Total Pengeluaran</div>
                <h3 class="summary-total" id="totalPengeluaran">
                    Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
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

    {{-- TABEL --}}
    <div class="table-card">
        <div class="table-heading">
            <div>
                <h5>
                    <i class="fas fa-list-ul text-primary me-2"></i>
                    Daftar Pengeluaran
                </h5>
                <p>Data pengeluaran berdasarkan periode yang dipilih.</p>
            </div>

            <div class="period-filter">
                <label for="filterBulan">Bulan</label>

                <select id="filterBulan">
                    <option value="all">Semua Bulan</option>

                    @foreach(range(1, 12) as $bulan)
                        <option value="{{ $bulan }}"
                            {{ $bulan == now()->month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($bulan)->locale('id')->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>

                <label for="filterTahun">Tahun</label>

                <select id="filterTahun">
                    @for($tahun = now()->year; $tahun >= now()->year - 5; $tahun--)
                        <option value="{{ $tahun }}"
                            {{ $tahun == now()->year ? 'selected' : '' }}>
                            {{ $tahun }}
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
                        <th width="100" class="text-center">AKSI</th>
                    </tr>
                </thead>

                <tbody id="tabelPengeluaran">
                    @forelse($pengeluarans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
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
                            <td>{{ $item->keterangan ?? '-' }}</td>
                            <td class="text-center">
                                <button type="button"
                                    class="btn-aksi btn-edit"
                                    onclick="editPengeluaran({{ $item->id }})"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button"
                                    class="btn-aksi btn-hapus"
                                    onclick="hapusPengeluaran({{ $item->id }})"
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada data pengeluaran bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- TOAST NOTIFIKASI --}}
<div class="toast-container position-fixed top-0 end-0 p-3"
     style="z-index:11000;">
    <div id="toastPengeluaran"
         class="toast border-0 shadow"
         role="alert"
         aria-live="assertive"
         aria-atomic="true">

        <div class="toast-header bg-primary text-white">
            <i class="fas fa-bell me-2"></i>
            <strong class="me-auto">SIM RS</strong>
            <button type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="toast"></button>
        </div>

        <div class="toast-body" id="toastPesan">
            Berhasil.
        </div>
    </div>
</div>

{{-- MODAL TAMBAH / EDIT --}}
<div class="modal fade" id="modalPengeluaran" tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="judulModal">
                    <i class="fas fa-wallet me-2"></i>
                    Tambah Pengeluaran
                </h5>

                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <form id="formPengeluaran">
                @csrf

                <input type="hidden" id="pengeluaran_id">
                <input type="hidden" id="method" value="POST">

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Pengeluaran</label>
                        <input type="text" class="form-control"
                               id="nama"
                               placeholder="Masukkan nama pengeluaran"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Operasional">Operasional</option>
                            <option value="Gaji">Gaji</option>
                            <option value="Obat dan Alat Medis">Obat dan Alat Medis</option>
                            <option value="Pemeliharaan">Pemeliharaan</option>
                            <option value="Listrik dan Air">Listrik dan Air</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Pengeluaran</label>
                        <input type="date" class="form-control"
                               id="tanggal_pengeluaran" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nominal (Rp)</label>
                        <input type="number" class="form-control"
                               id="nominal" min="1"
                               placeholder="Masukkan nominal" required>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan"
                                  rows="3"
                                  placeholder="Masukkan keterangan"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-batal"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-simpan"
                            id="btnSimpan">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    const baseUrl = "{{ url('/direktur/pengeluaran') }}";
    let modalPengeluaran;

    $(document).ready(function () {
        modalPengeluaran = new bootstrap.Modal(
            document.getElementById('modalPengeluaran')
        );

        loadPengeluaran();
    });

    // TOAST TANPA POP-UP ALERT
    function tampilkanToast(pesan) {
        $('#toastPesan').text(pesan);

        const toastElement = document.getElementById('toastPengeluaran');

        const toast = bootstrap.Toast.getOrCreateInstance(toastElement, {
            delay: 3000,
            autohide: true
        });

        toast.show();
    }

    function formatRupiah(angka) {
        return 'Rp ' + Number(angka || 0).toLocaleString('id-ID');
    }

    // LOAD DATA SESUAI BULAN DAN TAHUN
    function loadPengeluaran() {
        $.ajax({
            url: baseUrl + '/data',
            type: 'GET',
            data: {
                bulan: $('#filterBulan').val(),
                tahun: $('#filterTahun').val()
            },
            dataType: 'json',

            success: function (response) {
                $('#tabelPengeluaran').html(response.html);
                $('#totalPengeluaran').text(formatRupiah(response.total));
                $('#jumlahPengeluaran').text(response.jumlah);
                $('#periodePengeluaran').text(response.periode);
            },

            error: function (xhr) {
                console.error(xhr.responseText);
                tampilkanToast('Gagal memuat data pengeluaran.');
            }
        });
    }

    // GANTI PERIODE
    $('#filterBulan, #filterTahun').on('change', function () {
        loadPengeluaran();
    });

    // TAMBAH DATA
    function tambahPengeluaran() {
        $('#formPengeluaran')[0].reset();

        $('#pengeluaran_id').val('');
        $('#method').val('POST');

        $('#judulModal').html(
            '<i class="fas fa-wallet me-2"></i> Tambah Pengeluaran'
        );

        $('#btnSimpan').html(
            '<i class="fas fa-save me-1"></i> Simpan'
        );

        modalPengeluaran.show();
    }

    // EDIT DATA
    function editPengeluaran(id) {
        $.ajax({
            url: baseUrl + '/' + id + '/edit',
            type: 'GET',
            dataType: 'json',

            success: function (data) {
                $('#pengeluaran_id').val(data.id);
                $('#nama').val(data.nama);
                $('#kategori').val(data.kategori);
                $('#tanggal_pengeluaran').val(data.tanggal_pengeluaran);
                $('#nominal').val(data.nominal);
                $('#keterangan').val(data.keterangan);

                $('#method').val('PUT');

                $('#judulModal').html(
                    '<i class="fas fa-edit me-2"></i> Edit Pengeluaran'
                );

                $('#btnSimpan').html(
                    '<i class="fas fa-save me-1"></i> Perbarui'
                );

                modalPengeluaran.show();
            },

            error: function (xhr) {
                console.error(xhr.responseText);
                tampilkanToast('Gagal mengambil data pengeluaran.');
            }
        });
    }

    // SIMPAN DAN UPDATE
    $('#formPengeluaran').on('submit', function (e) {
        e.preventDefault();

        const id = $('#pengeluaran_id').val();
        const method = $('#method').val();

        const url = method === 'PUT'
            ? baseUrl + '/' + id
            : baseUrl;

        const tombol = $('#btnSimpan');
        const teksAwal = tombol.html();

        const formData = {
            _token: "{{ csrf_token() }}",
            _method: method,
            nama: $('#nama').val(),
            kategori: $('#kategori').val(),
            tanggal_pengeluaran: $('#tanggal_pengeluaran').val(),
            nominal: $('#nominal').val(),
            keterangan: $('#keterangan').val()
        };

        tombol.prop('disabled', true).text('Menyimpan...');

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            dataType: 'json',

            success: function (response) {
                modalPengeluaran.hide();
                loadPengeluaran();

                tampilkanToast(
                    response.message || 'Data pengeluaran berhasil disimpan.'
                );
            },

            error: function (xhr) {
                console.error(xhr.responseText);

                let pesan = 'Terjadi kesalahan saat menyimpan data.';

                if (xhr.responseJSON?.errors) {
                    pesan = Object.values(xhr.responseJSON.errors)
                        .flat()
                        .join(', ');
                } else if (xhr.responseJSON?.message) {
                    pesan = xhr.responseJSON.message;
                }

                tampilkanToast(pesan);
            },

            complete: function () {
                tombol.prop('disabled', false).html(teksAwal);
            }
        });
    });

    // HAPUS DATA
    function hapusPengeluaran(id) {
        if (!confirm('Yakin ingin menghapus data pengeluaran ini?')) {
            return;
        }

        $.ajax({
            url: baseUrl + '/' + id,
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                _method: 'DELETE'
            },
            dataType: 'json',

            success: function (response) {
                loadPengeluaran();

                tampilkanToast(
                    response.message || 'Data pengeluaran berhasil dihapus.'
                );
            },

            error: function (xhr) {
                console.error(xhr.responseText);

                tampilkanToast(
                    xhr.responseJSON?.message ||
                    'Gagal menghapus data pengeluaran.'
                );
            }
        });
    }
</script>
@endpush
