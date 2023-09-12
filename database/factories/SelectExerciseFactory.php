<?php

namespace Database\Factories;

use App\Models\SelectExercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SelectExercise>
 */
class SelectExerciseFactory extends Factory
{
    protected $model = SelectExercise::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->paragraph(),
            'answers' => $this->faker->word(4),
        ];
    }
}
