<!DOCTYPE html>

<html lang="id">

<head>

```
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Apoteker - RS Sehat</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
      rel="stylesheet">


<style>

    body {
        background: #f4f8fc;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }


    /* SIDEBAR */

    .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 260px;
        height: 100vh;
        background: linear-gradient(180deg, #0d6efd, #0b5ed7);
        color: white;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
        z-index: 1000;
        overflow-y: auto;
    }


    .logo {
        padding: 30px 20px;
        text-align: center;
        border-bottom: 1px solid rgba(255,255,255,0.15);
    }


    .logo i {
        font-size: 50px;
    }


    .menu {
        margin-top: 15px;
    }


    .menu a {
        color: rgba(255,255,255,0.9);
        text-decoration: none;
        display: block;
        padding: 14px 25px;
        transition: 0.3s;
        font-size: 15px;
    }


    .menu a:hover,
    .menu a.active {
        color: white;
        background: rgba(255,255,255,0.15);
        padding-left: 32px;
    }


    /* CONTENT */

    .content {
        margin-left: 260px;
        padding: 30px;
        min-height: 100vh;
    }


    /* HEADER */

    .page-header {
        background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        color: white;
        border-radius: 18px;
        padding: 25px 28px;
        margin-bottom: 25px;
        box-shadow: 0 8px 25px rgba(13,110,253,0.15);
    }


    .page-header h2 {
        font-weight: 700;
        margin-bottom: 5px;
    }


    .page-header p {
        margin: 0;
        opacity: 0.85;
    }


    /* BUTTON TAMBAH */

    .btn-add {
        background: white;
        color: #0d6efd;
        border: none;
        border-radius: 10px;
        padding: 10px 18px;
        font-weight: 600;
        transition: 0.3s;
    }


    .btn-add:hover {
        background: #eaf2ff;
        color: #0b5ed7;
        transform: translateY(-2px);
    }


    /* CARD */

    .data-card {
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        overflow: hidden;
        background: white;
    }


    .card-title {
        font-weight: 700;
        color: #1e293b;
    }


    /* TABLE */

    .table {
        margin-bottom: 0;
    }


    .table thead th {
        background: #0d6efd;
        color: white;
        border: none;
        padding: 14px 15px;
        font-size: 14px;
        white-space: nowrap;
    }


    .table tbody td {
        padding: 14px 15px;
        vertical-align: middle;
        color: #475569;
    }


    .table tbody tr {
        transition: 0.2s;
    }


    .table tbody tr:hover {
        background: #f4f8ff;
    }


    /* NOMOR */

    .number-badge {
        width: 32px;
        height: 32px;
        background: #e7f1ff;
        color: #0d6efd;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }


    /* NAMA */

    .apoteker-name {
        font-weight: 600;
        color: #1e293b;
    }


    /* NO HP */

    .no-hp {
        color: #475569;
        font-weight: 500;
    }


    /* BUTTON AKSI */

    .btn-edit {
        background: #fff3cd;
        color: #856404;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 7px 12px;
    }


    .btn-edit:hover {
        background: #ffc107;
        color: #212529;
    }


    .btn-delete {
        background: #ffe5e5;
        color: #dc3545;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        padding: 7px 12px;
    }


    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }


    /* DATA KOSONG */

    .empty-state {
        padding: 50px 20px !important;
        color: #94a3b8 !important;
    }


    .empty-state i {
        font-size: 45px;
        margin-bottom: 10px;
    }


    /* RESPONSIVE */

    @media (max-width: 991.98px) {

        .sidebar {
            position: relative;
            width: 100%;
            height: auto;
        }


        .content {
            margin-left: 0;
            padding: 20px;
        }

    }

</style>
```

</head>

<body>

```
<!-- =====================================================
     SIDEBAR
====================================================== -->

<div class="sidebar">


    <div class="logo">

        <i class="bi bi-hospital"></i>

        <h4 class="mt-2 fw-bold">
            RS Sehat
        </h4>

        <small class="text-white-50">
            Admin Rumah Sakit
        </small>

    </div>


    <div class="menu">


        <a href="{{ url('/dashboard') }}">

            <i class="bi bi-speedometer2 me-2"></i>

            Dashboard

        </a>


        <a href="{{ route('master-pasien.index') }}">

            <i class="bi bi-people-fill me-2"></i>

            Data Pasien

        </a>


        <a href="{{ route('master-dokters.index') }}">

            <i class="bi bi-person-badge-fill me-2"></i>

            Data Dokter

        </a>


        <a href="{{ route('master-perawat.index') }}">

            <i class="bi bi-heart-pulse-fill me-2"></i>

            Data Perawat

        </a>


        <a href="{{ route('master-apoteker.index') }}"
           class="active">

            <i class="bi bi-capsule me-2"></i>

            Data Apoteker

        </a>


        <a href="{{ route('kasir.index') }}">

            <i class="bi bi-cash-stack me-2"></i>

            Data Kasir

        </a>


    </div>

</div>


<!-- =====================================================
     CONTENT
====================================================== -->

<div class="content">


    <!-- HEADER -->

    <div class="page-header">


        <div class="d-flex flex-column flex-md-row
                    justify-content-between
                    align-items-md-center gap-3">


            <div>

                <h2>

                    <i class="bi bi-capsule me-2"></i>

                    Data Apoteker

                </h2>


                <p>
                    Kelola data apoteker rumah sakit
                </p>

            </div>


            <a href="{{ route('master-apoteker.create') }}"
               class="btn btn-add">

                <i class="bi bi-plus-circle me-1"></i>

                Tambah Apoteker

            </a>


        </div>

    </div>


    <!-- SUCCESS -->

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}


            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <!-- DATA CARD -->

    <div class="card data-card">


        <div class="p-4 border-bottom">

            <h5 class="card-title mb-1">

                <i class="bi bi-person-vcard me-2 text-primary"></i>

                Daftar Apoteker

            </h5>


            <small class="text-muted">

                Data apoteker yang terdaftar dalam sistem

            </small>

        </div>


        <!-- TABLE -->

        <div class="table-responsive">


            <table class="table">


                <thead>

                    <tr>

                        <th width="80">
                            No
                        </th>


                        <th>
                            Nama Apoteker
                        </th>


                        <th>
                            No HP
                        </th>


                        <th width="200">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($apotekers as $apoteker)


                        <tr>


                            <!-- NO -->

                            <td>

                                <span class="number-badge">

                                    {{ $loop->iteration }}

                                </span>

                            </td>


                            <!-- NAMA -->

                            <td>

                                <div class="d-flex align-items-center gap-3">


                                    <div class="rounded-circle
                                                bg-primary
                                                bg-opacity-10
                                                text-primary
                                                d-flex
                                                align-items-center
                                                justify-content-center"
                                         style="width:42px;height:42px;">

                                        <i class="bi bi-person-badge fs-5"></i>

                                    </div>


                                    <span class="apoteker-name">

                                        {{ $apoteker->nama }}

                                    </span>


                                </div>

                            </td>


                            <!-- NO HP -->

                            <td>

                                <span class="no-hp">

                                    <i class="bi bi-telephone-fill text-primary me-2"></i>

                                    {{ $apoteker->no_hp ?? '-' }}

                                </span>

                            </td>


                            <!-- AKSI -->

                            <td>


                                <a href="{{ route('master-apoteker.edit', $apoteker->id) }}"
                                   class="btn btn-edit btn-sm me-1">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </a>


                                <form action="{{ route('master-apoteker.destroy', $apoteker->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf

                                    @method('DELETE')


                                    <button type="submit"
                                            class="btn btn-delete btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data apoteker ini?')">

                                        <i class="bi bi-trash"></i>

                                        Hapus

                                    </button>

                                </form>


                            </td>


                        </tr>


                    @empty


                        <tr>


                            <td colspan="4"
                                class="text-center empty-state">


                                <i class="bi bi-person-x d-block"></i>


                                <strong>
                                    Data Apoteker Belum Ada
                                </strong>


                                <div class="small mt-1">

                                    Silakan tambahkan data apoteker terlebih dahulu.

                                </div>


                            </td>


                        </tr>


                    @endforelse


                </tbody>


            </table>

        </div>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
```

</body>

</html>
