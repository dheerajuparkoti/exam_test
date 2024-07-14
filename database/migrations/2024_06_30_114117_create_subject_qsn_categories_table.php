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
        Schema::create('subject_qsn_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('min');
            $table->unsignedInteger('max');
            $table->timestamps();
            $table->foreignId('qsn_category_id')->constrained('qsn_categories')->onDelete('Cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('Cascade');
            $table->foreignId('qsn_model_id')->constrained('qsn_models')->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_qsn_categories');
    }
};
