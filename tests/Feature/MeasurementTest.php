<?php

namespace Tests\Feature;

use App\Models\User;
use PHPUnit\Framework\Attributes\Test;
use App\Models\Measurement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MeasurementTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function authenticated_user_can_save_measurement(): void
    {
        $user = User::factory()->create();

        $data = [
            'measured_at' => now()->format('Y-m-d'),
            'weight' => 85.5,
            'waist' => 90.0,
            'notes' => 'Feeling good'
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/measurements', $data);

        // Status 201 for Creating
        $response->assertStatus(201);
        
        // Compare as floats to avoid '85.50' vs 85.5 issue
        $this->assertEquals(85.5, (float) $response->json('weight'));

        // Database check
        $this->assertDatabaseHas('measurements', [
            'user_id' => $user->id,
            'weight' => 85.5
        ]);
    }

    #[Test]
    public function user_can_fetch_their_measurement_history(): void
    {
        $user = User::factory()->create();
        Measurement::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->getJson('/api/measurements');

        // Status 200 for Fetching (Index)
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    #[Test]
    public function cannot_save_measurement_with_invalid_data(): void
    {
        $user = User::factory()->create();

        // Invalid weight (string) and negative value
        $data = [
            'weight' => -50, 
            'waist' => 'too big'
        ];

        $response = $this->actingAs($user)
            ->postJson('/api/measurements', $data);

        // Expecting validation error
        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['weight', 'waist']);
    }
}
