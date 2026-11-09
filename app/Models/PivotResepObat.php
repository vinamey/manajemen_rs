<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PivotResepObat extends Model
{
    protected $table = 'pivot_resep_obats';

    protected $fillable = [
        'resep_obat_id',
        'obat_id',
        'satuan_obat_id',
        'nilai',
        'aturan_pakai',
    ];

    public function resep(): BelongsTo
    {
        return $this->belongsTo(ResepObat::class, 'resep_obat_id');
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(MasterObat::class, 'obat_id');
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(MasterSatuanObat::class, 'satuan_obat_id');
    }
}