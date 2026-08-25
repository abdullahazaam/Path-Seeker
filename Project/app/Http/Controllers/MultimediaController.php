<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\ContentProgress;
use App\Models\Multimedia;
use App\Models\Rating;
use App\Models\RecentlyViewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'domain' => 'nullable|string|max:255',
            'transcript' => 'nullable|string',
        ]);

        Multimedia::create($validated);

        return redirect()->route('multimedia.index')->with('success', 'Multimedia item added successfully!');
    }

    /**
     * Display the specified resource with transcripts, related media & careers, and history logging.
     */
    public function show(string $id)
    {
        $item = Multimedia::with('ratings')->findOrFail($id);

        if (Auth::check()) {
            RecentlyViewed::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'viewable_type' => 'multimedia',
                    'viewable_id' => $item->id,
                ],
                ['viewed_at' => now()]
            );
        }

        // Related content engines
        $relatedMedia = Multimedia::where('id', '!=', $item->id)
            ->where(function ($q) use ($item) {
                if ($item->domain) {
                    $q->where('domain', $item->domain);
                }
                if ($item->tags) {
                    $q->orWhere('tags', 'like', "%{$item->tags}%");
                }
            })
            ->take(3)
            ->get();

        if ($relatedMedia->isEmpty()) {
            $relatedMedia = Multimedia::where('id', '!=', $item->id)->take(3)->get();
        }

        $relatedCareers = Career::where('domain', $item->domain)->take(2)->get();
        if ($relatedCareers->isEmpty()) {
            $relatedCareers = Career::take(2)->get();
        }

        $userRating = Auth::check() 
            ? Rating::where('user_id', Auth::id())->where('rateable_type', 'multimedia')->where('rateable_id', $item->id)->first() 
            : null;

        $userProgress = Auth::check()
            ? ContentProgress::where('user_id', Auth::id())->where('content_type', 'multimedia')->where('content_id', $item->id)->first()
            : null;

        return view('multimedia.show', compact('item', 'relatedMedia', 'relatedCareers', 'userRating', 'userProgress'));
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
                'rateable_type' => 'multimedia',
                'rateable_id' => $id,
            ],
            [
                'rating' => $validated['rating'],
                'review' => $validated['review'] ?? null,
            ]
        );

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Rating recorded successfully.']);
        }

        return redirect()->back()->with('success', 'Thank you! Your 5-star review has been recorded.');
    }

    /**
     * Track user content completion progress.
     */
    public function saveProgress(Request $request, string $id)
    {
        $validated = $request->validate([
            'progress_percent' => 'required|integer|between:0,100',
            'completed' => 'nullable|boolean',
        ]);

        ContentProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'content_type' => 'multimedia',
                'content_id' => $id,
            ],
            [
                'progress_percent' => $validated['progress_percent'],
                'completed' => $validated['completed'] ?? ($validated['progress_percent'] >= 90),
                'last_accessed_at' => now(),
            ]
        );

        return response()->json(['success' => true, 'message' => 'Progress saved.']);
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
            'domain' => 'nullable|string|max:255',
            'transcript' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('multimedia.index')->with('success', 'Multimedia item updated successfully!');
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
