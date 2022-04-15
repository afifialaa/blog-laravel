<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\FavoriteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Authentication */
Route::post('/user/register', [AuthenticationController::class, 'register']);
Route::post('/user/login', [AuthenticationController::class, 'login'])->name('login');

/* User */
Route::delete('/user/{email}', [UserController::class, 'delete']);
Route::get('/user/{email}', [UserController::class, 'read']);

/* Article */
Route::post('/blog/article', [ArticleController::class, 'create'])->middleware('auth:sanctum');
Route::delete('/blog/article/{id}', [ArticleController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/blog/article/{id}', [ArticleController::class, 'read'])->middleware('auth:sanctum');
Route::get('/blog/articles', [ArticleController::class, 'index']);
Route::get('/blog/articles/{page}', [ArticleController::class, 'paginate']);

/* Comment */
Route::post('/article/{article_id}/comment', [CommentController::class, 'create'])->middleware('auth:sanctum');
Route::delete('/article/{article_id}/comment/{id}', [CommentController::class, 'delete'])->middleware('auth:sanctum');
Route::get('/article/{article_id}/comments', [CommentController::class, 'index']);

/* Favorite */
Route::post('/blog/user/favorite/{article_id}', [FavoriteController::class, 'create'])->middleware('auth:sanctum');
Route::get('/blog/user/favorite', [FavoriteController::class, 'index'])->middleware('auth:sanctum');
Route::get('/blog/user/favorite/{article_id}', [FavoriteController::class, 'read'])->middleware('auth:sanctum');
Route::delete('/blog/user/favorite/{artilce_id}', [FavoriteController::class, 'delete'])->middleware('auth:sanctum');