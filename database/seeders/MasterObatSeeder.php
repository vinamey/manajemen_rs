<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterObat;

class MasterObatSeeder extends Seeder
{
    public function run()
    {
        // Masukkan data obat secara berurutan agar ID 1 sampai 6 (atau lebih) tersedia
        MasterObat::create(['nama' => 'Paracetamol']);
        MasterObat::create(['nama' => 'Amoxicillin']);
        MasterObat::create(['nama' => 'Antasida']);
        MasterObat::create(['nama' => 'Vitamin C']);
        MasterObat::create(['nama' => 'Ibuprofen']);
        MasterObat::create(['nama' => 'Omeprazole']); // Ini akan menjadi ID 6
    }
}
