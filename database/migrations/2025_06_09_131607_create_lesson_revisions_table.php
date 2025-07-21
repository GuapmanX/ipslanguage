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
        Schema::create('cp_lesson_revisions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('lesson_id');
            $table->foreign('lesson_id')->references('id')->on('cp_lessons');

            $table->unsignedBigInteger('lesson_content_id');
            $table->foreign('lesson_content_id')->references('id')->on('cp_lesson_contents');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cp_lesson_revisions');
    }
};
