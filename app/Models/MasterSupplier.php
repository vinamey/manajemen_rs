<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSupplier extends Model
{
    protected $table = 'master_suppliers';

    protected $fillable = [
        
        'nama',
    ];
}