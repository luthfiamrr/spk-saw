<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Karyawan;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        $karyawan = [
            [
                'nip' => 'NIP001',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@company.com',
                'departemen_id' => 1,
                'jabatan_id' => 1,
                'tgl_bergabung' => '2023-01-15'
            ],
            [
                'nip' => 'NIP002',
                'nama_lengkap' => 'Siti Aminah',
                'email' => 'siti@company.com',
                'departemen_id' => 2,
                'jabatan_id' => 2,
                'tgl_bergabung' => '2022-06-20'
            ],
            [
                'nip' => 'NIP003',
                'nama_lengkap' => 'Ahmad Wijaya',
                'email' => 'ahmad@company.com',
                'departemen_id' => 1,
                'jabatan_id' => 1,
                'tgl_bergabung' => '2023-03-10'
            ],
            [
                'nip' => 'NIP004',
                'nama_lengkap' => 'Dewi Lestari',
                'email' => 'dewi@company.com',
                'departemen_id' => 3,
                'jabatan_id' => 2,
                'tgl_bergabung' => '2021-11-05'
            ],
            [
                'nip' => 'NIP005',
                'nama_lengkap' => 'Rudi Hartono',
                'email' => 'rudi@company.com',
                'departemen_id' => 4,
                'jabatan_id' => 3,
                'tgl_bergabung' => '2020-08-12'
            ],
        ];

        foreach ($karyawan as $kar) {
            Karyawan::create($kar);
        }
    }
}
