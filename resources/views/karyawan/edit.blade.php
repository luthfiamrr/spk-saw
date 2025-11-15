@extends('layouts.app')

@section('title', 'Edit Karyawan')

@section('content')
<div class="mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Edit Karyawan</h2>
</div>

<div class="bg-white rounded-lg shadow-md p-6">
    <form action="{{ route('karyawan.update', $karyawan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nip">
                    NIP <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="nip"
                    id="nip"
                    value="{{ old('nip', $karyawan->nip) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nip') border-red-500 @enderror"
                    required>
                @error('nip')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_lengkap">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="nama_lengkap"
                    id="nama_lengkap"
                    value="{{ old('nama_lengkap', $karyawan->nama_lengkap) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_lengkap') border-red-500 @enderror"
                    required>
                @error('nama_lengkap')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $karyawan->email) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                    required>
                @error('email')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="departemen_id">
                    Departemen <span class="text-red-500">*</span>
                </label>
                <select
                    name="departemen_id"
                    id="departemen_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('departemen_id') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Departemen</option>
                    @foreach($departemen as $dept)
                    <option value="{{ $dept->id }}" {{ old('departemen_id', $karyawan->departemen_id) == $dept->id ? 'selected' : '' }}>
                        {{ $dept->nama_departemen }}
                    </option>
                    @endforeach
                </select>
                @error('departemen_id')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="jabatan_id">
                    Jabatan <span class="text-red-500">*</span>
                </label>
                <select
                    name="jabatan_id"
                    id="jabatan_id"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jabatan_id') border-red-500 @enderror"
                    required>
                    <option value="">Pilih Jabatan</option>
                    @foreach($jabatan as $jab)
                    <option value="{{ $jab->id }}" {{ old('jabatan_id', $karyawan->jabatan_id) == $jab->id ? 'selected' : '' }}>
                        {{ $jab->nama_jabatan }}
                    </option>
                    @endforeach
                </select>
                @error('jabatan_id')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tgl_bergabung">
                    Tanggal Bergabung <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    name="tgl_bergabung"
                    id="tgl_bergabung"
                    value="{{ old('tgl_bergabung', $karyawan->tgl_bergabung->format('Y-m-d')) }}"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tgl_bergabung') border-red-500 @enderror"
                    required>
                @error('tgl_bergabung')
                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex items-center justify-end mt-6 gap-3">
            <a href="{{ route('karyawan.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update
            </button>
        </div>
    </form>
</div>

@endsection