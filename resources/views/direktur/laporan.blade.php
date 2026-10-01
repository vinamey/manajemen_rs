<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Direktur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { margin: 0; background: #f5f7fb; font-family: Arial, sans-serif; }
        .sidebar { width: 250px; height: 100vh; position: fixed; left: 0; top: 0; background: #0d6efd; color: white; }
        .brand { padding: 25px 20px; text-align: center; font-size: 22px; font-weight: bold; border-bottom: 1px solid rgba(255,255,255,.2); }
        .sidebar a { display: block; color: white; text-decoration: none; padding: 14px 22px; }
        .sidebar a:hover, .sidebar a.active { background: #0b5ed7; }
        .content { margin-left: 250px; padding: 30px; }
        .report-card { background: white; border-radius: 15px; padding: 25px; box-shadow: 0 3px 10px rgba(0,0,0,.08); }
        .logout-btn { background: #dc3545; border: none; color: white; padding: 10px; border-radius: 6px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">
            <i class="fas fa-hospital"></i> SIM RS
        </div>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="{{ route('direktur.laporan') }}" class="active"><i class="fas fa-chart-column me-2"></i> Laporan</a>
        <form action="{{ route('logout') }}" method="POST" class="p-3">
            @csrf
        </form>
    </div>

    <div class="content">
        <h2 class="fw-bold mb-2">Laporan</h2>
        <p class="text-muted mb-4">Laporan berupa tabel yang dapat diekspor ke Excel dan PDF.</p>

        <div class="report-card">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th width="70">No</th>
                            <th>Jenis Laporan</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pendapatan</td>
                            <td>
                                <a href="{{ route('laporan.export.excel', 'pendapatan') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('laporan.export.pdf', 'pendapatan') }}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pasien</td>
                            <td>
                                <a href="{{ route('laporan.export.excel', 'pasien') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('laporan.export.pdf', 'pasien') }}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Apotek</td>
                            <td>
                                <a href="{{ route('laporan.export.excel', 'apotek') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                                <a href="{{ route('laporan.export.pdf', 'apotek') }}" target="_blank" class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>