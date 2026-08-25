<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\User;
use App\Services\QuizRecommendationEngine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class QuizPhase3Test extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_quiz_index_provides_questions_and_fresh_idempotency_token(): void
    {
        $response = $this->get('/quiz');
        $response->assertStatus(200);
        $response->assertSee('Career Interest');
        $response->assertSee('idempotency_token');
    }

    public function test_deterministic_weighted_scoring_and_explainable_career_recommendations(): void
    {
        $engine = new QuizRecommendationEngine();
        $student = User::where('email', 'student@pathseeker.com')->first();
        
        $questions = QuizQuestion::all();
        $this->assertNotEmpty($questions);

        // Submit all 'C' (Artificial Intelligence & Data)
        $aiAnswers = [];
        foreach ($questions as $q) {
            $aiAnswers[$q->id] = 'C';
        }

        $attempt = $engine->evaluateAndPersist($aiAnswers, $student, (string) Str::uuid());

        $this->assertInstanceOf(QuizAttempt::class, $attempt);
        $this->assertEquals('Artificial Intelligence & Data', $attempt->top_domain);
        $this->assertEquals(QuizRecommendationEngine::QUIZ_VERSION, $attempt->quiz_version);
        $this->assertGreaterThan(0, $attempt->total_score);

        // Verify explainable recommendations persisted directly
        $this->assertNotEmpty($attempt->recommended_careers);
        $firstRec = $attempt->recommended_careers[0];
        $this->assertArrayHasKey('career_id', $firstRec);
        $this->assertArrayHasKey('title', $firstRec);
        $this->assertArrayHasKey('match_percentage', $firstRec);
        $this->assertArrayHasKey('reason', $firstRec);
        $this->assertStringContainsString('Artificial Intelligence & Data', $firstRec['reason']);

        // Verify normalized quiz answers persisted
        $this->assertEquals($questions->count(), $attempt->answers()->count());
        $firstAns = $attempt->answers()->first();
        $this->assertEquals('C', $firstAns->selected_option);
        $this->assertEquals('Artificial Intelligence & Data', $firstAns->domain_awarded);
        $this->assertEquals(10, $firstAns->points_awarded);
    }

    public function test_duplicate_submission_prevention_via_idempotency_token(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $token = 'test-token-' . Str::uuid();

        $questions = QuizQuestion::all();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 'A';
        }

        $initialCount = QuizAttempt::count();

        // First submission
        $res1 = $this->actingAs($student)->post('/quiz/submit', [
            'answers' => $answers,
            'idempotency_token' => $token,
        ]);
        $res1->assertRedirect();

        $attempt1 = QuizAttempt::where('idempotency_token', $token)->first();
        $this->assertNotNull($attempt1);
        $this->assertEquals($initialCount + 1, QuizAttempt::count());

        // Immediate duplicate submission (simulating double-click or network retry)
        $res2 = $this->actingAs($student)->post('/quiz/submit', [
            'answers' => $answers,
            'idempotency_token' => $token,
        ]);
        $res2->assertRedirect(route('quiz.results', $attempt1->id));

        // DB count must remain identical (zero duplicate rows)
        $this->assertEquals($initialCount + 1, QuizAttempt::count());
    }

    public function test_legitimate_retake_creates_fresh_separate_attempt_records(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $questions = QuizQuestion::all();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 'B';
        }

        $countBefore = QuizAttempt::where('user_id', $student->id)->count();

        // Attempt 1
        $this->actingAs($student)->post('/quiz/submit', [
            'answers' => $answers,
            'idempotency_token' => (string) Str::uuid(),
        ]);

        // Attempt 2 (Retake)
        $this->actingAs($student)->post('/quiz/submit', [
            'answers' => $answers,
            'idempotency_token' => (string) Str::uuid(),
        ]);

        $this->assertEquals($countBefore + 2, QuizAttempt::where('user_id', $student->id)->count());
    }

    public function test_strict_privacy_prevents_unauthorized_history_access(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $pro = User::where('email', 'pro@pathseeker.com')->first();

        $questions = QuizQuestion::all();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 'D';
        }

        $engine = new QuizRecommendationEngine();
        $attempt = $engine->evaluateAndPersist($answers, $student, (string) Str::uuid());

        // Student can view their own attempt
        $this->actingAs($student)->get(route('quiz.results', $attempt->id))->assertStatus(200);

        // Pro user cannot view Student's attempt (403 Forbidden)
        $this->actingAs($pro)->get(route('quiz.results', $attempt->id))->assertStatus(403);
    }

    public function test_user_dashboard_renders_past_quiz_history_and_recommendations(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        
        $engine = new QuizRecommendationEngine();
        $questions = QuizQuestion::all();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 'A';
        }
        $attempt = $engine->evaluateAndPersist($answers, $student, (string) Str::uuid());

        $response = $this->actingAs($student)->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Interest Assessment');
        $response->assertSee('History');
        $response->assertSee($attempt->top_domain);
        $response->assertSee('Version ' . $attempt->quiz_version);
    }
}
