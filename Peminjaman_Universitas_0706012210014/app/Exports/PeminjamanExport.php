<?php
namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PeminjamanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Peminjaman::with(['peminjam', 'ruang'])->get();
    }

    public function headings(): array
    {
        return ["ID", "Peminjam", "Ruang", "Tanggal Pakai", "Status"];
    }

    public function map($peminjaman): array
    {
        return [
            $peminjaman->id,
            $peminjaman->peminjam->nama,
            $peminjaman->ruang->nama_ruang,
            $peminjaman->tgl_pakai,
            $peminjaman->waktu_kembali_aktual ? $peminjaman->waktu_kembali_aktual : 'Belum Kembali',
            $peminjaman->status,
        ];
    }
}
?>
