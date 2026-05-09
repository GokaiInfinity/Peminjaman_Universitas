<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class peralatan extends Model
{
    protected $fillable = [
        'nama_peralatan',
        'stok',
        'kategori',
    ];
}
