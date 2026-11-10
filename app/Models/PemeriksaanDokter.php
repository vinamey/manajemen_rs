<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PemeriksaanDokter extends Model
{
    protected $table = 'pemeriksaan_dokters';

    protected $fillable = [
        'pendaftaran_id',
        'dokter_id',
        'keluhan',
        'resep_obat',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(
            PendaftaranPasien::class,
            'pendaftaran_id'
        );
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(
            MasterDokter::class,
            'dokter_id'
        );
    }

    public function resep(): HasOne
    {
        return $this->hasOne(
            ResepObat::class,
            'pemeriksaan_id'
        );
    }
}
