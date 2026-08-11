@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h4 class="mb-0">Master Dokter</h4>

        <a href="{{ route('master-dokter.create') }}"
           class="btn btn-success">
            + Tambah Dokter
        </a>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Dokter</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Spesialis</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($dokters as $dokter)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $dokter->kode_dokter }}</td>

                        <td>{{ $dokter->nama }}</td>

                        <td>{{ ucfirst($dokter->jenis_kelamin) }}</td>

                        <td>{{ $dokter->spesialis ?? '-' }}</td>

                        <td>{{ $dokter->no_hp ?? '-' }}</td>

                        <td>

                            <a href="{{ route('master-dokter.show', $dokter->id) }}"
                               class="btn btn-info btn-sm">
                                Lihat
                            </a>

                            <a href="{{ route('master-dokter.edit', $dokter->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master-dokter.destroy', $dokter->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data dokter ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data dokter
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection