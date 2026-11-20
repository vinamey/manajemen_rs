<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterPerawat extends Model
{
    use HasFactory;

    protected $table = 'master_perawats';

    protected $fillable = [
        'users_id',
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi ke akun login
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'users_id',
            'id'
        );
    }
}
