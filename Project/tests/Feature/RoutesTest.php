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
        $r->assertRedirect('/dashboard');
        $this->assertAuthenticated();
        $u = User::where('email', 'jane.test@pathseeker.com')->first();
        $this->assertNotNull($u);
        $this->assertEquals('graduate', $u->role);
        $this->assertNotNull($u->profile);
        $this->assertEquals('Bachelor of IT', $u->profile->education_level);
    }

    public function test_user_can_login_and_access_personalized_dashboard(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $r = $this->post('/login', ['email' => 'student@pathseeker.com', 'password' => 'password123']);
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
        $r->assertStatus(200)->assertSee('Career Alignment', false)->assertSee('Software Engineering', false);
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
}