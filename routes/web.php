<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\NotUser\LessonController as NotUserLessonController;
use Inertia\Inertia;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\NotUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\NotUser\DashboardController as NotUserDashboardController;
use App\Http\Controllers\NotUser\TopicController as NotUserTopicController;
use App\Http\Controllers\NotUser\WordOfDayController as NotUserWordOfDayController;
use App\Http\Controllers\NotUser\ExerciseController as NotUserExerciseController;
use App\Http\Controllers\NotUser\ExplanationController;
use App\Http\Controllers\NotUser\MixedExerciseController as NotUserMixedExerciseController;
use App\Http\Controllers\NotUser\TopicSlideController;
use App\Http\Controllers\DictionaryWordController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\MixedExerciseController;
use App\Http\Controllers\WordOfDayController;

// TODO: ver si lo comentado sirve

Route::get('/', [FrontendController::class, 'index'])->name('welcome');

Route::controller(LessonController::class)->group(function () {
    Route::get('/lessons', 'index')->name('user.lessons.index');
    Route::get('/lessons/level/{level}', 'levelIndex');
    Route::get('/lessons/from0/{level}', 'from0Index')->name('user.lessons.from0');
    Route::get('/lessons/{lesson}', 'show')->name('user.lessons.show');
});

Route::controller(TopicController::class)->group(function () {
    Route::get('/topics/{topic}', 'usersShow')->name('user.topics.show');
    Route::get('/get-definition/{word}', 'getDefinition');
});

Route::controller(WordOfDayController::class)->group(function () {
    Route::get('/wordsOfDay/{wordOfDay}', 'usersShow')->name('user.wordsOfDay.show');
});

Route::controller(MixedExerciseController::class)->group(function () {
    Route::get('/mixed-exercise/{mixedExercise}', 'usersShow')->name('user.mixedExercises.show');
});


// Route::controller(ExerciseController::class)->group(function () {
//     Route::get('/exercises', 'usersIndex');
//     Route::get('/wordsOfDay/{wordOfDay}', 'usersShow')->name('user.wordsOfDay.show');
// });

Route::get('/about', function () {
    return Inertia::render('About', [
        'time' => now()->toTimeString()
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/profile', function () {
        return Inertia::render('Profile');
    })->name('profile');

    // Route::get('/profile', function () {
    //     return Inertia::render('Profile.Show');
    // })->name('profile');

    Route::apiResource('/dictionary', DictionaryWordController::class)->except('show');

    Route::get('/completed', [TopicController::class, 'completedIndex']);
    Route::post('/topics/markAsCompleted/{topic}', [TopicController::class, 'markAsCompleted']);
    Route::delete('/topics/deleteAsCompleted/{topic}', [TopicController::class, 'deleteAsCompleted']);
});

Route::prefix('admin')->middleware([IsAdmin::class])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

Route::prefix('not-user')->middleware([NotUser::class])->group(function () {
    Route::get('/dashboard', [NotUserDashboardController::class, 'index'])->name('not-user.dashboard');

    Route::view('/levels', 'admin/levels')->name('admin.levels');

    // Route::resource('/sliders', SliderController::class)->except('show');
    Route::resource('/lessons', NotUserLessonController::class)->except('show', 'create');
    Route::get('/lessons-level-index/{level}', [NotUserLessonController::class, 'levelIndex'])->name('lessons.level.index');
    Route::get('/lessons-create/{level?}', [NotUserLessonController::class, 'create'])->name('lessons.create');

    Route::resource('/topics', NotUserTopicController::class)->except('show', 'create');
    Route::get('/topics-lesson-index/{lessonId}', [NotUserTopicController::class, 'lessonIndex'])->name('topics.lesson.index');
    Route::get('/topics-create/{lessonId?}', [NotUserTopicController::class, 'create'])->name('topics.create');

    Route::resource('/topic-slides', TopicSlideController::class)->except('create', 'show');
    Route::get('/topic-slides-topic-index/{topicId}', [TopicSlideController::class, 'topicIndex'])->name('topic-slides.topic.index');
    Route::get('/topic-slides-create/{topicId?}', [TopicSlideController::class, 'create'])->name('topic-slides.create');

    Route::resource('/explanations', ExplanationController::class)->except('create', 'destroy', 'index');
    Route::get('/explanations-create/{topicSlideId}', [ExplanationController::class, 'create'])->name('explanations.create');

    Route::resource('/exercises', NotUserExerciseController::class)->except('create', 'destroy', 'index');
    Route::get('/exercises-create/{topicSlideId}', [NotUserExerciseController::class, 'create'])->name('exercises.create');

    Route::resource('/mixed-exercises', NotUserMixedExerciseController::class)->except('create');
    Route::get('/mixed-exercises-lesson-index/{lessonId}', [NotUserMixedExerciseController::class, 'lessonIndex'])->name('mixed-exercises.lesson.index');
    Route::get('/mixed-exercises-create/{lessonId?}', [NotUserMixedExerciseController::class, 'create'])->name('mixed-exercises.create');

    Route::resource('/word-of-day', NotUserWordOfDayController::class);
});
