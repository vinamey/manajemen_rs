<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterObat extends Model
{
    protected $table = 'master_obats';

    protected $fillable = [
        'nama',
        'kategori_id',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            MasterKategori::class,
            'kategori_id'
        );
    }

    public function hargaJual(): HasMany
    {
        return $this->hasMany(
            HargaJualObat::class,
            'obat_id'
        );
    }

    public function stokObat(): HasMany
    {
        return $this->hasMany(
            StokObat::class,
            'obat_id'
        );
    }

    public function detailResep(): HasMany
    {
        return $this->hasMany(
            PivotResepObat::class,
            'obat_id'
        );
    }
}
