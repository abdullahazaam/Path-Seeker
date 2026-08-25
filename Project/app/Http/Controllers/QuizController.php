<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Services\QuizRecommendationEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function __construct(
        protected QuizRecommendationEngine $engine
    ) {}

    public function index()
    {
        $questions = QuizQuestion::all();
        $idempotencyToken = (string) Str::uuid();

        return view('quiz.index', compact('questions', 'idempotencyToken'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|array|min:1',
            'idempotency_token' => 'nullable|string',
        ]);

        $answers = $request->input('answers', []);
        $token = $request->input('idempotency_token');
        $user = Auth::user();

        $attempt = $this->engine->evaluateAndPersist($answers, $user, $token);

        if (!$user) {
            session(['guest_quiz_attempt_id' => $attempt->id]);
        }

        return redirect()->route('quiz.results', $attempt->id)->with('success', 'Career alignment evaluated successfully!');
    }

    public function results(int $id)
    {
        $attempt = QuizAttempt::with('answers')->findOrFail($id);

        // Strict Privacy: Users can only view their own attempts (admins can inspect all)
        if ($attempt->user_id) {
            if (!Auth::check() || (Auth::id() !== $attempt->user_id && Auth::user()->role !== 'admin')) {
                abort(403, 'Unauthorized access. You can only view your own assessment history.');
            }
        }

        $score = $attempt->total_score;
        $totalQuestions = $attempt->answers->count() ?: 6;
        $recommendedDomain = $attempt->top_domain;
        $recommendedCareers = $attempt->recommended_careers ?? [];
        $domainCounts = $attempt->domain_scores ?? [];
        $details = $attempt->answers;

        return view('quiz.result', compact(
            'attempt',
            'score',
            'totalQuestions',
            'recommendedDomain',
            'recommendedCareers',
            'details',
            'domainCounts'
        ));
    }
}
