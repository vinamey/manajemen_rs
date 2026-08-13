@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4 class="mb-0">Detail Satuan Obat</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">ID</th>
                <td>{{ $satuan->id }}</td>
            </tr>

            <tr>
                <th>Nama Satuan</th>
                <td>{{ $satuan->nama_satuan }}</td>
            </tr>

        </table>

        <a href="{{ route('master-satuan.edit', $satuan->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-satuan.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@endsection