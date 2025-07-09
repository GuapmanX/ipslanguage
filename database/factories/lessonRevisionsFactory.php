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
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'lesson_content_id' => lessonContent::factory()
        ];
    }
}
//REVISIONS ARE THE FIRST THAT NEED TO BE FIRED TO GENERATE THE WHOLE SUITE OF COURSES,MODULES AND LESSONS