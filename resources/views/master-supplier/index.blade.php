@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">Master Supplier</h4>

        <a href="{{ route('master-supplier.create') }}"
           class="btn btn-success">
            + Tambah Supplier
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
                        <th>Kode Supplier</th>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($suppliers as $supplier)

                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $supplier->kode_supplier }}</td>
                        <td>{{ $supplier->nama_supplier }}</td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>{{ $supplier->no_hp }}</td>
                        <td>{{ $supplier->email ?? '-' }}</td>

                        <td>

                            <a href="{{ route('master-supplier.show', $supplier->id) }}"
                               class="btn btn-info btn-sm">
                                Lihat
                            </a>

                            <a href="{{ route('master-supplier.edit', $supplier->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master-supplier.destroy', $supplier->id) }}"
                                  method="POST"
                                  style="display:inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus supplier ini?')">
                                    Hapus
                                </button>

                            </form>

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data supplier.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection