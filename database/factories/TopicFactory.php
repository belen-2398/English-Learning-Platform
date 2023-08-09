<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'lesson_id' => '8',
            'name' => $this->faker->word,
            'category' => $this->faker->randomElement(['grammar', 'vocabulary']),
            'order' => $this->faker->unique()->numberBetween(1, 20),
            'points' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->boolean(),
        ];
    }
}
