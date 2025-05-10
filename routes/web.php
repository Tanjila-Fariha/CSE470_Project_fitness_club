<?php


use App\Http\Controllers\WorkoutClassController;
use App\Models\WorkoutClass;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\CustomAuthenticatedSessionController;
use App\Http\Controllers\success;
use App\Http\Controllers\AddGymEquipmentsController;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserClassController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MembershipFormController;

Route::get('/', function () {
    return redirect('/login');
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

Route::get('/sold-orders', [GymEquipmentController::class, 'showSoldOrders'])->name('sold.orders');




Route::middleware(['auth'])->get('/user_home', function () {
    // get all upcoming classes
    $classes = WorkoutClass::query()
        ->withCount('enrollments')
        ->where('start_time', '>', now())
        ->orderBy('start_time')
        ->get();

    // get user's enrolled classes
    $user = Auth::user(); // guaranteed to be non-null due to auth middleware

    $enrolledClasses = $user->enrollments()
        ->with('workoutClass')
        ->get()
        ->pluck('workoutClass');

    return view('user_home', compact('classes', 'enrolledClasses'));
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


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::prefix('trainers')->name('trainers.')->group(function () {
    Route::get('/classes', [WorkoutClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [WorkoutClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [WorkoutClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{workoutClass}/edit', [WorkoutClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{workoutClass}', [WorkoutClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{workoutClass}', [WorkoutClassController::class, 'destroy'])->name('classes.destroy');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// User Class Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/classes', [UserClassController::class, 'index'])->name('user.classes.index');
    Route::post('/classes/{class}/enroll', [UserClassController::class, 'enroll'])->name('user.classes.enroll');
    Route::delete('/classes/{class}/unenroll', [UserClassController::class, 'unenroll'])->name('user.classes.unenroll');
    Route::get('/my-classes', [UserClassController::class, 'myClasses'])->name('user.classes.my-classes');
    Route::post('/classes/{class}/rate', [UserClassController::class, 'rate'])->name('user.classes.rate');

    // Notification Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});
