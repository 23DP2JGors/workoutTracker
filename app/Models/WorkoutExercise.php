<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model
{
    // Fields that can be saved to database
    protected $fillable = [
        'workout_id',
        'exercise_id',
        'order',
    ];

    // Belongs to a workout
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    // Belongs to an exercise
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    // Has many sets
    public function sets()
    {
        return $this->hasMany(Set::class);
    }
}