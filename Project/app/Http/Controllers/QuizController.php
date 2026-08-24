<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestion;
use App\Models\Career;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $questions = QuizQuestion::all();
        return view('quiz.index', compact('questions'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $answers = $request->input('answers', []);
        $questions = QuizQuestion::all();

        $score = 0;
        $totalQuestions = $questions->count();
        $domainCounts = [
            'Software Engineering' => 0,
            'Cloud & Infrastructure' => 0,
            'Artificial Intelligence & Data' => 0,
            'Cybersecurity' => 0,
        ];

        // Domain mapping for options A, B, C, D
        $optionDomainMap = [
            'A' => 'Software Engineering',
            'B' => 'Cloud & Infrastructure',
            'C' => 'Artificial Intelligence & Data',
            'D' => 'Cybersecurity',
        ];

        $details = [];

        foreach ($questions as $question) {
            $userAns = $answers[$question->id] ?? null;
            $isCorrect = ($userAns === $question->correct_answer);

            if ($isCorrect) {
                $score++;
            }

            if ($userAns && isset($optionDomainMap[$userAns])) {
                $domainCounts[$optionDomainMap[$userAns]]++;
            }

            $details[] = [
                'question' => $question->question_text,
                'user_answer' => $userAns,
                'correct_answer' => $question->correct_answer,
                'is_correct' => $isCorrect,
                'options' => $question->options,
            ];
        }

        // Determine top aligned domain
        arsort($domainCounts);
        $recommendedDomain = array_key_first($domainCounts) ?? 'Software Engineering';

        // Fetch careers in the recommended domain or top careers
        $recommendedCareers = Career::where('domain', 'like', "%{$recommendedDomain}%")->get();
        if ($recommendedCareers->isEmpty()) {
            $recommendedCareers = Career::take(3)->get();
        }

        return view('quiz.result', compact(
            'score',
            'totalQuestions',
            'recommendedDomain',
            'recommendedCareers',
            'details',
            'domainCounts'
        ));
    }
}
