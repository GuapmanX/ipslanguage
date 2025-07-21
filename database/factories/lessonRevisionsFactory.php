<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lesson;
use App\Models\lessonContent;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lessonRevisions>
 */
class lessonRevisionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $translated = false;


    public function definition(): array
    {
        if($this->translated)
        {
            return [
                'lesson_id' => Lesson::factory()->translate()->create(),
                'lesson_content_id' => lessonContent::factory()->translate()->setToTranslated()->create()
            ];
        }
        else
        {
            return [
                'lesson_id' => Lesson::factory()->create(),
                'lesson_content_id' => lessonContent::factory()->create()
            ];
        }
    }

     public function translate(){
        $this->translated = true;
        return $this;
     }
}
//REVISIONS ARE THE FIRST THAT NEED TO BE FIRED TO GENERATE THE WHOLE SUITE OF COURSES,MODULES AND LESSONS