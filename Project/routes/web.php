<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuccessStoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserProfileController;
use App\Models\Career;
use App\Models\Multimedia;
use App\Models\Resource;
use App\Models\QuizQuestion;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    $featuredCareers = Career::latest()->take(3)->get();
    $featuredMultimedia = Multimedia::latest()->take(3)->get();
    $featuredResources = Resource::latest()->take(3)->get();
    $sampleQuestions = QuizQuestion::take(2)->get();

    $authUser = \Illuminate\Support\Facades\Auth::user();
    $digitalPassport = null;

    if ($authUser) {
        $latestAttempt = $authUser->quizAttempts()->latest()->first();
        $bookmarksCount = $authUser->bookmarks()->count();

        // 1. Calculate Profile Strength (%)
        $strength = 40; // baseline for created account
        if ($authUser->profile?->education_level || $authUser->education_level) $strength += 20;
        if ($authUser->profile?->interests || $authUser->interests) $strength += 20;
        if ($latestAttempt) $strength += 20;

        // 2. Core Domain & Cloud Proficiency
        $coreProficiency = 70;
        $cloudReadiness = 65;
        $activeTrack = $authUser->role ? ucfirst($authUser->role) . ' Track' : 'Technology Scholar';

        if ($latestAttempt) {
            $domainScores = $latestAttempt->domain_scores ?? [];
            if (!empty($domainScores)) {
                $maxScore = max($domainScores);
                $coreProficiency = min(99, max(50, (int) round(($maxScore / 25) * 100)));
            } elseif ($latestAttempt->total_score) {
                $coreProficiency = min(99, max(50, 60 + (int) ($latestAttempt->total_score * 3)));
            }

            if (!empty($latestAttempt->top_domain)) {
                $activeTrack = $latestAttempt->top_domain;
            } elseif (!empty($latestAttempt->recommended_careers[0])) {
                $firstRec = $latestAttempt->recommended_careers[0];
                $activeTrack = is_array($firstRec) ? ($firstRec['title'] ?? 'Tech Specialist') : $firstRec;
            }

            $cloudReadiness = min(98, max(55, 60 + ($bookmarksCount * 6) + (count($domainScores) * 4)));
        } else {
            $cloudReadiness = min(90, max(50, 50 + ($bookmarksCount * 8)));
        }

        $digitalPassport = [
            'is_auth' => true,
            'id_code' => 'PS-2026-' . str_pad($authUser->id, 4, '0', STR_PAD_LEFT),
            'name' => $authUser->name,
            'role' => $authUser->role,
            'education' => $authUser->profile?->education_level ?? $authUser->education_level,
            'active_track' => $activeTrack,
            'strength' => min(100, $strength),
            'core_proficiency' => $coreProficiency,
            'cloud_readiness' => $cloudReadiness,
            'has_quiz' => (bool) $latestAttempt,
        ];
    } else {
        $digitalPassport = [
            'is_auth' => false,
            'id_code' => 'PS-2026-DEMO',
            'name' => 'Guest Visitor',
            'role' => null,
            'education' => null,
            'active_track' => 'Explore 15+ Technology Tracks',
            'strength' => 85,
            'core_proficiency' => 88,
            'cloud_readiness' => 82,
            'has_quiz' => false,
        ];
    }

    return view('index', compact('featuredCareers', 'featuredMultimedia', 'featuredResources', 'sampleQuestions', 'digitalPassport'));
})->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email')->middleware('throttle:5,1');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update')->middleware('throttle:5,1');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Mandatory Email Verification Notice & Handlers
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [AuthController::class, 'showVerificationNotice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])->middleware('throttle:6,1')->name('verification.send');
});

// Public Features (Read-Only) & Indexed Career Intelligence Autocomplete
Route::get('/api/careers/autocomplete', [CareerController::class, 'autocomplete'])->name('api.careers.autocomplete');
Route::post('/careers/save-preferences', [CareerController::class, 'savePreferences'])->name('careers.save-preferences');
Route::resource('careers', CareerController::class)->only(['index', 'show']);
Route::resource('multimedia', MultimediaController::class)->only(['index', 'show']);
Route::resource('resources', ResourceController::class)->only(['index', 'show']);
Route::resource('stories', SuccessStoryController::class)->only(['index', 'show']);

// Interest Assessment Quiz
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/results/{id}', [QuizController::class, 'results'])->name('quiz.results');

use App\Http\Controllers\SitemapController;

// Dynamic Technical SEO XML Sitemap & Mandatory Visual Platform Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/sitemap', [SitemapController::class, 'visual'])->name('sitemap.visual');

use App\Http\Controllers\ChatController;

// Real-Time AI Career Guide Chatbot Endpoint (Rate-Limited)
Route::post('/chat/message', [ChatController::class, 'sendMessage'])->name('chat.message')->middleware('throttle:20,1');

use App\Http\Controllers\HealthController;
use App\Http\Controllers\FileUploadController;

// Production Service & DB Health-Check API
Route::get('/api/health', [HealthController::class, 'check'])->name('api.health');

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PassportShareController;
use App\Http\Controllers\PassportExportController;
use App\Http\Controllers\NotificationController;

// Public Resource Previews & Safe Rate-Limited Downloads
Route::get('/resources/{id}/preview', [ResourceController::class, 'preview'])->name('resources.preview');
Route::get('/resources/{id}/download', [ResourceController::class, 'download'])->name('resources.download')->middleware('throttle:15,1');

// Public Privacy-Safe Shared Passport (Opaque Token)
Route::get('/passport/share/{token}', [PassportShareController::class, 'showSharedPassport'])->name('passport.shared');

// Public Homepage Feedback Submission (Rate-Limited)
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('throttle:6,1');

// Newsletter Subscription & Unsubscribe
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe')->middleware('throttle:10,1');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Protected User Features (Mandatory Email Verification Required)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Live Real-Time Notifications API
    Route::get('/api/notifications', [NotificationController::class, 'index'])->name('api.notifications.index');
    Route::post('/api/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('api.notifications.read');
    Route::post('/api/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('api.notifications.read-all');

    // Passport Sharing & Rate-Limited PDF Export
    Route::get('/passport/share-link', [PassportShareController::class, 'getShareLink'])->name('passport.share-link');
    Route::get('/passport/export-pdf', [PassportExportController::class, 'exportPdf'])->name('passport.export-pdf')->middleware('throttle:5,1');

    // Secure Candidate Document / Resume Upload
    Route::post('/api/upload/resume', [FileUploadController::class, 'uploadResume'])->name('api.upload.resume')->middleware('throttle:10,1');

    // Bookmarks CRUD, Private Sticky Notes & PDF Export
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::get('/bookmarks/export-all-pdf', [BookmarkController::class, 'exportAllPdf'])->name('bookmarks.export-all-pdf')->middleware('throttle:10,1');
    Route::get('/bookmarks/{id}/export-pdf', [BookmarkController::class, 'exportPdf'])->name('bookmarks.export-pdf')->middleware('throttle:10,1');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::post('/bookmarks/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::put('/bookmarks/{id}', [BookmarkController::class, 'update'])->name('bookmarks.update');
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    // 5-Star Ratings & Content Progress
    Route::post('/multimedia/{id}/rate', [MultimediaController::class, 'rate'])->name('multimedia.rate');
    Route::post('/multimedia/{id}/progress', [MultimediaController::class, 'saveProgress'])->name('multimedia.progress');
    Route::post('/resources/{id}/rate', [ResourceController::class, 'rate'])->name('resources.rate');

    // User Profile & Account Settings & Resume Download
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/resume/download', [UserProfileController::class, 'downloadResume'])->name('profile.resume.download');

    // Feedback History & Conversation Thread for Auth User
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');

    // Story Submission by User
    Route::post('/stories', [SuccessStoryController::class, 'store'])->name('stories.store');
    Route::post('/stories/{id}/submit-review', [SuccessStoryController::class, 'submitForReview'])->name('stories.submit-review');
    Route::delete('/stories/{id}', [SuccessStoryController::class, 'destroy'])->name('stories.destroy');

    // Admin-Only Master Control Operations & Moderation Suite
    Route::middleware('admin')->group(function () {
        Route::resource('careers', CareerController::class)->except(['index', 'show']);
        Route::resource('multimedia', MultimediaController::class)->except(['index', 'show']);
        Route::resource('resources', ResourceController::class)->except(['index', 'show']);

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
            Route::patch('/users/{id}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
            Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.destroy');
            
            Route::post('/careers', [AdminController::class, 'storeCareer'])->name('careers.store');
            Route::put('/careers/{id}', [AdminController::class, 'updateCareer'])->name('careers.update');
            Route::delete('/careers/{id}', [AdminController::class, 'deleteCareer'])->name('careers.destroy');
            
            Route::post('/multimedia', [AdminController::class, 'storeMultimedia'])->name('multimedia.store');
            Route::put('/multimedia/{id}', [AdminController::class, 'updateMultimedia'])->name('multimedia.update');
            Route::delete('/multimedia/{id}', [AdminController::class, 'deleteMultimedia'])->name('multimedia.destroy');
            
            Route::post('/resources', [AdminController::class, 'storeResource'])->name('resources.store');
            Route::put('/resources/{id}', [AdminController::class, 'updateResource'])->name('resources.update');
            Route::delete('/resources/{id}', [AdminController::class, 'deleteResource'])->name('resources.destroy');

            // Success Story Moderation & Feedback Response & Deletion
            Route::post('/stories/{id}/moderate', [SuccessStoryController::class, 'moderate'])->name('stories.moderate');
            Route::post('/feedback/{id}/respond', [FeedbackController::class, 'respond'])->name('feedback.respond');
            Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
        });
    });
});


