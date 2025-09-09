<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('signup.')->group( function() {
    Route::get('/signup', [AuthController::class, 'step1'])->name('step1');
    Route::get
}
);


