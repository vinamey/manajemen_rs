@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Master Tindakan</h4>

        <a href="{{ route('master-tindakan.create') }}"
           class="btn btn-success">
            + Tambah Tindakan
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
                    <th>Nama Tindakan</th>
                    <th width="220">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($tindakans as $tindakan)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $tindakan->kode }}</td>

                    <td>{{ $tindakan->nama }}</td>

                    <td>

                        <a href="{{ route('master-tindakan.show', $tindakan->id) }}"
                           class="btn btn-info btn-sm">
                            Lihat
                        </a>

                        <a href="{{ route('master-tindakan.edit', $tindakan->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('master-tindakan.destroy', $tindakan->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus data tindakan ini?')">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada data tindakan.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection