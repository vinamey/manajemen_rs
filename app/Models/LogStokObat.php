<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogStokObat extends Model
{
    use HasFactory;

    protected $table = 'log_stok_obats';

    protected $fillable = [
        'obat_id',
        'nilai',
        'stok_obat_id',
        'tanggal_update',
        'pivot_resep_obat_id',
        'pembelian_obat_id',
    ];

    public function stokObat()
    {
        return $this->belongsTo(StokObat::class, 'stok_obat_id');
    }

    public function obat()
    {
        return $this->belongsTo(MasterObat::class, 'obat_id');
    }
}
