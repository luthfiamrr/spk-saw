<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPK SAW')</title>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Remix Icon CDN (ikon dari CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <nav class="bg-[#f9f9f9] h-screen fixed top-0 left-0 min-w-[250px] py-6 px-4 overflow-auto shadow-md">

        <!-- Logo -->
        <div class="flex items-center gap-3 mb-6 px-4">
            <i class="ri-bar-chart-box-line text-blue-600 text-3xl"></i>
            <h1 class="text-2xl font-bold text-blue-600">SPK SAW</h1>
        </div>

        <ul class="space-y-1">

            <!-- Dashboard -->
            <li>
                <a href="{{ route('dashboard') }}"
                    class="text-slate-800 hover:text-slate-900 font-medium transition-all text-[15px] 
                           flex items-center hover:bg-[#efefef] rounded-md px-4 py-2">
                    <i class="ri-dashboard-line text-xl mr-3"></i>
                    Dashboard
                </a>
            </li>

            <!-- Karyawan -->
            <li>
                <a href="{{ route('karyawan.index') }}"
                    class="text-slate-800 hover:text-slate-900 font-medium transition-all text-[15px] 
                           flex items-center hover:bg-[#efefef] rounded-md px-4 py-2">
                    <i class="ri-user-3-line text-xl mr-3"></i>
                    Karyawan
                </a>
            </li>

            <!-- Kriteria -->
            <li>
                <a href="{{ route('kriteria.index') }}"
                    class="text-slate-800 hover:text-slate-900 font-medium transition-all text-[15px] 
                           flex items-center hover:bg-[#efefef] rounded-md px-4 py-2">
                    <i class="ri-list-check-3 text-xl mr-3"></i>
                    Kriteria
                </a>
            </li>

            <!-- Periode -->
            <li>
                <a href="{{ route('periode.index') }}"
                    class="text-slate-800 hover:text-slate-900 font-medium transition-all text-[15px] 
                           flex items-center hover:bg-[#efefef] rounded-md px-4 py-2">
                    <i class="ri-calendar-event-line text-xl mr-3"></i>
                    Periode
                </a>
            </li>

            <!-- Penilaian -->
            <li>
                <a href="{{ route('penilaian.index') }}"
                    class="text-slate-800 hover:text-slate-900 font-medium transition-all text-[15px] 
                           flex items-center hover:bg-[#efefef] rounded-md px-4 py-2">
                    <i class="ri-star-smile-line text-xl mr-3"></i>
                    Penilaian
                </a>
            </li>

        </ul>

        <!-- Logout -->
        <div class="absolute bottom-6 left-0 w-full px-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-3 text-red-600 hover:text-red-700 
                           hover:bg-red-100 w-full px-4 py-2 rounded-md">
                    <i class="ri-logout-circle-line text-xl"></i>
                    Logout
                </button>
            </form>
        </div>

    </nav>

    <!-- Content -->
    <main class="ml-[250px] w-full p-10">

        @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>

</body>

</html>