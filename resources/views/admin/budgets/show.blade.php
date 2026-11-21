@extends('layouts.admin')

@section('page_title', 'Rincian ' . $budgetYear->title)

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.budgets.index') }}" class="text-sm font-semibold text-emerald-700 hover:underline">&larr; Kembali ke Daftar Tahun</a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">
    <!-- Update Info Tahun -->
    <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
        <h2 class="font-bold text-slate-900 mb-4">Pengaturan Tahun {{ $budgetYear->year }}</h2>
        <form action="{{ route('admin.budgets.years.update', $budgetYear) }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-sm">
            @csrf @method('PUT')
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tahun</label>
                <input type="number" name="year" value="{{ old('year', $budgetYear->year) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Judul</label>
                <input type="text" name="title" value="{{ old('title', $budgetYear->title) }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Keterangan</label>
                <textarea name="description" rows="2" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">{{ old('description', $budgetYear->description) }}</textarea>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50/70 p-3.5 space-y-2">
                <div class="flex items-center justify-between">
                    <label class="block font-semibold text-slate-700">Upload PDF APBDes</label>
                    @if($budgetYear->document_pdf)
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">Sudah terisi</span>
                    @else
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-200 text-slate-600">Belum ada PDF</span>
                    @endif
                </div>
                <input type="file" name="document_pdf" accept="application/pdf" class="block w-full text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer">
                @if($budgetYear->document_pdf)
                    <div class="text-xs text-slate-600">
                        File saat ini: <a href="{{ asset('storage/' . $budgetYear->document_pdf) }}" target="_blank" class="font-semibold text-emerald-700 hover:underline">{{ basename($budgetYear->document_pdf) }} (Buka PDF)</a>
                    </div>
                @endif
            </div>
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="is_active" value="1" {{ $budgetYear->is_active ? 'checked' : '' }} class="rounded border-slate-300 text-emerald-700">
                <span>Publikasikan</span>
            </label>
            <button type="submit" class="w-full py-2.5 rounded-xl bg-slate-800 hover:bg-slate-900 text-white font-semibold">Simpan Pengaturan</button>
        </form>
    </div>

    <!-- Tambah Rincian Item -->
    <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
        <h2 class="font-bold text-slate-900 mb-4">Tambah Rincian Anggaran</h2>
        <form action="{{ route('admin.budgets.items.store', $budgetYear) }}" method="POST" class="space-y-3 text-sm">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Jenis</label>
                    <select name="type" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                        <option value="Pendapatan">Pendapatan</option>
                        <option value="Belanja" selected>Belanja</option>
                        <option value="Pembiayaan">Pembiayaan</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Bidang / Kategori</label>
                    <input type="text" name="category" placeholder="Misal: Bidang Pelaksanaan Pembangunan" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                </div>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Uraian Kegiatan / Sumber Dana</label>
                <input type="text" name="description" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Anggaran (Rp)</label>
                    <input type="number" name="budget_amount" min="0" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                </div>
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Realisasi (Rp)</label>
                    <input type="number" name="realized_amount" min="0" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
                </div>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Catatan (Opsional)</label>
                <input type="text" name="notes" class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <button type="submit" class="px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">+ Tambah Rincian</button>
        </form>
    </div>
</div>

<!-- Tabel Rincian -->
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-slate-600 text-xs uppercase font-bold">
                <tr>
                    <th class="px-5 py-3.5 text-left">Jenis</th>
                    <th class="px-5 py-3.5 text-left">Kategori &amp; Uraian</th>
                    <th class="px-5 py-3.5 text-right">Anggaran</th>
                    <th class="px-5 py-3.5 text-right">Realisasi</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($budgetYear->items as $item)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3.5">
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $item->type === 'Pendapatan' ? 'bg-emerald-100 text-emerald-800' : ($item->type === 'Belanja' ? 'bg-amber-100 text-amber-800' : 'bg-sky-100 text-sky-800') }}">
                                {{ $item->type }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="font-bold text-slate-900">{{ $item->category }}</div>
                            <div class="text-xs text-slate-600">{{ $item->description }}</div>
                        </td>
                        <td class="px-5 py-3.5 text-right font-medium">{{ \App\Helpers\FormatHelper::rupiah($item->budget_amount) }}</td>
                        <td class="px-5 py-3.5 text-right font-bold text-emerald-700">{{ \App\Helpers\FormatHelper::rupiah($item->realized_amount) }} ({{ $item->percentage }}%)</td>
                        <td class="px-5 py-3.5 text-right">
                            <form action="{{ route('admin.budgets.items.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-600 text-xs font-semibold hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-5 py-8 text-center text-slate-500">Belum ada rincian anggaran.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
