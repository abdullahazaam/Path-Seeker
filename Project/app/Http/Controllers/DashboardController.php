<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Career;
use App\Models\Multimedia;
use App\Models\Resource;
use App\Models\Bookmark;
use App\Models\Feedback;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user() ?? User::where('role', 'student')->first() ?? User::first();
        
        $userRole = $user->role ?? 'student';

        // Role-based personalization data
        $rolePersonalization = match ($userRole) {
            'student' => [
                'tagline' => 'Explore Paths & Build Foundational Skills',
                'focus' => 'Take career quizzes, discover university pathways, and bookmark high-demand job profiles.',
                'action_label' => 'Take Interest Assessment',
                'action_route' => route('quiz.index'),
                'recommended_domain' => 'Software Engineering',
            ],
            'graduate' => [
                'tagline' => 'Accelerate Industry Entry & Interview Prep',
                'focus' => 'Download resume templates, review interview cheat sheets, and target entry-level positions.',
                'action_label' => 'Download Resume Toolkits',
                'action_route' => route('resources.index'),
                'recommended_domain' => 'Cloud & Infrastructure',
            ],
            'professional' => [
                'tagline' => 'Level Up, Pivot & Benchmark Salaries',
                'focus' => 'Analyze executive compensation benchmarks, advanced certifications, and transition trajectories.',
                'action_label' => 'Explore High-Yield Careers',
                'action_route' => route('careers.index'),
                'recommended_domain' => 'Artificial Intelligence & Data',
            ],
            default => [
                'tagline' => 'Platform Administration & Overview',
                'focus' => 'Monitor user registrations, manage career profiles, multimedia, and feedback.',
                'action_label' => 'Manage Career Bank',
                'action_route' => route('careers.index'),
                'recommended_domain' => 'Software Engineering',
            ]
        };

        $stats = [
            'total_careers' => Career::count(),
            'total_multimedia' => Multimedia::count(),
            'total_resources' => Resource::count(),
            'total_quiz_questions' => QuizQuestion::count(),
            'total_bookmarks' => Bookmark::where('user_id', $user?->id)->count(),
        ];

        $bookmarks = Bookmark::where('user_id', $user?->id)->latest()->get();
        $quizAttempts = QuizAttempt::where('user_id', $user?->id)->with('answers')->latest()->get();
        $latestAttempt = $quizAttempts->first();
        $recentCareers = Career::latest()->take(3)->get();
        $recentMultimedia = Multimedia::latest()->take(3)->get();
        $recentResources = Resource::latest()->take(3)->get();
        $stories = SuccessStory::latest()->take(2)->get();

        $totalUsers = User::count();
        $recentUsers = User::latest()->take(6)->get();
        $allUsers = User::latest()->get();
        $allCareers = Career::latest()->get();
        $allMultimedia = Multimedia::latest()->get();
        $allResources = Resource::latest()->get();
        $allFeedbacks = Feedback::with(['user', 'responder'])->latest()->get();

        return view('dashboard', compact(
            'user',
            'userRole',
            'rolePersonalization',
            'stats',
            'bookmarks',
            'quizAttempts',
            'latestAttempt',
            'recentCareers',
            'recentMultimedia',
            'recentResources',
            'stories',
            'totalUsers',
            'recentUsers',
            'allUsers',
            'allCareers',
            'allMultimedia',
            'allResources',
            'allFeedbacks'
        ));
    }
}
