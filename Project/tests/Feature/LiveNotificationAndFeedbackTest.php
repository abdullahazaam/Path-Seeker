<?php

namespace Tests\Feature;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LiveNotificationAndFeedbackTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_feedback_submission_and_placement(): void
    {
        // 1. Verify Homepage contains feedback section
        $homeRes = $this->get('/');
        $homeRes->assertStatus(200);
        $homeRes->assertSee('Help Shape the Future of', false);
        $homeRes->assertSee('Submit Feedback', false);

        // 2. Guest feedback submission from homepage
        $guestFeedback = $this->post('/feedback', [
            'category' => 'suggestion',
            'message' => 'Great roadmap visualization on the homepage!',
        ]);
        $guestFeedback->assertRedirect();
        $this->assertDatabaseHas('feedback', [
            'category' => 'suggestion',
            'message' => 'Great roadmap visualization on the homepage!',
            'user_id' => null,
        ]);

        // 3. Authenticated user feedback submission
        $student = User::where('email', 'student@pathseeker.com')->first();
        $userFeedback = $this->actingAs($student)->post('/feedback', [
            'category' => 'bug',
            'message' => 'Found a minor typo in system design cheatsheet.',
        ]);
        $userFeedback->assertRedirect();
        $this->assertDatabaseHas('feedback', [
            'category' => 'bug',
            'message' => 'Found a minor typo in system design cheatsheet.',
            'user_id' => $student->id,
        ]);
    }

    public function test_live_notifications_api_and_read_lifecycle(): void
    {
        $student = User::where('email', 'student@pathseeker.com')->first();

        // 1. Fetch live notifications on login (auto-seeds real-time updates if empty)
        $notifRes = $this->actingAs($student)->getJson('/api/notifications');
        $notifRes->assertStatus(200);
        $notifRes->assertJsonStructure([
            'unread_count',
            'notifications' => [
                '*' => ['id', 'title', 'message', 'action_url', 'icon', 'type_badge', 'read', 'time_ago'],
            ],
        ]);

        $unreadCount = $notifRes->json('unread_count');
        $this->assertGreaterThan(0, $unreadCount);
        $firstId = $notifRes->json('notifications.0.id');

        // 2. Mark single notification as read
        $markRes = $this->actingAs($student)->postJson("/api/notifications/{$firstId}/read");
        $markRes->assertStatus(200);
        $this->assertEquals($unreadCount - 1, $markRes->json('unread_count'));

        // 3. Mark all as read
        $readAllRes = $this->actingAs($student)->postJson('/api/notifications/read-all');
        $readAllRes->assertStatus(200);
        $this->assertEquals(0, $readAllRes->json('unread_count'));
    }

    public function test_admin_can_manage_and_delete_feedback(): void
    {
        $admin = User::where('email', 'admin@pathseeker.com')->first();
        $student = User::where('email', 'student@pathseeker.com')->first();

        // 1. Create a sample feedback with guest details
        $feedback = Feedback::create([
            'name' => 'Sara Connor',
            'email' => 'sara@cyberdyne.io',
            'category' => 'bug',
            'message' => 'Dark mode switch glitch on Chrome iOS.',
            'status' => 'open',
        ]);

        // 2. Admin views dashboard with feedback tab
        $dashRes = $this->actingAs($admin)->get('/dashboard?tab=feedback');
        $dashRes->assertStatus(200);
        $dashRes->assertSee('User Feedback &amp; Suggestions Inbox', false);
        $dashRes->assertSee('Sara Connor');
        $dashRes->assertSee('Dark mode switch glitch on Chrome iOS.');

        // 3. Admin responds to feedback
        $respondRes = $this->actingAs($admin)->post("/admin/feedback/{$feedback->id}/respond", [
            'status' => 'resolved',
            'admin_response' => 'Fixed in version 2.4.1 release.',
        ]);
        $respondRes->assertRedirect();
        $this->assertDatabaseHas('feedback', [
            'id' => $feedback->id,
            'status' => 'resolved',
            'admin_response' => 'Fixed in version 2.4.1 release.',
        ]);

        // 4. Non-admin cannot delete feedback
        $unauthDelete = $this->actingAs($student)->delete("/admin/feedback/{$feedback->id}");
        $unauthDelete->assertStatus(403);

        // 5. Admin deletes feedback
        $authDelete = $this->actingAs($admin)->delete("/admin/feedback/{$feedback->id}");
        $authDelete->assertRedirect();
        $this->assertDatabaseMissing('feedback', [
            'id' => $feedback->id,
        ]);
    }

    public function test_admin_can_edit_and_update_multimedia_and_resources(): void
    {
        $admin = User::where('email', 'admin@pathseeker.com')->first();
        $student = User::where('email', 'student@pathseeker.com')->first();

        $media = \App\Models\Multimedia::first();
        $resource = \App\Models\Resource::first();

        // 1. Admin updates multimedia item
        $mediaUpdate = $this->actingAs($admin)->put("/admin/multimedia/{$media->id}", [
            'title' => 'Updated Distributed Cloud Architecture',
            'description' => 'Updated deep dive description for 2026.',
            'type' => 'video',
            'url' => 'https://www.youtube.com/watch?v=updated123',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800',
            'duration' => '1h 45m',
            'tags' => 'Cloud, Architecture, Kubernetes',
        ]);
        $mediaUpdate->assertRedirect('/dashboard?tab=multimedia');
        $this->assertDatabaseHas('multimedia', [
            'id' => $media->id,
            'title' => 'Updated Distributed Cloud Architecture',
            'duration' => '1h 45m',
        ]);

        // 2. Admin updates resource item
        $resUpdate = $this->actingAs($admin)->put("/admin/resources/{$resource->id}", [
            'title' => 'Updated React 19 & Next.js Architecture Blueprint',
            'category' => 'Frontend Playbook',
            'file_url' => 'https://github.com/example/react-blueprint',
            'thumbnail_url' => 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=800',
            'description' => 'Updated enterprise frontend blueprint.',
        ]);
        $resUpdate->assertRedirect('/dashboard?tab=resources');
        $this->assertDatabaseHas('resources', [
            'id' => $resource->id,
            'title' => 'Updated React 19 & Next.js Architecture Blueprint',
            'category' => 'Frontend Playbook',
        ]);

        // 3. Non-admin is rejected
        $studentMediaUpdate = $this->actingAs($student)->put("/admin/multimedia/{$media->id}", [
            'title' => 'Hacked title',
            'type' => 'video',
            'url' => 'https://hacked.com',
        ]);
        $studentMediaUpdate->assertStatus(403);
    }

    public function test_feedback_notification_direct_routing_and_reply_viewing(): void
    {
        $admin = User::where('email', 'admin@pathseeker.com')->first();
        $student = User::where('email', 'student@pathseeker.com')->first();
        $otherUser = User::where('role', '!=', 'admin')->where('id', '!=', $student->id)->first() ?? User::factory()->create(['role' => 'graduate']);

        // 1. Student creates feedback
        $feedback = Feedback::create([
            'user_id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
            'category' => 'query',
            'message' => 'Are there new AI track certifications for Q3 2026?',
            'status' => 'open',
        ]);

        // 2. Admin responds
        $this->actingAs($admin)->post("/admin/feedback/{$feedback->id}/respond", [
            'status' => 'resolved',
            'admin_response' => 'Yes, our 2026 AI Architect credentials launch next Monday.',
        ]);

        // 3. Check student's live notification API payload
        $notifRes = $this->actingAs($student)->getJson('/api/notifications');
        $notifRes->assertStatus(200);
        $notifications = $notifRes->json('notifications');
        $feedbackNotif = collect($notifications)->first(fn ($n) => str_contains($n['action_url'], "/feedback/{$feedback->id}"));
        $this->assertNotNull($feedbackNotif, 'Notification should link directly to feedback.show');
        $this->assertEquals(url("/feedback/{$feedback->id}"), $feedbackNotif['action_url']);
        $this->assertEquals('Admin Reply', $feedbackNotif['type_badge']);

        // 4. Student views their feedback thread
        $threadRes = $this->actingAs($student)->get("/feedback/{$feedback->id}");
        $threadRes->assertStatus(200);
        $threadRes->assertSee('Feedback Inquiry &amp; Official Response', false);
        $threadRes->assertSee('Are there new AI track certifications for Q3 2026?');
        $threadRes->assertSee('Yes, our 2026 AI Architect credentials launch next Monday.');

        // 5. Another unauthorized user cannot view the private feedback thread
        $unauthRes = $this->actingAs($otherUser)->get("/feedback/{$feedback->id}");
        $unauthRes->assertStatus(403);
    }
}
