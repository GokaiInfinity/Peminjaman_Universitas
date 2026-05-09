<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeralatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed data for Peralatan model
        \App\Models\Peralatan::create([
            'kode_peralatan' => 'ALT001',
            'nama_peralatan' => 'Proyektor',
            'stok' => 5,
            'kategori' => 'Elektronik',
        ]);

        \App\Models\Peralatan::create([
            'kode_peralatan' => 'ALT002',
            'nama_peralatan' => 'Laptop',
            'stok' => 10,
            'kategori' => 'Elektronik',
        ]);

        \App\Models\Peralatan::create([
            'kode_peralatan' => 'ALT003',
            'nama_peralatan' => 'Meja Lipat',
            'stok' => 20,
            'kategori' => 'Furniture',
        ]);
    }
}
