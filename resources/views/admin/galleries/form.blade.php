@extends('layouts.admin')

@section('page_title', $gallery->exists ? 'Edit Foto Galeri' : 'Unggah Foto Galeri')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <form action="{{ $gallery->exists ? route('admin.galleries.update', $gallery) : route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm">
        @csrf
        @if($gallery->exists) @method('PUT') @endif

        <div>
            <label class="block font-semibold text-slate-700 mb-1">Judul Foto</label>
            <input type="text" name="title" value="{{ old('title', $gallery->title) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                <select name="category" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                    @foreach(['Kegiatan', 'Pembangunan', 'Wisata', 'Budaya'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $gallery->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tanggal Pengambilan</label>
                <input type="date" name="taken_at" value="{{ old('taken_at', $gallery->taken_at?->format('Y-m-d')) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Keterangan (Opsional)</label>
            <textarea name="caption" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('caption', $gallery->caption) }}</textarea>
        </div>
        <x-admin.image-upload name="image" label="File Foto Galeri" :current="$gallery->image" :required="!$gallery->exists" />

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">Simpan</button>
            <a href="{{ route('admin.galleries.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
