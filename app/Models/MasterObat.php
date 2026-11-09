<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterKategori;
use App\Models\HargaJualObat;

class MasterObat extends Model
{
    protected $table = 'master_obats';

    protected $fillable = [
        'nama',
        'kategori_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(
            MasterKategori::class,
            'kategori_id'
        );
    }

    public function hargaJual()
    {
        return $this->hasMany(
            HargaJualObat::class,
            'obat_id'
        );
    }
}
