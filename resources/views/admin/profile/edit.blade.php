@extends('layouts.admin')

@section('page_title', 'Profil & Statistik Desa')

@section('content')
<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-5xl">
    @csrf
    @method('PUT')

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <h2 class="font-bold text-slate-900 text-base border-b border-slate-100 pb-3">Identitas &amp; Wilayah Desa</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Nama Desa</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tagline / Slogan</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kecamatan</label>
                <input type="text" name="district" value="{{ old('district', $profile->district) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kabupaten / Kota</label>
                <input type="text" name="regency" value="{{ old('regency', $profile->regency) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Provinsi</label>
                <input type="text" name="province" value="{{ old('province', $profile->province) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kode Pos</label>
                <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <x-admin.image-upload name="logo" label="Logo Desa (Opsional)" :current="$profile->logo" />
            <x-admin.image-upload name="hero_image" label="Foto Banner Hero (Opsional)" :current="$profile->hero_image" />
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <h2 class="font-bold text-slate-900 text-base border-b border-slate-100 pb-3">Kepala Desa &amp; Sambutan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Nama Kepala Desa</label>
                <input type="text" name="head_name" value="{{ old('head_name', $profile->head_name) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jabatan</label>
                <input type="text" name="head_title" value="{{ old('head_title', $profile->head_title) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
        <x-admin.image-upload name="head_photo" label="Foto Kepala Desa (Opsional)" :current="$profile->head_photo" />
        <div class="text-sm">
            <label class="block font-semibold text-slate-700 mb-1">Sambutan Kepala Desa</label>
            <textarea name="head_welcome" rows="3" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('head_welcome', $profile->head_welcome) }}</textarea>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <h2 class="font-bold text-slate-900 text-base border-b border-slate-100 pb-3">Visi, Misi &amp; Sejarah</h2>
        <div class="text-sm space-y-4">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Visi</label>
                <textarea name="vision" rows="2" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('vision', $profile->vision) }}</textarea>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Misi (Pisahkan tiap poin dengan baris baru / Enter)</label>
                <textarea name="mission" rows="5" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('mission', $profile->mission) }}</textarea>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Sejarah Desa</label>
                <textarea name="history" rows="5" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('history', $profile->history) }}</textarea>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm space-y-5">
        <h2 class="font-bold text-slate-900 text-base border-b border-slate-100 pb-3">Statistik Demografi &amp; Kontak</h2>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Total Penduduk</label>
                <input type="number" name="population_total" value="{{ old('population_total', $profile->population_total) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kepala Keluarga</label>
                <input type="number" name="families_total" value="{{ old('families_total', $profile->families_total) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Laki-Laki</label>
                <input type="number" name="male_total" value="{{ old('male_total', $profile->male_total) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Perempuan</label>
                <input type="number" name="female_total" value="{{ old('female_total', $profile->female_total) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Luas (km&sup2;)</label>
                <input type="number" step="0.01" name="area_km2" value="{{ old('area_km2', $profile->area_km2) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jumlah Dusun</label>
                <input type="number" name="dusun_count" value="{{ old('dusun_count', $profile->dusun_count) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jumlah RW</label>
                <input type="number" name="rw_count" value="{{ old('rw_count', $profile->rw_count) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jumlah RT</label>
                <input type="number" name="rt_count" value="{{ old('rt_count', $profile->rt_count) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div class="md:col-span-2">
                <label class="block font-semibold text-slate-700 mb-1">Alamat Kantor Desa</label>
                <input type="text" name="address" value="{{ old('address', $profile->address) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Telepon</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Email Resmi</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Jam Pelayanan</label>
                <input type="text" name="office_hours" value="{{ old('office_hours', $profile->office_hours) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Google Maps Embed URL</label>
                <input type="text" name="map_embed_url" value="{{ old('map_embed_url', $profile->map_embed_url) }}" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-6 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold text-sm shadow-sm transition">
            Simpan Perubahan Profil
        </button>
    </div>
</form>
@endsection
