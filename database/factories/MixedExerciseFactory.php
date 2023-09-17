<?php

namespace Database\Factories;

use App\Models\FillExercise;
use App\Models\Lesson;
use App\Models\MatchExercise;
use App\Models\MixedExercise;
use App\Models\OrderExercise;
use App\Models\SelectExercise;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MixedExercise>
 */
class MixedExerciseFactory extends Factory
{
    protected $model = MixedExercise::class;

    public function definition(): array
    {
        $exerciseType = $this->faker->randomElement(
            ['match', 'fill', 'select', 'order']
        );

        $mxableType = null;

        if ($exerciseType === 'match') {
            $mxableType = MatchExercise::class;
        } elseif ($exerciseType === 'fill') {
            $mxableType = FillExercise::class;
        } elseif ($exerciseType === 'select') {
            $mxableType = SelectExercise::class;
        } elseif ($exerciseType === 'order') {
            $mxableType = OrderExercise::class;
        }

        return [
            'lesson_id' => Lesson::factory(),
            'type' => $exerciseType,
            'mxexerciseable_id' => $this->faker->randomNumber(),
            'mxexerciseable_type' => $mxableType,
            'name' => $this->faker->word,
            'order' => $this->faker->randomNumber(3),
            'status' => $this->faker->boolean,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (MixedExercise $mixedExercise) {
            if ($mixedExercise->mxexerciseable_type === MatchExercise::class) {
                MatchExercise::factory()->create([
                    'id' => $mixedExercise->mxexerciseable_id,
                ]);
            } elseif ($mixedExercise->mxexerciseable_type === FillExercise::class) {
                FillExercise::factory()->create([
                    'id' => $mixedExercise->mxexerciseable_id,
                ]);
            } elseif ($mixedExercise->mxexerciseable_type === OrderExercise::class) {
                OrderExercise::factory()->create([
                    'id' => $mixedExercise->mxexerciseable_id,
                ]);
            } elseif ($mixedExercise->mxexerciseable_type === SelectExercise::class) {
                SelectExercise::factory()->create([
                    'id' => $mixedExercise->mxexerciseable_id,
                ]);
            }
        });
    }
}
