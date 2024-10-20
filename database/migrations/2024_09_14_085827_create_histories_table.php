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
        Schema::create('histories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedInteger('total_qsn'); // Total number of questions
            $table->unsignedInteger('skipped_qsn'); // Number of skipped questions
            $table->unsignedInteger('answered_qsn'); // Number of answered questions
            $table->decimal('obtained_marks', 8, 2); // Marks obtained, change precision if necessary
            $table->unsignedInteger('correct_count'); // Number of correctly answered questions
            
            // Foreign keys
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // FK to users table
            $table->foreignId('qsn_model_id')->constrained('qsn_models')->onDelete('cascade'); // FK to qsn_models table

            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
