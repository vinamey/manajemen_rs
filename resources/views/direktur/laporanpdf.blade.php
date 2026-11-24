
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>
        Laporan {{ $type == 'data-obat' ? 'Data Obat' : ucfirst($type) }}
    </title>

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

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .badge-danger {
            color: #dc3545;
            font-weight: bold;
        }

        .badge-success {
            color: #198754;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            float: right;
            text-align: center;
            width: 200px;
        }

        .footer p {
            margin: 2px 0;
        }

        .signature-space {
            height: 60px;
        }

        .empty-data {
            padding: 15px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- KOP LAPORAN --}}
    <div class="header">
        <h2>
            LAPORAN DATA
            {{ $type == 'data-obat' ? 'OBAT' : strtoupper($type) }}
        </h2>

        <p>
            Sistem Informasi Manajemen Rumah Sakit (SIM RS)
        </p>
    </div>

    <div class="info-bar">
        Dicetak pada: {{ date('d-m-Y H:i') }}
    </div>

    {{-- TABEL LAPORAN --}}
    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>

                @if($type == 'data-obat')

                    <th width="35%">Nama Obat</th>
                    <th width="20%" class="text-center">Stok</th>
                    <th width="20%" class="text-right">Harga</th>

                @elseif($type == 'pasien')

                    <th width="25%">No. Rekam Medis</th>
                    <th width="30%">Nama Pasien</th>
                    <th width="20%" class="text-center">Jenis Kelamin</th>
                    <th width="20%" class="text-center">Tanggal Pendaftaran</th>

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
                    <td class="text-center">
                        {{ $index + 1 }}
                    </td>

                    {{-- DATA OBAT --}}
                    @if($type == 'data-obat')

                        @php
                            $obat = $item->obat;
                            $stok = (int) ($item->stok_tersedia ?? 0);
                            $harga = (float) ($item->harga_jual ?? 0);
                        @endphp

                        <td>
                            {{ $obat->nama ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if($stok <= 5)
                                <span class="badge-danger">
                                    {{ number_format($stok, 0, ',', '.') }}
                                    (Hampir Habis)
                                </span>
                            @else
                                <span class="badge-success">
                                    {{ number_format($stok, 0, ',', '.') }}
                                </span>
                            @endif
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($harga, 0, ',', '.') }}
                        </td>

                    {{-- DATA PASIEN --}}
                    @elseif($type == 'pasien')

                        <td>
                            {{ $item->no_rekam_medis ?? '-' }}
                        </td>

                        <td>
                            {{ $item->nama_pasien ?? '-' }}
                        </td>

                        <td class="text-center">
                            @php
                                $jenisKelamin = strtolower(trim($item->jenis_kelamin ?? ''));

                                if ($jenisKelamin === 'l') {
                                    $jenisKelamin = 'Laki-laki';
                                } elseif ($jenisKelamin === 'p') {
                                    $jenisKelamin = 'Perempuan';
                                } elseif ($jenisKelamin === 'laki-laki') {
                                    $jenisKelamin = 'Laki-laki';
                                } elseif ($jenisKelamin === 'perempuan') {
                                    $jenisKelamin = 'Perempuan';
                                } else {
                                    $jenisKelamin = '-';
                                }
                            @endphp

                            {{ $jenisKelamin }}
                        </td>

                        <td class="text-center">
                            {{ !empty($item->tanggal_pendaftaran)
                                ? date('d-m-Y', strtotime($item->tanggal_pendaftaran))
                                : '-' }}
                        </td>

                    {{-- DATA PENDAPATAN --}}
                    @elseif($type == 'pendapatan')

                        <td>
                            #{{ $item->id }}
                        </td>

                        <td>
                            {{ $item->keterangan ?? 'Pendapatan SIM RS' }}
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($item->jumlah ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="text-center">
                            {{ $item->tanggal ?? '-' }}
                        </td>

                    @endif

                </tr>

            @empty

                <tr>
                    <td colspan="{{ $type == 'data-obat' ? 4 : 5 }}"
                        class="empty-data">

                        Tidak ada data
                        {{ $type == 'data-obat' ? 'obat' : $type }}
                        yang tersedia.

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

        <p>________________________________</p>
    </div>

</body>
</html>
