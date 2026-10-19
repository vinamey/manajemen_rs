<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body style="background:#f4f7fc;">

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-primary">Data Pasien</h3>
            <p class="text-muted mb-0">
                Daftar pasien yang terdaftar di rumah sakit.
            </p>
        </div>

        <a href="{{ route('dokter.dashboard') }}"
           class="btn btn-outline-primary">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No.</th>
                            <th>Nama Pasien</th>
                            <th>Informasi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pasien as $item)
                            <tr>
                                <td>
                                    {{ $pasien->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    {{ $item->nama ?? '-' }}
                                </td>
                                <td>
                                    Data pasien terdaftar
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    Belum ada data pasien.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $pasien->links() }}
        </div>
    </div>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      rel="stylesheet">
</body>
</html>
