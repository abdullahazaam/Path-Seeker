<?php

namespace App\Models;

use DomainException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuccessStory extends Model
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PENDING = 'pending_review';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_ARCHIVED = 'archived';

    public const ALLOWED_STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PENDING,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
        self::STATUS_ARCHIVED,
    ];

    protected $fillable = [
        'title',
        'domain',
        'story_text',
        'image_url',
        'submitted_by',
        'status',
        'reviewer_id',
        'rejection_reason',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Enforce strict state machine transitions and self-moderation prevention.
     */
    public function transitionTo(string $newStatus, ?User $actor = null, ?string $reason = null): void
    {
        if (!in_array($newStatus, self::ALLOWED_STATUSES, true)) {
            throw new DomainException("Invalid target status '{$newStatus}'.");
        }

        $currentStatus = $this->status ?: self::STATUS_DRAFT;

        if ($currentStatus === $newStatus) {
            return;
        }

        // 1. Protection: An author must NEVER moderate (approve, reject, or archive) their own story
        if ($this->submitted_by && $actor && $actor->id === $this->submitted_by) {
            if (in_array($newStatus, [self::STATUS_APPROVED, self::STATUS_REJECTED, self::STATUS_ARCHIVED], true)) {
                throw new DomainException("Security Violation: Authors are prohibited from moderating their own success stories.");
            }
        }

        // 2. Validate Allowed State Transitions
        $valid = false;
        switch ($currentStatus) {
            case self::STATUS_DRAFT:
                $valid = ($newStatus === self::STATUS_PENDING);
                break;

            case self::STATUS_PENDING:
                $valid = in_array($newStatus, [self::STATUS_APPROVED, self::STATUS_REJECTED, self::STATUS_DRAFT], true);
                break;

            case self::STATUS_REJECTED:
                $valid = in_array($newStatus, [self::STATUS_DRAFT, self::STATUS_PENDING], true);
                break;

            case self::STATUS_APPROVED:
                $valid = ($newStatus === self::STATUS_ARCHIVED);
                break;

            case self::STATUS_ARCHIVED:
                $valid = ($newStatus === self::STATUS_APPROVED); // admin unarchive
                break;
        }

        if (!$valid) {
            throw new DomainException("Illegal state transition from '{$currentStatus}' to '{$newStatus}'.");
        }

        // 3. Admin Authorization for Moderation Actions
        if (in_array($newStatus, [self::STATUS_APPROVED, self::STATUS_REJECTED, self::STATUS_ARCHIVED], true)) {
            if (!$actor || $actor->role !== 'admin') {
                throw new DomainException("Unauthorized: Only administrators can moderate story status to '{$newStatus}'.");
            }

            $this->reviewer_id = $actor->id;
            $this->reviewed_at = now();
            $this->rejection_reason = ($newStatus === self::STATUS_REJECTED) ? $reason : null;
        }

        if ($newStatus === self::STATUS_PENDING) {
            $this->rejection_reason = null;
        }

        $this->status = $newStatus;
        $this->save();
    }
}
