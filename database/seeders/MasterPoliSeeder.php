<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterPoli;

class MasterPoliSeeder extends Seeder
{
    public function run(): void
    {
        MasterPoli::create([
            'kode' => 'POL001',
            'nama' => 'Poli Umum'
        ]);

        MasterPoli::create([
            'kode' => 'POL002',
            'nama' => 'Poli Anak'
        ]);

        MasterPoli::create([
            'kode' => 'POL003',
            'nama' => 'Poli Gigi'
        ]);
    }
}
