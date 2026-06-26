<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Seeder;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jurusans = [
            ['nama_jurusan' => 'Teknik Informatika', 'biaya_semester' => 5000000],
            ['nama_jurusan' => 'Sistem Informasi', 'biaya_semester' => 4500000],
            ['nama_jurusan' => 'Desain Komunikasi Visual', 'biaya_semester' => 4800000],
            ['nama_jurusan' => 'Teknik Komputer', 'biaya_semester' => 4700000],
        ];

        foreach ($jurusans as $jurusan) {
            Jurusan::create($jurusan);
        }
    }
}
