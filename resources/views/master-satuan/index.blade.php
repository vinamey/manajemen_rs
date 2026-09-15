@extends('layouts.superadmin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div class="d-flex align-items-center gap-3">

            <div class="icon-header">
                <i class="fas fa-box"></i>
            </div>

            <div>
                <h2 class="mb-1">Data Satuan Obat</h2>
                <p class="text-muted mb-0">
                    Data satuan obat yang terdaftar
                </p>
            </div>

        </div>

        <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambah">

            <i class="fas fa-plus"></i>
            Tambah Satuan

        </button>

    </div>


    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">

        <div class="table-responsive">

            <table class="table mb-0">

                <thead class="table-header">

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
                            <strong>{{ $satuan->kode }}</strong>
                        </td>

                        <td>
                            <strong>{{ $satuan->nama }}</strong>
                            <br>
                            <small class="text-muted">
                                ID: {{ $satuan->id }}
                            </small>
                        </td>

                        <td>

                            <button class="btn btn-info btn-sm"
                                    onclick="lihatData({{ $satuan->id }})">

                                <i class="fas fa-eye"></i>
                                Lihat

                            </button>


                            <button class="btn btn-warning btn-sm"
                                    onclick="editData(
                                        {{ $satuan->id }},
                                        '{{ $satuan->kode }}',
                                        '{{ $satuan->nama }}'
                                    )">

                                <i class="fas fa-edit"></i>
                                Edit

                            </button>


                            <button class="btn btn-danger btn-sm"
                                    onclick="hapusData({{ $satuan->id }})">

                                <i class="fas fa-trash"></i>
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


{{-- ================= MODAL TAMBAH ================= --}}

<div class="modal fade" id="modalTambah">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    Tambah Satuan Obat
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

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
                               class="form-control"
                               placeholder="Contoh: TAB">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Satuan
                        </label>

                        <div class="mb-3">
    <label class="form-label">Nama Satuan</label>

    <select name="nama" class="form-select" required>
        <option value="">-- Pilih Satuan --</option>
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

                        <i class="fas fa-save"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ================= MODAL LIHAT ================= --}}

<div class="modal fade" id="modalLihat">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    Detail Satuan Obat
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p>
                    <strong>Kode Satuan:</strong>
                    <span id="lihatKode"></span>
                </p>

                <p>
                    <strong>Nama Satuan:</strong>
                    <span id="lihatNama"></span>
                </p>

                <p>
                    <strong>ID:</strong>
                    <span id="lihatId"></span>
                </p>

            </div>

        </div>

    </div>

</div>


{{-- ================= MODAL EDIT ================= --}}

<div class="modal fade" id="modalEdit">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header bg-primary text-white">

                <h5 class="modal-title">
                    Edit Satuan Obat
                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal">
                </button>

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

                        <input type="text"
                               name="nama"
                               id="editNama"
                               class="form-control"
                               required>

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

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

body {
    background: #f5f7fb;
}

.icon-header {
    width: 60px;
    height: 60px;
    background: #dceaff;
    color: #2474ed;
    border-radius: 16px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 24px;
}

.table-header {
    background: #2474ed;
    color: white;
}

.table-header th {
    padding: 18px 20px;
    font-size: 16px;
}

.table tbody td {
    padding: 20px;
    vertical-align: middle;
}

.btn {
    border-radius: 7px;
}

</style>


<script>

<script>
$(document).ready(function () {

    // Otomatis isi kode
    $('#nama').change(function () {
        let kode = $(this).find(':selected').data('kode') || '';
        $('#kode').val(kode);
    });

    // Simpan data
    $('#formTambah').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('master-satuan.store') }}",
            type: "POST",
            data: $(this).serialize(),

            success: function (response) {
                alert(response.message);

                $('#formTambah')[0].reset();
                $('#modalTambah').modal('hide');

                location.reload();
            },

            error: function (xhr) {
                console.log(xhr.responseText);

                if (xhr.status === 422) {
                    alert('Data belum lengkap.');
                } else {
                    alert('Data gagal disimpan. Cek console/browser.');
                }
            }
        });
    });

});


// LIHAT
function lihatData(id)
{
    $.get(
        "{{ url('/master-satuan') }}/" + id,
        function(response) {

            $('#lihatKode').text(response.data.kode);

            $('#lihatNama').text(response.data.nama);

            $('#lihatId').text(response.data.id);

            $('#modalLihat').modal('show');
        }
    );
}


// EDIT
$('#formEdit').submit(function(e) {

    e.preventDefault();

    let id = $('#editId').val();

    $.ajax({

        url: "{{ url('/master-satuan') }}/" + id,

        type: "POST",

        data: $(this).serialize(),

        success: function(response) {

            alert(response.message);

            $('#modalEdit').modal('hide');

            location.reload();
        },

        error: function(xhr) {

            if (xhr.status === 422) {

                alert('Data tidak valid.');

            } else {

                alert('Data gagal diperbarui.');
            }

        }

    });

});


// HAPUS
function hapusData(id)
{
    if (!confirm('Yakin ingin menghapus data ini?')) {
        return;
    }

    $.ajax({

        url: "{{ url('/master-satuan') }}/" + id,

        type: "DELETE",

        data: {
            _token: "{{ csrf_token() }}"
        },

        success: function(response) {

            alert(response.message);

            location.reload();
        },

        error: function() {

            alert('Data gagal dihapus.');

        }

    });
}

</script>

@endsection