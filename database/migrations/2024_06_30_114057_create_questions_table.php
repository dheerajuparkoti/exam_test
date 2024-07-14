<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('options')->nullable();
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');

            // Making qsn_model_id nullable
            $table->foreignId('qsn_model_id')->nullable()->constrained('qsn_models')->onDelete('cascade');

            // Making the qsn_category_id column nullable
            $table->foreignId('qsn_category_id')->nullable()->constrained('qsn_categories')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
