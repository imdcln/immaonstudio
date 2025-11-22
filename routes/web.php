<?php
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Public Views
Route::get('/about', [ViewController::class, 'about'])->name('about');
Route::get('/reviews', [ViewController::class, 'reviews'])->name('reviews');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// Guest Only
Route::middleware('guest')->group(function() {
    // Landing
    Route::get('/', [ViewController::class, 'landing'])->name('landing');

    // Auth
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signupPost'])->name('signup.post');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::get('/available-times', [ReservationController::class, 'getAvailableTimes'])->name('available-times');

// User
Route::middleware('user')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/reserve', [ViewController::class, 'reserve'])->name('reserve');
    Route::get('/reserve/list', [ViewController::class, 'reserveList'])->name('reserveList');

    Route::post('/reserve', [ReservationController::class, 'store'])->name('reserve.store');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');


    Route::prefix('profile')->group(function () {
        Route::get('/{user:username}', [ProfileController::class, 'index'])->name('profile');
        Route::get('/{user:username}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/{user:username}/edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/{user:username}/reservation/{reservation}', [ProfileController::class, 'destroyReservation'])->name('profile.reservation.delete');
    });

});