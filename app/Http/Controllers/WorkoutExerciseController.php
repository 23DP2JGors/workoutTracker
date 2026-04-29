<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\WorkoutExercise;
use Illuminate\Http\Request;

class WorkoutExerciseController extends Controller
{
    // Get all exercises for a workout
    public function index(Workout $workout)
    {
        if ($workout->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(
            $workout->workoutExercises()->with('exercise', 'sets')->get()
        );
    }

    // Add exercise to workout
    public function store(Request $request, Workout $workout)
    {
        if ($workout->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'exercise_id' => ['required', 'exists:exercises,id'],
            'order'       => ['integer'],
        ]);

        $workoutExercise = WorkoutExercise::create([
            'workout_id'  => $workout->id,
            'exercise_id' => $request->exercise_id,
            'order'       => $request->order ?? 0,
        ]);

        return response()->json($workoutExercise->load('exercise'), 201);
    }

    public function destroy(WorkoutExercise $workoutExercise)
{
    // Check if the user owns the workout this exercise belongs to
    if ($workoutExercise->workout->user_id !== auth()->id()) {
        return response()->json(['message' => 'Forbidden'], 403);
    }

    $workoutExercise->delete();

    return response()->json(['message' => 'Exercise removed']);
}

}