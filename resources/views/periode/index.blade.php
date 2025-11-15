@extends('layouts.app')

@section('title', 'Periode Penilaian')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-3xl font-bold text-gray-700">Periode Penilaian</h2>
        <p class="text-md font-semibold text-gray-600">Kelola siklus penilaian kinerja karyawan.</p>
    </div>
    <a href="{{ route('periode.create') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
        <i class="ri-add-line mr-1 -ml-1"></i>
        Buat Periode Baru
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">

            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-full">
                        Periode
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($periode as $per)
                <tr class="hover:bg-gray-50 transition duration-150">

                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            {{-- Ikon Kalender --}}
                            <div class="h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="ri-calendar-todo-line text-lg text-blue-700"></i>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $per->nama_periode }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ $per->tgl_mulai->format('d M Y') }} - {{ $per->tgl_selesai->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($per->status == 'aktif')
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            <i class="ri-play-circle-line mr-1"></i> Aktif
                        </span>
                        @else
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            <i class="ri-check-line mr-1"></i> Selesai
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('periode.edit', $per) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                <i class="ri-pencil-line text-lg"></i>
                            </a>
                            <form action="{{ route('periode.destroy', $per) }}" method="POST" class="inline">
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
                            <i class="ri-calendar-off-line text-5xl text-gray-400"></i>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Periode</h3>
                            <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat periode penilaian baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Paginasi --}}
<div class="mt-6">
    {{ $periode->links() }}
</div>

@endsection