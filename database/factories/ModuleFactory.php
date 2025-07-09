<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languages = require base_path("resources/php/Languages.php");

        $constructed = [
            'course_id' => Course::factory(),
            'order' => 1,
            'is_coming_soon' => 0,
            'ignore_progress' => 1,
            'active' => 0,
            'completion_campaign_started_tag' => null,
            'completed_tag' => 6868

        ];

        //title
        foreach($languages as $language){
            $constructed['title' . $language['Language_code']] = "TEST_TITLE_" . $language['Language'];
        }

        //subtitle
        foreach($languages as $language){
            $constructed['subtitle' . $language['Language_code']] = "TEST_SUBTITLE_" . $language['Language'];
        }

        return $constructed;
    }
}
