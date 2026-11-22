@extends('layouts.public')

@section('title', ($villageProfile?->name ?? 'Desa Sukamaju') . ' - Portal Resmi Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-emerald-950 text-white overflow-hidden">
        @if($villageProfile?->hero_image)
            <img src="{{ asset('storage/' . $villageProfile->hero_image) }}" alt="{{ $villageProfile->name }}" class="absolute inset-0 w-full h-full object-cover opacity-30">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-emerald-950 to-slate-900 opacity-95"></div>
        @endif
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-28">
            <div class="max-w-3xl">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/20 text-emerald-200 border border-emerald-400/30 mb-5">
                    Portal Resmi {{ $villageProfile?->district ?? 'Kecamatan Sukasari' }}, {{ $villageProfile?->regency ?? 'Kabupaten Bandung' }}
                </span>
                <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                    Selamat Datang di {{ $villageProfile?->name ?? 'Desa Sukamaju' }}
                </h1>
                <p class="mt-4 text-base sm:text-lg text-emerald-100/90 leading-relaxed">
                    {{ $villageProfile?->tagline ?? 'Maju, Mandiri, Sejahtera & Transparan' }}. Temukan informasi profil wilayah, potensi unggulan desa, berita terbaru, serta transparansi pengelolaan APBDes secara terbuka.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('transparency.index') }}" class="px-6 py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-sm transition shadow-lg shadow-emerald-950/30">
                        Transparansi APBDes
                    </a>
                    <a href="{{ route('profile') }}" class="px-6 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold text-sm transition">
                        Profil Desa
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistik Ringkas -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Penduduk</div>
                <div class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($villageProfile?->population_total ?? 0, 0, ',', '.') }}</div>
                <div class="text-xs text-emerald-700 mt-1 font-medium">Jiwa</div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kepala Keluarga</div>
                <div class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900">{{ number_format($villageProfile?->families_total ?? 0, 0, ',', '.') }}</div>
                <div class="text-xs text-emerald-700 mt-1 font-medium">KK Terdaftar</div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Luas Wilayah</div>
                <div class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $villageProfile?->area_km2 ?? 0 }}</div>
                <div class="text-xs text-emerald-700 mt-1 font-medium">km&sup2;</div>
            </div>
            <div class="bg-white rounded-2xl p-5 shadow-md border border-slate-100">
                <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Wilayah Administrasi</div>
                <div class="mt-1 text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $villageProfile?->dusun_count ?? 0 }} Dusun</div>
                <div class="text-xs text-emerald-700 mt-1 font-medium">{{ $villageProfile?->rw_count ?? 0 }} RW &bull; {{ $villageProfile?->rt_count ?? 0 }} RT</div>
            </div>
        </div>
    </section>

    <!-- Sambutan Kepala Desa -->
    @if($villageProfile)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-4 flex justify-center">
                @if($villageProfile->head_photo)
                    <img src="{{ asset('storage/' . $villageProfile->head_photo) }}" alt="{{ $villageProfile->head_name }}" class="w-48 h-48 sm:w-56 sm:h-56 rounded-2xl object-cover shadow-md">
                @else
                    <div class="w-48 h-48 sm:w-56 sm:h-56 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-200 text-emerald-800 flex flex-col items-center justify-center font-bold shadow-inner">
                        <span class="text-5xl">{{ strtoupper(substr($villageProfile->head_name, 0, 1)) }}</span>
                        <span class="text-xs mt-2 font-medium text-emerald-700">{{ $villageProfile->head_title }}</span>
                    </div>
                @endif
            </div>
            <div class="lg:col-span-8 min-w-0">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Sambutan Kepala Desa</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">{{ $villageProfile->head_name }}</h2>
                <p class="text-sm text-slate-500 mb-4">{{ $villageProfile->head_title }}</p>
                <p class="text-slate-600 leading-relaxed text-sm sm:text-base break-words">{{ $villageProfile->head_welcome }}</p>
                <div class="mt-6">
                    <a href="{{ route('profile') }}" class="inline-flex items-center text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                        Baca Profil &amp; Visi Misi Desa &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Ringkasan Transparansi APBDes -->
    @if($budgetSummary)
    <section class="bg-emerald-950 text-white py-14 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Transparansi Keuangan Desa</span>
                    <h2 class="text-2xl sm:text-3xl font-bold mt-1">{{ $budgetSummary['title'] }}</h2>
                </div>
                <a href="{{ route('transparency.index') }}" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-sm transition self-start sm:self-auto">
                    Lihat Rincian &amp; Grafik &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Pendapatan -->
                <div class="bg-white/10 backdrop-blur border border-white/10 rounded-2xl p-6">
                    <div class="text-xs uppercase tracking-wider text-emerald-300 font-semibold">Pendapatan Desa</div>
                    <div class="mt-2 text-2xl font-extrabold">{{ \App\Helpers\FormatHelper::rupiah($budgetSummary['pendapatan']['budget']) }}</div>
                    <div class="mt-3 text-xs text-emerald-100/80 flex justify-between">
                        <span>Realisasi: {{ \App\Helpers\FormatHelper::rupiah($budgetSummary['pendapatan']['realized']) }}</span>
                        <span class="font-bold text-emerald-300">{{ $budgetSummary['pendapatan']['percentage'] }}%</span>
                    </div>
                    <div class="mt-2 w-full bg-white/10 rounded-full h-2">
                        <div class="bg-emerald-400 h-2 rounded-full" style="width: {{ min(100, $budgetSummary['pendapatan']['percentage']) }}%"></div>
                    </div>
                </div>

                <!-- Belanja -->
                <div class="bg-white/10 backdrop-blur border border-white/10 rounded-2xl p-6">
                    <div class="text-xs uppercase tracking-wider text-amber-300 font-semibold">Belanja Desa</div>
                    <div class="mt-2 text-2xl font-extrabold">{{ \App\Helpers\FormatHelper::rupiah($budgetSummary['belanja']['budget']) }}</div>
                    <div class="mt-3 text-xs text-emerald-100/80 flex justify-between">
                        <span>Realisasi: {{ \App\Helpers\FormatHelper::rupiah($budgetSummary['belanja']['realized']) }}</span>
                        <span class="font-bold text-amber-300">{{ $budgetSummary['belanja']['percentage'] }}%</span>
                    </div>
                    <div class="mt-2 w-full bg-white/10 rounded-full h-2">
                        <div class="bg-amber-400 h-2 rounded-full" style="width: {{ min(100, $budgetSummary['belanja']['percentage']) }}%"></div>
                    </div>
                </div>

                <!-- Pembiayaan -->
                <div class="bg-white/10 backdrop-blur border border-white/10 rounded-2xl p-6">
                    <div class="text-xs uppercase tracking-wider text-sky-300 font-semibold">Pembiayaan Desa</div>
                    <div class="mt-2 text-2xl font-extrabold">{{ \App\Helpers\FormatHelper::rupiah($budgetSummary['pembiayaan']['budget']) }}</div>
                    <div class="mt-3 text-xs text-emerald-100/80 flex justify-between">
                        <span>Realisasi: {{ \App\Helpers\FormatHelper::rupiah($budgetSummary['pembiayaan']['realized']) }}</span>
                        <span class="font-bold text-sky-300">{{ $budgetSummary['pembiayaan']['percentage'] }}%</span>
                    </div>
                    <div class="mt-2 w-full bg-white/10 rounded-full h-2">
                        <div class="bg-sky-400 h-2 rounded-full" style="width: {{ min(100, $budgetSummary['pembiayaan']['percentage']) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Berita & Informasi Terbaru -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Kabar &amp; Pengumuman</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Informasi Terbaru Desa</h2>
            </div>
            <a href="{{ route('posts.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                Semua Informasi &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-slate-100 overflow-hidden relative">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-emerald-50 to-slate-100 flex items-center justify-center text-emerald-700/40 font-bold text-xl">
                                {{ $post->type }}
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-emerald-800 shadow-sm">
                            {{ $post->type }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="text-xs text-slate-400 mb-2">{{ $post->published_at?->translatedFormat('d M Y') }}</div>
                        <h3 class="font-bold text-slate-900 text-base leading-snug line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-emerald-700 transition">{{ $post->title }}</a>
                        </h3>
                        <p class="mt-2 text-sm text-slate-600 line-clamp-3 flex-1">{{ $post->excerpt }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="mt-4 inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>
            @empty
                <p class="col-span-3 text-center text-slate-500 py-8">Belum ada informasi atau berita yang dipublikasikan.</p>
            @endforelse
        </div>
    </section>

    <!-- Potensi Desa Unggulan -->
    <section class="bg-slate-100 py-14 sm:py-16 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Ekonomi &amp; Wisata</span>
                    <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Potensi Unggulan Desa</h2>
                </div>
                <a href="{{ route('potentials.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                    Jelajahi Semua Potensi &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($potentials as $item)
                    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                        <div class="h-44 bg-slate-100 overflow-hidden relative">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-50 flex items-center justify-center text-emerald-700 font-bold text-lg">
                                    {{ $item->category }}
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-700 text-white">
                                {{ $item->category }}
                            </span>
                        </div>
                        <div class="p-5 flex-1 flex flex-col">
                            <h3 class="font-bold text-slate-900 text-base">
                                <a href="{{ route('potentials.show', $item->slug) }}" class="hover:text-emerald-700 transition">{{ $item->title }}</a>
                            </h3>
                            <p class="mt-2 text-sm text-slate-600 line-clamp-3 flex-1">{{ $item->summary }}</p>
                            <a href="{{ route('potentials.show', $item->slug) }}" class="mt-4 inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800">
                                Lihat Detail &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
