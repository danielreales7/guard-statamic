<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::post('/user/create', [UserController::class, 'create'])->middleware([HandlePrecognitiveRequests::class])->name('user.create');
Route::post('/user/authenticate', [UserController::class, 'authenticate'])->middleware([HandlePrecognitiveRequests::class])->name('user.authenticate');

Route::statamic('register', 'auth.register');

Route::middleware(['auth'])->group(function () {
    Route::statamic('/profile', 'profile.show')->name('profile.show');
});
