
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien Perawat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f3f6fc;
            font-family: Arial, sans-serif;
            color: #111827;
        }

        /* CONTAINER HALAMAN */
        .container-page {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 35px;
        }

        /* JUDUL */
        .page-title {
            color: #1877f2;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 7px;
        }

        .page-description {
            color: #718096;
            font-size: 13px;
            margin-bottom: 25px;
        }

        /* TOMBOL KEMBALI */
        .btn-back {
            color: #1877f2;
            background: white;
            border: 1px solid #1877f2;
            border-radius: 6px;
            padding: 8px 15px;
            font-size: 13px;
            text-decoration: none;
            transition: .2s;
        }

        .btn-back:hover {
            color: white;
            background: #1877f2;
        }

        /* CARD TABEL */
        .table-card {
            width: 100%;
            background: white;
            padding: 22px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .07);
            margin: 0 auto;
        }

        /* TABEL */
        .table-responsive {
            width: 100%;
        }

        .table {
            width: 100%;
            margin-bottom: 10px;
            font-size: 14px;
            table-layout: fixed;
        }

        .table thead th {
            background: #cfe0ff;
            color: #111827;
            border-bottom: 1px solid #b8cff5;
            padding: 15px 14px;
            font-weight: 700;
            font-size: 14px;
        }

        .table tbody td {
            padding: 15px 14px;
            border-bottom: 1px solid #e1e6ee;
            vertical-align: middle;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #f5f8ff;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* DATA KOSONG */
        .empty-row {
            text-align: center;
            color: #718096;
            padding: 35px !important;
            font-size: 14px !important;
        }

        /* PAGINATION */
        .pagination {
            font-size: 13px;
        }

        .pagination .page-link {
            color: #1877f2;
        }

        .pagination .active .page-link {
            background: #1877f2;
            border-color: #1877f2;
            color: white;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .container-page {
                padding: 20px 15px;
            }

            .page-title {
                font-size: 21px;
            }

            .table-card {
                padding: 12px;
            }

            .table {
                min-width: 600px;
            }

            .table thead th,
            .table tbody td {
                padding: 12px 10px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>

<div class="container-page">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-start mb-2">
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

    {{-- TABEL DATA PASIEN --}}
    <div class="table-card">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead>
                    <tr>
                        <th style="width: 12%;">No.</th>
                        <th style="width: 35%;">Nama Pasien</th>
                        <th style="width: 53%;">Informasi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($pasien as $item)

                        <tr>
                            <td>
                                {{ $pasien->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $item->nama }}
                            </td>

                            <td>
                                Data pasien terdaftar
                            </td>
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

        {{-- PAGINATION --}}
        @if ($pasien->hasPages())
            <div class="mt-3">
                {{ $pasien->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>

</body>
</html>

