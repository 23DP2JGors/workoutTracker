<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workout_exercises', function (Blueprint $table) {
            $table->id();
            // Link to workout
            $table->foreignId('workout_id')->constrained()->cascadeOnDelete();
            // Link to exercise
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            // Order of exercise in workout
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workout_exercises');
    }
};