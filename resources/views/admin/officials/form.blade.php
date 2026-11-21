@extends('layouts.admin')

@section('page_title', $official->exists ? 'Edit Perangkat Desa' : 'Tambah Perangkat Desa')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <form action="{{ $official->exists ? route('admin.officials.update', $official) : route('admin.officials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm">
        @csrf
        @if($official->exists) @method('PUT') @endif

        <div>
            <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $official->name) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jabatan</label>
                <input type="text" name="position" value="{{ old('position', $official->position) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Urutan Tampil</label>
                <input type="number" name="order" value="{{ old('order', $official->order ?? 1) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">NIP (Opsional)</label>
                <input type="text" name="nip" value="{{ old('nip', $official->nip) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">No. HP / Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $official->phone) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Tugas / Bio Singkat</label>
            <textarea name="bio" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('bio', $official->bio) }}</textarea>
        </div>
        <div>
            <label class="block font-semibold text-slate-700 mb-1">Foto (Opsional)</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-xs text-slate-500">
        </div>
        <label class="inline-flex items-center space-x-2">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $official->is_active) ? 'checked' : '' }} class="rounded border-slate-300 text-emerald-700">
            <span class="font-medium text-slate-700">Tampilkan di halaman publik</span>
        </label>

        <div class="pt-4 flex items-center space-x-3">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">Simpan</button>
            <a href="{{ route('admin.officials.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 font-semibold hover:bg-slate-50">Batal</a>
        </div>
    </form>
</div>
@endsection
