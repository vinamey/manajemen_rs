@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">

        <h4>Detail Pasien</h4>

    </div>

    <div class="card-body">

        <table class="table">

            <tr>
                <th>No RM</th>
                <td>{{ $pasien->no_rm }}</td>
            </tr>

            <tr>
                <th>Nama</th>
                <td>{{ $pasien->nama }}</td>
            </tr>

            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $pasien->jenis_kelamin }}</td>
            </tr>

            <tr>
                <th>No HP</th>
                <td>{{ $pasien->no_hp }}</td>
            </tr>

        </table>

        <a href="{{ route('master-pasien.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection