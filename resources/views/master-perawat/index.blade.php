@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between">
        <h4 class="mb-0">Master Perawat</h4>

        <a href="{{ route('master-perawat.create') }}"
           class="btn btn-success">
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
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($perawats as $perawat)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $perawat->Nama }}</td>

                        <td>{{ ucfirst($perawat->Jenis_Kelamin) }}</td>

                        <td>{{ $perawat->Tanggal_Lahir }}</td>

                        <td>{{ $perawat->Alamat }}</td>

                        <td>

                            <a href="{{ route('master-perawat.show', $perawat->id) }}"
                               class="btn btn-info btn-sm">
                                Lihat
                            </a>

                            <a href="{{ route('master-perawat.edit', $perawat->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master-perawat.destroy', $perawat->id) }}"
                                  method="POST"
                                  style="display:inline">

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

                @empty

                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data perawat.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection