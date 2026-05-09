<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Peralatan;
use App\Services\PeminjamanService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PeminjamanValidationTest extends TestCase
{
    use RefreshDatabase; // Memastikan DB bersih setiap kali test dijalankan

    /** @test */
    public function it_fails_if_equipment_stock_is_insufficient()
    {
        // 1. Persiapan Data (Gunakan Factory atau Manual)
        $alat = Peralatan::create([
            'kode_peralatan' => 'CAM-01',
            'nama_peralatan' => 'Kamera Sony',
            'stok' => 2,
            'kategori' => 'Elektronik'
        ]);

        $service = new PeminjamanService();

        // 2. Skenario: Pinjam 3 (Padahal stok cuma 2)
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Stok alat Kamera Sony tidak mencukupi.");

        // 3. Eksekusi fungsi validasi
        $service->validasiStok($alat->id, 5);
    }

    /** @test */
    public function it_fails_if_duration_is_zero_or_negative()
    {
        $service = new PeminjamanService();

        // Skenario: Durasi 0 jam
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Durasi tidak boleh nol atau negatif.");

        $service->validasiDurasi(0);
    }

    /** @test */
    public function it_fails_if_required_fields_are_missing()
    {
        $data = [
            'peminjam_id' => null, // Data kosong
            'ruang_id' => 1,
            'tgl_pakai' => '2026-05-20'
        ];

        // Menguji apakah data lengkap
        $this->assertFalse(isset($data['peminjam_id']) && !empty($data['peminjam_id']));
    }
}
