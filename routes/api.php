<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APISongController;
use App\Http\Controllers\APIUserController;
use App\Http\Middleware\JwtMiddleware;

Route::prefix("users")->group(function(){
    Route::post("/register",[APIUserController::class,"register"]);
    Route::post("/login",[APIUserController::class,"login"]);
});
Route::middleware(JwtMiddleware::class)->prefix("users")->group(function(){
    Route::post("/edit",[APIUserController::class,"edit"]);
});

Route::middleware(JwtMiddleware::class)->prefix("songs")->group(function(){
    Route::post("/create",[APISongController::class,"create"]);
});
Route::prefix("songs")->group(function(){
    Route::get('/', [APISongController::class,"all"]);
    Route::get('/search',[APISongController::class,"search"]);
});
