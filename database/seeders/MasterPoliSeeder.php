<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterPoli;

class MasterPoliSeeder extends Seeder
{
    public function run(): void
    {
        $polis = [

            [
                'kode' => 'POL001',
                'nama' => 'Poli Umum'
            ],

            [
                'kode' => 'POL002',
                'nama' => 'Poli Anak'
            ],

            [
                'kode' => 'POL003',
                'nama' => 'Poli Gigi'
            ],

            [
                'kode' => 'POL004',
                'nama' => 'Poli Kandungan'
            ],

            [
                'kode' => 'POL005',
                'nama' => 'Poli Penyakit Dalam'
            ],

            [
                'kode' => 'POL006',
                'nama' => 'Poli Bedah'
            ],

            [
                'kode' => 'POL007',
                'nama' => 'Poli Mata'
            ],

            [
                'kode' => 'POL008',
                'nama' => 'Poli THT'
            ],

            [
                'kode' => 'POL009',
                'nama' => 'Poli Saraf'
            ],

            [
                'kode' => 'POL010',
                'nama' => 'Poli Jantung'
            ],

            [
                'kode' => 'POL011',
                'nama' => 'Poli Kulit'
            ],

            [
                'kode' => 'POL012',
                'nama' => 'Poli Paru'
            ],

            [
                'kode' => 'POL013',
                'nama' => 'Poli Orthopedi'
            ],

            [
                'kode' => 'POL014',
                'nama' => 'Poli Jiwa'
            ],

            [
                'kode' => 'POL015',
                'nama' => 'Poli Urologi'
            ],

            [
                'kode' => 'POL016',
                'nama' => 'Poli Rehabilitasi Medik'
            ],

        ];

        foreach ($polis as $poli) {

            MasterPoli::updateOrCreate(
                [
                    'kode' => $poli['kode']
                ],
                [
                    'nama' => $poli['nama']
                ]
            );

        }
    }
}