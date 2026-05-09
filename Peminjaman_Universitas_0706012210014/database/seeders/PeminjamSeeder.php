<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeminjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed data for Peminjam model
        \App\Models\Peminjam::create([
            'nama' => 'Ahmad Fauzi',
            'nim_nik' => '0706012210014',
            'no_hp' => '081234567890',
            'jenis_akun' => 'mahasiswa',
        ]);

        \App\Models\Peminjam::create([
            'nama' => 'Filtest',
            'nim_nik' => '07987210014',
            'no_hp' => '0235527890',
            'jenis_akun' => 'dosen',
        ]);
    }
}
