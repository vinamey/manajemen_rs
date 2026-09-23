<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PemeriksaanDokter;

class ResepObat extends Model
{
    protected $table = 'resep_obats';

    protected $fillable = [
        'pemeriksaan_id',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(
            PemeriksaanDokter::class,
            'pemeriksaan_id'
        );
    }
}