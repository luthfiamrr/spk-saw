@extends('layouts.app')

@section('title', 'Penilaian Karyawan')

@section('content')

<div class="mb-8 text-center">
    <h2 class="text-3xl font-bold text-gray-800">Mulai Proses Penilaian</h2>
    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">
        Pilih salah satu dari dua langkah utama di bawah ini. Anda dapat memulai dengan menginput data baru atau langsung menghitung hasil dari data yang sudah ada.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <div class="bg-white rounded-lg shadow-lg p-8 transition-all hover:shadow-2xl">

        <div class="flex justify-center mb-5">
            <div class="bg-blue-100 rounded-full p-6">
                <i class="ri-pencil-line text-5xl text-blue-600"></i>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-800 text-center">Langkah 1: Input Nilai</h3>
        <p class="text-gray-600 text-center mt-2 mb-6">
            Ini adalah langkah awal. Pilih periode penilaian yang aktif, lalu Anda akan diarahkan ke halaman untuk memasukkan skor mentah (0-100) untuk setiap karyawan.
        </p>

        <form action="{{ route('penilaian.create') }}" method="GET">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Periode Aktif</label>
                <select name="periode_id" class="border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periodeAktif as $periode)
                    <option value="{{ $periode->id }}">
                        {{ $periode->nama_periode }} ({{ $periode->tgl_mulai->format('d/m/Y') }} - {{ $periode->tgl_selesai->format('d/m/Y') }})
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 text-base">
                Mulai Input Penilaian
            </button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8 transition-all hover:shadow-2xl">

        <div class="flex justify-center mb-5">
            <div class="bg-green-100 rounded-full p-6">
                <i class="ri-calculator-line text-5xl text-green-600"></i>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-800 text-center">Langkah 2: Hitung & Lihat Hasil</h3>
        <p class="text-gray-600 text-center mt-2 mb-6">
            Setelah semua nilai terisi, lakukan proses perhitungan. Sistem akan mengkalkulasi skor akhir (SAW) dan Anda akan langsung diarahkan ke laporan hasil rangking.
        </p>

        <form action="{{ route('penilaian.hitung') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Periode Dihitung</label>
                <select name="periode_id" class="border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periodeAktif as $periode)
                    <option value="{{ $periode->id }}">
                        {{ $periode->nama_periode }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg shadow-md transition duration-300 text-base" onclick="return confirm('Apakah Anda yakin ingin menghitung hasil?')">
                Hitung & Lihat Hasil
            </button>
        </form>
    </div>

</div>

@endsection