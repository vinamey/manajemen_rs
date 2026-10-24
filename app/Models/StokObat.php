<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
    use HasFactory;

    protected $table = 'stok_obats';

    protected $fillable = [
        'obat_id',
        'satuan_obat_id',
        'harga_jual',
        'stok_tersedia',
    ];

    
    public function obat()
    {
        return $this->belongsTo(
            MasterObat::class,
            'obat_id',
            'id'
        );
    }

   
    public function satuanObat()
    {
        return $this->belongsTo(
            MasterSatuanObat::class,
            'satuan_obat_id',
            'id'
        );
    }
}