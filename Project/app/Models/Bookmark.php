<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'item_type',
        'notes',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getItemAttribute()
    {
        return match ($this->item_type) {
            'career' => Career::find($this->item_id),
            'multimedia' => Multimedia::find($this->item_id),
            'resource' => Resource::find($this->item_id),
            default => null,
        };
    }
}
