@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between">

        <h4>Master Pasien</h4>

        <a href="{{ route('master-pasien.create') }}" class="btn btn-success">
            + Tambah Pasien
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
                    <th>No</th>
                    <th>No RM</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($pasiens as $pasien)

            <tr>

                <td>{{ $loop->iteration }}</td>
                <td>{{ $pasien->no_rm }}</td>
                <td>{{ $pasien->nama }}</td>
                <td>{{ $pasien->jenis_kelamin }}</td>
                <td>{{ $pasien->no_hp }}</td>

                <td>

                    <a href="{{ route('master-pasien.show',$pasien->id) }}"
                       class="btn btn-info btn-sm">
                        Detail
                    </a>

                    <a href="{{ route('master-pasien.edit',$pasien->id) }}"
                       class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form action="{{ route('master-pasien.destroy',$pasien->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus data?')">

                            Hapus

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="6" class="text-center">
                    Belum ada data pasien
                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection