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
use App\Http\Controllers\CompletedController;
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
});

Route::get('/wordsOfDay', [WordOfDayController::class, 'usersIndex']);
Route::get('/wordsOfDay/{wordOfDay}', [WordOfDayController::class, 'usersShow'])->name('user.wordsOfDay.show');

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
    Route::get('/dictionary', function () {
        return Inertia::render('Dictionary');
    })->name('dictionary');
    Route::get('/profile', function () {
        return Inertia::render('Profile.Show');
    })->name('profile');

    Route::get('/completed', [TopicController::class, 'completedIndex']);
    Route::post('/topics/markAsCompleted/{topic}', [TopicController::class, 'markAsCompleted']);
    Route::delete('/topics/deleteAsCompleted/{topic}', [TopicController::class, 'deleteAsCompleted']);
});

Route::prefix('admin')->middleware([IsAdmin::class])->group(function () {
    Route::view('/dashboard', 'admin/dashboard')->name('admin.dashboard');
    Route::resource('/sliders', SliderController::class)->except('show');
    Route::resource('/lessons', AdminLessonController::class);
    Route::resource('/topics', AdminTopicController::class);
    Route::resource('/word-of-day', AdminWordOfDayController::class);
});
