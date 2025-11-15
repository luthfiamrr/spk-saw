@extends('layouts.app')

@section('title', 'Hasil Penilaian')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">🏆 Hasil Penilaian SAW</h2>
    <p class="text-gray-600 mt-1">Periode: <strong>{{ $periode->nama_periode }}</strong></p>
</div>

<!-- Ranking Cards (Top 3) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    @foreach($hasil->take(3) as $index => $item)
    <div class="bg-gradient-to-br {{ $index == 0 ? 'from-yellow-400 to-yellow-600' : ($index == 1 ? 'from-gray-300 to-gray-500' : 'from-orange-400 to-orange-600') }} rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="text-6xl font-bold opacity-50">#{{ $item->ranking }}</div>
            <div class="text-4xl">
                {{ $index == 0 ? '🥇' : ($index == 1 ? '🥈' : '🥉') }}
            </div>
        </div>
        <h3 class="text-xl font-bold mb-2">{{ $item->karyawan->nama_lengkap }}</h3>
        <p class="text-sm opacity-90">{{ $item->karyawan->departemen->nama_departemen }} - {{ $item->karyawan->jabatan->nama_jabatan }}</p>
        <div class="mt-4 pt-4 border-t border-white border-opacity-30">
            <p class="text-sm">Skor Akhir</p>
            <p class="text-3xl font-bold">{{ number_format($item->skor_akhir, 4) }}</p>
        </div>
    </div>
    @endforeach
</div>

<!-- Detail Tabel Lengkap -->
<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <h3 class="text-lg font-bold text-gray-800">Ranking Lengkap Semua Karyawan</h3>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ranking</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Karyawan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departemen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Skor Akhir</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($hasil as $item)
                <tr class="hover:bg-gray-50 {{ $item->ranking <= 3 ? 'bg-yellow-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full {{ $item->ranking == 1 ? 'bg-yellow-100 text-yellow-800' : ($item->ranking == 2 ? 'bg-gray-200 text-gray-800' : ($item->ranking == 3 ? 'bg-orange-100 text-orange-800' : 'bg-blue-100 text-blue-800')) }} font-bold">
                            {{ $item->ranking }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->karyawan->nip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->karyawan->nama_lengkap }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->karyawan->departemen->nama_departemen }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->karyawan->jabatan->nama_jabatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="text-lg font-bold text-blue-600">{{ number_format($item->skor_akhir, 4) }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <button type="button" onclick="showDetail({{ $item->karyawan->id }})" class="text-indigo-600 hover:text-indigo-900">
                            Detail
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Detail Perhitungan per Karyawan (Modal) -->
<div id="detailModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-2/3 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Detail Penilaian</h3>
            <button type="button" onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div id="modalContent" class="overflow-x-auto">
            <!-- Content akan diisi via JavaScript -->
        </div>
    </div>
</div>

<!-- Tombol Aksi -->
<div class="flex justify-between items-center no-print">
    <a href="{{ route('penilaian.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
        Kembali
    </a>
    <div class="space-x-3">
        <button type="button" onclick="window.print()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            🖨️ Cetak Hasil
        </button>
        <a href="{{ route('penilaian.create', ['periode_id' => $periode->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">
            Edit Penilaian
        </a>
    </div>
</div>

<script src="{{ asset('js/penilaian-hasil.js') }}"></script>
<script>
    const dataHolder = document.getElementById('bladeData');

    var detailDataFromBlade = JSON.parse(dataHolder.dataset.detail);
    var kriteriaDataFromBlade = JSON.parse(dataHolder.dataset.kriteria);
    var hasilDataFromBlade = JSON.parse(dataHolder.dataset.hasil);

    initPenilaianHasil(detailDataFromBlade, kriteriaDataFromBlade, hasilDataFromBlade);
</script>

<style>
    @media print {

        nav,
        .no-print {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .bg-gradient-to-br {
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

@endsection