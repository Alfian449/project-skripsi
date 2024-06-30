<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansis';

    protected $fillable = [
        'name',
        'alamat',
        'phone',
        'email',
        'guru_id'
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
