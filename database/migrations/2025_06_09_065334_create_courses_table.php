<?php

use App\Models\Course;
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
        Schema::create('cp_courses', function (Blueprint $table) {
            $SupportedLanguages = config('languages');
            $CourseModel = Course::class;

            $table->id();

            foreach($CourseModel::translatables as $Translatable)
            {
                foreach($SupportedLanguages as $langauge){
                    /* if($Translatable . $langauge['Language_code'] == 'title')
                    {
                        $table->string($Translatable . $langauge['Language_code'])->charset('utf8mb4');
                    }
                    else
                    { */
                        $table->string($Translatable . $langauge['Language_code'])->charset('utf8mb4')->nullable();
                    /* } */
                }
            }

            $table->string('author')->charset('utf8mb4');
            $table->string('product_slug')->charset('utf8mb4');
            $table->string('domain')->charset('utf8mb4');
            $table->integer('cover_square');
            $table->integer('cover_wide');
            $table->integer('cover_locked')->nullable();
            $table->integer('cover_menu')->nullable();
            $table->tinyInteger('unlocked_order');
            $table->unsignedTinyInteger('locked_order');
            $table->boolean('legacy_product')->default(0);
            $table->unsignedBigInteger('purchase_tag');
            $table->integer('completion_campaign_started_tag')->nullable();
            $table->integer('completion_campaign_ended_tag')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('etag')->charset('utf8mb4');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cp_courses');
    }
};
