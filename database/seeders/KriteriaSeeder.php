<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $kriteria = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Absensi',
                'bobot' => 0.20,
                'tipe' => 'benefit' // Semakin tinggi kehadiran semakin baik
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Kualitas Kerja',
                'bobot' => 0.30,
                'tipe' => 'benefit'
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Teamwork',
                'bobot' => 0.25,
                'tipe' => 'benefit'
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Kedisiplinan',
                'bobot' => 0.15,
                'tipe' => 'benefit'
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Jumlah Komplain',
                'bobot' => 0.10,
                'tipe' => 'cost' // Semakin sedikit komplain semakin baik
            ],
        ];

        foreach ($kriteria as $krit) {
            Kriteria::create($krit);
        }
    }
}
