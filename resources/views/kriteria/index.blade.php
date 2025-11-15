@extends('layouts.app')

@section('title', 'Data Kriteria')

@section('content')

<div class="flex justify-between items-start mb-6 gap-4">
    <div>
        <h2 class="mt-4 text-3xl font-bold text-gray-700">Data Kriteria</h2>
        <p class="text-md font-semibold text-gray-600">
            Atur pilar-pilar yang menjadi dasar utama penilaian kinerja.
        </p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200 text-center">
        <span class="text-sm font-medium text-gray-500">Total Bobot</span>
        <p class="text-2xl font-bold {{ $totalBobot == 1 ? 'text-green-600' : 'text-red-600' }}">
            {{ $totalBobot * 100 }}<span class="text-lg">%</span>
        </p>
    </div>
</div>

<div class="mb-6">
    <a href="{{ route('kriteria.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
        <i class="ri-add-line mr-1 -ml-1"></i>
        Tambah Kriteria
    </a>
</div>


@if($totalBobot != 1)
<div class="mb-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-md shadow-sm">
    <div class="flex items-center">
        <i class="ri-error-warning-fill text-yellow-600 text-xl mr-3"></i>
        <div>
            <strong class="font-bold">Peringatan!</strong>
            <span class="block sm:inline">Total bobot harus sama dengan 1.0 (100%). Silakan sesuaikan bobot kriteria.</span>
        </div>
    </div>
</div>
@endif

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium leading-6 text-gray-900">
            Daftar Kriteria Penilaian
        </h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">
                        Kriteria
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Tipe
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($kriteria as $krit)
                <tr class="hover:bg-gray-50 transition duration-150">

                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-blue-700">{{ $krit->kode_kriteria }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $krit->nama_kriteria }}</div>
                                <div class="text-sm text-gray-500">Bobot: {{ $krit->bobot }} ({{ $krit->bobot * 100 }}%)</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($krit->tipe == 'benefit')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Benefit
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            Cost
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('kriteria.edit', $krit) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                <i class="ri-pencil-line text-lg"></i>
                            </a>
                            <form action="{{ route('kriteria.destroy', $krit) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="ri-delete-bin-line text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-10">
                        <div class="text-center">
                            <i class="ri-file-list-3-line text-5xl text-gray-400"></i>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Kriteria</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kriteria penilaian baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 bg-white rounded-lg shadow-lg p-5">
    <div class="flex items-center">
        <i class="ri-information-line text-2xl text-blue-500 mr-3"></i>
        <h4 class="font-bold text-gray-800 text-lg">Penjelasan Istilah</h4>
    </div>
    <ul class="mt-3 text-sm text-gray-700 space-y-2 pl-8 list-disc">
        <li><strong>Benefit:</strong> Semakin tinggi nilai semakin baik (contoh: Kualitas Kerja, Kehadiran).</li>
        <li><strong>Cost:</strong> Semakin rendah nilai semakin baik (contoh: Jumlah Komplain, Keterlambatan).</li>
        <li><strong>Bobot:</strong> Menentukan tingkat kepentingan kriteria. Total semua bobot harus 100%.</li>
    </ul>
</div>

@endsection