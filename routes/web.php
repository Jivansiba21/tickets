<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MessageController;



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

Route::resource('tickets', TicketController::class);



Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

Route::get('/home', function () {
    return view('page');
})->name('home');

Route::get('/tickets/{id}', [MessageController::class,'show'])
        ->name('tickets.show');

Route::post('/tickets/{id}/reply', [MessageController::class,'reply'])
        ->name('tickets.reply');

Route::get('/tickets/{id}/messages', [TicketController::class,'fetchMessages'])
        ->name('tickets.messages');


Route::get('/tickets/{id}/message', [TicketController::class, 'message'])->name('tickets.message');

Route::get('/tickets/{id}', [TicketController::class, 'show'])
    ->name('tickets.show');

//edit ticket details
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])
    ->name('tickets.edit');

Route::put('/tickets/{id}', [TicketController::class, 'update'])
    ->name('tickets.update');


//delete ticket
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])
    ->name('tickets.destroy');
