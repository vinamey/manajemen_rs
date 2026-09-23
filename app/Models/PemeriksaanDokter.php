<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PendaftaranPasien;
use App\Models\MasterDokter;
use App\Models\MasterObat;

class PemeriksaanDokter extends Model
{
    protected $table = 'pemeriksaan_dokters';

    protected $fillable = [
        'pendaftaran_id',
        'dokter_id',
        'keluhan',
        'resep_obat',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(
            PendaftaranPasien::class,
            'pendaftaran_id'
        );
    }

    public function dokter()
    {
        return $this->belongsTo(
            MasterDokter::class,
            'dokter_id'
        );
    }

    public function obat()
    {
        return $this->belongsTo(
            MasterObat::class,
            'resep_obat'
        );
    }
}