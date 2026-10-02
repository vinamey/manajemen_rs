<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterObat;
use App\Models\MasterSatuanObat;

class HargaJualObat extends Model
{
    protected $table = 'harga_jual_obats';

    protected $fillable = [
        'obat_id',
        'satuan_id',
        'isi',
        'harga',
    ];

    public function obat()
    {
        return $this->belongsTo(
            MasterObat::class,
            'obat_id'
        );
    }

    public function satuan()
    {
        return $this->belongsTo(
            MasterSatuanObat::class,
            'satuan_id'
        );
    }
}
