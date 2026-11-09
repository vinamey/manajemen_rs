<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use App\Models\PemeriksaanDokter;

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

    public function scopeHariIni($query)
    {
        return $query->whereDate(
            'tanggal_pendaftaran',
            Carbon::today()
        );
    }

    public function scopeCariPasien($query, $keyword)
    {
        return $query->whereHas('pasien', function ($q) use ($keyword) {
            $q->where('nama', 'like', "%{$keyword}%");
        });
    }

    // Relasi ke master pasien
    public function pasien()
    {
        return $this->belongsTo(MasterPasien::class, 'pasien_id');
    }

    public function dokter()
    {
        return $this->belongsTo(MasterDokter::class, 'dokter_id');
    }

    public function poli()
    {
        return $this->belongsTo(MasterPoli::class, 'poli_id');
    }

    public function kamar()
    {
        return $this->belongsTo(MasterKamar::class, 'kamar_id');
    }

    public function pemeriksaan()
    {
        return $this->hasMany(PemeriksaanDokter::class, 'pendaftaran_id');
    }
}
