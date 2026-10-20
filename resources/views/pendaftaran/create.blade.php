@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white">

        <h4 class="mb-0">
            + Tambah Pendaftaran Pasien
        </h4>

    </div>


    <div class="card-body">

        {{-- Menampilkan Error Validasi --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Terjadi kesalahan!</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('pendaftaran.store') }}"
              method="POST">

            @csrf


            {{-- ============================= --}}
            {{-- PILIH PASIEN --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Pasien

                </label>

                <select name="pasien_id"
                        class="form-select"
                        required>

                    <option value="">
                        -- Pilih Pasien --
                    </option>

                    @foreach($pasiens as $pasien)

                        <option value="{{ $pasien->id }}"
                            {{ old('pasien_id') == $pasien->id ? 'selected' : '' }}>

                            {{ $pasien->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            
{{-- ============================= --}}
{{-- PILIH DOKTER --}}
{{-- ============================= --}}

<div class="form-group">
    <label for="dokter_id">Dokter</label>

    <select name="dokter_id" id="dokter_id"
            class="form-control" required>
        <option value="">-- Pilih Dokter --</option>

        @foreach ($dokters as $dokter)
    <option
        value="{{ $dokter->id }}"
        data-poli-id="{{ $dokter->poli_id }}"
        data-poli-nama="{{ $dokter->poli?->nama }}"
    >
        {{ $dokter->nama }}
    </option>
@endforeach
    </select>

</div>




{{-- ============================= --}}
{{-- POLI OTOMATIS DARI DOKTER --}}
{{-- ============================= --}}

<div class="form-group">
    <label for="poli_display">Poli</label>

    {{-- Yang ditampilkan ke user --}}
    <input
        type="text"
        id="poli_display"
        class="form-control"
        value=""
        placeholder="Poli akan otomatis mengikuti dokter"
        readonly
        disabled
    >

    {{-- Yang benar-benar dikirim ke controller --}}
    <input
        type="hidden"
        name="poli_id"
        id="poli_id"
        value="{{ old('poli_id') }}"
    >
</div>

            {{-- ============================= --}}
            {{-- PILIH KAMAR --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Kamar
                    <small class="text-muted">
                        (Opsional)
                    </small>

                </label>

                <select name="kamar_id"
                        class="form-select">

                    <option value="">
                        -- Pilih Kamar --
                    </option>

                    @foreach($kamars as $kamar)

                        <option value="{{ $kamar->id }}"
                            {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}>

                             {{ $kamar->nama }}

                        </option>

                    @endforeach

                </select>

            </div>


            {{-- ============================= --}}
            {{-- TANGGAL PENDAFTARAN --}}
            {{-- ============================= --}}

            <div class="mb-3">

                <label class="form-label">

                    Tanggal Pendaftaran

                </label>

                <input type="date"
                       name="tanggal_pendaftaran"
                       class="form-control"
                       value="{{ old('tanggal_pendaftaran', date('Y-m-d')) }}"
                       required>

            </div>


            {{-- ============================= --}}
            {{-- BUTTON --}}
            {{-- ============================= --}}

            <div class="d-flex gap-2">

                <button type="submit"
                        class="btn btn-success">

                    💾 Simpan Pendaftaran

                </button>


                <a href="{{ route('pendaftaran.index') }}"
                   class="btn btn-secondary">

                    ← Kembali

                </a>

            </div>

        </form> 

    </div>

</div>



<script>
document.addEventListener('DOMContentLoaded', function () {

    const dokter = document.getElementById('dokter_id');
    const poliDisplay = document.getElementById('poli_display');
    const poliId = document.getElementById('poli_id');

    if (!dokter || !poliDisplay || !poliId) {
        console.error('Elemen dokter atau poli tidak ditemukan.');
        return;
    }

    function tampilkanPoli() {

        const pilihan = dokter.options[dokter.selectedIndex];

        // Jika dokter belum dipilih
        if (!pilihan || pilihan.value === '') {
            poliDisplay.value = '';
            poliDisplay.placeholder = 'Poli akan otomatis mengikuti dokter';
            poliId.value = '';
            return;
        }

        // Ambil ID dan nama poli dari dokter
        const idPoli = pilihan.getAttribute('data-poli-id');
        const namaPoli = pilihan.getAttribute('data-poli-nama');

        // Masukkan ke hidden input
        poliId.value = idPoli || '';

        // Tampilkan nama poli
        if (namaPoli && namaPoli.trim() !== '') {
            poliDisplay.value = namaPoli;
        } else {
            poliDisplay.value = 'Dokter belum memiliki poli';
        }
    }

    // Saat dokter dipilih/diganti
    dokter.addEventListener('change', tampilkanPoli);

    // Saat halaman pertama kali dibuka
    tampilkanPoli();

});
</script>


@endsection