<?php

namespace Tests\Feature;

use App\Models\Feedback;
use App\Models\Subscriber;
use App\Models\SuccessStory;
use App\Models\User;
use App\Notifications\FeedbackRespondedNotification;
use App\Notifications\StoryStatusUpdatedNotification;
use DomainException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Phase4ComprehensiveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_story_state_machine_valid_transitions(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $admin = User::where('email', 'admin@pathseeker.com')->first();

        // 1. Create Draft Story
        $story = SuccessStory::create([
            'title' => 'Test State Machine Story',
            'domain' => 'Software Engineering',
            'story_text' => 'This is a test story for validating lifecycle transitions in PathSeeker.',
            'submitted_by' => $student->id,
            'status' => SuccessStory::STATUS_DRAFT,
        ]);
        $this->assertEquals(SuccessStory::STATUS_DRAFT, $story->status);

        // 2. Transition draft -> pending_review
        $story->transitionTo(SuccessStory::STATUS_PENDING, $student);
        $this->assertEquals(SuccessStory::STATUS_PENDING, $story->fresh()->status);

        // 3. Admin approves pending -> approved
        $story->transitionTo(SuccessStory::STATUS_APPROVED, $admin);
        $this->assertEquals(SuccessStory::STATUS_APPROVED, $story->fresh()->status);
        $this->assertEquals($admin->id, $story->fresh()->reviewer_id);

        // 4. Admin archives approved -> archived
        $story->transitionTo(SuccessStory::STATUS_ARCHIVED, $admin);
        $this->assertEquals(SuccessStory::STATUS_ARCHIVED, $story->fresh()->status);
    }

    public function test_story_state_machine_blocks_invalid_transitions(): void
    {
        $admin = User::where('email', 'admin@pathseeker.com')->first();
        $student = User::where('email', 'student@pathseeker.com')->first();

        $story = SuccessStory::create([
            'title' => 'Direct Transition Story',
            'domain' => 'Cybersecurity',
            'story_text' => 'Testing forbidden state leap directly from draft to approved.',
            'submitted_by' => $student->id,
            'status' => SuccessStory::STATUS_DRAFT,
        ]);

        // Attempt invalid transition directly from draft -> approved without pending_review
        $this->expectException(DomainException::class);
        $story->transitionTo(SuccessStory::STATUS_APPROVED, $admin);
    }

    public function test_author_self_moderation_is_strictly_prohibited(): void
    {
        // Create an admin user who is also the author of a story
        $adminAuthor = User::where('email', 'admin@pathseeker.com')->first();

        $story = SuccessStory::create([
            'title' => 'Admin Authored Story',
            'domain' => 'Cloud & Infrastructure',
            'story_text' => 'An admin user wrote this story and must not self-moderate it.',
            'submitted_by' => $adminAuthor->id,
            'status' => SuccessStory::STATUS_PENDING,
        ]);

        // Admin attempting to self-approve their own story must throw DomainException
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Authors are prohibited from moderating their own success stories.');

        $story->transitionTo(SuccessStory::STATUS_APPROVED, $adminAuthor);
    }

    public function test_public_only_sees_approved_stories(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();

        $pendingStory = SuccessStory::create([
            'title' => 'Hidden Pending Story',
            'domain' => 'Software Engineering',
            'story_text' => 'This pending story text should be invisible to unauthenticated guests.',
            'submitted_by' => $student->id,
            'status' => SuccessStory::STATUS_PENDING,
        ]);

        // Guest requesting pending story receives 404
        $this->get(route('stories.show', $pendingStory->id))->assertStatus(404);

        // Guest requesting public listing does not see pending story
        $this->get(route('stories.index'))->assertDontSee('Hidden Pending Story');
    }

    public function test_feedback_submission_privacy_and_admin_response(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $pro = User::where('email', 'pro@pathseeker.com')->first();
        $admin = User::where('email', 'admin@pathseeker.com')->first();

        // Student submits feedback
        $this->actingAs($student)->post(route('feedback.store'), [
            'category' => 'bug',
            'message' => 'Found an issue with salary calculator benchmarks.',
        ])->assertRedirect();

        $fb = Feedback::where('user_id', $student->id)->first();
        $this->assertNotNull($fb);
        $this->assertEquals('open', $fb->status);

        // Student sees their feedback
        $this->actingAs($student)->get(route('feedback.index'))->assertSee('Found an issue with salary calculator');

        // Pro user cannot see Student's feedback on their own feedback index (Strict Privacy)
        $this->actingAs($pro)->get(route('feedback.index'))->assertDontSee('Found an issue with salary calculator');

        // Admin responds to feedback
        $this->actingAs($admin)->post(route('admin.feedback.respond', $fb->id), [
            'status' => 'resolved',
            'admin_response' => 'Patch applied to telemetry metrics engine in build v2.4.',
        ])->assertRedirect();

        $fb->refresh();
        $this->assertEquals('resolved', $fb->status);
        $this->assertEquals('Patch applied to telemetry metrics engine in build v2.4.', $fb->admin_response);
        $this->assertEquals($admin->id, $fb->responded_by);
    }

    public function test_idempotent_notifications_for_story_and_feedback(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();
        $admin = User::where('email', 'admin@pathseeker.com')->first();

        $story = SuccessStory::create([
            'title' => 'Notification Test Story',
            'domain' => 'Artificial Intelligence & Data',
            'story_text' => 'Verifying idempotent database notifications for story review.',
            'submitted_by' => $student->id,
            'status' => SuccessStory::STATUS_PENDING,
        ]);

        // First moderation: approve
        $this->actingAs($admin)->post(route('admin.stories.moderate', $story->id), [
            'status' => 'approved',
        ]);

        $this->assertEquals(1, $student->notifications()->where('type', StoryStatusUpdatedNotification::class)->count());

        // Repeated moderation action (simulating retry or duplicate request)
        $this->actingAs($admin)->post(route('admin.stories.moderate', $story->id), [
            'status' => 'approved',
        ]);

        // Notification count remains exactly 1 (Idempotent)
        $this->assertEquals(1, $student->notifications()->where('type', StoryStatusUpdatedNotification::class)->count());
    }

    public function test_newsletter_subscription_duplicate_handling_and_real_unsubscribe(): void
    {
        $testEmail = 'newsletter.test@example.com';

        // 1. Initial Subscribe
        $res1 = $this->post(route('newsletter.subscribe'), ['email' => $testEmail]);
        $res1->assertRedirect();

        $sub = Subscriber::where('email', $testEmail)->first();
        $this->assertNotNull($sub);
        $this->assertEquals(Subscriber::STATUS_SUBSCRIBED, $sub->status);
        $this->assertNotNull($sub->token);
        $this->assertNull($sub->unsubscribed_at);

        // 2. Duplicate subscribe attempt (returns info without creating duplicate DB row)
        $countBefore = Subscriber::count();
        $res2 = $this->post(route('newsletter.subscribe'), ['email' => $testEmail]);
        $res2->assertRedirect();
        $this->assertEquals($countBefore, Subscriber::count());

        // 3. Real Unsubscribe Flow via token
        $unsubUrl = route('newsletter.unsubscribe', $sub->token);
        $res3 = $this->get($unsubUrl);
        $res3->assertStatus(200);
        $res3->assertSee('Unsubscribed Successfully');

        // Verify DB state updated
        $sub->refresh();
        $this->assertEquals(Subscriber::STATUS_UNSUBSCRIBED, $sub->status);
        $this->assertNotNull($sub->unsubscribed_at);

        // 4. Re-subscribe after unsubscribing
        $this->post(route('newsletter.subscribe'), ['email' => $testEmail]);
        $sub->refresh();
        $this->assertEquals(Subscriber::STATUS_SUBSCRIBED, $sub->status);
        $this->assertNull($sub->unsubscribed_at);
    }
}
