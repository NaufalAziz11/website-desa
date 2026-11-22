@extends('layouts.admin')

@section('page_title', 'Pengaturan Akun Admin')

@section('content')
<div class="max-w-2xl bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
    <form action="{{ route('admin.account.update') }}" method="POST" class="space-y-5 text-sm">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold text-slate-700 mb-1">Nama Admin</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
        </div>

        <div>
            <label class="block font-semibold text-slate-700 mb-1">Email Login</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
        </div>

        <div class="pt-4 border-t border-slate-100 space-y-4">
            <div>
                <h2 class="font-bold text-slate-900">Ganti Kata Sandi (Opsional)</h2>
                <p class="text-xs text-slate-500">Kosongkan bagian ini jika tidak ingin mengubah kata sandi.</p>
            </div>

            <div>
                <label class="block font-semibold text-slate-700 mb-1">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Kata Sandi Baru (Min. 8 karakter)</label>
                    <input type="password" name="new_password" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="new_password_confirmation" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                </div>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">
                Simpan Pengaturan Akun
            </button>
        </div>
    </form>
</div>
@endsection
