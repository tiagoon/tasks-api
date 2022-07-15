<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
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

Route::group(['prefix'=>'/auth'], function(){
    Route::post("/login", [AuthController::class, 'login']);
    Route::post("/register", [AuthController::class, 'register']);
});

Route::middleware('auth:api')->group(function() {

    Route::get('/accounts', [UserController::class, 'me']);
    Route::put('/accounts', [UserController::class, 'update']);
    Route::delete('/accounts', [UserController::class, 'destroy']);

    Route::get("/tasks", [TaskController::class, 'index']);
    Route::get("/tasks/{id}", [TaskController::class, 'show']);
    Route::post("/tasks", [TaskController::class, 'store']);
    Route::put("/tasks/{id}", [TaskController::class, 'update']);
    Route::delete("/tasks/{id}", [TaskController::class, 'destroy']);

});
