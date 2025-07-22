<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Module;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
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
            'order' => fake()->numberBetween(1,1000),
            'active' => fake()->boolean(),
            'allowed_on_discovery' => fake()->boolean(),
            'share_id' => fake()->regexify('[A-Za-z]{10}')
        ];

        if($this->translated){
            $constructed['module_id'] = Module::factory()->translate()->setToTranslated()->create();
        }
        else{
            $constructed['module_id'] = Module::factory()->create();
        }


        return $constructed;
    }

    public function translate()
    {
        $this->translated = true;
        return $this;
    }
}
