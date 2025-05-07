<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CustomAuthenticatedSessionController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MembershipFormController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddGymEquipmentsController;

Route::get('/', function () {
    return view('welcome');
});


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
