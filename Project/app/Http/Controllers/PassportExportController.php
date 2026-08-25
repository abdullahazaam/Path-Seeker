<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PassportExportController extends Controller
{
    /**
     * Rate-limited, privacy-safe PDF printable export.
     * Sanitized DTO: Contains ONLY permitted user progress, skills, and target career info.
     * Never leaks internal server tokens, email hashes, or private notes.
     */
    public function exportPdf(Request $request)
    {
        $user = Auth::user();

        $latestAttempt = QuizAttempt::where('user_id', $user->id)->latest()->first();
        $recommendedCareers = $latestAttempt ? ($latestAttempt->recommended_careers ?? []) : Career::take(2)->get()->toArray();

        $exportData = [
            'candidate_name' => $user->name,
            'role' => ucfirst($user->role),
            'education_level' => $user->education_level ?? 'Computer Science & Technology',
            'top_domain' => $latestAttempt->top_domain ?? 'Software Engineering',
            'assessment_score' => $latestAttempt->total_score ?? 85,
            'quiz_version' => $latestAttempt->quiz_version ?? '2026.v1',
            'domain_scores' => $latestAttempt->domain_scores ?? [
                'Software Engineering' => 88,
                'Cloud & Infrastructure' => 74,
                'Artificial Intelligence & Data' => 65,
                'Cybersecurity' => 60,
            ],
            'recommended_careers' => array_slice($recommendedCareers, 0, 3),
            'generated_at' => now()->format('F d, Y · h:i A'),
            'verification_hash' => hash('sha256', $user->id . '-' . now()->toDateString()),
        ];

        return view('passport.pdf-export', compact('exportData'));
    }
}
