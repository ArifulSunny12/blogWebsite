<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\profileController;
use App\Http\Controllers\settingController;
use App\Http\Controllers\publishPostController;
use App\Http\Controllers\editPostController;
use App\Http\Controllers\commentController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'joinpostuser'])->name('home');
Route::post('/publishPost', [publishPostController::class, 'postpublish'])->name('publishPost');
Route::get('/editpost/{id}', [editPostController::class, 'editpost'])->name('editpost');
Route::post('/updatepost', [editPostController::class, 'updatepost'])->name('updatepost');
Route::get('/deletepost/{id}', [editPostController::class, 'deletepost'])->name('deletepost');
Route::post('/postcomment', [commentController::class, 'postcomment'])->name('postcomment');
Route::get('/deletecomment/{id}', [commentController::class, 'deletecomment'])->name('deletecomment');
Route::get('/editcomment/{id}', [commentController::class, 'editcomment'])->name('editcomment');
Route::post('/updatecomment', [commentController::class, 'updatecomment'])->name('updatecomment');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/profile', [profileController::class, 'profile'])->name('profile');
Route::get('/setting', [settingController::class, 'setting'])->name('setting');
