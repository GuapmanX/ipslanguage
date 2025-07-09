<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        $languages = require base_path("resources/php/Languages.php");

        $constructed = [
            'is_teaser' => 0,
            'available_from' => null,
            'thumbnail' => 'ngbdfgkihwuiauifhhahih',
            'duration' => 312,
            'portrait' => 0,
            'cta_url' => 'https://somethingsomething.com' //not a real webiste
        ];

        //title
        foreach($languages as $language){
            $constructed['title' . $language['Language_code']] = "TEST_TITLE_" . $language['Language'];
        }

        //notes
        foreach($languages as $language){
            $constructed['notes' . $language['Language_code']] = "TEST_NOTES_" . $language['Language'];
        }

        //summary
        foreach($languages as $language){
            $constructed['summary' . $language['Language_code']] = "TEST_SUMMARY_" . $language['Language'];
        }

        //video id
        foreach($languages as $language){
            $constructed['wistia_video_id' . $language['Language_code']] = "TEST_VIDID_" . $language['Language'];
        }

        //cta text
        foreach($languages as $language){
            $constructed['cta_text' . $language['Language_code']] = "TEST_CTATEXT_" . $language['Language'];
        }

        return $constructed;
    }
}
