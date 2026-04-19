<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            // Link to workout exercise
            $table->foreignId('workout_exercise_id')->constrained()->cascadeOnDelete();
            // Weight used in kg
            $table->decimal('weight', 6, 2)->nullable();
            // Number of repetitions
            $table->integer('reps')->nullable();
            // Order of set in exercise
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};