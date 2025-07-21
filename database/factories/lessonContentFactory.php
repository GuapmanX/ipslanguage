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
            'is_teaser' => 0,
            'available_from' => null,
            'thumbnail' => 'ngbdfgkihwuiauifhhahih',
            'duration' => 312,
            'portrait' => 0,
            'cta_url' => 'https://somethingsomething.com' //not a real website
        ];

        foreach(lessonContent::translatables as $translatable)
        {
            foreach($languages as $language){
                $constructed[$translatable . $language['Language_code']] = "TEST" . $language['Language'];
            }
        }
        

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
                $data[$translatable . $language['Language_code']] = "TEST" . $language['Language'];
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
