<?php

namespace App\Notifications;

use App\Models\SuccessStory;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class StoryStatusUpdatedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public SuccessStory $story,
        public string $status,
        public ?string $reason = null
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $actionText = match ($this->status) {
            'approved' => "Your success story '{$this->story->title}' has been approved and published!",
            'rejected' => "Your success story '{$this->story->title}' was reviewed with feedback: " . ($this->reason ?? 'Review required.'),
            'archived' => "Your success story '{$this->story->title}' was archived.",
            default => "Your success story '{$this->story->title}' status changed to {$this->status}."
        };

        return [
            'type' => 'story_status_updated',
            'story_id' => $this->story->id,
            'title' => $this->story->title,
            'status' => $this->status,
            'reason' => $this->reason,
            'message' => $actionText,
            'updated_at' => now()->toIso8601String(),
        ];
    }
}
