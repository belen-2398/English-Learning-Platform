<?php

namespace Tests\Feature;
// TODO: finish and see if this is correct
use App\Models\Lesson;
use App\Models\MixedExercise;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MixedExerciseTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_display_mixed_exercise_index_page()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('mixed-exercises.index', ['lessonId' => $lesson->id]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas(['mixedExercises', 'lesson']);
        // Add more assertions based on the expected data
    }

    public function it_can_create_a_mixed_exercise()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->post(route('mixed-exercises.store'), [
            // Provide necessary input data for creation
        ]);

        $response->assertStatus(302); // Assuming successful creation should redirect
        // Add more assertions based on the expected behavior
    }

    public function it_can_update_a_mixed_exercise()
    {
        $mixedExercise = MixedExercise::factory()->create();

        $response = $this->put(route('mixed-exercises.update', ['mixedExercise' => $mixedExercise->id]), [
            // Provide necessary input data for update
        ]);

        // Assert
        $response->assertStatus(302); // Assuming successful update should redirect
        // Add more assertions based on the expected behavior
    }

    /** @test */
    public function it_can_delete_a_mixed_exercise()
    {
        // Create a mixed exercise
        $mixedExercise = MixedExercise::factory()->create();

        // Act
        $response = $this->delete(route('mixed-exercises.destroy', ['mixedExercise' => $mixedExercise->id]));

        // Assert
        $response->assertStatus(302); // Assuming successful delete should redirect
        // Add more assertions based on the expected behavior
    }
}
