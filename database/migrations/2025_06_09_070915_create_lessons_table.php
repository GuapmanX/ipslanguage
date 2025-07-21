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
        Schema::create('cp_lessons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')->references('id')->on('cp_modules');

            $table->unsignedTinyInteger('order');
            $table->boolean('active')->default(0);
            $table->text('share_id')->charset('utf8mb4')->nullable();
            $table->boolean('allowed_on_discovery')->default(1);

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cp_lessons');
    }
};
