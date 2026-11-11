<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterFrekuensi extends Model
{
    protected $table = 'master_frekuensis';

    protected $fillable = [
        'kode',
        'nama',
    ];
}