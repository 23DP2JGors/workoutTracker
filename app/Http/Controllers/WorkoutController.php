<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
   // Get all workouts for current user
    public function index()
{
    // We explicitly tell Laravel to include exercises and their sets
    // using the 'workoutExercises' relationship defined in your Model
    $workouts = Workout::with(['workoutExercises.sets'])
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return response()->json($workouts);
}

    // Create new workout
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $workout = Workout::create([
            'user_id' => auth()->id(),
            'name'    => $request->name,
            'date'    => $request->date,
            'notes'   => $request->notes,
        ]);

        return response()->json($workout, 201);
    }

    // Get single workout with exercises and sets
    public function show(Workout $workout)
    {
        // Make sure user owns this workout
        if ($workout->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $workout->load('workoutExercises.exercise', 'workoutExercises.sets');

        return response()->json($workout);
    }

    // Update workout
    public function update(Request $request, Workout $workout)
    {
        if ($workout->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'name'  => ['sometimes', 'string', 'max:255'],
            'date'  => ['sometimes', 'date'],
            'notes' => ['nullable', 'string'],
        ]);

        $workout->update($request->only(['name', 'date', 'notes']));

        return response()->json($workout);
    }

    // Delete workout
    public function destroy(Workout $workout)
    {
        if ($workout->user_id !== auth()->id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $workout->delete();

        return response()->json(['message' => 'Workout deleted']);
    }
}