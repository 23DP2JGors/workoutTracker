<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase; // This ensures the database is reset after each test

    /**
     * Test that an authenticated user can save their profile.
     */
    public function test_authenticated_user_can_save_profile(): void
    {
        // Create a user
        $user = User::factory()->create();

        // Data to send
        $profileData = [
            'gender'         => 'male',
            'weight'         => 100,
            'height'         => 180,
            'age'            => 30,
            'activity_level' => 1.35,
            'goal'           => 'loss',
        ];

        // Act: login as user and post data
        $response = $this->actingAs($user)
            ->postJson('/api/user-profile', $profileData);

        // Assert: check response and database
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('user_profiles', [
            'user_id' => $user->id,
            'weight'  => 100
        ]);
    }

    /**
     * Test that guest cannot save profile.
     */
    public function test_guest_cannot_save_profile(): void
    {
        $response = $this->postJson('/api/user-profile', ['weight' => 80]);

        $response->assertStatus(401);
    }

    /**
     * Test validation rules for profile update.
     */
    public function test_user_cannot_save_profile_with_invalid_data(): void
    {
        $user = User::factory()->create();

        // Sending invalid weight (-100) and missing gender
        $invalidData = [
            'weight' => -100, 
            'height' => 'not-a-number',
            'age' => 200, // Too old for our validation rules
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/user-profile', $invalidData);

        // Assert: status 422 (Unprocessable Content)
        $response->assertStatus(422);
        
        // Check that we have errors for specific fields
        $response->assertJsonValidationErrors(['gender', 'weight', 'height']);
    }

}
