<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed data for Ruang model
        \App\Models\Ruang::create([
            "nama_ruang" => "Ruang A",
            "kapasitas" => 30,
            "gedung" => "Gedung 1",
            "lantai" => 1,
            "status_ketersediaan" => "1",
        ]);
    }
}
