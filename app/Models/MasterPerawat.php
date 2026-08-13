<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPerawat extends Model
{
    use HasFactory;

    protected $table = 'master_perawats';

    protected $primaryKey = 'id';

    protected $fillable = [
        'Nama',
        'Jenis_Kelamin',
        'Tanggal_Lahir',
        'Alamat',
    ];
}