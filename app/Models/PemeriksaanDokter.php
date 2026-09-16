<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanDokter extends Model
{
    protected $table = 'pemeriksaan_dokters';

    protected $fillable = [
        'pendaftaran_id',
        'dokter_id',
        'keluhan',
        'resep_obat',
    ];

    /**
     * Relasi ke pendaftaran pasien
     */
    public function pendaftaran()
    {
        return $this->belongsTo(
            PendaftaranPasien::class,
            'pendaftaran_id'
        );
    }

    /**
     * Relasi ke dokter
     */
    public function dokter()
    {
        return $this->belongsTo(
            MasterDokter::class,
            'dokter_id'
        );
    }
}