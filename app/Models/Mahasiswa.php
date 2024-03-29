<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Mahasiswa extends Model //Definisi Model
{
    protected $table="mahasiswa"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public $timestamps= false; 
    protected  $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey

    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'No_Handphone',
        'Email',
        'Tanggal_Lahir'
    ];
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function matakuliah()
    {
        return $this->belongsToMany(Matakuliah::class)->withPivot('nilai');
    }
};
