<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'category',
        'file_url',
        'thumbnail_url',
        'description',
        'file_type',
        'is_premium',
        'is_private',
        'download_count',
        'preview_content',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'is_private' => 'boolean',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'rateable_id')->where('rateable_type', 'resource');
    }

    public function getAverageRatingAttribute(): float
    {
        return round($this->ratings()->avg('rating') ?: 4.9, 1);
    }
}
