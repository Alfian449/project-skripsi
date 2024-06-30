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
                'name' => 'PT. Maju Mundur',
                'alamat' => 'Jl. Raya Cipadung No. 1',
                'phone' => '022-1234567',
                'email' => 'example@gmail.com'
            ],
            [
                'name' => 'PT. Pilih Pilih',
                'alamat' => 'Jl. Raya Cipadung No. 1',
                'phone' => '022-1234567',
                'email' => 'example@gmail.com'
            ],
            [
                'name' => 'PT. Akhir Awal',
                'alamat' => 'Jl. Raya Cipadung No. 1',
                'phone' => '022-1234567',
                'email' => 'example@gmail.com'
            ],
        ];

        foreach ($instansi as $i) {
            \App\Models\Instansi::create($i);
        }
    }
}
