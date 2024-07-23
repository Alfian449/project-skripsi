<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapnilai extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'rekaps';

    public function response()
    {
        return $this->belongsTo(User::class, 'response_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
