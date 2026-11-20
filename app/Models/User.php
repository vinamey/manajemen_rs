<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MasterPerawat;
use App\Models\MasterDokter;
use Spatie\Permission\Traits\HasRoles;

#[Fillable([
    'name',
    'email',
    'password',
    'dokter_id',
    'perawat_id',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // Relasi akun ke data dokter
    public function dokter()
    {
        return $this->belongsTo(
            MasterDokter::class,
            'dokter_id',
            'id'
        );
    }

    // Relasi akun ke data perawat
    public function perawat()
    {
        return $this->belongsTo(
            MasterPerawat::class,
            'perawat_id',
            'id'
        );
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
