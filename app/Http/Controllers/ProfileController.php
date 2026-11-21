<?php

namespace App\Http\Controllers;

use App\Models\Official;
use App\Models\VillageProfile;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = VillageProfile::first();
        $officials = Official::where('is_active', true)->orderBy('order')->get();

        return view('public.profile', compact('profile', 'officials'));
    }
}
