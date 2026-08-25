<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'user_id',
        'quiz_version',
        'domain_scores',
        'total_score',
        'top_domain',
        'recommended_careers',
        'idempotency_token',
        'completed_at',
    ];

    protected $casts = [
        'domain_scores' => 'array',
        'recommended_careers' => 'array',
        'completed_at' => 'datetime',
        'total_score' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
