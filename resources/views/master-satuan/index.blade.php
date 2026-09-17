@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Satuan Obat')

@section('content')

<style>
    /* ================= HEADER ================= */

    .satuan-page {
        padding: 0;
    }

    .satuan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .satuan-title-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .satuan-icon {
        width: 42px;
        height: 42px;
        background: #e7f3ff;
        color: #1877f2;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .satuan-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
    }

    .satuan-subtitle {
        margin: 3px 0 0;
        font-size: 11px;
        color: #8b95a5;
    }

    /* ================= TOMBOL TAMBAH ================= */

    .btn-tambah-satuan {
        background: #1877f2;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 9px 15px;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-tambah-satuan:hover {
        background: #0f58c6;
        color: white;
    }

    /* ================= TABLE ================= */

    .satuan-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .satuan-table {
        width: 100%;
        margin-bottom: 0;
        border-collapse: collapse;
    }

    .satuan-table thead {
        background: #1877f2;
        color: white;
    }

    .satuan-table thead th {
        padding: 14px 13px;
        font-size: 11px;
        font-weight: 700;
        border: none;
        white-space: nowrap;
    }

    .satuan-table tbody td {
        padding: 13px;
        font-size: 11px;
        color: #657184;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f5;
        white-space: nowrap;
    }

    .satuan-table tbody tr:last-child td {
        border-bottom: none;
    }

    .satuan-table tbody tr:hover {
        background: #f8fbff;
    }

    .satuan-table strong {
        color: #374151;
        font-weight: 600;
    }

    .satuan-table small {
        color: #9ca3af;
        font-size: 10px;
    }

    /* ================= BADGE KODE ================= */

    .badge-kode {
        display: inline-block;
        background: #e7f3ff;
        color: #1877f2;
        border-radius: 6px;
        padding: 5px 9px;
        font-size: 10px;
        font-weight: 600;
    }

    /* ================= TOMBOL AKSI ================= */

    .btn-satuan-aksi {
        border: none;
        border-radius: 6px;
        padding: 8px 10px;
        font-size: 10px;
        font-weight: 600;
        margin-right: 3px;
        min-width: 48px;
    }

    .btn-satuan-lihat {
        background: #dff1ff;
        color: #087db5;
    }

    .btn-satuan-lihat:hover {
        background: #c7e8fc;
        color: #087db5;
    }

    .btn-satuan-edit {
        background: #1877f2;
        color: white;
    }

    .btn-satuan-edit:hover {
        background: #0f58c6;
        color: white;
    }

    .btn-satuan-hapus {
        background: #ef4444;
        color: white;
    }

    .btn-satuan-hapus:hover {
        background: #dc2626;
        color: white;
    }

    /* ================= MODAL ================= */

    .satuan-modal .modal-content {
        border: none;
        border-radius: 12px;
        overflow: hidden;
    }

    .satuan-modal .modal-header {
        background: #1877f2;
        color: white;
        padding: 15px 20px;
    }

    .satuan-modal .modal-title {
        font-size: 15px;
        font-weight: 600;
    }

    .satuan-modal .modal-body {
        padding: 20px;
    }

    .satuan-modal .modal-footer {
        padding: 14px 20px;
    }

    .satuan-modal .form-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
    }

    .satuan-modal .form-control,
    .satuan-modal .form-select {
        font-size: 12px;
        border-radius: 7px;
        padding: 9px 11px;
    }

    .satuan-modal .form-control:focus,
    .satuan-modal .form-select:focus {
        border-color: #1877f2;
        box-shadow: 0 0 0 0.15rem rgba(24, 119, 242, 0.15);
    }

    .detail-item {
        margin-bottom: 16px;
    }

    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
    }

    .detail-value {
        font-size: 13px;
        color: #657184;
    }

    /* Hilangkan tombol X */
    .satuan-modal .btn-close {
        display: none !important;
    }
</style>


<div class="satuan-page">

    {{-- ================= HEADER ================= --}}

    <div class="satuan-header">

        <div class="satuan-title-wrapper">

            <div class="satuan-icon">
                <i class="fas fa-box"></i>
            </div>

            <div>
                <h2 class="satuan-title">
                    Master Satuan Obat
                </h2>

                <p class="satuan-subtitle">
                    Data satuan obat yang terdaftar
                </p>
            </div>

        </div>

        <button type="button"
                class="btn btn-tambah-satuan"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

            <i class="fas fa-plus me-1"></i>
            Tambah Satuan

        </button>

    </div>


    {{-- ================= TABLE ================= --}}

    <div class="satuan-card">

        <div class="table-responsive">

            <table class="satuan-table">

                <thead>

                    <tr>
                        <th width="8%">No</th>
                        <th width="25%">Kode Satuan</th>
                        <th width="35%">Nama Satuan</th>
                        <th width="32%">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($satuans as $satuan)

                        <tr id="row{{ $satuan->id }}">

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <span class="badge-kode">
                                    {{ $satuan->kode ?? '-' }}
                                </span>
                            </td>

                            <td>
                                <strong>
                                    {{ $satuan->nama }}
                                </strong>

                                <br>

                                <small>
                                    ID: {{ $satuan->id }}
                                </small>
                            </td>

                            <td>

                                {{-- LIHAT --}}

                                <button type="button"
                                        class="btn btn-satuan-aksi btn-satuan-lihat"
                                        onclick="lihatData({{ $satuan->id }})">

                                    <i class="fas fa-eye me-1"></i>
                                    Lihat

                                </button>


                                {{-- EDIT --}}

                                <button type="button"
                                        class="btn btn-satuan-aksi btn-satuan-edit"
                                        onclick="editData(
                                            {{ $satuan->id }},
                                            @js($satuan->kode),
                                            @js($satuan->nama)
                                        )">

                                    <i class="fas fa-edit me-1"></i>
                                    Edit

                                </button>


                                {{-- HAPUS --}}

                                <button type="button"
                                        class="btn btn-satuan-aksi btn-satuan-hapus"
                                        onclick="hapusData({{ $satuan->id }})">

                                    <i class="fas fa-trash me-1"></i>
                                    Hapus

                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center py-5 text-muted">

                                Belum ada data satuan obat.

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL TAMBAH --}}
{{-- ========================================================= --}}

<div class="modal fade satuan-modal"
     id="modalTambah"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Tambah Satuan Obat
                </h5>

            </div>

            <form id="formTambah">

                @csrf

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Kode Satuan
                        </label>

                        <input type="text"
                               name="kode"
                               id="kode"
                               class="form-control"
                               placeholder="Contoh: TAB">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Satuan
                        </label>

                        <select name="nama"
                                id="nama"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Satuan --
                            </option>

                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Keping">Keping</option>
                            <option value="Strip">Strip</option>
                            <option value="Botol">Botol</option>
                            <option value="Tube">Tube</option>
                            <option value="Ampul">Ampul</option>
                            <option value="Vial">Vial</option>
                            <option value="Sachet">Sachet</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Box">Box</option>
                            <option value="Dus">Dus</option>
                            <option value="Pot">Pot</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL LIHAT --}}
{{-- ========================================================= --}}

<div class="modal fade satuan-modal"
     id="modalLihat"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Detail Satuan Obat
                </h5>

            </div>

            <div class="modal-body">

                <div class="detail-item">

                    <div class="detail-label">
                        Kode Satuan
                    </div>

                    <div class="detail-value" id="lihatKode">
                        -
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        Nama Satuan
                    </div>

                    <div class="detail-value" id="lihatNama">
                        -
                    </div>

                </div>

                <div class="detail-item">

                    <div class="detail-label">
                        ID
                    </div>

                    <div class="detail-value" id="lihatId">
                        -
                    </div>

                </div>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- MODAL EDIT --}}
{{-- ========================================================= --}}

<div class="modal fade satuan-modal"
     id="modalEdit"
     tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Edit Satuan Obat
                </h5>

            </div>

            <form id="formEdit">

                @csrf
                @method('PUT')

                <input type="hidden" id="editId">

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Kode Satuan
                        </label>

                        <input type="text"
                               name="kode"
                               id="editKode"
                               class="form-control">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Satuan
                        </label>

                        <select name="nama"
                                id="editNama"
                                class="form-select"
                                required>

                            <option value="">
                                -- Pilih Satuan --
                            </option>

                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Keping">Keping</option>
                            <option value="Strip">Strip</option>
                            <option value="Botol">Botol</option>
                            <option value="Tube">Tube</option>
                            <option value="Ampul">Ampul</option>
                            <option value="Vial">Vial</option>
                            <option value="Sachet">Sachet</option>
                            <option value="Pcs">Pcs</option>
                            <option value="Box">Box</option>
                            <option value="Dus">Dus</option>
                            <option value="Pot">Pot</option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="fas fa-save me-1"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>



{{-- ========================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ========================================================= --}}

<script>

    /* ================= BANTUAN MODAL ================= */

    function bukaModal(id) {
        const modalElement = document.getElementById(id);
        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
        modal.show();
    }

    function tutupModal(id) {
        const modalElement = document.getElementById(id);
        const modal = bootstrap.Modal.getOrCreateInstance(modalElement);
        modal.hide();
    }


    /* ================= TAMBAH DATA ================= */

    document.getElementById('formTambah').addEventListener('submit', function(e) {

        e.preventDefault();

        fetch("{{ route('master-satuan.store') }}", {

            method: "POST",

            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },

            body: new URLSearchParams(new FormData(this))

        })

        .then(response => response.json())

        .then(response => {

            alert(response.message || 'Data berhasil disimpan.');

            this.reset();

            tutupModal('modalTambah');

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal disimpan.');

        });

    });


    /* ================= LIHAT DATA ================= */

    function lihatData(id) {

        fetch("{{ url('/master-satuan') }}/" + id, {

            headers: {
                "Accept": "application/json"
            }

        })

        .then(response => response.json())

        .then(response => {

            document.getElementById('lihatKode').textContent =
                response.data.kode || '-';

            document.getElementById('lihatNama').textContent =
                response.data.nama || '-';

            document.getElementById('lihatId').textContent =
                response.data.id;

            bukaModal('modalLihat');

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal ditampilkan.');

        });

    }


    /* ================= EDIT DATA ================= */

    function editData(id, kode, nama) {

        document.getElementById('editId').value = id;

        document.getElementById('editKode').value = kode || '';

        document.getElementById('editNama').value = nama || '';

        bukaModal('modalEdit');

    }


    /* ================= SIMPAN EDIT ================= */

    document.getElementById('formEdit').addEventListener('submit', function(e) {

        e.preventDefault();

        const id = document.getElementById('editId').value;

        fetch("{{ url('/master-satuan') }}/" + id, {

            method: "POST",

            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },

            body: new URLSearchParams(new FormData(this))

        })

        .then(response => response.json())

        .then(response => {

            alert(response.message || 'Data berhasil diperbarui.');

            tutupModal('modalEdit');

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal diperbarui.');

        });

    });


    /* ================= HAPUS DATA ================= */

    function hapusData(id) {

        if (!confirm('Yakin ingin menghapus data ini?')) {
            return;
        }

        fetch("{{ url('/master-satuan') }}/" + id, {

            method: "DELETE",

            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json"
            }

        })

        .then(response => response.json())

        .then(response => {

            alert(response.message || 'Data berhasil dihapus.');

            location.reload();

        })

        .catch(error => {

            console.error(error);

            alert('Data gagal dihapus.');

        });

    }

</script>

@endsection
