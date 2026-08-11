<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPoli extends Model
{
    use HasFactory;

    // Pastikan TANPA huruf 's' agar cocok dengan tabel phpMyAdmin
    protected $table = 'master_poli';

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function dokters()
    {
        return $this->hasMany(MasterDokter::class, 'poli_id');
    }
}
