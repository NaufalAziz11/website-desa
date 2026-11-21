<?php

namespace App\Http\Controllers;

use App\Models\Potential;
use Illuminate\Http\Request;

class PotentialController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('kategori');
        $search = $request->query('q');

        $potentials = Potential::query()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($search, fn ($q) => $q->where(function ($sub) use ($search) {
                $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");
            }))
            ->orderByDesc('is_featured')
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $categories = Potential::select('category')->distinct()->pluck('category');

        return view('public.potentials.index', compact('potentials', 'categories', 'category', 'search'));
    }

    public function show(string $slug)
    {
        $potential = Potential::where('slug', $slug)->firstOrFail();
        $others = Potential::where('id', '!=', $potential->id)->latest()->take(3)->get();

        return view('public.potentials.show', compact('potential', 'others'));
    }
}
