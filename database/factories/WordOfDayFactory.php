<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WordOfDay>
 */
class WordOfDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'word' => $this->faker->word,
            'type' => $this->faker->word,
            'pronunciation' => $this->faker->word,
            'audio' => 'audiotest.mp3',
            'definition' => $this->faker->paragraph,
            'example1' => $this->faker->sentence,
            'example2' => $this->faker->sentence,
            'example3' => $this->faker->sentence,
            'example4' => $this->faker->sentence,
            'example5' => $this->faker->sentence,
            'image' => 'imgtest.jpg',
            'publish_date' => $this->faker->date(),
        ];
    }
}
