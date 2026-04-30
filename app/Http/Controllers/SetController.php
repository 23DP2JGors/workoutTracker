<?php

namespace App\Http\Controllers;

use App\Models\WorkoutExercise;
use App\Models\Set;
use Illuminate\Http\Request;

class SetController extends Controller
{
    // Add set to workout exercise
    public function store(Request $request, WorkoutExercise $workoutExercise)
    {
        $request->validate([
            'weight' => ['nullable', 'numeric'],
            'reps'   => ['nullable', 'integer'],
            'order'  => ['integer'],
        ]);

        $set = Set::create([
            'workout_exercise_id' => $workoutExercise->id,
            'weight'              => $request->weight,
            'reps'                => $request->reps,
            'order'               => $request->order ?? 0,
        ]);

        return response()->json($set, 201);
    }

    // Update set
    public function update(Request $request, WorkoutExercise $workoutExercise, Set $set)
    {
        $request->validate([
            'weight' => ['nullable', 'numeric'],
            'reps'   => ['nullable', 'integer'],
        ]);

        $set->update($request->only(['weight', 'reps']));

        return response()->json($set);
    }

    // Delete set
    public function destroy(WorkoutExercise $workoutExercise, Set $set)
    {
        $set->delete();

        return response()->json(['message' => 'Set deleted']);
    }
}