<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilihinstansi extends Model
{
    use HasFactory;

    protected $table = 'pilihinstansi';

    protected $fillable = [
        'nis',
        'nama',
        'jurusan',
    ];
}
