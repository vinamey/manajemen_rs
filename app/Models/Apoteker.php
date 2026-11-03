<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apoteker extends Model
{
    protected $table = 'apotekers';

    protected $fillable = [
        'nama',
        'no_hp',
    ];
}