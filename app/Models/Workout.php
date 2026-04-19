<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    // Fields that can be saved to database
    protected $fillable = [
        'user_id',
        'name',
        'notes',
        'date',
    ];

    // Workout belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Workout has many exercises
    public function workoutExercises()
    {
        return $this->hasMany(WorkoutExercise::class);
    }
}