
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Perawat - RS Sehat</title>

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

            background: linear-gradient(
                180deg,
                #0d6efd,
                #0b5ed7
            );

            color: white;

            box-shadow: 0 0 25px rgba(0,0,0,0.15);

            z-index: 1000;

            overflow-y: auto;
        }


        .logo {

            padding: 30px 20px;

            text-align: center;

            border-bottom:
                1px solid rgba(255,255,255,0.15);
        }


        .logo i {

            font-size: 45px;

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

            background:
                rgba(255,255,255,0.15);

            padding-left: 32px;

        }


        /* CONTENT */

        .content {

            margin-left: 260px;

            padding: 30px;

            min-height: 100vh;

        }


        /* TOPBAR */

        .topbar {

            background: white;

            border-radius: 18px;

            padding: 20px 25px;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.05);

            margin-bottom: 25px;

        }


        /* CARD */

        .page-card {

            background: white;

            border: none;

            border-radius: 18px;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.05);

        }


        /* ICON */

        .nurse-icon {

            width: 45px;

            height: 45px;

            border-radius: 12px;

            background: #e7f8ef;

            color: #198754;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 21px;

        }


        /* TABLE */

        .table {

            margin-bottom: 0;

        }


        .table thead th {

            background: #198754;

            color: white;

            border: none;

            padding: 14px;

            font-size: 13px;

            white-space: nowrap;

        }


        .table tbody td {

            padding: 14px;

            vertical-align: middle;

            font-size: 13px;

        }


        .table tbody tr:hover {

            background: #f0fff8;

        }


        /* BUTTON */

        .btn-tambah {

            border-radius: 12px;

            padding: 11px 18px;

            font-weight: 600;

        }


        .btn-edit,
        .btn-hapus {

            border-radius: 8px;

            font-size: 12px;

        }


        /* RESPONSIVE */

        @media (max-width: 991.98px) {

            .sidebar {

                width: 100%;

                height: auto;

                position: relative;

            }


            .content {

                margin-left: 0;

                padding: 20px;

            }

        }

    </style>

</head>


<body>


    <!-- SIDEBAR -->

    <div class="sidebar">


        <div class="logo">

            <i class="bi bi-hospital"></i>

            <h4 class="mt-2 fw-bold mb-1">

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


            <a href="{{ route('master-perawat.index') }}"
               class="active">

                <i class="bi bi-heart-pulse-fill me-2"></i>

                Data Perawat

            </a>


            <a href="{{ route('master-apoteker.index') }}">

                <i class="bi bi-capsule me-2"></i>

                Data Apoteker

            </a>


            <a href="{{ route('kasir.index') }}">

                <i class="bi bi-cash-stack me-2"></i>

                Data Kasir

            </a>


        </div>

    </div>



    <!-- CONTENT -->

    <div class="content">


        <!-- TOPBAR -->

        <div class="topbar d-flex justify-content-between align-items-center">


            <div>

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-heart-pulse-fill text-success me-2"></i>

                    Data Perawat

                </h3>


                <p class="text-muted mb-0">

                    Kelola data perawat rumah sakit

                </p>

            </div>


            <div class="text-end">

                <h6 class="fw-bold mb-0">

                    Administrator

                </h6>


                <small class="text-muted">

                    <i class="bi bi-calendar3 me-1"></i>

                    {{ date('d F Y') }}

                </small>

            </div>


        </div>



        <!-- DATA CARD -->

        <div class="page-card p-4">


            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">


                <div class="d-flex align-items-center gap-3">


                    <div class="nurse-icon">

                        <i class="bi bi-heart-pulse-fill"></i>

                    </div>


                    <div>

                        <h5 class="fw-bold mb-1">

                            Daftar Perawat

                        </h5>


                        <small class="text-muted">

                            Data perawat yang terdaftar

                        </small>

                    </div>

                </div>



                <a href="{{ route('master-perawat.create') }}"
                   class="btn btn-success btn-tambah">


                    <i class="bi bi-plus-circle me-1"></i>

                    Tambah Perawat


                </a>


            </div>



            <!-- SUCCESS MESSAGE -->

            @if(session('success'))

                <div class="alert alert-success d-flex align-items-center">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>

            @endif



            <!-- TABLE -->

            <div class="table-responsive">


                <table class="table table-hover align-middle">


                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Nama Perawat</th>

                            <th>Jenis Kelamin</th>

                            <th>Tanggal Lahir</th>

                            <th>Alamat</th>

                            <th class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        @forelse($perawats as $perawat)


                            <tr>


                                <!-- NO -->

                                <td class="fw-bold text-muted">

                                    {{ $loop->iteration }}

                                </td>



                                <!-- NAMA -->

                                <td>


                                    <div class="d-flex align-items-center gap-2">


                                        <div class="nurse-icon">

                                            <i class="bi bi-person-fill"></i>

                                        </div>


                                        <div>


                                            <div class="fw-bold">

                                                {{ $perawat->nama }}

                                            </div>


                                            <small class="text-muted">

                                                ID: {{ $perawat->id }}

                                            </small>

                                        </div>


                                    </div>


                                </td>



                                <!-- JENIS KELAMIN -->

                                <td>


                                    @if($perawat->jenis_kelamin == 'laki-laki')


                                        <span class="badge bg-primary">

                                            <i class="bi bi-gender-male"></i>

                                            Laki-laki

                                        </span>


                                    @else


                                        <span class="badge bg-danger">

                                            <i class="bi bi-gender-female"></i>

                                            Perempuan

                                        </span>


                                    @endif


                                </td>



                                <!-- TANGGAL LAHIR -->

                                <td>

                                    {{ $perawat->tanggal_lahir }}

                                </td>



                                <!-- ALAMAT -->

                                <td>

                                    <span class="text-muted">

                                        <i class="bi bi-geo-alt me-1"></i>

                                        {{ $perawat->alamat }}

                                    </span>

                                </td>



                                <!-- AKSI -->

                                <td class="text-center">


                                    <div class="d-flex justify-content-center gap-2">


                                        <!-- EDIT -->

                                        <a href="{{ route('master-perawat.edit', $perawat->id) }}"
                                           class="btn btn-warning btn-sm btn-edit">


                                            <i class="bi bi-pencil-square"></i>

                                            Edit


                                        </a>



                                        <!-- HAPUS -->

                                        <form action="{{ route('master-perawat.destroy', $perawat->id) }}"
                                              method="POST"
                                              class="d-inline">


                                            @csrf

                                            @method('DELETE')


                                            <button type="submit"
                                                    class="btn btn-danger btn-sm btn-hapus"
                                                    onclick="return confirm('Yakin ingin menghapus data perawat ini?')">


                                                <i class="bi bi-trash3"></i>

                                                Hapus


                                            </button>


                                        </form>


                                    </div>


                                </td>


                            </tr>


                        @empty


                            <tr>


                                <td colspan="6">


                                    <div class="text-center py-5 text-muted">


                                        <i class="bi bi-heart-pulse display-4 d-block mb-3"></i>


                                        <h5 class="fw-bold">

                                            Data Perawat Belum Ada

                                        </h5>


                                        <p class="mb-3">

                                            Belum terdapat perawat yang terdaftar.

                                        </p>


                                        <a href="{{ route('master-perawat.create') }}"
                                           class="btn btn-success btn-tambah">


                                            <i class="bi bi-plus-circle me-1"></i>

                                            Tambah Perawat


                                        </a>


                                    </div>


                                </td>


                            </tr>


                        @endforelse


                    </tbody>


                </table>


            </div>


        </div>


    </div>



    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>

```blade
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Perawat - RS Sehat</title>

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

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;

            background: linear-gradient(
                180deg,
                #0d6efd,
                #0b5ed7
            );

            color: white;

            box-shadow: 0 0 25px rgba(0,0,0,0.15);

            z-index: 1000;

            overflow-y: auto;
        }

        .logo {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .logo i {
            font-size: 45px;
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

        /* =========================
           CONTENT
        ========================= */

        .content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        /* =========================
           TOPBAR
        ========================= */

        .topbar {
            background: white;
            border-radius: 18px;
            padding: 20px 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 25px;
        }

        /* =========================
           CARD
        ========================= */

        .page-card {
            background: white;
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        }

        /* =========================
           ICON BIRU
        ========================= */

        .nurse-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;

            background: #e7f1ff;
            color: #0d6efd;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 21px;
        }

        /* =========================
           TABLE
        ========================= */

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 14px;
            font-size: 13px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px;
            vertical-align: middle;
            font-size: 13px;
        }

        .table tbody tr:hover {
            background: #f4f8ff;
        }

        /* =========================
           BUTTON TAMBAH
        ========================= */

        .btn-tambah {
            background: #0d6efd;
            border-color: #0d6efd;
            color: white;

            border-radius: 12px;
            padding: 11px 18px;
            font-weight: 600;

            transition: 0.3s;
        }

        .btn-tambah:hover {
            background: #0b5ed7;
            border-color: #0b5ed7;
            color: white;

            transform: translateY(-2px);
        }

        /* =========================
           BUTTON EDIT & HAPUS
        ========================= */

        .btn-edit,
        .btn-hapus {
            border-radius: 8px;
            font-size: 12px;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 991.98px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
                padding: 20px;
            }

        }

    </style>

</head>

<body>

    <!-- =========================
         SIDEBAR
    ========================= -->

    <div class="sidebar">

        <div class="logo">

            <i class="bi bi-hospital"></i>

            <h4 class="mt-2 fw-bold mb-1">
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

            <a href="{{ route('master-perawat.index') }}"
               class="active">

                <i class="bi bi-heart-pulse-fill me-2"></i>
                Data Perawat

            </a>

            <a href="{{ route('master-apoteker.index') }}">

                <i class="bi bi-capsule me-2"></i>
                Data Apoteker

            </a>

            <a href="{{ route('kasir.index') }}">

                <i class="bi bi-cash-stack me-2"></i>
                Data Kasir

            </a>

        </div>

    </div>


    <!-- =========================
         CONTENT
    ========================= -->

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar d-flex justify-content-between align-items-center">

            <div>

                <h3 class="fw-bold mb-1">

                    <i class="bi bi-heart-pulse-fill text-primary me-2"></i>

                    Data Perawat

                </h3>

                <p class="text-muted mb-0">

                    Kelola data perawat rumah sakit

                </p>

            </div>

            <div class="text-end">

                <h6 class="fw-bold mb-0">
                    Administrator
                </h6>

                <small class="text-muted">

                    <i class="bi bi-calendar3 me-1"></i>

                    {{ date('d F Y') }}

                </small>

            </div>

        </div>


        <!-- =========================
             DATA CARD
        ========================= -->

        <div class="page-card p-4">

            <!-- HEADER -->

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="d-flex align-items-center gap-3">

                    <div class="nurse-icon">

                        <i class="bi bi-heart-pulse-fill"></i>

                    </div>

                    <div>

                        <h5 class="fw-bold mb-1">
                            Daftar Perawat
                        </h5>

                        <small class="text-muted">
                            Data perawat yang terdaftar
                        </small>

                    </div>

                </div>

                <a href="{{ route('master-perawat.create') }}"
                   class="btn btn-tambah">

                    <i class="bi bi-plus-circle me-1"></i>

                    Tambah Perawat

                </a>

            </div>


            <!-- SUCCESS MESSAGE -->

            @if(session('success'))

                <div class="alert alert-success d-flex align-items-center">

                    <i class="bi bi-check-circle-fill me-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            <!-- TABLE -->

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>

                        <tr>

                            <th>No</th>

                            <th>Nama Perawat</th>

                            <th>Jenis Kelamin</th>

                            <th>Tanggal Lahir</th>

                            <th>Alamat</th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($perawats as $perawat)

                            <tr>

                                <!-- NO -->

                                <td class="fw-bold text-muted">

                                    {{ $loop->iteration }}

                                </td>


                                <!-- NAMA -->

                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="nurse-icon">

                                            <i class="bi bi-person-fill"></i>

                                        </div>

                                        <div>

                                            <div class="fw-bold">

                                                {{ $perawat->nama }}

                                            </div>

                                            <small class="text-muted">

                                                ID: {{ $perawat->id }}

                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <!-- JENIS KELAMIN -->

                                <td>

                                    @if($perawat->jenis_kelamin == 'laki-laki')

                                        <span class="badge bg-primary">

                                            <i class="bi bi-gender-male"></i>

                                            Laki-laki

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            <i class="bi bi-gender-female"></i>

                                            Perempuan

                                        </span>

                                    @endif

                                </td>


                                <!-- TANGGAL LAHIR -->

                                <td>

                                    {{ $perawat->tanggal_lahir }}

                                </td>


                                <!-- ALAMAT -->

                                <td>

                                    <span class="text-muted">

                                        <i class="bi bi-geo-alt me-1"></i>

                                        {{ $perawat->alamat }}

                                    </span>

                                </td>


                                <!-- AKSI -->

                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->

                                        <a href="{{ route('master-perawat.edit', $perawat->id) }}"
                                           class="btn btn-warning btn-sm btn-edit">

                                            <i class="bi bi-pencil-square"></i>

                                            Edit

                                        </a>


                                        <!-- HAPUS -->

                                        <form action="{{ route('master-perawat.destroy', $perawat->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm btn-hapus"
                                                    onclick="return confirm('Yakin ingin menghapus data perawat ini?')">

                                                <i class="bi bi-trash3"></i>

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="6">

                                    <div class="text-center py-5 text-muted">

                                        <i class="bi bi-heart-pulse display-4 d-block mb-3 text-primary"></i>

                                        <h5 class="fw-bold">
                                            Data Perawat Belum Ada
                                        </h5>

                                        <p class="mb-3">
                                            Belum terdapat perawat yang terdaftar.
                                        </p>

                                        <a href="{{ route('master-perawat.create') }}"
                                           class="btn btn-tambah">

                                            <i class="bi bi-plus-circle me-1"></i>

                                            Tambah Perawat

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

