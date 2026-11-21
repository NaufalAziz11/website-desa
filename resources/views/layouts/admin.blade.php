<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ $villageProfile?->name ?? 'Website Desa' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">
        <!-- Mobile Sidebar Backdrop -->
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-slate-900/50 lg:hidden"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-slate-300 transform transition-transform duration-200 ease-in-out lg:translate-x-0 lg:static lg:inset-0 flex flex-col">
            <div class="h-16 flex items-center justify-between px-6 border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5">
                    <div class="h-8 w-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr($villageProfile?->name ?? 'D', 0, 1)) }}
                    </div>
                    <span class="font-bold text-white text-sm tracking-wide">ADMIN DESA</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto text-sm">
                @php
                    $menus = [
                        ['route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'label' => 'Dashboard'],
                        ['route' => 'admin.profile.edit', 'pattern' => 'admin.profile.*', 'label' => 'Profil & Statistik Desa'],
                        ['route' => 'admin.officials.index', 'pattern' => 'admin.officials.*', 'label' => 'Perangkat Desa'],
                        ['route' => 'admin.potentials.index', 'pattern' => 'admin.potentials.*', 'label' => 'Potensi & UMKM'],
                        ['route' => 'admin.posts.index', 'pattern' => 'admin.posts.*', 'label' => 'Berita & Informasi'],
                        ['route' => 'admin.budgets.index', 'pattern' => 'admin.budgets.*', 'label' => 'Transparansi APBDes'],
                        ['route' => 'admin.galleries.index', 'pattern' => 'admin.galleries.*', 'label' => 'Galeri Foto'],
                    ];
                @endphp
                @foreach($menus as $menu)
                    <a href="{{ route($menu['route']) }}"
                       class="flex items-center px-3.5 py-2.5 rounded-lg font-medium transition {{ request()->routeIs($menu['pattern']) ? 'bg-emerald-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
                        {{ $menu['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="p-4 border-t border-slate-800 space-y-2">
                <a href="{{ route('home') }}" target="_blank" class="block w-full text-center px-3 py-2 rounded-lg bg-slate-800 text-slate-200 text-xs font-semibold hover:bg-slate-700 transition">
                    Lihat Website Publik &rarr;
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-3 py-2 rounded-lg text-xs font-semibold text-rose-400 hover:bg-rose-500/10 transition text-center">
                        Keluar (Logout)
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center space-x-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-base sm:text-lg font-bold text-slate-800 truncate">@yield('page_title', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <span class="hidden sm:inline text-slate-500">Halo,</span>
                    <span class="font-semibold text-slate-800">{{ auth()->user()->name }}</span>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 text-sm font-medium flex items-center justify-between">
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
