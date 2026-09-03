@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Tambah Dokter</h4>
    </div>

    <div class="card-body">

        {{-- Pesan error --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="formDokter"
              action="{{ route('master-dokter.store') }}"
              method="POST">

            @csrf

            {{-- Nama Dokter --}}
            <div class="mb-3">
                <label for="nama" class="form-label">
                    Nama Dokter
                </label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama dokter"
                    required
                >
            </div>

            {{-- Jenis Kelamin --}}
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">
                    Jenis Kelamin
                </label>

                <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    class="form-control"
                    required
                >
                    <option value="">-- Pilih Jenis Kelamin --</option>

                    <option
                        value="laki-laki"
                        {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}
                    >
                        Laki-laki
                    </option>

                    <option
                        value="perempuan"
                        {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}
                    >
                        Perempuan
                    </option>
                </select>
            </div>

            {{-- Tanggal Lahir --}}
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">
                    Tanggal Lahir
                </label>

                <input
                    type="date"
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    class="form-control"
                    value="{{ old('tanggal_lahir') }}"
                    required
                >
            </div>

            {{-- Spesialis --}}
            <div class="mb-3">
                <label for="spesialis" class="form-label">
                    Spesialis
                </label>

                <input
                    type="text"
                    id="spesialis"
                    name="spesialis"
                    class="form-control"
                    value="{{ old('spesialis') }}"
                    placeholder="Contoh: Kandungan"
                >
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label for="alamat" class="form-label">
                    Alamat
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    class="form-control"
                    rows="3"
                    placeholder="Masukkan alamat dokter"
                >{{ old('alamat') }}</textarea>
            </div>

            {{-- Poli --}}
            <div class="mb-3">
                <label for="poli_id" class="form-label">
                    Poli
                </label>

                <select
                    id="poli_id"
                    name="poli_id"
                    class="form-control"
                >
                    <option value="">-- Pilih Poli --</option>

                    @foreach(\App\Models\MasterPoli::all() as $poli)
                        <option
                            value="{{ $poli->id }}"
                            {{ old('poli_id') == $poli->id ? 'selected' : '' }}
                        >
                            {{ $poli->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="mt-4">
                <button
                    type="submit"
                    class="btn btn-success"
                    id="btnSimpan"
                >
                    Simpan
                </button>

                <a
                    href="{{ route('master-dokter.index') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('formDokter').addEventListener('submit', function(event) {

    event.preventDefault();

    const form = this;
    const button = document.getElementById('btnSimpan');

    button.disabled = true;
    button.innerText = 'Menyimpan...';

    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(async response => {

        const data = await response.json();

        if (!response.ok) {
            throw data;
        }

        return data;
    })
    .then(data => {

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: data.message,
            confirmButtonText: 'OK'
        }).then(() => {

            window.location.href = "{{ route('master-dokter.index') }}";

        });

    })
    .catch(error => {

        let pesan = 'Terjadi kesalahan saat menyimpan data dokter.';

        if (error.errors) {

            pesan = Object.values(error.errors)
                .flat()
                .join('<br>');
        }

        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            html: pesan,
            confirmButtonText: 'OK'
        });

        button.disabled = false;
        button.innerText = 'Simpan';
    });

});
</script>

@endsection
