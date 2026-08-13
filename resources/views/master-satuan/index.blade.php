@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Master Satuan Obat
        </h4>

        <a href="{{ route('master-satuan.create') }}"
           class="btn btn-success">

            + Tambah Satuan

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead class="table-dark">

                    <tr>
                        <th width="70">No</th>
                        <th>Nama Satuan</th>
                        <th width="220">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($satuans as $satuan)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $satuan->nama_satuan }}
                        </td>

                        <td>

                            <a href="{{ route('master-satuan.show', $satuan->id) }}"
                               class="btn btn-info btn-sm">

                                Lihat

                            </a>

                            <a href="{{ route('master-satuan.edit', $satuan->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('master-satuan.destroy', $satuan->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus satuan ini?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3" class="text-center">

                            Belum ada data satuan obat.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection