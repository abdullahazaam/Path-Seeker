<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    /**
     * Subscribe to newsletter with duplicate prevention and re-activation handling.
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $email = strtolower(trim($validated['email']));
        $subscriber = Subscriber::where('email', $email)->first();

        if ($subscriber) {
            if ($subscriber->status === Subscriber::STATUS_SUBSCRIBED) {
                return redirect()->back()->with('info', 'You are already subscribed to PathSeeker tech intelligence dispatch.');
            }

            // Reactivate subscription
            $subscriber->update([
                'status' => Subscriber::STATUS_SUBSCRIBED,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ]);

            return redirect()->back()->with('success', 'Welcome back! Your newsletter subscription has been reactivated.');
        }

        Subscriber::create([
            'email' => $email,
            'status' => Subscriber::STATUS_SUBSCRIBED,
            'token' => Str::random(48),
            'subscribed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing! You will receive weekly career benchmarks.');
    }

    /**
     * Real unsubscribe flow with database state update.
     */
    public function unsubscribe(Request $request, string $token)
    {
        $subscriber = Subscriber::where('token', $token)->first();

        if (!$subscriber) {
            return response()->view('newsletter.unsubscribed', [
                'error' => 'Invalid or expired unsubscribe link token.',
                'subscriber' => null,
            ], 404);
        }

        $subscriber->unsubscribe();

        return response()->view('newsletter.unsubscribed', [
            'error' => null,
            'subscriber' => $subscriber,
        ]);
    }
}
