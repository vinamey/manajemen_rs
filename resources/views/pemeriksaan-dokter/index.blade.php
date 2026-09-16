@extends('layouts.superadmin')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-clipboard2-pulse me-2"></i>
                Pemeriksaan Dokter
            </h3>
            <p class="text-muted mb-0">
                Kelola data pemeriksaan pasien oleh dokter
            </p>
        </div>

        <a href="{{ route('pemeriksaan-dokter.create') }}"
           class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>
            Tambah Pemeriksaan
        </a>
    </div>


    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            {{-- INFO --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1">
                        Daftar Pemeriksaan
                    </h5>

                    <small class="text-muted">
                        Total {{ $pemeriksaans->count() }} pemeriksaan
                    </small>
                </div>
            </div>


            {{-- TABLE --}}
            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>No. Antrian</th>
                            <th>Pasien</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Resep Obat</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($pemeriksaans as $index => $pemeriksaan)

                            <tr>

                                {{-- NO --}}
                                <td>
                                    {{ $index + 1 }}
                                </td>


                                {{-- ANTRIAN --}}
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $pemeriksaan->pendaftaran->nomor_antrian ?? '-' }}
                                    </span>
                                </td>


                                {{-- PASIEN --}}
                                <td>
                                    <div class="fw-semibold">
                                        {{ $pemeriksaan->pendaftaran->pasien->nama ?? '-' }}
                                    </div>
                                </td>


                                {{-- POLI --}}
                                <td>
                                    {{ $pemeriksaan->pendaftaran->poli->nama ?? '-' }}
                                </td>


                                {{-- DOKTER --}}
                                <td>
                                    {{ $pemeriksaan->dokter->nama ?? '-' }}
                                </td>


                                {{-- KELUHAN --}}
                                <td>
                                    <span
                                        title="{{ $pemeriksaan->keluhan }}">
                                        {{ \Illuminate\Support\Str::limit($pemeriksaan->keluhan, 35) }}
                                    </span>
                                </td>


                                {{-- RESEP --}}
                                <td>
                                    {{ $pemeriksaan->resep_obat }}
                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- LIHAT --}}
                                        <a href="{{ route('pemeriksaan-dokter.show', $pemeriksaan->id) }}"
                                           class="btn btn-info btn-sm text-white"
                                           title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('pemeriksaan-dokter.edit', $pemeriksaan->id) }}"
                                           class="btn btn-warning btn-sm"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- HAPUS --}}
                                        <form action="{{ route('pemeriksaan-dokter.destroy', $pemeriksaan->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus data pemeriksaan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8"
                                    class="text-center py-5">

                                    <i class="bi bi-clipboard-x fs-1 text-muted"></i>

                                    <p class="text-muted mt-3 mb-0">
                                        Belum ada data pemeriksaan dokter.
                                    </p>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection