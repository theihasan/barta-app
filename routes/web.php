<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('user.login');
});

Route::get('/login', function (){
    return view('user.login');
});
Route::post('/login', [UserController::class,'login']);
Route::get('/logout', [UserController::class,'logout']);

Route::get('/register', [UserController::class,'registerView']);
Route::post('/register', [UserController::class,'register']);

Route::get('/profile', [UserController::class,'showProfilePage']);
Route::get('/edit-profile', [UserController::class,'showProfileData']);
Route::post('/profile-update', [UserController::class,'updateProfile']);

Route::get('/home', function(){
    return view('index');
});