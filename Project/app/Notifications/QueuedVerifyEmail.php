<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;

class QueuedVerifyEmail extends VerifyEmail
{
    // Synchronous dispatch for immediate delivery
}
