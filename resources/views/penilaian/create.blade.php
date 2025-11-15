@extends('layouts.app')

@section('title', 'Input Penilaian')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Input Penilaian Karyawan</h2>
    <p class="text-gray-600 mt-1">Periode: <strong>{{ $periode->nama_periode }}</strong></p>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf
        <input type="hidden" name="periode_id" value="{{ $periode->id }}">

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-0 bg-gray-50">
                            No
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider sticky left-12 bg-gray-50">
                            Nama Karyawan
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Departemen
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jabatan
                        </th>
                        @foreach($kriteria as $krit)
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $krit->kode_kriteria }}<br>
                            <span class="text-xs normal-case">{{ $krit->nama_kriteria }}</span><br>
                            <span class="text-xs normal-case font-normal">({{ $krit->bobot * 100 }}%)</span>
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($karyawan as $index => $kar)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900 sticky left-0 bg-white">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900 sticky left-12 bg-white">
                            {{ $kar->nama_lengkap }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $kar->departemen->nama_departemen }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500">
                            {{ $kar->jabatan->nama_jabatan }}
                        </td>
                        @foreach($kriteria as $krit)
                        <td class="px-4 py-3 whitespace-nowrap text-center">
                            <input
                                type="number"
                                name="nilai[{{ $kar->id }}][{{ $krit->id }}]"
                                min="0"
                                max="100"
                                step="0.01"
                                value="{{ old('nilai.' . $kar->id . '.' . $krit->id, $nilaiExisting[$kar->id][$krit->id] ?? '') }}"
                                class="w-20 px-2 py-1 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-center"
                                placeholder="0-100"
                                required>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="font-bold text-blue-800 mb-2">📝 Petunjuk Pengisian:</h4>
            <ul class="text-sm text-blue-700 space-y-1">
                <li>• Masukkan nilai antara 0-100 untuk setiap kriteria</li>
                <li>• Pastikan semua karyawan telah dinilai sebelum menyimpan</li>
                <li>• Data penilaian dapat diubah sebelum menghitung hasil akhir</li>
            </ul>
        </div>

        <div class="flex items-center justify-end mt-6 gap-3">
            <a href="{{ route('penilaian.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Penilaian
            </button>
        </div>
    </form>
</div>

@endsection