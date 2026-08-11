<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $table = 'kasirs';

    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'no_hp',
    ];
}
