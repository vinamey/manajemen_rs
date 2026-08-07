<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDokter extends Model
{
    protected $table = 'master_dokters';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'spesialis',
        'poli_id',
    ];

    public function poli()
    {
        return $this->belongsTo(MasterPoli::class, 'poli_id');
    }
}
