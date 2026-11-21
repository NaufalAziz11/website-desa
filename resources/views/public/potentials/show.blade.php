@extends('layouts.public')

@section('title', $potential->title . ' - Potensi Desa')

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('potentials.index') }}" class="inline-flex items-center text-sm font-semibold text-emerald-700 hover:text-emerald-800 mb-6">
            &larr; Kembali ke Potensi Desa
        </a>

        <article class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
            @if($potential->image)
                <img src="{{ asset('storage/' . $potential->image) }}" alt="{{ $potential->title }}" class="w-full h-64 sm:h-96 object-cover">
            @endif
            <div class="p-6 sm:p-10">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    {{ $potential->category }}
                </span>
                <h1 class="text-2xl sm:text-4xl font-extrabold text-slate-900 mt-3">{{ $potential->title }}</h1>

                <div class="mt-4 flex flex-wrap gap-4 text-sm text-slate-500 border-b border-slate-100 pb-6">
                    @if($potential->location)
                        <span><strong>Lokasi:</strong> {{ $potential->location }}</span>
                    @endif
                    @if($potential->contact)
                        <span><strong>Kontak:</strong> {{ $potential->contact }}</span>
                    @endif
                </div>

                <div class="mt-6 text-slate-700 leading-relaxed whitespace-pre-line text-sm sm:text-base">
                    {{ $potential->description }}
                </div>
            </div>
        </article>

        @if($others->isNotEmpty())
            <section class="mt-12">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Potensi Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($others as $item)
                        <a href="{{ route('potentials.show', $item->slug) }}" class="bg-white rounded-2xl border border-slate-200 p-5 hover:shadow-md transition">
                            <span class="text-xs font-semibold text-emerald-700">{{ $item->category }}</span>
                            <h3 class="font-bold text-slate-900 mt-1">{{ $item->title }}</h3>
                            <p class="text-xs text-slate-600 mt-2 line-clamp-2">{{ $item->summary }}</p>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
