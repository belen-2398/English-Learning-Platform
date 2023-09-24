<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\FillExercise;
use App\Models\MatchExercise;
use App\Models\OrderExercise;
use App\Models\SelectExercise;
use App\Models\Topic;
use App\Models\TopicSlide;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exercise>
 */
class ExerciseFactory extends Factory
{
    public function definition(): array
    {
        // TODO: fix exerciseable.id
        $exerciseType = $this->faker->randomElement(
            ['match', 'fill', 'select', 'order']
        );

        $exerciseableType = null;

        if ($exerciseType === 'match') {
            $exerciseableType = MatchExercise::class;
        } elseif ($exerciseType === 'fill') {
            $exerciseableType = FillExercise::class;
        } elseif ($exerciseType === 'select') {
            $exerciseableType = SelectExercise::class;
        } elseif ($exerciseType === 'order') {
            $exerciseableType = OrderExercise::class;
        }
        
        return [
            'topic_slide_id' => $this->faker->unique()->numberBetween(1, 10),
            'type' => $exerciseType,
            'exerciseable_id' => $this->faker->randomNumber(),
            'exerciseable_type' => $exerciseableType,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Exercise $exercise) {
            if ($exercise->exerciseable_type === MatchExercise::class) {
                MatchExercise::factory()->create([
                    'id' => $exercise->exerciseable_id,
                ]);
            } elseif ($exercise->exerciseable_type === FillExercise::class) {
                FillExercise::factory()->create([
                    'id' => $exercise->exerciseable_id,
                ]);
            } elseif ($exercise->exerciseable_type === OrderExercise::class) {
                OrderExercise::factory()->create([
                    'id' => $exercise->exerciseable_id,
                ]);
            } elseif ($exercise->exerciseable_type === SelectExercise::class) {
                SelectExercise::factory()->create([
                    'id' => $exercise->exerciseable_id,
                ]);
            }
        });
    }
}
