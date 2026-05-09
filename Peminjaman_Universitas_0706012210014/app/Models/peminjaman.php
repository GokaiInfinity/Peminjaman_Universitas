<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    protected $fillable = [
        'tanggal_pengajuan',
        'tanggal_pakai',
        'durasi_peminjaman',
        'status_pengajuan',
        'catatan_waktu_pengembalian_aktual',
        'keterangan_keperluan_kegiatan',
    ];
}
