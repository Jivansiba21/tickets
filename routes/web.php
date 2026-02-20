<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




// Route::get('/page', function () {
//     return view('page');
// });


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

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');




Route::group(['middleware' => 'auth'], function () {
    Route::resource('tickets', TicketController::class);



    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

    Route::get('/page', [HomeController::class, 'home'])->name('home');

    Route::get('/tickets/{id}', [MessageController::class, 'show'])
        ->name('tickets.show');

    Route::post('/tickets/{id}/reply', [MessageController::class, 'reply'])
        ->name('tickets.reply');

    Route::get('/tickets/{id}/messages', [TicketController::class, 'fetchMessages'])
        ->name('tickets.messages');


//Route::get('/tickets/{id}/message', [MessageController::class, 'show'])->name('tickets.message');

Route::get('/tickets/{id}/chat', [MessageController::class, 'show'])
    ->name('tickets.chat');

    //edit ticket details
    Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])
        ->name('tickets.edit');

    Route::put('/tickets/{id}', [TicketController::class, 'update'])
        ->name('tickets.update');


    //delete ticket
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])
        ->name('tickets.destroy');


    //user management routes(admin only)

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    //agent management routes(admin only)

    Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');

    Route::get('/agents/create', [AgentController::class, 'create'])->name('agents.create');

    Route::post('/agents', [AgentController::class, 'store'])->name('agents.store');
});

Route::post('tickets/read-message',[MessageController::class,'readMessage'])->name('tickets.readMessage');



Route::put('/tickets/status/{id}', [TicketController::class,'updateStatus'])
        ->name('tickets.status');
//edit user details

Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', [UserController::class, 'show'])
    ->name('users.show');

//edit agent details
Route::get('/agents/{id}/edit', [AgentController::class, 'edit'])->name('agents.edit');
Route::put('/agents/{id}', [AgentController::class, 'update'])->name('agents.update');
Route::delete('/agents/{id}', [AgentController::class, 'destroy'])->name('agents.destroy');
Route::get('/agents/{id}', [AgentController::class, 'show'])
    ->name('agents.show');

