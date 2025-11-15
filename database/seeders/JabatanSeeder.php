<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        $jabatan = [
            ['nama_jabatan' => 'Staff'],
            ['nama_jabatan' => 'Supervisor'],
            ['nama_jabatan' => 'Manager'],
            ['nama_jabatan' => 'Senior Manager'],
        ];

        foreach ($jabatan as $jab) {
            Jabatan::create($jab);
        }
    }
}
