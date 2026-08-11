<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterPerawat extends Model
{
    protected $table = 'master_perawats';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
    ];
}
