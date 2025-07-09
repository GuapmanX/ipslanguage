<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
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
            'author' => 'John Doe',
            'product_slug' => '12 gauge',
            'domain' => 'ips',
            'cover_square' => 313213,
            'cover_wide' => 313213,
            'cover_locked' => 313213,
            'cover_menu' => 313213,
            'unlocked_order' => 1,
            'locked_order' => 1,
            'legacy_product' => 0,
            'purchase_tag' => 1,
            'completion_campaign_started_tag' => 1,
            'completion_campaign_ended_tag' => 1,
            'is_active' => 1,
            'etag' => 'AUYGUIFDGIG(%@%(*@%%432'
        ];

        //title
        foreach($languages as $language){
            $constructed['title' . $language['Language_code']] = "TEST_TITLE_" . $language['Language'];
        }

        //description
        foreach($languages as $language){
            $constructed['description' . $language['Language_code']] = "TEST_DESCRIPTION_" . $language['Language'];
        }


        return $constructed;
    }
}
