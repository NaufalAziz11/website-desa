@props([
    'name',
    'label',
    'current' => null,
    'required' => false,
    'hint' => null,
])

@php
    $currentUrl = $current ? asset('storage/' . $current) : null;
@endphp

<div x-data="{ preview: @js($currentUrl), selectedName: '' }" class="rounded-xl border border-slate-200 bg-slate-50/70 p-4 space-y-3">
    <div class="flex flex-wrap items-center justify-between gap-2">
        <label class="block font-semibold text-slate-700 text-sm">{{ $label }}</label>
        @if($currentUrl)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                Sudah terisi
            </span>
        @else
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-200 text-slate-600">
                Belum ada gambar
            </span>
        @endif
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
        <template x-if="preview">
            <div class="relative w-32 h-24 rounded-lg overflow-hidden border border-slate-200 bg-white flex-shrink-0 shadow-sm">
                <img :src="preview" alt="{{ $label }}" class="w-full h-full object-cover">
            </div>
        </template>
        <template x-if="!preview">
            <div class="w-32 h-24 rounded-lg border border-dashed border-slate-300 bg-white flex items-center justify-center text-xs text-slate-400 flex-shrink-0">
                Tidak ada foto
            </div>
        </template>

        <div class="flex-1 min-w-0 space-y-1.5">
            <input type="file"
                   name="{{ $name }}"
                   accept="image/*"
                   {{ $required ? 'required' : '' }}
                   @change="
                       const file = $event.target.files[0];
                       if (file) {
                           selectedName = file.name;
                           const reader = new FileReader();
                           reader.onload = (e) => preview = e.target.result;
                           reader.readAsDataURL(file);
                       }
                   "
                   class="block w-full text-xs text-slate-600 file:mr-3 file:py-2 file:px-3.5 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-700 file:text-white hover:file:bg-emerald-800 cursor-pointer">

            @if($current)
                <p class="text-xs text-slate-500 truncate" x-show="!selectedName">
                    File saat ini: <span class="font-mono text-slate-700">{{ basename($current) }}</span> &mdash; biarkan kosong jika tidak ingin mengganti.
                </p>
            @endif
            <p class="text-xs text-emerald-700 font-medium truncate" x-show="selectedName" x-cloak>
                File baru dipilih: <span x-text="selectedName"></span>
            </p>
            @if($hint)
                <p class="text-xs text-slate-400">{{ $hint }}</p>
            @endif
        </div>
    </div>
</div>
