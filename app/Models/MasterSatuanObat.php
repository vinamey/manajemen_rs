<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterSatuanObat extends Model
{
    use HasFactory;

    protected $table = 'master_satuan_obats';

    protected $fillable = [
        'nama',
    ];

    public function stokObat(): HasMany
    {
        return $this->hasMany(
            StokObat::class,
            'satuan_obat_id'
        );
    }

    public function detailResep(): HasMany
    {
        return $this->hasMany(
            PivotResepObat::class,
            'satuan_obat_id'
        );
    }
}
