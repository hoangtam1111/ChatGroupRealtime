<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/users', 'users.showAll')->name('users.all');

Route::get('/chat', [App\Http\Controllers\ChatController::class, 'showChat'])->name('show.chat');

Route::post('/chat/message', [App\Http\Controllers\ChatController::class, 'messageReceived'])->name('show.message');
Route::post('/chat/greet', [App\Http\Controllers\ChatController::class, 'greetReceived'])->name('show.greet');
