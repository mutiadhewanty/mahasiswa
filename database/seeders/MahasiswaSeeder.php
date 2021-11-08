<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i=1; $i <= 10; $i++) {
            DB::table('mahasiswa')->insert([
                'nim' => $faker->numerify('##########'),
                'nama' => $faker->name(),
                'jurusan' => 'Teknologi Informasi',
                // 'kelas_id' => $faker->randomElement(['2A', '2B', '2C', '2D', '2E']),
                'no_handphone' => $faker->phoneNumber(),
            ]);
        }
    }
}
