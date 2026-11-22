<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PotentialController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $potentials = Potential::query()
            ->when($search, fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('admin.potentials.index', compact('potentials', 'search'));
    }

    public function create()
    {
        return view('admin.potentials.form', ['potential' => new Potential()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = Potential::uniqueSlug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('potentials', 'public');
        }

        Potential::create($data);

        return redirect()->route('admin.potentials.index')->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    public function edit(Potential $potential)
    {
        return view('admin.potentials.form', compact('potential'));
    }

    public function update(Request $request, Potential $potential)
    {
        $data = $this->validated($request);
        $data['slug'] = Potential::uniqueSlug($data['title'], $potential->id);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($potential->image) {
                Storage::disk('public')->delete($potential->image);
            }
            $data['image'] = $request->file('image')->store('potentials', 'public');
        }

        $potential->update($data);

        return redirect()->route('admin.potentials.index')->with('success', 'Potensi desa berhasil diperbarui.');
    }

    public function destroy(Potential $potential)
    {
        if ($potential->image) {
            Storage::disk('public')->delete($potential->image);
        }
        $potential->delete();

        return redirect()->route('admin.potentials.index')->with('success', 'Potensi desa berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:60'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'contact' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:3072'],
        ]);
    }
}
