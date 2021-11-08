<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaMatakuliah extends Model
{
    use HasFactory;
    protected $table="mahasiswa_matakuliah" ;

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class);
    }

    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class);
    }
}
