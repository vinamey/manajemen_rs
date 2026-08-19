<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = Role::where('name', 'Super Admin')->first();
        $admin = Role::where('name', 'Admin Rumah Sakit')->first();
        $dokter = Role::where('name', 'Dokter')->first();
        $perawat = Role::where('name', 'Perawat')->first();
        $apoteker = Role::where('name', 'Apoteker')->first();
        $kasir = Role::where('name', 'Kasir')->first();
        $direktur = Role::where('name', 'Direktur')->first();

        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($superAdmin);

        $user = User::create([
            'name' => 'Admin Rumah Sakit', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($admin);

        $user = User::create([
            'name' => 'Dokter',
            'email' => 'dokter@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($dokter);

        $user = User::create([
            'name' => 'Perawat',
            'email' => 'perawat@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($perawat);

        $user = User::create([
            'name' => 'Apoteker',
            'email' => 'apoteker@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($apoteker);

        $user = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($kasir);

        $user = User::create([
            'name' => 'Direktur',
            'email' => 'direktur@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $user->assignRole($direktur);
    }
}