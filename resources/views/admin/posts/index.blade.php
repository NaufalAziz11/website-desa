@extends('layouts.admin')

@section('page_title', 'Berita & Informasi Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <form action="{{ route('admin.posts.index') }}" method="GET" class="flex gap-2">
            <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari judul berita/informasi..." class="w-full sm:w-64 rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-sm outline-none focus:border-emerald-600">
            <button type="submit" class="px-4 py-2 rounded-xl border border-slate-300 bg-white text-slate-700 text-sm font-semibold hover:bg-slate-50">Cari</button>
        </form>
        <a href="{{ route('admin.posts.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition text-center">
            + Tambah Informasi
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-600 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-3.5 text-left">Judul</th>
                        <th class="px-6 py-3.5 text-left">Jenis</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-left">Dibaca</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-900">{{ $post->title }}</td>
                            <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">{{ $post->type }}</span></td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $post->is_published ? 'bg-sky-100 text-sky-800' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $post->is_published ? 'Terbit' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $post->views }}x</td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="text-emerald-700 font-semibold hover:underline">Edit</a>
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Hapus informasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-600 font-semibold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada berita atau informasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $posts->links() }}</div>
@endsection
