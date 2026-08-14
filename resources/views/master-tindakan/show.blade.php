@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Tindakan</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">ID</th>
                <td>{{ $tindakan->id }}</td>
            </tr>

            <tr>
                <th>Kode Tindakan</th>
                <td>{{ $tindakan->kode }}</td>
            </tr>

            <tr>
                <th>Nama Tindakan</th>
                <td>{{ $tindakan->nama }}</td>
            </tr>

        </table>

        <a href="{{ route('master-tindakan.edit', $tindakan->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-tindakan.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection