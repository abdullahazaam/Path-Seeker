<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use Illuminate\Http\Request;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource with pagination.
     */
    public function index()
    {
        // Order by id ASC so items appear in seeded sequence (Page 1: 1-6, Page 2: 7-12, Page 3: 13-16)
        $multimedia = Multimedia::orderBy('id')->paginate(6);
        return view('multimedia.index', compact('multimedia'));
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