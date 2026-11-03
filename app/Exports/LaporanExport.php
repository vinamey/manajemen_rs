<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Enumerable;
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
        if ($this->type == 'pasien') {
            return DB::table('pasiens')->select('id', 'no_rekam_medis', 'nama_pasien', 'jenis_kelamin', 'created_at')->get();
        } elseif ($this->type == 'pendapatan') {
            return DB::table('pendapatan')->get();
        } elseif ($this->type == 'apotek') {
            return DB::table('stok_obats')
                ->join('master_obats', 'stok_obats.obat_id', '=', 'master_obats.id')
                ->select('master_obats.nama as nama_obat', 'stok_obats.stok_tersedia as stok', 'stok_obats.harga_jual as harga')
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
            return ['ID', 'No. Rekam Medis', 'Nama Pasien', 'Jenis Kelamin', 'Tanggal Masuk'];
        } elseif ($this->type == 'pendapatan') {
            return ['ID', 'Keterangan', 'Jumlah', 'Tanggal'];
        } elseif ($this->type == 'apotek') {
            return ['No', 'Nama Obat', 'Stok Obat', 'Harga (Rp)'];
        }

        return [];
    }

    /**
     * Mengatur tampilan Excel.
     */
   
public function styles(Worksheet $sheet): ?array
{
    $lastRow = max(1, $sheet->getHighestRow());

    // Menentukan kolom terakhir berdasarkan jenis laporan
    $lastColumn = match ($this->type) {
        'pasien' => 'E',
        'pendapatan' => 'D',
        'apotek' => 'D',
        default => 'D',
    };

    // Format seluruh header
    $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
            'size' => 11,
        ],
        'fill' => [
            'fillType' => 'solid',
            'startColor' => ['rgb' => '1877F2'],
        ],
        'alignment' => [
            'horizontal' => 'center',
            'vertical' => 'center',
        ],
    ]);

    // Border tabel
    $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
        ->getBorders()
        ->getAllBorders()
        ->setBorderStyle(Border::BORDER_THIN);

    // Tinggi header
    $sheet->getRowDimension(1)->setRowHeight(25);

    return [];
}

    /**
     * Format angka Excel.
     */
    public function columnFormats(): array
    {
        if ($this->type == 'apotek') {
            return [
                'C' => NumberFormat::FORMAT_NUMBER,
                'D' => '"Rp" #,##0',
            ];
        }

        return [];
    }
}

