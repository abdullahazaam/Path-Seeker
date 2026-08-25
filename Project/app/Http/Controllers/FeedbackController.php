<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Notifications\FeedbackRespondedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display authenticated user's feedback history (Privacy-guarded).
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please sign in to view your feedback history.');
        }

        $feedbacks = Feedback::where('user_id', $user->id)->with('responder')->latest()->paginate(10);

        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Display a specific feedback conversation thread with administrator response.
     */
    public function show(string $id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please sign in to view this feedback thread.');
        }

        $feedback = Feedback::with(['user', 'responder'])->findOrFail($id);

        // Strict Authorization: Only the author or an administrator can view
        if ($user->id !== $feedback->user_id && $user->role !== 'admin') {
            abort(403, 'Unauthorized access to private feedback conversation.');
        }

        // Auto-mark any matching unread notification as read
        $user->unreadNotifications()
            ->where('data->feedback_id', (int) $feedback->id)
            ->get()
            ->each(fn ($n) => $n->markAsRead());

        return view('feedback.show', compact('feedback'));
    }

    /**
     * Store new feedback (Rate-limited via route throttle).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:bug,suggestion,query,general',
            'message' => 'required|string|min:5|max:2000',
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:150',
        ]);

        $user = Auth::user();
        $validated['user_id'] = $user?->id;
        $validated['name'] = $validated['name'] ?? ($user ? $user->name : 'Community Member');
        $validated['email'] = $validated['email'] ?? ($user ? $user->email : null);
        $validated['status'] = Feedback::STATUS_OPEN;

        Feedback::create($validated);

        return redirect()->back()->with('success', 'Thank you! Your feedback has been received and logged for engineering review.');
    }

    /**
     * Admin delete feedback endpoint.
     */
    public function destroy(string $id)
    {
        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'Unauthorized. Admin role required.');
        }

        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->back()->with('success', 'Feedback ticket removed from system.');
    }

    /**
     * Admin review and response endpoint.
     */
    public function respond(Request $request, string $id)
    {
        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            abort(403, 'Unauthorized. Admin role required.');
        }

        $feedback = Feedback::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:open,in_review,resolved,closed',
            'admin_response' => 'required|string|max:2000',
        ]);

        $feedback->update([
            'status' => $validated['status'],
            'admin_response' => $validated['admin_response'],
            'responded_by' => $admin->id,
            'responded_at' => now(),
        ]);

        // Idempotently notify user
        if ($feedback->user) {
            $alreadyNotified = $feedback->user->notifications()
                ->where('type', FeedbackRespondedNotification::class)
                ->where('data->feedback_id', $feedback->id)
                ->where('data->status', $feedback->status)
                ->exists();

            if (!$alreadyNotified) {
                $feedback->user->notify(new FeedbackRespondedNotification($feedback));
            }
        }

        return redirect()->back()->with('success', 'Response recorded and user notified.');
    }
}
