<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokObat extends Model
{
    protected $table = 'stok_obats';

    protected $fillable = [
        'obat_id',
        'satuan_obat_id',
    ];

    public function obat(): BelongsTo
    {
        return $this->belongsTo(MasterObat::class, 'obat_id');
    }

    public function satuanObat(): BelongsTo
    {
        return $this->belongsTo(
            MasterSatuanObat::class,
            'satuan_obat_id'
        );
    }
}
