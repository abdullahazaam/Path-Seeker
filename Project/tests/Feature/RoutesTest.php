<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Career;
use App\Models\Multimedia;
use App\Models\QuizQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_loads_successfully(): void
    {
        $r = $this->get('/');
        $r->assertStatus(200);
        $r->assertSee('PathSeeker');
    }

    public function test_guest_is_redirected_from_protected_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_user_can_register_with_role_and_profile_created(): void
    {
        $r = $this->post('/register', [
            'name' => 'Jane Test',
            'email' => 'jane.test@pathseeker.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'role' => 'graduate',
            'education_level' => 'Bachelor of IT',
            'interests' => 'Cloud, DevOps',
        ]);
        // 1. Mandatory redirect to email verification notice
        $r->assertRedirect(route('verification.notice'));
        $this->assertAuthenticated();
        
        $u = User::where('email', 'jane.test@pathseeker.com')->first();
        $this->assertNotNull($u);
        $this->assertEquals('graduate', $u->role);
        $this->assertNotNull($u->profile);
        $this->assertEquals('Bachelor of IT', $u->profile->education_level);
        $this->assertFalse($u->hasVerifiedEmail());

        // 2. Unverified user visiting dashboard is redirected to verification notice
        $dashBlocked = $this->actingAs($u)->get('/dashboard');
        $dashBlocked->assertRedirect(route('verification.notice'));

        // 3. Verification notice renders correctly
        $verifyNotice = $this->actingAs($u)->get(route('verification.notice'));
        $verifyNotice->assertStatus(200);
        $verifyNotice->assertSee('Verify Your Email Address');

        // 4. Once verified, access to dashboard is granted
        $u->markEmailAsVerified();
        $dashAllowed = $this->actingAs($u)->get('/dashboard');
        $dashAllowed->assertStatus(200);
    }

    public function test_forgot_password_flow_and_login_link(): void
    {
        // 1. Login page contains Forgot Password link
        $loginRes = $this->get('/login');
        $loginRes->assertStatus(200);
        $loginRes->assertSee('Forgot Password?');
        $loginRes->assertSee(route('password.request'));

        // 2. Forgot password request page renders
        $forgotRes = $this->get(route('password.request'));
        $forgotRes->assertStatus(200);
        $forgotRes->assertSee('Reset Password');
        $forgotRes->assertSee('Send Reset Link');
    }

    public function test_user_can_login_and_access_personalized_dashboard(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $r = $this->post('/login', ['email' => 'student@pathseeker.com', 'password' => 'student123']);
        $r->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($student);
        $dash = $this->actingAs($student)->get('/dashboard');
        $dash->assertStatus(200);
        $dash->assertSee('Alex Rivera');
        $dash->assertSee('Personalized for Students');
    }

    public function test_career_search_and_domain_filtering(): void
    {
        $this->get('/careers?search=Laravel')->assertStatus(200)->assertSee('Full-Stack Web Developer');
        $this->get('/careers?domain=Cloud+%26+Infrastructure')->assertStatus(200)->assertSee('Cloud Solutions Architect');
        
        // Test role-based filtering
        $this->get('/careers?role=student')->assertStatus(200)->assertSee('Full-Stack Web Developer');
        $this->get('/careers?role=graduate')->assertStatus(200)->assertSee('AI & Machine Learning Engineer');
        $this->get('/careers?role=professional')->assertStatus(200)->assertSee('Distributed Backend & Systems Architect');
    }

    public function test_career_pagination_works_correctly(): void
    {
        $responsePage1 = $this->get('/careers');
        $responsePage1->assertStatus(200);
        $responsePage1->assertSee('Next');

        $responsePage2 = $this->get('/careers?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('Previous');
    }

    public function test_quiz_listing_and_submission(): void
    {
        $this->get('/quiz')->assertStatus(200)->assertSee('Career Interest', false);
        $answers = [];
        foreach (QuizQuestion::all() as $q) { $answers[$q->id] = 'A'; }
        $r = $this->post('/quiz/submit', ['answers' => $answers]);
        $r->assertRedirect();
        $resultsPage = $this->followRedirects($r);
        $resultsPage->assertStatus(200)->assertSee('Career Alignment', false)->assertSee('Software Engineering', false);
    }

    public function test_multimedia_pagination_and_detail_routing(): void
    {
        // 1. Check listing and pagination
        $list = $this->get('/multimedia');
        $list->assertStatus(200);
        $list->assertSee('Multimedia Center');
        $list->assertSee('Next');

        // 2. Test search and filtering
        $search = $this->get('/multimedia?search=React');
        $search->assertStatus(200);

        $filterType = $this->get('/multimedia?type=video');
        $filterType->assertStatus(200);

        // 3. Check exact detail routing matching
        $firstItem = Multimedia::first();
        $detail = $this->get("/multimedia/{$firstItem->id}");
        $detail->assertStatus(200);
        $detail->assertSee($firstItem->title);
        $detail->assertSee($firstItem->url);
        if ($firstItem->description) {
            $detail->assertSee($firstItem->description);
        }
    }

    public function test_resources_load(): void
    {
        $r = $this->get('/resources');
        $r->assertStatus(200);
        $r->assertSee('Resource Library');
        $r->assertSee('Download Toolkit');
        $r->assertSee('Next');

        // Test search and category filtering
        $search = $this->get('/resources?search=System');
        $search->assertStatus(200);
    }

    public function test_chatbot_endpoint_returns_real_time_ai_guidance(): void
    {
        $response = $this->postJson('/chat/message', [
            'message' => 'Tell me about Full-Stack Web Developer salary and requirements',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['status', 'reply', 'source'])
                 ->assertJson(['status' => 'success']);

        $this->assertStringContainsString('Full-Stack Web Developer', $response->json('reply'));
    }

    public function test_sitemap_xml_endpoint_generates_valid_schema(): void
    {
        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $content = $response->getContent();
        $this->assertStringContainsString('<?xml version="1.0" encoding="UTF-8"?>', $content);
        $this->assertStringContainsString('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', $content);
        $this->assertStringContainsString('/careers', $content);
        $this->assertStringContainsString('/quiz', $content);
        $this->assertStringContainsString('/multimedia', $content);
        $this->assertStringContainsString('/resources', $content);
    }

    public function test_security_backdoor_route_is_removed(): void
    {
        $this->get('/fix-admin-password')->assertStatus(404);
    }

    public function test_security_non_admin_cannot_mutate_resources(): void
    {
        // 1. Guest cannot POST to careers or admin endpoints
        $this->post('/careers', ['title' => 'Hacker Career'])->assertRedirect('/login');
        $this->post('/admin/careers', ['title' => 'Hacker Career'])->assertRedirect('/login');

        // 2. Student cannot access admin endpoints
        $student = User::where('email', 'student@pathseeker.com')->first();
        $this->actingAs($student)->post('/admin/careers', ['title' => 'Hacker Career'])->assertStatus(403);
        $this->actingAs($student)->delete('/admin/users/1')->assertStatus(403);
    }

    public function test_security_strict_authentication_rejects_wrong_passwords(): void
    {
        $r = $this->post('/login', [
            'email' => 'admin@pathseeker.com',
            'password' => 'wrongpassword123',
        ]);
        $r->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_user_profile_edit_and_update_lifecycle(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();

        // 1. Guest is redirected
        $this->get('/profile')->assertRedirect('/login');

        // 2. Auth user views profile edit screen
        $res = $this->actingAs($student)->get('/profile');
        $res->assertStatus(200);
        $res->assertSee('Personal &amp; Academic Credentials', false);
        $res->assertSee($student->email);

        // 3. User updates profile details
        $updateRes = $this->actingAs($student)->put('/profile', [
            'name' => 'Alex Rivera Updated',
            'email' => 'student@pathseeker.com',
            'education_level' => 'Senior Computer Science Undergraduate',
            'interests' => 'Distributed Cloud Systems, Generative AI',
            'skills' => 'Laravel, PHP, Vue.js, Docker, PostgreSQL',
            'work_experience' => 'Full-Stack Software Engineering Intern at TechLabs (2024)',
        ]);
        $updateRes->assertRedirect('/profile');
        $updateRes->assertSessionHas('success');

        $this->assertDatabaseHas('users', [
            'id' => $student->id,
            'name' => 'Alex Rivera Updated',
        ]);

        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $student->id,
            'education_level' => 'Senior Computer Science Undergraduate',
            'skills' => 'Laravel, PHP, Vue.js, Docker, PostgreSQL',
            'work_experience' => 'Full-Stack Software Engineering Intern at TechLabs (2024)',
        ]);
    }

    public function test_homepage_renders_dynamic_digital_id_for_guest_and_user(): void
    {
        // 1. Guest views homepage - sees guest digital ID placeholder
        $guestRes = $this->get('/');
        $guestRes->assertStatus(200);
        $guestRes->assertSee('PS-2026-DEMO');
        $guestRes->assertSee('Guest Visitor');
        $guestRes->assertSee('Guest Mode');

        // 2. Auth user views homepage - sees dynamic user digital ID and metrics
        $student = User::where('email', 'student@pathseeker.com')->first();
        $authRes = $this->actingAs($student)->get('/');
        $authRes->assertStatus(200);
        $authRes->assertSee('PS-2026-' . str_pad($student->id, 4, '0', STR_PAD_LEFT));
        $authRes->assertSee($student->name);
        $authRes->assertSee('Verified ID');
    }

    public function test_visual_sitemap_loads_successfully(): void
    {
        $response = $this->get('/sitemap');
        $response->assertStatus(200);
        $response->assertSee('Visual Platform');
        $response->assertSee('Platform Navigation Blueprint');
        $response->assertSee('Software Engineering');
    }

    public function test_user_can_upload_and_download_resume(): void
    {
        \Illuminate\Support\Facades\Storage::fake('public');

        $student = User::where('email', 'student@pathseeker.com')->first();
        $file = \Illuminate\Http\UploadedFile::fake()->create('alex_rivera_resume.pdf', 150, 'application/pdf');

        $res = $this->actingAs($student)->put('/profile', [
            'name' => 'Alex Rivera',
            'email' => 'student@pathseeker.com',
            'resume' => $file,
        ]);

        $res->assertRedirect('/profile');
        $res->assertSessionHas('success');

        $student->refresh();
        $this->assertNotNull($student->profile->resume_path);
        $this->assertEquals('alex_rivera_resume.pdf', $student->profile->resume_filename);

        // Test download endpoint
        $downloadRes = $this->actingAs($student)->get('/profile/resume/download');
        $downloadRes->assertStatus(200);
    }

    public function test_dashboard_renders_recently_viewed_and_suggestion_engine(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $career = Career::first();

        // 1. Visit career detail to register recently viewed
        $this->actingAs($student)->get('/careers/' . $career->id);

        // 2. Open dashboard
        $res = $this->actingAs($student)->get('/dashboard');
        $res->assertStatus(200);
        $res->assertSee('Recently Viewed Careers');
        $res->assertSee('Because you liked');
        $res->assertSee($career->title);
    }
}