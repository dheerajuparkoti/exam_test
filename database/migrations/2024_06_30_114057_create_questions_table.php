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
            $table->string('description');
            $table->string('option');//json
            $table->timestamps();
            $table->foreignId('qsn_model_id')->constrained('qsn_models')->onDelete('cascade')->default('null');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->foreignId('qsn_category_id')->constrained('qsn_categories')->onDelete('cascade')->default('null');
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
