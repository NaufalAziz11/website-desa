<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('kategori');

        $galleries = Gallery::query()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->latest('taken_at')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Gallery::select('category')->distinct()->pluck('category');

        return view('public.gallery', compact('galleries', 'categories', 'category'));
    }
}
