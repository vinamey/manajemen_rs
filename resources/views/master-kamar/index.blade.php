@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Master Kamar</h4>

        <a href="{{ route('master-kamar.create') }}"
           class="btn btn-success">
            + Tambah Kamar
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th width="70">No</th>
                    <th>Kode</th>
                    <th>Nama Kamar</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($kamars as $kamar)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $kamar->kode }}</td>

                    <td>{{ $kamar->nama }}</td>

                    <td>

                        @if($kamar->status == 'tersedia')

                            <span class="badge bg-success">
                                Tersedia
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Terisi
                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('master-kamar.show', $kamar->id) }}"
                           class="btn btn-info btn-sm">
                            Lihat
                        </a>

                        <a href="{{ route('master-kamar.edit', $kamar->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('master-kamar.destroy', $kamar->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kamar ini?')">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center">
                        Belum ada data kamar.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection