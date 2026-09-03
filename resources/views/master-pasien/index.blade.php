@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Perawat')

@section('content')

<style>
    /* ================================
       MASTER PERAWAT
    ================================= */

    .master-perawat {
        padding: 10px 5px 30px;
    }

    .master-perawat .card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        background: #ffffff;
    }

    /* ================================
       HEADER
    ================================= */

    .master-perawat .card-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #ffffff;
        padding: 20px 24px;
        border: none;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .header-title h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .header-title small {
        display: block;
        margin-top: 3px;
        opacity: 0.85;
        font-size: 13px;
    }

    /* ================================
       BUTTON TAMBAH
    ================================= */

    .btn-tambah {
        background: #ffffff;
        color: #0d6efd;
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-tambah:hover {
        background: #f1f6ff;
        color: #0b5ed7;
        transform: translateY(-1px);
    }

    /* ================================
       BODY
    ================================= */

    .master-perawat .card-body {
        padding: 24px;
    }

    /* ================================
       TABLE
    ================================= */

    .table-wrapper {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table thead th {
        background: #f4f7fb;
        color: #495057;
        font-size: 13px;
        font-weight: 700;
        padding: 14px 16px;
        border-bottom: 1px solid #e3e7ec;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 14px 16px;
        color: #495057;
        font-size: 14px;
        border-bottom: 1px solid #f0f1f3;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr {
        transition: background 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f8fbff;
    }

    /* ================================
       NOMOR
    ================================= */

    .nomor {
        width: 45px;
        text-align: center;
        font-weight: 600;
        color: #6c757d;
    }

    /* ================================
       NAMA PERAWAT
    ================================= */

    .nama-perawat {
        font-weight: 600;
        color: #212529;
    }

    /* ================================
       BADGE JENIS KELAMIN
    ================================= */

    .badge-gender {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #eef5ff;
        color: #0d6efd;
    }

    /* ================================
       ALAMAT
    ================================= */

    .alamat {
        max-width: 280px;
        color: #6c757d;
    }

    /* ================================
       TOMBOL AKSI
    ================================= */

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-edit {
        background: #eaf3ff;
        color: #0d6efd;
    }

    .btn-edit:hover {
        background: #0d6efd;
        color: #ffffff;
    }

    .btn-delete {
        background: #fff0f0;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: #ffffff;
    }

    /* ================================
       EMPTY DATA
    ================================= */

    .empty-data {
        text-align: center;
        padding: 55px 20px !important;
        color: #6c757d;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .empty-data h6 {
        font-weight: 700;
        color: #495057;
        margin-bottom: 5px;
    }

    .empty-data p {
        margin-bottom: 0;
        font-size: 13px;
    }

    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 768px) {

        .master-perawat .card-header {
            padding: 16px;
        }

        .master-perawat .card-body {
            padding: 15px;
        }

        .header-title h4 {
            font-size: 17px;
        }

        .header-title small {
            font-size: 11px;
        }

        .btn-tambah {
            padding: 8px 12px;
            font-size: 12px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            min-width: 850px;
        }
    }
</style>


<div class="master-perawat">

    <div class="card">

        {{-- ================================
             HEADER
        ================================= --}}
        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">

                <div class="header-title">

                    <div class="header-icon">
                        <i class="fas fa-user-nurse"></i>
                    </div>

                    <div>
                        <h4>Master Perawat</h4>
                        <small>Kelola data perawat rumah sakit</small>
                    </div>

                </div>

                {{-- TOMBOL TAMBAH --}}
                <a href="{{ route('master-perawat.create') }}"
                   class="btn btn-tambah">

                    <i class="fas fa-plus me-1"></i>
                    Tambah Perawat

                </a>

            </div>

        </div>


        {{-- ================================
             BODY
        ================================= --}}
        <div class="card-body">

            <div class="table-wrapper">

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th class="text-center" style="width: 60px;">
                                    No
                                </th>

                                <th>
                                    Nama Perawat
                                </th>

                                <th>
                                    Jenis Kelamin
                                </th>

                                <th>
                                    Tanggal Lahir
                                </th>

                                <th>
                                    Alamat
                                </th>

                                <th class="text-center" style="width: 130px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($perawats as $perawat)

                                <tr>

                                    {{-- NO --}}
                                    <td class="nomor">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- NAMA --}}
                                    <td>
                                        <span class="nama-perawat">
                                            {{ $perawat->nama }}
                                        </span>
                                    </td>


                                    {{-- JENIS KELAMIN --}}
                                    <td>

                                        @if($perawat->jenis_kelamin == 'laki-laki')

                                            <span class="badge-gender">
                                                <i class="fas fa-mars"></i>
                                                Laki-laki
                                            </span>

                                        @else

                                            <span class="badge-gender">
                                                <i class="fas fa-venus"></i>
                                                Perempuan
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TANGGAL LAHIR --}}
                                    <td>

                                        @if($perawat->tanggal_lahir)

                                            {{ \Carbon\Carbon::parse($perawat->tanggal_lahir)->format('d-m-Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- ALAMAT --}}
                                    <td>

                                        <span class="alamat">
                                            {{ $perawat->alamat ?? '-' }}
                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="action-buttons">

                                            {{-- EDIT --}}
                                            <a href="{{ route('master-perawat.edit', $perawat->id) }}"
                                               class="btn-action btn-edit"
                                               title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>


                                            {{-- DELETE --}}
                                            <form action="{{ route('master-perawat.destroy', $perawat->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data perawat ini?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn-action btn-delete"
                                                        title="Hapus">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="empty-data">

                                        <div class="empty-icon">
                                            <i class="fas fa-user-nurse"></i>
                                        </div>

                                        <h6>Belum Ada Data Perawat</h6>

                                        <p>
                                            Silakan tambahkan data perawat terlebih dahulu.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection@extends('layouts.superadmin')

@section('page-title', 'Dashboard Master Perawat')

@section('content')

<style>
    /* ================================
       MASTER PERAWAT
    ================================= */

    .master-perawat {
        padding: 10px 5px 30px;
    }

    .master-perawat .card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        background: #ffffff;
    }

    /* ================================
       HEADER
    ================================= */

    .master-perawat .card-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: #ffffff;
        padding: 20px 24px;
        border: none;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    .header-title h4 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .header-title small {
        display: block;
        margin-top: 3px;
        opacity: 0.85;
        font-size: 13px;
    }

    /* ================================
       BUTTON TAMBAH
    ================================= */

    .btn-tambah {
        background: #ffffff;
        color: #0d6efd;
        border: none;
        border-radius: 9px;
        padding: 10px 17px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .btn-tambah:hover {
        background: #f1f6ff;
        color: #0b5ed7;
        transform: translateY(-1px);
    }

    /* ================================
       BODY
    ================================= */

    .master-perawat .card-body {
        padding: 24px;
    }

    /* ================================
       TABLE
    ================================= */

    .table-wrapper {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table thead th {
        background: #f4f7fb;
        color: #495057;
        font-size: 13px;
        font-weight: 700;
        padding: 14px 16px;
        border-bottom: 1px solid #e3e7ec;
        white-space: nowrap;
    }

    .table tbody td {
        padding: 14px 16px;
        color: #495057;
        font-size: 14px;
        border-bottom: 1px solid #f0f1f3;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tbody tr {
        transition: background 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f8fbff;
    }

    /* ================================
       NOMOR
    ================================= */

    .nomor {
        width: 45px;
        text-align: center;
        font-weight: 600;
        color: #6c757d;
    }

    /* ================================
       NAMA PERAWAT
    ================================= */

    .nama-perawat {
        font-weight: 600;
        color: #212529;
    }

    /* ================================
       BADGE JENIS KELAMIN
    ================================= */

    .badge-gender {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background: #eef5ff;
        color: #0d6efd;
    }

    /* ================================
       ALAMAT
    ================================= */

    .alamat {
        max-width: 280px;
        color: #6c757d;
    }

    /* ================================
       TOMBOL AKSI
    ================================= */

    .action-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-edit {
        background: #eaf3ff;
        color: #0d6efd;
    }

    .btn-edit:hover {
        background: #0d6efd;
        color: #ffffff;
    }

    .btn-delete {
        background: #fff0f0;
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: #ffffff;
    }

    /* ================================
       EMPTY DATA
    ================================= */

    .empty-data {
        text-align: center;
        padding: 55px 20px !important;
        color: #6c757d;
    }

    .empty-icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .empty-data h6 {
        font-weight: 700;
        color: #495057;
        margin-bottom: 5px;
    }

    .empty-data p {
        margin-bottom: 0;
        font-size: 13px;
    }

    /* ================================
       RESPONSIVE
    ================================= */

    @media (max-width: 768px) {

        .master-perawat .card-header {
            padding: 16px;
        }

        .master-perawat .card-body {
            padding: 15px;
        }

        .header-title h4 {
            font-size: 17px;
        }

        .header-title small {
            font-size: 11px;
        }

        .btn-tambah {
            padding: 8px 12px;
            font-size: 12px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            min-width: 850px;
        }
    }
</style>


<div class="master-perawat">

    <div class="card">

        {{-- ================================
             HEADER
        ================================= --}}
        <div class="card-header">

            <div class="d-flex justify-content-between align-items-center">

                <div class="header-title">

                    <div class="header-icon">
                        <i class="fas fa-user-nurse"></i>
                    </div>

                    <div>
                        <h4>Master Perawat</h4>
                        <small>Kelola data perawat rumah sakit</small>
                    </div>

                </div>

                {{-- TOMBOL TAMBAH --}}
                <a href="{{ route('master-perawat.create') }}"
                   class="btn btn-tambah">

                    <i class="fas fa-plus me-1"></i>
                    Tambah Perawat

                </a>

            </div>

        </div>


        {{-- ================================
             BODY
        ================================= --}}
        <div class="card-body">

            <div class="table-wrapper">

                <div class="table-responsive">

                    <table class="table">

                        <thead>

                            <tr>

                                <th class="text-center" style="width: 60px;">
                                    No
                                </th>

                                <th>
                                    Nama Perawat
                                </th>

                                <th>
                                    Jenis Kelamin
                                </th>

                                <th>
                                    Tanggal Lahir
                                </th>

                                <th>
                                    Alamat
                                </th>

                                <th class="text-center" style="width: 130px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($perawats as $perawat)

                                <tr>

                                    {{-- NO --}}
                                    <td class="nomor">
                                        {{ $loop->iteration }}
                                    </td>


                                    {{-- NAMA --}}
                                    <td>
                                        <span class="nama-perawat">
                                            {{ $perawat->nama }}
                                        </span>
                                    </td>


                                    {{-- JENIS KELAMIN --}}
                                    <td>

                                        @if($perawat->jenis_kelamin == 'laki-laki')

                                            <span class="badge-gender">
                                                <i class="fas fa-mars"></i>
                                                Laki-laki
                                            </span>

                                        @else

                                            <span class="badge-gender">
                                                <i class="fas fa-venus"></i>
                                                Perempuan
                                            </span>

                                        @endif

                                    </td>


                                    {{-- TANGGAL LAHIR --}}
                                    <td>

                                        @if($perawat->tanggal_lahir)

                                            {{ \Carbon\Carbon::parse($perawat->tanggal_lahir)->format('d-m-Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>


                                    {{-- ALAMAT --}}
                                    <td>

                                        <span class="alamat">
                                            {{ $perawat->alamat ?? '-' }}
                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="action-buttons">

                                            {{-- EDIT --}}
                                            <a href="{{ route('master-perawat.edit', $perawat->id) }}"
                                               class="btn-action btn-edit"
                                               title="Edit">

                                                <i class="fas fa-edit"></i>

                                            </a>


                                            {{-- DELETE --}}
                                            <form action="{{ route('master-perawat.destroy', $perawat->id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data perawat ini?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn-action btn-delete"
                                                        title="Hapus">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="empty-data">

                                        <div class="empty-icon">
                                            <i class="fas fa-user-nurse"></i>
                                        </div>

                                        <h6>Belum Ada Data Perawat</h6>

                                        <p>
                                            Silakan tambahkan data perawat terlebih dahulu.
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
