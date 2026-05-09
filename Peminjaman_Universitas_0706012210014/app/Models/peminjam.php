<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjam extends Model
{
    protected $fillable = [
        'nama',
        'nim_nik',
        'no_hp',
        'jenis_akun',
    ];

    public function peminjamans() {
        return $this->hasMany(Peminjaman::class);
    }

}
