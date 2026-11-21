@extends('layouts.admin')

@section('page_title', 'Transparansi Keuangan (APBDes)')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- Tambah Tahun Anggaran -->
    <div class="lg:col-span-4 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm self-start">
        <h2 class="font-bold text-slate-900 mb-4">Tambah Tahun Anggaran</h2>
        <form action="{{ route('admin.budgets.years.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-sm">
            @csrf
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Tahun</label>
                <input type="number" name="year" value="{{ date('Y') }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Judul</label>
                <input type="text" name="title" placeholder="APBDes Tahun Anggaran {{ date('Y') }}" required class="w-full rounded-xl border border-slate-300 px-3.5 py-2">
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Keterangan</label>
                <textarea name="description" rows="2" class="w-full rounded-xl border border-slate-300 px-3.5 py-2"></textarea>
            </div>
            <div>
                <label class="block font-semibold text-slate-700 mb-1">Dokumen PDF APBDes (Opsional)</label>
                <input type="file" name="document_pdf" accept="application/pdf" class="w-full text-xs text-slate-500">
            </div>
            <label class="inline-flex items-center space-x-2">
                <input type="checkbox" name="is_active" value="1" checked class="rounded border-slate-300 text-emerald-700">
                <span>Publikasikan</span>
            </label>
            <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-semibold">
                Buat Tahun Anggaran
            </button>
        </form>
    </div>

    <!-- Daftar Tahun Anggaran -->
    <div class="lg:col-span-8 space-y-4">
        @forelse($years as $year)
            @php
                $pendapatan = $year->summaryByType('Pendapatan');
                $belanja = $year->summaryByType('Belanja');
            @endphp
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center space-x-2">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">{{ $year->year }}</span>
                        <span class="text-xs font-semibold {{ $year->is_active ? 'text-emerald-700' : 'text-slate-400' }}">
                            {{ $year->is_active ? 'Publik' : 'Draft' }}
                        </span>
                    </div>
                    <h3 class="font-bold text-slate-900 text-lg mt-1">{{ $year->title }}</h3>
                    <div class="mt-2 flex flex-wrap gap-4 text-xs text-slate-600">
                        <span>Pendapatan: <strong>{{ \App\Helpers\FormatHelper::shortRupiah($pendapatan['budget']) }}</strong></span>
                        <span>Belanja: <strong>{{ \App\Helpers\FormatHelper::shortRupiah($belanja['budget']) }}</strong></span>
                        <span>Item: <strong>{{ $year->items->count() }}</strong></span>
                    </div>
                </div>
                <div class="flex items-center space-x-3 flex-shrink-0">
                    <a href="{{ route('admin.budgets.show', $year) }}" class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-semibold">
                        Kelola Rincian &rarr;
                    </a>
                    <form action="{{ route('admin.budgets.years.destroy', $year) }}" method="POST" onsubmit="return confirm('Hapus seluruh data tahun {{ $year->year }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-3 py-2 rounded-xl border border-rose-200 text-rose-600 text-xs font-semibold hover:bg-rose-50">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-slate-500 text-sm">
                Belum ada tahun anggaran.
            </div>
        @endforelse
    </div>
</div>
@endsection
