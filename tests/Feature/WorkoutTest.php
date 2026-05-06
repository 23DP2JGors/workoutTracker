<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_create_workout(): void
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Morning Session',
            'date' => now()->format('Y-m-d'),
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/workouts', $data);

        // Assert 201 Created or 200 OK depending on your controller
        $response->assertStatus(201); 

        $this->assertDatabaseHas('workouts', [
            'user_id' => $user->id,
            'name' => 'Morning Session'
        ]);
    }

    #[Test]
    public function user_can_only_see_their_own_workouts(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Workout::factory()->create(['user_id' => $user1->id, 'name' => 'User 1 Workout']);
        Workout::factory()->create(['user_id' => $user2->id, 'name' => 'User 2 Workout']);

        $response = $this->actingAs($user1)
            ->getJson('/api/workouts');

        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonPath('0.name', 'User 1 Workout');
    }
}
