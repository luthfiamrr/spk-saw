@extends('layouts.app')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Tambah Kriteria Baru</h2>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="kode_kriteria">
                    Kode Kriteria <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="kode_kriteria"
                    id="kode_kriteria"
                    value="{{ old('kode_kriteria') }}"
                    placeholder="C1, C2, C3..."
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kode_kriteria') border-red-500 @enderror"
                    required>
                @error('kode_kriteria')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_kriteria">
                    Nama Kriteria <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="nama_kriteria"
                    id="nama_kriteria"
                    value="{{ old('nama_kriteria') }}"
                    placeholder="Absensi, Kualitas Kerja..."
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_kriteria') border-red-500 @enderror"
                    required>
                @error('nama_kriteria')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="bobot">
                    Bobot (0.00 - 1.00) <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    step="0.01"
                    min="0"
                    max="1"
                    name="bobot"
                    id="bobot"
                    value="{{ old('bobot') }}"
                    placeholder="0.25 = 25%"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bobot') border-red-500 @enderror"
                    required>
                @error('bobot')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tipe">
                    Tipe <span class="text-red-500">*</span>
                </label>
                <select
                    name="tipe"
                    id="tipe"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tipe') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Tipe</option>
                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit (Semakin tinggi semakin baik)</option>
                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost (Semakin rendah semakin baik)</option>
                </select>
                @error('tipe')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center justify-end mt-6 gap-3">
            <a href="{{ route('kriteria.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>

@endsection