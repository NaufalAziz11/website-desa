@extends('layouts.public')

@section('title', $post->title . ' - Informasi Desa')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-700 hover:text-emerald-800 mb-6">
            &larr; Kembali ke Informasi &amp; Berita
        </a>

        <article class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-64 sm:h-96 object-cover">
            @endif
            <div class="p-6 sm:p-10">
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500 mb-3">
                    <span class="px-3 py-1 rounded-full font-semibold bg-emerald-100 text-emerald-800">{{ $post->type }}</span>
                    <span>Dipublikasikan {{ $post->published_at?->translatedFormat('d F Y') }}</span>
                    <span>&bull; {{ $post->views }}x dibaca</span>
                    @if($post->event_date)
                        <span class="px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 font-semibold">
                            Tanggal Acara: {{ $post->event_date->translatedFormat('d F Y') }}
                        </span>
                    @endif
                </div>

                <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $post->title }}</h1>

                <div class="mt-6 pt-6 border-t border-slate-100 text-slate-700 leading-relaxed whitespace-pre-line text-sm sm:text-base">
                    {{ $post->content }}
                </div>
            </div>
        </article>

        @if($related->isNotEmpty())
            <section class="mt-12">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Informasi Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($related as $item)
                        <a href="{{ route('posts.show', $item->slug) }}" class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md transition">
                            <span class="text-xs font-semibold text-emerald-700">{{ $item->type }}</span>
                            <h3 class="font-bold text-slate-900 mt-1 line-clamp-2">{{ $item->title }}</h3>
                            <div class="text-xs text-slate-400 mt-2">{{ $item->published_at?->translatedFormat('d M Y') }}</div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
