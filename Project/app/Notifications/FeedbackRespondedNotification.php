<?php

namespace App\Notifications;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class FeedbackRespondedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Feedback $feedback
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'feedback_responded',
            'feedback_id' => $this->feedback->id,
            'category' => $this->feedback->category,
            'status' => $this->feedback->status,
            'title' => 'Admin Response: ' . ucfirst($this->feedback->category) . ' Feedback',
            'response' => $this->feedback->admin_response,
            'message' => "Admin reply: \"" . \Illuminate\Support\Str::limit($this->feedback->admin_response, 80) . "\"",
            'action_url' => route('feedback.show', $this->feedback->id),
            'icon' => 'fa-solid fa-reply-all',
            'type_badge' => 'Admin Reply',
            'updated_at' => now()->toIso8601String(),
        ];
    }
}
