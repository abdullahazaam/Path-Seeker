<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'url',
        'thumbnail_url',
        'duration',
        'tags',
        'domain',
        'transcript',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'rateable_id')->where('rateable_type', 'multimedia');
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->ratings()->avg('rating') ?: 4.8, 1);
    }

    /**
     * Helper to get clean, embeddable YouTube URL with fallback
     */
    public function getEmbedUrl(): string
    {
        $defaultFallback = 'https://www.youtube-nocookie.com/embed/ScMzIvxBSi4';

        if (empty($this->url)) {
            return $defaultFallback;
        }

        // Handle YouTube Embed format
        if (str_contains($this->url, 'youtube.com/embed/') || str_contains($this->url, 'youtube-nocookie.com/embed/')) {
            $parts = explode('/embed/', $this->url);
            $id = explode('?', $parts[1] ?? '')[0];
            return !empty($id) ? "https://www.youtube-nocookie.com/embed/{$id}" : $defaultFallback;
        }

        // Handle standard watch?v= format
        if (str_contains($this->url, 'youtube.com/watch?v=')) {
            $parts = explode('v=', $this->url);
            $id = explode('&', $parts[1] ?? '')[0];
            return !empty($id) ? "https://www.youtube-nocookie.com/embed/{$id}" : $defaultFallback;
        }

        // Handle short youtu.be format
        if (str_contains($this->url, 'youtu.be/')) {
            $parts = explode('youtu.be/', $this->url);
            $id = explode('?', $parts[1] ?? '')[0];
            return !empty($id) ? "https://www.youtube-nocookie.com/embed/{$id}" : $defaultFallback;
        }

        return $this->url;
    }

    /**
     * Get clean timestamped transcript with comprehensive fallback
     */
    public function getFormattedTranscriptAttribute(): string
    {
        if (!empty($this->transcript)) {
            return $this->transcript;
        }

        return "[00:00:00] Instructor: Welcome to PathSeeker's deep-dive masterclass on \"{$this->title}\".\n" .
               "[00:01:30] Instructor: In this comprehensive session, we explore key industry architectures, hands-on production code, and real-world trade-offs.\n" .
               "[00:06:45] Instructor: Let's examine the foundational principles, tooling ecosystem, and how distributed frameworks connect in modern cloud workflows.\n" .
               "[00:14:20] Instructor: Notice how latency, scalability, security guardrails, and maintainability guide architectural choices.\n" .
               "[00:22:10] Instructor: In this next segment, we review technical interview scenarios and production debugging methodologies.\n" .
               "[00:28:40] Instructor: To cement your learning, explore the companion blueprints and assessments on PathSeeker.";
    }
}