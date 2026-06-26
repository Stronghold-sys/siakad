<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ti = Jurusan::where('nama_jurusan', 'Teknik Informatika')->first();
        $si = Jurusan::where('nama_jurusan', 'Sistem Informasi')->first();
        $dkv = Jurusan::where('nama_jurusan', 'Desain Komunikasi Visual')->first();
        $tk = Jurusan::where('nama_jurusan', 'Teknik Komputer')->first();

        // Biaya registrasi dasar (tambahan biaya sensitif yang dihitung server-side)
        $registrationFee = 250000;

        $mahasiswas = [
            [
                'nim' => '2201010001',
                'nama' => 'Aditya Pratama',
                'jurusan_id' => $ti->id,
                'biaya_kuliah' => $ti->biaya_semester + $registrationFee,
            ],
            [
                'nim' => '2201010002',
                'nama' => 'Budi Setiawan',
                'jurusan_id' => $si->id,
                'biaya_kuliah' => $si->biaya_semester + $registrationFee,
            ],
            [
                'nim' => '2201010003',
                'nama' => 'Citra Lestari',
                'jurusan_id' => $dkv->id,
                'biaya_kuliah' => $dkv->biaya_semester + $registrationFee,
            ],
            [
                'nim' => '2201010004',
                'nama' => 'Dharma Wijaya',
                'jurusan_id' => $tk->id,
                'biaya_kuliah' => $tk->biaya_semester + $registrationFee,
            ],
            [
                'nim' => '2201010005',
                'nama' => 'Elisa Fitriani',
                'jurusan_id' => $ti->id,
                'biaya_kuliah' => $ti->biaya_semester + $registrationFee,
            ],
        ];

        foreach ($mahasiswas as $mahasiswa) {
            Mahasiswa::create($mahasiswa);
        }
    }
}
