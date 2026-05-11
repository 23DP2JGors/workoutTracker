<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        // Link to the users table
        $table->foreignId('user_id')
            ->unique()
            ->constrained()
            ->cascadeOnDelete();
        
        // Physical metrics
        $table->enum('gender', ['male', 'female'])->nullable();
        $table->decimal('weight', 5, 2)->nullable(); // Up to 999.99 kg
        $table->integer('height')->nullable();
        $table->integer('age')->nullable();
        
        // Activity and Goals
        $table->string('activity_level')->nullable(); // sedentary, light, moderate, etc.
        $table->string('goal')->nullable(); // lose, maintain, gain
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
