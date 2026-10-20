<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ResepObat;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $fillable = [
        'resep_id',
        'total_pembayaran',
        'metode_pembayaran',
        'status',
    ];

    public function resep()
    {
        return $this->belongsTo(ResepObat::class, 'resep_id');
    }
}
