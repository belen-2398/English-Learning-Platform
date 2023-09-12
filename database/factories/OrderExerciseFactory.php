<?php

namespace Database\Factories;

use App\Models\OrderExercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderExercise>
 */
class OrderExerciseFactory extends Factory
{
    protected $model = OrderExercise::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $arraySize = $this->faker->numberBetween(2, 10);

        $sentenceArray = [];

        for ($i = 0; $i < $arraySize; $i++) {
            $sentenceArray[] = $this->faker->sentence();
        }

        return [
            'sentences' => $sentenceArray,
        ];
    }
}
