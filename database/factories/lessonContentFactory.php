<?php

namespace Database\Factories;

use App\Models\lessonContent;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lessonContent>
 */
class lessonContentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public $translated = false;

    public function definition(): array
    {
        $languages = config('languages');

        $constructed = [
            'is_teaser' => fake()->boolean(),
            'available_from' => fake()->time(),
            'thumbnail' => fake()->domainName(),
            'duration' => fake()->numberBetween(0,1000),
            'portrait' => fake()->boolean(),
            'cta_url' => fake()->domainName() //not a real website
        ];
        

        return $constructed;
    }

    public function translate()
    {
        $languages = config('languages');
        $this->translated = true;
        $data = [];

        foreach(lessonContent::translatables as $translatable)
        {
            foreach($languages as $language){
                $data[$translatable . $language['Language_code']] = fake()->sentence();
            }
        }
        
        return $this->state(fn () => $data);
    }

    public function setToTranslated()
    {
        $this->translated = true;
        return $this;
    }
}
