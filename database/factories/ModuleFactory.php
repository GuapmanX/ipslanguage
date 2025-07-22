<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Course;
use App\Models\Module;

use function Symfony\Component\VarDumper\Dumper\esc;

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
    public $translated = false;

    public function definition(): array
    {


        $constructed = [
            'order' => fake()->numberBetween(1,9),
            'is_coming_soon' => fake()->boolean(),
            'ignore_progress' => fake()->boolean(),
            'active' => fake()->boolean(),
            'completion_campaign_started_tag' => fake()->numberBetween(1,10000),
            'completed_tag' => fake()->numberBetween(1,10000)

        ];

        if($this->translated)
        {
            $constructed['course_id'] = Course::factory()->translate()->create();
        }
        else
        {
            $constructed['course_id'] = Course::factory()->create();
        }


        return $constructed;
    }

    public function translate(){
        //$this->translated = true;

        $attribs = [];

        $languages = config('languages');

        foreach(Module::translatables as $translatable)
        {
            foreach($languages as $language){
                $attribs[$translatable . $language['Language_code']] = fake()->sentence();
            }
        }


        return $this->state(fn () => $attribs);
    }

    public function setToTranslated()
    {
        $this->translated = true;
        return $this;
    }
}
