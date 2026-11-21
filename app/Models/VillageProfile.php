<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'district',
        'regency',
        'province',
        'postal_code',
        'head_name',
        'head_title',
        'head_photo',
        'head_welcome',
        'vision',
        'mission',
        'history',
        'address',
        'phone',
        'email',
        'office_hours',
        'population_total',
        'families_total',
        'male_total',
        'female_total',
        'area_km2',
        'dusun_count',
        'rw_count',
        'rt_count',
        'map_embed_url',
        'logo',
        'hero_image',
    ];

    public function getMissionListAttribute(): array
    {
        if (empty($this->mission)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $this->mission))));
    }
}
