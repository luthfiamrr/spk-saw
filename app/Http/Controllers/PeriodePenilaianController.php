<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodePenilaian;

class PeriodePenilaianController extends Controller
{
    public function index()
    {
        $periode = PeriodePenilaian::latest()->paginate(10);
        return view('periode.index', compact('periode'));
    }

    public function create()
    {
        return view('periode.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|max:200',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'status' => 'required|in:aktif,selesai'
        ]);

        PeriodePenilaian::create($validated);

        return redirect()->route('periode.index')
            ->with('success', 'Periode penilaian berhasil dibuat');
    }

    public function edit(PeriodePenilaian $periode)
    {
        return view('periode.edit', compact('periode'));
    }

    public function update(Request $request, PeriodePenilaian $periode)
    {
        $validated = $request->validate([
            'nama_periode' => 'required|max:200',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'status' => 'required|in:aktif,selesai'
        ]);

        $periode->update($validated);

        return redirect()->route('periode.index')
            ->with('success', 'Periode penilaian berhasil diupdate');
    }

    public function destroy(PeriodePenilaian $periode)
    {
        $periode->delete();

        return redirect()->route('periode.index')
            ->with('success', 'Periode penilaian berhasil dihapus');
    }
}
