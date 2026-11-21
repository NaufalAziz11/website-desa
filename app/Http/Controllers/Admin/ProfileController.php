<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VillageProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = VillageProfile::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Desa Sukamaju',
                'district' => 'Kecamatan Sukasari',
                'regency' => 'Kabupaten Bandung',
                'province' => 'Jawa Barat',
                'head_name' => 'Kepala Desa',
                'address' => 'Jl. Raya Desa',
            ]
        );

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = VillageProfile::firstOrFail();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'regency' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:10'],
            'head_name' => ['required', 'string', 'max:255'],
            'head_title' => ['required', 'string', 'max:255'],
            'head_welcome' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'mission' => ['nullable', 'string'],
            'history' => ['nullable', 'string'],
            'address' => ['required', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'office_hours' => ['nullable', 'string', 'max:255'],
            'population_total' => ['required', 'integer', 'min:0'],
            'families_total' => ['required', 'integer', 'min:0'],
            'male_total' => ['required', 'integer', 'min:0'],
            'female_total' => ['required', 'integer', 'min:0'],
            'area_km2' => ['required', 'numeric', 'min:0'],
            'dusun_count' => ['required', 'integer', 'min:0'],
            'rw_count' => ['required', 'integer', 'min:0'],
            'rt_count' => ['required', 'integer', 'min:0'],
            'map_embed_url' => ['nullable', 'string'],
            'head_photo' => ['nullable', 'image', 'max:2048'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
        ]);

        foreach (['head_photo', 'logo', 'hero_image'] as $field) {
            if ($request->hasFile($field)) {
                if ($profile->$field) {
                    Storage::disk('public')->delete($profile->$field);
                }
                $data[$field] = $request->file($field)->store('profile', 'public');
            }
        }

        $profile->update($data);

        return redirect()->route('admin.profile.edit')->with('success', 'Profil desa berhasil diperbarui.');
    }
}
