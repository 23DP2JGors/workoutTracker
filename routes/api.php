<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutExerciseController;
use App\Http\Controllers\SetController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    // Workout routes
    Route::apiResource('workouts', WorkoutController::class);

    // Workout exercise routes — nested under workout
    Route::get('workouts/{workout}/exercises', [WorkoutExerciseController::class, 'index']);
    Route::post('workouts/{workout}/exercises', [WorkoutExerciseController::class, 'store']);
    Route::delete('workouts/{workout}/exercises/{workoutExercise}', [WorkoutExerciseController::class, 'destroy']);

    // Set routes — nested under workout exercise
    Route::post('workout-exercises/{workoutExercise}/sets', [SetController::class, 'store']);
    Route::put('workout-exercises/{workoutExercise}/sets/{set}', [SetController::class, 'update']);
    Route::delete('workout-exercises/{workoutExercise}/sets/{set}', [SetController::class, 'destroy']);
});