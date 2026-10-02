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
        $accounts = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => '12345',
                'role' => 'Super Admin',
            ],
            [
                'name' => 'Admin Rumah Sakit',
                'email' => 'admin@gmail.com',
                'password' => '12345',
                'role' => 'Admin Rumah Sakit',
            ],
            [
                'name' => 'Dokter',
                'email' => 'dokter@gmail.com',
                'password' => '12345',
                'role' => 'dokter',
            ],
            [
                'name' => 'Perawat',
                'email' => 'perawat@gmail.com',
                'password' => '12345',
                'role' => 'Perawat',
            ],
            [
                'name' => 'Apoteker',
                'email' => 'apoteker@gmail.com',
                'password' => '12345',
                'role' => 'Apoteker',
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => '12345',
                'role' => 'Kasir',
            ],
            [
                'name' => 'Direktur',
                'email' => 'direktur@gmail.com',
                'password' => '12345',
                'role' => 'Direktur',
            ],
        ];

        foreach ($accounts as $account) {

            $role = Role::where('name', $account['role'])->first();

            if (!$role) {
                $this->command->warn(
                    "Role '{$account['role']}' tidak ditemukan. Akun {$account['email']} dilewati."
                );

                continue;
            }

            $user = User::updateOrCreate(
                [
                    'email' => $account['email'],
                ],
                [
                    'name' => $account['name'],
                    'password' => Hash::make($account['password']),
                ]
            );

            $user->syncRoles([$role]);
        }

        $this->command->info('User berhasil dibuat/diperbarui tanpa duplikat.');
    }
}
