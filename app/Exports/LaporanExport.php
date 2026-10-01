<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Enumerable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Ambil data dari database berdasarkan $type
     */
    public function collection(): Enumerable
    {
        if ($this->type == 'pasien') {
            return DB::table('pasiens')
                ->select('id', 'no_rekam_medis', 'nama_pasien', 'jenis_kelamin', 'created_at')
                ->get();

        } elseif ($this->type == 'pendapatan') {
            return DB::table('pendapatan')->get();

        } elseif ($this->type == 'apotek') {
            // Cek tabel master_obats / obats di DB Anda
            // Gunakan map() agar format data yang masuk ke Excel rapi & pasti terbaca
            $obats = DB::table('master_obats')->get(); // Sesuaikan nama tabel jika menggunakan 'obats'

            return $obats->map(function ($item, $key) {
                return [
                    'no'         => $key + 1,
                    'kode_obat'  => $item->kode_obat ?? $item->kode ?? '-',
                    'nama_obat'  => $item->nama_obat ?? $item->nama ?? '-',
                    'stok'       => $item->stok ?? 0,
                    'harga'      => $item->harga ?? 0,
                ];
            });
        }

        return collect([]);
    }

    /**
     * Set Nama Judul Kolom (Header Excel)
     */
    public function headings(): array
    {
        if ($this->type == 'pasien') {
            return ['ID', 'No. Rekam Medis', 'Nama Pasien', 'Jenis Kelamin', 'Tanggal Dibuat'];
        } elseif ($this->type == 'pendapatan') {
            return ['ID', 'Keterangan', 'Jumlah', 'Tanggal'];
        } elseif ($this->type == 'apotek') {
            return ['No', 'Kode Obat', 'Nama Obat', 'Stok Obat', 'Harga (Rp)'];
        }

        return [];
    }
}