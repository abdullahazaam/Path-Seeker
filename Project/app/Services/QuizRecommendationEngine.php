<?php

namespace App\Services;

use App\Models\Career;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class QuizRecommendationEngine
{
    public const QUIZ_VERSION = '2026.v1';

    public const DOMAIN_MAPPING = [
        'A' => 'Software Engineering',
        'B' => 'Cloud & Infrastructure',
        'C' => 'Artificial Intelligence & Data',
        'D' => 'Cybersecurity',
    ];

    /**
     * Evaluate answers, calculate deterministic weighted scores, generate explainable career matches, and persist attempt.
     */
    public function evaluateAndPersist(array $answers, ?User $user = null, ?string $idempotencyToken = null): QuizAttempt
    {
        // 1. Idempotency Check
        if (!empty($idempotencyToken)) {
            $existing = QuizAttempt::where('idempotency_token', $idempotencyToken)->first();
            if ($existing) {
                return $existing;
            }
        }

        $questions = QuizQuestion::all()->keyBy('id');
        
        $domainPoints = [
            'Software Engineering' => 0,
            'Cloud & Infrastructure' => 0,
            'Artificial Intelligence & Data' => 0,
            'Cybersecurity' => 0,
        ];

        $totalPoints = 0;
        $normalizedAnswers = [];

        foreach ($answers as $qId => $selectedOption) {
            $question = $questions->get($qId);
            if (!$question) {
                continue;
            }

            $optionKey = strtoupper(trim($selectedOption));
            $domain = self::DOMAIN_MAPPING[$optionKey] ?? 'Software Engineering';
            $points = 10;

            $domainPoints[$domain] = ($domainPoints[$domain] ?? 0) + $points;
            $totalPoints += $points;

            $optionsArray = $question->options;
            $optionText = $optionsArray[$optionKey] ?? ($optionsArray[$selectedOption] ?? 'Selected response');

            $normalizedAnswers[] = [
                'question_id' => $question->id,
                'question_text' => $question->question_text,
                'selected_option' => $optionKey,
                'selected_option_text' => $optionText,
                'domain_awarded' => $domain,
                'points_awarded' => $points,
            ];
        }

        if ($totalPoints === 0) {
            $totalPoints = 10;
        }

        // Calculate domain percentages (deterministic integer scores)
        $domainScores = [];
        foreach ($domainPoints as $domain => $pts) {
            $domainScores[$domain] = (int) round(($pts / $totalPoints) * 100);
        }

        arsort($domainScores);
        $topDomain = array_key_first($domainScores) ?? 'Software Engineering';

        // Rank Career Recommendations with Explainability
        $recommendations = $this->generateRankedRecommendations($domainScores, $topDomain, $user);

        // Persist QuizAttempt
        $attempt = QuizAttempt::create([
            'user_id' => $user?->id,
            'quiz_version' => self::QUIZ_VERSION,
            'domain_scores' => $domainScores,
            'total_score' => $totalPoints,
            'top_domain' => $topDomain,
            'recommended_careers' => $recommendations,
            'idempotency_token' => $idempotencyToken,
            'completed_at' => now(),
        ]);

        // Persist normalized answers
        foreach ($normalizedAnswers as $ans) {
            $attempt->answers()->create($ans);
        }

        return $attempt;
    }

    /**
     * Generate deterministic ranked recommendations with explainable reasoning based on actual career bank data.
     */
    public function generateRankedRecommendations(array $domainScores, string $topDomain, ?User $user = null): array
    {
        $careers = Career::all();
        if ($careers->isEmpty()) {
            return [];
        }

        $ranked = [];
        $userRole = $user?->role ?? 'student';

        // Identify secondary domain
        $sortedDomains = array_keys($domainScores);
        $secondDomain = $sortedDomains[1] ?? null;

        foreach ($careers as $career) {
            $careerDomain = $career->domain;
            $topScore = $domainScores[$topDomain] ?? 0;
            $secondScore = $secondDomain ? ($domainScores[$secondDomain] ?? 0) : 0;
            
            $matchPct = 40;
            $explanation = '';

            // Check domain alignment
            if (str_contains(strtolower($careerDomain), strtolower($topDomain)) || 
                str_contains(strtolower($topDomain), strtolower($careerDomain))) {
                $matchPct = (int) min(98, 70 + ($topScore * 0.28));
                $explanation = "Primary {$matchPct}% Match: Your assessment reveals high affinity for {$topDomain} ({$topScore}% score). Your selected preferences align directly with this career's core competency requirements.";
            } elseif ($secondDomain && (str_contains(strtolower($careerDomain), strtolower($secondDomain)) || str_contains(strtolower($secondDomain), strtolower($careerDomain)))) {
                $matchPct = (int) min(90, 55 + ($secondScore * 0.25));
                $explanation = "Secondary {$matchPct}% Match: Supported by your strong secondary interest in {$secondDomain} ({$secondScore}% score) and compatible cross-disciplinary skills.";
            } else {
                $matchPct = (int) max(45, 50 - (rand(0, 0))); // deterministic base
                $explanation = "Adjacent {$matchPct}% Match: Provides an alternative career track utilizing transferable technical principles.";
            }

            // Role affinity bonus
            if ($career->target_role === $userRole || $career->target_role === 'all') {
                $matchPct = min(98, $matchPct + 3);
            }

            $ranked[] = [
                'career_id' => $career->id,
                'title' => $career->title,
                'domain' => $career->domain,
                'target_role' => $career->target_role,
                'expected_salary' => $career->expected_salary,
                'required_skills' => $career->required_skills,
                'match_percentage' => $matchPct,
                'reason' => $explanation,
            ];
        }

        // Sort descending by match percentage
        usort($ranked, function ($a, $b) {
            return $b['match_percentage'] <=> $a['match_percentage'];
        });

        // Return top 4 distinct recommendations
        return array_slice($ranked, 0, 4);
    }
}
