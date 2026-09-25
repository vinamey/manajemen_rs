<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MasterKategori;

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
}