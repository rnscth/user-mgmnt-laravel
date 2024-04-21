<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['namespace' => 'App\Http\Controllers'], function(){
    Route::middleware('auth:sanctum')->apiResource('users',UserController::class);
})->middleware('auth:sanctum');

// Login Route
Route::post('/login', 'App\Http\Controllers\AuthController@login');

// Logout Route
Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:sanctum');

// Register Route
Route::post('/register', 'App\Http\Controllers\AuthController@register');

// Verify token
Route::middleware('auth:sanctum')->get('/tokenVerify', 'App\Http\Controllers\AuthController@tokenVerify');

