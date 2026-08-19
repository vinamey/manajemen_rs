
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Dokter - RS Sehat</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        }

        .logo i {
            font-size: 45px;
        }

        .menu {
            margin-top: 15px;
        }

        .menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: block;
            padding: 14px 25px;
            transition: 0.3s;
            font-size: 15px;
        }

        .menu a:hover,
        .menu a.active {
            color: white;
            background: rgba(255, 255, 255, 0.15);
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
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
        }

        /* CARD */
        .page-card {
            background: white;
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        /* ICON */
        .doctor-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: #e8f1ff;
            color: #0d6efd;
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
            background: #f0f7ff;
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

        /* BADGES */
        .badge-spesialis {
            background: #e7f1ff;
            color: #0d6efd;
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-poli {
            background: #e8f8ef;
            color: #198754;
            padding: 7px 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
        }

        /* EMPTY */
        .empty-state {
            padding: 50px;
            text-align: center;
            color: #6c757d;
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
                 SIM RS
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

            <a href="{{ route('master-dokters.index') }}" class="active">
                <i class="bi bi-person-badge-fill me-2"></i>
                Data Dokter
            </a>

            <a href="{{ route('master-perawat.index') }}">
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
                    <i class="bi bi-person-badge-fill text-primary me-2"></i>
                    Data Dokter
                </h3>

                <p class="text-muted mb-0">
                    Kelola data dokter rumah sakit
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


        <!-- CARD DATA DOKTER -->
        <div class="page-card p-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="d-flex align-items-center gap-3">

                    <div class="doctor-icon">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Daftar Dokter
                        </h5>

                        <small class="text-muted">
                            Data dokter yang terdaftar
                        </small>
                    </div>

                </div>

                <a href="{{ route('master-dokters.create') }}"
                   class="btn btn-primary btn-tambah">

                    <i class="bi bi-plus-circle me-1"></i>
                    Tambah Dokter

                </a>

            </div>


            <!-- SUCCESS -->
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
                            <th>Nama Dokter</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Spesialis</th>
                            <th>Poli</th>
                            <th class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse($dokters as $dokter)

                            <tr>

                                <!-- NO -->
                                <td class="fw-bold text-muted">
                                    {{ $loop->iteration }}
                                </td>


                                <!-- NAMA -->
                                <td>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="doctor-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>

                                        <div>

                                            <div class="fw-bold">
                                                {{ $dokter->nama }}
                                            </div>

                                            <small class="text-muted">
                                                ID: {{ $dokter->id }}
                                            </small>

                                        </div>

                                    </div>

                                </td>


                                <!-- JENIS KELAMIN -->
                                <td>

                                    @if($dokter->jenis_kelamin == 'laki-laki')

                                        <span class="badge bg-primary">
                                            <i class="bi bi-gender-male me-1"></i>
                                            Laki-laki
                                        </span>

                                    @elseif($dokter->jenis_kelamin == 'perempuan')

                                        <span class="badge bg-danger">
                                            <i class="bi bi-gender-female me-1"></i>
                                            Perempuan
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            -
                                        </span>

                                    @endif

                                </td>


                                <!-- TANGGAL LAHIR -->
                                <td>
                                    {{ $dokter->tanggal_lahir }}
                                </td>


                                <!-- SPESIALIS -->
                                <td>

                                    <span class="badge-spesialis">

                                        <i class="bi bi-award me-1"></i>

                                        {{ $dokter->spesialis ?? '-' }}

                                    </span>

                                </td>


                                <!-- POLI -->
                                <td>

                                    <span class="badge-poli">

                                        <i class="bi bi-hospital me-1"></i>

                                        {{ $dokter->poli->nama ?? '-' }}

                                    </span>

                                </td>


                                <!-- AKSI -->
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->
                                        <a href="{{ route('master-dokters.edit', $dokter->id) }}"
                                           class="btn btn-warning btn-sm btn-edit">

                                            <i class="bi bi-pencil-square"></i>
                                            Edit

                                        </a>


                                        <!-- HAPUS -->
                                        <form action="{{ route('master-dokters.destroy', $dokter->id) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm btn-hapus"
                                                    onclick="return confirm('Yakin ingin menghapus data dokter ini?')">

                                                <i class="bi bi-trash3"></i>
                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7">

                                    <div class="empty-state">

                                        <i class="bi bi-person-badge display-4 d-block mb-3 text-secondary"></i>

                                        <h5 class="fw-bold">
                                            Data Dokter Belum Ada
                                        </h5>

                                        <p class="mb-3">
                                            Belum terdapat dokter yang terdaftar.
                                        </p>

                                        <a href="{{ route('master-dokters.create') }}"
                                           class="btn btn-primary btn-tambah">

                                            <i class="bi bi-plus-circle me-1"></i>
                                            Tambah Dokter

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
