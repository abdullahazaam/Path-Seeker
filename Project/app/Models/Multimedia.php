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
    ];

    /**
     * Helper to get clean embed URL
     */
    public function getEmbedUrl(): string
    {
        if (str_contains($this->url, 'youtube.com/watch?v=')) {
            $parts = explode('v=', $this->url);
            $id = explode('&', $parts[1] ?? '')[0];
            return "https://www.youtube-nocookie.com/embed/{$id}";
        }
        if (str_contains($this->url, 'youtu.be/')) {
            $parts = explode('youtu.be/', $this->url);
            $id = explode('?', $parts[1] ?? '')[0];
            return "https://www.youtube-nocookie.com/embed/{$id}";
        }
        return $this->url;
    }
}