<?php
use App\Http\Controllers\ViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public Views
Route::get('/about', [ViewController::class, 'about'])->name('about');
Route::get('/reviews', [ViewController::class, 'reviews'])->name('reviews');
Route::get('/contact', [ViewController::class, 'contact'])->name('contact');

// Guest Only
Route::middleware('guest')->group(function() {
    // Landing
    Route::get('/', [LandingController::class, 'index'])->name('landing');

    // Auth
    Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signupPost'])->name('signup.post');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
});

// User
Route::middleware('user')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/home', [UserController::class, 'home'])->name('home');
});