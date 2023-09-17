<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\Lesson;
use App\Models\Topic;
use App\Models\TopicSlide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    // TODO: rerun after fixing views

    private $topicId;

    public function setUp(): void
    {
        parent::setUp();

        $admin = User::factory()->create([
            'role_as' => 2,
        ]);

        $lesson = Lesson::factory()->create();
        $topic = Topic::factory()->create(
            ['lesson_id' => $lesson->id]
        );

        $topicSlide = TopicSlide::factory()->create([
            'topic_id' => $topic->id
        ]);

        $this->topicId = $topicSlide->topic_id;

        $this->actingAs($admin);
    }

    public function test_exercise_create_page()
    {
        $response = $this->get(route('exercises.create', [
            'topicSlideId' => $this->topicId,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.create');
        $response->assertViewHas(['topicSlideId']);
    }

    public function test_store_match_exercise()
    {
        $exercise = [
            'topic_slide_id' => $this->topicId,
            'type' => 'match',
            'exerciseable_id' => 1,
            'exerciseable_type' => MatchExercise::class,
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

        $response = $this->post(route('exercises.store'), $exercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('topic-slides.topic.index', [
            'topicId' => $this->topicId,
        ]));
        $response->assertSessionHas('message', 'Exercise slide created successfully');

        $this->assertDatabaseHas('exercises', [
            'topic_slide_id' => $this->topicId,
            'type' => 'match',
            'exerciseable_id' => 1,
            'exerciseable_type' => 'App\\Models\\MatchExercise',
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
    }

    public function test_store_select_exercise()
    {
        $exercise = [
            'topic_slide_id' => $this->topicId,
            'type' => 'select',
            'exerciseable_id' => 1,
            'exerciseable_type' => SelectExercise::class,
            'selectText' => 'dog, dog, dog',
            'selectAnswers' => 'dog, dog, dog',
        ];

        $response = $this->post(route('exercises.store'), $exercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('topic-slides.topic.index', [
            'topicId' => $this->topicId,
        ]));
        $response->assertSessionHas('message', 'Exercise slide created successfully');

        $this->assertDatabaseHas('exercises', [
            'topic_slide_id' => $this->topicId,
            'type' => 'select',
            'exerciseable_id' => 1,
            'exerciseable_type' => 'App\\Models\\SelectExercise',
        ]);

        $this->assertDatabaseHas('select_exercises', [
            'text' => 'dog, dog, dog',
            'answers' => 'dog, dog, dog',
        ]);
    }

    public function test_store_order_exercise()
    {
        $exercise = [
            'topic_slide_id' => $this->topicId,
            'type' => 'order',
            'exerciseable_id' => 1,
            'exerciseable_type' => OrderExercise::class,
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

        $response = $this->post(route('exercises.store'), $exercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('topic-slides.topic.index', [
            'topicId' => $this->topicId,
        ]));
        $response->assertSessionHas('message', 'Exercise slide created successfully');

        $this->assertDatabaseHas('exercises', [
            'topic_slide_id' => $this->topicId,
            'type' => 'order',
            'exerciseable_id' => 1,
            'exerciseable_type' => 'App\\Models\\OrderExercise',
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
    }

    public function test_store_fill_exercise()
    {
        $exercise = [
            'topic_slide_id' => $this->topicId,
            'type' => 'fill',
            'exerciseable_id' => 1,
            'exerciseable_type' => FillExercise::class,
            'fillText' => 'dog, dog, dog',
            'words_to_fill' => 'dog, dog, dog',
        ];

        $response = $this->post(route('exercises.store'), $exercise);

        $response->assertStatus(302);
        $response->assertRedirect(route('topic-slides.topic.index', [
            'topicId' => $this->topicId,
        ]));
        $response->assertSessionHas('message', 'Exercise slide created successfully');

        $this->assertDatabaseHas('exercises', [
            'topic_slide_id' => $this->topicId,
            'type' => 'fill',
            'exerciseable_id' => 1,
            'exerciseable_type' => 'App\\Models\\FillExercise',
        ]);

        $this->assertDatabaseHas('fill_exercises', [
            'text' => 'dog, dog, dog',
            'words_to_fill' => 'dog, dog, dog',
        ]);
    }

    public function test_exercise_show_page()
    {
        $exercise = Exercise::factory()->create(['topic_slide_id' => $this->topicId]);

        $response = $this->get(route('exercises.show', [
            'exercise' => $exercise,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.show');
        $response->assertViewHas('exercise', $exercise);
    }

    public function test_exercise_edit_page()
    {
        $exercise = Exercise::factory()->create(['topic_slide_id' => $this->topicId]);

        $response = $this->get(route('exercises.edit', [
            'exercise' => $exercise->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.exercises.edit');
        $response->assertSee('value="' . $exercise->type . '"', false);

        if ($exercise->type === 'match') {
            $response->assertSee($exercise->exerciseable->left[0]);
            $response->assertSee($exercise->exerciseable->right[0]);
        } elseif ($exercise->type === 'fill') {
            $response->assertSee($exercise->exerciseable->text);
            $response->assertSee($exercise->exerciseable->words_to_fill);
        } elseif ($exercise->type === 'order') {
            $response->assertSee($exercise->exerciseable->sentences[0]);
        } elseif ($exercise->type === 'select') {
            $response->assertSee($exercise->exerciseable->text);
            $response->assertSee($exercise->exerciseable->answers);
        }

        $response->assertViewHas('exercise', $exercise);
    }

    public function test_exercise_update_validation_error_redirects_back_to_form()
    {
        $exercise = Exercise::factory()->create(['topic_slide_id' => $this->topicId]);

        $response = $this->put(route('exercises.update', [
            'exercise' => $exercise->id,
            'type' => '',
        ]));

        $response->assertStatus(302);
        $response->assertInvalid(['type']);
    }
}
