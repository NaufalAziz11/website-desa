@extends('layouts.admin')

@section('page_title', 'Dashboard Admin')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase">Berita &amp; Informasi</div>
            <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['posts'] }}</div>
            <a href="{{ route('admin.posts.index') }}" class="text-xs font-semibold text-emerald-700 mt-2 inline-block hover:underline">Kelola &rarr;</a>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase">Potensi &amp; UMKM</div>
            <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['potentials'] }}</div>
            <a href="{{ route('admin.potentials.index') }}" class="text-xs font-semibold text-emerald-700 mt-2 inline-block hover:underline">Kelola &rarr;</a>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase">Perangkat Desa</div>
            <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['officials'] }}</div>
            <a href="{{ route('admin.officials.index') }}" class="text-xs font-semibold text-emerald-700 mt-2 inline-block hover:underline">Kelola &rarr;</a>
        </div>
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="text-xs font-semibold text-slate-500 uppercase">Foto Galeri</div>
            <div class="text-3xl font-extrabold text-slate-900 mt-1">{{ $stats['galleries'] }}</div>
            <a href="{{ route('admin.galleries.index') }}" class="text-xs font-semibold text-emerald-700 mt-2 inline-block hover:underline">Kelola &rarr;</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Ringkasan APBDes -->
        <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-900">Ringkasan APBDes {{ $budgetSummary['year'] ?? '' }}</h2>
                <a href="{{ route('admin.budgets.index') }}" class="text-xs font-semibold text-emerald-700 hover:underline">Kelola APBDes &rarr;</a>
            </div>
            @if($budgetSummary)
                <div class="space-y-4 text-sm">
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-100">
                        <div class="text-xs font-semibold text-emerald-800">Pendapatan</div>
                        <div class="text-lg font-extrabold text-slate-900 mt-0.5">{{ \App\Helpers\FormatHelper::rupiah($budgetSummary['pendapatan']['budget']) }}</div>
                        <div class="text-xs text-slate-600 mt-1">Realisasi: {{ \App\Helpers\FormatHelper::rupiah($budgetSummary['pendapatan']['realized']) }} ({{ $budgetSummary['pendapatan']['percentage'] }}%)</div>
                    </div>
                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-100">
                        <div class="text-xs font-semibold text-amber-800">Belanja</div>
                        <div class="text-lg font-extrabold text-slate-900 mt-0.5">{{ \App\Helpers\FormatHelper::rupiah($budgetSummary['belanja']['budget']) }}</div>
                        <div class="text-xs text-slate-600 mt-1">Realisasi: {{ \App\Helpers\FormatHelper::rupiah($budgetSummary['belanja']['realized']) }} ({{ $budgetSummary['belanja']['percentage'] }}%)</div>
                    </div>
                </div>
            @else
                <p class="text-sm text-slate-500">Belum ada tahun anggaran aktif.</p>
            @endif
        </div>

        <!-- Berita Terbaru -->
        <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-slate-900">Informasi &amp; Berita Terbaru</h2>
                <a href="{{ route('admin.posts.create') }}" class="px-3 py-1.5 rounded-lg bg-emerald-700 text-white text-xs font-semibold hover:bg-emerald-800">+ Tambah</a>
            </div>
            <div class="divide-y divide-slate-100 text-sm">
                @forelse($latestPosts as $post)
                    <div class="py-3 flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <div class="font-semibold text-slate-800 truncate">{{ $post->title }}</div>
                            <div class="text-xs text-slate-400">{{ $post->type }} &bull; {{ $post->created_at->diffForHumans() }}</div>
                        </div>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-xs font-semibold text-emerald-700 hover:underline flex-shrink-0">Edit</a>
                    </div>
                @empty
                    <p class="text-slate-500 py-4">Belum ada berita.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
