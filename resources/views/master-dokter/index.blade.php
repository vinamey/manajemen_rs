@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between">

        <h4>Master Dokter</h4>

        <a href="{{ route('master-dokter.create') }}" class="btn btn-success">
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
                <th>Nama Dokter</th>
                <th>Spesialis</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($dokters as $dokter)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $dokter->nama_dokter }}</td>

                <td>{{ $dokter->spesialis }}</td>

                <td>{{ $dokter->no_hp }}</td>

                <td>{{ $dokter->alamat }}</td>

                <td>

                    <a href="{{ route('master-dokter.edit',$dokter->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('master-dokter.destroy',$dokter->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Hapus data?')">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center">
                    Tidak ada data dokter.
                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection