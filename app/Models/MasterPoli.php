<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPoli extends Model
{
    use HasFactory;

   protected $table = 'master_polis';

   protected $fillable = [
    'kode',
    'nama',
];
}
