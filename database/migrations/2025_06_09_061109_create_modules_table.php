<?php

use App\Models\Module;
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
        Schema::create('cp_modules', function (Blueprint $table) {
            $CourseModel = Module::class;
            $SupportedLanguages = config('languages');

            $table->id();

            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('cp_courses');

            foreach($CourseModel::translatables as $Translatable)
            {
                foreach($SupportedLanguages as $langauge){
                    /* if($Translatable . $langauge['Language_code'] == '')
                    {
                        $table->string($Translatable . $langauge['Language_code'])->charset('utf8mb4');
                    }
                    else
                    { */
                        $table->string($Translatable . $langauge['Language_code'])->charset('utf8mb4')->nullable();
                    /* } */
                }
            }

            $table->unsignedTinyInteger('order');
            $table->boolean('is_coming_soon')->default(0);
            $table->boolean('ignore_progress');
            $table->boolean('active')->default(0);
            $table->integer('completion_campaign_started_tag')->nullable();
            $table->integer('completed_tag')->nullable();

            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cp_modules');
    }
};
