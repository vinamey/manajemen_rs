<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluarans';

    protected $fillable = [
        'nama',
        'kategori',
        'tanggal_pengeluaran',
        'nominal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengeluaran' => 'date',
        'nominal' => 'decimal:2',
    ];
}