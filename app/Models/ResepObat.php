<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\PivotResepObat;
use App\Models\MasterObat;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ResepObat extends Model
{
    protected $table = 'resep_obats';

   protected $fillable = [
    'pemeriksaan_id',
    'status',
    ];

    public function pemeriksaan(): BelongsTo
    {
        return $this->belongsTo(
            PemeriksaanDokter::class,
            'pemeriksaan_id'
        );
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(
            Pembayaran::class,
            'resep_id'
        );
    }

    public function detailResep(): HasMany
{
    return $this->hasMany(PivotResepObat::class, 'resep_obat_id');
}

public function obat(): BelongsToMany
{
    return $this->belongsToMany(
        MasterObat::class,
        'pivot_resep_obats',
        'resep_obat_id',
        'obat_id'
    )->withPivot([
        'id',
        'satuan_obat_id',
        'nilai',
        'aturan_pakai',
    ]);
  }
}
