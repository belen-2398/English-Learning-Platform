<?php

namespace Database\Factories;

use App\Models\DictionaryWord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DictionaryWord>
 */
class DictionaryWordFactory extends Factory
{
    protected $model = DictionaryWord::class;

    public function definition(): array
    {
        $arraySize = $this->faker->numberBetween(1, 5);

        $sentenceArray = [];

        for ($i = 0; $i < $arraySize; $i++) {
            $sentenceArray[] = $this->faker->sentence();
        }

        return [
            'user_id' => User::factory(),
            'word' => $this->faker->word,
            'notes' => $this->faker->paragraph(),
            'definition' => $this->faker->paragraph(),
            'pronunciation' => $this->faker->word,
            'translation' => $this->faker->word,
            'examples' => $sentenceArray,
        ];
    }
}
