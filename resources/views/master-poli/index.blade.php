@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Master Poli</h4>

        <a href="{{ route('master-poli.create') }}" class="btn btn-success">
            + Tambah Poli
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
                    <th>Nama Poli</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($polis as $poli)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $poli->nama_poli }}</td>

                    <td>

                        <a href="{{ route('master-poli.show', $poli->id) }}"
                           class="btn btn-info btn-sm">
                            Lihat
                        </a>

                        <a href="{{ route('master-poli.edit', $poli->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('master-poli.destroy', $poli->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus poli ini?')">
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="3" class="text-center">
                        Belum ada data poli.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>
</div>

@endsection