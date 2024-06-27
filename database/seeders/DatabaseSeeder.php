<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => 'admin',
            'role' => 'admin',
            'password' => bcrypt('admin')
        ]);

        \App\Models\User::factory()->create([
            'username' => 'guru',
            'role' => 'guru',
            'password' => bcrypt('guru')
        ]);

        \App\Models\User::factory()->create([
            'username' => 'siswa',
            'role' => 'siswa',
            'password' => bcrypt('siswa'),
            'kelas' => 'XI RPL 2'
        ]);
    }
}
