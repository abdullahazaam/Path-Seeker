<?php

namespace Tests\Feature;

use App\Models\Career;
use App\Models\Feedback;
use App\Models\SuccessStory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class Phase5And6ComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_enterprise_security_headers_and_csp_enforcement(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Verify CSP Header & essential directives
        $this->assertTrue($response->headers->has('Content-Security-Policy'));
        $csp = $response->headers->get('Content-Security-Policy');
        $this->assertStringContainsString("default-src 'self'", $csp);
        $this->assertStringContainsString('https://www.youtube.com', $csp);
        $this->assertStringContainsString('https://cdn.tailwindcss.com', $csp);
        $this->assertStringContainsString("object-src 'none'", $csp);

        // Verify standard security headers
        $this->assertEquals('strict-origin-when-cross-origin', $response->headers->get('Referrer-Policy'));
        $this->assertEquals('nosniff', $response->headers->get('X-Content-Type-Options'));
        $this->assertEquals('SAMEORIGIN', $response->headers->get('X-Frame-Options'));
        $this->assertStringContainsString('camera=()', $response->headers->get('Permissions-Policy'));

        // Obsolete X-XSS-Protection should not be present
        $this->assertFalse($response->headers->has('X-XSS-Protection'));
    }

    public function test_password_reset_workflow(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $this->assertNotNull($student);

        // 1. Request Reset Link
        $reqRes = $this->post(route('password.email'), [
            'email' => 'student@pathseeker.com',
        ]);
        $reqRes->assertSessionHas('status');

        $record = DB::table('password_reset_tokens')->where('email', 'student@pathseeker.com')->first();
        $this->assertNotNull($record);

        // 2. Perform Reset
        $plainToken = Str::random(60);
        DB::table('password_reset_tokens')->where('email', 'student@pathseeker.com')->update([
            'token' => Hash::make($plainToken),
        ]);

        $resetRes = $this->post(route('password.update'), [
            'token' => $plainToken,
            'email' => 'student@pathseeker.com',
            'password' => 'newstudentpass123',
            'password_confirmation' => 'newstudentpass123',
        ]);
        $resetRes->assertRedirect(route('login'));

        // 3. Authenticate with new password
        $this->assertTrue(Auth::attempt([
            'email' => 'student@pathseeker.com',
            'password' => 'newstudentpass123',
        ]));
    }

    public function test_strict_server_side_admin_authorization_rejects_non_admin(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $pro = User::where('email', 'pro@pathseeker.com')->first();
        $career = Career::first();
        $story = SuccessStory::first();
        $feedback = Feedback::create([
            'user_id' => $student->id,
            'category' => 'bug',
            'message' => 'Test auth feedback',
            'status' => 'open',
        ]);

        // Student attempting Admin mutations must receive 403 Forbidden
        $this->actingAs($student)->post(route('admin.careers.store'), [
            'title' => 'Unauthorized Career',
            'description' => 'Test',
            'domain' => 'Test',
            'required_skills' => 'Test',
            'expected_salary' => '$100,000',
        ])->assertStatus(403);

        $this->actingAs($student)->put(route('admin.careers.update', $career->id), [
            'title' => 'Hacked Career Title',
        ])->assertStatus(403);

        $this->actingAs($student)->delete(route('admin.careers.destroy', $career->id))->assertStatus(403);

        $this->actingAs($pro)->post(route('admin.users.store'), [
            'name' => 'Fake Admin',
            'email' => 'fake@admin.com',
            'password' => 'pass123',
            'role' => 'admin',
        ])->assertStatus(403);

        $this->actingAs($pro)->post(route('admin.stories.moderate', $story->id), [
            'status' => 'approved',
        ])->assertStatus(403);

        $this->actingAs($pro)->post(route('admin.feedback.respond', $feedback->id), [
            'status' => 'resolved',
            'admin_response' => 'Unauthorized reply',
        ])->assertStatus(403);
    }

    public function test_career_autocomplete_api_and_indexed_search(): void
    {
        $res = $this->get('/api/careers/autocomplete?q=Full');
        $res->assertStatus(200);
        $res->assertJsonStructure([
            '*' => ['id', 'title', 'domain', 'target_role', 'expected_salary', 'confidence_level'],
        ]);
        $res->assertSee('Full-Stack', false);
    }

    public function test_career_intelligence_metadata_and_advanced_filtering(): void
    {
        $career = Career::where('title', 'like', '%AI & Machine Learning%')->first();
        $this->assertNotNull($career);

        // Verify explicit intelligence metadata columns populated
        $this->assertEquals('USD', $career->currency);
        $this->assertEquals('Verified High Confidence', $career->confidence_level);
        $this->assertNotEmpty($career->salary_source_name);
        $this->assertNotEmpty($career->source_url);

        // Verify advanced filtering on career index
        $res = $this->get('/careers?domain=Software+Engineering&role=student&sort=title_asc');
        $res->assertStatus(200);
        $res->assertSee('Software Engineering', false);

        // Verify detail page displays explicit intelligence metadata
        $detailRes = $this->get(route('careers.show', $career->id));
        $detailRes->assertStatus(200);
        $detailRes->assertSee($career->salary_source_name, false);
        $detailRes->assertSee('Verified High Confidence', false);
    }
}
