<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // ======================
        // Permission
        // ======================

        $permissions = [

            'dashboard',

            'role management',
            'permission management',
            'user management',

            'master obat',
            'master dokter',
            'master perawat',
            'master pasien',
            'master supplier',
            'master kategori',
            'master satuan obat',
            'master tindakan',
            'master poli',
            'master kamar',
            'master asuransi',

            'pendaftaran pasien',
            'pemeriksaan dokter',
            'resep obat',

            'pembelian obat',
            'stok obat',
            'harga jual obat',

            'pembayaran',

            'laporan',
        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);
        }

        // ======================
        // Role
        // ======================

        $superAdmin = Role::firstOrCreate([
            'name'=>'super admin',
            'guard_name'=>'web'
        ]);

        $admin = Role::firstOrCreate([
            'name'=>'admin rumah sakit',
            'guard_name'=>'web'
        ]);

        $dokter = Role::firstOrCreate([
            'name'=>'dokter',
            'guard_name'=>'web'
        ]);

        $perawat = Role::firstOrCreate([
            'name'=>'perawat',
            'guard_name'=>'web'
        ]);

        $apoteker = Role::firstOrCreate([
            'name'=>'apoteker',
            'guard_name'=>'web'
        ]);

        $kasir = Role::firstOrCreate([
            'name'=>'kasir',
            'guard_name'=>'web'
        ]);

        $direktur = Role::firstOrCreate([
            'name'=>'direktur',
            'guard_name'=>'web'
        ]);

        // ======================
        // Berikan Permission
        // ======================

        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'dashboard',

            'master obat',
            'master dokter',
            'master pasien',
            'master perawat',
            'master supplier',
            'master kategori',
            'master satuan obat',
            'master tindakan',
            'master poli',
            'master kamar',
            'master asuransi',

            'pendaftaran pasien',

            'laporan',
        ]);

      $dokter->givePermissionTo([
    'dashboard',
    'master dokter',
    'master pasien',
    'pemeriksaan dokter',
    'resep obat',
]);

     $perawat->givePermissionTo([
    'dashboard',
    'master perawat',
    'master pasien',
    'pendaftaran pasien',
]);
        $apoteker->givePermissionTo([
            'dashboard',
            'master obat',
            'pembelian obat',
            'stok obat',
            'harga jual obat',
        ]);

        $kasir->givePermissionTo([
            'dashboard',
            'pembayaran',
        ]);

        $direktur->givePermissionTo([
            'dashboard',
            'laporan',
        ]);
    }
}
