<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Enumerable;
use Carbon\Carbon;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Border;

class LaporanExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithColumnFormatting
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function collection(): Enumerable
    {
        // LAPORAN PASIEN
        if ($this->type == 'pasien') {
            return DB::table('pasiens')
                ->select(
                    'id',
                    'no_rekam_medis',
                    'nama_pasien',
                    'jenis_kelamin',
                    'tanggal_masuk'
                )
                ->orderBy('id', 'asc')
                ->get()
                ->map(function ($item) {

                    $jenisKelamin = strtoupper(trim($item->jenis_kelamin ?? ''));

                    if ($jenisKelamin === 'L') {
                        $jenisKelamin = 'Laki-laki';
                    } elseif ($jenisKelamin === 'P') {
                        $jenisKelamin = 'Perempuan';
                    } elseif ($jenisKelamin === '') {
                        $jenisKelamin = '-';
                    }

                    return [
                        'id' => $item->id,
                        'no_rekam_medis' => $item->no_rekam_medis,
                        'nama_pasien' => $item->nama_pasien,
                        'jenis_kelamin' => $jenisKelamin,
                        'tanggal_masuk' => $item->tanggal_masuk
                            ? Carbon::parse($item->tanggal_masuk)->format('d-m-Y')
                            : '-',
                    ];
                });
        }

        // LAPORAN PENDAPATAN
        elseif ($this->type == 'pendapatan') {
            $table = 'pembayarans';
            $columns = Schema::getColumnListing($table);

            $statusColumn = null;

            foreach (['status', 'status_pembayaran'] as $column) {
                if (in_array($column, $columns)) {
                    $statusColumn = $column;
                    break;
                }
            }

            if (!$statusColumn) {
                throw new \RuntimeException(
                    'Kolom status tidak ditemukan pada tabel pembayarans.'
                );
            }

            $amountColumn = null;

            foreach ([
                'total_pembayaran',
                'total_bayar',
                'jumlah_bayar',
                'nominal',
                'jumlah',
                'total'
            ] as $column) {
                if (in_array($column, $columns)) {
                    $amountColumn = $column;
                    break;
                }
            }

            if (!$amountColumn) {
                throw new \RuntimeException(
                    'Kolom jumlah pembayaran tidak ditemukan pada tabel pembayarans.'
                );
            }

            $dateColumn = null;

            foreach ([
                'tanggal_pembayaran',
                'tanggal_bayar',
                'tanggal',
                'created_at'
            ] as $column) {
                if (in_array($column, $columns)) {
                    $dateColumn = $column;
                    break;
                }
            }

            $descriptionColumn = null;

            foreach ([
                'keterangan',
                'deskripsi',
                'nama_pembayaran'
            ] as $column) {
                if (in_array($column, $columns)) {
                    $descriptionColumn = $column;
                    break;
                }
            }

            $payments = DB::table($table)
                ->whereRaw(
                    "UPPER(TRIM(`{$statusColumn}`)) = ?",
                    ['LUNAS']
                )
               ->orderBy('id', 'asc')
                ->get();

            return $payments->map(function ($item) use (
                $amountColumn,
                $dateColumn,
                $descriptionColumn,
                $columns
            ) {
                $keterangan = '-';

                if ($descriptionColumn) {
                    $keterangan = $item->{$descriptionColumn} ?? '-';
                } else {
                    $keterangan = 'Pembayaran #' . $item->id;
                }

                if (in_array('metode_pembayaran', $columns)) {
                    $metode = $item->metode_pembayaran ?? '';

                    if ($metode != '') {
                        $keterangan .= ' - ' . $metode;
                    }
                }

                $tanggal = '-';

                if ($dateColumn && !empty($item->{$dateColumn})) {
                    $tanggal = Carbon::parse(
                        $item->{$dateColumn}
                    )->format('d-m-Y');
                }

                return [
                    'id' => $item->id,
                    'keterangan' => $keterangan,
                    'jumlah' => $item->{$amountColumn},
                    'tanggal' => $tanggal,
                ];
            });
        }

        // LAPORAN DATA OBAT
        elseif ($this->type == 'data-obat') {
            return DB::table('stok_obats')
                ->join(
                    'master_obats',
                    'stok_obats.obat_id',
                    '=',
                    'master_obats.id'
                )
                ->select(
                    'master_obats.nama as nama_obat',
                    'stok_obats.stok_tersedia as stok',
                    'stok_obats.harga_jual as harga'
                )
                ->orderBy('master_obats.nama')
                ->get()
                ->map(function ($item, $key) {
                    return [
                        'no' => $key + 1,
                        'nama_obat' => $item->nama_obat,
                        'stok' => $item->stok,
                        'harga' => $item->harga,
                    ];
                });
        }

        return collect([]);
    }

    public function headings(): array
    {
        if ($this->type == 'pasien') {
            return [
                'ID',
                'No. Rekam Medis',
                'Nama Pasien',
                'Jenis Kelamin',
                'Tanggal Masuk'
            ];
        }

        elseif ($this->type == 'pendapatan') {
            return [
                'ID',
                'Keterangan',
                'Jumlah',
                'Tanggal'
            ];
        }

        elseif ($this->type == 'data-obat') {
            return [
                'No',
                'Nama Obat',
                'Stok Tersedia',
                'Harga Jual (Rp)'
            ];
        }

        return [];
    }

    public function styles(Worksheet $sheet): ?array
    {
        $lastRow = max(1, $sheet->getHighestRow());

        $lastColumn = match ($this->type) {
            'pasien' => 'E',
            'pendapatan' => 'D',
            'data-obat' => 'D',
            default => 'D',
        };

        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => '1877F2',
                ],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        $sheet
            ->getStyle("A1:{$lastColumn}{$lastRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        $sheet->getRowDimension(1)->setRowHeight(25);

        return [];
    }

    public function columnFormats(): array
    {
        if ($this->type == 'data-obat') {
            return [
                'C' => NumberFormat::FORMAT_NUMBER,
                'D' => '"Rp" #,##0',
            ];
        }

        if ($this->type == 'pendapatan') {
            return [
                'C' => '"Rp" #,##0',
            ];
        }

        return [];
    }
}
