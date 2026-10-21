<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f3f6fc;
            font-family: Arial, sans-serif;
            color: #111827;
        }

        .container-page {
            padding: 18px 27px;
            max-width: 1150px;
        }

        .page-title {
            color: #1877f2;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-description {
            color: #718096;
            font-size: 11px;
            margin-bottom: 18px;
        }

        .btn-back {
            color: #1877f2;
            background: white;
            border: 1px solid #1877f2;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 11px;
            text-decoration: none;
        }

        .btn-back:hover {
            color: white;
            background: #1877f2;
        }

        .table-card {
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, .06);
        }

        .table {
            margin-bottom: 10px;
            font-size: 11px;
        }

        .table thead th {
            background: #cfe0ff;
            color: #111827;
            border-bottom: 1px solid #b8cff5;
            padding: 8px 6px;
            font-weight: 700;
        }

        .table tbody td {
            padding: 7px 6px;
            border-bottom: 1px solid #e1e6ee;
            vertical-align: middle;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .pagination {
            font-size: 11px;
        }

        .pagination .page-link {
            color: #1877f2;
        }

        .pagination .active .page-link {
            background: #1877f2;
            border-color: #1877f2;
            color: white;
        }

        .empty-row {
            text-align: center;
            color: #718096;
            padding: 20px !important;
        }
    </style>
</head>

<body>
<div class="container-page">

    <div class="d-flex justify-content-between align-items-start">
        <div>
            <h1 class="page-title">Data Pasien</h1>
            <p class="page-description">
                Daftar pasien yang terdaftar di rumah sakit.
            </p>
        </div>

        <a href="{{ route('perawat.dashboard') }}" class="btn-back">
            &larr; Kembali
        </a>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 13%;">No.</th>
                        <th style="width: 36%;">Nama Pasien</th>
                        <th>Informasi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pasien as $item)
                        <tr>
                            <td>{{ $pasien->firstItem() + $loop->index }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>Data pasien terdaftar</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="empty-row">
                                Belum ada data pasien.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pasien->hasPages())
            <div class="mt-3">
                {{ $pasien->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

</div>
</body>
</html>

