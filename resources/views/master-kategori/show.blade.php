@extends('layouts.superadmin')

@section('content')

<div class="card shadow">

    <div class="card-header bg-info text-white">

        <h4 class="mb-0">Detail Kategori</h4>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="200">
                    Nama Kategori
                </th>

                <td>
                    {{ $kategori->nama_kategori }}
                </td>

            </tr>

        </table>

        <a href="{{ route('master-kategori.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('master-kategori.edit', $kategori->id) }}"
           class="btn btn-warning">
            Edit
        </a>

    </div>

</div>

@endsection