@extends('layouts.public')

@section('title', 'Transparansi Keuangan APBDes - ' . ($villageProfile?->name ?? 'Website Desa'))

@section('content')
    <section class="bg-emerald-950 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Akuntabilitas Publik</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold mt-1">Transparansi Keuangan Desa (APBDes)</h1>
                <p class="text-emerald-100/80 mt-2 max-w-2xl text-sm sm:text-base">
                    Keterbukaan informasi anggaran pendapatan, belanja, dan pembiayaan desa beserta realisasinya untuk masyarakat.
                </p>
            </div>

            @if($years->isNotEmpty())
                <form action="{{ route('transparency.index') }}" method="GET" class="flex items-center space-x-2">
                    <label for="tahun" class="text-xs font-semibold text-emerald-200">Tahun Anggaran:</label>
                    <select name="tahun" id="tahun" onchange="this.form.submit()" class="rounded-xl bg-white text-slate-900 px-4 py-2 text-sm font-bold outline-none">
                        @foreach($years as $y)
                            <option value="{{ $y->year }}" {{ $selectedYear?->id === $y->id ? 'selected' : '' }}>{{ $y->year }}</option>
                        @endforeach
                    </select>
                </form>
            @endif
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10" x-data="{ activeTab: 'Belanja' }">
        @if($selectedYear && $summary)
            <!-- Header Tahun & Unduh PDF -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">{{ $selectedYear->title }}</h2>
                    @if($selectedYear->description)
                        <p class="text-sm text-slate-600 mt-1">{{ $selectedYear->description }}</p>
                    @endif
                </div>
                @if($selectedYear->document_pdf)
                    <a href="{{ asset('storage/' . $selectedYear->document_pdf) }}" target="_blank" class="inline-flex items-center px-5 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-sm font-semibold transition flex-shrink-0">
                        Unduh Dokumen PDF
                    </a>
                @endif
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <div class="text-xs font-bold uppercase text-emerald-700">Total Pendapatan</div>
                    <div class="text-xl font-extrabold text-slate-900 mt-2">{{ \App\Helpers\FormatHelper::rupiah($summary['pendapatan']['budget']) }}</div>
                    <div class="text-xs text-slate-500 mt-2">Realisasi: <strong class="text-slate-800">{{ \App\Helpers\FormatHelper::rupiah($summary['pendapatan']['realized']) }}</strong> ({{ $summary['pendapatan']['percentage'] }}%)</div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <div class="text-xs font-bold uppercase text-amber-600">Total Belanja</div>
                    <div class="text-xl font-extrabold text-slate-900 mt-2">{{ \App\Helpers\FormatHelper::rupiah($summary['belanja']['budget']) }}</div>
                    <div class="text-xs text-slate-500 mt-2">Realisasi: <strong class="text-slate-800">{{ \App\Helpers\FormatHelper::rupiah($summary['belanja']['realized']) }}</strong> ({{ $summary['belanja']['percentage'] }}%)</div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <div class="text-xs font-bold uppercase text-sky-600">Total Pembiayaan</div>
                    <div class="text-xl font-extrabold text-slate-900 mt-2">{{ \App\Helpers\FormatHelper::rupiah($summary['pembiayaan']['budget']) }}</div>
                    <div class="text-xs text-slate-500 mt-2">Realisasi: <strong class="text-slate-800">{{ \App\Helpers\FormatHelper::rupiah($summary['pembiayaan']['realized']) }}</strong> ({{ $summary['pembiayaan']['percentage'] }}%)</div>
                </div>

                <div class="bg-emerald-950 text-white rounded-2xl p-6 shadow-sm">
                    <div class="text-xs font-bold uppercase text-emerald-300">Selisih Realisasi (SILPA)</div>
                    <div class="text-xl font-extrabold mt-2">{{ \App\Helpers\FormatHelper::rupiah($summary['silpa']) }}</div>
                    <div class="text-xs text-emerald-200/80 mt-2">Pendapatan dikurangi Belanja</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-7 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 text-base mb-4">Perbandingan Anggaran vs Realisasi Belanja</h3>
                    <div class="h-72">
                        <canvas id="belanjaBarChart"></canvas>
                    </div>
                </div>
                <div class="lg:col-span-5 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 text-base mb-4">Sumber Pendapatan Desa (Realisasi)</h3>
                    <div class="h-72">
                        <canvas id="pendapatanPieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Rincian Tabel Interaktif dengan Pencarian, Filter & Pagination -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="border-b border-slate-200 px-6 pt-4 flex flex-wrap gap-2">
                    @foreach(['Belanja' => $belanjaItems, 'Pendapatan' => $pendapatanItems, 'Pembiayaan' => $pembiayaanItems] as $tab => $tabItems)
                        <button @click="activeTab = '{{ $tab }}'"
                                :class="activeTab === '{{ $tab }}' ? 'border-emerald-700 text-emerald-700 bg-emerald-50/50' : 'border-transparent text-slate-500 hover:text-slate-800'"
                                class="px-4 py-3 text-sm font-bold border-b-2 transition rounded-t-lg inline-flex items-center space-x-2">
                            <span>Rincian {{ $tab }}</span>
                            <span class="px-2 py-0.5 rounded-full text-xs bg-slate-100 text-slate-600">{{ $tabItems->count() }}</span>
                        </button>
                    @endforeach
                </div>

                @foreach(['Belanja' => $belanjaItems, 'Pendapatan' => $pendapatanItems, 'Pembiayaan' => $pembiayaanItems] as $tabName => $items)
                    @php
                        $mappedItems = $items->map(fn ($item) => [
                            'category' => $item->category,
                            'description' => $item->description,
                            'notes' => $item->notes,
                            'budget_formatted' => \App\Helpers\FormatHelper::rupiah($item->budget_amount),
                            'realized_formatted' => \App\Helpers\FormatHelper::rupiah($item->realized_amount),
                            'percentage' => $item->percentage,
                        ])->values();
                        $uniqueCategories = $items->pluck('category')->unique()->values();
                    @endphp
                    <div x-show="activeTab === '{{ $tabName }}'"
                         x-data="{
                             items: @js($mappedItems),
                             search: '',
                             categoryFilter: '',
                             page: 1,
                             perPage: 10,
                             get filtered() {
                                 const q = this.search.toLowerCase();
                                 return this.items.filter(i => {
                                     const matchCat = !this.categoryFilter || i.category === this.categoryFilter;
                                     const matchText = !q || i.category.toLowerCase().includes(q) || i.description.toLowerCase().includes(q) || (i.notes && i.notes.toLowerCase().includes(q));
                                     return matchCat && matchText;
                                 });
                             },
                             get totalPages() {
                                 return Math.max(1, Math.ceil(this.filtered.length / this.perPage));
                             },
                             get paginated() {
                                 if (this.page > this.totalPages) this.page = 1;
                                 const start = (this.page - 1) * this.perPage;
                                 return this.filtered.slice(start, start + this.perPage);
                             }
                         }">

                        <!-- Filter & Search Bar -->
                        <div class="p-4 sm:px-6 bg-slate-50/70 border-b border-slate-100 flex flex-col sm:flex-row gap-3 justify-between items-stretch sm:items-center">
                            <div class="flex flex-col sm:flex-row gap-2.5 flex-1">
                                <input type="text" x-model="search" @input="page = 1" placeholder="Cari uraian / bidang {{ strtolower($tabName) }}..."
                                       class="w-full sm:w-64 rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-xs sm:text-sm outline-none focus:border-emerald-600">
                                <select x-model="categoryFilter" @change="page = 1"
                                        class="w-full sm:w-60 rounded-xl border border-slate-300 bg-white px-3.5 py-2 text-xs sm:text-sm outline-none focus:border-emerald-600">
                                    <option value="">Semua Bidang / Kategori</option>
                                    @foreach($uniqueCategories as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-xs text-slate-500">
                                Menampilkan <strong x-text="paginated.length"></strong> dari <strong x-text="filtered.length"></strong> data
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-slate-200 text-sm">
                                <thead class="bg-slate-50 text-slate-600 text-xs uppercase font-bold">
                                    <tr>
                                        <th class="px-6 py-3.5 text-left">Bidang / Kategori</th>
                                        <th class="px-6 py-3.5 text-left">Uraian</th>
                                        <th class="px-6 py-3.5 text-right">Anggaran</th>
                                        <th class="px-6 py-3.5 text-right">Realisasi</th>
                                        <th class="px-6 py-3.5 text-center w-36">Serapan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    <template x-for="(item, idx) in paginated" :key="idx">
                                        <tr class="hover:bg-slate-50/70">
                                            <td class="px-6 py-4 font-semibold text-slate-900" x-text="item.category"></td>
                                            <td class="px-6 py-4 text-slate-600">
                                                <div x-text="item.description"></div>
                                                <div class="text-xs text-slate-400 mt-0.5" x-show="item.notes" x-text="item.notes"></div>
                                            </td>
                                            <td class="px-6 py-4 text-right font-medium text-slate-800 whitespace-nowrap" x-text="item.budget_formatted"></td>
                                            <td class="px-6 py-4 text-right font-bold text-emerald-700 whitespace-nowrap" x-text="item.realized_formatted"></td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-2">
                                                    <div class="flex-1 bg-slate-200 rounded-full h-2">
                                                        <div class="bg-emerald-600 h-2 rounded-full" :style="'width: ' + item.percentage + '%'"></div>
                                                    </div>
                                                    <span class="text-xs font-bold text-slate-700 w-10 text-right" x-text="item.percentage + '%'"></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="paginated.length === 0">
                                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">Tidak ada rincian {{ strtolower($tabName) }} yang sesuai.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Controls -->
                        <div x-show="totalPages > 1" class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs">
                            <span class="text-slate-500">Halaman <strong x-text="page"></strong> dari <strong x-text="totalPages"></strong></span>
                            <div class="flex space-x-2">
                                <button @click="if (page > 1) page--" :disabled="page <= 1"
                                        class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white font-semibold text-slate-700 disabled:opacity-40 hover:bg-slate-50">
                                    &larr; Sebelumnya
                                </button>
                                <button @click="if (page < totalPages) page++" :disabled="page >= totalPages"
                                        class="px-3 py-1.5 rounded-lg border border-slate-300 bg-white font-semibold text-slate-700 disabled:opacity-40 hover:bg-slate-50">
                                    Berikutnya &rarr;
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 p-12 text-center text-slate-500">
                Belum ada data transparansi keuangan APBDes yang dipublikasikan.
            </div>
        @endif
    </div>
@endsection

@if($chartData)
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (!window.Chart) return;

        const barCtx = document.getElementById('belanjaBarChart');
        if (barCtx) {
            new window.Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: @json($chartData['belanjaLabels']),
                    datasets: [
                        {
                            label: 'Anggaran',
                            data: @json($chartData['belanjaBudgets']),
                            backgroundColor: '#94a3b8',
                            borderRadius: 6
                        },
                        {
                            label: 'Realisasi',
                            data: @json($chartData['belanjaRealized']),
                            backgroundColor: '#059669',
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } },
                    scales: {
                        y: {
                            ticks: {
                                callback: (val) => 'Rp ' + (val / 1000000).toFixed(0) + ' Jt'
                            }
                        }
                    }
                }
            });
        }

        const pieCtx = document.getElementById('pendapatanPieChart');
        if (pieCtx) {
            new window.Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: @json($chartData['pendapatanLabels']),
                    datasets: [{
                        data: @json($chartData['pendapatanRealized']),
                        backgroundColor: ['#059669', '#0284c7', '#d97706', '#7c3aed', '#e11d48'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }
    });
</script>
@endpush
@endif
