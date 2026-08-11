<!DOCTYPE html>
<html>
<head>
    <title>Tambah Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">Tambah Data Dokter</h4>
                </div>
                <div class="card-body p-4">

                    {{-- Menampilkan pesan error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('master-dokters.store') }}" method="POST">
                        @csrf

                        <!-- NAMA DOKTER -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Dokter</label>
                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ old('nama') }}"
                                   placeholder="Masukkan nama dokter">
                        </div>

                        <!-- JENIS KELAMIN -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki
                                </option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <!-- TANGGAL LAHIR -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir</label>
                            <input type="date"
                                   name="tanggal_lahir"
                                   class="form-control"
                                   value="{{ old('tanggal_lahir') }}">
                        </div>

                        <!-- ALAMAT -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat</label>
                            <textarea name="alamat"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Masukkan alamat dokter">{{ old('alamat') }}</textarea>
                        </div>

                        <!-- SPESIALIS (SUDAH DIUBAH JADI SELECT) -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Spesialis</label>
                            <select name="spesialis" class="form-select">
                                <option value="">-- Pilih Spesialis --</option>
                                <option value="Anak" {{ old('spesialis') == 'Anak' ? 'selected' : '' }}>Anak</option>
                                <option value="Umum" {{ old('spesialis') == 'Umum' ? 'selected' : '' }}>Umum</option>
                                <option value="Gigi" {{ old('spesialis') == 'Gigi' ? 'selected' : '' }}>Gigi</option>
                                <option value="Kandungan" {{ old('spesialis') == 'Kandungan' ? 'selected' : '' }}>Kandungan</option>
                                <option value="Penyakit Dalam" {{ old('spesialis') == 'Penyakit Dalam' ? 'selected' : '' }}>Penyakit Dalam</option>
                            </select>
                        </div>

                        <!-- POLI -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Poli</label>
                            <select name="poli_id" class="form-select">
                                <option value="">-- Pilih Poli --</option>
                                @if(isset($polis) && count($polis) > 0)
                                    @foreach($polis as $poli)
                                        <option value="{{ $poli->id }}" {{ old('poli_id') == $poli->id ? 'selected' : '' }}>
                                            {{ $poli->nama }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- TOMBOL -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                            <a href="{{ route('master-dokters.index') }}" class="btn btn-secondary px-4">Kembali</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
    