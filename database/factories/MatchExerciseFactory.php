<?php

namespace Database\Factories;

use App\Models\MatchExercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MatchExercise>
 */
class MatchExerciseFactory extends Factory
{
    protected $model = MatchExercise::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arraySize = $this->faker->numberBetween(3, 10);

        $leftArray = [];
        $rightArray = [];

        for ($i = 0; $i < $arraySize; $i++) {
            $leftArray[] = $this->faker->word();
            $rightArray[] = $this->faker->sentence(4);
        }

        return [
            'left' => $leftArray,
            'right' => $rightArray,
        ];
    }
}
