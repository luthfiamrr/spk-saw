@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="mb-8 p-6 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg shadow-lg text-white">
    <div class="flex items-center">
        <i class="ri-dashboard-3-line text-5xl mr-4 opacity-90"></i>
        <div>
            <h2 class="text-3xl font-bold">Halo, Selamat Datang!</h2>
            <p class="text-blue-100 mt-1">
                Anda berada di Dashboard Sistem Pendukung Keputusan (SPK) Metode SAW.
            </p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center transition-all hover:shadow-xl">
        <div class="bg-blue-100 rounded-lg p-4 mr-5">
            <i class="ri-group-line text-4xl text-blue-600"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Karyawan</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalKaryawan }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center transition-all hover:shadow-xl">
        <div class="bg-green-100 rounded-lg p-4 mr-5">
            <i class="ri-file-list-3-line text-4xl text-green-600"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Kriteria</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalKriteria }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center transition-all hover:shadow-xl">
        <div class="bg-yellow-100 rounded-lg p-4 mr-5">
            <i class="ri-calendar-event-line text-4xl text-yellow-600"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Periode Aktif</p>
            <p class="text-2xl font-bold text-gray-800">{{ $periodeAktif }}</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-5 flex items-center transition-all hover:shadow-xl">
        <div class="bg-purple-100 rounded-lg p-4 mr-5">
            <i class="ri-building-4-line text-4xl text-purple-600"></i>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Departemen</p>
            <p class="text-3xl font-bold text-gray-800">{{ $totalDepartemen }}</p>
        </div>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow-lg p-6">
    <div class="flex items-center mb-5">
        <i class="ri-play-list-add-line text-2xl text-blue-600 mr-3"></i>
        <h3 class="text-xl font-bold text-gray-800">Panduan Cepat Penggunaan Sistem</h3>
    </div>

    <div class="space-y-5">
        <div class="flex items-start">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold ring-4 ring-blue-100">1</div>
            <div class="ml-4">
                <p class="font-medium text-gray-900">Siapkan Data Master</p>
                <p class="text-sm text-gray-600">Pastikan data <strong>Karyawan</strong> dan <strong>Kriteria</strong> sudah terisi lengkap.</p>
            </div>
        </div>
        <div class="flex items-start">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold ring-4 ring-blue-100">2</div>
            <div class="ml-4">
                <p class="font-medium text-gray-900">Tentukan Periode</p>
                <p class="text-sm text-gray-600">Buat <strong>Periode Penilaian</strong> baru dan pastikan statusnya "Aktif".</p>
            </div>
        </div>
        <div class="flex items-start">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold ring-4 ring-blue-100">3</div>
            <div class="ml-4">
                <p class="font-medium text-gray-900">Input Penilaian</p>
                <p class="text-sm text-gray-600">Masuk ke menu <strong>Penilaian</strong>, pilih periode, lalu input nilai untuk setiap karyawan.</p>
            </div>
        </div>
        <div class="flex items-start">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold ring-4 ring-blue-100">4</div>
            <div class="ml-4">
                <p class="font-medium text-gray-900">Proses Perhitungan</p>
                <p class="text-sm text-gray-600">Klik tombol <strong>"Hitung Hasil SAW"</strong> untuk memproses data nilai.</p>
            </div>
        </div>
        <div class="flex items-start">
            <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold ring-4 ring-blue-100">5</div>
            <div class="ml-4">
                <p class="font-medium text-gray-900">Lihat Hasil Akhir</p>
                <p class="text-sm text-gray-600">Lihat hasil ranking karyawan terbaik di halaman <strong>Hasil Penilaian</strong>.</p>
            </div>
        </div>
    </div>
</div>

@endsection