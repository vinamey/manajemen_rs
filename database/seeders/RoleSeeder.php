<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'Super Admin'
        ]);

        Role::create([
            'name' => 'Admin Rumah Sakit'
        ]);

        Role::create([
            'name' => 'Dokter'
        ]);

        Role::create([
            'name' => 'Perawat'
        ]);

        Role::create([
            'name' => 'Apoteker'
        ]);

        Role::create([
            'name' => 'Kasir'
        ]);

        Role::create([
            'name' => 'Direktur'
        ]);
    }
}