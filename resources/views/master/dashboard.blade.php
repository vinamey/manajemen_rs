<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Rumah Sakit</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f4f8fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

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
            font-size: 50px;
        }

        .menu {
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            display: block;
            padding: 14px 25px;
            transition: all 0.3s ease;
            font-size: 15px;
        }

        .menu a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.15);
            padding-left: 32px;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
        }

        .topbar {
            background: white;
            border-radius: 18px;
            padding: 20px 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .card-dashboard {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
        }

        .card-dashboard:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 26px;
        }

        .quick-btn {
            border-radius: 14px;
            padding: 18px;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

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

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <div class="logo">
            <i class="bi bi-hospital"></i>
            <h4 class="mt-2 fw-bold">RS Sehat</h4>
            <small class="text-white-50">Admin Rumah Sakit</small>
        </div>

        <div class="menu">
            <a href="/">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="/master-pasien">
                <i class="bi bi-people-fill me-2"></i> Data Pasien
            </a>
            <a href="/master-dokters">
                <i class="bi bi-person-badge-fill me-2"></i> Data Dokter
            </a>
            <a href="/master-perawat">
                <i class="bi bi-heart-pulse-fill me-2"></i> Data Perawat
            </a>
            <a href="/master-apoteker">
                <i class="bi bi-capsule me-2"></i> Data Apoteker
            </a>
            <a href="/master-kasir">
                <i class="bi bi-cash-stack me-2"></i> Data Kasir
            </a>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="content">

        <!-- Topbar -->
        <div class="topbar d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h3 class="fw-bold mb-1">Dashboard Admin Rumah Sakit</h3>
                <p class="text-muted mb-0">Selamat Datang di Sistem Informasi Rumah Sakit</p>
            </div>
            <div class="text-md-end">
                <h6 class="fw-bold mb-0">Administrator</h6>
                <small class="text-muted"><i class="bi bi-calendar3 me-1"></i>{{ date('d F Y') }}</small>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
                <div class="card card-dashboard p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold">Total Pasien</small>
                            <h2 class="fw-bold text-primary mb-0 mt-1">{{ $totalPasien }}</h2>
                        </div>
                        <div class="icon-circle bg-primary">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-dashboard p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold">Total Dokter</small>
                            <h2 class="fw-bold text-success mb-0 mt-1">{{ $totalDokter }}</h2>
                        </div>
                        <div class="icon-circle bg-success">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-dashboard p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted fw-semibold">Total Perawat</small>
                            <h2 class="fw-bold text-info mb-0 mt-1">{{ $totalPerawat }}</h2>
                        </div>
                        <div class="icon-circle bg-info">
                            <i class="bi bi-heart-pulse-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3">
                <div class="card card-dashboard p-4">
                    <div class="d-flex justify-content-between align-items-center">
                       
                        <div class="icon-circle bg-warning">
                            <i class="bi bi-capsule"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="row g-4 mt-2">
            <!-- Quick Menu -->
            <div class="col-lg-8">
                <div class="card card-dashboard p-4 h-100">
                    <h5 class="fw-bold mb-4">Quick Menu</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="/master-pasien" class="btn btn-primary w-100 quick-btn">
                                <i class="bi bi-people-fill fs-5"></i> Data Pasien
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/master-dokters" class="btn btn-success w-100 quick-btn">
                                <i class="bi bi-person-badge-fill fs-5"></i> Data Dokter
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/master-perawat" class="btn btn-info text-white w-100 quick-btn">
                                <i class="bi bi-heart-pulse-fill fs-5"></i> Data Perawat
                            </a>
                        </div>

                </div>
            </div>

            <!-- Information Card -->
            <div class="col-lg-4">
                <div class="card card-dashboard p-4 h-100">
                    <h5 class="fw-bold mb-3">Informasi Sistem</h5>
                    <p class="text-muted small leading-relaxed">
                        Selamat datang di Sistem Informasi Rumah Sakit. Gunakan menu navigasi di samping atau tombol pintas untuk mengelola data operasional rumah sakit dengan cepat.
                    </p>
                    <hr class="my-3">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-calendar-event text-primary"></i>
                        <span class="small fw-semibold">{{ date('d F Y') }}</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle text-success"></i>
                        <span class="small fw-semibold">Administrator</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
