<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\PeriodePenilaian;
use App\Models\Departemen;
use App\Models\Jabatan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalKriteria = Kriteria::count();
        $periodeAktif = PeriodePenilaian::where('status', 'aktif')->count();
        $totalDepartemen = Departemen::count();

        return view('dashboard', compact(
            'totalKaryawan',
            'totalKriteria',
            'periodeAktif',
            'totalDepartemen'
        ));
    }
}
