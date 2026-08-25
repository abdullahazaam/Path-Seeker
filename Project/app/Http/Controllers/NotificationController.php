<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    /**
     * Fetch active live notifications and unread count for current user.
     * Seeds initial real-time onboarding notifications on first login if empty.
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['unread_count' => 0, 'notifications' => []]);
        }

        // Onboarding seed on first login if user has 0 notifications
        if ($user->notifications()->count() === 0) {
            $user->notifications()->create([
                'id' => (string) Str::uuid(),
                'type' => 'App\Notifications\PlatformAnnouncementNotification',
                'data' => [
                    'title' => 'Welcome to PathSeeker 2026',
                    'message' => 'Explore 10-year market trajectories, verified compensation benchmarks, and career toolkits.',
                    'action_url' => route('quiz.index'),
                    'icon' => 'fa-solid fa-sparkles',
                    'type_badge' => 'Welcome',
                ],
                'read_at' => null,
                'created_at' => now()->subMinutes(5),
            ]);

            $user->notifications()->create([
                'id' => (string) Str::uuid(),
                'type' => 'App\Notifications\CareerTrackNotification',
                'data' => [
                    'title' => 'New 2026 AI Tracks Added',
                    'message' => 'Autonomous AI Agent Architect & Cloud DevOps Specialist tracks are now live in Career Bank.',
                    'action_url' => route('careers.index'),
                    'icon' => 'fa-solid fa-compass',
                    'type_badge' => 'Intelligence',
                ],
                'read_at' => null,
                'created_at' => now()->subMinutes(2),
            ]);
        }

        $notifications = $user->notifications()
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($n) {
                $data = is_array($n->data) ? $n->data : json_decode($n->data, true) ?? [];
                
                $actionUrl = $data['action_url'] ?? null;
                if (!$actionUrl || $actionUrl === route('dashboard')) {
                    if (!empty($data['feedback_id'])) {
                        $actionUrl = route('feedback.show', $data['feedback_id']);
                    } else {
                        $actionUrl = route('dashboard');
                    }
                }

                $title = $data['title'] ?? null;
                if (!$title && !empty($data['feedback_id'])) {
                    $title = 'Admin Reply: ' . ucfirst($data['category'] ?? 'Support') . ' Ticket';
                }

                return [
                    'id' => $n->id,
                    'title' => $title ?? 'System Notification',
                    'message' => $data['message'] ?? 'Notification from PathSeeker Platform.',
                    'action_url' => $actionUrl,
                    'icon' => $data['icon'] ?? (!empty($data['feedback_id']) ? 'fa-solid fa-reply-all' : 'fa-solid fa-bell'),
                    'type_badge' => $data['type_badge'] ?? (!empty($data['feedback_id']) ? 'Admin Reply' : 'Notice'),
                    'read' => !is_null($n->read_at),
                    'time_ago' => $n->created_at->diffForHumans(),
                ];
            });

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'unread_count' => $unreadCount,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark single notification as read.
     */
    public function markAsRead(Request $request, string $id): JsonResponse
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return response()->json([
            'success' => true,
            'unread_count' => $user->unreadNotifications()->count(),
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request): JsonResponse
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return response()->json([
            'success' => true,
            'unread_count' => 0,
        ]);
    }
}
