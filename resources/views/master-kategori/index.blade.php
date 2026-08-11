@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Master Kategori</h4>

        <a href="{{ route('master-kategori.create') }}"
           class="btn btn-success">
            + Tambah Kategori
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>
                    <th width="70">No</th>
                    <th>Nama Kategori</th>
                    <th width="200">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($kategoris as $kategori)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $kategori->nama_kategori }}</td>

                    <td>

                        <a href="{{ route('master-kategori.show', $kategori->id) }}"
                           class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <a href="{{ route('master-kategori.edit', $kategori->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('master-kategori.destroy', $kategori->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="3" class="text-center">
                        Belum ada data kategori.
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection