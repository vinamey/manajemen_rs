<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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

   
    protected static function booted()
    {
        static::creating(function ($pendaftaran) {
            if (empty($pendaftaran->tanggal_pendaftaran)) {
                $pendaftaran->tanggal_pendaftaran = Carbon::today()->toDateString();
            }

            $totalHariIni = static::whereDate('tanggal_pendaftaran', $pendaftaran->tanggal_pendaftaran)->count();
            
            $pendaftaran->nomor_antrian = $totalHariIni + 1;
        });
    }


    public function scopeHariIni($query)
    {
        return $query->whereDate('tanggal_pendaftaran', Carbon::today());
    }

    public function scopeCariPasien($query, $keyword)
    {
        return $query->whereHas('pasien', function ($q) use ($keyword) {
            $q->where('nama_pasien', 'like', "%{$keyword}%")
              ->orWhere('nik', 'like', "%{$keyword}%")
              ->orWhere('no_rm', 'like', "%{$keyword}%");
        });
    }


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
}