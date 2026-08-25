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
        $userFeedbacks = Feedback::where('user_id', $user?->id)->with('responder')->latest()->get();
        $allStories = SuccessStory::with(['author', 'user'])->latest()->get();
        $pendingStories = SuccessStory::with(['author', 'user'])->whereIn('status', ['pending', 'pending_review', 'draft'])->latest()->get();

        // 1. Dynamic System Intelligence: Recently Viewed Careers (DB & Session)
        $recentlyViewedIds = [];
        if ($user) {
            $recentlyViewedIds = \App\Models\RecentlyViewed::where('user_id', $user->id)
                ->where('viewable_type', Career::class)
                ->orderByDesc('viewed_at')
                ->take(6)
                ->pluck('viewable_id')
                ->toArray();
        }
        if (empty($recentlyViewedIds)) {
            $recentlyViewedIds = session()->get('recently_viewed_careers', []);
        }

        $recentlyViewedCareers = collect();
        if (!empty($recentlyViewedIds)) {
            $careersMap = Career::whereIn('id', $recentlyViewedIds)->get()->keyBy('id');
            foreach ($recentlyViewedIds as $rId) {
                if (isset($careersMap[$rId])) {
                    $recentlyViewedCareers->push($careersMap[$rId]);
                }
            }
        }

        // 2. Dynamic Suggestion Engine ("Because you liked X...")
        $bookmarkedCareerId = $bookmarks->firstWhere('item_type', 'career')?->item_id;
        $anchorCareer = null;
        if ($bookmarkedCareerId) {
            $anchorCareer = Career::find($bookmarkedCareerId);
        }
        if (!$anchorCareer && $recentlyViewedCareers->isNotEmpty()) {
            $anchorCareer = $recentlyViewedCareers->first();
        }
        if (!$anchorCareer) {
            $anchorCareer = Career::where('domain', $rolePersonalization['recommended_domain'])->first() ?? Career::first();
        }

        $suggestedCareers = collect();
        if ($anchorCareer) {
            $excludeIds = array_filter(array_merge([$anchorCareer->id], $bookmarks->where('item_type', 'career')->pluck('item_id')->toArray()));
            
            $skills = array_filter(array_map('trim', explode(',', $anchorCareer->required_skills ?? '')));
            
            $query = Career::whereNotIn('id', $excludeIds);
            $query->where(function($q) use ($anchorCareer, $skills) {
                $q->where('domain', $anchorCareer->domain);
                foreach (array_slice($skills, 0, 3) as $skill) {
                    $q->orWhere('required_skills', 'like', "%{$skill}%");
                }
            });
            
            $suggestedCareers = $query->take(3)->get();
            
            if ($suggestedCareers->count() < 3) {
                $extra = Career::whereNotIn('id', array_merge($excludeIds, $suggestedCareers->pluck('id')->toArray()))
                    ->take(3 - $suggestedCareers->count())
                    ->get();
                $suggestedCareers = $suggestedCareers->concat($extra);
            }
        }

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
            'allFeedbacks',
            'userFeedbacks',
            'allStories',
            'pendingStories',
            'recentlyViewedCareers',
            'anchorCareer',
            'suggestedCareers'
        ));
    }
}
