<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Measurement>
 */
class MeasurementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'user_id' => \App\Models\User::factory(),
        'measured_at' => fake()->date(),
        'weight' => fake()->randomFloat(1, 60, 120),
        'waist' => fake()->randomFloat(1, 60, 100),
    ];
}

}
