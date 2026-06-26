<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama',
        'jurusan_id',
        'biaya_kuliah',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
