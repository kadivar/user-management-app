<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('user', [UserController::class, 'show']);
    Route::post('user', [UserController::class, 'update']);
    Route::get('friends', [UserController::class, 'get_friends']);
    Route::post('friends', [UserController::class, 'update_friends']);
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('users/{destination_user_id}/scores', [UserController::class, 'update_scores']);
});
