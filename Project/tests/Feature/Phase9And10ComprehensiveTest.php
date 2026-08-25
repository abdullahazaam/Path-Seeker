<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\QuizAttempt;
use App\Models\QuizQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class Phase9And10ComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_seo_structured_data_and_visible_sitemap_link(): void
    {
        $res = $this->get('/');
        $res->assertStatus(200);

        // Verify Schema.org structured data
        $res->assertSee('https://schema.org', false);
        $res->assertSee('SoftwareApplication', false);

        // Verify Visible XML Sitemap Link
        $res->assertSee('XML Sitemap', false);
        $res->assertSee('/sitemap.xml', false);
    }

    public function test_system_health_check_endpoint(): void
    {
        $res = $this->get('/api/health');
        $res->assertStatus(200);
        $res->assertJsonFragment([
            'status' => 'healthy',
            'database' => 'connected',
        ]);
    }

    public function test_secure_file_upload_and_threat_defense(): void
    {
        Storage::fake('local');
        $student = User::where('email', 'student@pathseeker.com')->first();

        // 1. Valid PDF upload succeeds with random filename
        $validPdf = UploadedFile::fake()->create('candidate_cv.pdf', 1200, 'application/pdf');
        $uploadRes = $this->actingAs($student)->postJson('/api/upload/resume', [
            'resume' => $validPdf,
        ]);
        $uploadRes->assertStatus(200);
        $uploadRes->assertJsonStructure(['success', 'filename', 'file_size']);

        $filename = $uploadRes->json('filename');
        $this->assertNotEquals('candidate_cv.pdf', $filename);
        $this->assertStringEndsWith('.pdf', $filename);

        // 2. Malicious PHP script upload blocked immediately
        $maliciousFile = UploadedFile::fake()->create('backdoor.php', 10, 'text/x-php');
        $badRes = $this->actingAs($student)->postJson('/api/upload/resume', [
            'resume' => $maliciousFile,
        ]);
        $this->assertTrue(in_array($badRes->getStatusCode(), [403, 422]));

        // 3. Oversized file (>5MB) rejected
        $hugeFile = UploadedFile::fake()->create('huge_portfolio.pdf', 6000, 'application/pdf');
        $hugeRes = $this->actingAs($student)->postJson('/api/upload/resume', [
            'resume' => $hugeFile,
        ]);
        $hugeRes->assertStatus(422);
    }

    public function test_full_e2e_candidate_journey(): void
    {
        // 1. Candidate Registration
        $regRes = $this->post('/register', [
            'name' => 'Alex Rivera',
            'email' => 'alex.rivera@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'graduate',
            'education_level' => 'Bachelor of Science in Software Engineering',
        ]);
        $regRes->assertRedirect(route('dashboard'));

        $user = User::where('email', 'alex.rivera@example.com')->first();
        $this->assertNotNull($user);

        // 2. Take and Submit Interest Assessment Quiz
        $questions = QuizQuestion::take(5)->get();
        $answers = [];
        foreach ($questions as $q) {
            $answers[$q->id] = 1; // Pick top option
        }

        $quizRes = $this->actingAs($user)->post(route('quiz.submit'), [
            'answers' => $answers,
            'idempotency_token' => 'e2e-token-' . uniqid(),
        ]);
        $quizRes->assertRedirect();

        $attempt = QuizAttempt::where('user_id', $user->id)->first();
        $this->assertNotNull($attempt);
        $this->assertNotEmpty($attempt->recommended_careers);

        // 3. User Dashboard Loads Personalized Recommendations & Stats
        $dashRes = $this->actingAs($user)->get(route('dashboard'));
        $dashRes->assertStatus(200);
        $dashRes->assertSee('Alex Rivera', false);

        // 4. Bookmark Recommended Career Track with Private Study Note
        $topCareer = Career::first();
        $this->actingAs($user)->post(route('bookmarks.store'), [
            'item_type' => 'career',
            'item_id' => $topCareer->id,
            'notes' => 'Priority goal for Q2 2026 tech interviews.',
        ])->assertRedirect();

        // 5. Generate Privacy-Safe PDF Passport
        $pdfRes = $this->actingAs($user)->get(route('passport.export-pdf'));
        $pdfRes->assertStatus(200);
        $pdfRes->assertSee('VERIFIED CAREER PASSPORT', false);
        $pdfRes->assertSee('Alex Rivera', false);
        $pdfRes->assertDontSee($user->email, false); // Strict privacy verification
    }
}
