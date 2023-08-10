<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MixedExercise>
 */
class MixedExerciseFactory extends Factory
{
    protected $model = MixedExercise::class;
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'exerciseable_id' => $this->faker->randomNumber(),
            'exerciseable_type' => $this->faker->randomElement([
                MatchExercise::class,
                FillExercise::class,
                OrderExercise::class,
                SelectExercise::class,
            ]),
            'name' => $this->faker->word,
            'order' => $this->faker->numberBetween(1, 100),
            'type' => $this->faker->randomElement(['match', 'fill', 'order', 'select']),
            'status' => $this->faker->boolean,
        ];
    }
}
