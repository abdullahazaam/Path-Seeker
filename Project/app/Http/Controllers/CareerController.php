<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource with advanced relational filters and pagination.
     */
    public function index(Request $request)
    {
        $query = Career::query();

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('domain', 'like', "%{$search}%")
                  ->orWhere('required_skills', 'like', "%{$search}%");
            });
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->input('domain'));
        }

        if ($request->filled('role')) {
            $query->forRole($request->input('role'));
        }

        if ($request->filled('confidence')) {
            $query->where('confidence_level', $request->input('confidence'));
        }

        // Relational sorting options
        $sort = $request->input('sort', 'default');
        switch ($sort) {
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        $careers = $query->paginate(6)->withQueryString();
        $domains = Career::select('domain')->distinct()->pluck('domain');

        $roleCounts = [
            'all' => Career::count(),
            'student' => Career::where(function($q){ $q->where('target_role', 'student')->orWhere('target_role', 'all'); })->count(),
            'graduate' => Career::where(function($q){ $q->where('target_role', 'graduate')->orWhere('target_role', 'all'); })->count(),
            'professional' => Career::where(function($q){ $q->where('target_role', 'professional')->orWhere('target_role', 'all'); })->count(),
        ];

        return view('careers.index', compact('careers', 'domains', 'roleCounts'));
    }

    /**
     * Autocomplete API endpoint for instant indexed search suggestions.
     */
    public function autocomplete(Request $request)
    {
        $q = trim($request->query('q', ''));
        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $results = Career::where('title', 'like', "%{$q}%")
            ->orWhere('domain', 'like', "%{$q}%")
            ->orWhere('required_skills', 'like', "%{$q}%")
            ->select('id', 'title', 'domain', 'target_role', 'expected_salary', 'confidence_level')
            ->take(8)
            ->get();

        return response()->json($results);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('careers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domain' => 'required|string|max:255',
            'required_skills' => 'required|string',
            'expected_salary' => 'required|string|max:255',
            'target_role' => 'nullable|in:student,graduate,professional,all',
            'salary_source_name' => 'nullable|string|max:255',
            'source_url' => 'nullable|url',
            'source_date' => 'nullable|string|max:50',
            'currency' => 'nullable|string|max:10',
            'methodology_notes' => 'nullable|string',
            'confidence_level' => 'nullable|string|max:50',
        ]);

        $career = Career::create($validated);

        return redirect()->route('careers.index')->with('success', 'Career added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $career = Career::findOrFail($id);
        return view('careers.show', compact('career'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $career = Career::findOrFail($id);
        return view('careers.edit', compact('career'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $career = Career::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'domain' => 'required|string|max:255',
            'required_skills' => 'required|string',
            'expected_salary' => 'required|string|max:255',
            'target_role' => 'nullable|in:student,graduate,professional,all',
            'salary_source_name' => 'nullable|string|max:255',
            'source_url' => 'nullable|url',
            'source_date' => 'nullable|string|max:50',
            'currency' => 'nullable|string|max:10',
            'methodology_notes' => 'nullable|string',
            'confidence_level' => 'nullable|string|max:50',
        ]);

        $career->update($validated);

        return redirect()->route('careers.index')->with('success', 'Career updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('careers.index')->with('success', 'Career deleted successfully!');
    }
}
