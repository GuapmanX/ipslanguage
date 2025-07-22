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
            'author' => fake()->name(),
            'product_slug' => fake()->sentence(),
            'domain' => fake()->domainName(),
            'cover_square' => fake()->numberBetween(1,10000),
            'cover_wide' => fake()->numberBetween(1,10000),
            'cover_locked' => fake()->numberBetween(1,10000),
            'cover_menu' => fake()->numberBetween(1,10000),
            'unlocked_order' => fake()->numberBetween(1,9),
            'locked_order' => fake()->numberBetween(1,9),
            'legacy_product' => fake()->boolean(),
            'purchase_tag' => fake()->numberBetween(1,10000),
            'completion_campaign_started_tag' => fake()->numberBetween(1,10000),
            'completion_campaign_ended_tag' => fake()->numberBetween(1,10000),
            'is_active' => fake()->numberBetween(1,10000),
            'etag' => fake()->regexify('[A-Za-z]{15}')
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
                $attribs[$translatable . $language['Language_code']] = fake()->sentence();
            }
        }


        return $this->state(fn () => $attribs);
    }

}
