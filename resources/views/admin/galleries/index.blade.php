@extends('layouts.admin')

@section('page_title', 'Galeri Foto Desa')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-sm text-slate-600">Kelola dokumentasi foto kegiatan dan pembangunan desa.</p>
        <a href="{{ route('admin.galleries.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition">
            + Unggah Foto
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($galleries as $item)
            <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-full h-44 object-cover">
                <div class="p-4">
                    <span class="text-xs font-semibold text-emerald-700">{{ $item->category }}</span>
                    <h3 class="font-bold text-slate-900 mt-0.5">{{ $item->title }}</h3>
                    <div class="mt-4 flex justify-between items-center text-xs">
                        <a href="{{ route('admin.galleries.edit', $item) }}" class="text-emerald-700 font-semibold hover:underline">Edit</a>
                        <form action="{{ route('admin.galleries.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus foto ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-rose-600 font-semibold hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500 text-sm">
                Belum ada foto galeri. Klik "+ Unggah Foto" untuk menambahkan.
            </div>
        @endforelse
    </div>

    <div class="mt-6">{{ $galleries->links() }}</div>
@endsection
