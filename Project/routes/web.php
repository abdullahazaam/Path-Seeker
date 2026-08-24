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
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Public Features
Route::resource('careers', CareerController::class);
Route::resource('multimedia', MultimediaController::class);
Route::resource('resources', ResourceController::class);
Route::resource('stories', SuccessStoryController::class);

// Interest Assessment Quiz
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('/quiz/submit', [QuizController::class, 'submit'])->name('quiz.submit');

use App\Http\Controllers\ChatController;

// Real-Time AI Career Guide Chatbot Endpoint
Route::post('/chat/message', [ChatController::class, 'sendMessage'])->name('chat.message');

use App\Http\Controllers\AdminController;

// Protected User Dashboard & Admin Master Suite
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Master Control Operations
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
    });
});

// Temporary Admin Password Fix
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::get('/fix-admin-password', function () {
    $admin = User::where('email', 'admin@pathseeker.com')->first();
    
    if ($admin) {
        $admin->password = Hash::make('admin123');
        $admin->save();
        return '<h2 style="color: green; text-align: center; margin-top: 50px;">✅ Admin password successfully hashed and updated! You can now login.</h2>';
    }
    
    return '<h2 style="color: red; text-align: center; margin-top: 50px;">❌ Admin user not found! Check the email address.</h2>';
});


