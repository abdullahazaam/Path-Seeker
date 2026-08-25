<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Display all bookmarks for the authenticated user.
     */
    public function index()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())->latest()->get();
        return view('bookmarks.index', compact('bookmarks'));
    }

    /**
     * Toggle or save a bookmark with optional private notes.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_type' => 'required|in:career,multimedia,resource',
            'item_id' => 'required|integer',
            'notes' => 'nullable|string|max:1000',
        ]);

        $bookmark = Bookmark::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'item_type' => $validated['item_type'],
                'item_id' => $validated['item_id'],
            ],
            [
                'notes' => $validated['notes'] ?? null,
            ]
        );

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'bookmark' => $bookmark]);
        }

        return redirect()->back()->with('success', 'Saved to your Career Passport bookmarks!');
    }

    /**
     * Update private note for a bookmark.
     */
    public function update(Request $request, string $id)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $bookmark->update([
            'notes' => $validated['notes'] ?? null,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'notes' => $bookmark->notes]);
        }

        return redirect()->back()->with('success', 'Private note updated.');
    }

    /**
     * Remove bookmark.
     */
    public function destroy(string $id)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->findOrFail($id);
        $bookmark->delete();

        return redirect()->back()->with('success', 'Bookmark removed.');
    }
}
