<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'education_level',
        'interests',
        'skills',
        'work_experience',
        'profile_image',
        'resume_path',
        'resume_filename',
        'resume_updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
