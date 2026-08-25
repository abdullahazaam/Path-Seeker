<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentProgress extends Model
{
    protected $table = 'content_progress';

    protected $fillable = [
        'user_id',
        'content_type',
        'content_id',
        'progress_percent',
        'completed',
        'last_accessed_at',
    ];

    protected $casts = [
        'completed' => 'boolean',
        'last_accessed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
