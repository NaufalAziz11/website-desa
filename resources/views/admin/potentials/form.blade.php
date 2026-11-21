@extends('layouts.admin')

@section('page_title', $potential->exists ? 'Edit Potensi Desa' : 'Tambah Potensi Desa')

@section('content')
<div class="max-w-3xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <form action="{{ $potential->exists ? route('admin.potentials.update', $potential) : route('admin.potentials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm">
        @csrf
        @if($potential->exists) @method('PUT') @endif

        <div>
            <label class="block font-semibold text-slate-700 mb-1">Judul Potensi</label>
            <input type="text" name="title" value="{{ old('title', $potential->title) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kategori</label>
                <select name="category" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                    @foreach(['Wisata', 'UMKM', 'Pertanian', 'Budaya', 'Pendidikan & Kesehatan'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $potential->category) === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Lokasi</label>
                <input type="text" name="location" value="{{ old('location', $potential->location) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Ringkasan Singkat</label>
            <textarea name="summary" rows="2" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('summary', $potential->summary) }}</textarea>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Deskripsi Lengkap</label>
            <textarea name="description" rows="6" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('description', $potential->description) }}</textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kontak Pengelola (Opsional)</label>
                <input type="text" name="contact" value="{{ old('contact', $potential->contact) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Gambar (Opsional)</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs text-slate-500">
            </div>
        </div>
        <label class="inline-flex items-center space-x-2">
            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $potential->is_featured) ? 'checked' : '' }} class="rounded border-slate-300 text-emerald-700">
            <span class="font-medium text-slate-700">Tampilkan sebagai potensi unggulan di Beranda</span>
        </label>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">Simpan</button>
            <a href="{{ route('admin.potentials.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
