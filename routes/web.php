<?php

use Inertia\Inertia;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render(
        'Welcome',
    
    );
})->name('welcome');



Route::get('/lessons', function () {
    return Inertia::render('Lessons');
});

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
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/dictionary', function () {
        return Inertia::render('Dictionary');
    })->name('dictionary');
    Route::get('/profile', function () {
        return Inertia::render('Profile.Show');
    })->name('profile');
});

Route::prefix('admin')->middleware([IsAdmin::class])->group(function () {
    Route::resource('sliders', SliderController::class);
});
