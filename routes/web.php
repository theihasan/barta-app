<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SinglePostController;
use App\Http\Controllers\PublicProfileController;


Route::get('/', function () {
    return view('user.login');
})->middleware('guest');



Route::middleware('auth')->group(function () {

    Route::get('/home', [HomePageController::class, 'index'])->name('home');


    Route::get('/profile', [ProfileController::class, 'index']);
    Route::get('/edit-profile', [UserController::class,'showProfileData'])->name('profile.show');
    Route::patch('/edit-profile', [UserController::class,'updateProfile'])->name('profile.edit');
    Route::get('/profile/{username}', [PublicProfileController::class,'index'])->name('public.profile');


    Route::post('/addpost', [PostController::class, 'create'])->name('post.create');
    Route::get('/posts/{postuuid}', [PostController::class, 'show'])->name('post.single');
    Route::get('/edit/{postuuid}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/edit/{postuuid}', [PostController::class, 'update'])->name('post.update');
    Route::get('/delete/{postuuid}', [PostController::class,'delete'])->name('post.delete');


    Route::post('/add-comment/{postid}', [CommentController::class,'create'])->name('comment.create');

    Route::get('/search', [SearchController::class,'index'])->name('search');
});

require __DIR__.'/auth.php';
