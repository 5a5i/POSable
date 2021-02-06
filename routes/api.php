<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['web']], function () {
Route::any('login', [App\Http\Controllers\API\UserController::class, 'login']);
Route::any('register', [App\Http\Controllers\API\UserController::class, 'register']);
Route::any('logout', [App\Http\Controllers\API\UserController::class, 'logout']);
});

Route::group(['prefix' => 'developer', 'middleware' => ['web']], function () {
    Route::get('/', [App\Http\Controllers\API\DeveloperController::class, 'index']);
    Route::post('add', [App\Http\Controllers\API\DeveloperController::class, 'store']);
    Route::get('view/{id}', [App\Http\Controllers\API\DeveloperController::class, 'show']);
    Route::get('edit/{id}', [App\Http\Controllers\API\DeveloperController::class, 'show']);
    Route::post('update/{id}', [App\Http\Controllers\API\DeveloperController::class, 'update']);
    Route::delete('delete/{id}', [App\Http\Controllers\API\DeveloperController::class, 'destroy']);
});
