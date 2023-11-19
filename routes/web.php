<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;


//User Oparation Route
Route::get('/', function () {
    return view('user.login');
});
Route::get('/login', function (){
    return view('user.login');
})->name('login');


Route::middleware(['guest'])->group(function(){
    
  
    Route::post('/login', [UserController::class,'login']);
    Route::get('/logout', [UserController::class,'logout']);
    
    Route::get('/register', [UserController::class,'registerView']);
    Route::post('/register', [UserController::class,'register']);
});



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class,'showProfilePage']);
    Route::get('/edit-profile', [UserController::class,'showProfileData']);
    Route::post('/profile-update', [UserController::class,'updateProfile']);
    Route::get('/profile/{username}', [PublicController::class,'publicProfile']);


    Route::get('/home', [PublicController::class, 'homePagePost'])->name('home');

    //Post Oparation Route 
    Route::post('/addpost', [PostController::class, 'addPost']);
    Route::get('/{postuuid}', [PublicController::class, 'singlePostShow']);
    Route::get('/edit/{uuid}', [PostController::class, 'updatePostData']);
    Route::put('/edit/{uuid}', [PostController::class, 'updatePost']);
    Route::get('/delete/{uuid}', [PostController::class,'deletePost']);
});







