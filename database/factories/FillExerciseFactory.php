<?php

namespace Database\Factories;

use App\Models\FillExercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FillExercise>
 */
class FillExerciseFactory extends Factory
{
    protected $model = FillExercise::class;

    public function definition(): array
    {
        return [
            'text' => $this->faker->paragraph(),
            'words_to_fill' => $this->faker->word(4),
        ];
    }
}
