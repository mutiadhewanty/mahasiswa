<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nilai = [
            [   'mahasiswa_id' => 1,
                'matakuliah_id' => 1,
                'nilai' => 'A'
            ],
            [   'mahasiswa_id' => 2,
                'matakuliah_id' => 2,
                'nilai' => 'B'
            ]
        ];
        DB::table('mahasiswa_matakuliah')->insert($nilai);
    }
}
