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
            return response()->json(['success' => true, 'bookmarked' => true, 'bookmark' => $bookmark]);
        }

        return redirect()->back()->with('success', 'Saved to your Career Passport bookmarks!');
    }

    /**
     * Toggle bookmark state (save or remove) via AJAX.
     */
    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please sign in to save bookmarks to your Career Passport.',
                'redirect' => route('login'),
            ], 401);
        }

        $validated = $request->validate([
            'item_type' => 'required|in:career,multimedia,resource',
            'item_id' => 'required|integer',
        ]);

        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('item_type', $validated['item_type'])
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $isBookmarked = false;
            $message = 'Removed from bookmarks.';
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'item_type' => $validated['item_type'],
                'item_id' => $validated['item_id'],
            ]);
            $isBookmarked = true;
            $message = 'Saved to your Career Passport bookmarks!';
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'bookmarked' => $isBookmarked,
                'message' => $message,
            ]);
        }

        return redirect()->back()->with('success', $message);
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

    /**
     * Printable / PDF export view for a specific bookmark.
     */
    public function exportPdf(string $id)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())->findOrFail($id);
        $user = Auth::user();
        $item = $bookmark->item;

        return view('bookmarks.pdf-export', compact('bookmark', 'user', 'item'));
    }

    /**
     * Printable / PDF export view for all user bookmarks.
     */
    public function exportAllPdf()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())->latest()->get();
        $user = Auth::user();

        return view('bookmarks.pdf-export-all', compact('bookmarks', 'user'));
    }
}
