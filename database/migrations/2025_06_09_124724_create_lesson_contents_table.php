<?php

use App\Models\lessonContent;
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
        Schema::create('cp_lesson_contents', function (Blueprint $table) {
            $SupportedLanguages = config('languages');
            $CourseModel = lessonContent::class;

            $table->id();

            foreach($CourseModel::translatables as $Translatable)
            {
                foreach($SupportedLanguages as $langauge){
                    /* if($langauge['Language_code'] == '')
                    {
                        $table->string($Translatable . $langauge['Language_code'])->charset('utf8mb4');
                    }
                    else
                    { */
                        $table->string($Translatable . $langauge['Language_code'])->charset('utf8mb4')->nullable();
                    /* } */
                }
            }

            $table->text('thumbnail')->charset('utf8mb4');
            $table->integer('duration');
            $table->boolean('portrait')->default(0);
            $table->text('cta_url')->charset('utf8mb4');
            $table->boolean('is_teaser')->default(0);


            $table->timestamp('available_from')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cp_lesson_contents');
    }
};
