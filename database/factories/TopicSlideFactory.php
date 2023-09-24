<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TopicSlide>
 */
class TopicSlideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'topic_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word,
            'order' => $this->faker->randomNumber(3),
            'status' => $this->faker->boolean(),
            'prompt' => $this->faker->sentence(),
        ];
    }
}
