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
        Schema::create('qsn_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('full_mark');
            $table->unsignedInteger('pass_mark');
            $table->unsignedInteger('time_limit');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('levels')->onDelete('cascade');
            $table->foreignId('faculty_id')->constrained('faculties')->onDelete('cascade');
            $table->foreignId('sub_faculty_id')->constrained('faculties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qsn_models');
    }
};
