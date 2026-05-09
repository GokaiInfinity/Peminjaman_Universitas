<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $fillable = [
    'peminjam_id',
    'ruang_id',
    'tgl_pengajuan',
    'tgl_pakai',
    'durasi_jam',
    'status',
    'waktu_kembali_aktual',
    'keperluan'
];

    // Relasi ke Peminjam
    public function peminjam() {
        return $this->belongsTo(Peminjam::class);
    }

    // Relasi ke Ruang
    public function ruang() {
        return $this->belongsTo(Ruang::class);
    }

    // Relasi Many-to-Many ke Peralatan melalui tabel pivot
    public function peralatans() {
        return $this->belongsToMany(Peralatan::class, 'detail_peralatans')
                    ->withPivot('jumlah_pinjam')
                    ->withTimestamps();
    }

}
