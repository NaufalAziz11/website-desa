<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $villageProfile?->name ?? 'Portal Resmi Desa')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen" x-data="{ mobileMenu: false }">

    <!-- Top Info Bar (Desktop) -->
    <div class="hidden md:block bg-emerald-950 text-emerald-100 text-xs py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span>{{ $villageProfile?->district ?? 'Kecamatan' }}, {{ $villageProfile?->regency ?? 'Kabupaten' }}</span>
                @if($villageProfile?->office_hours)
                    <span>Jam Layanan: {{ $villageProfile->office_hours }}</span>
                @endif
            </div>
            <div class="flex items-center space-x-4">
                @if($villageProfile?->phone)
                    <span>Telp: {{ $villageProfile->phone }}</span>
                @endif
                @if($villageProfile?->email)
                    <span>{{ $villageProfile->email }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    @if($villageProfile?->logo)
                        <img src="{{ asset('storage/' . $villageProfile->logo) }}" alt="Logo Desa" class="h-10 w-10 rounded-lg object-cover">
                    @else
                        <div class="h-10 w-10 rounded-xl bg-emerald-700 text-white flex items-center justify-center font-bold text-lg shadow-sm group-hover:bg-emerald-800 transition">
                            {{ strtoupper(substr($villageProfile?->name ?? 'D', 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div class="font-bold text-slate-900 text-base md:text-lg leading-tight">{{ $villageProfile?->name ?? 'Desa Sukamaju' }}</div>
                        <div class="text-xs text-emerald-700 font-medium">{{ $villageProfile?->regency ?? 'Portal Resmi Desa' }}</div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    @php
                        $navLinks = [
                            ['route' => 'home', 'label' => 'Beranda', 'pattern' => 'home'],
                            ['route' => 'profile', 'label' => 'Profil Desa', 'pattern' => 'profile'],
                            ['route' => 'potentials.index', 'label' => 'Potensi Desa', 'pattern' => 'potentials.*'],
                            ['route' => 'posts.index', 'label' => 'Informasi & Berita', 'pattern' => 'posts.*'],
                            ['route' => 'transparency.index', 'label' => 'Transparansi APBDes', 'pattern' => 'transparency.*'],
                            ['route' => 'gallery.index', 'label' => 'Galeri', 'pattern' => 'gallery.*'],
                        ];
                    @endphp
                    @foreach($navLinks as $link)
                        <a href="{{ route($link['route']) }}"
                           class="px-3.5 py-2 rounded-lg text-sm font-semibold transition {{ request()->routeIs($link['pattern']) ? 'bg-emerald-50 text-emerald-700' : 'text-slate-600 hover:text-emerald-700 hover:bg-slate-50' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Action + Mobile Button -->
                <div class="flex items-center space-x-3">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-lg bg-emerald-700 text-white text-sm font-semibold hover:bg-emerald-800 transition shadow-sm">
                            Dashboard Admin
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-4 py-2 rounded-lg border border-slate-300 text-slate-700 text-sm font-semibold hover:bg-slate-50 transition">
                            Login Admin
                        </a>
                    @endauth

                    <button @click="mobileMenu = !mobileMenu" type="button" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none" aria-label="Buka Menu">
                        <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileMenu" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div x-show="mobileMenu" x-transition x-cloak class="lg:hidden bg-white border-t border-slate-200 px-4 py-4 space-y-1 shadow-lg">
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="block px-4 py-2.5 rounded-lg text-sm font-semibold {{ request()->routeIs($link['pattern']) ? 'bg-emerald-50 text-emerald-700' : 'text-slate-700 hover:bg-slate-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="pt-3 border-t border-slate-100">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="block w-full text-center px-4 py-2.5 rounded-lg bg-emerald-700 text-white text-sm font-semibold">Dashboard Admin</a>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center px-4 py-2.5 rounded-lg border border-slate-300 text-slate-700 text-sm font-semibold">Login Admin</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="h-10 w-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-lg">
                            {{ strtoupper(substr($villageProfile?->name ?? 'D', 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-white text-lg">{{ $villageProfile?->name ?? 'Desa Sukamaju' }}</div>
                            <div class="text-xs text-emerald-400">{{ $villageProfile?->tagline ?? 'Maju, Mandiri & Transparan' }}</div>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-md">
                        Portal resmi informasi publik, profil wilayah, potensi lokal, dan transparansi anggaran pendapatan dan belanja desa (APBDes).
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('profile') }}" class="hover:text-emerald-400 transition">Profil & Perangkat Desa</a></li>
                        <li><a href="{{ route('potentials.index') }}" class="hover:text-emerald-400 transition">Potensi & UMKM Desa</a></li>
                        <li><a href="{{ route('posts.index') }}" class="hover:text-emerald-400 transition">Berita & Pengumuman</a></li>
                        <li><a href="{{ route('transparency.index') }}" class="hover:text-emerald-400 transition">Transparansi APBDes</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-emerald-400 transition">Galeri Kegiatan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Kontak Kantor Desa</h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li>{{ $villageProfile?->address ?? 'Alamat Kantor Desa' }}</li>
                        @if($villageProfile?->phone)
                            <li>Telp: {{ $villageProfile->phone }}</li>
                        @endif
                        @if($villageProfile?->email)
                            <li>Email: {{ $villageProfile->email }}</li>
                        @endif
                        @if($villageProfile?->office_hours)
                            <li>Jam Kerja: {{ $villageProfile->office_hours }}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-10 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-3">
                <p>&copy; {{ date('Y') }} Pemerintah {{ $villageProfile?->name ?? 'Desa Sukamaju' }}. Seluruh hak cipta dilindungi.</p>
                <p>Transparansi &amp; Pelayanan Publik Digital</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
