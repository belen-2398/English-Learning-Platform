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
use App\Http\Controllers\Admin\WordofDayController;

Route::get('/', [FrontendController::class, 'index'])->name('welcome');

Route::get('/lessons', function () {
    return Inertia::render('Lessons');
});

Route::controller(LessonController::class)->group(function () {
    Route::get('/A1', 'A1Index');
    Route::get('/A2', 'A2Index');
    Route::get('/B1', 'B1Index');
    Route::get('/B2', 'B2Index');
    Route::get('/C1', 'C1Index');
    Route::get('/C2', 'C2Index');
    Route::get('/A1-from-0', 'A1from0');
    Route::get('/A2-from-0', 'A2from0');
    Route::get('/B1-from-0', 'B1from0');
    Route::get('/B2-from-0', 'B2from0');
    Route::get('/C1-from-0', 'C1from0');
    Route::get('/C2-from-0', 'C2from0');
    Route::get('/lessons/{lesson}', 'show')->name('user.lessons.show');
});

Route::get('/topics', [TopicController::class, 'usersIndex']);
Route::get('/topics/{topic}', [TopicController::class, 'usersShow'])->name('user.topics.show');

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
});

Route::prefix('admin')->middleware([IsAdmin::class])->group(function () {
    Route::view('/dashboard', 'admin/dashboard')->name('admin.dashboard');
    Route::resource('/sliders', SliderController::class)->except('show');
    Route::resource('/lessons', AdminLessonController::class);
    Route::resource('/topics', AdminTopicController::class);
    Route::resource('/word-of-day', WordofDayController::class);
});
