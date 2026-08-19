<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDokter extends Model
{
    use HasFactory;

    protected $table = 'master_dokters';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'spesialis',
        'no_hp',
        'alamat',
    ];
}