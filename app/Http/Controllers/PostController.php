<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('jenis');
        $search = $request->query('q');

        $posts = Post::published()
            ->when($type, fn ($q) => $q->where('type', $type))
            ->when($search, fn ($q) => $q->where(function ($sub) use ($search) {
                $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            }))
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('public.posts.index', compact('posts', 'type', 'search'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        $post->increment('views');

        $related = Post::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.posts.show', compact('post', 'related'));
    }
}
