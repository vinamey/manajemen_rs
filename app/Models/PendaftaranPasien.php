<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendaftaranPasien extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pendaftaran_pasiens';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'poli_id',
        'kamar_id',
        'tanggal_pendaftaran',
        'nomor_antrian',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI PASIEN
    |--------------------------------------------------------------------------
    */

    public function pasien()
    {
        return $this->belongsTo(MasterPasien::class, 'pasien_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI DOKTER
    |--------------------------------------------------------------------------
    */

    public function dokter()
    {
        return $this->belongsTo(MasterDokter::class, 'dokter_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI POLI
    |--------------------------------------------------------------------------
    */

    public function poli()
    {
        return $this->belongsTo(MasterPoli::class, 'poli_id');
    }

    /*
    |--------------------------------------------------------------------------
    | RELASI KAMAR
    |--------------------------------------------------------------------------
    */

    public function kamar()
    {
        return $this->belongsTo(MasterKamar::class, 'kamar_id');
    }
}