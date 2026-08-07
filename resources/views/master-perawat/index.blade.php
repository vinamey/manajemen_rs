@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between">

        <h4>Master Perawat</h4>

        <a href="{{ route('master-perawat.create') }}" class="btn btn-success">
            + Tambah Perawat
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
                <th>Nama Perawat</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($perawats as $perawat)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $perawat->nama_perawat }}</td>

                <td>{{ $perawat->no_hp }}</td>

                <td>{{ $perawat->alamat }}</td>

                <td>

                    <a href="{{ route('master-perawat.edit',$perawat->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('master-perawat.destroy',$perawat->id) }}"
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

                <td colspan="5" class="text-center">
                    Tidak ada data perawat.
                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection