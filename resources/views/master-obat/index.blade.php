@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Master Obat</h4>

        <a href="{{ route('master-obat.create') }}"
           class="btn btn-success">
            + Tambah Obat
        </a>

    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($obats as $obat)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $obat->kode_obat }}</td>

                        <td>{{ $obat->nama_obat }}</td>

                        <td>{{ $obat->kategori }}</td>

                        <td>{{ $obat->satuan }}</td>

                        <td>
    Rp {{ number_format($obat->harga, 0, ',', '.') }}
</td>

                        <td>

    @if($obat->stok <= 0)

        <span class="badge bg-danger">
            Habis
        </span>

    @elseif($obat->stok <= $obat->stok_minimum)

        <span class="badge bg-warning text-dark">
            Stok Menipis
        </span>

    @else

        <span class="badge bg-success">
            Stok Aman
        </span>

    @endif

    <div class="mt-1">
        {{ $obat->stok }} {{ $obat->satuan }}
    </div>

</td>

                        <td>

                            <a href="{{ route('master-obat.show', $obat->id) }}"
                               class="btn btn-info btn-sm">
                                Lihat
                            </a>

                            <a href="{{ route('master-obat.edit', $obat->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master-obat.destroy', $obat->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus obat ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center">
                            Belum ada data obat.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
