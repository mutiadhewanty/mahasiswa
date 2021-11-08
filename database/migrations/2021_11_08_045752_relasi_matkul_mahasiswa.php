<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiMatkulMahasiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table){
            //$table->dropColumn('kelas'); //menghapus kolom kelas
            $table->unsignedBigInteger('mahasiswa_id')->nullable(); //menambahkan kolom mahasiswa_id
            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa'); //menambahkan foreign key di kolom mahasiswa_id
            $table->unsignedBigInteger('matakuliah_id')->nullable(); //menambahkan kolom mahasiswa_id
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah'); //menambahkan foreign key di kolom mahasiswa_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai', function (Blueprint $table){
            $table->string('mahasiswa');
            $table->dropForeign(['mahasiswa_id']);
            $table->string('matakuliah');
            $table->dropForeign(['matakuliah_id']);
        });
    }
}
