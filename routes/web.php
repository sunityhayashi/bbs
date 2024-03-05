<?php

use App\Http\Controllers\BbsController;
use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('thread', 'App\Http\Controllers\ThreadController');
Route::resource('thread/{thread_id}/comment', 'App\Http\Controllers\CommentController');
