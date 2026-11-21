@extends('layouts.public')

@section('title', 'Potensi Desa - ' . ($villageProfile?->name ?? 'Website Desa'))

@section('content')
    <section class="bg-emerald-950 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Ekonomi, Wisata &amp; Budaya</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold mt-1">Potensi Unggulan Desa</h1>
            <p class="text-emerald-100/80 mt-2 max-w-2xl text-sm sm:text-base">
                Jelajahi berbagai sektor unggulan mulai dari destinasi wisata alam, UMKM lokal, pertanian organik, hingga pelestarian budaya.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Filter & Search -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('potentials.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ !$category ? 'bg-emerald-700 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('potentials.index', ['kategori' => $cat]) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ $category === $cat ? 'bg-emerald-700 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>

            <form action="{{ route('potentials.index') }}" method="GET" class="flex gap-2">
                @if($category)
                    <input type="hidden" name="kategori" value="{{ $category }}">
                @endif
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari potensi desa..." class="w-full sm:w-64 rounded-xl border border-slate-300 px-4 py-2 text-sm focus:border-emerald-600 outline-none">
                <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-700 text-white text-sm font-semibold hover:bg-emerald-800">Cari</button>
            </form>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($potentials as $item)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <div class="h-48 bg-slate-100 relative overflow-hidden">
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
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="font-bold text-slate-900 text-lg leading-snug">
                            <a href="{{ route('potentials.show', $item->slug) }}" class="hover:text-emerald-700 transition">{{ $item->title }}</a>
                        </h2>
                        <p class="mt-2 text-sm text-slate-600 line-clamp-3 flex-1">{{ $item->summary }}</p>
                        @if($item->location)
                            <div class="mt-4 text-xs text-slate-500">Lokasi: {{ $item->location }}</div>
                        @endif
                        <a href="{{ route('potentials.show', $item->slug) }}" class="mt-4 inline-flex items-center text-sm font-semibold text-emerald-700 hover:text-emerald-800">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500 bg-white rounded-2xl border border-slate-200">
                    Tidak ada data potensi desa yang ditemukan.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $potentials->links() }}
        </div>
    </div>
@endsection
