<?php

use App\Http\Controllers\APISongs;
use App\Http\Controllers\UserController;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APISongController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("user")->group(function(){
    Route::post("register",[UserController::class,"register"]);
});

Route::middleware("auth")->prefix("songs")->group(function(){
    Route::get('/', [APISongController::class,"all"]);
    Route::get('/search',[APISongController::class,"search"]);
    Route::post("/create",[APISongController::class,"create"]);
    Route::get('/{id}', [APISongController::class,"getById"]);
});
