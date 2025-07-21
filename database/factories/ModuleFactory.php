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
            'order' => 1,
            'is_coming_soon' => 0,
            'ignore_progress' => 1,
            'active' => 0,
            'completion_campaign_started_tag' => null,
            'completed_tag' => 6868

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
                $attribs[$translatable . $language['Language_code']] = "TEST" . $language['Language'];
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
