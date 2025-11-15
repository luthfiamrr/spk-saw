@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-3xl font-bold text-gray-700">Data Karyawan</h2>
    <a href="{{ route('karyawan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
        + Tambah Karyawan
    </a>
</div>

<div class="mb-4">
    <form action="{{ route('karyawan.index') }}" method="GET">
        <div class="flex">
            <input type="text" name="search"
                class="w-full px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Cari berdasarkan Nama, NIP, atau Email..."
                value="{{ $search ?? '' }}">

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg shadow-md transition duration-300">
                <i class="ri-search-line"></i>
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">

            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Karyawan
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        NIP
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Departemen
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jabatan
                    </th>
                    <th scope="col" class="px-8.5 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($karyawan as $kar)
                @php
                $names = explode(' ', $kar->nama_lengkap);
                $initials = strtoupper(substr($names[0], 0, 1) . (count($names) > 1 ? substr(end($names), 0, 1) : ''));
                @endphp

                <tr class="hover:bg-gray-50 transition duration-150">

                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-sm font-semibold text-blue-700">{{ $initials }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $kar->nama_lengkap }}</div>
                                <div class="text-sm text-gray-500">{{ $kar->email }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-700">{{ $kar->nip }}</div>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $kar->departemen->nama_departemen }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                            {{ $kar->jabatan->nama_jabatan }}
                        </span>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('karyawan.edit', $kar) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                <i class="ri-pencil-line text-lg"></i>
                            </a>
                            <form action="{{ route('karyawan.destroy', $kar) }}" method="POST" class="inline">
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
                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                        Belum ada data karyawan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $karyawan->links() }}
</div>
@endsection