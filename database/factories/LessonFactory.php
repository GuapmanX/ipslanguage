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
    public function definition(): array
    {
        $constructed = [
            'module_id' => Module::factory(),
            'order' => 144,
            'active' => 1,
            'allowed_on_discovery' => 1,
            'share_id' => 'FAKEFAKEFAKE'
        ];

        return $constructed;
    }
}
