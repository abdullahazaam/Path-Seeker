<?php

namespace Tests\Feature;

use App\Models\Bookmark;
use App\Models\Career;
use App\Models\ContentProgress;
use App\Models\Multimedia;
use App\Models\Rating;
use App\Models\Resource;
use App\Models\ShareToken;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Phase7And8ComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_multimedia_transcripts_and_related_content(): void
    {
        $media = Multimedia::create([
            'title' => 'Advanced Cloud Architecture 2026',
            'description' => 'Deep dive into Kubernetes and multi-region resilience.',
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'domain' => 'Cloud & Infrastructure',
            'transcript' => 'In this session, we dissect multi-region failover and service meshes.',
        ]);

        $res = $this->get(route('multimedia.show', $media->id));
        $res->assertStatus(200);
        $res->assertSee('Advanced Cloud Architecture 2026', false);
    }

    public function test_five_star_ratings_unique_constraint(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $resource = Resource::first();

        // 1. Initial Rating
        $this->actingAs($student)->post(route('resources.rate', $resource->id), [
            'rating' => 5,
            'review' => 'Exceptional system design cheat sheet!',
        ])->assertRedirect();

        $this->assertEquals(1, Rating::where('user_id', $student->id)->where('rateable_id', $resource->id)->count());
        $rating = Rating::where('user_id', $student->id)->where('rateable_id', $resource->id)->first();
        $this->assertEquals(5, $rating->rating);

        // 2. Updated Rating by same user (Unique constraint prevents duplicate rows)
        $this->actingAs($student)->post(route('resources.rate', $resource->id), [
            'rating' => 4,
            'review' => 'Updated review note.',
        ])->assertRedirect();

        $this->assertEquals(1, Rating::where('user_id', $student->id)->where('rateable_id', $resource->id)->count());
        $rating->refresh();
        $this->assertEquals(4, $rating->rating);
    }

    public function test_content_progress_deduplication(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $media = Multimedia::first();

        // 1. Save 50% progress
        $this->actingAs($student)->postJson(route('multimedia.progress', $media->id), [
            'progress_percent' => 50,
        ])->assertStatus(200);

        $this->assertEquals(1, ContentProgress::where('user_id', $student->id)->where('content_id', $media->id)->count());

        // 2. Update to 100% progress (completed)
        $this->actingAs($student)->postJson(route('multimedia.progress', $media->id), [
            'progress_percent' => 100,
            'completed' => true,
        ])->assertStatus(200);

        // Record count must remain 1
        $this->assertEquals(1, ContentProgress::where('user_id', $student->id)->where('content_id', $media->id)->count());
        $progress = ContentProgress::where('user_id', $student->id)->where('content_id', $media->id)->first();
        $this->assertEquals(100, $progress->progress_percent);
        $this->assertTrue($progress->completed);
    }

    public function test_safe_resource_downloads_and_preview(): void
    {
        $resource = Resource::create([
            'title' => '2026 AWS Cloud Blueprint',
            'category' => 'Resume Blueprints',
            'file_url' => '/storage/resources/pdfs/aws-solutions-architect-cheatsheet.pdf',
            'is_premium' => false,
            'download_count' => 0,
        ]);

        // 1. Preview Metadata Endpoint
        $previewRes = $this->get(route('resources.preview', $resource->id));
        $previewRes->assertStatus(200);
        $previewRes->assertJsonFragment(['title' => '2026 AWS Cloud Blueprint']);
        $previewRes->assertJsonStructure(['stream_url', 'download_url']);

        // 2. Stream Endpoint (Physical File / Dynamic Fallback)
        $streamRes = $this->get(route('resources.stream', $resource->id));
        $streamRes->assertStatus(200);
        $streamRes->assertHeader('content-type', 'application/pdf');

        // 3. Fallback Test with missing file
        $fallbackRes = Resource::create([
            'title' => 'Fallback Missing PDF Blueprint',
            'category' => 'Systems',
            'file_url' => '/storage/resources/pdfs/non_existent_file_9999.pdf',
        ]);
        $fallbackStream = $this->get(route('resources.stream', $fallbackRes->id));
        $fallbackStream->assertStatus(200);
        $fallbackStream->assertHeader('content-type', 'application/pdf');

        // 4. Safe Local Storage PDF Download
        $downloadRes = $this->get(route('resources.download', $resource->id));
        $downloadRes->assertStatus(200);
        $downloadRes->assertHeader('content-type', 'application/pdf');

        $resource->refresh();
        $this->assertEquals(1, $resource->download_count);

        // 3. Admin PDF Upload Test
        $admin = User::where('role', 'admin')->first() ?? User::create([
            'name' => 'Admin User',
            'email' => 'admin_test@pathseeker.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $pdfFile = \Illuminate\Http\UploadedFile::fake()->create('custom_guide.pdf', 100, 'application/pdf');

        $uploadRes = $this->actingAs($admin)->post('/admin/resources', [
            'title' => 'Custom Uploaded Guide',
            'category' => 'Custom Guides',
            'pdf_file' => $pdfFile,
        ]);

        $uploadRes->assertRedirect('/dashboard?tab=resources');
        $this->assertDatabaseHas('resources', [
            'title' => 'Custom Uploaded Guide',
            'category' => 'Custom Guides',
        ]);
    }

    public function test_bookmark_crud_and_private_notes(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $career = Career::first();

        // 1. Create Bookmark with Private Note
        $this->actingAs($student)->post(route('bookmarks.store'), [
            'item_type' => 'career',
            'item_id' => $career->id,
            'notes' => 'Review distributed systems chapter before tech screening.',
        ])->assertRedirect();

        $bm = Bookmark::where('user_id', $student->id)->where('item_id', $career->id)->first();
        $this->assertNotNull($bm);
        $this->assertEquals('Review distributed systems chapter before tech screening.', $bm->notes);

        // 2. Update Private Note
        $this->actingAs($student)->put(route('bookmarks.update', $bm->id), [
            'notes' => 'Completed LeetCode system design patterns.',
        ])->assertRedirect();

        $bm->refresh();
        $this->assertEquals('Completed LeetCode system design patterns.', $bm->notes);

        // 3. Delete Bookmark
        $this->actingAs($student)->delete(route('bookmarks.destroy', $bm->id))->assertRedirect();
        $this->assertNull(Bookmark::find($bm->id));
    }

    public function test_privacy_safe_sharing_does_not_leak_sensitive_fields(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();

        // 1. Generate Opaque Share Token
        $tokenRes = $this->actingAs($student)->getJson(route('passport.share-link'));
        $tokenRes->assertStatus(200);
        $token = $tokenRes->json('token');
        $this->assertNotEmpty($token);

        // 2. Public Access to Shared Passport (Guest View)
        auth()->logout();
        $publicRes = $this->get(route('passport.shared', $token));
        $publicRes->assertStatus(200);
        $publicRes->assertSee($student->name, false);

        // 3. Strict Privacy: Sensitive user data MUST NEVER be in response
        $publicRes->assertDontSee($student->email, false);
        $publicRes->assertDontSee($student->password, false);
        $publicRes->assertDontSee('password_reset_tokens', false);
    }

    public function test_rate_limited_pdf_export(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();

        $res = $this->actingAs($student)->get(route('passport.export-pdf'));
        $res->assertStatus(200);
        $res->assertSee('VERIFIED CAREER PASSPORT', false);
        $res->assertSee($student->name, false);
        $res->assertDontSee($student->email, false);
    }

    public function test_ajax_bookmark_toggle_and_career_card_rendering(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $career = Career::first();

        // 1. Unauthenticated request to toggle must return 401 JSON
        $guestRes = $this->postJson(route('bookmarks.toggle'), [
            'item_type' => 'career',
            'item_id' => $career->id,
        ]);
        $guestRes->assertStatus(401);

        // 2. Authenticated user toggles bookmark ON
        $toggleOnRes = $this->actingAs($student)->postJson(route('bookmarks.toggle'), [
            'item_type' => 'career',
            'item_id' => $career->id,
        ]);
        $toggleOnRes->assertStatus(200);
        $toggleOnRes->assertJsonFragment(['success' => true, 'bookmarked' => true]);
        $this->assertDatabaseHas('bookmarks', [
            'user_id' => $student->id,
            'item_type' => 'career',
            'item_id' => $career->id,
        ]);

        // 3. Career Bank index page renders active bookmark state for user
        $careerRes = $this->actingAs($student)->get(route('careers.index'));
        $careerRes->assertStatus(200);
        $careerRes->assertSee('btn-bookmark-' . $career->id);
        $careerRes->assertSee('data-bookmarked="true"', false);

        // 4. Authenticated user toggles bookmark OFF
        $toggleOffRes = $this->actingAs($student)->postJson(route('bookmarks.toggle'), [
            'item_type' => 'career',
            'item_id' => $career->id,
        ]);
        $toggleOffRes->assertStatus(200);
        $toggleOffRes->assertJsonFragment(['success' => true, 'bookmarked' => false]);
        $this->assertDatabaseMissing('bookmarks', [
            'user_id' => $student->id,
            'item_type' => 'career',
            'item_id' => $career->id,
        ]);
    }
}
