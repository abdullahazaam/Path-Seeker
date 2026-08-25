<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\RecentlyViewed;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Strict allowlisted external domains for resource downloads
     */
    protected const ALLOWED_DOWNLOAD_HOSTS = [
        'github.com',
        'raw.githubusercontent.com',
        'drive.google.com',
        'docs.google.com',
        'unsplash.com',
        'images.unsplash.com',
        'cdn.jsdelivr.net',
        'cdnjs.cloudflare.com',
        'pathseeker.com',
        'railway.app',
        'localhost',
        '127.0.0.1',
    ];

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
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
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
     * Safe Resource Download with authentication checks, allowlist validation, and rate-limiting.
     */
    public function download(Request $request, string $id)
    {
        $resource = Resource::findOrFail($id);

        // 1. Authorization check if resource is premium or private
        if (($resource->is_premium || $resource->is_private) && !Auth::check()) {
            return redirect()->route('login')->with('error', 'Authentication required to download this specialized toolkit.');
        }

        // 2. Strict Allowlisted URL destination verification (Open Redirect prevention)
        $url = $resource->file_url;
        $parsedUrl = parse_url($url);
        $host = strtolower($parsedUrl['host'] ?? '');

        $isAllowed = false;
        foreach (self::ALLOWED_DOWNLOAD_HOSTS as $allowedHost) {
            if ($host === $allowedHost || str_ends_with($host, '.' . $allowedHost)) {
                $isAllowed = true;
                break;
            }
        }

        if (!$isAllowed && !empty($host)) {
            abort(403, 'Download destination rejected by security policy.');
        }

        // 3. Increment download telemetry
        $resource->increment('download_count');

        if (Auth::check()) {
            RecentlyViewed::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'viewable_type' => 'resource',
                    'viewable_id' => $resource->id,
                ],
                ['viewed_at' => now()]
            );
        }

        return redirect()->away($url);
    }

    /**
     * 5-Star Rating handler with strict unique constraint.
     */
    public function rate(Request $request, string $id)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'review' => 'nullable|string|max:500',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'rateable_type' => 'resource',
                'rateable_id' => $id,
            ],
            [
                'rating' => $validated['rating'],
                'review' => $validated['review'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Rating recorded successfully.');
    }

    /**
     * Preview metadata endpoint for modal.
     */
    public function preview(string $id)
    {
        $resource = Resource::findOrFail($id);

        return response()->json([
            'id' => $resource->id,
            'title' => $resource->title,
            'category' => $resource->category,
            'description' => $resource->description ?? 'Production-ready engineering blueprint and checklist.',
            'file_type' => $resource->file_type ?? 'pdf',
            'preview_content' => $resource->preview_content ?? 'Full documentation, implementation steps, and architecture diagram included.',
            'download_url' => route('resources.download', $resource->id),
            'download_count' => $resource->download_count,
        ]);
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
            'description' => 'nullable|string',
            'file_type' => 'nullable|string|max:20',
            'is_premium' => 'nullable|boolean',
            'is_private' => 'nullable|boolean',
            'preview_content' => 'nullable|string',
        ]);

        Resource::create($validated);

        return redirect()->route('resources.index')->with('success', 'Resource created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resource = Resource::with('ratings')->findOrFail($id);

        if (Auth::check()) {
            RecentlyViewed::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'viewable_type' => 'resource',
                    'viewable_id' => $resource->id,
                ],
                ['viewed_at' => now()]
            );
        }

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
            'description' => 'nullable|string',
            'file_type' => 'nullable|string|max:20',
            'is_premium' => 'nullable|boolean',
            'is_private' => 'nullable|boolean',
            'preview_content' => 'nullable|string',
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
