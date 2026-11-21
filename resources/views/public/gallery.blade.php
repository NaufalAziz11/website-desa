@extends('layouts.public')

@section('title', 'Galeri Desa - ' . ($villageProfile?->name ?? 'Website Desa'))

@section('content')
    <section class="bg-emerald-950 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Dokumentasi</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold mt-1">Galeri Kegiatan &amp; Wilayah</h1>
            <p class="text-emerald-100/80 mt-2 max-w-2xl text-sm sm:text-base">
                Dokumentasi visual kegiatan masyarakat, pembangunan desa, dan keindahan wilayah.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ activeImage: null, activeTitle: '', activeCaption: '' }">
        <!-- Filter -->
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="{{ route('gallery.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ !$category ? 'bg-emerald-700 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                Semua
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('gallery.index', ['kategori' => $cat]) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ $category === $cat ? 'bg-emerald-700 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galleries as $item)
                <div @click="activeImage = '{{ asset('storage/' . $item->image) }}'; activeTitle = @js($item->title); activeCaption = @js($item->caption ?? '')"
                     class="group cursor-pointer bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition">
                    <div class="h-56 bg-slate-100 overflow-hidden relative">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 text-slate-800">
                            {{ $item->category }}
                        </span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-slate-900 text-sm">{{ $item->title }}</h3>
                        @if($item->caption)
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $item->caption }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500 bg-white rounded-2xl border border-slate-200">
                    Belum ada foto galeri yang diunggah. Anda dapat mengunggahnya melalui Dashboard Admin.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $galleries->links() }}
        </div>

        <!-- Lightbox Modal -->
        <div x-show="activeImage" x-cloak @click.self="activeImage = null" class="fixed inset-0 z-50 bg-slate-950/80 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-3xl w-full overflow-hidden shadow-2xl">
                <img :src="activeImage" :alt="activeTitle" class="w-full max-h-[70vh] object-contain bg-slate-900">
                <div class="p-5 flex justify-between items-start gap-4">
                    <div>
                        <h3 class="font-bold text-slate-900" x-text="activeTitle"></h3>
                        <p class="text-sm text-slate-600 mt-1" x-text="activeCaption"></p>
                    </div>
                    <button @click="activeImage = null" class="px-3 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-xs font-semibold text-slate-700">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
