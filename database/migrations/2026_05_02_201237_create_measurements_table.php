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
    Schema::create('measurements', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // 1. Define all columns first
        $table->date('measured_at'); 
        $table->decimal('weight', 5, 2)->nullable();
        $table->decimal('neck', 5, 2)->nullable();
        $table->decimal('chest', 5, 2)->nullable();
        $table->decimal('biceps', 5, 2)->nullable();
        $table->decimal('forearms', 5, 2)->nullable();
        $table->decimal('waist', 5, 2)->nullable();
        $table->decimal('hips', 5, 2)->nullable();
        $table->decimal('calves', 5, 2)->nullable();
        $table->text('notes')->nullable();
        
        $table->timestamps();

    
        $table->index(['user_id', 'measured_at']);
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};
