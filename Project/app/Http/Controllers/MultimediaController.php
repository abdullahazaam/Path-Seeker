<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource with search, tag, and type filtering.
     */
    public function index(Request $request)
    {
        $query = Multimedia::query();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('tags', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tag')) {
            $tag = trim($request->input('tag'));
            $query->where('tags', 'like', "%{$tag}%");
        }

        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $allTags = Multimedia::pluck('tags')
            ->filter()
            ->flatMap(function ($t) {
                return array_map('trim', explode(',', $t));
            })
            ->filter()
            ->unique()
            ->values()
            ->take(12)
            ->all();

        $multimedia = $query->orderBy('id')->paginate(6)->withQueryString();

        return view('multimedia.index', compact('multimedia', 'allTags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('multimedia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,audio',
            'url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'duration' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
        ]);

        Multimedia::create($validated);

        return redirect()->route('multimedia.index')->with('success', 'Multimedia item added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Multimedia::findOrFail($id);
        return view('multimedia.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Multimedia::findOrFail($id);
        return view('multimedia.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Multimedia::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:video,audio',
            'url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'duration' => 'nullable|string|max:50',
            'tags' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('multimedia.show', $item->id)->with('success', 'Multimedia item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Multimedia::findOrFail($id);
        $item->delete();

        return redirect()->route('multimedia.index')->with('success', 'Multimedia item deleted successfully!');
    }
}