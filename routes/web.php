<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CustomAuthenticatedSessionController;
use App\Http\Controllers\success;
use App\Http\Controllers\AddGymEquipmentsController;
Route::get('/', function () {
    return view('welcome');
});



Route::get('/success', [success::class, 'index']);
Route::post('/success', [success::class, 'successPost'])->name('success.post');
Route::get('/stories', [Success::class, 'showStories'])->name('success.stories');
Route::post('/stories/{id}/like', [success::class, 'like'])->name('stories.like');
Route::post('/stories/{id}/dislike', [success::class, 'dislike'])->name('stories.dislike');

use App\Http\Controllers\GymEquipmentController;

Route::get('/buy-gym-equipments', [GymEquipmentController::class, 'index'])->name('buy.equipments');
Route::get('/order-form/{id}', [GymEquipmentController::class, 'orderForm'])->name('order.form');
Route::post('/submit-order', [GymEquipmentController::class, 'orderSubmit'])->name('order.submit');



Route::get('/user_home', function () {
    return view('user_home');
})->name('user_home');

Route::get('/trainer_home', function () {
    return view('trainer_home');
})->name('trainer_home');

Route::get('/redirect', [RedirectController::class, 'index'])->name('redirect');

Route::get('/login', [CustomAuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/membership', [MembershipController::class, 'index'])->name('Membership.index');
Route::post('/submit-form', [MembershipFormController::class, 'index'])->name('form.submit');

Route::get('/payment', function () {
    return view('payment');
})->name('payment');

Route::post('/submit-payment', [PaymentController::class, 'index'])->name('payment.submit');


Route::get('/addgymequipments', [AddGymEquipmentsController::class, 'index'])->name('AddGymEquipments.index');
Route::post('/addgymequipments', [AddGymEquipmentsController::class, 'submit'])->name('AddEquipments.submit');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
