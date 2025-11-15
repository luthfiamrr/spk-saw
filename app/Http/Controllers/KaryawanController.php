<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Departemen;
use App\Models\Jabatan;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $karyawanQuery = Karyawan::with(['departemen', 'jabatan']);

        $karyawanQuery->when($search, function ($query, $searchTerm) {
            return $query->where('nama_lengkap', 'like', "%{$searchTerm}%")
                ->orWhere('nip', 'like', "%{$searchTerm}%")
                ->orWhere('email', 'like', "%{$searchTerm}%");
        });

        $karyawan = $karyawanQuery->paginate(10)->appends($request->only('search'));

        return view('karyawan.index', compact('karyawan', 'search'));
    }

    public function create()
    {
        $departemen = Departemen::all();
        $jabatan = Jabatan::all();
        return view('karyawan.create', compact('departemen', 'jabatan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:karyawan,nip',
            'nama_lengkap' => 'required|max:150',
            'email' => 'required|email|unique:karyawan,email',
            'departemen_id' => 'required|exists:departemen,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'tgl_bergabung' => 'required|date'
        ]);

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function edit(Karyawan $karyawan)
    {
        $departemen = Departemen::all();
        $jabatan = Jabatan::all();
        return view('karyawan.edit', compact('karyawan', 'departemen', 'jabatan'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nip' => 'required|unique:karyawan,nip,' . $karyawan->id,
            'nama_lengkap' => 'required|max:150',
            'email' => 'required|email|unique:karyawan,email,' . $karyawan->id,
            'departemen_id' => 'required|exists:departemen,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'tgl_bergabung' => 'required|date'
        ]);

        $karyawan->update($validated);

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil diupdate');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawan.index')
            ->with('success', 'Karyawan berhasil dihapus');
    }
}
