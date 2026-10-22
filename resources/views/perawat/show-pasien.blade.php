<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pasien - Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6fa;
            font-family: Arial, sans-serif;
            color: #263445;
        }

        .page {
            max-width: 950px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .header {
            background: linear-gradient(135deg, #1877f2, #0f58c6);
            color: white;
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .panel {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(20, 50, 90, .06);
        }

        .info-item {
            padding: 16px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #718096;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .info-value {
            color: #263445;
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .btn-back {
            background: white;
            border: 1px solid #1877f2;
            color: #1877f2;
            border-radius: 8px;
            padding: 9px 15px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: #1877f2;
            color: white;
        }

        .patient-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .2);
            border-radius: 14px;
            font-size: 25px;
        }
    </style>
</head>

<body>
<div class="page">

    <div class="mb-3">
        <a href="{{ route('perawat.pasien.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            Kembali ke Data Pasien
        </a>
    </div>

    <div class="header">
        <div class="d-flex align-items-center gap-3">
            <div class="patient-icon">
                <i class="fas fa-hospital-user"></i>
            </div>

            <div>
                <h3 class="fw-bold mb-1">Detail Pasien</h3>
                <p class="mb-0">Informasi lengkap pasien</p>
            </div>
        </div>
    </div>

    <div class="panel">
        <h5 class="fw-bold mb-3">
            <i class="fas fa-id-card me-2 text-primary"></i>
            Informasi Identitas Pasien
        </h5>

        <div class="row">
            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">ID Pasien</div>
                    <div class="info-value">{{ $pasien->id }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">Nama Pasien</div>
                    <div class="info-value">{{ $pasien->nama ?: '-' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">Jenis Kelamin</div>
                    <div class="info-value">
                        @if (in_array($pasien->jenis_kelamin, ['laki-laki', 'laki_laki']))
                            Laki-laki
                        @elseif ($pasien->jenis_kelamin === 'perempuan')
                            Perempuan
                        @else
                            {{ $pasien->jenis_kelamin ?: '-' }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">Tanggal Lahir</div>
                    <div class="info-value">
                        {{ $pasien->tanggal_lahir
                            ? \Carbon\Carbon::parse($pasien->tanggal_lahir)->format('d-m-Y')
                            : '-' }}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="info-item">
                    <div class="info-label">Alamat</div>
                    <div class="info-value">{{ $pasien->alamat ?: '-' }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">Golongan Darah</div>
                    <div class="info-value">
                        {{ $pasien->golongan_darah ?: '-' }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item">
                    <div class="info-label">Status Asuransi</div>
                    <div class="info-value">
                        @if ($pasien->status_asuransi === '01' || $pasien->status_asuransi == 1)
                            <span class="badge text-bg-success">Memiliki Asuransi</span>
                        @else
                            <span class="badge text-bg-secondary">Tidak Memiliki Asuransi</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('perawat.pasien.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali
            </a>
        </div>
    </div>

</div>
</body>
</html>

