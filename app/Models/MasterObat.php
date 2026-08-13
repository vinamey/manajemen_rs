<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterObat extends Model
{
    protected $fillable = [
    'kode_obat',
    'nama_obat',
    'kategori',
    'satuan',
    'harga',
    'stok',
];
}