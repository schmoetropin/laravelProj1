<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ForumController::class,'index']);

Route::get('/create',[ForumController::class,'create']);
Route::post('/create/do',[ForumController::class,'store']);
Route::get('/create/do',function(){ return redirect('/');});

Route::get('/show/{id}',[ForumController::class,'show']);
Route::get('/show/{id}/edit',[ForumController::class,'edit']);
Route::post('/show/{id}/edit/do',[ForumController::class,'update']);
Route::get('/show/{id}/edit/do',function(){ return redirect('/');});
Route::delete('/show/{id}/delete',[ForumController::class,'destroy']);
Route::get('/show/{id}/delete',function(){ return redirect('/');});

Route::get('/profile/{id}',[ProfileController::class,'show']);
Route::get('/myProfile',[ProfileController::class,'showMyProfile']);
Route::get('/myProfile/edit',[ProfileController::class,'editMyProfile']);
Route::post('/myProfile/edit/do',[ProfileController::class,'updateMyProfile']);
Route::get('/myProfile/edit/do',function(){ return redirect('/');});

Route::post('/show/{id}/like',[LikeController::class,'likeButton']);
Route::post('/show/{id}/dislike',[LikeController::class,'dislikeButton']);
Route::get('/show/{id}/like',function(){ return redirect('/');});
Route::get('/show/{id}/dislike',function(){ return redirect('/');});

Route::post('/search',[SearchController::class,'search']);
Route::get('/search',function(){ return redirect('/');});
/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
*/
require __DIR__.'/auth.php';
