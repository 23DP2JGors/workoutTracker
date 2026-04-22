<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    // Get all exercises — global and user's personal ones
    public function index()
    {
        $exercises = Exercise::where(function($query) {
            $query->whereNull('user_id')
                  ->orWhere('user_id', auth()->id());
        })
        ->orderBy('muscle_group')
        ->orderBy('name')
        ->get();

        return response()->json($exercises);
    }

    // Add personal exercise
    public function store(Request $request)
    {
        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'muscle_group' => ['required', 'string', 'max:255'],
            'description'  => ['nullable', 'string'],
        ]);

        $exercise = Exercise::create([
            'user_id'      => auth()->id(),
            'name'         => $request->name,
            'muscle_group' => $request->muscle_group,
            'description'  => $request->description,
        ]);

        return response()->json($exercise, 201);
    }
}