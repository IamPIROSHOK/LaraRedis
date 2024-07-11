<?php

use App\Http\Controllers\PusherController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth::routes();

    Route::get('/chat', [PusherController::class, 'index']);
    Route::post('/broadcast', [PusherController::class, 'broadcast']);
    Route::post('/receive', [PusherController::class, 'receive']);
    Route::get('/', [UserController::class, 'withoutRedis'])->name('withoutRedis');


Route::get('/redis', [UserController::class, 'withRedis'])->name('withRedis');
