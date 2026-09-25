<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterPoli;

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

    public function poli()
{
    return $this->belongsTo(MasterPoli::class, 'poli_id');
}
}
