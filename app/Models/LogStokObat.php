<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogStokObat extends Model
{
    use HasFactory;

    protected $table = 'log_stok_obats';

    public $timestamps = true;

    // Kolom yang dapat diisi
    protected $fillable = [
        'obat_id',
        'nilai',
        'stok_obat_id',
        'tanggal_update',
        'pivot_resep_obat_id',
        'pembelian_obat_id',
    ];

    // Relasi ke Model StokObat
    public function stokObat()
    {
        return $this->belongsTo(StokObat::class, 'log_stok_obat_id');
    }

    // Relasi ke Model MasterObat (sesuai nama model master obat kamu)
    public function obat()
    {
        return $this->belongsTo(MasterObat::class, 'obat_id');
    }
}