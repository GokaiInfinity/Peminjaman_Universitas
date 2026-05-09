<?php
namespace App\Services;

use App\Models\Peralatan;

class PeminjamanService
{
    public function validasiStok($alatId, $jumlahPinjam)
    {
        $alat = Peralatan::findOrFail($alatId);
        if ($alat->stok < $jumlahPinjam) {
            throw new \Exception("Stok alat {$alat->nama_peralatan} tidak mencukupi.");
        }
        return true;
    }

    public function validasiDurasi($durasi)
    {
        if ($durasi <= 0) {
            throw new \Exception("Durasi tidak boleh nol atau negatif.");
        }
        return true;
    }
}
?>
