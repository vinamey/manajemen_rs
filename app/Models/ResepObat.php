<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PemeriksaanDokter;
use App\Models\MasterObat;

class ResepObat extends Model
{
    protected $table = 'resep_obats';

    protected $fillable = [
        'pemeriksaan_id',
    ];

    /**
     * Relasi ke pemeriksaan dokter
     */
    public function pemeriksaan()
    {
        return $this->belongsTo(
            PemeriksaanDokter::class,
            'pemeriksaan_id'
        );
    }

    /**
     * Relasi ke obat-obat dalam resep
     */
    public function obat()
    {
        return $this->belongsToMany(
            MasterObat::class,
            'pivot_resep_obats',
            'resep_obat_id',
            'obat_id'
        )->withPivot([
            'satuan_obat_id',
            'nilai',
            'aturan_pakai',
        ]);
    }
}
