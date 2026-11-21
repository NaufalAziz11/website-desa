<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Official;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficialController extends Controller
{
    public function index()
    {
        $officials = Official::orderBy('order')->latest()->paginate(15);

        return view('admin.officials.index', compact('officials'));
    }

    public function create()
    {
        return view('admin.officials.form', ['official' => new Official(['is_active' => true, 'order' => 1])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('officials', 'public');
        }

        Official::create($data);

        return redirect()->route('admin.officials.index')->with('success', 'Perangkat desa berhasil ditambahkan.');
    }

    public function edit(Official $official)
    {
        return view('admin.officials.form', compact('official'));
    }

    public function update(Request $request, Official $official)
    {
        $data = $this->validated($request);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            if ($official->photo) {
                Storage::disk('public')->delete($official->photo);
            }
            $data['photo'] = $request->file('photo')->store('officials', 'public');
        }

        $official->update($data);

        return redirect()->route('admin.officials.index')->with('success', 'Data perangkat desa berhasil diperbarui.');
    }

    public function destroy(Official $official)
    {
        if ($official->photo) {
            Storage::disk('public')->delete($official->photo);
        }
        $official->delete();

        return redirect()->route('admin.officials.index')->with('success', 'Perangkat desa berhasil dihapus.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:30'],
            'bio' => ['nullable', 'string'],
            'order' => ['required', 'integer', 'min:0'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
