@extends('layouts.public')

@section('title', 'Login Admin - ' . ($villageProfile?->name ?? 'Website Desa'))

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg border border-slate-200 p-8">
        <div class="text-center mb-8">
            <div class="inline-flex h-12 w-12 rounded-xl bg-emerald-700 text-white items-center justify-center font-bold text-xl mb-3">
                {{ strtoupper(substr($villageProfile?->name ?? 'D', 0, 1)) }}
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Login Admin Desa</h1>
            <p class="text-sm text-slate-500 mt-1">Masuk untuk mengelola profil, informasi, dan transparansi APBDes</p>
        </div>

        @if($errors->any())
            <div class="mb-5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       placeholder="admin@desasukamaju.id"
                       class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                <input type="password" name="password" required
                       placeholder="••••••••"
                       class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/20 outline-none">
            </div>

            <div class="flex items-center justify-between text-sm">
                <label class="inline-flex items-center space-x-2 text-slate-600">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-emerald-700 focus:ring-emerald-600">
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-700 text-white font-semibold text-sm hover:bg-emerald-800 transition shadow-sm">
                Masuk ke Dashboard
            </button>
        </form>

        @if(app()->environment('local'))
            <div class="mt-6 pt-5 border-t border-slate-100 text-center text-xs text-slate-500">
                Demo akun (Lokal): <span class="font-mono text-slate-700">admin@desasukamaju.id</span> / <span class="font-mono text-slate-700">password</span>
            </div>
        @endif
    </div>
</div>
@endsection
