<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'category',
        'image',
        'caption',
        'taken_at',
    ];

    protected $casts = [
        'taken_at' => 'date',
    ];
}
