@extends('layouts.admin')

@section('page_title', 'Perangkat Desa')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <p class="text-sm text-slate-600">Kelola daftar perangkat desa dan struktur organisasi.</p>
        <a href="{{ route('admin.officials.create') }}" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition">
            + Tambah Perangkat
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-slate-600 text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-3.5 text-left">Urutan</th>
                        <th class="px-6 py-3.5 text-left">Nama</th>
                        <th class="px-6 py-3.5 text-left">Jabatan</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($officials as $official)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-semibold">{{ $official->order }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    @if($official->photo)
                                        <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}" class="w-9 h-9 rounded-lg object-cover flex-shrink-0">
                                    @else
                                        <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-800 font-bold text-xs flex items-center justify-center flex-shrink-0">
                                            {{ strtoupper(substr($official->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-bold text-slate-900">{{ $official->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $official->position }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $official->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $official->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-3 whitespace-nowrap">
                                <a href="{{ route('admin.officials.edit', $official) }}" class="text-emerald-700 font-semibold hover:underline">Edit</a>
                                <form action="{{ route('admin.officials.destroy', $official) }}" method="POST" class="inline" onsubmit="return confirm('Hapus perangkat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-600 font-semibold hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada data perangkat desa.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">{{ $officials->links() }}</div>
@endsection
