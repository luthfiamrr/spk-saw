<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodePenilaian;
use App\Models\Karyawan;
use App\Models\Kriteria;
use App\Models\MatriksPenilaian;
use App\Models\HasilPenilaian;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    // Halaman Input Penilaian
    public function index()
    {
        $periodeAktif = PeriodePenilaian::where('status', 'aktif')->get();
        return view('penilaian.index', compact('periodeAktif'));
    }

    // Form Input Nilai
    public function create(Request $request)
    {
        $periodeId = $request->periode_id;

        if (!$periodeId) {
            return redirect()->route('penilaian.index')
                ->with('error', 'Pilih periode penilaian terlebih dahulu');
        }

        $periode = PeriodePenilaian::findOrFail($periodeId);
        $karyawan = Karyawan::with(['departemen', 'jabatan'])->get();
        $kriteria = Kriteria::all();

        // Ambil nilai yang sudah ada (jika edit)
        $nilaiExisting = MatriksPenilaian::where('periode_id', $periodeId)
            ->get()
            ->groupBy('karyawan_id')
            ->map(function ($items) {
                return $items->pluck('nilai_mentah', 'kriteria_id');
            });

        return view('penilaian.create', compact('periode', 'karyawan', 'kriteria', 'nilaiExisting'));
    }

    // Simpan Penilaian
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode_id' => 'required|exists:periode_penilaian,id',
            'nilai' => 'required|array',
            'nilai.*.*' => 'required|numeric|min:0|max:100'
        ]);

        DB::beginTransaction();

        try {
            $periodeId = $validated['periode_id'];

            // Hapus nilai lama untuk periode ini
            MatriksPenilaian::where('periode_id', $periodeId)->delete();

            // Insert nilai baru
            foreach ($validated['nilai'] as $karyawanId => $nilaiKriteria) {
                foreach ($nilaiKriteria as $kriteriaId => $nilai) {
                    MatriksPenilaian::create([
                        'periode_id' => $periodeId,
                        'karyawan_id' => $karyawanId,
                        'kriteria_id' => $kriteriaId,
                        'nilai_mentah' => $nilai
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('penilaian.index')
                ->with('success', 'Penilaian berhasil disimpan. Silakan hitung hasil SAW.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // HITUNG SAW (ALGORITMA UTAMA)
    public function hitung(Request $request)
    {
        $periodeId = $request->periode_id;

        if (!$periodeId) {
            return redirect()->route('penilaian.index')
                ->with('error', 'Pilih periode penilaian terlebih dahulu');
        }

        DB::beginTransaction();

        try {
            // 1. Ambil data
            $kriteria = Kriteria::all();
            $karyawan = Karyawan::all();
            $matriks = MatriksPenilaian::where('periode_id', $periodeId)->get();

            // Validasi: Cek apakah semua karyawan sudah dinilai
            $totalNilaiHarus = $karyawan->count() * $kriteria->count();
            if ($matriks->count() < $totalNilaiHarus) {
                DB::rollBack();
                return redirect()->back()
                    ->with('error', 'Data penilaian belum lengkap. Pastikan semua karyawan telah dinilai untuk semua kriteria.');
            }

            // 2. Kelompokkan nilai per kriteria
            $nilaiPerKriteria = $matriks->groupBy('kriteria_id');

            // 3. NORMALISASI (Tahap 1 SAW)
            $matriksNormalisasi = [];

            foreach ($kriteria as $krit) {
                $kriteriaId = $krit->id;
                $nilaiKriteria = $nilaiPerKriteria[$kriteriaId] ?? collect();

                // Cari nilai max dan min untuk kriteria ini
                $maxNilai = $nilaiKriteria->max('nilai_mentah');
                $minNilai = $nilaiKriteria->min('nilai_mentah');

                // Normalisasi untuk setiap karyawan
                foreach ($nilaiKriteria as $nilai) {
                    $karyawanId = $nilai->karyawan_id;
                    $nilaiMentah = $nilai->nilai_mentah;

                    // Rumus Normalisasi SAW
                    if ($krit->tipe == 'benefit') {
                        // Benefit: R = X / Max(X)
                        $nilaiNormal = $maxNilai > 0 ? $nilaiMentah / $maxNilai : 0;
                    } else {
                        // Cost: R = Min(X) / X
                        $nilaiNormal = $nilaiMentah > 0 ? $minNilai / $nilaiMentah : 0;
                    }

                    // Simpan hasil normalisasi
                    if (!isset($matriksNormalisasi[$karyawanId])) {
                        $matriksNormalisasi[$karyawanId] = [];
                    }
                    $matriksNormalisasi[$karyawanId][$kriteriaId] = $nilaiNormal;
                }
            }

            // 4. PERANGKINGAN (Tahap 2 SAW)
            $hasilAkhir = [];

            foreach ($karyawan as $kar) {
                $karyawanId = $kar->id;
                $skorAkhir = 0;

                // V = Σ(W × R)
                foreach ($kriteria as $krit) {
                    $kriteriaId = $krit->id;
                    $bobot = $krit->bobot;
                    $nilaiNormal = $matriksNormalisasi[$karyawanId][$kriteriaId] ?? 0;

                    $skorAkhir += ($bobot * $nilaiNormal);
                }

                $hasilAkhir[$karyawanId] = $skorAkhir;
            }

            // 5. Urutkan berdasarkan skor (DESC)
            arsort($hasilAkhir);

            // 6. Simpan hasil ke database
            HasilPenilaian::where('periode_id', $periodeId)->delete();

            $ranking = 1;
            foreach ($hasilAkhir as $karyawanId => $skor) {
                HasilPenilaian::create([
                    'periode_id' => $periodeId,
                    'karyawan_id' => $karyawanId,
                    'skor_akhir' => $skor,
                    'ranking' => $ranking++
                ]);
            }

            DB::commit();

            return redirect()->route('penilaian.hasil', ['periode_id' => $periodeId])
                ->with('success', 'Perhitungan SAW berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Tampilkan Hasil
    public function hasil(Request $request)
    {
        $periodeId = $request->periode_id;

        if (!$periodeId) {
            return redirect()->route('penilaian.index')
                ->with('error', 'Pilih periode penilaian terlebih dahulu');
        }

        $periode = PeriodePenilaian::findOrFail($periodeId);
        $hasil = HasilPenilaian::where('periode_id', $periodeId)
            ->with(['karyawan.departemen', 'karyawan.jabatan'])
            ->orderBy('ranking', 'asc')
            ->get();

        // Ambil detail penilaian
        $kriteria = Kriteria::all();
        $detailNilai = MatriksPenilaian::where('periode_id', $periodeId)
            ->with('kriteria')
            ->get()
            ->groupBy('karyawan_id');

        return view('penilaian.hasil', compact('periode', 'hasil', 'kriteria', 'detailNilai'));
    }
}
