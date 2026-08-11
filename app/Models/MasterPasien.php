<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPasien extends Model
{
    use HasFactory;

    protected $table = 'master_pasiens';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'status_asuransi',
        'golongan_darah',
    ];
}