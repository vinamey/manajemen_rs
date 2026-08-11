@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Asuransi</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">ID</th>
                <td>{{ $asuransi->id }}</td>
            </tr>

            <tr>
                <th>Kode Asuransi</th>
                <td>{{ $asuransi->kode }}</td>
            </tr>

            <tr>
                <th>Nama Asuransi</th>
                <td>{{ $asuransi->nama }}</td>
            </tr>

        </table>

        <a href="{{ route('master-asuransi.edit', $asuransi->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-asuransi.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection