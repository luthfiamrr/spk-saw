@extends('layouts.app')

@section('title', 'Edit Periode Penilaian')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Edit Periode Penilaian</h2>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('periode.update', $periode) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6">

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_periode">
                    Nama Periode <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="nama_periode"
                    id="nama_periode"
                    value="{{ old('nama_periode', $periode->nama_periode) }}"
                    placeholder="Contoh: Karyawan Terbaik Q4 2025"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_periode') border-red-500 @enderror"
                    required>
                @error('nama_periode')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tgl_mulai">
                        Tanggal Mulai <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        name="tgl_mulai"
                        id="tgl_mulai"
                        value="{{ old('tgl_mulai', $periode->tgl_mulai->format('Y-m-d')) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tgl_mulai') border-red-500 @enderror"
                        required>
                    @error('tgl_mulai')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tgl_selesai">
                        Tanggal Selesai <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="date"
                        name="tgl_selesai"
                        id="tgl_selesai"
                        value="{{ old('tgl_selesai', $periode->tgl_selesai->format('Y-m-d')) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tgl_selesai') border-red-500 @enderror"
                        required>
                    @error('tgl_selesai')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status <span class="text-red-500">*</span>
                </label>
                <select
                    name="status"
                    id="status"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Status</option>
                    <option value="aktif" {{ old('status', $periode->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ old('status', $periode->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                @error('status')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center justify-end mt-6 gap-3">
            <a href="{{ route('periode.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>

@endsection