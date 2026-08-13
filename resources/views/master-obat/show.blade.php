@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">

        <h4 class="mb-0">Detail Obat</h4>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">Kode Obat</th>
                <td>{{ $obat->kode_obat }}</td>
            </tr>

            <tr>
                <th>Nama Obat</th>
                <td>{{ $obat->nama_obat }}</td>
            </tr>

            <tr>
                <th>Kategori</th>
                <td>{{ $obat->kategori }}</td>
            </tr>

            <tr>
                <th>Satuan</th>
                <td>{{ $obat->satuan }}</td>
            </tr>

            <tr>
                <th>Harga</th>
                <td>
                    Rp {{ number_format($obat->harga, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <th>Stok</th>
                <td>{{ $obat->stok }}</td>
            </tr>

        </table>

        <a href="{{ route('master-obat.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('master-obat.edit', $obat->id) }}"
           class="btn btn-warning">
            Edit
        </a>

    </div>

</div>

@endsection