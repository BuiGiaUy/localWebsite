<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
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
    Route::post('/create-room', [ChatController::class, 'storeRoom'])->name('room.store');
    Route::post('/search/', [ChatController::class, 'search'])->name('room.search');
});
