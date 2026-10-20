<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDokter extends Model
{
    protected $table = 'master_dokters';

    protected $fillable = [
        'nama',
        'users_id',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'spesialis',
        'poli_id',
    ];

    /**
     * Dokter memiliki satu poli.
     */
    public function poli()
    {
        return $this->belongsTo(MasterPoli::class, 'poli_id');
    }
}