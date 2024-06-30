<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instansi = [
            [
                'name' => 'Kecamatan Kraksaan',
                'alamat' => 'Jl. Raya Patokan',
                'phone' => '022-1234567',
                'email' => 'kecamatankraksaan@gmail.com',
                'guru_id' => 1
            ],
            [
                'name' => 'Dinas Pendidikan Kraksaan',
                'alamat' => 'Jl. Raya Kraksaan',
                'phone' => '022-1234567',
                'email' => 'dispendik@gmail.com',
                'guru_id' => 2
            ],
            [
                'name' => 'Pemda Kab. Probolinggo',
                'alamat' => 'Jl. Raya Ciputat',
                'phone' => '022-1234567',
                'email' => 'pemdakabprobolinggo@gmail.com',
                'guru_id' => 3
            ]
        ];

        foreach ($instansi as $i) {
            \App\Models\Instansi::create($i);
        }
    }
}
