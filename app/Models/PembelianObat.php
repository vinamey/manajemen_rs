<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PembelianObat extends Model
{
    protected $table = 'pembelian_obats';

    protected $fillable = [
        'supplier_id',
        'obat_id',
        'satuan_id',
        'nilai',
        'tanggal',
        'apoteker_id',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nilai' => 'integer',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(MasterSupplier::class, 'supplier_id');
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(MasterObat::class, 'obat_id');
    }

    public function satuan(): BelongsTo
    {
        return $this->belongsTo(
    MasterSatuanObat::class,
    'satuan_id'
);
    }

    public function apoteker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'apoteker_id');
    }
}
