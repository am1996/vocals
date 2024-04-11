<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/",[PageController::class,'index'])->name("index");
Route::get("/list",[PageController::class,'listSongs']);
Route::get("/aboutus",[PageController::class,"aboutUs"])->name("aboutUs");
Route::get("/song/{id}",[PageController::class,'songDetails'])->name("details");

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [UserController::class,'logout'])->name('logout');
    Route::post("/create",[PageController::class,'createSong']);
    Route::get("/create",[PageController::class,'getCreateSongPage'])->name("createsong");
    Route::get("/{id}/edit",[PageController::class,'getEditsong'])->name("geteditsong");
    Route::post("/{id}/edit",[PageController::class,'updateSong'])->name("updatesong");
    Route::get("/dashboard",[PageController::class,'getDashboard'])->name("dashboard");
    Route::get("/changepassword",[UserController::class,"changePassword"])->name("changepassword");
    Route::post("/changepassword",[UserController::class,"updatePassword"])->name("updatepassword");
    Route::post("/edit",[UserController::class,"editUserData"])->name("edituser");
    Route::get("{id}/delete",[PageController::class,"deleteSong"])->name("deletesong");
});
Route::middleware(['guest'])->group(function(){
    Route::post("/store", [UserController::class,'register'])->name("store");
    Route::get("/login", [UserController::class,'getLogin'])->name("login");
    Route::get("/register", [UserController::class,'getRegister'])->name("register");
    Route::post("/authenticate", [UserController::class,'authenticate'])->name("authenticate");
});

Route::get("/api/csrf",function(){
    return [
        'csrf_token'=> csrf_token(),
    ];
});