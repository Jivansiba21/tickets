<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/page', function () {
    return view('page');
});


Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
Route::post('/authenticate', [AuthController::class, 'Authentication'])->name('login.post');

