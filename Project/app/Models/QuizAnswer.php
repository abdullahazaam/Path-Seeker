<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswer extends Model
{
    protected $fillable = [
        'quiz_attempt_id',
        'question_id',
        'question_text',
        'selected_option',
        'selected_option_text',
        'domain_awarded',
        'points_awarded',
    ];

    protected $casts = [
        'points_awarded' => 'integer',
        'question_id' => 'integer',
    ];

    public function attempt(): BelongsTo
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }
}
