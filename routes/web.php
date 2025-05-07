<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CustomAuthenticatedSessionController;
use App\Http\Controllers\success;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/success', [success::class, 'index']);
Route::post('/success', [success::class, 'successPost'])->name('success.post');
Route::get('/stories', [Success::class, 'showStories'])->name('success.stories');
Route::post('/stories/{id}/like', [success::class, 'like'])->name('stories.like');
Route::post('/stories/{id}/dislike', [success::class, 'dislike'])->name('stories.dislike');


Route::get('/user_home', function () {
    return view('user_home');
})->name('user_home');

Route::get('/trainer_home', function () {
    return view('trainer_home');
})->name('trainer_home');

Route::get('/redirect', [RedirectController::class, 'index'])->name('redirect');

Route::get('/login', [CustomAuthenticatedSessionController::class, 'create'])->name('login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
