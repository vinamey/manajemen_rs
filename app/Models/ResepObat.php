<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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

    /**
     * Relasi ke pemeriksaan dokter.
     */
    public function pemeriksaan(): BelongsTo
    {
        return $this->belongsTo(
            PemeriksaanDokter::class,
            'pemeriksaan_id'
        );
    }

    /**
     * Relasi ke pembayaran.
     */
    public function pembayaran(): HasOne
    {
        return $this->hasOne(
            Pembayaran::class,
            'resep_id'
        );
    }

    /**
     * Relasi ke detail resep.
     */
    public function detailResep(): HasMany
    {
        return $this->hasMany(
            PivotResepObat::class,
            'resep_obat_id'
        );
    }

    /**
     * Relasi ke master obat melalui tabel pivot.
     */
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