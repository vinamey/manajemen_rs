@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Poli</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">ID</th>
                <td>{{ $poli->id }}</td>
            </tr>

            <tr>
                <th>Nama Poli</th>
                <td>{{ $poli->nama_poli }}</td>
            </tr>

        </table>

        <a href="{{ route('master-poli.edit', $poli->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-poli.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>

@endsection