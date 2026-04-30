<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    // Fields that can be saved to database
    protected $fillable = [
        'workout_exercise_id',
        'weight',
        'reps',
        'order',
    ];

    // Belongs to a workout exercise
    public function workoutExercise()
    {
        return $this->belongsTo(WorkoutExercise::class);
    }
}