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
        $arraySize = $this->faker->numberBetween(1, 5);

        $sentenceArray = [];

        for ($i = 0; $i < $arraySize; $i++) {
            $sentenceArray[] = $this->faker->sentence(4);
        }

        $startDate = '2023-01-01';
        $endDate = '2024-01-01';

        return [
            'word' => $this->faker->word,
            'type' => $this->faker->word,
            'pronunciation' => $this->faker->word,
            'audio' => 'audiotest.mp3',
            'definition' => $this->faker->paragraph,
            'examples' => $sentenceArray,
            'image' => 'imgtest.jpg',
            'publish_date' => $this->faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
        ];
    }
}
