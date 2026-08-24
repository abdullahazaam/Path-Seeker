<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $fillable = [
        'title',
        'domain',
        'story_text',
        'image_url',
        'submitted_by',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}
