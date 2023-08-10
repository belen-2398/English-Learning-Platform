<?php

// TODO: fix everything
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'topic_slide_id' => '6',
            'name' => $this->faker->word,
            'level' => $this->faker->randomElement(['A1', 'A2', 'B1', 'B2', 'C1', 'C2']),
            'category' => $this->faker->randomElement(['grammar', 'vocabulary', 'mixed']),
            'order' => $this->faker->unique()->numberBetween(1, 100),
            'status' => $this->faker->boolean(),
            'type' => $this->faker->randomElement(['match', 'fill', 'select', 'order']),
        ];
    }
}
