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

        $this->assertEquals(0, $student->unreadNotifications()->count());
    }
}
