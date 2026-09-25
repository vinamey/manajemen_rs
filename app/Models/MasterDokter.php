<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterDokter extends Model
{
    use HasFactory;

    protected $table = 'master_dokters';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'spesialis',
        'alamat',
        'poli_id',
    ];

    /**
     * Relasi dokter ke poli
     */
    public function poli(): BelongsTo
    {
        return $this->belongsTo(
            MasterPoli::class,
            'poli_id',
            'id'
        );
    }
}
