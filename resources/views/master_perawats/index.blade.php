@extends('layouts.superadmin')

@section('title', 'Master Perawat')

@section('content')

<style>
    :root {
        --blue: #1877f2;
        --blue-dark: #0f58c6;
        --blue-light: #eaf3ff;
        --border: #dbe7f5;
        --text: #1f2937;
        --muted: #6b7280;
    }

    .page-header {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        border-radius: 18px;
        padding: 24px 28px;
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 8px 24px rgba(24, 119, 242, .18);
    }

    .page-header h3 {
        margin: 0;
        font-weight: 700;
    }

    .page-header p {
        margin: 5px 0 0;
        opacity: .9;
    }

    .card-data {
        background: white;
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: 0 6px 20px rgba(15, 88, 198, .08);
        overflow: hidden;
    }

    .card-header-custom {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .card-header-custom h5 {
        margin: 0;
        font-weight: 700;
        color: var(--text);
    }

    .btn-blue {
        background: var(--blue);
        border: none;
        color: white;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-blue:hover {
        background: var(--blue-dark);
        color: white;
        transform: translateY(-1px);
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .table {
        margin: 0;
        min-width: 900px;
    }

    .table thead th {
        background: var(--blue-light);
        color: var(--blue-dark);
        font-weight: 700;
        border-bottom: 2px solid #cfe0f7;
        padding: 15px;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-color: #edf2f7;
    }

    .table tbody tr:hover {
        background: #f8fbff;
    }

    .nomor {
        width: 70px;
        text-align: center;
        font-weight: 600;
        color: var(--muted);
    }

    .nurse-name {
        font-weight: 700;
        color: #1f2937;
    }

    .badge-gender {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 8px;
        background: #eaf3ff;
        color: var(--blue-dark);
        font-size: 12px;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        min-width: 210px;
    }

    .btn-action {
        border: none;
        border-radius: 8px;
        padding: 7px 11px;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-view {
        background: #eaf3ff;
        color: #1877f2;
    }

    .btn-view:hover {
        background: #dcecff;
        color: #0f58c6;
    }

    .btn-edit {
        background: #fff4df;
        color: #d88a00;
    }

    .btn-edit:hover {
        background: #ffe9bd;
        color: #b87300;
    }

    .btn-delete {
        background: #ffeaea;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #ffd7d7;
        color: #b02a37;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px !important;
        color: var(--muted);
    }

    .empty-state i {
        font-size: 42px;
        color: #b8cbe4;
        margin-bottom: 10px;
    }

    .modal-content {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 15px 45px rgba(0, 0, 0, .15);
    }

    .modal-header-blue {
        background: linear-gradient(135deg, #1877f2, #0f58c6);
        color: white;
        padding: 18px 22px;
    }

    .modal-header-blue h5 {
        margin: 0;
        font-weight: 700;
    }

    .modal-body {
        padding: 24px;
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #edf2f7;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 7px;
    }

    .form-control,
    .form-select {
        border: 1px solid #d7e2ef;
        border-radius: 10px;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 .2rem rgba(24, 119, 242, .12);
    }

    .btn-cancel {
        background: #f1f3f5;
        border: none;
        color: #495057;
        border-radius: 9px;
        padding: 9px 18px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #e2e6ea;
    }

    .detail-label {
        color: #6b7280;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .detail-value {
        color: #1f2937;
        font-weight: 600;
        margin-bottom: 18px;
    }
</style>

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="page-header">
        <h3>
            <i class="bi bi-person-badge me-2"></i>
            Master Perawat
        </h3>

        <p>
            Kelola data perawat rumah sakit
        </p>
    </div>

    {{-- CARD DATA --}}
    <div class="card-data">

        <div class="card-header-custom">

            <div>
                <h5>
                    <i class="bi bi-people me-2 text-primary"></i>
                    Data Perawat
                </h5>
            </div>

            <button
                type="button"
                class="btn btn-blue"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPerawat"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Perawat
            </button>

        </div>

        <div class="table-wrapper">

            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">
                            No
                        </th>

                        <th>
                            Nama Perawat
                        </th>

                        <th>
                            Jenis Kelamin
                        </th>

                        <th>
                            Tanggal Lahir
                        </th>

                        <th>
                            Alamat
                        </th>

                        <th class="text-center" style="width: 230px;">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody id="tabelPerawat">

                    @forelse($perawats as $index => $perawat)

                        <tr id="perawat-{{ $perawat->id }}">

                            <td class="text-center nomor-urut">
                                {{ $index + 1 }}
                            </td>

                            <td>
                                <div class="nurse-name data-nama">
                                    {{ $perawat->nama }}
                                </div>
                            </td>

                            <td>
                                <span class="badge-gender">
                                    {{ ucfirst($perawat->jenis_kelamin) }}
                                </span>
                            </td>

                            <td class="data-tanggal-lahir">
                                {{ \Carbon\Carbon::parse($perawat->tanggal_lahir)->format('d-m-Y') }}
                            </td>

                            <td class="data-alamat">
                                {{ $perawat->alamat }}
                            </td>

                            <td>
                                <div class="action-buttons">

                                    <button
                                        type="button"
                                        class="btn-action btn-view"
                                        onclick="lihatPerawat({{ $perawat->id }})"
                                    >
                                        <i class="bi bi-eye me-1"></i>
                                        Lihat
                                    </button>

                                    <button
                                        type="button"
                                        class="btn-action btn-edit"
                                        onclick="editPerawat({{ $perawat->id }})"
                                    >
                                        <i class="bi bi-pencil me-1"></i>
                                        Edit
                                    </button>

                                    <button
                                        type="button"
                                        class="btn-action btn-delete"
                                        onclick="hapusPerawat({{ $perawat->id }})"
                                    >
                                        <i class="bi bi-trash me-1"></i>
                                        Hapus
                                    </button>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr id="barisKosong">

                            <td colspan="6" class="empty-state">

                                <i class="bi bi-person-x d-block"></i>

                                <div class="fw-semibold">
                                    Belum ada data perawat
                                </div>

                                <small>
                                    Silakan tambahkan data perawat baru.
                                </small>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>


{{-- ========================================================= --}}
{{-- MODAL TAMBAH PERAWAT --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalTambahPerawat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form id="formTambahPerawat">

                <div class="modal-header-blue">

                    <h5>
                        <i class="bi bi-person-plus me-2"></i>
                        Tambah Data Perawat
                    </h5>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Perawat
                        </label>

                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama perawat"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <select
                            name="jenis_kelamin"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Pilih jenis kelamin
                            </option>

                            <option value="laki-laki">
                                Laki-laki
                            </option>

                            <option value="perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            name="tanggal_lahir"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            class="form-control"
                            rows="3"
                            placeholder="Masukkan alamat"
                            required
                        ></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-blue"
                    >
                        <i class="bi bi-save me-1"></i>
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


{{-- ========================================================= --}}
{{-- MODAL LIHAT PERAWAT --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalLihatPerawat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header-blue">

                <h5>
                    <i class="bi bi-person-badge me-2"></i>
                    Detail Perawat
                </h5>

            </div>

            <div class="modal-body">

                <div class="detail-label">
                    Nama Perawat
                </div>

                <div
                    class="detail-value"
                    id="lihatNama"
                >
                    -
                </div>

                <div class="detail-label">
                    Jenis Kelamin
                </div>

                <div
                    class="detail-value"
                    id="lihatJenisKelamin"
                >
                    -
                </div>

                <div class="detail-label">
                    Tanggal Lahir
                </div>

                <div
                    class="detail-value"
                    id="lihatTanggalLahir"
                >
                    -
                </div>

                <div class="detail-label">
                    Alamat
                </div>

                <div
                    class="detail-value"
                    id="lihatAlamat"
                >
                    -
                </div>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn-cancel"
                    data-bs-dismiss="modal"
                >
                    Tutup
                </button>

            </div>

        </div>

    </div>
</div>


{{-- ========================================================= --}}
{{-- MODAL EDIT PERAWAT --}}
{{-- ========================================================= --}}

<div
    class="modal fade"
    id="modalEditPerawat"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <form id="formEditPerawat">

                <div class="modal-header-blue">

                    <h5>
                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Data Perawat
                    </h5>

                </div>

                <div class="modal-body">

                    <input
                        type="hidden"
                        id="editId"
                        name="id"
                    >

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Perawat
                        </label>

                        <input
                            type="text"
                            id="editNama"
                            name="nama"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Jenis Kelamin
                        </label>

                        <select
                            id="editJenisKelamin"
                            name="jenis_kelamin"
                            class="form-select"
                            required
                        >

                            <option value="laki-laki">
                                Laki-laki
                            </option>

                            <option value="perempuan">
                                Perempuan
                            </option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Lahir
                        </label>

                        <input
                            type="date"
                            id="editTanggalLahir"
                            name="tanggal_lahir"
                            class="form-control"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea
                            id="editAlamat"
                            name="alamat"
                            class="form-control"
                            rows="3"
                            required
                        ></textarea>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn-cancel"
                        data-bs-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-blue"
                    >
                        <i class="bi bi-save me-1"></i>
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

document.addEventListener('DOMContentLoaded', function () {

    const formTambah = document.getElementById('formTambahPerawat');
    const formEdit = document.getElementById('formEditPerawat');

    const modalTambahElement =
        document.getElementById('modalTambahPerawat');

    const modalEditElement =
        document.getElementById('modalEditPerawat');

    const modalLihatElement =
        document.getElementById('modalLihatPerawat');

    const tabel =
        document.getElementById('tabelPerawat');

    const storeUrl =
        @json(route('master-perawat.store'));

    const baseUrl =
        @json(url('master-perawat'));

    const csrfToken =
        document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');


    // =========================================================
    // TAMBAH DATA
    // =========================================================

    if (formTambah) {

        formTambah.addEventListener('submit', async function (e) {

            e.preventDefault();

            const tombolSimpan =
                formTambah.querySelector('button[type="submit"]');

            const teksAwal =
                tombolSimpan.innerHTML;

            tombolSimpan.disabled = true;

            tombolSimpan.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1"></span>
                Menyimpan...
            `;

            try {

                const formData =
                    new FormData(formTambah);

                const response =
                    await fetch(storeUrl, {

                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },

                        body: formData

                    });

                const data =
                    await response.json();

                if (!response.ok) {
                    throw data;
                }

                if (!data.data || !data.data.id) {

                    throw {
                        message:
                            'Data berhasil disimpan, tetapi data tidak diterima dari server.'
                    };

                }

                // Hapus tulisan "Belum ada data"
                const barisKosong =
                    document.getElementById('barisKosong');

                if (barisKosong) {
                    barisKosong.remove();
                }

                // Tambahkan data baru ke tabel
                tambahBarisKeTabel(data.data);

                // Perbarui nomor
                perbaruiNomor();

                // Tutup modal
                const modal =
                    bootstrap.Modal.getInstance(
                        modalTambahElement
                    );

                if (modal) {
                    modal.hide();
                }

                // Reset form
                formTambah.reset();

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        data.message ||
                        'Data perawat berhasil ditambahkan.',
                    timer: 1800,
                    showConfirmButton: false
                });

            } catch (error) {

                console.error(
                    'Error tambah perawat:',
                    error
                );

                let pesan =
                    'Terjadi kesalahan saat menambahkan data perawat.';

                if (error.errors) {

                    pesan =
                        Object.values(error.errors)
                            .flat()
                            .join('<br>');

                } else if (error.message) {

                    pesan = error.message;

                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: pesan
                });

            } finally {

                tombolSimpan.disabled = false;

                tombolSimpan.innerHTML =
                    teksAwal;

            }

        });

    }


    // =========================================================
    // EDIT DATA
    // =========================================================

    if (formEdit) {

        formEdit.addEventListener('submit', async function (e) {

            e.preventDefault();

            const id =
                document.getElementById('editId').value;

            const tombolSimpan =
                formEdit.querySelector('button[type="submit"]');

            const teksAwal =
                tombolSimpan.innerHTML;

            tombolSimpan.disabled = true;

            tombolSimpan.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1"></span>
                Menyimpan...
            `;

            try {

                const formData =
                    new FormData(formEdit);

                formData.append('_method', 'PUT');

                const response =
                    await fetch(`${baseUrl}/${id}`, {

                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },

                        body: formData

                    });

                const data =
                    await response.json();

                if (!response.ok) {
                    throw data;
                }

                const perawat =
                    data.data;

                const row =
                    document.getElementById(
                        `perawat-${id}`
                    );

                if (row && perawat) {

                    const nama =
                        row.querySelector('.data-nama');

                    const tanggal =
                        row.querySelector(
                            '.data-tanggal-lahir'
                        );

                    const alamat =
                        row.querySelector('.data-alamat');

                    const gender =
                        row.querySelector('.badge-gender');

                    if (nama) {
                        nama.textContent =
                            perawat.nama;
                    }

                    if (gender) {
                        gender.textContent =
                            ucfirst(perawat.jenis_kelamin);
                    }

                    if (tanggal) {
                        tanggal.textContent =
                            formatTanggal(
                                perawat.tanggal_lahir
                            );
                    }

                    if (alamat) {
                        alamat.textContent =
                            perawat.alamat;
                    }

                }

                const modal =
                    bootstrap.Modal.getInstance(
                        modalEditElement
                    );

                if (modal) {
                    modal.hide();
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text:
                        data.message ||
                        'Data perawat berhasil diperbarui.',
                    timer: 1800,
                    showConfirmButton: false
                });

            } catch (error) {

                console.error(
                    'Error edit perawat:',
                    error
                );

                let pesan =
                    'Terjadi kesalahan saat memperbarui data.';

                if (error.errors) {

                    pesan =
                        Object.values(error.errors)
                            .flat()
                            .join('<br>');

                } else if (error.message) {

                    pesan = error.message;

                }

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    html: pesan
                });

            } finally {

                tombolSimpan.disabled = false;

                tombolSimpan.innerHTML =
                    teksAwal;

            }

        });

    }


    // =========================================================
    // FUNGSI TAMBAH BARIS
    // =========================================================

    window.tambahBarisKeTabel =
    function (perawat) {

        if (!tabel || !perawat) {
            return;
        }

        const row =
            document.createElement('tr');

        row.id =
            'perawat-' + perawat.id;

        row.innerHTML = `

            <td class="text-center nomor-urut">
                -
            </td>

            <td>
                <div class="nurse-name data-nama">
                    ${escapeHtml(perawat.nama ?? '-')}
                </div>
            </td>

            <td>
                <span class="badge-gender">
                    ${escapeHtml(
                        ucfirst(
                            perawat.jenis_kelamin ?? '-'
                        )
                    )}
                </span>
            </td>

            <td class="data-tanggal-lahir">
                ${escapeHtml(
                    formatTanggal(
                        perawat.tanggal_lahir
                    )
                )}
            </td>

            <td class="data-alamat">
                ${escapeHtml(
                    perawat.alamat ?? '-'
                )}
            </td>

            <td>

                <div class="action-buttons">

                    <button
                        type="button"
                        class="btn-action btn-view"
                        onclick="lihatPerawat(${perawat.id})"
                    >
                        <i class="bi bi-eye me-1"></i>
                        Lihat
                    </button>

                    <button
                        type="button"
                        class="btn-action btn-edit"
                        onclick="editPerawat(${perawat.id})"
                    >
                        <i class="bi bi-pencil me-1"></i>
                        Edit
                    </button>

                    <button
                        type="button"
                        class="btn-action btn-delete"
                        onclick="hapusPerawat(${perawat.id})"
                    >
                        <i class="bi bi-trash me-1"></i>
                        Hapus
                    </button>

                </div>

            </td>
        `;

        tabel.prepend(row);

    };


    // =========================================================
    // FUNGSI NOMOR URUT
    // =========================================================

    window.perbaruiNomor =
    function () {

        if (!tabel) {
            return;
        }

        const semuaBaris =
            tabel.querySelectorAll(
                'tr[id^="perawat-"]'
            );

        semuaBaris.forEach(
            (row, index) => {

                const nomor =
                    row.querySelector(
                        '.nomor-urut'
                    );

                if (nomor) {
                    nomor.textContent =
                        index + 1;
                }

            }
        );

    };


    // =========================================================
    // LIHAT DATA
    // =========================================================

    window.lihatPerawat =
    async function (id) {

        try {

            const response =
                await fetch(
                    `${baseUrl}/${id}`,
                    {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

            if (!response.ok) {
                throw new Error(
                    'Data perawat tidak ditemukan.'
                );
            }

            const data =
                await response.json();

            const perawat =
                data.data ?? data;

            document.getElementById(
                'lihatNama'
            ).textContent =
                perawat.nama ?? '-';

            document.getElementById(
                'lihatJenisKelamin'
            ).textContent =
                ucfirst(
                    perawat.jenis_kelamin ?? '-'
                );

            document.getElementById(
                'lihatTanggalLahir'
            ).textContent =
                formatTanggal(
                    perawat.tanggal_lahir
                );

            document.getElementById(
                'lihatAlamat'
            ).textContent =
                perawat.alamat ?? '-';

            const modal =
                new bootstrap.Modal(
                    modalLihatElement
                );

            modal.show();

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text:
                    error.message ||
                    'Gagal mengambil data perawat.'
            });

        }

    };


    // =========================================================
    // EDIT DATA
    // =========================================================

    window.editPerawat =
    async function (id) {

        try {

            const response =
                await fetch(
                    `${baseUrl}/${id}`,
                    {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

            if (!response.ok) {
                throw new Error(
                    'Data perawat tidak ditemukan.'
                );
            }

            const data =
                await response.json();

            const perawat =
                data.data ?? data;

            document.getElementById(
                'editId'
            ).value =
                perawat.id;

            document.getElementById(
                'editNama'
            ).value =
                perawat.nama ?? '';

            document.getElementById(
                'editJenisKelamin'
            ).value =
                perawat.jenis_kelamin ?? '';

            document.getElementById(
                'editTanggalLahir'
            ).value =
                perawat.tanggal_lahir ?? '';

            document.getElementById(
                'editAlamat'
            ).value =
                perawat.alamat ?? '';

            const modal =
                new bootstrap.Modal(
                    modalEditElement
                );

            modal.show();

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text:
                    error.message ||
                    'Gagal mengambil data perawat.'
            });

        }

    };


    // =========================================================
    // HAPUS DATA
    // =========================================================

    window.hapusPerawat =
    async function (id) {

        const konfirmasi =
            await Swal.fire({

                icon: 'warning',

                title: 'Hapus Data?',

                text:
                    'Data perawat yang dihapus tidak dapat dikembalikan.',

                showCancelButton: true,

                confirmButtonText:
                    'Ya, Hapus',

                cancelButtonText:
                    'Batal',

                reverseButtons: true

            });

        if (!konfirmasi.isConfirmed) {
            return;
        }

        try {

            const response =
                await fetch(
                    `${baseUrl}/${id}`,
                    {
                        method: 'DELETE',

                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

            const data =
                await response.json();

            if (!response.ok) {
                throw data;
            }

            const row =
                document.getElementById(
                    `perawat-${id}`
                );

            if (row) {
                row.remove();
            }

            perbaruiNomor();

            // Kalau sudah tidak ada data
            const jumlahData =
                tabel.querySelectorAll(
                    'tr[id^="perawat-"]'
                ).length;

            if (jumlahData === 0) {

                tabel.innerHTML = `

                    <tr id="barisKosong">

                        <td
                            colspan="6"
                            class="empty-state"
                        >

                            <i class="bi bi-person-x d-block"></i>

                            <div class="fw-semibold">
                                Belum ada data perawat
                            </div>

                            <small>
                                Silakan tambahkan data perawat baru.
                            </small>

                        </td>

                    </tr>

                `;

            }

            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text:
                    data.message ||
                    'Data perawat berhasil dihapus.',
                timer: 1800,
                showConfirmButton: false
            });

        } catch (error) {

            console.error(error);

            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text:
                    error.message ||
                    'Data perawat gagal dihapus.'
            });

        }

    };


    // =========================================================
    // FORMAT TANGGAL
    // =========================================================

    window.formatTanggal =
    function (tanggal) {

        if (!tanggal) {
            return '-';
        }

        const bagian =
            String(tanggal).split('-');

        if (bagian.length !== 3) {
            return tanggal;
        }

        return `${bagian[2]}-${bagian[1]}-${bagian[0]}`;

    };


    // =========================================================
    // UC FIRST
    // =========================================================

    window.ucfirst =
    function (text) {

        if (!text) {
            return '';
        }

        return text.charAt(0).toUpperCase()
            + text.slice(1);

    };


    // =========================================================
    // ESCAPE HTML
    // =========================================================

    window.escapeHtml =
    function (text) {

        if (
            text === null ||
            text === undefined
        ) {
            return '';
        }

        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    };

});

</script>

@endsection
