<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departemen;

class DepartemenSeeder extends Seeder
{
    public function run(): void
    {
        $departemen = [
            ['nama_departemen' => 'IT'],
            ['nama_departemen' => 'Sales'],
            ['nama_departemen' => 'Marketing'],
            ['nama_departemen' => 'Finance'],
            ['nama_departemen' => 'HRD'],
        ];

        foreach ($departemen as $dept) {
            Departemen::create($dept);
        }
    }
}
