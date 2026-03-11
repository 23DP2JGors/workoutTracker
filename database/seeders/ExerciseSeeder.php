<?php

namespace Database\Seeders;

use App\Models\Exercise; 
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds to populate the exercises table.
     */
    public function run(): void
    {
        // This will delete all existing exercises (including the "Test" one)
        Exercise::truncate();

        // Define an array of exercises to populate the database
        $exercises = [
            // Glutes
            ['name' => 'Dumbbell Lunges', 'muscle_group' => 'Glutes', 'description' => 'A unilateral exercise that targets the glutes and quadriceps by stepping forward with dumbbells.'],
            ['name' => 'Bulgarian Split Squats', 'muscle_group' => 'Glutes', 'description' => 'A single-leg squat variation performed with the rear foot elevated on a bench, emphasizing glute activation.'],
            ['name' => 'Hip Abduction Machine', 'muscle_group' => 'Glutes', 'description' => 'A machine-based exercise that isolates the gluteus medius by pushing legs apart against resistance.'],
            ['name' => 'Barbell Lunges', 'muscle_group' => 'Glutes', 'description' => 'Forward lunges performed with a barbell on the shoulders to target glutes and quadriceps.'],
            ['name' => 'Smith Machine Lunges', 'muscle_group' => 'Glutes', 'description' => 'Lunges executed on a Smith machine for controlled movement, focusing on glute development.'],
            ['name' => 'Hyperextensions', 'muscle_group' => 'Glutes', 'description' => 'A back extension exercise that also engages the glutes for improved posture and strength.'],
            ['name' => 'Romanian Deadlift', 'muscle_group' => 'Glutes', 'description' => 'A hinge movement that primarily targets the glutes and hamstrings with minimal knee bend.'],
            ['name' => 'Barbell Hip Thrust', 'muscle_group' => 'Glutes', 'description' => 'A glute-focused exercise where you thrust hips upward with a barbell placed across the hips.'],
            ['name' => 'Machine Hip Thrust', 'muscle_group' => 'Glutes', 'description' => 'A machine-assisted hip thrust that isolates the glutes for maximum activation.'],
            ['name' => 'Step-ups', 'muscle_group' => 'Glutes', 'description' => 'Stepping onto a bench or platform to target glutes, quadriceps, and improve unilateral strength.'],
            ['name' => 'Cable Kickbacks', 'muscle_group' => 'Glutes', 'description' => 'A cable machine exercise that isolates the glutes by kicking the leg backward.'],
        // Quadriceps
            ['name' => 'Squats', 'muscle_group' => 'Quadriceps', 'description' => 'A fundamental lower body exercise that primarily targets the quadriceps, glutes, and hamstrings.'],
            ['name' => 'Hack Squats', 'muscle_group' => 'Quadriceps', 'description' => 'A squat variation performed on a hack squat machine, emphasizing quadriceps development.'],
            ['name' => 'Smith Machine Squats', 'muscle_group' => 'Quadriceps', 'description' => 'Squats executed in a Smith machine for guided movement, focusing on quadriceps strength.'],
            ['name' => 'Lunges', 'muscle_group' => 'Quadriceps', 'description' => 'A stepping exercise that targets the quadriceps, glutes, and hamstrings unilaterally.'],
            ['name' => 'Angled Leg Press', 'muscle_group' => 'Quadriceps', 'description' => 'Leg press performed on an angled platform to emphasize quadriceps activation.'],
            ['name' => 'Straight Leg Press', 'muscle_group' => 'Quadriceps', 'description' => 'Leg press with feet positioned for balanced quadriceps, glutes, and hamstrings engagement.'],
            ['name' => 'Dumbbell Goblet Squats', 'muscle_group' => 'Quadriceps', 'description' => 'Squats holding a dumbbell at chest level, targeting quadriceps and core stability.'],
            // Hamstrings
            ['name' => 'Barbell Romanian Deadlift', 'muscle_group' => 'Hamstrings', 'description' => 'A deadlift variation that heavily targets the hamstrings and glutes with a barbell.'],
            ['name' => 'Dumbbell Romanian Deadlift', 'muscle_group' => 'Hamstrings', 'description' => 'Romanian deadlift performed with dumbbells to isolate hamstrings and improve hip hinge mechanics.'],
            ['name' => 'Seated Leg Curls', 'muscle_group' => 'Hamstrings', 'description' => 'A machine exercise that curls the legs while seated, isolating the hamstrings.'],
            ['name' => 'Lying Leg Curls', 'muscle_group' => 'Hamstrings', 'description' => 'Prone leg curls on a machine to target the hamstrings effectively.'],
            ['name' => 'Single-leg Standing Leg Curls', 'muscle_group' => 'Hamstrings', 'description' => 'Unilateral standing leg curls that challenge hamstring strength and balance.'],
            // Biceps
            ['name' => 'Dumbbell Curls', 'muscle_group' => 'Biceps', 'description' => 'Bicep curls performed with dumbbells for balanced arm development.'],
            ['name' => 'Barbell Curls', 'muscle_group' => 'Biceps', 'description' => 'Standing curls with a barbell to build overall bicep strength.'],
            ['name' => 'Cable Curls', 'muscle_group' => 'Biceps', 'description' => 'Curls using a cable machine for constant tension on the biceps.'],
            ['name' => 'Machine Curls', 'muscle_group' => 'Biceps', 'description' => 'Seated machine curls that isolate the biceps for targeted growth.'],
            ['name' => 'Scott Bench Dumbbell Curls', 'muscle_group' => 'Biceps', 'description' => 'Dumbbell curls performed on a Scott bench to maximize bicep contraction.'],
            ['name' => 'Scott Bench Barbell Curls', 'muscle_group' => 'Biceps', 'description' => 'Barbell curls on a Scott bench for focused bicep isolation.'],
            // Triceps
            ['name' => 'Overhead Cable Extensions', 'muscle_group' => 'Triceps', 'description' => 'Cable tricep extensions performed overhead to target all three heads.'],
            ['name' => 'Barbell Skullcrushers', 'muscle_group' => 'Triceps', 'description' => 'Lying tricep extensions with a barbell, emphasizing the long head.'],
            ['name' => 'Dumbbell Skullcrushers', 'muscle_group' => 'Triceps', 'description' => 'Dumbbell version of skullcrushers for unilateral tricep development.'],
            ['name' => 'Cable Pushdowns', 'muscle_group' => 'Triceps', 'description' => 'Cable machine pushdowns to isolate the triceps effectively.'],
            ['name' => 'Close-grip Bench Press', 'muscle_group' => 'Triceps', 'description' => 'Bench press with a narrow grip to shift focus to the triceps.'],
            ['name' => 'JM Press', 'muscle_group' => 'Triceps', 'description' => 'A hybrid press that combines close-grip bench and skullcrusher movements.'],
            ['name' => 'Single-arm Cable Extensions', 'muscle_group' => 'Triceps', 'description' => 'Unilateral cable tricep extensions for balanced development.'],
            ['name' => 'Seated Dumbbell Overhead Extension', 'muscle_group' => 'Triceps', 'description' => 'Seated overhead tricep extensions with dumbbells to target the long head.'],
            // Back
            ['name' => 'Pull-ups', 'muscle_group' => 'Back', 'description' => 'Bodyweight exercise pulling up to a bar, targeting lats and upper back.'],
            ['name' => 'Lat Pulldowns', 'muscle_group' => 'Back', 'description' => 'Machine-assisted pulldowns to simulate pull-ups and build lat strength.'],
            ['name' => 'Seated Cable Rows', 'muscle_group' => 'Back', 'description' => 'Seated rowing with cables to target the middle back and rhomboids.'],
            ['name' => 'T-Bar Rows', 'muscle_group' => 'Back', 'description' => 'Rows performed with a T-bar for comprehensive back development.'],
            ['name' => 'Hammer Strength Rows', 'muscle_group' => 'Back', 'description' => 'Machine rows that provide stable resistance for back muscle isolation.'],
            ['name' => 'Single-arm Vertical Rows', 'muscle_group' => 'Back', 'description' => 'Unilateral vertical pulling to balance back development.'],
            ['name' => 'Bent-over Barbell Rows', 'muscle_group' => 'Back', 'description' => 'Bent-over rows with a barbell to build overall back thickness.'],
            ['name' => 'Single-arm Dumbbell Rows', 'muscle_group' => 'Back', 'description' => 'One-arm dumbbell rows for unilateral back strengthening.'],
            // Chest
            ['name' => 'Flat Barbell Bench Press', 'muscle_group' => 'Chest', 'description' => 'Classic bench press on a flat bench with barbell for chest development.'],
            ['name' => 'Flat Dumbbell Bench Press', 'muscle_group' => 'Chest', 'description' => 'Dumbbell bench press allowing greater range of motion for chest activation.'],
            ['name' => 'Incline Barbell Press', 'muscle_group' => 'Chest', 'description' => 'Barbell press on an incline bench to target upper chest.'],
            ['name' => 'Incline Dumbbell Press', 'muscle_group' => 'Chest', 'description' => 'Incline dumbbell press for upper chest and shoulder involvement.'],
            ['name' => 'Machine Bench Press', 'muscle_group' => 'Chest', 'description' => 'Machine-assisted bench press for controlled chest training.'],
            ['name' => 'Seated Machine Press', 'muscle_group' => 'Chest', 'description' => 'Seated chest press machine for isolation and safety.'],
            ['name' => 'Cable Crossover', 'muscle_group' => 'Chest', 'description' => 'Cable flyes crossing over the body to emphasize inner chest.'],
            ['name' => 'Butterfly (Pec Deck)', 'muscle_group' => 'Chest', 'description' => 'Machine flyes that isolate the pectorals effectively.'],
            ['name' => 'Dips', 'muscle_group' => 'Chest', 'description' => 'Bodyweight or assisted dips targeting chest and triceps.'],
            // Shoulders
            ['name' => 'Cable Lateral Raises', 'muscle_group' => 'Shoulders', 'description' => 'Cable machine raises to target the medial deltoids.'],
            ['name' => 'Machine Lateral Raises', 'muscle_group' => 'Shoulders', 'description' => 'Machine-assisted lateral raises for controlled shoulder development.'],
            ['name' => 'Dumbbell Lateral Raises', 'muscle_group' => 'Shoulders', 'description' => 'Dumbbell raises to the sides for shoulder width and strength.'],
            ['name' => 'Seated Dumbbell Press', 'muscle_group' => 'Shoulders', 'description' => 'Seated overhead press with dumbbells for overall shoulder strength.'],
            ['name' => 'Seated Barbell Press', 'muscle_group' => 'Shoulders', 'description' => 'Seated barbell press to build shoulder mass and power.'],
            ['name' => 'Machine Shoulder Press', 'muscle_group' => 'Shoulders', 'description' => 'Machine press for safe and effective shoulder training.'],
            ['name' => 'Upright Rows (middle delt)', 'muscle_group' => 'Shoulders', 'description' => 'Rows pulling weight to chin level, targeting middle deltoids.'],
            ['name' => 'Rear Delt Cable Flyes', 'muscle_group' => 'Shoulders', 'description' => 'Cable flyes targeting the posterior deltoids for balanced shoulders.'],
            ['name' => 'Rear Delt Butterfly', 'muscle_group' => 'Shoulders', 'description' => 'Machine rear delt flyes to strengthen the back of the shoulders.'],
            ['name' => 'Face Pulls', 'muscle_group' => 'Shoulders', 'description' => 'Cable pulls to the face for rear delt and upper back activation.'],
            ];
        
        // Loop through the array and create each exercise in the database
        foreach ($exercises as $exercise) {
            Exercise::create($exercise);
        }
    }
}
