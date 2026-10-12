<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PemeriksaanDokter;
use App\Models\MasterTindakan;

class HasilPemeriksaan extends Model
{
    protected $table = 'hasil_pemeriksaans';

    protected $fillable = [
        'pemeriksaan_id',
        'tanggal_pemeriksaan',
        'keluhan',
        'diagnosa',
        'tindakan_id',
        'suhu_tubuh',
        'berat_badan',
        'tinggi_badan',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'suhu_tubuh' => 'decimal:1',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(
            PemeriksaanDokter::class,
            'pemeriksaan_id'
        );
    }

    public function tindakan()
    {
        return $this->belongsTo(
            MasterTindakan::class,
            'tindakan_id'
        );
    }
}
