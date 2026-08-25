<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource with search and category filtering.
     */
    public function index(Request $request)
    {
        $query = Resource::query();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $category = trim($request->input('category'));
            $query->where('category', $category);
        }

        $categories = Resource::distinct()->pluck('category')->filter()->values()->all();
        $resources = $query->orderBy('id', 'asc')->paginate(6)->withQueryString();

        return view('resources.index', compact('resources', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file_url' => 'required|url',
        ]);

        Resource::create($validated);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resource = Resource::findOrFail($id);
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resource = Resource::findOrFail($id);
        return view('resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resource = Resource::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'file_url' => 'required|url',
        ]);

        $resource->update($validated);

        return redirect()->route('resources.show', $resource->id)->with('success', 'Resource updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = Resource::findOrFail($id);
        $resource->delete();

        return redirect()->route('resources.index')->with('success', 'Resource deleted successfully!');
    }
}
