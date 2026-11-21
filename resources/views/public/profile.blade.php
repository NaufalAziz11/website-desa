@extends('layouts.public')

@section('title', 'Profil Desa - ' . ($profile?->name ?? 'Website Desa'))

@section('content')
    <!-- Header Banner -->
    <section class="bg-emerald-950 text-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400">Company Profile</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold mt-1">Profil {{ $profile?->name ?? 'Desa' }}</h1>
            <p class="text-emerald-100/80 mt-2 max-w-2xl text-sm sm:text-base">
                Mengenal sejarah, visi &amp; misi, demografi penduduk, struktur pemerintahan, serta wilayah administrasi desa.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-14">
        <!-- Visi & Misi -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-5 bg-emerald-50 border border-emerald-200 rounded-2xl p-6 sm:p-8">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Visi Desa</span>
                <h2 class="text-xl font-bold text-slate-900 mt-2 mb-3">Arah Pembangunan</h2>
                <p class="text-slate-700 leading-relaxed italic text-base">
                    "{{ $profile?->vision ?? 'Visi desa belum diatur.' }}"
                </p>
            </div>
            <div class="lg:col-span-7 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Misi Desa</span>
                <h2 class="text-xl font-bold text-slate-900 mt-2 mb-4">Langkah Strategis</h2>
                <ul class="space-y-3">
                    @forelse($profile?->mission_list ?? [] as $index => $misi)
                        <li class="flex items-start space-x-3">
                            <span class="flex-shrink-0 h-6 w-6 rounded-full bg-emerald-700 text-white text-xs font-bold flex items-center justify-center mt-0.5">{{ $index + 1 }}</span>
                            <span class="text-slate-700 text-sm sm:text-base leading-relaxed">{{ $misi }}</span>
                        </li>
                    @empty
                        <li class="text-slate-500 text-sm">Misi desa belum diatur.</li>
                    @endforelse
                </ul>
            </div>
        </section>

        <!-- Sejarah Desa -->
        <section class="bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Sejarah Singkat</span>
            <h2 class="text-2xl font-bold text-slate-900 mt-1 mb-4">Asal Usul {{ $profile?->name ?? 'Desa' }}</h2>
            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-line text-sm sm:text-base">
                {{ $profile?->history ?? 'Belum ada catatan sejarah.' }}
            </div>
        </section>

        <!-- Demografi & Wilayah -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Statistik Wilayah</span>
                <h2 class="text-2xl font-bold text-slate-900 mt-1 mb-6">Data Demografi &amp; Administrasi</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500">Total Penduduk</div>
                        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($profile?->population_total ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500">Kepala Keluarga</div>
                        <div class="text-2xl font-extrabold text-slate-900 mt-1">{{ number_format($profile?->families_total ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500">Laki-Laki</div>
                        <div class="text-2xl font-extrabold text-sky-700 mt-1">{{ number_format($profile?->male_total ?? 0, 0, ',', '.') }}</div>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <div class="text-xs text-slate-500">Perempuan</div>
                        <div class="text-2xl font-extrabold text-rose-600 mt-1">{{ number_format($profile?->female_total ?? 0, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="mt-4 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex flex-wrap gap-6 text-sm text-emerald-900 font-medium">
                    <span>Luas: <strong>{{ $profile?->area_km2 ?? 0 }} km&sup2;</strong></span>
                    <span>Dusun: <strong>{{ $profile?->dusun_count ?? 0 }}</strong></span>
                    <span>RW: <strong>{{ $profile?->rw_count ?? 0 }}</strong></span>
                    <span>RT: <strong>{{ $profile?->rt_count ?? 0 }}</strong></span>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <h3 class="text-sm font-bold text-slate-700 mb-3">Komposisi Penduduk Berdasarkan Gender</h3>
                <div class="w-full max-w-xs h-64">
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </section>

        <!-- Perangkat Desa -->
        <section>
            <div class="mb-8">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Struktur Pemerintahan</span>
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">Perangkat Desa</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($officials as $official)
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-start space-x-4">
                        @if($official->photo)
                            <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0">
                        @else
                            <div class="w-16 h-16 rounded-xl bg-emerald-100 text-emerald-800 font-bold text-xl flex items-center justify-center flex-shrink-0">
                                {{ strtoupper(substr($official->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="min-w-0">
                            <h3 class="font-bold text-slate-900 text-base">{{ $official->name }}</h3>
                            <div class="text-xs font-semibold text-emerald-700 mt-0.5">{{ $official->position }}</div>
                            @if($official->bio)
                                <p class="text-xs text-slate-600 mt-2 leading-relaxed">{{ $official->bio }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Peta & Kontak -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 bg-white border border-slate-200 rounded-2xl p-6 sm:p-8 shadow-sm">
            <div class="lg:col-span-5 space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Lokasi &amp; Kontak</span>
                <h2 class="text-2xl font-bold text-slate-900">Kantor Pemerintah Desa</h2>
                <div class="space-y-3 text-sm text-slate-600 pt-2">
                    <p><strong class="text-slate-800 block">Alamat:</strong> {{ $profile?->address }}</p>
                    @if($profile?->phone)
                        <p><strong class="text-slate-800 block">Telepon:</strong> {{ $profile->phone }}</p>
                    @endif
                    @if($profile?->email)
                        <p><strong class="text-slate-800 block">Email:</strong> {{ $profile->email }}</p>
                    @endif
                    @if($profile?->office_hours)
                        <p><strong class="text-slate-800 block">Jam Pelayanan:</strong> {{ $profile->office_hours }}</p>
                    @endif
                </div>
            </div>
            <div class="lg:col-span-7">
                @if($profile?->map_embed_url)
                    <div class="w-full h-72 sm:h-80 rounded-xl overflow-hidden border border-slate-200">
                        <iframe src="{{ $profile->map_embed_url }}" class="w-full h-full border-0" loading="lazy" allowfullscreen></iframe>
                    </div>
                @else
                    <div class="w-full h-72 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500 text-sm">
                        Peta lokasi belum dikonfigurasi.
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('genderChart');
        if (ctx && window.Chart) {
            new window.Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-Laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $profile?->male_total ?? 0 }}, {{ $profile?->female_total ?? 0 }}],
                        backgroundColor: ['#0284c7', '#e11d48'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }
    });
</script>
@endpush
