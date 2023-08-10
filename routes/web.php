<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;
use Inertia\Inertia;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Admin\TopicController as AdminTopicController;
use App\Http\Controllers\Admin\WordOfDayController as AdminWordOfDayController;
use App\Http\Controllers\Admin\ExerciseController as AdminExerciseController;
use App\Http\Controllers\Admin\ExplanationController;
use App\Http\Controllers\Admin\MixedExerciseController;
use App\Http\Controllers\Admin\TopicSlideController;
use App\Http\Controllers\DictionaryWordController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\WordOfDayController;

Route::get('/', [FrontendController::class, 'index'])->name('welcome');

Route::controller(LessonController::class)->group(function () {
    Route::get('/lessons', 'index');
    Route::get('/lessons/level/{level}', 'levelIndex');
    Route::get('/lessons/from0/{level}', 'from0Index')->name('user.lessons.from0');
    Route::get('/lessons/{lesson}', 'show')->name('user.lessons.show');
});

Route::controller(TopicController::class)->group(function () {
    Route::get('/topics/{topic}', 'usersShow')->name('user.topics.show');
    Route::get('/get-definition/{word}', 'getDefinition');
});

Route::controller(WordOfDayController::class)->group(function () {
    Route::get('/wordsOfDay', 'usersIndex');
    Route::get('/wordsOfDay/{wordOfDay}', 'usersShow')->name('user.wordsOfDay.show');
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
        return Inertia::render('Profile.Show');
    })->name('profile');

    Route::apiResource('/dictionary', DictionaryWordController::class)->except('show');

    Route::get('/completed', [TopicController::class, 'completedIndex']);
    Route::post('/topics/markAsCompleted/{topic}', [TopicController::class, 'markAsCompleted']);
    Route::delete('/topics/deleteAsCompleted/{topic}', [TopicController::class, 'deleteAsCompleted']);
});

Route::prefix('admin')->middleware([IsAdmin::class])->group(function () {
    Route::view('/dashboard', 'admin/dashboard')->name('admin.dashboard');
    // TODO: ver si sliders sirve y si para topics, topic-slides y exercises necesito todo el CRUD
    Route::resource('/sliders', SliderController::class)->except('show');
    Route::resource('/lessons', AdminLessonController::class);
    Route::resource('/topics', AdminTopicController::class)->except('show');
    Route::resource('/topic-slides', TopicSlideController::class)->except('index', 'create');
    Route::get('/topic-slides-index/{topicId}', [TopicSlideController::class, 'index'])->name('topic-slides.index');
    Route::get('/topic-slides-create/{topicId}', [TopicSlideController::class, 'create'])->name('topic-slides.create');
    Route::resource('/exercises', AdminExerciseController::class)->except('create');
    Route::get('/exercises-create/{topicSlideId}', [AdminExerciseController::class, 'create'])->name('exercises.create');
    Route::resource('/explanations', ExplanationController::class);
    Route::get('/explanations-create/{topicSlideId}', [ExplanationController::class, 'create'])->name('explanations.create');
    Route::resource('/mixed-exercises', MixedExerciseController::class)->except('index', 'create');
    Route::get('/mixed-exercises-index/{lessonId}', [MixedExerciseController::class, 'index'])->name('mixed-exercises.index');
    Route::get('/mixed-exercises-create/{lessonId}', [MixedExerciseController::class, 'create'])->name('mixed-exercises.create');
    Route::resource('/word-of-day', AdminWordOfDayController::class)->except('show');
});
