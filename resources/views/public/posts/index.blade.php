@extends('layouts.public')

@section('title', 'Informasi & Berita Desa - ' . ($villageProfile?->name ?? 'Website Desa'))

@section('content')
    <section class="bg-emerald-950 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Kabar &amp; Agenda</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold mt-1">Informasi &amp; Berita Desa</h1>
            <p class="text-emerald-100/80 mt-2 max-w-2xl text-sm sm:text-base">
                Ikuti perkembangan berita pembangunan, pengumuman resmi pemerintah desa, serta agenda kegiatan masyarakat.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Filter & Search -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('posts.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ !$type ? 'bg-emerald-700 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                    Semua
                </a>
                @foreach(['Berita', 'Pengumuman', 'Agenda'] as $itemType)
                    <a href="{{ route('posts.index', ['jenis' => $itemType]) }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition {{ $type === $itemType ? 'bg-emerald-700 text-white' : 'bg-white border border-slate-200 text-slate-700 hover:bg-slate-50' }}">
                        {{ $itemType }}
                    </a>
                @endforeach
            </div>

            <form action="{{ route('posts.index') }}" method="GET" class="flex gap-2">
                @if($type)
                    <input type="hidden" name="jenis" value="{{ $type }}">
                @endif
                <input type="text" name="q" value="{{ $search }}" placeholder="Cari berita atau pengumuman..." class="w-full sm:w-64 rounded-xl border border-slate-300 px-4 py-2 text-sm focus:border-emerald-600 outline-none">
                <button type="submit" class="px-4 py-2 rounded-xl bg-emerald-700 text-white text-sm font-semibold hover:bg-emerald-800">Cari</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($posts as $post)
                <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md transition flex flex-col">
                    <div class="h-44 bg-slate-100 relative overflow-hidden">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-emerald-50 to-slate-100 flex items-center justify-center text-emerald-700/50 font-bold text-lg">
                                {{ $post->type }}
                            </div>
                        @endif
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-white/95 text-emerald-800 shadow-sm">
                            {{ $post->type }}
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center justify-between text-xs text-slate-400 mb-2">
                            <span>{{ $post->published_at?->translatedFormat('d M Y') }}</span>
                            <span>{{ $post->views }}x dibaca</span>
                        </div>
                        <h2 class="font-bold text-slate-900 text-base leading-snug line-clamp-2">
                            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-emerald-700 transition">{{ $post->title }}</a>
                        </h2>
                        <p class="mt-2 text-sm text-slate-600 line-clamp-3 flex-1">{{ $post->excerpt }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="mt-4 inline-flex items-center text-xs font-bold text-emerald-700 hover:text-emerald-800">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500 bg-white rounded-2xl border border-slate-200">
                    Belum ada informasi atau berita yang sesuai.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
