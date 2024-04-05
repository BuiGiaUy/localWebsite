<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
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
Route::group(['prefix' => 'chat-room'], function () {
    Route::get('/', [ChatController::class, 'index'])->name('room.index');
    Route::get('/room/{id}/users', [ChatController::class, 'getRoomUsers'])->name('room.users');
    Route::post('/{roomId}/send-message', [MessageController::class, 'sendMessage'])->name('room.send-message');
    Route::delete('/delete-message/{id}', [MessageController::class, 'deleteMessage'])->name('room.delete-message');
    Route::delete('/delete-room/{id}', [ChatController::class, 'deleteRoom'])->name('room.delete');
    Route::post('/edit-message/{id}', [MessageController::class, 'editMessage'])->name('room.edit-message');
    Route::post('/create-room', [ChatController::class, 'storeRoom'])->name('room.store');
    Route::get('/chat/{id}', [ChatController::class, 'chat'])->name('room.chat');
    Route::post('/search/', [ChatController::class, 'search'])->name('room.search');
    Route::post('/join', [ChatController::class, 'join'])->name('room.join');
});
