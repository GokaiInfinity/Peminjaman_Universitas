<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ruang extends Model
{
    protected $fillable = [
        'gedung',
        'lantai',
        'status_ketersediaan',
    ];
}
