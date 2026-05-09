<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peralatan extends Model
{
    protected $fillable = [
        'kode_peralatan',
        'nama_peralatan',
        'stok',
        'kategori',
    ];

    public function peminjamans() {
        return $this->belongsToMany(Peminjaman::class, 'detail_peralatans')
                    ->withPivot('jumlah_pinjam');
    }
}
