<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MahasiswaMatakuliah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_id'); //menambahkan kolom mahasiswa id
            $table->unsignedBigInteger('matakuliah_id'); //menambahkan kolom matakuliah id
            $table->char('nilai');

            $table->foreign('mahasiswa_id')->references('nim')->on('mahasiswa'); //menambahkan foreign key di kolom mahasiswa id
            $table->foreign('matakuliah_id')->references('id')->on('matakuliah'); //menambahkan foreign key di kolom matakuliah_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
}
