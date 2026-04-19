<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            // Link workout to a user
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // Workout name entered by user (e.g. "Push Day")
            $table->string('name');
            // Optional notes about the workout
            $table->text('notes')->nullable();
            // Date when workout was performed
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};