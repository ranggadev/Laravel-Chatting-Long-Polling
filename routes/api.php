<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/siswa-list', [ChatController::class, 'siswaList'])->name('siswaList');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('sendMessage');
Route::get('/chatting-show', [ChatController::class, 'chattingShow'])->name('chattingShow');
Route::get('/latest-chatting', [ChatController::class, 'latestChatting'])->name('latestChatting');