<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Obat Apoteker | SIM RS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary px-4">
        <a href="{{ route('apoteker.dashboard') }}"
           class="navbar-brand">
            SIM RS - Apoteker
        </a>

        <a href="{{ route('apoteker.dashboard') }}"
           class="btn btn-light btn-sm">
            Kembali ke Dashboard
        </a>
    </nav>

    <div class="container py-4">
        <h3>Data Obat</h3>
        <p class="text-muted">
            Kelola data obat khusus halaman Apoteker.
        </p>

        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tabel dan tombol data obat diletakkan di sini -->
            </div>
        </div>
    </div>

</body>
</html>