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
            'response' => $this->feedback->admin_response,
            'message' => "An administrator has responded to your {$this->feedback->category} feedback.",
            'updated_at' => now()->toIso8601String(),
        ];
    }
}
