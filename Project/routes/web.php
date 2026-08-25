<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuccessStoryController;
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
    return view('index', compact('featuredCareers', 'featuredMultimedia', 'featuredResources', 'sampleQuestions'));
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

// Public Features (Read-Only) & Indexed Career Intelligence Autocomplete
Route::get('/api/careers/autocomplete', [CareerController::class, 'autocomplete'])->name('api.careers.autocomplete');
Route::resource('careers', CareerController::class)->only(['index', 'show']);
Route::resource('multimedia', MultimediaController::class)->only(['index', 'show']);
Route::resource('resources', ResourceController::class)->only(['index', 'show']);
Route::resource('stories', SuccessStoryController::class)->only(['index', 'show']);

// Interest Assessment Quiz
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/results/{id}', [QuizController::class, 'results'])->name('quiz.results');

use App\Http\Controllers\SitemapController;

// Dynamic Technical SEO XML Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

use App\Http\Controllers\ChatController;

// Real-Time AI Career Guide Chatbot Endpoint (Rate-Limited)
Route::post('/chat/message', [ChatController::class, 'sendMessage'])->name('chat.message')->middleware('throttle:20,1');

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PassportShareController;
use App\Http\Controllers\PassportExportController;

// Public Resource Previews & Safe Rate-Limited Downloads
Route::get('/resources/{id}/preview', [ResourceController::class, 'preview'])->name('resources.preview');
Route::get('/resources/{id}/download', [ResourceController::class, 'download'])->name('resources.download')->middleware('throttle:15,1');

// Public Privacy-Safe Shared Passport (Opaque Token)
Route::get('/passport/share/{token}', [PassportShareController::class, 'showSharedPassport'])->name('passport.shared');

// Newsletter Subscription & Unsubscribe
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe')->middleware('throttle:10,1');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

// Protected User Features
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Passport Sharing & Rate-Limited PDF Export
    Route::get('/passport/share-link', [PassportShareController::class, 'getShareLink'])->name('passport.share-link');
    Route::get('/passport/export-pdf', [PassportExportController::class, 'exportPdf'])->name('passport.export-pdf')->middleware('throttle:5,1');

    // Bookmarks CRUD & Private Notes
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::put('/bookmarks/{id}', [BookmarkController::class, 'update'])->name('bookmarks.update');
    Route::delete('/bookmarks/{id}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    // 5-Star Ratings & Content Progress
    Route::post('/multimedia/{id}/rate', [MultimediaController::class, 'rate'])->name('multimedia.rate');
    Route::post('/multimedia/{id}/progress', [MultimediaController::class, 'saveProgress'])->name('multimedia.progress');
    Route::post('/resources/{id}/rate', [ResourceController::class, 'rate'])->name('resources.rate');

    // Feedback Submission & History
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store')->middleware('throttle:6,1');

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
            Route::delete('/multimedia/{id}', [AdminController::class, 'deleteMultimedia'])->name('multimedia.destroy');
            
            Route::post('/resources', [AdminController::class, 'storeResource'])->name('resources.store');
            Route::delete('/resources/{id}', [AdminController::class, 'deleteResource'])->name('resources.destroy');

            // Success Story Moderation & Feedback Response
            Route::post('/stories/{id}/moderate', [SuccessStoryController::class, 'moderate'])->name('stories.moderate');
            Route::post('/feedback/{id}/respond', [FeedbackController::class, 'respond'])->name('feedback.respond');
        });
    });
});


