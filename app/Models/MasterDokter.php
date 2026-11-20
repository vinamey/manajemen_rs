<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MasterPoli;

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

    // Dokter terhubung ke satu akun user
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    // Dokter memiliki satu poli
    public function poli()
    {
        return $this->belongsTo(MasterPoli::class, 'poli_id');
    }
}
