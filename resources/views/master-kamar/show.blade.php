@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">
        <h4>Detail Kamar</h4>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th width="200">ID</th>
                <td>{{ $kamar->id }}</td>
            </tr>

            <tr>
                <th>Kode Kamar</th>
                <td>{{ $kamar->kode }}</td>
            </tr>

            <tr>
                <th>Nama Kamar</th>
                <td>{{ $kamar->nama }}</td>
            </tr>

            <tr>
                
        </table>

        <a href="{{ route('master-kamar.edit', $kamar->id) }}"
           class="btn btn-warning">
            Edit
        </a>

        <a href="{{ route('master-kamar.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection