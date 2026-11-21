@extends('layouts.admin')

@section('page_title', $post->exists ? 'Edit Informasi / Berita' : 'Tambah Informasi / Berita')

@section('content')
<div class="max-w-3xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <form action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm">
        @csrf
        @if($post->exists) @method('PUT') @endif

        <div>
            <label class="block font-semibold text-slate-700 mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jenis Informasi</label>
                <select name="type" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                    @foreach(['Berita', 'Pengumuman', 'Agenda'] as $type)
                        <option value="{{ $type }}" {{ old('type', $post->type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tanggal Acara (Khusus Agenda)</label>
                <input type="date" name="event_date" value="{{ old('event_date', $post->event_date?->format('Y-m-d')) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Ringkasan (Excerpt)</label>
            <textarea name="excerpt" rows="2" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Isi Lengkap</label>
            <textarea name="content" rows="7" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('content', $post->content) }}</textarea>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Gambar Sampul (Opsional)</label>
            <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500">
        </div>
        <label class="inline-flex items-center space-x-2">
            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $post->is_published) ? 'checked' : '' }} class="rounded border-slate-300 text-emerald-700">
            <span class="font-medium text-slate-700">Publikasikan langsung ke website</span>
        </label>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">Simpan</button>
            <a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
