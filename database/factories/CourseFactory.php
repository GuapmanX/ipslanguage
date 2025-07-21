<?php

namespace Database\Factories;

use App\Models\Course;
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
        $languages = config('languages');


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


        return $constructed;
    }


    public function translate()
    {
        $attribs = [];

        $languages = config('languages');

        foreach(Course::translatables as $translatable)
        {
            foreach($languages as $language){
                $attribs[$translatable . $language['Language_code']] = "TEST" . $language['Language'];
            }
        }


        return $this->state(fn () => $attribs);
    }

}
