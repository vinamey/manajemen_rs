
@extends('layouts.superadmin')

@section('page-title', 'Data Obat - Admin Rumah Sakit')
@section('navbar-title', 'Data Obat')

@push('styles')
<link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
    :root {
        --blue-main: #1877f2;
        --blue-dark: #0f58c6;
        --text-dark: #1f2937;
    }

    .obat-admin-page {
        color: var(--text-dark);
    }

    .obat-admin-page .welcome-card {
        background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
        color: white;
        border: none;
        border-radius: 18px;
        padding: 23px 27px;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(24,119,242,.16);
    }

    .obat-admin-page .welcome-card h3 {
        font-size: 23px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .obat-admin-page .welcome-card p {
        font-size: 14px;
        margin: 0;
        opacity: .9;
    }

    .obat-admin-page .welcome-icon {
        width: 55px;
        height: 55px;
        background: rgba(255,255,255,.17);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
        flex-shrink: 0;
    }

    .obat-admin-page .content-card {
        background: white;
        border: 1px solid #e9eef5;
        border-radius: 17px;
        box-shadow: 0 4px 15px rgba(25,50,90,.045);
        overflow: hidden;
    }

    .obat-admin-page .card-header-custom {
        padding: 20px 23px;
        border-bottom: 1px solid #edf0f5;
    }

    .obat-admin-page .content-title {
        font-size: 17px;
        font-weight: 700;
        margin: 0;
        color: #243247;
    }

    .obat-admin-page .content-title i {
        color: var(--blue-main);
        margin-right: 9px;
    }

    .obat-admin-page .content-subtitle {
        color: #7a879a;
        font-size: 13px;
        margin-top: 6px;
        margin-bottom: 0;
    }

    .obat-admin-page .card-body-custom {
        padding: 22px;
    }

    .obat-admin-page .btn-add {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--blue-main);
        border: none;
        color: white;
        padding: 10px 17px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        transition: .2s;
    }

    .obat-admin-page .btn-add:hover {
        background: var(--blue-dark);
        color: white;
        transform: translateY(-2px);
    }

    .obat-admin-page table.dataTable {
        width: 100% !important;
        border-collapse: collapse !important;
        margin-top: 12px !important;
    }

    .obat-admin-page table.dataTable thead th {
        background: var(--blue-main) !important;
        color: white !important;
        border-bottom: none !important;
        padding: 14px 13px !important;
        font-size: 13px;
        white-space: nowrap;
    }

    .obat-admin-page table.dataTable tbody td {
        padding: 13px !important;
        vertical-align: middle;
        font-size: 13px;
        color: #344054;
    }

    .obat-admin-page table.dataTable tbody tr:hover {
        background: #f3f8ff !important;
    }

    .obat-admin-page .dataTables_wrapper {
        font-size: 13px;
        color: #59677b;
    }

    .obat-admin-page .dataTables_wrapper .dataTables_filter input,
    .obat-admin-page .dataTables_wrapper .dataTables_length select {
        border: 1px solid #dce3ed;
        border-radius: 8px;
        padding: 7px 10px;
        outline: none;
        background: white;
        font-size: 13px;
        margin-left: 7px;
    }

    /* MODAL */

    .obat-admin-page .modal-dialog {
        max-width: 460px;
    }

    .obat-admin-page .modal-content {
        border: none;
        border-radius: 9px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.18);
    }

    .obat-admin-page .modal-header {
        background: var(--blue-main);
        color: white;
        padding: 12px 15px;
        border: none;
    }

    .obat-admin-page .modal-title {
        font-size: 15px;
        font-weight: 700;
    }

    .obat-admin-page .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: .8;
        box-shadow: none;
    }

    .obat-admin-page .modal-body {
        padding: 20px 18px;
    }

    .obat-admin-page .modal-body .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #344054;
        margin-bottom: 7px;
    }

    .obat-admin-page .modal-body .form-control,
    .obat-admin-page .modal-body .form-select {
        border: 1px solid #dce3ed;
        border-radius: 7px;
        padding: 9px 10px;
        font-size: 12px;
    }

    .obat-admin-page .modal-body .form-control:focus,
    .obat-admin-page .modal-body .form-select:focus {
        border-color: var(--blue-main);
        box-shadow: 0 0 0 3px rgba(24,119,242,.1);
    }

 .obat-admin-page .modal-footer {
    padding: 12px 18px;
    background: #f8f9fa;
    border-top: 1px solid #e9eef5;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 10px;
}

.obat-admin-page .btn-modal-cancel,
.obat-admin-page .btn-modal-save {
    min-height: 38px;
    padding: 7px 16px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: .2s;
}

    .obat-admin-page .btn-modal-cancel {
        background: white;
        border: 1px solid #cbd5dc;
        color: #82909a;
    }

    .obat-admin-page .btn-modal-cancel:hover {
        background: #f5f7f9;
        color: #59677b;
    }

    .obat-admin-page .btn-modal-save {
        background: #079bd8;
        border: 1px solid #079bd8;
        color: white;
    }

    .obat-admin-page .btn-modal-save:hover {
        background: #0789c0;
        border-color: #0789c0;
        color: white;
    }

    .obat-admin-page .footer-text {
        text-align: center;
        color: #8a95a7;
        font-size: 11px;
        padding: 25px 0 10px;
    }

    @media(max-width: 600px) {
        .obat-admin-page .welcome-card {
            padding: 18px;
        }

        .obat-admin-page .welcome-card h3 {
            font-size: 19px;
        }

        .obat-admin-page .card-body-custom {
            padding: 14px;
        }

        .obat-admin-page .modal-dialog {
            margin: 15px;
        }
    }
</style>
@endpush

@section('content')

<div class="obat-admin-page">

    {{-- WELCOME CARD --}}
    <div class="welcome-card">
        <div class="d-flex align-items-center gap-3">

            <div class="welcome-icon">
                <i class="fa-solid fa-capsules"></i>
            </div>

            <div>
                <h3>Data Obat Admin Rumah Sakit</h3>
                <p>Kelola informasi dan daftar obat rumah sakit melalui halaman ini.</p>
            </div>

        </div>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">

            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- DAFTAR OBAT --}}
    <div class="content-card">

        <div class="card-header-custom">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <h5 class="content-title">
                        <i class="fa-solid fa-list-ul"></i>
                        Daftar Obat
                    </h5>

                    <p class="content-subtitle">
                        Cari dan lihat ID, nama obat, serta kategori obat.
                    </p>
                </div>

                <button
                    type="button"
                    class="btn-add"
                    data-bs-toggle="modal"
                    data-bs-target="#modalTambahObat">

                    <i class="fa-solid fa-plus"></i>
                    Tambah Data
                </button>

            </div>

        </div>

        <div class="card-body-custom">

            <div class="table-responsive">

                <table id="tabelObat" class="table table-bordered table-hover w-100">

                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Nama Obat</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Isi</th>
                            <th>Harga Jual</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="footer-text">
        SIM RS © {{ date('Y') }} — Admin Rumah Sakit
    </div>

{{-- MODAL TAMBAH SATUAN DAN HARGA OBAT --}}
<div
    class="modal fade"
    id="modalTambahObat"
    tabindex="-1"
    aria-labelledby="judulModalObat"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="judulModalObat">
                    <i class="fa-solid fa-circle-plus me-2"></i>
                    Tambah Satuan dan Harga Obat
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <form
                action="{{ route('admin.apoteker.obat.harga.store') }}"
                method="POST">

                @csrf

                <div class="modal-body">

                    {{-- PILIH OBAT --}}
                    <div class="mb-3">

                        <label for="obat_id" class="form-label">
                            Nama Obat <span class="text-danger">*</span>
                        </label>

                        <select
                            class="form-select @error('obat_id') is-invalid @enderror"
                            id="obat_id"
                            name="obat_id"
                            required>

                            <option value="">-- Pilih Obat --</option>

                            @foreach($obats as $obat)
                                <option
                                    value="{{ $obat->id }}"
                                    {{ old('obat_id') == $obat->id ? 'selected' : '' }}>
                                    {{ $obat->nama }}
                                </option>
                            @endforeach

                        </select>

                        @error('obat_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- PILIH SATUAN --}}
                    <div class="mb-3">

                        <label for="satuan_id" class="form-label">
                            Satuan Obat <span class="text-danger">*</span>
                        </label>

                        <select
                            class="form-select @error('satuan_id') is-invalid @enderror"
                            id="satuan_id"
                            name="satuan_id"
                            required>

                            <option value="">-- Pilih Satuan --</option>

                            @foreach($satuans as $satuan)
                                <option
                                    value="{{ $satuan->id }}"
                                    {{ old('satuan_id') == $satuan->id ? 'selected' : '' }}>
                                    {{ $satuan->nama }}
                                </option>
                            @endforeach

                        </select>

                        @error('satuan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- ISI SATUAN --}}
                    <div class="mb-3">

                        <label for="isi" class="form-label">
                            Isi Satuan <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            class="form-control @error('isi') is-invalid @enderror"
                            id="isi"
                            name="isi"
                            value="{{ old('isi') }}"
                            min="1"
                            placeholder="Contoh: 10"
                            required>

                        @error('isi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    {{-- HARGA JUAL --}}
                    <div class="mb-3">

                        <label for="harga" class="form-label">
                            Harga Jual <span class="text-danger">*</span>
                        </label>

                        <input
                            type="number"
                            class="form-control @error('harga') is-invalid @enderror"
                            id="harga"
                            name="harga"
                            value="{{ old('harga') }}"
                            min="1"
                            step="1"
                            placeholder="Contoh: 5000"
                            required>

                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-modal-cancel"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn-modal-save">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>

       </div>

</div>

</div> {{-- Penutup obat-admin-page --}}

@endsection


@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {

        $('#tabelObat').DataTable({

            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 10,
            order: [],

            ajax: {
                url: '{{ route("admin.apoteker.obat.data") }}',
                type: 'GET',

                error: function (xhr) {
                    console.error(xhr.responseText);

                    alert('Data obat gagal dimuat. Periksa route dan controller.');
                }
            },

            columns: [
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'nama',
                    name: 'nama',
                    defaultContent: '-'
                },
                {
                    data: 'kategori_nama',
                    name: 'kategori_nama',
                    defaultContent: '-'
                },
                {
                    data: 'satuan_nama',
                    name: 'satuan_nama',
                    defaultContent: '-'
                },
                {
                    data: 'isi',
                    name: 'isi',
                    defaultContent: '-'
                },
                {
                    data: 'harga',
                    name: 'harga',
                    defaultContent: '-'
                }
            ],

            language: {
                processing: 'Memuat data...',
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                infoEmpty: 'Belum ada data',
                infoFiltered: '(disaring dari _MAX_ data)',
                zeroRecords: 'Data obat tidak ditemukan',
                emptyTable: 'Belum ada data obat',

                paginate: {
                    first: 'Pertama',
                    last: 'Terakhir',
                    next: 'Berikutnya',
                    previous: 'Sebelumnya'
                }
            }

        });

        @if($errors->any())
            const modalTambah = new bootstrap.Modal(
                document.getElementById('modalTambahObat')
            );

            modalTambah.show();
        @endif

    });
</script>

@endpush
