<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

/* 
Route::post('/user/login', [UserController::class, 'login']);
Route::delete('/user/{email}', [UserController::class, 'delete']);
Route::get('/user/{email}', [UserController::class, 'read']);

Route::post('/blog/article', [ArticleController::class, 'create']);
Route::delete('/blog/article/{id}', [ArticleController::class, 'delete']);
Route::get('/blog/article/{id}', [ArticleController::class, 'read']);

Route::post('/article/{article_id}/comment', [CommentController::class, 'create']);
Route::get('/article/{article_id}/comments', [CommentController::class, 'read']);
Route::delete('/article/{article_id}/comment/{id}', [CommentController::class, 'delete']);
*/