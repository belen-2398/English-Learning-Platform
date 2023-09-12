<?php

namespace Tests\Feature;
use App\Models\Lesson;
use App\Models\MatchExercise;
use App\Models\MixedExercise;
use App\Models\SelectExercise;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\Mime\Part\Multipart\MixedPart;
use Tests\TestCase;

class MixedExerciseTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create([
            'role_as' => 2,
        ]);

        $this->actingAs($admin);
    }

    public function test_mixed_exercise_empty_index_page()
    {

        $lesson = Lesson::factory()->create();

        $response = $this->get(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas(['mixedExercises', 'lesson']);
        $response->assertSee('No mixed exercises');
    }

    public function test_mixed_exercise_not_empty_index_page()
    {

        $lesson1 = Lesson::factory()->create();
        $lesson2 = Lesson::factory()->create();

        $visibleMixedExercise = MixedExercise::factory()->create(['lesson_id' => $lesson1->id]);
        $notVisibleMixedExercise = MixedExercise::factory()->create(['lesson_id' => $lesson2->id]);

        $response = $this->get(route('mixed-exercises.index', [
            'lessonId' => $lesson1->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas('mixedExercises', function ($collection) use ($visibleMixedExercise) {
            return $collection->contains($visibleMixedExercise);
        });
        $response->assertViewHas('mixedExercises', function ($collection) use ($notVisibleMixedExercise) {
            return !$collection->contains($notVisibleMixedExercise);
        });
        $response->assertViewHas('lesson');
    }

    public function test_mixed_exercise_paginated_index_page()
    {

        $lesson = Lesson::factory()->create();

        $newMixedExercises = MixedExercise::factory(11)->create(['lesson_id' => $lesson->id]);
        $lastMixedExercise = $newMixedExercises->last();

        $response = $this->get(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas('mixedExercises', function ($collection) use ($lastMixedExercise) {
            return !$collection->contains($lastMixedExercise);
        });
        $response->assertViewHas('lesson');
    }

    /**
     * @dataProvider sortDataProvider
     */
    public function test_mixed_exercise_index_page_with_sort($sortField, $sortOrder)
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise1 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 2,
            'type' => 'match'
        ]);

        $mixedExercise2 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercise B',
            'order' => 1,
            'type' => 'select'
        ]);

        $response = $this->get(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
            'sort_by' => $sortField,
            'sort' => $sortOrder,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas(['mixedExercises', 'lesson']);

        if ($sortField === 'name') {
            if ($sortOrder === 'asc') {
                $response->assertSeeInOrder(['Exercise A', 'Exercise B']);
            } elseif ($sortOrder === 'desc') {
                $response->assertSeeInOrder(['Exercise B', 'Exercise A']);
            }
        } elseif ($sortField === 'order') {
            if ($sortOrder === 'asc') {
                $response->assertSeeInOrder(['Exercise B', 'Exercise A']);
            } elseif ($sortOrder === 'desc') {
                $response->assertSeeInOrder(['Exercise A', 'Exercise B']);
            }
        } elseif ($sortField === 'type') {
            if ($sortOrder === 'asc') {
                $response->assertSeeInOrder(['Exercise A', 'Exercise B']);
            } elseif ($sortOrder === 'desc') {
                $response->assertSeeInOrder(['Exercise B', 'Exercise A']);
            }
        } else {
            $response->assertSeeInOrder(['Exercise B', 'Exercise A']);
        }
    }

    public static function sortDataProvider()
    {
        return [
            ['name', 'asc'],
            ['name', 'desc'],
            ['order', 'asc'],
            ['order', 'desc'],
            ['type', 'asc'],
            ['type', 'desc'],
        ];
    }

    /**
     * @dataProvider searchDataProvider
     */
    public function test_mixed_exercise_index_page_with_search($queryParameter, $query)
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise1 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'type' => 'match'
        ]);

        $mixedExercise2 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercise B',
            'type' => 'select'
        ]);

        $response = $this->get(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
            'query_parameter' => $queryParameter,
            'query' => $query,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas(['mixedExercises', 'lesson']);

        if ($queryParameter === 'name') {
            if ($query === 'Ex') {
                $response->assertSee(['Exercise A', 'Exercise B']);
            } elseif ($query === 'Lala') {
                $response->assertDontSee(['Exercise A', 'Exercise B']);
            } elseif ($query === 'Exercise A') {
                $response->assertSee('Exercise A');
                $response->assertDontSee('Exercise B');
            }
        } elseif ($queryParameter === 'type') {
            if ($query === 'match') {
                $response->assertSee('Exercise A');
                $response->assertDontSee('Exercise B');
            } elseif ($query === '1') {
                $response->assertDontSee(['Exercise A', 'Exercise B']);
            } elseif ($query === 'sel') {
                $response->assertSee('Exercise B');
                $response->assertDontSee('Exercise A');
            }
        } else {
            $response->assertSeeInOrder(['Exercise B', 'Exercise A']);
        }
    }

    public static function searchDataProvider()
    {
        return [
            ['name', 'Ex'],
            ['name', 'Lala'],
            ['name', 'Exercise A'],
            ['type', 'match'],
            ['type', 'Sel'],
            ['type', '1'],
        ];
    }

    public function test_mixed_exercise_index_page_with_search_and_sort_after()
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise1 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercises A',
            'order' => 3
        ]);

        $mixedExercise2 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercises B',
            'order' => 2
        ]);

        $mixedExercise3 = MixedExercise::factory()->create([
            'lesson_id' => $lesson->id,
            'name' => 'Exercise C',
            'order' => 1
        ]);

        $response = $this->get(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
            'query_parameter' => 'name',
            'query' => 'Exercises',
            'sort_by' => 'order',
            'sort' => 'asc',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.index');
        $response->assertViewHas(['mixedExercises', 'lesson']);

        $response->assertSeeInOrder(['Exercises B', 'Exercises A']);
        $response->assertDontSee('Exercise C');
    }

    public function test_mixed_exercise_create_page()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->get(route('mixed-exercises.create', [
            'lessonId' => $lesson->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.create');
        $response->assertViewHas(['lessonId']);
    }

    public function test_store_match_mixed_exercise()
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise = [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => true,
            'type' => 'match',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => MatchExercise::class,
            'left1' => 'dog',
            'left2' => 'cat',
            'left3' => 'cow',
            'left4' => '',
            'left5' => '',
            'left6' => '',
            'left7' => '',
            'left8' => '',
            'left9' => '',
            'left10' => '',
            'right1' => 'wof',
            'right2' => 'meow',
            'right3' => 'moo',
            'right4' => '',
            'right5' => '',
            'right6' => '',
            'right7' => '',
            'right8' => '',
            'right9' => '',
            'right10' => '',
        ];

        $response = $this->post(route('mixed-exercises.store'), $mixedExercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
        ]));
        $response->assertSessionHas('message', 'Mixed exercise created successfully');

        $this->assertDatabaseHas('mixed_exercises', [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => 1,
            'type' => 'match',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => 'App\\Models\\MatchExercise',
        ]);

        $this->assertDatabaseHas('match_exercises', [
            'left' => json_encode([
                'dog',
                'cat',
                'cow',
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ]),
            'right' => json_encode([
                'wof',
                'meow',
                'moo',
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ])
        ]);

        $lastMixedExercise = MixedExercise::latest()->first();
        $this->assertEquals($mixedExercise['name'], $lastMixedExercise->name);
    }

    public function test_store_select_mixed_exercise()
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise = [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => true,
            'type' => 'select',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => SelectExercise::class,
            'selectText' => 'dog, dog, dog',
            'selectAnswers' => 'dog, dog, dog',
        ];

        $response = $this->post(route('mixed-exercises.store'), $mixedExercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
        ]));
        $response->assertSessionHas('message', 'Mixed exercise created successfully');

        $this->assertDatabaseHas('mixed_exercises', [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => 1,
            'type' => 'select',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => 'App\\Models\\SelectExercise',
        ]);

        $this->assertDatabaseHas('select_exercises', [
            'text' => 'dog, dog, dog',
            'answers' => 'dog, dog, dog',
        ]);

        $lastMixedExercise = MixedExercise::latest()->first();
        $this->assertEquals($mixedExercise['name'], $lastMixedExercise->name);
    }

    public function test_store_order_mixed_exercise()
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise = [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => true,
            'type' => 'order',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => OrderExercise::class,
            'orSentence1' => 'dog, fog, fodo, fdfdf',
            'orSentence2' => 'cat, fog, fodo, fdfdf',
            'orSentence3' => 'cow, fog, fodo, fdfdf',
            'orSentence4' => '',
            'orSentence5' => '',
            'orSentence6' => '',
            'orSentence7' => '',
            'orSentence8' => '',
            'orSentence9' => '',
            'orSentence10' => '',
        ];

        $response = $this->post(route('mixed-exercises.store'), $mixedExercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
        ]));
        $response->assertSessionHas('message', 'Mixed exercise created successfully');

        $this->assertDatabaseHas('mixed_exercises', [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => 1,
            'type' => 'order',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => 'App\\Models\\OrderExercise',
        ]);

        $this->assertDatabaseHas('order_exercises', [
            'sentences' => json_encode([
                'dog, fog, fodo, fdfdf',
                'cat, fog, fodo, fdfdf',
                'cow, fog, fodo, fdfdf',
                null,
                null,
                null,
                null,
                null,
                null,
                null,
            ]),
        ]);

        $lastMixedExercise = MixedExercise::latest()->first();
        $this->assertEquals($mixedExercise['name'], $lastMixedExercise->name);
    }

    public function test_store_fill_mixed_exercise()
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise = [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => true,
            'type' => 'fill',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => FillExercise::class,
            'fillText' => 'dog, dog, dog',
            'words_to_fill' => 'dog, dog, dog',
        ];

        $response = $this->post(route('mixed-exercises.store'), $mixedExercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('mixed-exercises.index', [
            'lessonId' => $lesson->id,
        ]));
        $response->assertSessionHas('message', 'Mixed exercise created successfully');

        $this->assertDatabaseHas('mixed_exercises', [
            'lesson_id' => $lesson->id,
            'name' => 'Exercise A',
            'order' => 1,
            'status' => 1,
            'type' => 'fill',
            'mxexerciseable_id' => 1,
            'mxexerciseable_type' => 'App\\Models\\FillExercise',
        ]);

        $this->assertDatabaseHas('fill_exercises', [
            'text' => 'dog, dog, dog',
            'words_to_fill' => 'dog, dog, dog',
        ]);

        $lastMixedExercise = MixedExercise::latest()->first();
        $this->assertEquals($mixedExercise['name'], $lastMixedExercise->name);
    }

    public function test_mixed_exercise_show_page()
    {
        $lesson = Lesson::factory()->create();

        $mixedExercise = MixedExercise::factory()->create(['lesson_id' => $lesson->id]);

        $response = $this->get(route('mixed-exercises.show', [
            'mixed_exercise' => $mixedExercise,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.show');
        $response->assertViewHas('mixedExercise', $mixedExercise);
    }

    public function test_mixed_exercise_edit_page()
    {
        $mixedExercise = MixedExercise::factory()->create();

        $response = $this->get(route('mixed-exercises.edit', [
            'mixed_exercise' => $mixedExercise->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.mixed.edit');
        $response->assertSee('value="' . $mixedExercise->name . '"', false);
        $response->assertSee('value="' . $mixedExercise->order . '"', false);
        $response->assertSee('value="' . $mixedExercise->type . '"', false);

        if ($mixedExercise->status === true) {
            $response->assertSee('id="status" checked', false);
        } else {
            $response->assertDontSee('id="status" checked', false);
        }

        if ($mixedExercise->type === 'match') {
            $response->assertSee($mixedExercise->mxexerciseable->left[0]);
            $response->assertSee($mixedExercise->mxexerciseable->right[0]);
        } elseif ($mixedExercise->type === 'fill') {
            $response->assertSee($mixedExercise->mxexerciseable->text);
            $response->assertSee($mixedExercise->mxexerciseable->words_to_fill);
        } elseif ($mixedExercise->type === 'order') {
            $response->assertSee($mixedExercise->mxexerciseable->sentences[0]);
        } elseif ($mixedExercise->type === 'select') {
            $response->assertSee($mixedExercise->mxexerciseable->text);
            $response->assertSee($mixedExercise->mxexerciseable->answers);
        }


        $response->assertViewHas('mixedExercise', $mixedExercise);
    }

    public function test_mixed_exercise_update_validation_error_redirects_back_to_form()
    {
        $mixedExercise = MixedExercise::factory()->create();

        $response = $this->put(route('mixed-exercises.update', [
            'mixed_exercise' => $mixedExercise->id,
            'name' => '',
            'order' => '',
        ]));

        $response->assertStatus(302);
        $response->assertInvalid(['name', 'order']);
    }

    public function test_mixed_exercise_delete()
    {
        $mixedExercise = MixedExercise::factory()->create();
        $lessonId = $mixedExercise->lesson_id;

        $response = $this->delete(route('mixed-exercises.destroy', [
            'mixed_exercise' => $mixedExercise->id,
           
        ]));

        $response->assertStatus(302);
        $response->assertRedirect(route('mixed-exercises.index', [ 'lessonId'  => $lessonId]));
        $this->assertDatabaseMissing('mixed_exercises', $mixedExercise->toArray());
        $this->assertDatabaseCount('mixed_exercises', 0);
    }
}
