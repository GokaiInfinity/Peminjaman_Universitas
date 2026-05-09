<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peminjam extends Model
{
    protected $fillable = [
        'nama',
        'nim/nik',
        'no_hp',
        'jenis_akun',
    ];
}
