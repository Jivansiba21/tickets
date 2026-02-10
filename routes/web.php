<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;



Route::get('/page', function () {
    return view('page');
});

// Route::get('/github-test', function () {
//     return view('welcome');
// });

// Route::get('/github-test-1-2', function () {
//     return view('welcome');
// });
// Route::get('/login',[AuthController::class,'showLogin'])->name('login');
// Route::get('/logout',[AuthController::class,'logout'])->name('logout');
// Route::post('/authenticate', [AuthController::class, 'Authentication'])->name('login.post');


Route::get('/register', [RegisterController::class, 'show'])->name('register.form');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/authenticate', [LoginController::class, 'Authentication'])->name('login.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
