@extends('layouts.superadmin')

@section('page-title', 'Dashboard Pendaftaran Pasien')

@section('content')

{{-- ======================================== --}}
{{-- STATISTIK PENDAFTARAN --}}
{{-- ======================================== --}}

<div class="row mb-4">

    {{-- TOTAL PENDAFTARAN --}}
    <div class="col-md-3 mb-3">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Total Pendaftaran
                        </small>

                        <h3 class="mb-0 mt-2">

                            {{ $totalPendaftaran }}

                        </h3>

                    </div>

                    <div class="fs-1">
                        👥
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- MENUNGGU --}}
    <div class="col-md-3 mb-3">

        <div class="card shadow-sm border-warning">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Menunggu
                        </small>

                        <h3 class="mb-0 mt-2 text-warning">

                            {{ $totalMenunggu }}

                        </h3>

                    </div>

                    <div class="fs-1">
                        ⏳
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- DIPERIKSA --}}
    <div class="col-md-3 mb-3">

        <div class="card shadow-sm border-info">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Sedang Diperiksa
                        </small>

                        <h3 class="mb-0 mt-2 text-info">

                            {{ $totalDiperiksa }}

                        </h3>

                    </div>

                    <div class="fs-1">
                        🩺
                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- SELESAI --}}
    <div class="col-md-3 mb-3">

        <div class="card shadow-sm border-success">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-muted">
                            Selesai
                        </small>

                        <h3 class="mb-0 mt-2 text-success">

                            {{ $totalSelesai }}

                        </h3>

                    </div>

                    <div class="fs-1">
                        ✅
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Pendaftaran Pasien
        </h4>

        <a href="{{ route('pendaftaran.create') }}"
           class="btn btn-success">

            + Daftar Pasien

        </a>

    </div>


    <div class="card-body">

        {{-- PESAN BERHASIL --}}
        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        {{-- ======================================== --}}
{{-- SEARCH & FILTER PENDAFTARAN --}}
{{-- ======================================== --}}

<form action="{{ route('pendaftaran.index') }}"
      method="GET"
      class="mb-4">

    <div class="row g-3">

        {{-- SEARCH --}}
        <div class="col-md-4">

            <label class="form-label">
                🔍 Cari Data
            </label>

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Nama pasien, dokter, atau no antrian..."
                   value="{{ request('search') }}">

        </div>


        {{-- FILTER POLI --}}
        <div class="col-md-2">

            <label class="form-label">
                🏥 Poli
            </label>

            <select name="poli_id"
                    class="form-select">

                <option value="">
                    Semua Poli
                </option>

                @foreach($polis as $poli)

                    <option value="{{ $poli->id }}"
                        {{ request('poli_id') == $poli->id ? 'selected' : '' }}>

                        {{ $poli->nama }}

                    </option>

                @endforeach

            </select>

        </div>


        {{-- FILTER STATUS --}}
        <div class="col-md-2">

            <label class="form-label">
                📋 Status
            </label>

            <select name="status"
                    class="form-select">

                <option value="">
                    Semua Status
                </option>

                <option value="menunggu"
                    {{ request('status') == 'menunggu' ? 'selected' : '' }}>

                    Menunggu

                </option>

                <option value="diperiksa"
                    {{ request('status') == 'diperiksa' ? 'selected' : '' }}>

                    Diperiksa

                </option>

                <option value="selesai"
                    {{ request('status') == 'selesai' ? 'selected' : '' }}>

                    Selesai

                </option>

            </select>

        </div>


        {{-- FILTER TANGGAL --}}
        <div class="col-md-2">

            <label class="form-label">
                📅 Tanggal
            </label>

            <input type="date"
                   name="tanggal"
                   class="form-control"
                   value="{{ request('tanggal') }}">

        </div>


        {{-- BUTTON --}}
        <div class="col-md-2 d-flex align-items-end gap-2">

            <button type="submit"
                    class="btn btn-primary">

                🔍 Cari

            </button>


            <a href="{{ route('pendaftaran.index') }}"
               class="btn btn-secondary">

                Reset

            </a>

        </div>

    </div>

</form>


        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-primary">

                    <tr>

                        <th>No</th>
                        <th>No Antrian</th>
                        <th>Nama Pasien</th>
                        <th>Dokter</th>
                        <th>Poli</th>
                        <th>Kamar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($pendaftarans as $pendaftaran)

                    <tr>

                        {{-- NOMOR --}}
                        <td>

                            {{ $loop->iteration }}

                        </td>


                        {{-- NOMOR ANTRIAN --}}
                        <td>

                            <strong>
                                {{ $pendaftaran->nomor_antrian }}
                            </strong>

                        </td>


                        {{-- PASIEN --}}
                        <td>

                            {{ $pendaftaran->pasien->nama ?? '-' }}

                        </td>


                        {{-- DOKTER --}}
                        <td>

                            {{ $pendaftaran->dokter->nama ?? '-' }}

                        </td>


                        {{-- POLI --}}
                        <td>

                            {{ $pendaftaran->poli->nama ?? '-' }}

                        </td>


                        {{-- KAMAR --}}
                        <td>

                            {{ $pendaftaran->kamar->nama ?? '-' }}

                        </td>


                        {{-- TANGGAL --}}
                        <td>

                            {{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d-m-Y') }}

                        </td>


                        {{-- STATUS --}}
                        <td>

                            @if($pendaftaran->status == 'menunggu')

                                <span class="badge bg-warning text-dark">

                                    Menunggu

                                </span>

                            @elseif($pendaftaran->status == 'diperiksa')

                                <span class="badge bg-info">

                                    Diperiksa

                                </span>

                            @elseif($pendaftaran->status == 'selesai')

                                <span class="badge bg-success">

                                    Selesai

                                </span>

                            @endif

                        </td>


                        {{-- AKSI --}}
                        <td>

                            {{-- LIHAT --}}
                            <a href="{{ route('pendaftaran.show', $pendaftaran->id) }}"
                               class="btn btn-info btn-sm">

                                Lihat

                            </a>


                            {{-- EDIT MODAL --}}
                            <button type="button"
                                    class="btn btn-warning btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $pendaftaran->id }}">

                                Edit

                            </button>


                            {{-- HAPUS --}}
                            <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>


                    {{-- ======================================== --}}
                    {{-- MODAL EDIT --}}
                    {{-- ======================================== --}}

                    <div class="modal fade"
                         id="editModal{{ $pendaftaran->id }}"
                         tabindex="-1">

                        <div class="modal-dialog modal-dialog-centered">

                            <div class="modal-content">


                                {{-- HEADER --}}
                                <div class="modal-header bg-primary text-white">

                                    <h5 class="modal-title">

                                        Edit Pendaftaran Pasien

                                    </h5>

                                </div>


                                {{-- FORM --}}
                                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PUT')


                                    <div class="modal-body">


                                        {{-- PASIEN --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                Pasien

                                            </label>

                                            <select name="pasien_id"
                                                    class="form-select"
                                                    required>

                                                @foreach($pasiens as $pasien)

                                                    <option value="{{ $pasien->id }}"

                                                        {{ $pendaftaran->pasien_id == $pasien->id ? 'selected' : '' }}>

                                                        {{ $pasien->nama }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        {{-- DOKTER --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                Dokter

                                            </label>

                                            <select name="dokter_id"
                                                    class="form-select"
                                                    required>

                                                @foreach($dokters as $dokter)

                                                    <option value="{{ $dokter->id }}"

                                                        {{ $pendaftaran->dokter_id == $dokter->id ? 'selected' : '' }}>

                                                        {{ $dokter->nama }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        {{-- POLI --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                Poli

                                            </label>

                                            <select name="poli_id"
                                                    class="form-select"
                                                    required>

                                                @foreach($polis as $poli)

                                                    <option value="{{ $poli->id }}"

                                                        {{ $pendaftaran->poli_id == $poli->id ? 'selected' : '' }}>

                                                        {{ $poli->nama }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        {{-- KAMAR --}}
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

                                                    -- Tidak Memilih Kamar --

                                                </option>

                                                @foreach($kamars as $kamar)

                                                    <option value="{{ $kamar->id }}"

                                                        {{ $pendaftaran->kamar_id == $kamar->id ? 'selected' : '' }}>

                                                        {{ $kamar->nama }}

                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>


                                        {{-- TANGGAL --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                Tanggal Pendaftaran

                                            </label>

                                            <input type="date"
                                                   name="tanggal_pendaftaran"
                                                   class="form-control"
                                                   value="{{ $pendaftaran->tanggal_pendaftaran }}"
                                                   required>

                                        </div>


                                        {{-- STATUS --}}
                                        <div class="mb-3">

                                            <label class="form-label">

                                                Status

                                            </label>

                                            <select name="status"
                                                    class="form-select"
                                                    required>

                                                <option value="menunggu"

                                                    {{ $pendaftaran->status == 'menunggu' ? 'selected' : '' }}>

                                                    Menunggu

                                                </option>


                                                <option value="diperiksa"

                                                    {{ $pendaftaran->status == 'diperiksa' ? 'selected' : '' }}>

                                                    Diperiksa

                                                </option>


                                                <option value="selesai"

                                                    {{ $pendaftaran->status == 'selesai' ? 'selected' : '' }}>

                                                    Selesai

                                                </option>

                                            </select>

                                        </div>


                                    </div>


                                    {{-- FOOTER --}}
                                    <div class="modal-footer">

                                        <button type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">

                                            Batal

                                        </button>


                                        <button type="submit"
                                                class="btn btn-primary">

                                            💾 Update Data

                                        </button>

                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>

                    @empty

                    <tr>

                        <td colspan="9"
                            class="text-center">

                            Belum ada data pendaftaran pasien

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="d-flex justify-content-center mt-4">

        {{ $pendaftarans->links() }}

</div>

</div>

<style>
    /* Header tabel Pendaftaran Pasien */
    .table thead th {
        background-color: #0d6efd !important;
        color: white !important;
        font-weight: 600;
    }
</style>

@endsection