<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ruang extends Model
{
    protected $fillable = [
        'kapasitas',
        'gedung',
        'lantai',
        'status_ketersediaan',
    ];

    public function peminjamans() {
        return $this->hasMany(Peminjaman::class);
    }
}
