<?php

namespace Database\Seeders;

use App\Models\Exercise; // Important: we import our Exercise model
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds to populate the exercises table.
     */
    public function run(): void
    {
        // Define an array of basic exercises to start with
        $exercises = [
            [
                'name' => 'Bench Press',
                'muscle_group' => 'Chest',
                'description' => 'Lie on a flat bench and press the barbell upwards.'
            ],
            [
                'name' => 'Squats',
                'muscle_group' => 'Legs',
                'description' => 'Perform a deep squat with a barbell on your shoulders.'
            ],
            [
                'name' => 'Deadlift',
                'muscle_group' => 'Back',
                'description' => 'Lift the barbell from the floor to hip level.'
            ],
            [
                'name' => 'Pull-ups',
                'muscle_group' => 'Back',
                'description' => 'Pull your body up to the bar using your lats.'
            ],
            [
                'name' => 'Shoulder Press',
                'muscle_group' => 'Shoulders',
                'description' => 'Press dumbbells over your head while seated or standing.'
            ],
        ];

        // Loop through the array and create each exercise in the database
        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
