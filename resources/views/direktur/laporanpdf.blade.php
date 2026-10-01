<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan {{ ucfirst($type) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            color: #0d6efd;
            text-transform: uppercase;
            font-size: 18px;
        }
        .header p {
            margin: 4px 0 0;
            color: #555;
            font-size: 11px;
        }
        .info-bar {
            margin-bottom: 15px;
            font-size: 10px;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #cbd5e1;
        }
        th {
            background-color: #f1f5f9;
            color: #1e293b;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
        }
        td {
            padding: 7px 6px;
            font-size: 10px;
            vertical-align: middle;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge-danger {
            color: #dc3545;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            float: right;
            text-align: center;
            width: 200px;
        }
        .footer p { margin: 2px 0; }
        .signature-space { height: 60px; }
    </style>
</head>
<body>

    {{-- KOP LAPORAN --}}
    <div class="header">
        <h2>Laporan Data {{ ucfirst($type) == 'Apotek' ? 'Obat & Apotek' : ucfirst($type) }}</h2>
        <p>Sistem Informasi Manajemen Rumah Sakit (SIM RS)</p>
    </div>

    <div class="info-bar">
        <span> {{ date('d-m-Y H:i') }}</span>
    </div>

    {{-- TABEL LAPORAN --}}
    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>

                @if($type == 'apotek')
                    <th width="20%">Kode Obat</th>
                    <th width="40%">Nama Obat</th>
                    <th width="15%" class="text-center">Stok</th>
                    <th width="20%" class="text-right">Harga</th>
                @elseif($type == 'pasien')
                    <th width="20%">No. Rekam Medis</th>
                    <th width="35%">Nama Pasien</th>
                    <th width="20%" class="text-center">Jenis Kelamin</th>
                    <th width="20%" class="text-center">Tanggal Masuk</th>
                @elseif($type == 'pendapatan')
                    <th width="15%">ID Transaksi</th>
                    <th width="45%">Keterangan</th>
                    <th width="20%" class="text-right">Jumlah</th>
                    <th width="15%" class="text-center">Tanggal</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>

                    @if($type == 'apotek')
                        <td>{{ $item->kode_obat ?? $item->kode ?? '-' }}</td>
                        <td>{{ $item->nama_obat ?? $item->nama ?? '-' }}</td>
                        <td class="text-center">
                            @if(($item->stok ?? 0) <= 5)
                                <span class="badge-danger">{{ $item->stok ?? 0 }} (Hampir Habis)</span>
                            @else
                                {{ $item->stok ?? 0 }}
                            @endif
                        </td>
                        <td class="text-right">Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>

                    @elseif($type == 'pasien')
                        <td>{{ $item->no_rekam_medis ?? '-' }}</td>
                        <td>{{ $item->nama_pasien ?? '-' }}</td>
                        <td class="text-center">{{ $item->jenis_kelamin ?? '-' }}</td>
                        <td class="text-center">{{ isset($item->created_at) ? date('d/m/Y', strtotime($item->created_at)) : '-' }}</td>

                    @elseif($type == 'pendapatan')
                        <td>#{{ $item->id }}</td>
                        <td>{{ $item->keterangan ?? 'Pendapatan SIM RS' }}</td>
                        <td class="text-right">Rp {{ number_format($item->jumlah ?? 0, 0, ',', '.') }}</td>
                        <td class="text-center">{{ isset($item->created_at) ? date('d/m/Y', strtotime($item->created_at)) : '-' }}</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center" style="padding: 15px; color: #888;">
                        Tidak ada data {{ $type }} yang tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TANDA TANGAN DIREKTUR --}}
    <div class="footer">
        <p>Mengetahui,</p>
        <p><strong>Direktur Rumah Sakit</strong></p>
        <div class="signature-space"></div>
        <p>_______________________</p>
    </div>

</body>
</html>