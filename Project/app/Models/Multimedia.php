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
}