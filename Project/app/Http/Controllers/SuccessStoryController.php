<?php

namespace App\Http\Controllers;

use App\Models\SuccessStory;
use App\Notifications\StoryStatusUpdatedNotification;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuccessStoryController extends Controller
{
    /**
     * Display approved public success stories.
     */
    public function index()
    {
        $stories = SuccessStory::approved()->latest()->paginate(9);
        return view('stories.index', compact('stories'));
    }

    /**
     * Display a single story with privacy authorization for non-approved states.
     */
    public function show(string $id)
    {
        $story = SuccessStory::findOrFail($id);

        if ($story->status !== SuccessStory::STATUS_APPROVED) {
            $user = Auth::user();
            if (!$user || ($user->id !== $story->submitted_by && $user->role !== 'admin')) {
                abort(404, 'Story is currently undergoing moderation.');
            }
        }

        return view('stories.show', compact('story'));
    }

    /**
     * Store a newly created success story.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'educational_path' => 'nullable|string|max:1000',
            'challenges' => 'nullable|string|max:1000',
            'outcome' => 'nullable|string|max:1000',
            'timeline_path' => 'nullable|string|max:1000',
            'story_text' => 'required|string|min:20',
            'image_url' => 'nullable|url',
        ]);

        $userId = Auth::id();
        $validated['submitted_by'] = $userId;
        $validated['user_id'] = $userId;
        $validated['status'] = SuccessStory::STATUS_PENDING;

        $story = SuccessStory::create($validated);

        return redirect()->back()->with('success', 'Your success story has been submitted for administrative review!');
    }

    /**
     * Submit draft story for review.
     */
    public function submitForReview(string $id)
    {
        $story = SuccessStory::findOrFail($id);
        $user = Auth::user();

        if ($user->id !== $story->submitted_by && $user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $story->transitionTo(SuccessStory::STATUS_PENDING, $user);

        return redirect()->back()->with('success', 'Story submitted for review.');
    }

    /**
     * Moderate story state (Admin only). Enforces author self-moderation prevention and idempotent notification.
     */
    public function moderate(Request $request, string $id)
    {
        $story = SuccessStory::findOrFail($id);
        $admin = Auth::user();

        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'Unauthorized: Administrator privileges required.');
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected,archived',
            'reason' => 'nullable|string|max:1000',
        ]);

        $newStatus = $validated['status'];
        $reason = $validated['reason'] ?? null;

        if ($newStatus === SuccessStory::STATUS_REJECTED && empty($reason)) {
            return redirect()->back()->withErrors(['reason' => 'A rejection reason is required when rejecting a story.']);
        }

        try {
            $story->transitionTo($newStatus, $admin, $reason);
        } catch (DomainException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        // Idempotently notify author
        if ($story->author && in_array($newStatus, [SuccessStory::STATUS_APPROVED, SuccessStory::STATUS_REJECTED], true)) {
            $alreadyNotified = $story->author->notifications()
                ->where('type', StoryStatusUpdatedNotification::class)
                ->where('data->story_id', $story->id)
                ->where('data->status', $newStatus)
                ->exists();

            if (!$alreadyNotified) {
                $story->author->notify(new StoryStatusUpdatedNotification($story, $newStatus, $reason));
            }
        }

        return redirect()->back()->with('success', "Success story status updated to '{$newStatus}'.");
    }

    /**
     * Delete story (Admin or Author).
     */
    public function destroy(string $id)
    {
        $story = SuccessStory::findOrFail($id);
        $user = Auth::user();

        if (!$user || ($user->id !== $story->submitted_by && $user->role !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        $story->delete();

        return redirect()->back()->with('success', 'Success story deleted.');
    }
}
