<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HargaJualObatSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('harga_jual_obats')->updateOrInsert(
            [
                'obat_id' => 12,
                'satuan_id' => 8,
            ],
            [
                'isi' => 1,
                'harga' => 15000,
            ]
        );
    }
}
